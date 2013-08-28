<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password_2
 * @property string $last_login_time
 * @property string $created
 * @property integer $create_user_id
 * @property string $updated
 * @property integer $update_user_id
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'tbl_dealers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		/*return array(
			array('email,username, tel, username', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('email, username, username, password_2', 'length', 'max'=>256),
			array('last_login_time, created, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, username, password_2, last_login_time, created, updated', 'safe', 'on'=>'search'),
		);*/
		return array(
			array('username, user_surname, email_address', 'required'),
			array('active', 'numerical', 'integerOnly'=>true),
			array('username, role, user_surname', 'length', 'max'=>255),
			array('email_address,voucher_amount, username, password_2', 'length', 'max'=>256),
			array('last_login, created, updated', 'safe'),
			//array('profile_picture', 'file', 'types'=>'jpg, gif, png'),
			array('profile_picture', 'file', 'types'=>'jpg, gif, png', 
								'maxSize'=>1024 * 1024 * 5,
                                'tooLarge'=>'The file was larger than 5MB. Please upload a smaller file.',
                                'wrongType'=>'Please upload only images in the format jpg, gif, png',
                                'tooMany'=>'You can upload only 1 avatar',
                        'on'=>'upload'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username,voucher_amount, user_surname, email_address, password_2, last_login,  created, updated, active', 'safe', 'on'=>'search'),
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
			'username' => 'First Name',
			'user_surname' => 'Last Name',
			'email_address' => 'Email',
			'password_2' => 'Password',
			'last_login' => 'Last Login',
                        'voucher_amount'=> 'Voucher Amount',
			'created' => 'Created',
			'updated' => 'Updated',
			'active' => 'Active',
			'profile_picture'=>'Profile Picture',

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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('user_surname',$this->user_surname,true);
		$criteria->compare('email_address',$this->email_address,true);
		$criteria->compare('password_2',$this->password_2,true);
		$criteria->compare('last_login',$this->last_login,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('active',$this->active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* perform one-way encryption on the password_2 before we store it in
	the database
	*/
	/*protected function afterValidate()
	{
		parent::afterValidate();
		$this->password_2 = $this->encrypt($this->password_2);
	}*/
	public function encrypt($value)
	{
		return md5($value);
	}

	public function getConcatenated()
	{
		 return $this->username.' '.$this->user_surname;
	}
}