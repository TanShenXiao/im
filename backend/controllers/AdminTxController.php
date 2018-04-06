<?php
/**
 * Created by PhpStorm.
 * User: use
 * Date: 2018/3/31
 * Time: 9:03
 */

namespace backend\controllers;


use backend\models\AdminUser;
use backend\models\MemberUser;
use common\models\User;
use Yii;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class AdminTxController extends BaseController
{
    public $layout = "lte_main";

    public function actionIndex(){

        $query = MemberUser::find();
        $querys = Yii::$app->request->get('query');
        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]=$value;
                    if(empty($condition) == true){
                        $condition = " {$key}=:{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
        }
        //$models = $query->orderBy('display_order')
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '10',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );

        $orderby = ['created_at'=>SORT_ASC];
        $query = $query->orderBy($orderby);

        $models = $query
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
        ]);
    }

    public function actionDelete(array $ids)
    {
     if(count($ids) > 0){
        $model = MemberUser::find()->where(['in', 'id', $ids])->all();
        foreach ($model as $obj){

            if($obj->is_chat){
                $obj->is_chat=0;

            }else{
                $obj->is_chat=1;
            }
            $obj->save();       }
         echo json_encode(array('errno'=>0));
    }
    else{
        echo json_encode(array('errno'=>1));
    }


    }

    public function actionRealias()
    {
        $get=Yii::$app->request->get();
        if(!isset($get['id']) or empty($get['id']) or !isset($get['alias']) or empty($get['alias'])){
            return json_encode(['errno'=>1]);
        }
        $user=MemberUser::findOne(['id'=>$get['id']]);
        if(!$user){
            return json_encode(['errno'=>1]);
        }

        $user->alias=$get['alias'];
        if($user->save()){
            return json_encode(['errno'=>0]);
        }
    }

}