<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
/*class UserIdentity extends CUserIdentity
{
	 *
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 
	public function authenticate()
	{
		$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		elseif($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}
}*/

class UserIdentity extends CUserIdentity
{
	private $_id;
        const ERROR_USERNAME_INACTIVE=67;

	/**
	* Authenticates a user using the User data model.
	* @return boolean whether authentication succeeds.
         *  else if (!$record->active)
            $this->errorCode=self::ERROR_USERNAME_INACTIVE;
            else if($record->password!==md5($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;

	*/

	public function authenticate()
	{
		$user=  Dealers::model()->findByAttributes(array('email_address'=>$this->username));
                /*if(empty($user)){
                    $user=  User::model()->findByAttributes(array('email_address'=>$this->username));
                }*/
		if($user===null)
		{
                    
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		}
                else if(!$user->active)
                {
                    
                    $this->errorCode=self::ERROR_USERNAME_INACTIVE;
                }
                else {
			if($user->password_2!==$user->encrypt($this->password))
			{
				$this->errorCode=self::ERROR_PASSWORD_INVALID;
			} else {
				$this->_id = $user->id;
				if(null===$user->last_login)
				{
					$lastLogin = time();
				} else {
					$lastLogin = strtotime($user->last_login);
				}
                                $this->setState('description', $user->description);
				$this->setState('physical_address', $user->physical_address);
				$this->setState('role', $user->role);
				/*$this->setState('last_name', $user->last_name);
				$this->setState('location', $user->location);
				$this->setState('tel', $user->tel);
				$this->setState('first_name', $user->first_name);
				$this->setState('username', $user->username);
				$this->setState('membership', $user->membership);
				$this->setState('image', $user->image);
				$this->setState('active', $user->active);*/
                                
				$this->setState('lastLoginTime', $lastLogin);
                                $this->errorCode=self::ERROR_NONE;
                                }
		}
		return !$this->errorCode;
	}

	public function getId()
	{
		return $this->_id;
	}
}
