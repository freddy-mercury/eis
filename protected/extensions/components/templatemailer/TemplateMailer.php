<?php
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'phpmailer'.DIRECTORY_SEPARATOR.'class.phpmailer.php');
/**
 * Templatemailer for emails mass sending with PHPMailer.
 * @author Evgeny Lexunin <lexunin@gmail.com>
 * @link http://www.yiiframework.com/
 * @since 1.0
 */
/*
 * Usage:
 		 $mailing_list=array(
			array(
				'email'=>array(Yii::app()->params['admin_email']),
				'template'=>'request_bill', // view file from: protected/views/email/request_bill.php
				'subject'=>'Bill request',
				'template_vars'=>array(
					'howmuch'=>$howmuch,
					),
			),
		);
		Yii::app()->templatemailer->massSend($mailing_list);
 */
class TemplateMailer {

	// Settings
	public $charset='UTF-8';
	public $from='';
	public $smtp_host='localhost';
	public $from_name='';
	public $reply_to='';

	// Layout. Default is 'main'.
	public $layout='main';

	// Outer Service settings
	public $service_sending=false;
	public $service_host='ssl://smtp.gmail.com';
	public $service_port=465;
	public $service_smtp_auth=true;
	public $service_username='';
	public $service_pass='';

	// Email subjects: array('template_name'=>'subject')
	public $subjects=array(
		'default'=>'Site email service',
	);
	
	public $themed_views=false;

	// Dump mode
	public $dump_mode;
	public $dump_file;

	/**
    * The path to the directory where the view for getView is stored. Must not
    * have ending dot.
    *
    * @var string
    */
   protected $path_views = 'application.views.email';

   /**
    * The path to the directory where the layout for getView is stored. Must
    * not have ending dot.
    *
    * @var string
    */
   protected $path_layouts = 'application.views.email.layouts';

	/**
	 * @var PHPMailer instance
	 */
	private $_mailer;
	
	public function init()
	{
		// Themed views
		if ($this->themed_views)
		{
			$path='webroot.themes.'.Yii::app()->theme->name.'.views';
			$this->path_views=str_replace('application.views', $path, $this->path_views);
			$this->path_layouts=str_replace('application.views', $path, $this->path_layouts);
		}
			
		//Default settings
		$this->_mailer->Host = $this->smtp_host;
		$this->_mailer->FromName = $this->from_name;
		$this->_mailer->From = $this->from;
		
		$this->_mailer->CharSet = $this->charset;
		$this->_mailer->IsSMTP(true);
		$this->_mailer->isHTML(true);
		$this->_mailer->AddReplyTo($this->reply_to);
		
		//Set service sending
		if ($this->service_sending) $this->set_service_use();
	}
	
	/**
	 * Construct
	 */
	public function __construct()
	{
		$this->_mailer=new PHPMailer;
	}

	/**
	 * Calling PHPMailer methods
	 * @param string $method
	 * @param array $params
	 * @return mixed 
	 */
	public function __call($method, $params)
	{
		if (is_object($this->_mailer) && get_class($this->_mailer)==='PHPMailer')
				return call_user_func_array(array($this->_mailer, $method), $params);
		else throw new CException(Yii::t('EMailer', 'Can not call a method of a non existent object'));
	}
	
	/**
	 * Setter
	 * @param string $name the property name
	 * @param string $value the property value
	 */
	public function __set($name, $value)
	{
	   if (is_object($this->_myMailer) && get_class($this->_myMailer)==='PHPMailer')
			$this->_myMailer->{$name} = $value;
	   else
		   throw new CException(Yii::t('EMailer', 'Can not set a property of a non existent object'));
	}

	/**
	 * Getter
	 * @param string $name
	 * @return string 
	 */
	public function __get($name)
	{
	   if (is_object($this->_myMailer) && get_class($this->_myMailer)==='PHPMailer')
			return $this->_myMailer->$name;
	   else
		   throw new CException(Yii::t('EMailer', 'Can not access a property of a non existent object'));
	}

