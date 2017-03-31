<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "novel".
 *
 * @property int $id ID
 * @property string $title 标题
 * @property string $content 内容
 * @property string $tags 标签
 * @property int $status 状态
 * @property int $is_top 置顶
 * @property int $is_hot 热门
 * @property int $is_best 精华
 * @property int $create_time 创建时间
 * @property int $update_time 修改时间
 * @property int $author_id 作者
 */
class Novel extends \yii\db\ActiveRecord
{
    private $_oldTags;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'novel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'tags', 'status', 'author_id'], 'required','message'=>'{attribute}不能为空'],
            [['content', 'tags'], 'string'],
            [['status', 'is_top', 'is_hot', 'is_best', 'create_time', 'update_time', 'author_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签',
            'status' => '状态',
            'is_top' => '置顶',
            'is_hot' => '热门',
            'is_best' => '精华',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'author_id' => '作者',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->create_time = time();
                $this->update_time = time();
            }else
            {
                $this->update_time = time();
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        $this->_oldTags = $this->tags;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        Tag::updateFrequency($this->_oldTags,$this->tags);
    }

    public function afterDelete()
    {
        parent::afterDelete(); // TODO: Change the autogenerated stub
        Tag::updateFrequency($this->tags,'');
        Comment::updateComment($this->id);
    }

    public function getBeginning($length = 288)
    {
        $tmpStr = strip_tags($this->content);       //去除content中的HTML和PHP标记
        $tmpLen = mb_strlen($tmpStr);               //获取文本长度

        $tmpStr = mb_substr($tmpStr,0,$length,'utf-8');
        return $tmpStr.($tmpLen>$length?'...':"");
    }

    public function getAuthor()
    {
        return $this->hasOne(Author::className(),['userid'=>'author_id']);
    }

    public function getNumber()
    {
        $num = Novel::find()->where(['status'=>'1'])->count();
        return $num?$num:'';
    }

    public function getTag()
    {
        return $this->hasOne(Tag::className(),['id'=>'tags']);
    }

    public function approve()
    {
        $this->status = 2;
        return ($this->save()?true:false);
    }

    public function getUrl()
    {
        return Yii::$app->urlManager->createUrl(['novel/detail','id'=>$this->id,'title'=>$this->title]);
    }

    public function getCommentCount()
    {
        $num = Comment::find()->where(['novel_id'=>$this->id])->count();
        return $num?$num:0;
    }

//    public function  getTagLinks()
//    {
//        $links=array();
//        foreach(Tag::string2array($this->tags) as $tag)
//        {
//            $links[]=Html::a(Html::encode($tag),array('post/index','PostSearch[tags]'=>$tag));
//        }
//        return $links;
//    }
}
