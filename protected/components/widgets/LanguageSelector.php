<?php
class LanguageSelector extends CWidget
{
    public function run()
    {
        $currentLang = Yii::app()->language;
        $messages_config = include(Yii::app()->basePath . DIRECTORY_SEPARATOR . 'messages'
            . DIRECTORY_SEPARATOR . 'config.php');
        $languages = $messages_config['languages'];
        $this->render('language_selector', array('currentLang' => $currentLang, 'languages'=>$languages));
    }
}