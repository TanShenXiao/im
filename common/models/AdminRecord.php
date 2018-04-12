<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "admin_record".
 *
 * @property integer $id
 * @property integer $uid
 * @property string $portrait
 * @property string $send_user
 * @property string $content
 * @property integer $type
 * @property string $create
 * @property string $update
 */
class AdminRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_record';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'portrait', 'send_user', 'content'], 'required'],
            [['uid', 'type', 'create', 'update'], 'integer'],
            [['content'], 'string'],
            [['portrait', 'send_user'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'portrait' => 'Portrait',
            'send_user' => 'Send User',
            'content' => 'Content',
            'type' => 'Type',
            'create' => 'Create',
            'update' => 'Update',
        ];
    }
}
