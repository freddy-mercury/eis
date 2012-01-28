<?php

/**
 * This is the model class for table "members".
 *
 * The followings are the available columns in table 'members':
 * @property integer $id
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
 * @property integer $login_notify
 * @property integer $profile_notify
 * @property integer $withdrawal_notify
 * @property double $transaction_limit
 * @property double $daily_limit
 * @property double $total_limit
 * @property string $lang
 * @property integer $status
 * @property integer $date_registered
 * @property string $hash
 * @property integer $monitor
 */
class Member extends CActiveRecord
{
	public $password_repeat, $verifyCode;

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
			array('country, login_notify, profile_notify, withdrawal_notify, status, date_registered, monitor',
				'numerical', 'integerOnly'=>true),
			array('transaction_limit, daily_limit, total_limit', 'numerical'),
			array('login', 'length', 'max'=>50),
			array('password, security_question, security_answer, security_question2, security_answer2, firstname, '
				.'lastname, city, zip, ecurrency_purse', 'length', 'max'=>255),
			array('login_pin, master_pin', 'length', 'max'=>10),
			array('email', 'length', 'max'=>150),
			array('ecurrency, lang', 'length', 'max'=>2),
			array('hash', 'length', 'max'=>32),
			array('birthdate, address', 'safe'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
			//Register scenario
			array('login, password, password_repeat, login_pin, master_pin, email, security_question, '
				.'security_answer, security_question2, security_answer2, firstname, lastname, birthdate, '
				.'country, city, zip, address, ecurrency, ecurrency_purse, lang', 'safe', 'on'=>'register'),
			array('login, password, password_repeat, login_pin, master_pin, email, security_question, '
				.'security_answer, security_question2, security_answer2, firstname, lastname, birthdate, '
				.'country, city, zip, address, ecurrency, ecurrency_purse, lang', 'required', 'on'=>'register'),
			array('password', 'compare'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, login, password, login_pin, master_pin, email, security_question, security_answer, '
				.'security_question2, security_answer2, firstname, lastname, birthdate, country, city, zip, address,'
				.'ecurrency, ecurrency_purse, login_notify, profile_notify, withdrawal_notify, transaction_limit,'
				.'daily_limit, total_limit, lang, status, date_registered, hash, monitor', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('global', 'ID'),
			'login' => Yii::t('global', 'Login'),
			'password' => Yii::t('global', 'Password'),
			'password_repeat' => Yii::t('global', 'Repeat password'),
			'login_pin' => Yii::t('global', 'Login Pin'),
			'master_pin' => Yii::t('global', 'Master Pin'),
			'email' => Yii::t('global', 'E-mail address'),
			'security_question' => Yii::t('global', 'Security question'),
			'security_answer' => Yii::t('global', 'Answer'),
			'security_question2' => Yii::t('global', 'Alternative security question'),
			'security_answer2' => Yii::t('global', 'Alternative question answer'),
			'firstname' => Yii::t('global', 'Firstname'),
			'lastname' => Yii::t('global', 'Lastname'),
			'birthdate' => Yii::t('global', 'Birthdate'),
			'country' => Yii::t('global', 'Country'),
			'city' => Yii::t('global', 'City'),
			'zip' => Yii::t('global', 'Zip'),
			'address' => Yii::t('global', 'Address'),
			'ecurrency' => Yii::t('global', 'E-currency'),
			'ecurrency_purse' => Yii::t('global', 'E-currency purse'),
			'login_notify' => Yii::t('global', 'Login Notify'),
			'profile_notify' => Yii::t('global', 'Profile Notify'),
			'withdrawal_notify' => Yii::t('global', 'Withdrawal Notify'),
			'transaction_limit' => Yii::t('global', 'Transaction Limit'),
			'daily_limit' => Yii::t('global', 'Daily Limit'),
			'total_limit' => Yii::t('global', 'Total Limit'),
			'lang' => Yii::t('global', 'Lang'),
			'status' => Yii::t('global', 'Status'),
			'date_registered' => Yii::t('global', 'Date Registered'),
			'hash' => Yii::t('global', 'Hash'),
			'monitor' => Yii::t('global', 'Monitor'),
		);
	}

	public function getIsAdmin()
	{
		return true;
	}


	public function verifyPassword($password)
	{
		return ($this->hashPassword($password) === $this->password);
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
		$criteria->compare('login_notify',$this->login_notify);
		$criteria->compare('profile_notify',$this->profile_notify);
		$criteria->compare('withdrawal_notify',$this->withdrawal_notify);
		$criteria->compare('transaction_limit',$this->transaction_limit);
		$criteria->compare('daily_limit',$this->daily_limit);
		$criteria->compare('total_limit',$this->total_limit);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('date_registered',$this->date_registered);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('monitor',$this->monitor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}