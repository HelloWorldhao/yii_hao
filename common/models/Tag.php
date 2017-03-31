<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property int $id
 * @property string $name
 * @property int $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '标签',
            'frequency' => '文章数',
        ];
    }

//    public static function string2array($tags)   //正则表达式分割字符串，返回数组
//    {
//        return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
//    }

//    public static function array2string($tags)  //数组转化为字符串
//    {
//        return implode(',',$tags);
//    }

//    public static function addTags($tags)    //传入标签数组
//    {
//        if(empty($tags)) return ;
//
//        foreach($tags as $name)
//        {
//            $aTag = Tag::find()->where(['name'=>$name])->one();
//
//            if(!$aTag)
//            {
//                $tag = new Tag;
//                $tag->name = $name;
//                $tag->frequency = 1;
//                $tag->save();
//            }
//            else
//            {
//                $aTag->frequency += 1;
//                $aTag->save();
//            }
//        }
//    }

//    public static function removeTags($tags)  //传入标签数组
//    {
//        if(empty($tags))  return ;
//
//        foreach($tags as $name)
//        {
//            $aTag = Tag::find()->where(['name'=>$name])->one();
//
//            if($aTag)
//            {
//                if($aTag->frequency<=0)
//                {
//                    $aTag->delete();
//                }
//                else
//                {
//                    $aTag->frequency -= 1;
//                    $aTag->save();
//                }
//            }
//        }
//    }

//    public static function updateFrequency($oldTags,$newTags)
//    {
//        if(!empty($oldTags) ||!empty($newTags))
//        {
//            $oldTagsArray = self::string2array($oldTags);
//            $newTagsArray = self::string2array($newTags);
//
//            self::addTags(array_values(array_diff($newTagsArray,$oldTagsArray)));    //返回新标签组与旧标签组的差集数组,并将数组重新按键值0开始以1递增排序
//            self::removeTags(array_values(array_diff($oldTagsArray,$newTagsArray)));
//        }
//    }
    public static function updateFrequency($oldTags,$newTags)
    {
        if(!empty($oldTags))
        {
            $old = Tag::findOne($oldTags);
            $old->frequency -=1;
            $old->save();
        }
        if(!empty($newTags))
        {
            $new = Tag::findOne($newTags);
            $new->frequency +=1;
            $new->save();
        }
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert))
        {
            if($insert)
            {
                $this->frequency = 0;
            }
            return true;
        }
        else
        {
            return false;
        }
    }
}
