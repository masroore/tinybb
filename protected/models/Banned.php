<?php

/**
 * This is the model class for table "tbb_banned".
 *
 * The followings are the available columns in table 'tbb_banned':
 * @property integer $id
 * @property integer $banned_user
 * @property integer $ban_creator
 * @property string $expires_at
 * @property string $message
 */
class Banned extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banned the static model class
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
		return '{{banned}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, banned_user', 'required'),
			array('id, banned_user, ban_creator', 'numerical', 'integerOnly'=>true),
			array('expires_at, message', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, banned_user, ban_creator, expires_at, message', 'safe', 'on'=>'search'),
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
			'banned_user' => 'Banned User',
			'ban_creator' => 'Ban Creator',
			'expires_at' => 'Expires At',
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
		$criteria->compare('banned_user',$this->banned_user);
		$criteria->compare('ban_creator',$this->ban_creator);
		$criteria->compare('expires_at',$this->expires_at,true);
		$criteria->compare('message',$this->message,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}