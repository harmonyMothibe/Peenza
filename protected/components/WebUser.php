<?php
 
// this file must be stored in:
// protected/components/WebUser.php
 
class WebUser extends CWebUser {
 
  // Store model to not repeat query.
  private $_model;
 
  // Return first name.
  // access it by Yii::app()->user->first_name
  function getFirst_Name(){
    $user = $this->loadUser(Yii::app()->user->id);
    if( empty($user->trading_as))
        return $user->username;
    return $user->trading_as;
  }
  function getSurname(){
      $user = $this->loadUser(Yii::app()->user->id);
    if( empty($user->surname))
        return $user->user_surname;
    return $user->surname;
  }
  function getRole(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->role;
  }
  function getImage(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->profile_image;
  }
  // This is a function that checks the field 'role'
  // in the User model to be equal to 1, that means it's admin
  // access it by Yii::app()->user->isAdmin()
  function isAdmin(){
    $user = $this->loadUser(Yii::app()->user->id);
    return intval($user->role) == 1;
  }
  function getVoucherAmount(){
    $user = $this->loadUser(Yii::app()->user->id);
    return $user->voucher_amount;
  }
  
  // Load user model.
  protected function loadUser($id=null)
    {
        if($this->_model===null)
        {
            if($id!==null)
                $this->_model=Dealers::model()->findByPk($id);
        }
        return $this->_model;
    }
    // Load user model.
   function getWishListProducts($id=null)
    {
       
            //if($id!==null)
       $array = array();
        if($id!==null){
        $dataWishList = WishList::model()->with('wishListProducts')->findAll(array('condition' => "user_id=" . $id));
        foreach ($dataWishList as $dataProducts) {
        $data = Products::model()->findAll(array('condition' => "id=" . $dataProducts['product_id']));
            foreach ($data as $pd) {
                array_push($array, $pd);
            }
        }
        }
        return $array;
    }
	function getPopups()
    {
		$popups = Popups::model()->findAll();
		return $popups;
	}
}
?>