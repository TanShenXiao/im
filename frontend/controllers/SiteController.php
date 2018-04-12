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
        $record=array_reverse(AdminRecord::find()->limit(200)->orderBy(['create'=>SORT_DESC])->asArray()->all(),true);
        $fd=Admin_fd::find()->where(["not",["fd"=>null]])->orderBy(['sort'=>SORT_DESC])->asArray()->all();
        $num=MemberUser::find()->count();
        if(isset($_GET['token']) and !empty($_GET['token'])){
            $uid=MemberUser::find()->where(["id"=>$_GET['token']])->select(['id','nickname','alias','portrait'])->one();
            if(!empty($uid) and empty($uid->portrait)){
                 $uid->portrait=rand(1,84).".jpg";
                 $uid->save();
            }
        }else{
            $uid=null;
        }
        if(!empty($uid['id']) and $uid['id'] == 394) {
            $array=[];
        }else{
            $fdnum=count($fd);
            if($fdnum < 15){
                $array=array_slice($array,0,15-$fdnum);
            }elseif($fdnum > 15){
                $array=[];
                $fd=array_slice($fd,0,15);
            }else{
                $array=array_slice($array,0,15);
            }
        }
        return $this->render('index',['record'=>$record,'uid'=>$uid,'number'=>$num,'member'=>$fd,'randname'=>$array]);
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
