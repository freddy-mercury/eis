<?php
class SUserIdentity extends CUserIdentity
{
	const ERROR_LOGIN_PIN_INVALID=5;
	
	private $_id;
	private $_model;
	public $login_pin;
	
	public function __construct($username,$password,$login_pin)
	{
		$this->username=$username;
		$this->password=$password;
		$this->login_pin=$login_pin;
	}
	
	public function authenticate() {
	
		$user=Member::model()->findByAttributes(array('login'=>$this->username));
		
		if ($user===null)													// User exists?
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif (!$user->verifyPassword($this->password))					// Correct password?
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		elseif (!$user->verifyLoginPin($this->login_pin))					// Correct login_pin?
			$this->errorCode=self::ERROR_LOGIN_PIN_INVALID;
		else
		{
			$this->_id=$user->id;
			$this->_model=$user;
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function getModel()
	{
		return $this->_model;
	}
}