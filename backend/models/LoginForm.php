<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/17
 * Time: 15:32
 */

namespace backend\models;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password_hash;
    public $code;
    public $rememberMe;//记住我

    public function rules()
    {
        return [
            [['username', 'password_hash',], 'required'],
            ['code', 'captcha', 'captchaAction' => 'admin/captcha'],
            ['rememberMe', 'safe']

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'password_hash'=>'密码',
            'cade'=>'密码',
        ];

    }
}
