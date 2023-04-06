<?php

namespace app\models;

use app\controllers\SiteController;
use Yii;
use yii\base\Model;
use function Symfony\Component\String\s;

class SignUpForm extends User
{
public $login;
public $email;
public $about = 'Напишите больше о себе';
public $password;
public $status = 1;
public $role;

public $update_at;
public $tblPosts;


    public function rules()
    {
        return [
            ['login', 'filter', 'filter' => 'trim'],
            ['login', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['login', 'unique', 'targetClass' => User::className(), 'message' => 'This username has already been taken.'],
            ['login', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['nickname', 'filter', 'filter' => 'trim'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['role', 'boolean']
        ];
    }

    public function signUp()
    {
        $user = new User();
        if ($this->validate()) {
            $user->login = $this->login;
            $user->nickname = $this->login;
            $user->email = $this->email;
            $user->hash_password = $user->setPasswordHash($this->password);
            $user->auth_key = $user->generateAuthKey();
            $user->about = $this->about;
            $user->created_at = Yii::$app->formatter->asDate('now', 'long');
            $user->role = $this->role;
           if ($user->save()) {
                return $user;
            }
        }
        return null;

    }

}



