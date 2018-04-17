<?php
/**
 * Created by PhpStorm.
 * User: 谭深潇
 * Date: 2018/4/5
 * Time: 10:57
 */

namespace frontend\models;


use yii\base\Model;
use backend\models\MemberUser;
use common\models\Admin_fd;
use common\models\AdminRecord;

class ReName extends Model
{
    /**
     * @var
     */
    public $user;
    /**
     * @var
     */
    public $id;
    /**
     * @var
     */
    public $alias;

    public function rules()
    {
        return [
            [['id','alias'],'required'],
            ['id','validate_id'],
        ];
    }

    public function attributeLabels()
    {
       return [
           'id'=>'用户id',
           'alias'=>'用户别名',
       ];
    }

    public function validate_id($attribute)
    {
        if($this->errors){
            return ;
        }
        if(MemberUser::findOne(['alias'=>$this->alias])){
            $this->addError($attribute,'别名已存在');
        }

        $this->user=MemberUser::findOne(['id'=>$this->id]);
        if(!$this->user){
            $this->addError($attribute,'用户不存在');
        }
    }

    public function Realias($data)
    {
        $this->load($data,'');
        if(!$this->validate()){
            return ['code'=>0,current($this->getFirstErrors())];
        }

        $this->user->alias=$this->alias;
        $fd=Admin_fd::find()->where(['uid'=>$this->id])->all();
        foreach($fd as $obj){
                $obj->name=$this->alias;
                $obj->save();
        }

        $recrod=AdminRecord::find()->where(['uid'=>$this->id])->all();
        foreach($recrod as $obj){
            $obj->send_user=$this->alias;
            $obj->save();
        }
        if($this->user->save()){
            return ['code'=>1,'用户名修改成功'];
        }

        return ['code'=>0,'用户名修改失败'];
    }


}