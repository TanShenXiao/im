<?php
/**
 * Created by PhpStorm.
 * User: use
 * Date: 2018/3/29
 * Time: 15:00
 */

namespace console\models;

use backend\models\MemberUser;
use common\models\AdminRecord;
use Yii;
use yii\base\Model;
use common\models\Admin_fd;
use backend\models\AdminUser;
use yii\di\ServiceLocator;
use yii\helpers\Json;


class Websocket extends  Model
{
    /**
     * 允许连接的ip
     */
    public $ip='0.0.0.0';
    /**
     * swoole端口号
     */
    public $sport=9501;
    /**
     * swoole对象
     */
    public $swoole_websocket_server;
    /**
     * redis对象
     */
    public $redis;

    public function __construct(array $config = [])
    {
        //parent::__construct($config);
        $this->swoole_websocket_server=new \swoole_websocket_server($this->ip,$this->sport);
        $this->swoole_websocket_server->set($config);

        $this->swoole_websocket_server->on('open',function (\swoole_websocket_server $server, $request){
            $this->open($server, $request);
        });

        $this->swoole_websocket_server->on('message',function (\swoole_websocket_server $server, $frame){
            $this->message($server, $frame);
        });
        $this->swoole_websocket_server->on('task',function ($serv, $fd, $from_id, $data){
            $this->task($serv, $fd, $from_id, $data);
        });
        $this->swoole_websocket_server->on('finish',function (){
            return '';
        });
        $this->swoole_websocket_server->on('close', function ($ser, $fd){
            $this->close($ser, $fd);
        });
    }

    /**
     *开启服务
     */
    public function start()
    {
        $this->swoole_websocket_server->start();
    }

    /**
     * @param \swoole_websocket_server $server
     * @param $request
     */
    private function open(\swoole_websocket_server $server, $request)
    {
        $get=$request->get;
        if(isset($get['token']) and !empty($get['token'])){
            if($user=MemberUser::find()->where(["id"=>$get['token']])->one()){
                if(!$modelfd=Admin_fd::find()->where(["uid"=>$user->id])->one()){
                    $modelfd=new Admin_fd();
                    $modelfd->created=time();
                }
                $modelfd->uid=$user->id;
                $modelfd->portrait=$user->portrait;
                $modelfd->name=$user->alias == null?$user->nickname:$user->alias;
                $modelfd->fd=$request->fd;
                $modelfd->update=time();
                $modelfd->save();
                $modelfd=Admin_fd::find()->where(["not",["fd"=>null]])->asArray()->all();
                $msg=[
                    'type'=>111,
                    'msg'=>$modelfd,
                ];
                foreach ($server->connections as $fdd){
                    if($fdd != $request->fd){
                        $server->push($fdd, Json::encode($msg));
                    }
                }

            }else{
                $mes=[
                    "type"=>110,
                    "msg"=>"用户验证失败请重新登录",
                ];
                $server->push($request->fd,Json::encode($mes));
            }

        }
       // echo "用户已上车\n";
        // print_r($request->get);
    }

    /**
     * @param \swoole_websocket_server $server
     * @param $frame
     */
    private function message(\swoole_websocket_server $server, $frame)
    {

        $server->task($frame->data.$frame->fd);
    }

    private function task(\swoole_websocket_server $server, $task_id, $worker_id, $data)
    {
        if(!preg_match("/({.+})(\d+)$/",$data,$arr)){
            return;
        }
        $data=json_decode($arr[1],true);
        if(!$modelfd=Admin_fd::find()->where(["fd"=>$arr[2]])->one()){
            $mess=[
                'type'=>110,
                'msg'=>'游客不能发言请登录',
            ];
            $server->push($arr[2],Json::encode($mess));
            return;
        }
        $is_chat=MemberUser::find()->where(['id'=>$modelfd->uid])->select('is_chat')->asArray()->one()['is_chat'];
        if(!$is_chat){
            $mess=[
                'type'=>110,
                'msg'=>'你没有发言权限请联系管理员',
            ];
            $server->push($arr[2],Json::encode($mess));
            return;
        }
                $model=new AdminRecord();
                $model->uid=$modelfd->uid;
                $model->portrait=$modelfd->portrait;
                $model->send_user=$modelfd->name;
                $model->content=base64_encode($arr[1]);
                $model->type=1;
                $model->create=time();
                $model->update=time();
                $model->save();
                print_r($model->errors);
                echo "大家好";
                $data['name']=$modelfd->name;
        foreach ($server->connections as $fd){
            if($fd != $arr[2]) {
                if($data['type'] == 1 ){
                    $server->push($fd, Json::encode($data));
                }
            }
        }
    }
    /**
     * @param $ser
     * @param $fd
     */
    private function close($ser, $fd)
    {
       if($model=Admin_fd::find()->where(['fd'=>$fd])->one()){
           $model->fd=null;
           $model->save();
           $modelfd=Admin_fd::find()->where(["not",["fd"=>null,"fd"=>$fd],])->orderBy(["sort"=>SORT_DESC])->asArray()->all();
           $msg=[
               'type'=>111,
               'msg'=>$modelfd,
           ];
           foreach ($ser->connections as $fdd){
               if($fdd != $fd){
                   $ser->push($fdd, Json::encode($msg));
               }
           }
       }
    }

}