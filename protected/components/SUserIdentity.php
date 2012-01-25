<?php
class SUserIdentity extends CUserIdentity
{
	private $_id;
	private $_model;
	
	public function authenticate() {
	
		$user=Member::model()->findByAttributes(array('login'=>$this->username));
		
		if ($user===null)													// User exists?
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif (!$user->verifyPassword($this->password))					// Correct password?
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
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