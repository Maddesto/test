<?php

class UserLikesController extends Controller
{
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserAttitudes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserAttitudes::model()->findByPk($id);
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
			$user_id = Yii::app()->request->getPost('id');
			$repo_id = Yii::app()->request->getPost('repo');
			$ip = CHttpRequest::getUserHostAddress();
			$like = UserLikes::model()->findByAttributes(array('ip'=>$ip, 'user_id'=>$user_id, 'repo_id'=>$repo_id));
			if(!$like){
				$logobj = new UserLikes();
				$logobj->ip = $ip;
				$logobj->user_id = $user_id;
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
	 * @return json data, like deleted true/false
	 */
	public function actionUnlike(){
		$result = false;
		if(Yii::app()->request->isPostRequest){
			$id = Yii::app()->request->getPost('id');
			$repo_id = Yii::app()->request->getPost('repo');
			$like = UserLikes::model()->findByAttributes(array('ip'=>CHttpRequest::getUserHostAddress(), 'user_id'=>$id, 'repo_id' =>$repo_id));
			if($like->delete()){
				$result = true;
			}
		}
		$this->returnJson(array('result'=>$result));
	}
}
