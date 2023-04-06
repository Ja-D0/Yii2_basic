<?php

namespace app\models;

use app\models\Category;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%tbl_post}}".
 *
 * @property int $id
 * @property string $title
 * @property string|null $anons
 * @property string|null $content
 * @property int|null $category_id
 * @property int|null $author_id
 * @property string $publish_status
 * @property string $publish_date
 *
 * @property User $author
 * @property Category $category
 */
class Post extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISH = 'PUBLISH';
    const STATUS_DRAFT = 'DRAFT';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tbl_post}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publish_date', 'tags'], 'safe'],
            //Добавил


            [['title'], 'required'],
            [['anons', 'content', 'publish_status'], 'string'],
            [['category_id', 'author_id'], 'integer'],
            [['publish_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'anons' => 'Анонс',
            'content' => 'Содержание',
            'category_id' => 'Категория',
            'author_id' => 'Автор',
            'publish_status' => 'Статус',
            'publish_date' => 'Дата',
            'tags' => 'Тэги',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }




















    protected $tags = [];



    public function setTags($tagsId)
    {
        $this->tags = (array) $tagsId;
    }

    public function getTags()
    {
        return ArrayHelper::getColumn(
            $this->getTagPost()->all(), 'tag_id'
        );
    }



    function getPublishedPosts()
    {
        return new ActiveDataProvider([
            'query' => Post::find()
                ->where(['publish_status' => self::STATUS_PUBLISH])
        ]);
    }

    public function getTagPost()
    {
        return $this->hasMany(TagPost::className(), ['post_id' => 'id']);
    }
    public function afterSave($insert, $changedAttributes)
    {
        TagPost::deleteAll(['post_id' => $this->id]);
        $values = [];
        foreach ($this->tags as $id) {
            $values[] = [$this->id, $id];
        }
        self::getDb()->createCommand()
            ->batchInsert(TagPost::tableName(), ['post_id', 'tag_id'], $values)->execute();

        parent::afterSave($insert, $changedAttributes);
    }
}

