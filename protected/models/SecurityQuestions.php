<?php

class SecurityQuestions 
{
	public static function get() {
		return array(
			'1' => Yii::t('security_questions', 'Mother\'s Maiden Name'),
			'2' => Yii::t('security_questions', 'City of Birth'),
			'3' => Yii::t('security_questions', 'Highschool Name'),
			'4' => Yii::t('security_questions', 'Name of Your First Love'),
			'5' => Yii::t('security_questions', 'Favorite Pet'),
			'6' => Yii::t('security_questions', 'Favorite Book'),
			'7' => Yii::t('security_questions', 'Favorite TV Show/Sitcom'),
			'8' => Yii::t('security_questions', 'Favorite Movie'),
			'9' => Yii::t('security_questions', 'Favorite Flower'),
			'10' => Yii::t('security_questions', 'Favorite Color'),
		);
	}
}