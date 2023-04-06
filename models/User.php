<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use function Symfony\Component\String\s;

/**
 * This is the model class for table "{{%tbl_user}}".
 *
 * @property int $id
 * @property string $login
 * @property string $email
 * @property string $nickname
 * @property string|null $about
 * @property string|null $hash_password
 * @property string|null $status
 * @property string|null $auth_key
 * @property string|null $created_at
 * @property string|null $update_at
 * @property boolean|null $role
 *
 * @property Post[] $tblPosts
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * User status
     */
    const STATUS_BLOCKED = 0;
    const STATUS_ACTIVE = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'nickname', 'email'], 'required'],
            [['email'], 'email'],
            [['login', 'nickname', 'email'], 'unique'],
            [['about'], 'string'],
            [['created_at', 'update_at'], 'string'],
            ['created_at', 'default', 'value' => Yii::$app->formatter->asDate('now', 'long')],
            [['login'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 100],
            [['nickname', 'hash_password', 'status', 'auth_key'], 'string', 'max' => 255],

            ['role' , 'boolean'],
            ['status', 'integer'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password' => 'Пароль',
            'role' => 'Роль',
            'login' => 'Логин',
            'email' => 'Электронная почта',
            'nickname' => 'Ник',
            'about' => 'О себе',
            'hash_password' => 'Хэш пароля',
            'status' => 'Статус',
            'auth_key' => 'Ключ аутентификации',
            'created_at' => 'Создан',
            'update_at' => 'Обновлён',
        ];
    }

    /**
     * Gets query for [[TblPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::class, ['author_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findByUsername($username)
    {
        return static::findOne(['login' => $username]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->hash_password);
    }

    public function setPasswordHash($password)
    {
        return $this->hash_password = Yii::$app->security->generatePasswordHash($password);
    }

    public function generateAuthKey()
    {
        return $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
