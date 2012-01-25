<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property integer $id
 * @property integer $access
 * @property string $login
 * @property string $password
 * @property string $login_pin
 * @property string $master_pin
 * @property string $email
 * @property string $security_question
 * @property string $security_answer
 * @property string $security_question2
 * @property string $security_answer2
 * @property string $firstname
 * @property string $lastname
 * @property string $birthdate
 * @property integer $country
 * @property string $city
 * @property string $zip
 * @property string $address
 * @property string $ecurrency
 * @property string $ecurrency_purse
 * @property string $referral
 * @property integer $alert_profile
 * @property integer $alert_login
 * @property integer $alert_withdrawal
 * @property integer $date_registered
 * @property string $hash
 */
class Member extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Member the static model class
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
		return 'members';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('access, country, alert_profile, alert_login, alert_withdrawal, date_registered', 'numerical', 'integerOnly'=>true),
			array('login, password, email, security_question, security_answer, security_question2, security_answer2, firstname, lastname, city, zip, ecurrency_purse, referral', 'length', 'max'=>255),
			array('login_pin, master_pin', 'length', 'max'=>10),
			array('ecurrency', 'length', 'max'=>2),
			array('hash', 'length', 'max'=>32),
			array('birthdate, address', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, access, login, password, login_pin, master_pin, email, security_question, security_answer, security_question2, security_answer2, firstname, lastname, birthdate, country, city, zip, address, ecurrency, ecurrency_purse, referral, alert_profile, alert_login, alert_withdrawal, date_registered, hash', 'safe', 'on'=>'search'),
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
			'access' => 'Access',
			'login' => 'Login',
			'password' => 'Password',
			'login_pin' => 'Login Pin',
			'master_pin' => 'Master Pin',
			'email' => 'Email',
			'security_question' => 'Security Question',
			'security_answer' => 'Security Answer',
			'security_question2' => 'Security Question2',
			'security_answer2' => 'Security Answer2',
			'firstname' => 'Firstname',
			'lastname' => 'Lastname',
			'birthdate' => 'Birthdate',
			'country' => 'Country',
			'city' => 'City',
			'zip' => 'Zip',
			'address' => 'Address',
			'ecurrency' => 'Ecurrency',
			'ecurrency_purse' => 'Ecurrency Purse',
			'referral' => 'Referral',
			'alert_profile' => 'Alert Profile',
			'alert_login' => 'Alert Login',
			'alert_withdrawal' => 'Alert Withdrawal',
			'date_registered' => 'Date Registered',
			'hash' => 'Hash',
		);
	}
	
	public function getIsAdmin()
	{
		return true;
	}
	
		
	public function verifyPassword($password)
	{
		return ($this->hashPassword($password)===$this->password);
	}
	
	private function hashPassword($password)
	{
		return $password;
//		return md5($password.$password.Yii::app()->params['member_password_salt']);
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
		$criteria->compare('access',$this->access);
		$criteria->compare('login',$this->login,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('login_pin',$this->login_pin,true);
		$criteria->compare('master_pin',$this->master_pin,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('security_question',$this->security_question,true);
		$criteria->compare('security_answer',$this->security_answer,true);
		$criteria->compare('security_question2',$this->security_question2,true);
		$criteria->compare('security_answer2',$this->security_answer2,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('birthdate',$this->birthdate,true);
		$criteria->compare('country',$this->country);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('ecurrency',$this->ecurrency,true);
		$criteria->compare('ecurrency_purse',$this->ecurrency_purse,true);
		$criteria->compare('referral',$this->referral,true);
		$criteria->compare('alert_profile',$this->alert_profile);
		$criteria->compare('alert_login',$this->alert_login);
		$criteria->compare('alert_withdrawal',$this->alert_withdrawal);
		$criteria->compare('date_registered',$this->date_registered);
		$criteria->compare('hash',$this->hash,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}