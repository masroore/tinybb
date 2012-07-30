<?php

/**
 * This is the model class for table "tbb_posts".
 *
 * The followings are the available columns in table 'tbb_posts':
 * @property integer $id
 * @property string $body
 * @property string $created_at
 * @property string $updated_at
 * @property integer $topic_id
 * @property integer $forum_id
 * @property integer $poster_id
 * @property string $poster_ip
 * @property integer $is_edited
 * @property integer $edited_by
 */
class Post extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
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
        return '{{posts}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('topic_id, forum_id, poster_id, body', 'required'),
            array('topic_id, forum_id, poster_id, edited_by, poster_ip', 'numerical', 'integerOnly' => true),
            array('is_edited', 'boolean'),
            array('created_at, updated_at, poster_ip', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, created_at, topic_id, forum_id, poster_id, poster_ip', 'safe', 'on' => 'search'),
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
            'topic' => array(self::BELONGS_TO, 'Topic', 'topic_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'body' => 'Body',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'topic_id' => 'Topic',
            'forum_id' => 'Forum',
            'poster_id' => 'Poster',
            'poster_ip' => 'Poster Ip',
            'is_edited' => 'Is Edited',
            'edited_by' => 'Edited By',
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
        $criteria->compare('body', $this->body, true);
        $criteria->compare('created_at', $this->created_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);
        $criteria->compare('topic_id', $this->topic_id);
        $criteria->compare('forum_id', $this->forum_id);
        $criteria->compare('poster_id', $this->poster_id);
        $criteria->compare('poster_ip', $this->poster_ip, true);
        $criteria->compare('is_edited', $this->is_edited);
        $criteria->compare('edited_by', $this->edited_by);

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
    }
}