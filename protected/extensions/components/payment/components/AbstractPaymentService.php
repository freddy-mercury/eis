<?php
interface IPaymentService
{
	public function withdraw();
	
}
abstract class AbstractPaymentService extends CApplicationComponent implements IPaymentService
{
	/**
	 * Contains parameter wich was set in /config/main.php.
	 * Will be available in exact payment service.
	 * @var string
	 */
	public $secret_key;
	
	public $name;
}