<?php
Yii::import('application.vendors.php-github-api-master.vendor.*');
require_once 'autoload.php';

class User
{
	/**
	 * user data fields
	 * @return array list of nessesary fields
	 */

	public static function fields()
	{
		return array(
				'id',
				'login',
				'company',
				'blog',
				'followers',
				'name',
				'avatar_url'
		);
	}
	
	/**
	 * 
	 * @param string $login
	 * @return retun array user information
	 */
	public static function createRepositoryData($login){
		$client = new \Github\Client();
		$user = $client->api('user')->show($login);
		return User::selectData($user);		
	}
	
	/**
	 *
	 * @param string $repository
	 * @return return array only necessary information
	 */
	public static function selectData($data){
		$repo = array();
		foreach(User::fields() as $field){
			if(array_key_exists ($field, $data)){
				$repo[$field] = $data[$field];
			}
		}
		return $repo;
	}
	/**
	 * 
	 * @param array $data
	 * @return array of nessesary information
	 */
	public static function createRepositoryListData($data){
		$all_repos = array();
		foreach($data as $repo){
			$all_repos[] = Repository::createRepositoryData($repo);
		}
		return $all_repos;
	}
	/**
	 * 
	 * @param array $data
	 * @return array of user's ids
	 */
	public static function selectRepositoriesIds($data){
		$list= array();
		foreach($data as $repo){
			$list[] = $repo['id'];
		}
		return $list;
	}
}
