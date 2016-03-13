<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api".
 *
 * @property string $apiId
 * @property string $fkProjectId
 * @property string $functionName
 * @property string $apiName
 * @property string $number
 * @property string $params
 * @property string $returnParams
 * @property string $type
 * @property integer $userId
 * @property string $lastTime
 */
class Api extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fkProjectId','apiName', 'functionName', 'number', 'userId', 'lastTime'], 'required'],
            [['fkProjectId', 'userId'], 'integer'],
            [['params', 'returnParams','apiDiscribe'], 'string'],
            [['lastTime'], 'safe'],
            [['functionName'], 'string', 'max' => 50],
            [['apiName'], 'string', 'max' => 50],
            [['number', 'type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apiId' => 'Api ID',
            'fkProjectId' => 'Fk Project ID',
            'functionName' => 'Function Name',
            'apiName' => 'Api Name',
            'number' => 'Number',
            'params' => 'Params',
            'returnParams' => 'Return Params',
            'type' => 'Type',
            'userId' => 'User ID',
            'lastTime' => 'Last Time',
            'apiDiscribe' => 'Api Discribe',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['projectId' => 'fkProjectId']);
    }
}
