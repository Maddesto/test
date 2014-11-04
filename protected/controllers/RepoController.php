<?php

use SebastianBergmann\Exporter\Exception;
class RepoController extends Controller
{
	
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
						'actions'=>array('index','view', 'search'),
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
	 * 
	 * @param string $login
	 * @param string $repo
	 */
	public function actionView($login = null, $repo = null)
	{
		if(!$login) $login = 'yiisoft';
		if(!$repo) $repo = 'yii';
		try{	
			$repository_info = Repository::getRepositoryData($login, $repo);
			$contributors = Repository::getRepositoryContributors($login, $repo);
			$likes = UserLikes::model()->findAllByAttributes(array('ip'=>Yii::app()->request->getUserHostAddress(), 'repo_id' =>$repository_info['id']));
		}catch(Exception $e){
			
		}
		$this->render('view', array(
							'repo' =>$repository_info,
							'contributors'=>$contributors,
							'likes' => array_keys(CHtml::ListData($likes, 'user_id', 'repo_id'))
		));
	}
	/**
	 * 
	 */
	public function actionSearch(){
		$repository = Yii::app()->getRequest()->getParam('repository');
		$number_page = Yii::app()->getRequest()->getParam('name_page');
		$repoInfo = array();
		$number_page = $number_page? $number_page: 1; 
		$params = array('per_page'=>10, 'page'=> $number_page);
		try{
			if($repository){
				$repoInfo = Repository::findRepositories($repository, $params);
			}
			$likes = RepoLikes::model()->findAllByAttributes(array('ip'=>Yii::app()->request->getUserHostAddress(), 'repo_id' =>Repository::selectRepositoriesIds($repoInfo['items'])));
		}catch(Exception $e){
			
		}
		$dataProvider = new CArrayDataProvider($repoInfo['items'], array(
			'id' => 'name',
			'totalItemCount' => $repoInfo['total_count'],
			'data' => $repoInfo['items'],		
			'pagination'=>array(
				'itemCount' => $repoInfo['total_count'],
				'pageSize' => 10,
				'params'=> array('repository'=>$repository)
			),		
		));
		$this->render('index', array(
				'repository'=>$repository,
				'dataProvider' =>$dataProvider,
				'likes' => array_keys(CHtml::ListData($likes, 'repo_id', 'ip'))
		));
	}
}