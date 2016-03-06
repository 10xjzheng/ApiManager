<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class ApiForm extends Model
{
    public $apiNum;
    public $apiName;
    public $apiUrl;
    public $type;
    private $_api = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['apiNum'], 'required'],
            [['apiName'], 'required'],
            [['apiUrl'], 'required'],
            [['type'], 'required'],

        ];
    }

 
}
