<?php
class SWebUser extends CWebUser
{
	/**
	 *
	 * @var Member
	 */
	private $_model;
	
	public function login($identity, $duration = 0) {
		
		$this->_model=$identity->model;
		$this->refreshLastLogin();
		
		parent::login($identity, $duration);
	}
	
	private function loadModel()
	{
		if ($this->_model===null && ($this->id!==null))
			$this->_model=Member::model()->findByPk($this->id);
	}
	
	public function getModel()
	{
		$this->loadModel();
		return $this->_model;
	}
	
	/**
	 * Admin check
	 * @return boolean
	 */
	public function getIsAdmin()
	{
		$this->loadModel();
		return  (($this->_model!==null) && $this->_model->isAdmin);
	}
	
	/**
	 * Refreshes last_login field
	 */
	private function refreshLastLogin()
	{
		/*
		$this->_model->last_login=new CDbExpression('NOW()');
		$this->_model->password=null;
		$this->_model->disableBehavior('CTimestampBehavior');
		$this->_model->save(false);
		$this->_model->enableBehavior('CTimestampBehavior');
		*/
	}
}