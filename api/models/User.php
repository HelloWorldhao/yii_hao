<?php

namespace api\models;

use Yii;
use yii\web\IdentityInterface;
use yii\filters\RateLimitInterface;


/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $pseudonym 别名
 * @property string $auth_key 密钥
 * @property string $password_hash Hash密码
 * @property string $password_reset_token 密码重置
 * @property string $email Email
 * @property string $access_token
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 修改时间
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface , RateLimitInterface
{
    const STATUS_ACTIVE = 1; 

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'pseudonym', 'auth_key', 'password_hash', 'email', 'access_token', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'access_token'], 'string', 'max' => 255],
            [['pseudonym'], 'string', 'max' => 128],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'pseudonym' => 'Pseudonym',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'access_token' => 'Access Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    //过滤掉一些敏感字段
    public function fields()
    {
        $fields = parent::fields();
        unset($fields['auth_key'],$fields['password_hash'],$fields['password_reset_token'],$fields['access_token'],$fields['created_at'],$fields['updated_at'],$fields['allowance'],$fields['allowance_updated_at']);
        return $fields;
    }

    // 返回某一时间允许请求的最大数量，比如设置10秒内最多5次请求（小数量方便我们模拟测试
    public  function getRateLimit($request, $action){
        return [5, 10];
    }

    // 回剩余的允许的请求和相应的UNIX时间戳数 当最后一次速率限制检查时
    public  function loadAllowance($request, $action){
        return [$this->allowance, $this->allowance_updated_at];
    }

    // 保存允许剩余的请求数和当前的UNIX时间戳
    public  function saveAllowance($request, $action, $allowance, $timestamp){
        $this->allowance = $allowance;
        $this->allowance_updated_at = $timestamp;
        $this->save();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token,'status'=>self::STATUS_ACTIVE]);
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return $this->authKey;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
