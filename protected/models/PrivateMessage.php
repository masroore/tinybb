<?php

/**
 * This is the model class for table "tbb_private_messages".
 *
 * The followings are the available columns in table 'tbb_private_messages':
 * @property integer $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property integer $is_read
 * @property string $sent_at
 * @property string $updated_at
 * @property string $subject
 * @property string $message
 */
class PrivateMessage extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return PrivateMessage the static model class
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
        return '{{private_messages}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('subject, message', 'required'),
            array('sender_id, receiver_id', 'numerical', 'integerOnly' => true),
            array('is_read', 'boolean'),
            array('subject', 'length', 'max' => 255),
            array('sent_at, updated_at', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sender_id, receiver_id, is_read, sent_at, updated_at, subject', 'safe', 'on' => 'search'),
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
            'sender' => array(self::BELONGS_TO, 'User', 'sender_id'),
            'receiver' => array(self::BELONGS_TO, 'User', 'receiver_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'sender_id' => 'Sender',
            'receiver_id' => 'Receiver',
            'is_read' => 'Is Read?',
            'sent_at' => 'Sent At',
            'updated_at' => 'Updated At',
            'subject' => 'Subject',
            'message' => 'Message',
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
        $criteria->compare('sender_id', $this->sender_id);
        $criteria->compare('receiver_id', $this->receiver_id);
        $criteria->compare('is_read', $this->is_read);
        $criteria->compare('sent_at', $this->sent_at, true);
        $criteria->compare('updated_at', $this->updated_at, true);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('message', $this->message, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->sent_at = new CDbExpression('NOW()');
                $this->is_read = false;
            }
        }
        $this->updated_at = new CDbExpression('NOW()');
    }

    private static function _fetchMessages($rcvd_only, $user_id, $limit)
    {
        $user_id = abs(intval($user_id));
        $limit = abs(intval($limit));

        return self::model()->
            with( $rcvd_only ? 'receiver' : 'sender')->
            findAll(
                array(
                'condition' => $rcvd_only ? 't.receiver_id=' : 't.sender_id=' . $user_id,
                'order' => 't.sent_at DESC',
                'limit' => $limit));
    }

    // returns a list of private messages received by the user
    public static function fetchReceivedMessages($user_id, $limit = 10)
    {
        return self::_fetchMessages(true, $user_id, $limit);
    }

    // returns a list of private messages sent by the user
    public static function fetchSentMessages($user_id, $limit = 10)
    {
        return self::_fetchMessages(false, $user_id, $limit);
    }
}