<?php

class MessagesController extends MemberController
{
	/**
	 * @param $id
	 * @return Message|null
	 */
	private function loadModel($id)
	{
		return Message::model()->findByPk($id);
	}

	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		if ($model !== null) {
			$model->delete();
		}
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);
		$model->is_read = true;
		$model->save();
		$this->render('view', array('model' => $model));
	}

	public function actionIndex()
	{
		$criteria = new CDbCriteria();
		$criteria
			->compare('member_id', Yii::app()->user->id)
			->order = 'stamp DESC';
		$messages_data_provider = new CActiveDataProvider('Message');
		$messages_data_provider->setCriteria($criteria);
		$this->render('index', array('messages_data_provider' => $messages_data_provider));
	}
}
