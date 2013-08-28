<?php

class ProductsHistory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
        public $users_id ;	
        public $products_id ;	
        public $dates_added ;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_products_viewed_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('users_id, products_id,date_added', 'required'),
			array('users_id, products_id, date_added', 'length', 'max'=>255),
			array('id, users_id, products_id, date_added ', 'safe', 'on'=>'search'),
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
                        'products_id' => 'Products ID',
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
		$criteria->compare('products_id',$this->products_id,true);
		$criteria->compare('date_added',$this->date_added,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}