	/**
	 * Sending emails to receivers
	 * @param array $recievers
	 * @param array $mailing_vars 
	 */
	public function massSend($recievers, $mailing_vars=array())
	{
		// Dump mode (testing)
		if ($this->dump_mode) {
			$log_file=fopen($this->dump_file, 'a');
			if (!$log_file) throw new CExeption('Unable to open file '.$this->dump_file);
		}
		
		// Sending emails
		foreach($recievers as $key=>$recvr) {
			
			$this->addAddresses($recvr['email']);
			$this->addDefaultVars($recvr['template_vars']);
			$this->_mailer->Subject=isset($recvr['subject']) ? $recvr['subject'] : $this->emailSubject($recvr['template']);
			$this->_mailer->Body=$this->emailBody($recvr['template'], CMap::mergeArray($recvr['template_vars'], $mailing_vars));
			
			//$mailer->isHTML(false);
			//$mailer->AltBody = 'Простая текстовая версия (не хтмл)';

			/* Присоединяем к письму файлы (если это разрешено в add_attachments)
			 * В обычном PHPmailer-5 есть баг на присоединением множества файлов
			 * см. здесь: http://sourceforge.net/projects/phpmailer/forums/forum/81620/topic/3176187
			 * касательно строки 1236 в class.phpmailer.php (в данном проекте исправлено)
			 */
			if (isset($recvr['add_attachments']) && ($recvr['add_attachments']) && (isset($mailing_vars['attachments']))) {
				foreach ($mailing_vars['attachments'] as $key=>$file) {
					$this->_mailer->AddAttachment($file['path'], $file['name']);
				}
			}



			if ($this->dump_mode) {			// Dump mode
				$data="*---------------------------------------------*\n";
				$data.='Mail sent to: '.print_r($recvr['email'], true)."\n";
				$data.="Body:\n".$this->_mailer->Body;
				$test=fwrite($log_file,$data);
				
				if (!$test) throw new CExeption('Unable to write file: '.$this->dump_file);
				unset($test);
			} else {						// Normal mode
				try {
				
					if (!($result=$this->_mailer->Send())) {
						Yii::log('Unable to send email through setuped settings. Trying to use sendmail.','error','system.TemplateMailer');
						//Если не получилось по обычному SMTP, то пробовать через SendMail
						$this->_mailer->IsSendmail();
						$result2=$this->_mailer->Send();
						
					}
				} catch (phpmailerException $e) {
					Yii::log('Unable to send email. Error: '.$e->errorMessage(),'error','system.TemplateMailer');
				}
			}
			$this->_mailer->ClearAddresses();
			$this->_mailer->ClearAttachments();
		}

		// Closing dump file
		if ($this->dump_mode && $log_file) fclose($log_file);

	}

	/**
	 * Sets using of outer email service
	 */
	protected function set_service_use()
	{
		$this->_mailer->Mailer = 'smtp';
		$this->_mailer->Host = $this->service_host;
		$this->_mailer->Port = $this->service_port;
		$this->_mailer->SMTPAuth = $this->service_smtp_auth;
		$this->_mailer->Username = $this->service_username;
		$this->_mailer->Password = $this->service_pass;
		$this->_mailer->IsSMTP(true);
	}

	/**
	 * Returns email subject
	 * @param string $template
	 * @return string
	 */
	protected function emailSubject($template)
	{
		return (isset($this->subjects[$template])) ? $this->subjects[$template] : $this->subjects['default'];
	}

	/**
	 * Rendering email view templates
	 * @param string $template
	 * @param array $vars
	 * @return string
	 */
	protected function emailBody($template,$vars)
	{
		$body=Yii::app()->controller->renderPartial($this->path_views.'.'.$template, $vars, true);
		$vars['content']=$body;
		
		if (!empty($this->layout)) return Yii::app()->controller->renderPartial($this->path_layouts.'.'.$this->layout, $vars, true);
		else return $body;
	}
	
	/**
	 * Emails for sending
	 * @param mixed $emails Array or string of emails
	 */
	private function addAddresses($emails)
	{
		if (is_array($emails)) {
			$emails=array_unique($emails);		// Remove duplicated emails
			foreach($emails as $email)
				if (!empty($email)) $this->_mailer->AddAddress($email);
		} else {
			$this->_mailer->AddAddress($emails);
		}
	}
	
	/**
	 * Adding default variables to template vars
	 * @param array $template_vars Call by reference
	 */
	private function addDefaultVars(&$template_vars)
	{
		$template_vars['site_full_url']=Yii::app()->request->hostInfo;
		$template_vars['site_name']=Yii::app()->name;
		$template_vars['site_link']=CHtml::link(Yii::app()->name,Yii::app()->controller->createAbsoluteUrl('/'));
	}
			

}