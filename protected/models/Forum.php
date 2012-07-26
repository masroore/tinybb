<?php

/**
 * This is the model class for table "tbb_forums".
 *
 * The followings are the available columns in table 'tbb_forums':
 * @property integer $id
 * @property integer $is_active
 * @property integer $sort_order
 * @property string $name
 * @property string $group_name
 * @property string $description
 * @property string $created_on
 * @property string $updated_at
 * @property string $redirect_url
 */
class Forum extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Forum the static model class
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
		return '{{forums}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, group_name', 'required'),
			array('is_active, sort_order', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>160),
			array('group_name, redirect_url', 'length', 'max'=>80),
			array('description, created_on, updated_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, is_active, sort_order, name, group_name, description, created_on, updated_at, redirect_url', 'safe', 'on'=>'search'),
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
			'is_active' => 'Is Active',
			'sort_order' => 'Sort Order',
			'name' => 'Name',
			'group_name' => 'Group Name',
			'description' => 'Description',
			'created_on' => 'Created On',
			'updated_at' => 'Updated At',
			'redirect_url' => 'Redirect Url',
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
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('group_name',$this->group_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('redirect_url',$this->redirect_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}