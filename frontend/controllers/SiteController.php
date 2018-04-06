<?php
namespace frontend\controllers;

use http\Url;
use Yii;
use backend\models\MemberUser;
use common\models\Admin_fd;
use common\models\AdminRecord;
use backend\models\AdminUser;
use yii\helpers\Json;
use frontend\models\UpFile;
use backend\models\RandName;
use frontend\models\ReName;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
    public $layout=false;
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $array=RandName::name();
        shuffle($array);
        $record=AdminRecord::find()->limit(200)->orderBy(['create'=>SORT_ASC])->asArray()->all();
        $fd=Admin_fd::find()->where(["not",["fd"=>null]])->orderBy(['sort'=>SORT_DESC])->asArray()->all();
        if(isset($_GET['token']) and !empty($_GET['token'])){
            $uid=MemberUser::find()->where(["id"=>$_GET['token']])->select(['id','nickname','alias','portrait'])->one();
            if(!empty($uid) and empty($uid->portrait)){
                 $uid->portrait=rand(1,84).".jpg";
                 $uid->save();
            }
            if(!empty($uid['id']) and $uid['id'] == 480) {
                $array=[];
            }else{
                $fdnum=count($fd);
                if($fdnum < 17){
                    $array=array_slice($array,0,17-$fdnum);
                }elseif($fdnum > 17){
                    $array=[];
                    $fd=array_slice($fd,0,17);
                }else{
                    $array=array_slice($array,0,17);
                }
            }
        }else{
            $uid=null;
        }
        return $this->render('index',['record'=>$record,'uid'=>$uid,'member'=>$fd,'randname'=>$array]);
    }

    /**
     * 重置用别名
     */
    public function actionReAlias()
    {
        $get=Yii::$app->request->get();
        $model=new ReName();
        return Json::encode($model->Realias($get));

    }

    /**
     * upfile
     */
    public function actionUp()
    {
        $request=Yii::$app->request;
        if($request->isAjax){
            $upfile=new UpFile();
            return Json::encode($upfile->upFile($request->post()));
        }

    }


}
