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
	public static function model($className=__CLASS__)
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
			array('sender_id, receiver_id, is_read', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>255),
			array('sent_at, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sender_id, receiver_id, is_read, sent_at, updated_at, subject, message', 'safe', 'on'=>'search'),
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
			'is_read' => 'Is Read',
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('sender_id',$this->sender_id);
		$criteria->compare('receiver_id',$this->receiver_id);
		$criteria->compare('is_read',$this->is_read);
		$criteria->compare('sent_at',$this->sent_at,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}