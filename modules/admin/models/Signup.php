<?php
namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Users;

/**
 * Signup model
 */
class Signup extends Users
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['login', 'required', 'message' => 'Логин не может быть пустым'],
            ['password', 'required', 'message' => 'Пароль не может быть пустым'],
            ['email', 'required', 'message' => 'Email не может быть пустым'],
            ['password', 'string', 'min' => 8, 'max' => 255, 'tooShort' => 'Длина пароля не минее 8 символов'],
            ['login', 'unique', 'targetClass' => Signup::className(), 'message' => 'Пользователь с таким логином уже существует'],            
            ['email', 'unique', 'targetClass' => Signup::className(), 'message' => 'Пользователь с таким email уже существует'],
        ];
    }
   
}
