<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id ID
 * @property string $pseudonym 笔名
 * @property int $userid 用户
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pseudonym', 'userid'], 'required'],
            [['userid'], 'integer'],
            [['pseudonym'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pseudonym' => '笔名',
            'userid' => '用户',
        ];
    }
}
