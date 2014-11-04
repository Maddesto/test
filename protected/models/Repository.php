<?php
Yii::import('application.vendors.php-github-api-master.vendor.*');
require_once 'autoload.php';

class Repository
{
	/**
	 * user data fields
	 * @return array list of nessesary fields
	 */
	public static function fields()
	{
		return array(
				'id',
				'name',
				'description',
				'owner',
				'watchers_count',
				'forks_count',
				'open_issues',
				'homepage',
				'url',
				'created_at'
		);
	}
	
	/**
	 * 
	 * @param string $login user
	 * @param string $repo 
	 * @return return contributors data
	 */
	public static function getRepositoryContributors($login, $repo){
		$client = new \Github\Client();
		$contributors = $client->api('repo')->contributors($login, $repo);
		return $contributors;
	}
	
	/**
	 * 
	 * @param string $login
	 * @param string $repo
	 * @return return repository data
	 */
	public static function getRepositoryData($login, $repo){
		$client = new \Github\Client();
		$repository = $client->api('repo')->show($login, $repo);
		return Repository::selectData($repository);		
	}
	
	/**
	 * 
	 * @param string $repository
	 * @return array return only necessary information
	 */
	public static function selectData($repository){
		$repo = array();
		foreach(Repository::fields() as $field){
			if(array_key_exists ($field, $repository)){
				$repo[$field] = $repository[$field];
			}
		}
		return $repo;
	}
	/**
	 * 
	 * @param string $repository
	 * @param array $params
	 * @return return array list of repositories
	 */
	public static function findRepositories($repository, $params){
		$client = new \Github\Client();
		$repos = $client->api('repo')->find($repository, $params);
		$repos['items'] = Repository::createRepositoryListData($repos['items']);
		return $repos;
	}
	/**
	 * 
	 * @param array $data
	 * @return array of nessesary information
	 */
	public static function createRepositoryListData($data){
		$all_repos = array();
		foreach($data as $repo){
			$all_repos[] = Repository::selectData($repo);
		}
		return $all_repos;
	}
	
	/**
	 * 
	 * @param array $data
	 * @return array user's ids 
	 */
	public static function selectRepositoriesIds($data){
		$list= array();
		foreach($data as $repo){
			$list[] = $repo['id'];
		}
		return $list;
	}
}
