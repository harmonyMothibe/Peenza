<?php

class WishList extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class


	 */
        public $product_id ;	
        public $user_id ;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_wishlist';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, user_id', 'required'),
			array('product_id, user_id', 'length', 'max'=>255),
			array('id, product_id,user_id ', 'safe', 'on'=>'search'),
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
                    
                    'wishListProducts'=>array(self::HAS_MANY,'Products','id'),
                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_id' => 'Product ID',
                        'user_id' => 'User ID',
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
		$criteria->compare('product_id',$this->dealers_id,true);
		$criteria->compare('user_id',$this->dealers_id,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
}