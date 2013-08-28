<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_posts_ads':
 * @property integer $id
 * @property string $post_first_name 	
 * @property string $post_second_name 	
 * @property string $email 	
 * @property string $cell 	
 * @property string $category 
 * @property string $location 
 * @property string $selling_servicce
 * @property string $description


 */
class Register extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
         //public $verifyCode;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name,username, last_name, email, tel, active, role, password', 'required'),
                        //array('first_name,username, last_name, email, tel, active, role, password', 'allowEmpty' => true,),
			array('first_name,name_of_principal_director_head_of_hr, location, grades_offered, years_offered, town_suburb_of_school_college_institution_company,describe_your_core_business, number_of_academic_lecturing_facilitation_staff_employed_on_an_a, number_of_learners_students_on_an_average_day, username, website_of_school_college_institution_company, phone_number_of_school_college_institution_company, name_of_school_college_institution_company, last_name, email , profile_picture', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id,username, first_name,active, second_name,location, tel,name_of_principal_director_head_of_hr, grades_offered, years_offered, number_of_learners_students_on_an_average_day,describe_your_core_business, number_of_academic_lecturing_facilitation_staff_employed_on_an_a, website_of_school_college_institution_company, phone_number_of_school_college_institution_company,town_suburb_of_school_college_institution_company, email, name_of_school_college_institution_company, cell, password', 'safe', 'on'=>'search'),
			array('profile_image', 'file', 'types'=>'jpg, gif, png', 'maxSize'=>1024 * 1024 * 5, 'allowEmpty' => true),
			array('profile_image', 'file', 'types'=>'jpg, gif', 'maxSize'=>1024 * 1024 * 5, 'allowEmpty' => true, 'on'=>'updateDealer'),
                        //array('verifyCode', 'captcha', 'on'=>'register'),
                        //array('verifyCode', 'captcha', 'on'=>'insert','allowEmpty'=>!CCaptcha::checkRequirements()),
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

			//'id'=>array(self::BELONGS_TO, 'Candidates', 'catid'),
			//'post_applied'=>array(self::BELONGS_TO, 'Jobapplicants', 'catid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'username' => 'username',
			'email' => 'Email',
			'tel' => 'Cell',
			'role' => 'Role',
			'profile_picture' => 'Profile Picture',
			'password'=>'Password',
		
		);
	}


	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('profile_picture',$this->profile_picture,true);
		$criteria->compare('active',$this->active,true);
                $criteria->compare('location',$this->location,true);
                $criteria->compare('grades_offered',$this->grades_offered,true);
                $criteria->compare('years_offered',$this->years_offered,true);
               
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}