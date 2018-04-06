<?php
/**
 * Created by PhpStorm.
 * User: use
 * Date: 2018/3/29
 * Time: 16:27
 */

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UpFile extends Model
{
    public $filepath="RecordImg/";
    public $img;
    public function rules()
    {
        return [
            [['img'],'required'],
            ['img','file','extensions'=>'jpg,gif,png','maxSize'=>10000000]
        ];
    }

    public function attributeLabels()
    {
        return ['img'=>'文件'];
    }

    public function upFile($post)
    {
        $this->img=UploadedFile::getInstanceByName('img');
        if(!$this->validate()){
            return ['code'=>0,'msg'=>current($this->getFirstErrors())];
        }
        $path="im".time();
        if($this->img->saveAs($this->filepath. $path. '.' . $this->img->extension)){
            return ['code'=>1,'msg'=>$path . '.' . $this->img->extension];
        }

        return ['code'=>0,'msg'=>'文件上传失败'];



    }
}