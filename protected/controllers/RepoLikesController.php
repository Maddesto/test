<?php

class RepoLikesController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */

	/**
	 * @return array action filters
	 */
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'like', 'unlike'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
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
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ProjectAttitides the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ProjectAttitides::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * add like
	 * @return json data, like added true/false
	 */
	public function actionLike(){
		$result = false;
		if(Yii::app()->request->isPostRequest){
			$repo_id = Yii::app()->request->getPost('id');
			$ip = Yii::app()->request->getUserHostAddress();
			$like = RepoLikes::model()->findByAttributes(array('ip'=>$ip, 'repo_id'=>$repo_id));
			if(!$like){
				$logobj = new RepoLikes();
				$logobj->ip = $ip;
				$logobj->repo_id = $repo_id;
				if($logobj->insert()){
					$result = true;
				}
			}
		}
		$this->returnJson(array('result'=>$result));
	}
	
	/**
	 * delete like
	 * @return json data, like added true/false
	 */
	public function actionUnlike(){
		$result = false;
		if(Yii::app()->request->isPostRequest){
			$repo_id = Yii::app()->request->getPost('id');
			$like = RepoLikes::model()->findByAttributes(array('ip'=>Yii::app()->request->getUserHostAddress(), 'repo_id'=>$repo_id));
			if($like->delete()){
				$result = true;
			}
		}
		$this->returnJson(array('result'=>$result));   
	}
	
}
