<?php

/**
 * This is the model class for table "tbb_topics".
 *
 * The followings are the available columns in table 'tbb_topics':
 * @property integer $id
 * @property integer $is_active
 * @property integer $is_sticky
 * @property integer $is_locked
 * @property string $title
 * @property string $slug
 * @property integer $poster_id
 * @property integer $forum_id
 * @property integer $num_hits
 * @property string $created_at
 * @property string $last_reply_on
 * @property string $last_reply_user
 */
class Topic extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Topic the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{topics}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, slug, poster_id, forum_id, num_hits, last_reply_user', 'required'),
            array('poster_id, forum_id, num_hits', 'numerical', 'integerOnly' => true),
            array('is_active, is_sticky, is_locked', 'boolean'),
            array('title', 'length', 'max' => 255),
            array('slug', 'length', 'max' => 80),
            array('last_reply_user', 'length', 'max' => 48),
            array('created_at, last_reply_on', 'safe'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, is_active, is_sticky, is_locked, title, poster_id, forum_id, created_at', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'poster' => array(self::BELONGS_TO, 'User', 'poster_id'),
            'forum' => array(self::BELONGS_TO, 'Forum', 'forum_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'is_active' => 'Is Active?',
            'is_sticky' => 'Is Sticky?',
            'is_locked' => 'Is Locked?',
            'title' => 'Title',
            'slug' => 'Slug',
            'poster_id' => 'Poster',
            'forum_id' => 'Forum',
            'num_hits' => 'Number of Hits',
            'created_at' => 'Created At',
            'last_reply_on' => 'Last Reply On',
            'last_reply_user' => 'Last Reply User',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('is_sticky', $this->is_sticky);
        $criteria->compare('is_locked', $this->is_locked);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('poster_id', $this->poster_id);
        $criteria->compare('forum_id', $this->forum_id);
        $criteria->compare('num_hits', $this->num_hits);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('last_reply_on', $this->last_reply_on, true);
        $criteria->compare('last_reply_user', $this->last_reply_user, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function scopes()
    {
        return array(
            'activeTopics' => array('condition' => 'is_active=1', 'limit' => 10),
        );
    }

    // set some default values before creating a new record
    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->slug = self::slugify($this->title);
                $this->created_at = new CDbException('NOW()');
                $user = User::model()->findByPk($this->poster_id);
                $this->last_reply_user = $user->name;
            }

            $this->last_reply_on = new CDbExpression('NOW()');
        }

        return true;
    }

    /**
     * Modifies a string to remove al non ASCII characters and spaces.
     */
    public static function slugify($topic_title)
    {
        // replace non letter or digits by -
        $topic_title = preg_replace('~[^\\pL\d]+~u', '-', trim($topic_title));

        // trim
        $topic_title = trim($topic_title, '-');

        // transliterate
        if (function_exists('iconv')) {
            $topic_title = iconv('utf-8', 'us-ascii//TRANSLIT', $topic_title);
        }

        // lowercase
        $topic_title = strtolower($topic_title);

        // remove unwanted characters
        $topic_title = preg_replace('~[^-\w]+~', '', $topic_title);

        if (empty($topic_title)) {
            return 'the-topic';
        }

        return $topic_title;
    }

    public static function getLatestTopics($limit = 10, $forum_id = false)
    {
        if ($forum_id === false) {
            return self::model()->
                with('poster')->
                findAll(array('order' => 't.last_reply_on DESC', 'limit' => intval($limit)));
        } else {
            return self::model()->
                with(array('poster' => array('condition' => 't.forum_id=' . intval($forum_id))))->
                findAll(array('order' => 't.last_reply_on DESC', 'limit' => intval($limit)));
        }
    }

    public function getSticky()
    {
        return $this->is_sticky == 1 ? true : false;
    }

    public function setSticky($value)
    {
        $this->is_sticky = ($value == true) ? 1 : 0;
    }

    public function getLocked()
    {
        return $this->is_locked == 1 ? true : false;
    }

    public function setLocked($value)
    {
        $this->is_locked = ($value == true) ? 1 : 0;
    }

    public function getActive()
    {
        return $this->is_active == 1 ? true : false;
    }

    public function setActive($value)
    {
        $this->is_active = ($value == true) ? 1 : 0;
    }

    public function getTopicsCountForUser($user_id)
    {
        return Yii::app()->db->createCommand()->
            select('COUNT(*)')->
            from('{{topics}}')->
            where('poster_id=:uid', array(':uid' => abs(intval($user_id))))->
            queryColumn();
    }
}