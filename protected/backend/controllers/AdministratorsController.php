<?php

class AdministratorsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','search','active','deactivate','delete'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new Administrators;
			$data = User::model()->findByPk($id);
			$this->render('view',array(
				'model'=>$model, 'data' => $data
			));
		} else {
			$this->redirect("backend.php");
		}
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new Administrators;
			
			if(!empty($_POST)) {	
				$password_clear = $_POST['password_2'];
				$_POST['password_2'] = md5($_POST['password_2']);
				$_POST['active'] = 1;
				$_POST['role'] = 'admin';
                                $_POST['email_address'] = $_POST['email'];  
				unset($_POST['confirm_password']);
				$model->attributes=$_POST;
                                $model->date_added = date("Y-m-d H:i:s");
                                
				//print_r($model->attributes); exit;
				if($model->save()) {
					require_once('assets/phpmailer/class.phpmailer.php');

					//Email notification to new admin
					$message = "Dear ".$_POST['first_name']." ".$_POST['last_name'].",<br /><br />";
					$message .= "You have been successfully registered as an adminsitrator on the ".$this->pageTitle=Yii::app()->name." website! Please find your login details below:<br /><br />";
					$message .= "Login Url: <a href='http://www.peenza.co.za/admin'>http://www.peenza.co.za/admin</a><br />";
					$message .= "Username: ".$_POST['user_name']."<br />";
					$message .= "Password: ".$password_clear."<br /><br />";
					$message .= "Regards,<br />";
					$message .= "Peenza Online Shopping Experience<br />";
				
					$mail = new phpmailer();

					$toname = $_POST['first_name']." ".$_POST['last_name'];
					$toemail = $_POST['email'];
					$fromname = 'Peenza Online Shopping Experience';
					$fromemail = 'info@peenza.co.za';
					$subject = 'Peenza Online Shopping Experience Website access';

					$mail->From     = $fromemail;
					$mail->FromName = $fromname;
					$mail->IsSMTP();
					$mail->Host = "85.10.215.172";
					$mail->Port = 587;
					$mail->SMTPAuth = true;
					$mail->Username = "auth@peenza.co.za";
					$mail->Password = "auth!5699";

					$mail->IsHTML(true); // send as HTML
					$mail->AddAddress($toemail, $toname);
					$mail->Subject = $subject;
					$mail->Body = $message;
					
					if(!$mail->Send()) {
						//echo "Mailer Error: " . $mail->ErrorInfo;
					}

					$this->redirect(Yii::app()->request->baseUrl.'/backend.php/administrators/index');
				}
			}
			$this->render('create',array(
				'model'=>$model,
			));
		} else {
			$this->redirect(Yii::app()->request->baseUrl.'/backend.php');
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new Administrators;
			$id = $_GET['id'];

			if($update=Administrators::model()->findByPk($_POST['administrators_id']))
			{
				if($_POST['password_2']) {
					$_POST['password_2'] = md5($_POST['password_2']);
				} else {
					unset($_POST['password_2']);
				}
				$_POST['updated'] = date("Y-m-d H:i:s");
                                //$_POST['email_address'] = $_POST['email']; 
				$_POST['active'] = 1;
				
				$_POST['role'] = 'admin';
				unset($_POST['confirm_password']);
				
				$attributes = $model->attributes=$_POST;
				
				if(Administrators::model()->updateByPk($_POST['administrators_id'],$attributes))
				{
					$this->redirect(Yii::app()->request->baseUrl.'/backend.php/administrators/index');
				}
			}
			$adminsArray = Administrators::model()->find('id=:id', array(':id'=>$id));
			
			$this->render('update',array(
				'model'=>$model, 'adminsarray' => $adminsArray,
			));
		} else {
			$this->redirect("backend.php");
		}
	}

	public function actionActive($id)
	{
		$model=$this->loadModel($id);
		if($model->updateByPk($id,array('active'=>'1'))); 
			$this->redirect(Yii::app()->request->urlReferrer);
	}

	public function actionDeactivate($id)
	{
		$model=$this->loadModel($id);
		if($model->updateByPk($id,array('active'=>'0'))); 
			$this->redirect(Yii::app()->request->urlReferrer);
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new Administrators;
			$data = Administrators::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php");
		}
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$criteria=new CDbCriteria(array
			(
				'condition' => 'role = "admin"'
			));
			$dataProvider=new CActiveDataProvider('User', array('criteria'=>$criteria));
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		} else {
			$this->redirect("backend.php");
		}
	}

	/**
	 * Search models.
	 */
	public function actionSearch()
	{
		$keyword = $_POST['keyword'];

		$model = "Administrators";
		$view = "index";
		
		$dataProvider=new CActiveDataProvider($model, array(
		'criteria'=>array(
			'condition'=>'first_name LIKE "%'.$keyword.'%" OR last_name LIKE "%'.$keyword.'%" OR email LIKE "%'.$keyword.'%"',
			'order'=>'first_name DESC',
		),
		'pagination'=>array(
			'pageSize'=>10,
		),
		));
		
		$this->render($view,array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Administrators::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
