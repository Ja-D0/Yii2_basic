<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%tbl_category}}".
 *
 * @property int $id
 * @property string $title
 *
 * @property Post[] $tblPosts
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * Gets query for [[TblPosts]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function getPosts()
    {
        return $this->hasMany(Post::class, ['category_id' => 'id'])->where(['publish_status' => Post::STATUS_PUBLISH]);
    }

    public function getCategory($id = 1)
    {
        return Category::findOne($id);
    }


    public function getCategories()
    {
        return new ActiveDataProvider(['query' => Category::find()]);
    }
}
