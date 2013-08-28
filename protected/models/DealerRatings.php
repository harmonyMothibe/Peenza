<?php

class DealerRatings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class


	 */
        public $users_id ;	
        public $dealers_id ;	
        public $rating;
        public $description;
        public $date_added;	

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_dealer_ratings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, dealers_id, rating, date_added', 'required'),
			array('users_id, dealers_id, rating, description, date_added', 'length', 'max'=>255),
			array('id, users_id, dealers_id,  rating, description,date_added ', 'safe', 'on'=>'search'),
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
                    
                    //'dealersStats'=>array(self::STAT,'Products','dealers_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'users_id' => 'Users ID',
                        'dealers_id' => 'Dealers ID',
                        'rating' => 'Rating',
                        'description' => 'Description',
                        'date_added' => 'Date Added',	
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
		$criteria->compare('users_id',$this->users_id,true);
		$criteria->compare('dealers_id',$this->dealers_id,true);
                $criteria->compare('rating',$this->rating,true);
                $criteria->compare('description',$this->description,true);
		$criteria->compare('date_added',$this->date_added,true);
            
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}