<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
            
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $sql = "select * from tbl_dealers d where active = 1 ORDER BY (SELECT count(id) FROM tbl_products WHERE dealers_id = d.id ) DESC LIMIT 5 ";
	$dealers= Yii::app()->db->createCommand($sql)->queryAll();
        #$products = Products::model()->with('productsMany')->findAll(array('limit'=>'5'));
        $products = Products::model()->findAll(array('condition'=>'active=1', 'limit'=>'10', 'order'=>'date_added DESC'));
        #$dealers = Dealers::model()->findAll(array('condition'=>'active=1 AND role=1', 'limit'=>'5', 'order'=>'(SELECT rating FROM peenza_main.tbl_dealer_ratings r WHERE dealers_id = id LIMIT 1) DESC' ));
        
        
        $basket = Yii::app()->session['basket'];
        $count = array();
        $count_dealers = array();
        $products_count;
		
            foreach($products as $myProducts){
                $products_count = Categories::model()->with('products')->findByPk($myProducts->category_id,array('condition'=>'active=1'));
                array_push($count, $products_count->products);
            }
            foreach($dealers as $myDealers){
                $dealers_products_count = Dealers::model()->with('dealersStats')->findByPk($myDealers['id']);
                array_push($count_dealers, $dealers_products_count['dealersStats']); 
            }
			
            $categories = Categories::model()->findAll();
        $this->render('index', array('products' => $products, 'dealers' => $dealers, 'count'=>$count,'count_dealers'=>$count_dealers, 'categories'=>$categories));
        //$this->render('index');
    }
    
    public function actionContent($id)
	{
		$view = 'index-2col';
		$model=new Pages;
		$criteria=new CDbCriteria;
		$criteria->condition='active = 1 AND id = '.$id;
		$criteria->order='created_date ASC';

		$data = Pages::model()->find($criteria);
		$this->render($view,array(
			'model' => $model,
			
			'data' => $data,
		));
	}

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        
        if (isset($_POST['ContactForm']) && !empty($_POST)) {
            $sender_email = $_POST['email'];
            $categoryName= Categories::model()->findByPk($_POST['ContactForm_category']);
            $subject = $categoryName->category_name;
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $message = 'Hi, 
                
You have a message from ' . $name.' '.$surname.' 

'. 
$_POST['body']." 
			
Regards
Peenza Online
			";
            
            Yii::app()->mailer->Host = 'localhost';
            Yii::app()->mailer->IsSMTP();
            Yii::app()->mailer->From = "info@peenza.com";
            Yii::app()->mailer->FromName = 'Peenza Online: ';
            Yii::app()->mailer->AddReplyTo($sender_email);
            Yii::app()->mailer->AddAddress('harmony@ctsc.co.za');
            Yii::app()->mailer->Subject = '[Contact Us]'.$subject;
            Yii::app()->mailer->Body = $message;
            
            if (Yii::app()->mailer->Send()) {
                $this->redirect('index.php?r=site/index');
            } else {
                echo "Your message could not be delivered. <br />";
                echo Yii::app()->createAbsoluteUrl('site/', array());
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            //print_r($model->attributes);exit;
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()){
                if(!empty($_POST['first-time-login']))
                $this->redirect(Yii::app()->user->returnUrl.'?login=true');
                $this->redirect('index.php?r=site/index');
            }
        }
        // display the login form $this->redirect(Yii::app()->user->returnUrl.'?login=true');
        $this->redirect(Yii::app()->user->returnUrl.'?login=false');
        //$this->render('login', array('model' => $model));
    }

    public function actionRegister3() {
        $model = new LoginForm;
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        
        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('register', array('model' => $model));
    }

    public function actionUser() {
        //$products = Products::model()->findAll();
        $user = User::model()->findAll();
        $this->render('user', array('user' => $users));
    }

    public function actionUpdateUser() {
        $model = new User;
        //$model->last_updated = date("Y-m-d H:i:s");
        if (!empty($_POST)) {
            
            if ($update = User::model()->findByPk($_POST['id'])) {
                $update->last_updated =  date("Y-m-d H:i:s");
                $attributes = $update->attributes = $_POST;
                 $file=CUploadedFile::getInstance($update,'profile_image');
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$file}";
                if(!empty($file))
                {
                        $update->profile_image=CUploadedFile::getInstance($update,'profile_image');
                }
                else
                {
                        $update->profile_image = $update->profile_image;
                }
                    
                     
                if (User::model()->updateByPk($_POST['id'], $update->attributes)) {
                    if(!empty($file))
                    {	
                        
                            $update->profile_image->saveAs(Yii::app()->basePath.'/../images/dealers/'. $update->profile_image);
                    }
                    $this->redirect('index.php?r=site/viewUser&id=' . $_POST['id']);
                }
            }
        } else {
            $id = $_GET['id'];
            $userArray = User::model()->find('id=:id', array(':id' => $id));
            $this->render('updateUser', array('model' => $model,
                'userArray' => $userArray,
            ));
        }
    }

    public function actionDealers() {
        //$products = Products::model()->findAll();
        $dealers = Dealers::model()->findAll(array('condition'=>'active=1 AND role=1'));
        $count_dealers = array();
        foreach($dealers as $myDealers){
            $dealers_products_count = Dealers::model()->with('dealersStats')->findByPk($myDealers->id);
            array_push($count_dealers, $dealers_products_count->dealersStats); 

        }
        $this->render('dealers', array('dealers' => $dealers,'count_dealers'=>$count_dealers));
    }
    //You do not need to alter these functions
    function getHeight($image) {
            $size = getimagesize($image);
            $height = $size[1];
            return $height;
    }
    //You do not need to alter these functions
    function getWidth($image) {
            $size = getimagesize($image);
            $width = $size[0];
            return $width;
    }
    function getImageName($post){
       $trimDirectory = explode('/', $post);
       $image = $trimDirectory[count($trimDirectory)-1]; 
       return $image;
    }
    function cropImage( $imageToBeCropped, $leftM , $topM, $width, $height ) {
        // Original image
        $filename = $imageToBeCropped;

        // Get dimensions of the original image
        list($current_width, $current_height) = getimagesize($filename);
        
        // The x and y coordinates on the original image where we
        // will begin cropping the image
        $left = $leftM;
        $top = $topM;

        // This will be the final size of the image (e.g. how many pixels
        // left and down we will be going)
        $crop_width = $width;
        $crop_height = $height;
        $valid_formats = array("jpg", "png", "gif", "bmp");
        list($txt, $ext) = explode(".", $imageToBeCropped);
        if (in_array($ext, $valid_formats)) {
            
        }
       
        // Resample the image
        /*echo $left;
        exit;*/
        $dst_x = 0;
        $dst_y = 0;
        $src_x = $left + $width ; // Crop Start X
        $src_y = $top + $height; // Crop Srart Y
        $dst_w = $width; // Thumb width
        $dst_h = $height; // Thumb height
        $src_w = $src_x + $width; // $src_x + $dst_w
        $src_h = $src_y + $dst_h; // $src_y + $dst_h
        
        $canvas = imagecreatetruecolor($dst_w, $dst_h);
        list($txt, $ext) = explode(".", $imageToBeCropped);
        /*echo $ext;
        exit;*/
        switch($ext) {
           case "gif":
               $current_image = imagecreatefromgif($filename);
               imagecopyresampled($canvas, $current_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
               imagegif($canvas,$filename); 
               break;
           case "pjpeg":
           case "jpeg":
           case "jpg":
              $current_image = imagecreatefromjpeg($filename);
              imagecopyresampled($canvas, $current_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
              imagejpeg($canvas, $filename);
               break;
           case "png":
           case "x-png":
               $current_image = imagecreatefrompng($filename);
               imagecopyresampled($canvas, $current_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
               imagepng($canvas,$filename);  
               break;
        }	
        chmod($filename, 0777);
        
        
        imagedestroy($canvas);
    }
    public function actionViewDealer($id) {
        //$canvas = imagecreatetruecolor(111, 111);
        if(isset($_POST['image-attributes'])){
           //break the image-attributes into pieces 
           $croppinginfo = explode(',', $_POST['image-attributes']);
           $width = $croppinginfo[0];
           $height = $croppinginfo[1];
           $marginleft = $croppinginfo[2];
           $margintop = $croppinginfo[3];
           $imageSource = $croppinginfo[4];
           $this->cropImage($imageSource, intval($marginleft), intval($margintop), intval($width), intval($height));
        }
        $CriteriaProduct = new CDbCriteria();
		if(Yii::app()->user->id  === $id )
			$active = "";
		else 
			$active="AND active=1";
        //$CriteriaProduct->condition = "dealers_id = $id $active";
		
        $data = Dealers::model()->findByPk($id);
        $city = Cities::model()->findByPk($data->cities_id);
        $ratings = DealerRatings::model()->findAll(array("condition"=>"dealers_id = $id"));
        $total_ratings = 0;
        $count_ratings = 0;
        $count_dealers = 0;
        $voted = false;
        foreach($ratings as $ratingsitem){
            $count_ratings += $ratingsitem->rating;
            if( Yii::app()->user->id === $ratingsitem->users_id){
               $voted = true; 
            }
        }
        if($ratings == null){
            $total_ratings = 0;
            $count_dealers = 0;
            
        }else{
            $count_dealers = count($ratings);
            $total_ratings = $count_ratings /$count_dealers ;
        }
        $condition = "dealers_id = $id $active";
        $order = 'date_added DESC';
        $dataProvider=new CActiveDataProvider('Products', array('criteria'=>array(
                                    'condition'=>$condition,
                                    'order'=>$order,   
                            ), 'pagination'=>array(
                    'pageSize'=>10,
                ),));
        $this->render('viewDealer', array('data' => $data, 'city'=>$city, 'dataProvider'=>$dataProvider,'total_ratings'=>$total_ratings,'voted'=>$voted,'count_dealers'=>$count_dealers,
        ));
    }
    
     public function actionViewUser($id) {
        $data = User::model()->findByPk($id);
        $this->render('viewUser', array('data' => $data,
        ));
    }

    public function actionRegister() {

        $model = new Dealers;
        $model->date_added = date("Y-m-d H:i:s");
        $cities = Cities::model()->findAll(array('order' => 'city_name ASC'));
        $citiesArray = CHtml::listData($cities, 'id', 'city_name');
        $categories = Categories::model()->findAll(array('order' => 'category_name ASC'));
        $categoriesArray = CHtml::listData($categories, 'id', 'category_name');
        $prices = Prices::model()->findAll(array('order' => 'id ASC'));
        $pricesArray = CHtml::listData($prices, 'id', 'allPrices');
        if (!empty($_POST)) {
            
            $emailExist = Dealers::model()->findAll();
            $exist = false;
            foreach($emailExist as $emails){
                if( $_POST['email_address']  == $emails->email_address)
                $exist = true;
            }
            
            if(!$exist){
            $_POST['password_2'] = md5($_POST['password_2']);
            $_POST['active'] = 0;
            $model->password_2 = $_POST['password_2'];
            $model->role = 1;
            $model->attributes = $_POST;
            $uploadedImage = CUploadedFile::getInstance($model, 'profile_image');

            if (is_object($uploadedImage)) {
                $rnd = rand(0,9999);  
                $fileName = "{$rnd}-{$uploadedImage}";  // random number + file name
                $model->profile_image = $fileName;
            } 
            
            if ($model->save()) {
                if(is_object($uploadedImage))
                {
                    $uploadedImage->saveAs(Yii::app()->basePath.'/../images/dealers/'. $model->profile_image);
                }
		$email_message = "Hi Admin!


".ucfirst($_POST['dealer_name'])." has registered an account on peenza.com and is awaiting activation. 
Please check for payment of the subscription fees before activating their account.

------------------------------------------------
Activation Instructions
------------------------------------------------

To activate the user, you need to login to the backend, 
list all the dealers and click the tick icon under the Activate /Deactivate column.

------------------------------------------------
Regards
Peenza
------------------------------------------------
";
					Yii::app()->mailer->Host = 'localhost';
					Yii::app()->mailer->IsSMTP();
					Yii::app()->mailer->From = "info@peenza.com";
					Yii::app()->mailer->FromName = 'Peenza Online: ';
					Yii::app()->mailer->AddReplyTo('info@peenza.com');
					Yii::app()->mailer->AddAddress('info@peenza.com');
					Yii::app()->mailer->Subject = 'Account Activation';
					Yii::app()->mailer->Body = $email_message;
					Yii::app()->mailer->Send();
                  $this->redirect('index.php?r=site/index&registerdealer=true');
                 /*$this->render('feedback', array('message' => $message,
            ));*/
            }else{
                $message="You registration was unsuccessful. Please try again";
                 $this->render('feedback', array('message' => $message,));}
            } // EO Checking email
            else{
                $this->redirect('index.php?r=site/register&emailExist=true');
            }
        }else {
            $this->render('register', array('model' => $model,'citiesArray'=>$citiesArray,'categoriesArray'=>$categoriesArray, 'pricesArray'=>$pricesArray
            ));
        }
    }
	##########################################################################################################
	# IMAGE FUNCTIONS																						 #
	# You do not need to alter these functions																 #
	##########################################################################################################
	function resizeImage($image,$width,$height,$scale) {
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
		    case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
	  	}
		imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);
		
		switch($imageType) {
			case "image/gif":
		  		imagegif($newImage,$image); 
				break;
	      	case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
		  		imagejpeg($newImage,$image,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$image);  
				break;
	    }
		
		chmod($image, 0777);
		return $image;
	}
	//You do not need to alter these functions
	function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
		list($imagewidth, $imageheight, $imageType) = getimagesize($image);
		$imageType = image_type_to_mime_type($imageType);
		
		$newImageWidth = ceil($width * $scale);
		$newImageHeight = ceil($height * $scale);
		$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
		switch($imageType) {
			case "image/gif":
				$source=imagecreatefromgif($image); 
				break;
		    case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
				$source=imagecreatefromjpeg($image); 
				break;
		    case "image/png":
			case "image/x-png":
				$source=imagecreatefrompng($image); 
				break;
	  	}
		imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
		switch($imageType) {
			case "image/gif":
		  		imagegif($newImage,$thumb_image_name); 
				break;
	      	case "image/pjpeg":
			case "image/jpeg":
			case "image/jpg":
		  		imagejpeg($newImage,$thumb_image_name,90); 
				break;
			case "image/png":
			case "image/x-png":
				imagepng($newImage,$thumb_image_name);  
				break;
	    }
		chmod($thumb_image_name, 0777);
		return $thumb_image_name;
	}
	
    
    public function actionUserRegister() {
        $model = new User;
        $model->active = "0";
        $model->date_added = date("Y-m-d H:i:s");
        if (!empty($_POST)) {
            $emailExist = Dealers::model()->findAll();
            $exist = false;
            foreach($emailExist as $emails){
                if( $_POST['email_address']  == $emails->email_address)
                $exist = true;
            }
            if(!$exist){
               
            $_POST['password_2'] = md5($_POST['password_2']);
            $model->password_2 = $_POST['password_2'];
            $model->role = 2;
            $model->attributes = $_POST;
            /*$uploadedImage = CUploadedFile::getInstance($model, 'profile_image');
            if (is_object($uploadedImage)) {
                $rnd = rand(0,9999);  
                $fileName = "{$rnd}-{$uploadedImage}";  // random number + file name
                $model->profile_image = $fileName;
            } */
             if(!empty($_POST['image-attributes'])){
               $model->profile_image = $this->getImageName($_POST['image-attributes']);
               }
            if ($model->save()) {
                 if(!empty($_POST['image-attributes'])){
                    $imageDimensions = explode(',', $_POST['image-attributes']);
                    $imageDirectoryANdImage = $imageDimensions[count($imageDimensions)-1];
                    $imageLeft = $imageDimensions[2]; // eliminating -ve sign
                    $imageTop = $imageDimensions[3]; // eliminating -ve sign
                    $width = $croppinginfo[0];
                    $height = $croppinginfo[1];
                    $cropImage = $this->cropImage($imageDirectoryANdImage, intval($imageLeft), intval($imageTop), $width,$height );
               }
                /*if(is_object($uploadedImage))
                {
                    $uploadedImage->saveAs(Yii::app()->basePath.'/../images/users/'. $model->profile_image);
                }*/
                 $message="Thank you for registering as on our website. Please click on the confirmation link sent your email to activate your account";
                 $to = $_POST['email_address'];
					$email_message = "Hi ".ucfirst($_POST['username'])."

This email has been sent from Peenza

You have received this email because this email address
was used during registration on our website.
If you did not register on our website, please disregard this
email. You do not need to unsubscribe or take any further action.

------------------------------------------------
Activation Instructions
------------------------------------------------

Thank you for registering.
We require that you 'validate' your registration to ensure that
the email address you entered was correct. This protects against
unwanted spam and malicious abuse.

To activate your account, simply click on the following link:
".
Yii::app()->createAbsoluteUrl('site/activatereg', array('email_address' => $model->email_address, 'id'=>$model->id))."

". sha1(mt_rand(10000, 99999).time().$to) ."
(Some email client users may need to copy and paste the link into your web
browser).

------------------------------------------------
Regards
Peenza
------------------------------------------------
";
					Yii::app()->mailer->Host = 'localhost';
					Yii::app()->mailer->IsSMTP();
					Yii::app()->mailer->From = "info@peenza.com";
					Yii::app()->mailer->FromName = 'Peenza Online: ';
					Yii::app()->mailer->AddReplyTo('info@peenza.com');
					Yii::app()->mailer->AddAddress($to);
					Yii::app()->mailer->Subject = 'Account Activation';
					Yii::app()->mailer->Body = $email_message;
					Yii::app()->mailer->Send();
                 $this->redirect('index.php?r=site/index&register=true');
            }else{
                $message="You registration was unsuccessful. Please try again";
                 $this->render('feedback', array('message' => $message,));}
                 
        }else {
            $this->redirect('index.php?r=site/userRegister&emailExist=true');
        } //regiser
        }else {
            $this->render('userRegister', array('model' => $model,
            ));
        }
    }
    
    public function actionUserUpload() {
        
        $model = new User;
        $model->active = "0";
        $model->date_added = date("Y-m-d H:i:s");
        if (!empty($_POST)) {
            $emailExist = Dealers::model()->findAll();
            $exist = false;
            foreach($emailExist as $emails){
                if( $_POST['email_address']  == $emails->email_address)
                $exist = true;
            }
            if(!$exist){
               
            $_POST['password_2'] = md5($_POST['password_2']);
            $model->password_2 = $_POST['password_2'];
            $model->role = 2;
            $model->attributes = $_POST;
            /*$uploadedImage = CUploadedFile::getInstance($model, 'profile_image');
            if (is_object($uploadedImage)) {
                $rnd = rand(0,9999);  
                $fileName = "{$rnd}-{$uploadedImage}";  // random number + file name
                $model->profile_image = $fileName;
            } */
             if(!empty($_POST['image-attributes'])){
               $model->profile_image = $this->getImageName($_POST['image-attributes']);
               }
            if ($model->save()) {
                 if(!empty($_POST['image-attributes'])){
                    $imageDimensions = explode(',', $_POST['image-attributes']);
                    $imageDirectoryANdImage = $imageDimensions[count($imageDimensions)-1];
                    $imageLeft = $imageDimensions[2]; // eliminating -ve sign
                    $imageTop = $imageDimensions[3]; // eliminating -ve sign
                    $width = $croppinginfo[0];
                    $height = $croppinginfo[1];
                    $cropImage = $this->cropImage($imageDirectoryANdImage, intval($imageLeft), intval($imageTop), $width, $height);
               }
                /*if(is_object($uploadedImage))
                {
                    $uploadedImage->saveAs(Yii::app()->basePath.'/../images/users/'. $model->profile_image);
                }*/
                 $message="Thank you for registering as on our website. Please click on the confirmation link sent your email to activate your account";
                 $to = $_POST['email_address'];
					$email_message = "Hi ".ucfirst($_POST['username'])."

This email has been sent from Peenza

You have received this email because this email address
was used during registration on our website.
If you did not register on our website, please disregard this
email. You do not need to unsubscribe or take any further action.

------------------------------------------------
Activation Instructions
------------------------------------------------

Thank you for registering.
We require that you 'validate' your registration to ensure that
the email address you entered was correct. This protects against
unwanted spam and malicious abuse.

To activate your account, simply click on the following link:
".
Yii::app()->createAbsoluteUrl('site/activatereg', array('email_address' => $model->email_address, 'id'=>$model->id))."

". sha1(mt_rand(10000, 99999).time().$to) ."
(Some email client users may need to copy and paste the link into your web
browser).

------------------------------------------------
Regards
Peenza
------------------------------------------------
";
					Yii::app()->mailer->Host = 'localhost';
					Yii::app()->mailer->IsSMTP();
					Yii::app()->mailer->From = "info@peenza.com";
					Yii::app()->mailer->FromName = 'Peenza Online: ';
					Yii::app()->mailer->AddReplyTo('info@peenza.com');
					Yii::app()->mailer->AddAddress($to);
					Yii::app()->mailer->Subject = 'Account Activation';
					Yii::app()->mailer->Body = $email_message;
					Yii::app()->mailer->Send();
                 $this->redirect('index.php?r=site/index&register=true');
            }else{
                $message="You registration was unsuccessful. Please try again";
                 $this->render('feedback', array('message' => $message,));}
                 
        }else {
            $this->redirect('index.php?r=site/userRegister&emailExist=true');
        } //regiser
        }else {
            $this->render('upload', array('model' => $model,
            ));
        }
    }
    public function actionCrop() {
        $this->redirect('index.php');
        if (empty(Yii::app()->session['timestamp'])) {
            Yii::app()->session['timestamp'] = time();

        } 
        $path = "uploads/";
        $valid_formats = array("jpg", "png", "gif", "bmp");
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];

            if (strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = Yii::app()->session['timestamp'].'_'.$name;
                        //time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                            //$this->renderPartial('upload');
                               echo 'test';                 }
                        else
                            echo "failed";
                    }
                    else
                        echo "Image file size max 1 MB";
                }
                else
                    echo "Invalid file format..";
            }

            else
                echo "Please select image..!";

            //exit;
        }
    }
    public function actionUpload() {
        $this->redirect('index.php');
        if (empty(Yii::app()->session['timestamp'])) {
            Yii::app()->session['timestamp'] = time();

        } 
        $path = "uploads/";
        $valid_formats = array("jpg", "png", "gif", "bmp");
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];

            if (strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = Yii::app()->session['timestamp'].'_'.$name;
                        //time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        if (move_uploaded_file($tmp, $path . $actual_image_name)) {
                            //$this->renderPartial('upload');
                               echo 'test';                 }
                        else
                            echo "failed";
                    }
                    else
                        echo "Image file size max 1 MB";
                }
                else
                    echo "Invalid file format..";
            }

            else
                echo "Please select image..!";

            //exit;
        }
    }
    
    public function actionRecommend(){
        if(!empty($_POST)){
                 $to = $_POST['friend_email'];
                 $name_surname = $_POST['name_surname'];
                 $email_message = "Hi, "."

This email has been sent from Peenza

You have received this email because this email address
has been recommended by ".$name_surname." on our website.

------------------------------------------------
Regards
Peenza
------------------------------------------------
";
            Yii::app()->mailer->Host = 'localhost';
            Yii::app()->mailer->IsSMTP();
            Yii::app()->mailer->From = "info@peenza.com";
            Yii::app()->mailer->FromName = 'Peenza Online: ';
            Yii::app()->mailer->AddReplyTo('info@peenza.com');
            Yii::app()->mailer->AddAddress($to);
            Yii::app()->mailer->Subject = 'Recommendation';
            Yii::app()->mailer->Body = $email_message;
            if(Yii::app()->mailer->Send()){
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
    }


    public function actionActivatereg()
        {
            $email_address= Yii::app()->request->getQuery('email_address');       
			$id = $_GET['id'];
			// collect user input data
                            
			if(isset($email_address))
			{
				
			  $model = Dealers::model()->find('email_address=:email_address', array(':email_address'=>$email_address));   
			  if($email_address == $model->email_address)
				{
					$model->active = 1;
					Dealers::model()->updateByPk($id, array('active'=>"1"));
                                        $this->redirect('index.php?r=site/index&success=true');
					/*$this->render('confirmationreg',array('model'=>$model,
					));*/
				}   
				
			}
  
			// display the login form
			
        }

    public function actionUpdateDealer() {
        $model = new Dealers;
        $cities = Cities::model()->findAll(array('order' => 'city_name ASC'));
        $citiesArray = CHtml::listData($cities, 'id', 'city_name');
        $categories = Categories::model()->findAll(array('order' => 'category_name ASC'));
        $categoriesArray = CHtml::listData($categories, 'id', 'category_name');
        /*var_dump($_POST);
        exit;*/
        if (!empty($_POST)) {
            if ($update = Dealers::model()->findByPk($_POST['id'])) {

                $attributes = $update->attributes = $_POST;
                $update->cities_id = $_POST['cities_id'];
                $update->last_updated =  date("Y-m-d H:i:s");
                $file=CUploadedFile::getInstance($update,'profile_image');
                $rnd = rand(0,9999);
                $fileName = "{$rnd}-{$file}";
                if(!empty($file))
                {
                        $update->profile_image=CUploadedFile::getInstance($update,'profile_image');
                }
                else
                {
                        $update->profile_image = $update->profile_image;
                }
               
                if (Dealers::model()->updateByPk($_POST['id'], $update->attributes)) {
                    
                     if(!empty($file))
                    {	
                        
                            $update->profile_image->saveAs(Yii::app()->basePath.'/../images/dealers/'. $update->profile_image);
                    }
                    $this->redirect('index.php?r=site/viewDealer&id=' . $_POST['id']);
                }
            }
        } else {
            $id = $_GET['id'];
            $dealerArray = Dealers::model()->find('id=:id', array(':id' => $id));
            $this->render('updateDealer', array('model' => $model,
                'dealerArray' => $dealerArray,'citiesArray'=>$citiesArray, 'categoriesArray'=>$categoriesArray 
            ));
        }
    }
    public function actionModus(){
        $this->render('modustest');
    }
    /*public function actionCities(){
        $cities = array('0'=>'Jozi', '1'=>'harare' );
        $this->render('cities', array('cities'=>$cities));
        //$this->redirect('index.php?r=site/viewDealer&id=' . $_POST['id']);
    }*/
    
    public function actionProducts() {
        if(isset($_POST['nevershowAgain'] )){
            if(Yii::app()->request->cookies['showagain']->value =="set"){
               // unset(Yii::app()->request->cookies['showagain']);
                Yii::app()->request->cookies['showagain']->value = 'unset';
             } 
        }
        $count = array();
        if (isset($_GET['catID'])) {
            //$products = Products::model()->findAll(array('condition'=>'category_id='.$_GET['catID'].' AND active=1', 'order'=>'date_added DESC') );
            $condition ='category_id='.$_GET['catID'].' AND active=1';
            $order = 'date_added DESC';
            $dataProvider=new CActiveDataProvider('Products', array('criteria'=>array(
					'condition'=>$condition,
                                        'order'=>$order,   
				), 'pagination'=>array(
                        'pageSize'=>10,
                    ),));
            $categories = Categories::model()->findByPk($_GET['catID']);
        } else {
            //$products = Products::model()->findAll(array('condition'=>'active=1', 'order'=>'date_added DESC'));
            $condition ='active=1';
            $order = 'date_added DESC';
            $dataProvider=new CActiveDataProvider('Products', array('criteria'=>array(
					'condition'=>$condition,
                                        'order'=>$order,   
				), 'pagination'=>array(
                        'pageSize'=>10,
                    ),));
            
            foreach($dataProvider as $myProducts){
                $products_count = Categories::model()->with('products')->findByPk($myProducts->category_id,array('condition'=>'active=1', 'order'=>'date_added DESC') );
                array_push($count, $products_count->products);
            }
            $categories = "";
            
        }
        $this->render('products', array('dataProvider'=> $dataProvider, 'categories'=> $categories, 'count'=>$count ));
    }
	
	public function actionBankAccounts() {
        
        $bankaccounts= BankAccounts::model()->findAll(array('condition'=>'active=1'));
		$userID=Yii::app()->user->id;
	    $voucher_value=$_POST['voucher_value'];
	    $quantity= $_POST['quantity'];
	    $reference= $_POST['random'];
	    $date_added=date("Y-m-d H:i:s");
		$connection = Yii::app()->db;		    
		$sql = "INSERT INTO tbl_online_wallet_vouchers 
		SET 
		userID='$userID',
		voucher_value ='$voucher_value',
		quantity ='$quantity',
		reference = '$reference',
		date_added = '$date_added'
		";
		$connection->createCommand($sql)->execute();
        $to = "raphael@ctsc.co.za";
		$email= Yii::app()->db->createCommand()
		->select('email_address')
		->from('tbl_dealers')
		->where('id="'.$userID.'"')
		->queryRow();
     	$email_message = "Hi 
                         
You received this email because you bought Online Wallet Vouchers from our online store [ Peenza.com ],

------------------------------------------------
Online Wallet Vouchers Details
------------------------------------------------

Voucher Value: $voucher_value
Quantity: $quantity
Reference: $reference
Date Added: $date_added

Please make your payment using the following details (Remember to use the Reference Number): 
                                          
Bank Deposit Option
Reference: 2139743088
Bank: Barclays Bank
Acc No. 1234567890
Acc Holder: Peenza Enterprises 

BEcoCash Option
Reference: 2139743088
Ecocash
EcocCash No. 1234567890
Acc Holder: Peenza Enterprises 

Kingdom Bank Option
Reference: 2139743088
Kingdom Cash Send
Kingdom No. 1234567890
Acc Holder: Peenza Enterprises

Once you have made the payment, the voucher will be sent to you via email. Please note that bank deposits will take between 24 - 48 hours to reflect. EcoCash and Kingdom Cash Send transfers will reflect immediately. 


------------------------------------------------
Regards
Peenza Online
------------------------------------------------
";		$userID = Dealers::model()->findByPk($userID);

        Yii::app()->mailer->Host = 'localhost';
        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->From = "harmony@ctsc.co.za";
        Yii::app()->mailer->FromName = 'Peenza Online: ';
        Yii::app()->mailer->AddReplyTo('harmony@ctsc.co.za');
        Yii::app()->mailer->AddAddress($to);
        Yii::app()->mailer->AddAddress($email['email_address']);
        Yii::app()->mailer->Subject = 'Online Wallet Vouchers Details';
        Yii::app()->mailer->Body = $email_message;
        Yii::app()->mailer->Send();
        $this->render('pages/online-wallet-voucher-step4', array('bankaccounts' => $bankaccounts));
		
    }
    public function actionAddToBasket(){
       session_start();
       
        $_SESSION['basket'][] = array('id' => $_POST['id'],
            'product_name' => $_POST['product_name'],
            'price' => $_POST['price'],
            'color' => $_POST['color'],
            'product_year' => $_POST['product_year'],
            'quantity' => $_POST['quantity'],
            'dimensions'=>$_POST['dimensions'],
            'dealer_name' => $_POST['dealer_name'],
            'thumb_image' => $_POST['thumb_image'],
            'conditions'=>$_POST['conditions'],
        );
        $this->redirect('index.php?r=site/viewBasket');
    }
    
    public function actionAddToWishList(){
        $model = new WishList;
        /*die($_POST);*/
        if(!empty($_POST)){
            
            $model->attributes = $_POST;
            $model->date_added =  date("Y-m-d H:i:s");
             if ($model->save()) {
                 $this->redirect('index.php?r=site/viewWishList');
            } 
        }
        $this->redirect('index.php?r=site/viewWishList');
    }
    
    public function actionRemoveItem($id){
        session_start();
        if (isset($_GET)) {
            $r = array_values($_SESSION['basket']);
            $_SESSION['basket'] = array();
            $_SESSION['basket'] = $r;
            for($j = 0; $j < count($_SESSION['basket']); $j++ ){
                if($_GET['id'] == $_SESSION['basket'][$j]['id']){
                    unset($_SESSION['basket'][$j]) ;
                    break;
                }
            }
        } 
        $basket = array_values($_SESSION['basket']);
        $basket = array_values($basket);
        $this->render('viewBasket', array('basket'=>$basket));
    }
    public function actionAddProduct() {
        if(Yii::app()->user->id){
        $model = new Products;
        $colors = Colors::model()->findAll(array('order' => 'colorName ASC'));
        $colorsArray = CHtml::listData($colors, 'id', 'colorName');
        $brands = Brands::model()->findAll(array('order' => 'brand_name ASC'));
        $brandsArray = CHtml::listData($brands, 'id', 'brand_name');
        $categories = Categories::model()->findAll(array('order' => 'category_name ASC'));
        $categoriesArray = CHtml::listData($categories, 'id', 'category_name');
        //Conditions Data
        $conditions = Conditions::model()->findAll(array('order' => 'status ASC'));
        $conditionsArray = CHtml::listData($conditions, 'id', 'status');
        // Add Year
         $years = Years::model()->findAll(array('order' => 'year ASC'));
         $yearsArray = CHtml::listData($years, 'id', 'year');
        
        if (!empty($_POST)) {
            $model->attributes = $_POST;
            $uploadedImage = CUploadedFile::getInstance($model, 'thumb_image');
            $model->date_added =  date("Y-m-d H:i:s");
            $model->dealers_id = Yii::app()->user->id;
            $model->views =  0;
            $model->active =  1;
            if (is_object($uploadedImage)) {
                $rnd = rand(0,9999);  
                $fileName = "{$rnd}-{$uploadedImage}";  // random number + file name
                $model->thumb_image = $fileName;
            } else {
                $model->thumb_image = "";
            } 
            if ($model->save()) {
                 if(is_object($uploadedImage))
                {
                    $uploadedImage->saveAs(Yii::app()->basePath.'/../images/products/'. $model->thumb_image);
                }
                //Set the upload url for showing the message again
                $upload = '';
                if(Yii::app()->request->cookies['showagain']->value ==""){ 
                        Yii::app()->request->cookies['showagain'] = new CHttpCookie('showagain', 'set');
                        $upload = '&upload';
                 }
                 //if the upload suburl is empty it will not show the message
                 $this->redirect("index.php?r=site/products$upload");
            } else {
                $this->redirect('index.php?r=site/addProduct');
            }
        } else {
            $this->render('addProduct', array('model' => $model, 'yearsArray'=>$yearsArray, 'colorsArray'=>$colorsArray, 'brandsArray'=>$brandsArray, 'categoriesArray'=>$categoriesArray,'conditionsArray'=>$conditionsArray ));
        }
        }else $this->redirect('index.php?r=site/index&loginrequired');
    }

    public function actionUpdateProduct() {
        $model = new Products;
        $colors = Colors::model()->findAll(array('order' => 'colorName ASC'));
        $colorsArray = CHtml::listData($colors, 'id', 'colorName');
        // Condition Dropdown Data
        $conditions = Conditions::model()->findAll(array('order' => 'status ASC'));
        $conditionsArray = CHtml::listData($conditions, 'id', 'status');
        // Brands Dropdown Data
        $brands = Brands::model()->findAll(array('order' => 'brand_name ASC'));
        $brandsArray = CHtml::listData($brands, 'id', 'brand_name');
        //Year Dropdown
         $years = Years::model()->findAll(array('order' => 'year ASC'));
         $yearsArray = CHtml::listData($years, 'id', 'year');
         
        if (!empty($_POST)) {
            if ($update = Products::model()->findByPk($_POST['id'])) {
                $rnd = rand(0,9999);  
                $attributes = $update->attributes = $_POST;
                $update->last_updated =  date("Y-m-d H:i:s");
                $file=CUploadedFile::getInstance($update,'thumb_image');
                $fileName = "{$rnd}-{$file}";
                if(!empty($file))
                {
                        $update->thumb_image=CUploadedFile::getInstance($update,'thumb_image');
                }
                else
                {
                        $update->thumb_image = $update->thumb_image;
                }


                if (Products::model()->updateByPk($_POST['id'], $update->attributes)) {
                    if(!empty($file))
                    {	
                            $update->thumb_image->saveAs(Yii::app()->basePath.'/../images/products/'. $update->thumb_image);
                    }
                    $this->redirect('index.php?r=site/viewProduct&id=' . $_POST['id']);
                }
            }
        } else {
            $id = $_GET['id'];
            $productArray = Products::model()->find('id=:id', array(':id' => $id));
            $this->render('updateProduct', array('model' => $model,
                'productArray' => $productArray,'colorsArray'=>$colorsArray,
                'conditionsArray'=>$conditionsArray,'brandsArray'=>$brandsArray,
                'yearsArray'=>$yearsArray
            ));
        }
    }

    public function actionViewProduct($id) {
        //$canvas = imagecreatetruecolor(111, 111);
        if(isset($_POST['image-attributes'])){
           //break the image-attributes into pieces 
           $croppinginfo = explode(',', $_POST['image-attributes']);
           $width = $croppinginfo[0];
           $height = $croppinginfo[1];
           $marginleft = $croppinginfo[2];
           $margintop = $croppinginfo[3];
           $imageSource = $croppinginfo[4];
            
           $this->cropImage($imageSource, intval($marginleft), intval($margintop), $width , $height);
           
        }
        $model = new Products;
        $data = Products::model()->findByPk($id);
        $color = Colors::model()->findByPk($data->color);
        $year = Years::model()->findByPk($data->product_year);
        // select other poducts by this user
        //$products = Products::model()->findAll(array("condition"=>"dealers_id=$data->dealers_id AND id != $id"));
        $condition ="dealers_id=$data->dealers_id AND active=1 AND id != $id";
        $order = 'date_added DESC';
        $dataProvider=new CActiveDataProvider('Products', array('criteria'=>array(
                                    'condition'=>$condition,
                                    'order'=>$order,   
                            ), 'pagination'=>array(
                    'pageSize'=>10,
                ),));
        // update counter whenever the product is viewed
        Products::model()->updateCounters(array('views' => 1), array('condition' => "id=" . $id), array(':id' => $id));
        //Setting saving the history related to this produts
        $productHistory = new ProductsHistory;
        $userID =  rand(9000,9999); 
        if(Yii::app()->user->id){
            $userID = Yii::app()->user->id;
        }
        //echo $userID; exit;
        $users_id= $userID;
        $products_id = $id;
        $date_added =  date("Y-m-d H:i:s");
        $historyArray = array('users_id'=>$users_id, 'products_id'=>$products_id, 'date_added'=>$date_added );
        $productHistory->attributes = $historyArray;
        
        $checkProductHistory = ProductsHistory::model()->findAll(array('order' => 'id ASC'));
        $Exist = false;
        foreach($checkProductHistory as $checkProducts){
            //var_dump((int)$productHistory['products_id'] !== (int)$checkProducts['products_id']); exit;
            if( (((int)$checkProducts['products_id'] === (int)$productHistory['products_id']) AND  ((int)$checkProducts['users_id'] ===(int)$productHistory['users_id']))){
                  $Exist = true;       
            }
        }
        if(!$Exist){
            $productHistory->save(); 
        }
        //select all the users with this product
        $findProducts = ProductsHistory::model()->findAll(array("condition" => "products_id=$id"));
        //echo 'test';
       // print('<br />products_id '.' users_id<br />');
        $associatedProducts = array();
        foreach($findProducts as $productsArray){
                $findProductsAtThisDealers = ProductsHistory::model()->findAll(array("condition" => "users_id=$productsArray->users_id"));
                
                foreach($findProductsAtThisDealers as $theDealers){
                    if($theDealers->products_id != $id){
                    array_push($associatedProducts, $theDealers->products_id);
                    }
                }
        }
        $array_s = array();
        for($i = 0; $i< count($associatedProducts); $i++){
            array_push( $array_s , Products::model()->findAll(array("condition"=>"id=$associatedProducts[$i] AND active=1")));  
        }
        $this->render('viewProduct', array('color'=> $color, 'data' => $data, 'dataProvider'=>$dataProvider,'array_s'=>$array_s, 'year'=>$year
        ));
    }
    public function actionTopUpWallet(){
        if(!empty($_POST)){
            $front_code = $_POST['front_code'];
			$back_code = $_POST['back_code'];
			$keygen = $_POST['keygen'];
			$voucher = Yii::app()->db->createCommand()->select('tbl_value_id, id')->from('tbl_vouchers')->where("front_code=$front_code AND back_code=$back_code AND keygen=$keygen AND redeemed=0")->queryRow();
			$talue_id = $voucher["tbl_value_id"];
			if(!empty($talue_id)){
				$value = Yii::app()->db->createCommand()->select('value')->from('tbl_values')->where("id=$talue_id")->queryRow();
				$value_amount= $value["value"];
				$id = Yii::app()->user->id;
				$user = Dealers::model()->findByPk($id);
		        if($user->updateByPk($id,array('voucher_amount'=>$user->voucher_amount + $value_amount))){
					$voucher_id = $voucher['id'];
					Yii::app()->db
				    ->createCommand("UPDATE tbl_vouchers SET redeemed = '1' WHERE id=$voucher_id")
				    ->execute();
		        	$this->redirect(Yii::app()->request->urlReferrer);
		        }
	                
			}
			else $this->redirect('index.php?topupwallet=false');
	        }
        else $this->redirect('index.php?topupwallet=false');
    }
    
   
    
    public function actionQuicksale() {
        $model = new Sales;
        if (!empty($_POST)) {
            $model->attributes = $_POST;
            $model->date_time =  date("Y-m-d H:i:s"); 
            $model->ip_address = $_SERVER["REMOTE_ADDR"];
            if ($model->save()) {
                 $this->redirect('index.php?r=site/index');
            } else {
                $this->redirect('index.php?r=site/quicksale');
            }
            
        }else{
            $this->render('quicksale', array('model' => $model));
        }
    }
    
   
    public function actionDeleteProduct($id){
        //$model = new Products;
        $data = Products::model()->findByPk($id);
        if($data->updateByPk($id,array('active'=>'0'))); 
                $this->redirect(Yii::app()->request->urlReferrer);
    }
    public function actionActivateProduct($id){
        //$model = new Products;
        $data = Products::model()->findByPk($id);
        if($data->updateByPk($id,array('active'=>'1'))); 
                $this->redirect(Yii::app()->request->urlReferrer);
    }
    public function actionDeactivateAccount($id){
        //$model = new Products;
        $data = Dealers::model()->findByPk($id);
        if($data->updateByPk($id,array('active'=>'2'))){
            $this->actionLogout();
        }
    }
    public function actionDealerRatings(){
        //print_r($_POST);
        $model = new DealerRatings;
        if (!empty($_POST)) {
            $model->attributes = $_POST;
            $model->date_added =  date("Y-m-d H:i:s");
            $model->rating = $_POST['star'];
            if ($model->save()) {
                 $this->redirect(Yii::app()->request->urlReferrer);
            } 
        } else {
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
     private function advancedSearch($searchValue, $colorValue, $dimentionValue, $minPrice, $maxPrice){
        
        $active = 'active="1"';
        $searchWord = ' AND  product_name like "%' . $searchValue . '%"  AND  description like "%' . $searchValue . '%" ';
        $color = ' AND color="' .$colorValue. '"';
        $dimention = '" AND dimensions like "%' . $dimentionValue . '%"';
        $priceStatement=""; 
        
        if( (isset($minPrice) && ($minPrice != null)) && (isset($maxPrice) && ($maxPrice != null))  ){
            $priceStatement = ' AND price >="'.$minPrice.'" AND price <="'.$maxPrice.'"';
        }
        else if(isset($minPrice) && ($minPrice != null)){
            $priceStatement = ' AND price >="'.$minPrice.'"';
        }
        else if(isset($maxPrice) && ($maxPrice != null)){
            $priceStatement = ' AND price <="'.$maxPrice.'"';
        }
        
        if((isset($searchValue) && ($searchValue != null)) && (isset($colorValue) && ($colorValue != null) ) && (isset($dimentionValue) && ($dimentionValue != null)) && (isset($minPrice) && ($minPrice != null)) ){
            $condition = $active.$searchWord.$color.$dimention. $priceStatement; 
            $order = 'product_name ASC';
        }else if((isset($searchValue) && ($searchValue != null)) && (isset($colorValue) && ($colorValue != null) ) && (isset($dimentionValue) && ($dimentionValue != null)) ){
            $condition = $active.$searchWord.$color; 
            $order = 'product_name ASC';
        }else if((isset($searchValue) && ($searchValue != null)) && (isset($colorValue) && ($colorValue != null) ) ){
            $condition= $active.$searchWord.$color; 
            $order = 'product_name ASC';
        }else if((isset($searchValue) && ($searchValue != null)) && (isset($colorValue) && ($colorValue != null) ) ){
            $condition = $active. $searchWord .$color; 
            $order = 'product_name ASC';
        }else if((isset($searchValue) && ($searchValue != null)) ){
            $condition = $active.$searchWord; 
            $order = 'product_name ASC';
        }
        $dataProvider = new CActiveDataProvider('Products', array('criteria' => array(
                                'condition' => $condition,
                                'order' => $order,
                            ), 'pagination' => array(
                                'pageSize' => 5,
                            ),));
        return $dataProvider;
    }
    public function actionSearch() {
        $data = new Products;
        $colors = Colors::model()->findAll(array('order' => 'colorName ASC'));
        $colorsArray = CHtml::listData($colors, 'id', 'colorName');
        $resultString = $_GET['search_keyword'];
        $renderAdvancedForm = false;
        if (!empty($_POST["advanced_search_keyword"])) {
            $heading = "Search Results";
            $search = $_POST['advanced_search_keyword'];
            $color = $_POST['color'];
            $dimension = $_POST['dimensions'];
            $minPrice = $_POST['minimum_price'];
            $maxPrice = $_POST['maximum_price'];
            $dataProvider = $this->advancedSearch($search, $color, $dimension, $minPrice, $maxPrice);
            $resultString = $search;
            if (empty($dataProvider)) {
                //$resultString = $search;   
            }
            $this->render('search', array('renderAdvancedForm' => $renderAdvancedForm,'dataProvider' => $dataProvider, 'colorsArray' => $colorsArray, 'model' => $model, 'data' => $data, 'heading' => $heading, 'resultString' => $resultString,
            ));
        } else if ((isset($_GET['searchkeyword']) && !empty($_GET['searchkeyword'])) && $_GET['sort'] != null) {
            $resultString = $_GET['searchkeyword'];
            $sort = $_GET['sort'];
            $sql_color = "color = (SELECT id FROM tbl_colors WHERE colorName LIKE '%" . $resultString . "%')";
            $sql_category = "category_id = (SELECT id FROM tbl_categories WHERE category_name LIKE '%" . $resultString . "%')";
            $sql_dealers = "dealers_id = (SELECT id FROM tbl_dealers WHERE dealer_name LIKE '%" . $resultString . "%' OR trading_as LIKE '%" . $resultString . "%' LIMIT 1) AND active=1";
            $condition = 'active = "1" AND  product_name like "%' . $resultString . '%" OR description like "%' . $resultString . '%" OR product_year="' . $resultString . '" OR ' . $sql_color . ' OR ' . $sql_category . ' OR ' . $sql_dealers;
            $order = $sort . " ASC ";
            $dataProvider = new CActiveDataProvider('Products', array('criteria' => array(
                            'condition' => $condition,
                            'order' => $order,
                        ), 'pagination' => array(
                            'pageSize' => 5,
                        ),));
            //$model = Products::model()->findAll(array('condition' => 'active = "1" AND  product_name like "%'.$resultString.'%" OR description like "%' . $resultString . '%" OR product_year="' . $resultString.'" OR '.$sql_color.' OR '.$sql_category.' OR '.$sql_dealers, "order" =>$sort." ASC " ));

            $this->render('search', array('renderAdvancedForm' => $renderAdvancedForm, 'count_dealers' => $count_dealers, 'colorsArray' => $colorsArray, 'dataProvider' => $dataProvider, 'data' => $data, 'heading' => $heading, 'resultString' => $resultString,
            ));
        }else if (isset($_GET['advanced-search'])) {
            $heading = "Search Results";
            if (empty($dataProvider)) {
                $resultString = $_GET['search_keyword'];
                    $renderAdvancedForm = true;
            }
            $this->render('search', array('renderAdvancedForm' => $renderAdvancedForm, 'colorsArray' => $colorsArray,  'data' => $data, 'heading' => $heading, 'resultString' => $resultString,
            ));
        }
        
    }
    public function actionNormalSearch(){
        $data = new Products;
        $colors = Colors::model()->findAll(array('order' => 'colorName ASC'));
        $colorsArray = CHtml::listData($colors, 'id', 'colorName');
        $resultString = $_GET['search_keyword'];
        $renderAdvancedForm = false;
        if ((isset($_GET['search_keyword']) && $_GET['search_keyword'] != null) || isset($_GET['advanced-search'])) {
            $heading = "Search Results";
            if ($_GET['search_keyword']) {
                $sql_color = "color = (SELECT id FROM tbl_colors WHERE colorName LIKE '%" . $_GET['search_keyword'] . "%')";
                $sql_category = "category_id = (SELECT id FROM tbl_categories WHERE category_name LIKE '%" . $_GET['search_keyword'] . "%')";
                $sql_dealers = "dealers_id = (SELECT id FROM tbl_dealers WHERE dealer_name LIKE '%" . $_GET['search_keyword'] . "%' OR trading_as LIKE '%" . $_GET['search_keyword'] . "%' LIMIT 1) AND active=1";

                $condition = 'active = "1" AND  product_name like "%' . $_GET['search_keyword'] . '%" OR description="' . $_GET['search_keyword'] . '" OR product_year="' . $_GET['search_keyword'] . '" OR ' . $sql_color . ' OR ' . $sql_category . ' OR ' . $sql_dealers;
                $order = 'views DESC';
                $dataProvider = new CActiveDataProvider('Products', array('criteria' => array(
                                'condition' => $condition,
                                'order' => $order,
                            ), 'pagination' => array(
                                'pageSize' => 5,
                            ),));
                //$model = Products::model()->findAll(array('condition' => 'active = "1" AND  product_name like "%'. $_POST['search_keyword'].'%" OR description="' . $_POST['search_keyword'] . '" OR product_year="' . $_POST['search_keyword'].'" OR '.$sql_color.' OR '.$sql_category.' OR '.$sql_dealers, 'order' => 'views DESC'));
            }
            if (empty($dataProvider)) {
                $resultString = $_GET['search_keyword'];
                    $renderAdvancedForm = true;
            }
            $this->render('search', array('renderAdvancedForm' => $renderAdvancedForm, 'colorsArray' => $colorsArray, 'dataProvider' => $dataProvider, 'data' => $data, 'heading' => $heading, 'resultString' => $resultString,
            ));
        }else if ((isset($_GET['searchkeyword']) && !empty($_GET['searchkeyword'])) && $_GET['sort'] != null) {
            $resultString = $_GET['searchkeyword'];
            $sort = $_GET['sort'];
            $sql_color = "color = (SELECT id FROM tbl_colors WHERE colorName LIKE '%" . $resultString . "%')";
            $sql_category = "category_id = (SELECT id FROM tbl_categories WHERE category_name LIKE '%" . $resultString . "%')";
            $sql_dealers = "dealers_id = (SELECT id FROM tbl_dealers WHERE dealer_name LIKE '%" . $resultString . "%' OR trading_as LIKE '%" . $resultString . "%' LIMIT 1) AND active=1";
            $condition = 'active = "1" AND  product_name like "%' . $resultString . '%" OR description like "%' . $resultString . '%" OR product_year="' . $resultString . '" OR ' . $sql_color . ' OR ' . $sql_category . ' OR ' . $sql_dealers;
            $order = $sort . " ASC ";
            $dataProvider = new CActiveDataProvider('Products', array('criteria' => array(
                            'condition' => $condition,
                            'order' => $order,
                        ), 'pagination' => array(
                            'pageSize' => 5,
                        ),));
            //$model = Products::model()->findAll(array('condition' => 'active = "1" AND  product_name like "%'.$resultString.'%" OR description like "%' . $resultString . '%" OR product_year="' . $resultString.'" OR '.$sql_color.' OR '.$sql_category.' OR '.$sql_dealers, "order" =>$sort." ASC " ));

            $this->render('search', array('renderAdvancedForm' => $renderAdvancedForm, 'count_dealers' => $count_dealers, 'colorsArray' => $colorsArray, 'dataProvider' => $dataProvider, 'data' => $data, 'heading' => $heading, 'resultString' => $resultString,
            ));
        }
        
    }
    
     public function actionViewBasket() {
         $basket = Yii::app()->session['basket'];
         
         for($i = 0; $i < count($basket); $i++){
             if($_POST['update_quantity']){
                 $_SESSION['basket'][$_POST['id']]['quantity'] = $_POST['quantity'];
                 $_SESSION['basket'][$_POST['id']]['price'] = $_POST['price']; 
             }
             if(empty($basket[$i])){
                 unset($basket[$i]);
             }
         }
         if(!empty($basket)){
              if($_POST['update_quantity']){
                 $basket[$_POST['id']]['quantity'] = $_POST['quantity'];
                 $basket[$_POST['id']]['price'] = $_POST['price']; 
             }
            $basket = array_values($basket);
         }
         $buyer = User::model()->findByPk(Yii::app()->user->id);
         $this->render('viewBasket', array('buyer'=>$buyer, 'basket'=>$basket));
    }
    
    public function actionCheckout() {
         if(Yii::app()->user->id){
            $model = new Checkout;
            $checkoutHistory = Checkout::model()->findAll(array('condition' =>'status="1" AND user_id = "'.Yii::app()->user->id.'"', "order" =>"date_added ASC " ));
            $user = User::model()->findByPk(Yii::app()->user->id);
            if (!empty($_POST)) {
                $model->attributes = $_POST;
                $model->date_added = date("Y-m-d H:i:s");
                $model->user_id = $_POST['loggedInStatus'] ;
                $model->totalPrice =  $_POST['totalPrice'];
                $model->status =  1;
                $model->description =  "None";
                if($user->voucher_amount > $model->totalPrice || $user->voucher_amount == $model->totalPrice){
                    $user->updateByPk(Yii::app()->user->id,array('voucher_amount'=>$user->voucher_amount - $model->totalPrice  ));
                    if ($model->save()) {
                         $_SESSION['basket'] = array();
                         $to = $user->email_address;
                         $email_message = "Hi ".$user->username."
                         
You received this email because you purchased items from our online store [ Peenza.com ],

                                          
------------------------------------------------
Checkout Details
------------------------------------------------

Name and Surname: $user->username $user->user_surname 
Date & Time: $model->date_added
Total Price: $$model->totalPrice 
Description: $model->description

Please click the link below to confirm

".
Yii::app()->createAbsoluteUrl('site/confirmcheckout', array('email_address' => $user->email_address, 'id'=>$user->id, 'checkoutID'=>$model->id))."

". sha1(mt_rand(10000, 99999).time().$to) 
."  

------------------------------------------------
Regards
Peenza Online
------------------------------------------------
";
                            Yii::app()->mailer->Host = 'localhost';
                            Yii::app()->mailer->IsSMTP();
                            Yii::app()->mailer->From = "info@peenza.com";
                            Yii::app()->mailer->FromName = 'Peenza Online: ';
                            Yii::app()->mailer->AddReplyTo('info@peenza.com');
                            Yii::app()->mailer->AddAddress($to);
                            Yii::app()->mailer->Subject = 'Checkout Details';
                            Yii::app()->mailer->Body = $email_message;
                            Yii::app()->mailer->Send();
                         $this->redirect('index.php?r=site/checkout&checkout=true');
                    } else {
                        $this->redirect('index.php?r=site/viewBasket');
                    }
                 }
            } else {
                if (!empty($_GET['id'])) {
                    $item = Checkout::model()->findByPk($_GET['id']);
                    $item->updateByPk($_GET['id'],array('status'=> 0 ));
                }
                $this->render('checkout', array('checkoutHistory' => $checkoutHistory, 'user'=>$user ));
            }
            }else $this->redirect('index.php?r=site/index&loginrequired');
    }
    
   public function actionConfirmcheckout($id){
        if(Yii::app()->user->id && Yii::app()->user->id == $id){
        	$user = User::model()->findByPk(Yii::app()->user->id);
			$checkOutInfo = Checkout::model()->findByPk($_GET['checkoutID']);
            $to = $user->email_address;
                         $email_message = "
Please keep this as a proof of payment      
                        
------------------------------------------------
Payment Confirmation
------------------------------------------------

Name and Surname: $user->username $user->user_surname 
Date & Time: $checkOutInfo->date_added
Total Price: US$ $checkOutInfo->totalPrice 
Description: $checkOutInfo->description

------------------------------------------------
Regards
Peenza Online
------------------------------------------------
";
                            Yii::app()->mailer->Host = 'localhost';
                            Yii::app()->mailer->IsSMTP();
                            Yii::app()->mailer->From = "info@peenza.com";
                            Yii::app()->mailer->FromName = 'Peenza Online: ';
                            Yii::app()->mailer->AddReplyTo('info@peenza.com');
                            Yii::app()->mailer->AddAddress($to);
							Yii::app()->mailer->AddAddress('info@peenza.com');
                            Yii::app()->mailer->Subject = 'Payment Confirmation';
                            Yii::app()->mailer->Body = $email_message;
                            Yii::app()->mailer->Send();
                         $this->redirect('index.php?r=site/checkout&confirmation=true');
        }
    }

    public function actionViewWishlist() {
        $this->render('viewWishlist');
    }
    
    
    public function actionRemoveWishlistProduct($id) {
        $data = WishList::model()->findByPk($id);
        $data->delete();
	$this->redirect(Yii::app()->request->urlReferrer);
        //$this->render('viewWishlist');
    }
    

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
    
    
    
    public function actionResetpassword() {
        if ($_POST['token']) {
            $model = new Dealers;
            $id = $_POST['id'];
            $token = date("Y-m-d H:i:s", $_POST['token']);
            $email_address = $_POST['email_address'];
            $_POST['password_2'] = md5($_POST['password_2']);
            unset($_POST['confirm_password']);
            unset($_POST['token']);
            unset($_POST['id']);
            $attributes = $model->attributes = $_POST;
            if (Dealers::model()->find('id = ' . $id . ' AND date_added = "' . $token . '"')) {
                if (Dealers::model()->updateByPk($id, $attributes)) {
                    $this->redirect('index.php?r=site/index&reset=true');
                } else {
                    $this->redirect('index.php?r=site/index&reset=true');
                }
            } else {
                $this->redirect('index.php?r=site/index&reset=true');
            }
        } elseif ($_GET['token']) {
            $token = $_GET['token'];
            $id = $_GET['id'];
            $this->redirect('index.php?r=site/index&id='.$id.'&token='.$token);
        } else {
            $email = $_POST['email_address'];
            $userdata = Dealers::model()->find('email_address = "' . $email . '"');
            $token = strtotime($userdata['date_added']);
            $id = $userdata['id'];

            $url = Yii::app()->createAbsoluteUrl('site/resetpassword', array('id' => $id, 'token' => $token));
            $headers = "From: info@peenza.com\r\nReply-To: info@peenza.com";
            $subject = 'Peenza Login';
            $body = 'Hi, 

Click the link below to reset your password or copy and paste the link into your browser.

' . $url . '


Regards
Peenza Online
';
            mail($email, $subject, $body, $headers);

            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }

}