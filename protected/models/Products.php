<?php

class Products extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class


	 */
        public $dealers_id ;	
        public $brands_id ;
        public $brand_name;
        public $product_name 	;
        public $description ;	
        public $color ;
        public $product_year 	;
        public $quantity 	;
        public $dimensions 	;
        public $units 	;
        public $conditions ;	
        public $price 	;
        public $special_price ;
        public $thumb_image ;	
        public$stock 	;
        public $views 	;
        public $active ;	
        public $retired ;	
        public $date_added;
        public $last_updated;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_products';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_name, price, quantity, product_year', 'required'),
			array('product_name, description', 'length', 'max'=>255),
			array('description, brand_name, category_id, color,brands_id, dimensions, units, conditions,special_price,thumb_image,stock,active,retired,date_added,last_updated', 'length', 'max'=>256),
			array('id, brand_name, dealers_id, brands_id, category_id, product_name, description, color,product_year,quantity, dimensions, conditions,price,special_price,thumb_image,stock,views,active,retired,date_added', 'safe', 'on'=>'search'),
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
                    
                    'productsMany'=>array(self::BELONGS_TO,'Categories','id'),
                        
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'product_name' => 'Product Name (e.g. album title, book title, clothing item)',
			'description' => 'Description (e.g. record label, publisher, manufacturer)',
                        'brand_name' => 'Brand Name (e.g. artist, author, brand)',
                        'color' => 'Color',
			'product_year' => 'Year (e.g. release date, publish date, year of manufacture)',
			'quantity' => 'Quantity',
                        'dimensions' => 'Size (e.g. 42 inch, XXL, 32GB. Please enter &quot;None&quot; if size is non-applicable)',
			'units' => 'Units',
			'conditions' => 'Conditions',
                        'special_price' => 'Special Price',
                        'price' => 'Price (Please enter numeric value only. All prices are in US$)',
			'stock' => 'Stock',
                        'thumb_image' => 'Thumb Image',
                        'views' => 'views',
			'active' => 'Active',
			'retired' => 'Retired',
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
		$criteria->compare('dealers_id',$this->dealers_id,true);
		$criteria->compare('dealers_id',$this->dealers_id,true);
		$criteria->compare('brands_id',$this->brands_id,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('product_year',$this->product_year,true);
		$criteria->compare('quantity',$this->quantity,true);
                $criteria->compare('dimensions',$this->dimensions,true);
		$criteria->compare('units',$this->units,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('special_price',$this->special_price,true);
		$criteria->compare('thumb_image',$this->thumb_image,true);
		$criteria->compare('stock',$this->stock,true);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('active',$this->active,true);
                $criteria->compare('retired',$this->retired,true);
		$criteria->compare('date_added',$this->date_added,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
}