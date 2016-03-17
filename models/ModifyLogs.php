<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modify_logs".
 *
 * @property string $id
 * @property string $userId
 * @property string $editTime
 * @property string $content
 * @property string $apiId
 */
class ModifyLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modify_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'editTime', 'content', 'apiId'], 'required'],
            [['userId', 'apiId'], 'integer'],
            [['editTime'], 'safe'],
            [['content'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'editTime' => 'Edit Time',
            'content' => 'Content',
            'apiId' => 'Api ID',
        ];
    }
}
