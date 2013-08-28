<?php

class Checkout extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class


	 */
        public $user_id;	
        public $totalPrice;
        public $status;	
        public $date_added;
        public $description;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_checkout';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, totalPrice, status, date_added', 'required'),
			array('totalPrice, status, description, date_added, description', 'length', 'max'=>255),
			array('id, user_id, totalPrice, status, date_added, description', 'safe', 'on'=>'search'),
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

			//'color'=>array(self::BELONGS_TO, 'Colors', 'color'),
                        //'color'=>array(self::BELONGS_TO,'Colors','id'),
                    
                    //'productsMany'=>array(self::BELONGS_TO,'Categories','id'),
                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User ID',
                        'totalPrice' => 'Total Price',
			'status' => 'status',
                        'date_added' => 'Date Added',
                        'description' => 'Description'
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
		/*$criteria->compare('id',$this->id);
		$criteria->compare('dealers_id',$this->dealers_id,true);
		$criteria->compare('dealers_id',$this->dealers_id,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('quantity',$this->quantity,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('thumb_image',$this->thumb_image,true);*/
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
}