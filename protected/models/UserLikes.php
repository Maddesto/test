<?php

/**
 * This is the model class for table "user_attitudes".
 *
 * The followings are the available columns in table 'user_attitudes':
 * @property string $id
 * @property integer $user_id
 * @property integer $attitude
 */
class UserLikes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_likes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip, repo_id, user_id', 'required'),
			array('user_id, repo_id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, repo_id, user_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'repo_url' => 'Repo url'	
		);
	}


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserAttitudes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
