<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $login_pin;
	public $rememberMe;
    public $verifyCode;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password, login_pin', 'required'),
			array('login_pin', 'length', 'max'=>5),
			array('login_pin', 'numerical', 'integerOnly'=>true),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>Yii::t('login', 'Remember me next time'),
			'username'=>Yii::t('login', 'Username'),
			'password'=>Yii::t('login', 'Password'),
			'login_pin'=>Yii::t('login', 'Login pin'),
            'verifyCode'=> Yii::t('global','Verification Code'),
		);
	}

    public function validate($attributes = null, $clearErrors = true)
    {
        $captcha_validator = new CCaptchaValidator();
        $captcha_validator->attributes = array('verifyCode');
        $captcha_validator->validate($this);
        if ($this->hasErrors()) {
            return false;
        }
        return parent::validate($attributes, $clearErrors);
    }


    /**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new SUserIdentity($this->username,$this->password,$this->login_pin);
			if(!$this->_identity->authenticate())
				$this->addError('login_pin',Yii::t('login','Incorrect username, password or login pin.'));
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new SUserIdentity($this->username,$this->password,$this->login_pin);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===SUserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
