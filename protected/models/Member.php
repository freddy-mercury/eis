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
 * @property integer $security_question
 * @property string $security_answer
 * @property integer $security_question2
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
 * @property float $transaction_limit
 * @property float $daily_limit
 * @property float $total_limit
 * @property string $lang
 * @property integer $status
 * @property integer $date_registered
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
    public static function model($className = __CLASS__)
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

    public function init()
    {
        parent::init();
        $this->lang = 'ru';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        $security_question_ids = array_keys(SecurityQuestions::get());
        $country_ids = array_keys(Countries::get());
        $messages_config = include(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'messages'
            . DIRECTORY_SEPARATOR . 'config.php');
        $rules = array(
            array(
                'security_question, security_question2, login_notify, profile_notify, withdrawal_notify,'
                    . ' status, date_registered, monitor',
                'numerical',
                'integerOnly' => true),
            array(
                'transaction_limit, daily_limit, total_limit',
                'numerical'
            ),
            array(
                'login, password, email, security_answer, security_answer2, firstname, lastname, city, zip, '
                    . 'ecurrency_purse',
                'length',
                'max' => 255
            ),
            array(
                'lang',
                'in',
                'range' => $messages_config['languages'],
            ),
            array('verifyCode', 'captcha', 'allowEmpty' => true || !CCaptcha::checkRequirements()),
            //General
            array(
                'login',
                'match',
                'pattern' => '/\w{3,}/',
                'message' => Yii::t('member', 'Login must be at least 3 symbols!')
            ),
            array(
                'password',
                'match',
                'pattern' => '/\w{6,}/',
                'message' => Yii::t('member', 'Password must be at least 6 symbols!')
            ),
            array(
                'email',
                'email'
            ),
            array(
                'login, email',
                'unique'
            ),
            array(
                'login_pin',
                'match',
                'pattern' => '/\d{5}/',
                'message' => Yii::t('member', 'Login Pin must be of 5 digits.')
            ),
            array(
                'master_pin',
                'match',
                'pattern' => '/\d{3}/',
                'message' => Yii::t('member', 'Master Pin must be of 3 digits.')
            ),
            //Edit profile scenario
            array(
                'password, password_repeat, login_pin, master_pin, ecurrency_purse, lang, login_notify, '
                    . 'profile_notify, withdrawal_notify',
                'safe',
                'on' => 'profile'
            ),
            array(
                'ecurrency_purse, lang',
                'required',
                'on' => 'profile'
            ),
            array(
                'password',
                'compare',
                'allowEmpty' => true,
                'on' => 'profile',
            ),
            //Register scenario
            array(
                'login, password, password_repeat, login_pin, master_pin, email, security_question, '
                    . 'security_answer, security_question2, security_answer2, firstname, lastname, birthdate, '
                    . 'country, city, zip, address, ecurrency, ecurrency_purse, lang',
                'safe',
                'on' => 'register'
            ),
            array(
                'login, password, password_repeat, login_pin, master_pin, email, security_question, '
                    . 'security_answer, security_question2, security_answer2, firstname, lastname, birthdate, '
                    . 'country, city, zip, address, lang',
                'required',
                'on' => 'register'
            ),
            array(
                'password',
                'compare',
                'on' => 'register'
            ),
            array(
                'security_question, security_question2',
                'in',
                'range' => $security_question_ids,
                'message' => Yii::t('member', 'Invalid security question!'),
                'on' => 'register'
            ),
            array(
                'security_question2', 'compare',
                'compareAttribute' => 'security_question',
                'operator' => '!=',
                'message' => Yii::t('member', 'Must differ to "Security question"!'),
                'on' => 'register'
            ),
            array(
                'birthdate',
                'match',
                'pattern' => '/\d{4}-\d{2}-\d{2}/',
                'message' => Yii::t('member', 'Invalid date format!'),
                'on' => 'register'
            ),
            array(
                'country',
                'in',
                'range' => $country_ids,
                'on' => 'register'
            ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, login, password, login_pin, master_pin, email, security_question, security_answer, '
                . 'security_question2, security_answer2, firstname, lastname, birthdate, country, city, zip, address,'
                . 'ecurrency, ecurrency_purse, login_notify, profile_notify, withdrawal_notify, transaction_limit,'
                . 'daily_limit, total_limit, lang, status, date_registered, hash, monitor', 'safe', 'on' => 'search'),
        );

        /* If ecurrencies are enabled */
        if (Yii::app()->ecurrency->getComponentsNames()) {
            $rules[] = array(
                'ecurrency, ecurrency_purse',
                'required',
                'on' => 'register'
            );
            $rules[] = array(
                'ecurrency',
                'in',
                'range' => array_keys(Yii::app()->ecurrency->getComponentsNames()),
                'on' => 'register',
            );
        }
        return $rules;
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'messages' => array(self::HAS_MANY, 'Message', 'member_id'),
            'visits' => array(self::HAS_MANY, 'Visit', 'member_id'),
            'transactions' => array(self::HAS_MANY, 'Transaction', 'member_id', 'condition' => 'status > 0'),

            'balance' => array(self::STAT, 'Transaction', 'member_id',
                'select' => 'SUM(amount)',
                'condition' => 't.status > 0'
            ),
            'invested' => array(self::STAT, 'Transaction', 'member_id',
                'select' => 'ABS(SUM(amount))',
                'condition' => 't.type = "i" AND t.status > 0'
            ),
            'withdrawn' => array(self::STAT, 'Transaction', 'member_id',
                'select' => 'ABS(SUM(amount))',
                'condition' => 't.type = "w" AND t.status > 0'
            ),
            'earned' => array(self::STAT, 'Transaction', 'member_id',
                'select' => 'SUM(amount)',
                'condition' => 't.type = "e" AND t.status > 0'
            ),
            'deposited' => array(self::STAT, 'Transaction', 'member_id',
                'select' => 'SUM(amount)',
                'condition' => 't.type = "d" AND t.status > 0'
            ),
            'bonus' => array(self::STAT, 'Transaction', 'member_id',
                'select' => 'SUM(amount)',
                'condition' => 't.type = "b" AND t.status > 0'
            ),
            'penalty' => array(self::STAT, 'Transaction', 'member_id',
                'select' => 'ABS(SUM(amount))',
                'condition' => 't.type = "p" AND t.status > 0'
            ),
	        'mavro' => array(self::STAT, 'MavroTransaction', 'member_id',
		        'select' => 'ABS(SUM(amount))',
	            'condition' => 'status > 0'),
	        'mavro_frozen' => array(self::STAT, 'MavroSellRequest', 'member_id',
			    'select' => 'ABS(SUM(amount))',
			    'condition' => 'status = 0'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => Yii::t('member', 'ID'),
            'login' => Yii::t('member', 'Login'),
            'password' => Yii::t('member', 'Password'),
            'password_repeat' => Yii::t('member', 'Repeat password'),
            'login_pin' => Yii::t('member', 'Login Pin'),
            'master_pin' => Yii::t('member', 'Master Pin'),
            'email' => Yii::t('member', 'E-mail address'),
            'security_question' => Yii::t('member', 'Security question'),
            'security_answer' => Yii::t('member', 'Answer'),
            'security_question2' => Yii::t('member', 'Alternative security question'),
            'security_answer2' => Yii::t('member', 'Alternative question answer'),
            'firstname' => Yii::t('member', 'Firstname'),
            'lastname' => Yii::t('member', 'Lastname'),
            'birthdate' => Yii::t('member', 'Birthdate'),
            'country' => Yii::t('member', 'Country'),
            'city' => Yii::t('member', 'City'),
            'zip' => Yii::t('member', 'Zip'),
            'address' => Yii::t('member', 'Address'),
            'ecurrency' => Yii::t('member', 'E-currency'),
            'ecurrency_purse' => Yii::t('member', 'E-currency purse'),
            'login_notify' => Yii::t('member', 'Login Notify'),
            'profile_notify' => Yii::t('member', 'Profile Notify'),
            'withdrawal_notify' => Yii::t('member', 'Withdrawal Notify'),
            'transaction_limit' => Yii::t('member', 'Transaction Limit'),
            'daily_limit' => Yii::t('member', 'Daily Limit'),
            'total_limit' => Yii::t('member', 'Total Limit'),
            'lang' => Yii::t('member', 'Your language'),
            'status' => Yii::t('member', 'Status'),
            'date_registered' => Yii::t('member', 'Date Registered'),
            'hash' => Yii::t('member', 'Hash'),
            'monitor' => Yii::t('member', 'Monitor'),
            'verifyCode'=> Yii::t('global','Verification Code'),
        );
    }

    public function getIsAdmin()
    {
        return ($this->login == 'admin');
    }


    public function verifyPassword($password)
    {
        return ($this->hashPassword($password) === $this->password);
    }

    public function verifyLoginPin($login_pin)
    {
        return ($this->login_pin == $login_pin);
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

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('login', $this->login, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('login_pin', $this->login_pin, true);
        $criteria->compare('master_pin', $this->master_pin, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('security_question', $this->security_question, true);
        $criteria->compare('security_answer', $this->security_answer, true);
        $criteria->compare('security_question2', $this->security_question2, true);
        $criteria->compare('security_answer2', $this->security_answer2, true);
        $criteria->compare('firstname', $this->firstname, true);
        $criteria->compare('lastname', $this->lastname, true);
        $criteria->compare('birthdate', $this->birthdate, true);
        $criteria->compare('country', $this->country);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('zip', $this->zip, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('ecurrency', $this->ecurrency, true);
        $criteria->compare('ecurrency_purse', $this->ecurrency_purse, true);
        $criteria->compare('login_notify', $this->login_notify);
        $criteria->compare('profile_notify', $this->profile_notify);
        $criteria->compare('withdrawal_notify', $this->withdrawal_notify);
        $criteria->compare('transaction_limit', $this->transaction_limit);
        $criteria->compare('daily_limit', $this->daily_limit);
        $criteria->compare('total_limit', $this->total_limit);
        $criteria->compare('lang', $this->lang, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('date_registered', $this->date_registered);
        $criteria->compare('monitor', $this->monitor);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function stats()
    {
        $criteria = new CDbCriteria();
        $criteria->compare('member_id', $this->id);
        $criteria->addCondition('status > 0');
        $criteria->order = 'time DESC';
        return new CActiveDataProvider('Transaction', array('criteria' => $criteria));
    }

	public function mavro_stats()
	{
		$criteria = new CDbCriteria();
		$criteria->compare('member_id', $this->id);
		$criteria->addCondition('((type = "buy" AND status > 0) OR (type = "sell"))');
		$criteria->order = 'time DESC';
		return new CActiveDataProvider('MavroTransaction', array('criteria' => $criteria));
	}

	public function getMavroBalance() {
		return $this->mavro - $this->mavro_frozen;
	}
}
