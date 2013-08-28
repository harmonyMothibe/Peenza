<?php

class Dealers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class


	 */
        public $dealer_statuses_id ;	
        public $cities_id ;	
        public $dealer_name	;
        public $trading_as ;	
        public $email_address;
        public $physical_address;
        public $cat_id;
        public $identification;
        public $profile_image	;
        public $password_2 ;
        public $description ;	
        public $active;
        public $retired;
        public $date_added;	
        public $last_updated;
        public $subscription_id;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_dealers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dealer_name, trading_as, email_address,physical_address, identification', 'required'),
			array('dealer_name, role,subscription_id, trading_as,cities_id,  email_address, cat_id', 'length', 'max'=>255),
			array('description', 'length', 'max'=>256),
                        array('profile_image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update,insert'),
			array('id, dealer_name, subscription_id, role, trading_as,  email_address, identification', 'safe', 'on'=>'search'),
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
                    
                    'dealersStats'=>array(self::STAT,'Products','dealers_id','condition'=>'active=1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dealer_name' => 'Dealer Name',
			'trading_as' => 'Trading as',
                        'dealer_statuses_id' => 'Dealer Status',	
                        'cities_id' => 'City',
                        'cat_id' => 'Category',
                        'dealer_name' => 'Dealer Name',
                        'trading_as' => 'Trading As',
                        'email_address' => 'Email Address',
                        'physical_address' => 'Physical Address',
                        'identification' => 'User Name',
                        'profile_image' => 'Profile Image',
                        'password_2' => 'Password',
                        'description' => 'Description',	
                        'active' => 'Active',
                        'role'=>'Role',
                        'retired' => 'Retired',
                        'date_added' => 'Date Added',	
                        'last_updated'=> 'Last Updated',
                        'subscription_id' => 'Subscription ID'
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
		$criteria->compare('dealer_statuses_id',$this->dealer_statuses_id,true);
		$criteria->compare('cities_id',$this->cities_id,true);
		$criteria->compare('dealer_name',$this->dealer_name,true);
		$criteria->compare('trading_as',$this->trading_as,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('physical_address',$this->physical_address,true);
		$criteria->compare('identification',$this->identification,true);
		$criteria->compare('profile_image',$this->profile_image,true);
                $criteria->compare('password_2',$this->password_2,true);
		$criteria->compare('active ',$this->active ,true);
		$criteria->compare('retired',$this->retired,true);
		$criteria->compare('date_added',$this->date_added,true);
                $criteria->compare('last_updated',$this->last_updated,true);
                $criteria->compare('subscription_id',$this->subscription_id,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function encrypt($value)
	{
		return md5($value);
	}
	
}