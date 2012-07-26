<?php
/*
 * $Id:$
 */

/**
 * This is the model class for table "tbb_users".
 *
 * The followings are the available columns in table 'tbb_users':
 * @property integer $id
 * @property string $username
 * @property string $display_name
 * @property string $password_hash
 * @property string $password_salt
 * @property string $email
 * @property string $website
 * @property integer $is_admin
 * @property integer $is_active
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_login_at
 * @property string $registration_ip
 * @property string $facebook
 * @property string $twitter
 * @property string $skype
 * @property string $msn
 * @property string $yahoo
 * @property string $location
 * @property string $signature
 * @property integer $show_signature
 */
class User extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
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
        return '{{users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, display_name, email', 'required'),
            array('registration_ip', 'numerical', 'integerOnly' => true),
            array('is_admin, is_active, show_signature', 'boolean'),
            array('skype, msn, yahoo, location', 'length', 'max' => 32),
            array('password_hash', 'length', 'max' => 60),
            array('username', 'length', 'min' => 4, 'max' => 32),
            array('display_name', 'length', 'min' => 4, 'max' => 48),
            array('email', 'email'),
            array('username, email', 'unique'),
            array('password_salt', 'length', 'max' => 21),
            array('website, facebook, twitter', 'length', 'max' => 80),
            array('website', 'url'),
            array('signature', 'length', 'max' => 200),
            array('created_at, updated_at, last_login_at, password_salt, password_hash', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, username, display_name, email, website, is_admin, is_active, created_at, last_login_at, registration_ip, facebook, twitter, skype, msn, yahoo, location', 'safe', 'on' => 'search'),
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
            'topics' => array(self::HAS_MANY, 'Topic', 'poster_id', 'order' => 'created_at DESC', 'limit' => 10),
            'posts' => array(self::HAS_MANY, 'Post', 'poster_id', 'order' => 'created_at DESC', 'limit' => 10),
            'topicsCount' => array(self::STAT, 'Topic', 'poster_id'),
            'postsCount' => array(self::STAT, 'Post', 'poster_id'),
        );
    }

    /**
     * @return array relational scopes.
     */
    public function scopes()
    {
        return array(
            'activeUser' => array('condition' => 'is_active=1', 'limit' => 1),
            'activeSortedUsers' => array('condition' => 'is_active=1', 'order' => 'display_name'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'display_name' => 'Display Name',
            'password_hash' => 'Password Hash',
            'password_salt' => 'Password Salt',
            'email' => 'Email',
            'website' => 'Website',
            'is_admin' => 'Is Adminstrator',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_login_at' => 'Last Login At',
            'registration_ip' => 'Registration Ip',
            'facebook' => 'Facebook',
            'twitter' => 'Twitter',
            'skype' => 'Skype',
            'msn' => 'Msn',
            'yahoo' => 'Yahoo',
            'location' => 'Location',
            'signature' => 'Signature',
            'show_signature' => 'Show Signature',
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('display_name', $this->display_name, true);
        //$criteria->compare('password_hash', $this->password_hash, true);
        //$criteria->compare('password_salt', $this->password_salt, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('website', $this->website, true);
        $criteria->compare('is_admin', $this->is_admin);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('created_at', $this->created_at, true);
        //$criteria->compare('updated_at', $this->updated_at, true);
        $criteria->compare('last_login_at', $this->last_login_at, true);
        $criteria->compare('registration_ip', $this->registration_ip, true);
        $criteria->compare('facebook', $this->facebook, true);
        $criteria->compare('twitter', $this->twitter, true);
        $criteria->compare('skype', $this->skype, true);
        $criteria->compare('msn', $this->msn, true);
        $criteria->compare('yahoo', $this->yahoo, true);
        $criteria->compare('location', $this->location, true);
        //$criteria->compare('signature', $this->signature, true);
        //$criteria->compare('show_signature', $this->show_signature);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    private static function _getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) //if from shared
        {
            return $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) //if from a proxy
        {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    // Set the date fields to default values
    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->created_at = new CDbExpression('NOW()');
                $this->last_login_at = new CDbExpression('NOW()');
                $this->updated_at = new CDbExpression('NOW()');
                $this->registration_ip = ip2long(self::_getUserIpAddr());
            }
        }
    }

    // perform one-way hashing on the password before we store it in the database
    protected function afterValidate()
    {
        parent::afterValidate();
        $this->password_salt = self::_generateSalt();
        $this->password_hash = md5($this->password_hash . $this->password_salt);
    }

    private static function _generateSalt()
    {
        $salt = substr(str_replace('+', '.', base64_encode(sha1(microtime(true), true))), 0, 22);
        return $salt;
    }

    public function getName()
    {
        if (!empty($this->display_name)) {
            return $this->display_name;
        } else {
            return $this->username;
        }
    }

    public function getPostsCountText()
    {
        if ($this->postsCount == 1) {
            return "1 post";
        }

        return $this->postsCount . " posts";
    }

    public function getTopicsCountText()
    {
        if ($this->topicsCount == 1) {
            return "1 topic";
        }

        return $this->topicsCount . " topics";
    }

    public function validatePassword($password)
    {
        return self::_hashPassword($password, $this->password_salt) == $this->password_hash;
    }

    private static function _hashPassword($password, $salt)
    {
        return md5($salt . $password);
    }
}