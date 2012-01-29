<?php
class PayPalPaymentService extends AbstractPaymentService
{
	public function init()
	{
	}
	
	public function withdraw() {
		echo 'Some withdraw action. Secretkey is: '.$this->secret_key;
	}
	
}