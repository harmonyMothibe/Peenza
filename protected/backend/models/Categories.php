<?php

/**
 * This is the model class for table "tbl_posts".
 *
 * The followings are the available columns in table 'tbl_posts':
 * @property integer $id
 * @property integer $active
 * @property string $title
 * @property string $details
 * @property string $created_date
 */
class Categories extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Posts the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_categories';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('active, location, title, application_date, remuneration, details, created_date', 'required'),
            array('active', 'numerical', 'integerOnly'=>true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, active, category_name, description, date_added', 'safe', 'on'=>'search'),
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
            'id' => 'ID',
            'active' => 'Active',
            'category_name' => 'Category Name',
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
        $criteria->compare('active',$this->active);
        $criteria->compare('category_name',$this->category_name,true);
        $criteria->compare('description',$this->description,true);
        $criteria->compare('date_added',$this->date_added,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

} 