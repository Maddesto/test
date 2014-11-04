<?php

/**
 * This is the model class for table "project_attitides".
 *
 * The followings are the available columns in table 'project_attitides':
 * @property string $id
 * @property integer $project_id
 * @property integer $attitide
 */
class RepoLikes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'repo_likes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip', 'required'),
			array('repo_id, id', 'numerical', 'integerOnly'=>true),
			array('ip', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ip, repo_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ip' => 'ID',
			'repo_id' => 'Repo'
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ProjectAttitides the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
