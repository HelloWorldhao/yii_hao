<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id ID
 * @property string $content 评论内容
 * @property int $status 状态
 * @property int $create_time 创建时间
 * @property int $userid 用户
 * @property int $novel_id 文章
 */
class Comment extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'userid', 'novel_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'userid', 'novel_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '评论内容',
            'status' => '状态',
            'create_time' => '发布时间',
            'userid' => '作者',
            'novel_id' => '文章',
        ];
    }

    public static function updateComment($novel_id)
    {
        if($comments =Comment::find()->where(['novel_id'=>$novel_id])->all()){
            Comment::deleteAll('novel_id = :novel_id',[':novel_id'=>$novel_id]);
        }
//        $comments->delete();
    }

    public function getBeginning()
    {
        $tmpStr = strip_tags($this->content);       //剥去HTML、XML以及PHP的标签
        $tmpLen = mb_strlen($tmpStr);                //获取字符串长度
        return mb_substr($tmpStr,0,10,'utf-8').(($tmpLen>50)?'...':'');
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userid']);
    }

    public function getNovel()
    {
        return $this->hasOne(Novel::className(),['id'=>'novel_id']);
    }

    public function getNumber()
    {
        $num = Comment::find()->where(['status'=>'1'])->count();
        return $num?$num:'';
    }

    public function approve()
    {
        $this->status = 2;
        return ($this->save()?true:false);
    }
}
