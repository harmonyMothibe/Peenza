<?php

/**
 * This is the model class for table "tbl_blog".
 *
 * The followings are the available columns in table 'tbl_blog':
 * @property integer $id
 * @property string $title
 * @property string $blog_text
 * @property integer $active
 * @property string $created_date
 */
class GalleryAlbums extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Blog the static model class
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
        return 'tbl_gallery_albums';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('title, blog_text, created_date', 'required'),
            array('title', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, active, created_date', 'safe', 'on'=>'search'),
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
            'title' => 'Title',
            'active' => 'Active',
            'page_id' => 'Page ID',
            'created_date' => 'Created Date',
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
        $criteria->compare('title',$this->title,true);
        $criteria->compare('active',$this->active,true);
        $criteria->compare('page_id',$this->page_id,true);
        $criteria->compare('created_date',$this->created_date,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

	public function get_menus()
	{
		$menus = Yii::app()->db->createCommand()
		->select('id, title')
		->where('parent_id = 0')
		->from('tbl_menus')
		->queryAll();
		return $menus;
	}

	public function get_pages()
	{
		$pages = Yii::app()->db->createCommand()
		->select('id, title')
		->from('tbl_pages')
		->queryAll();
		return $pages;
	}
}