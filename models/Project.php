<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property string $projectId
 * @property string $projectName
 * @property string $projectHost
 * @property string $discribe
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['projectName', 'projectHost'], 'required'],
            [['discribe'], 'string'],
            [['projectName'], 'string', 'max' => 50],
            [['projectHost'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'projectId' => 'Project ID',
            'projectName' => 'Project Name',
            'projectHost' => 'Project Host',
            'discribe' => 'Discribe',
        ];
    }
}
