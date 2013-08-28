<?php

class Sales extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class


	 */
        public $sales_statuses_id ;	
        public $users_id ;
        public $dealer_name;
        public $item_description1;
        public $item_description2;
        public $item_description3;
        public $year_of_manufacture;
        public $products_id;
        public $date_time;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_sales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dealer_name', 'required'),
			array('dealer_name, item_description1,year_of_manufacture,ip_address, item_description2, item_description3', 'length', 'max'=>255),
			array('id, dealer_name, sales_statuses_id, year_of_manufacture 	, products_id, date_time', 'safe', 'on'=>'search'),
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
                        'dealer_name' => 'Dealer Name',
                        'trading_as' => 'Trading As',
                        'email_address' => 'Email Address',
                        'physical_address' => 'Physical Address',
                        'identification' => 'Identification',
                        'profile_image' => 'Profile Image',
                        'password_2' => 'Password',
                        'description' => 'Description',	
                        'active' => 'Active',
                        'retired' => 'Retired',
                        'date_added' => 'Date Added',	
                        'last_updated'=> 'Last Updated',
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
            
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function encrypt($value)
	{
		return md5($value);
	}
	
}