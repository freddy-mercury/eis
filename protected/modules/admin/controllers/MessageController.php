<?php

class MessageController extends AdminController
{
	protected $model_name = 'Message';

    public function newModel($scenario = '')
    {
        $model  = parent::newModel($scenario);
        $model->setAttributes(
            array(
                'stamp' => time(),
                'is_read' => 0,
            )
        );
        return $model;
    }


}
