<?php

class AdminController extends SController
{
    protected $model_name;
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/column2';

    public function init()
    {
        $this->breadcrumbs = array(
            Yii::t('admin', 'Admin panel') => array('default/index')
        );

        $this->menu=array(
            array('label'=>Yii::t('admin', 'Members'), 'url'=>array('member/index')),
            array('label'=>Yii::t('admin', 'Plans'), 'url'=>array('plan/index')),
        );
    }


    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'users'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     * @return void
     */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return void
     */
    public function actionCreate()
    {
        $model= $this->newModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST[$this->model_name]))
        {
            $model->attributes=$_POST[$this->model_name];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    protected function newModel($scenario = '')
    {
        $model_name = $this->model_name;
        return new $model_name($scenario);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     * @return void
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        if(isset($_POST[$this->model_name]))
        {
            $model->attributes=$_POST[$this->model_name];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param int $id the ID of the model to be deleted
     * @throws CHttpException
     * @return void
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     * @return void
     */
    public function actionIndex()
    {
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     * @return void
     */
    public function actionAdmin()
    {
        $model=$this->newModel('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET[$this->model_name]))
            $model->attributes=$_GET[$this->model_name];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param $id
     * @throws CHttpException
     * @return array|\CActiveRecord|mixed|null
     * @internal param \the $integer ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model_name = $this->model_name;
        $model=$model_name::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

}