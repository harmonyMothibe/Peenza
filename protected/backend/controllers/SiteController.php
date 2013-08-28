<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

		if(Yii::app()->user->id)
		{
			$this->render('index');
		} else {
			$this->actionLogin();
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(Yii::app()->user->id)
		{
			$this->render('index');
		} else

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
                        
			if($model->validate() && $model->login())
			{
				$this->actionIndex();
			} else {
				$this->render('login',array('model'=>$model));
			}
		} else {
			// display the login form
			$this->render('login',array('model'=>$model));
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('login'));
	}

	public function actionPages()
	{
		$location = $keyword = $date = null;
		if (isset($_POST['location'])) {
			$location = $_POST['location'];
		}
		if (isset($_POST['keyword'])) {
			$location = $_POST['keyword'];
		}
		if (isset($_POST['date'])) {
			$location = $_POST['date'];
		}
		$data = null;
		if (!isset($_POST['keyword'])) {
			$_POST['keyword'] = null;
		}
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if($_POST['scenario'] == 'search' or isset($pages->params['location']) or isset($pages->params['keyword']) or isset($_POST['date'])) {

				if(!empty($location)) {
					if($location == "South Africa") {
						$location_query = 'AND (location LIKE "%'.$location.'%")';
					} else {
						$location_query = 'AND (location NOT LIKE "South Africa")';
					}
				}

				$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'title LIKE "%'.$keyword.'%"', 'order' => 'created_date ASC'));

				$data = Pages::model()->findAll($criteria);

				$pages=new CPagination(count($data));
				$pages->pageSize=20;
				$pages->params=array('location' => $location, 'keyword' => $keyword, 'date' => $date);

			} else {
				$pages=new CPagination(count($data));
				$pages->pageSize=20;
				$criteria=new CDbCriteria(array('select' => '*', 'limit' => 10, 'order' => 'created_date ASC'));
			}

			$dataProvider=new CActiveDataProvider('Pages',array('criteria'=>$criteria, 'pagination'=>$pages)); //'pagination'=>array('pageSize'=>10)
			$this->render('pages',array('dataProvider'=>$dataProvider, 'pages' => $pages));
		} else {
			$this->actionLogin();
		}
	}
	public function actionBankaccounts()
	{
		$location = $keyword = $date = null;
		if (isset($_POST['location'])) {
			$location = $_POST['location'];
		}
		if (isset($_POST['keyword'])) {
			$location = $_POST['keyword'];
		}
		if (isset($_POST['date'])) {
			$location = $_POST['date'];
		}
		$data = null;
		if (!isset($_POST['keyword'])) {
			$_POST['keyword'] = null;
		}
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if($_POST['scenario'] == 'search' or isset($pages->params['location']) or isset($pages->params['keyword']) or isset($_POST['date'])) {

				if(!empty($location)) {
					if($location == "South Africa") {
						$location_query = 'AND (location LIKE "%'.$location.'%")';
					} else {
						$location_query = 'AND (location NOT LIKE "South Africa")';
					}
				}

				$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'title LIKE "%'.$keyword.'%"', 'order' => 'created_date ASC'));

				$data = BankAccounts::model()->findAll($criteria);

				$pages=new CPagination(count($data));
				$pages->pageSize=20;
				$pages->params=array('location' => $location, 'keyword' => $keyword, 'date' => $date);

			} else {
				$pages=new CPagination(count($data));
				$pages->pageSize=20;
				$criteria=new CDbCriteria(array('select' => '*', 'limit' => 10, 'order' => 'created_date ASC'));
			}

			$dataProvider=new CActiveDataProvider('BankAccounts',array('criteria'=>$criteria, 'pagination'=>$pages)); //'pagination'=>array('pageSize'=>10)
			$this->render('bankaccounts',array('dataProvider'=>$dataProvider, 'pages' => $pages));
		} else {
			$this->actionLogin();
		}
	}
        public function actionDealers()
	{
		$location = $keyword = $date = null;
		if (isset($_POST['location'])) {
			$location = $_POST['location'];
		}
		if (isset($_POST['keyword'])) {
			$location = $_POST['keyword'];
		}
		if (isset($_POST['date'])) {
			$location = $_POST['date'];
		}
		$data = null;
		if (!isset($_POST['keyword'])) {
			$_POST['keyword'] = null;
		}
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if($_POST['scenario'] == 'search' or isset($pages->params['location']) or isset($pages->params['keyword']) or isset($_POST['date'])) {

				if(!empty($location)) {
					if($location == "South Africa") {
						$location_query = 'AND (location LIKE "%'.$location.'%")';
					} else {
						$location_query = 'AND (location NOT LIKE "South Africa")';
					}
				}

				$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'dealer_name LIKE "%'.$keyword.'%" AND role=1', 'order' => 'date_added ASC'));

				$data = Dealers::model()->findAll($criteria);

				$pages=new CPagination(count($data));
				$pages->pageSize=20;
				$pages->params=array('location' => $location, 'keyword' => $keyword, 'date' => $date);

			} else {
				$pages=new CPagination(count($data));
				$pages->pageSize=20;
				$criteria=new CDbCriteria(array('select' => '*', 'condition'=>'role=1', 'limit' => 10, 'order' => 'date_added ASC'));
			}

			$dataProvider=new CActiveDataProvider('Dealers',array('criteria'=>$criteria, 'pagination'=>$pages)); //'pagination'=>array('pageSize'=>10)
			$this->render('dealers',array('dataProvider'=>$dataProvider, 'pages' => $pages));
		} else {
			$this->actionLogin();
		}
	}
	public function actionPopups()
	{
		$location = $keyword = $date = null;
		if (isset($_POST['location'])) {
			$location = $_POST['location'];
		}
		if (isset($_POST['keyword'])) {
			$location = $_POST['keyword'];
		}
		if (isset($_POST['date'])) {
			$location = $_POST['date'];
		}
		$data = null;
		if (!isset($_POST['keyword'])) {
			$_POST['keyword'] = null;
		}
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if($_POST['scenario'] == 'search' or isset($popups->params['location']) or isset($popups->params['keyword']) or isset($_POST['date'])) {

				if(!empty($location)) {
					if($location == "South Africa") {
						$location_query = 'AND (location LIKE "%'.$location.'%")';
					} else {
						$location_query = 'AND (location NOT LIKE "South Africa")';
					}
				}

				$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'title LIKE "%'.$keyword.'%"', 'order' => 'created_date ASC'));

				$data = Popups::model()->findAll($criteria);

				$popups=new CPagination(count($data));
				$popups->pageSize=20;
				$popups->params=array('location' => $location, 'keyword' => $keyword, 'date' => $date);

			} else {
				$popups=new CPagination(count($data));
				$popups->pageSize=20;
				$criteria=new CDbCriteria(array('select' => '*', 'limit' => 10, 'order' => 'created_date ASC'));
			}

			$dataProvider=new CActiveDataProvider('Popups',array('criteria'=>$criteria, 'pagination'=>$popups)); //'pagination'=>array('popupSize'=>10)
			$this->render('popups',array('dataProvider'=>$dataProvider, 'popups' => $popups));
		} else {
			$this->actionLogin();
		}
	}
        public function actionCategories()
	{
		$location = $keyword = $date = null;
		if (isset($_POST['location'])) {
			$location = $_POST['location'];
		}
		if (isset($_POST['keyword'])) {
			$location = $_POST['keyword'];
		}
		if (isset($_POST['date'])) {
			$location = $_POST['date'];
		}
		$data = null;
		if (!isset($_POST['keyword'])) {
			$_POST['keyword'] = null;
		}
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if($_POST['scenario'] == 'search' or isset($categories->params['location']) or isset($categories->params['keyword']) or isset($_POST['date'])) {

				if(!empty($location)) {
					if($location == "South Africa") {
						$location_query = 'AND (location LIKE "%'.$location.'%")';
					} else {
						$location_query = 'AND (location NOT LIKE "South Africa")';
					}
				}

				$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'category_name LIKE "%'.$keyword.'%"', 'order' => 'category_name ASC'));

				$data = Categories::model()->findAll($criteria);

				$categories=new CPagination(count($data));
				$categories->pageSize=20;
				$categories->params=array('category_name' => $location, 'keyword' => $keyword, 'date' => $date);

			} else {
				$categories=new CPagination(count($data));
				$categories->pageSize=20;
				$criteria=new CDbCriteria(array('select' => '*', 'limit' => 10, 'order' => 'category_name ASC'));
			}

			$dataProvider=new CActiveDataProvider('Categories',array('criteria'=>$criteria, 'pagination'=>$categories)); //'pagination'=>array('popupSize'=>10)
			$this->render('categories',array('dataProvider'=>$dataProvider, 'categories' => $categories));
		} else {
			$this->actionLogin();
		}
	}
        public function actionColors()
	{
		$location = null;
		
		if (isset($_POST['keyword'])) {
			$colorName = $_POST['keyword'];
		}
		if (!isset($_POST['keyword'])) {
			$_POST['keyword'] = null;
		}
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if($_POST['scenario'] == 'search' or isset($colors->params['location']) or isset($colors->params['keyword'])) {
				$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'colorName LIKE "%'.$keyword.'%"', 'order' => 'colorName ASC'));

				$data = Colors::model()->findAll($criteria);

				$colors=new CPagination(count($data));
				$colors->pageSize=20;
				$colors->params=array('colorName' => $location, 'keyword' => $keyword, 'date' => $date);

			} else {
				$colors=new CPagination(count($data));
				$colors->pageSize=20;
				$criteria=new CDbCriteria(array('select' => '*', 'limit' => 10, 'order' => 'colorName ASC'));
			}

			$dataProvider=new CActiveDataProvider('Colors',array('criteria'=>$criteria, 'pagination'=>$colors)); //'pagination'=>array('popupSize'=>10)
			$this->render('colors',array('dataProvider'=>$dataProvider, 'colors' => $colors));
		} else {
			$this->actionLogin();
		}
	}
         public function actionCities()
	{
		$location = null;
		
		if (isset($_POST['keyword'])) {
			$city_name = $_POST['keyword'];
		}
		if (!isset($_POST['keyword'])) {
			$_POST['keyword'] = null;
		}
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if($_POST['scenario'] == 'search' or isset($cities->params['location']) or isset($cities->params['keyword'])) {
				$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'city_name LIKE "%'.$keyword.'%"', 'order' => 'city_name ASC'));

				$data = Cities::model()->findAll($criteria);

				$cities=new CPagination(count($data));
				$cities->pageSize=20;
				$cities->params=array('city_name' => $location, 'keyword' => $keyword, 'date' => $date);

			} else {
				$cities=new CPagination(count($data));
				$cities->pageSize=20;
				$criteria=new CDbCriteria(array('select' => '*', 'limit' => 10, 'order' => 'city_name ASC'));
			}

			$dataProvider=new CActiveDataProvider('Cities',array('criteria'=>$criteria, 'pagination'=>$colors)); //'pagination'=>array('popupSize'=>10)
			$this->render('cities',array('dataProvider'=>$dataProvider, 'cities' => $cities));
		} else {
			$this->actionLogin();
		}
	}
        
	public function actionAddPage()
	{
		if(Yii::app()->user->id) {
			$model=new Pages;
			//$countries = $model->countries();
			//$country_options = CHtml::listData($countries, 'country_name', 'country_name', $groupField='');
			$this->render('addpage');
		} else {
			$this->actionLogin();
		}
	}
	public function actionAddPopup()
	{
		if(Yii::app()->user->id) {
			$model=new Popups;
			$this->render('addpopup');
		} else {
			$this->actionLogin();
		}
	}
        public function actionAddCategory()
	{
		if(Yii::app()->user->id) {
			$model=new Categories;
			$this->render('addcategory');
		} else {
			$this->actionLogin();
		}
	}
        public function actionAddColor()
	{
		if(Yii::app()->user->id) {
			$model=new Colors;
			$this->render('addcolor');
		} else {
			$this->actionLogin();
		}
	}
        public function actionAddCity()
	{
		if(Yii::app()->user->id) {
			$model=new Cities;
			$this->render('addcity');
		} else {
			$this->actionLogin();
		}
	}
	public function actionSavePage()
	{
		$model=new Pages;

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));

			$_POST['details'] = trim($_POST['page_details']);

			unset($_POST['page_details']);

			$attributes = $model->attributes;

			foreach($attributes as $key=>$val){
				if(isset($_POST[$key])) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/pages');
			} else {
				echo "error";
			}
		} else {
			$this->actionAddPage();
		}
	}
	public function actionSavePopup()
	{
		$model=new Popups;

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));

			$_POST['details'] = trim($_POST['popup_details']);

			unset($_POST['popup_details']);

			$attributes = $model->attributes;

			foreach($attributes as $key=>$val){
				if(isset($_POST[$key])) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/popups');
			} else {
				echo "error";
			}
		} else {
			$this->actionAddPopup();
		}
	}
        public function actionSaveCategory()
	{
		$model=new Categories;

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['category_name'] = strip_tags(trim($_POST['category_name']));

			$_POST['description'] = trim($_POST['description']);

			$attributes = $model->attributes;

			foreach($attributes as $key=>$val){
				if(isset($_POST[$key])) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/categories');
			} else {
				echo "error";
			}
		} else {
			$this->actionAddPopup();
		}
	}
        public function actionSaveColor()
	{
		$model=new Colors;

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['colorName'] = trim($_POST['colorName']);
			$attributes = $model->attributes;

			foreach($attributes as $key=>$val){
				if(isset($_POST[$key])) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/colors');
			} else {
				echo "error";
			}
		} else {
			$this->actionAddPopup();
		}
	}
        public function actionSaveCity()
	{
		$model=new Cities;

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['city_name'] = trim($_POST['city_name']);
			$attributes = $model->attributes;

			foreach($attributes as $key=>$val){
				if(isset($_POST[$key])) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/cities');
			} else {
				echo "error";
			}
		} else {
			$this->actionAddCity();
		}
	}
	public function actionViewPage($id)
	{
		$model=new Pages;
		$data = Pages::model()->findByPk($id);
		$scenario = null;
		$this->render('viewpage',array(
			'model'=>$model,
			'data' => $data,
			'scenario' => $scenario,
		));
	}

	public function actionViewBankAccount($id)
	{
		$model=new BankAccounts;
		$data = BankAccounts::model()->findByPk($id);
		$scenario = null;
		$this->render('viewbankaccount',array(
			'model'=>$model,
			'data' => $data,
			'scenario' => $scenario,
		));
	}
	public function actionViewPopup($id)
	{
		$model=new Popups;
		$data = Popups::model()->findByPk($id);
		$scenario = null;
		$this->render('viewpopup',array(
			'model'=>$model,
			'data' => $data,
			'scenario' => $scenario,
		));
	}
        public function actionViewCategory($id)
	{
		$model=new Categories;
		$data = Categories::model()->findByPk($id);
		$scenario = null;
		$this->render('viewcategory',array(
			'model'=>$model,
			'data' => $data,
			'scenario' => $scenario,
		));
	}
	public function actionViewPageArchive($id)
	{
		$model=new PagesArchive;
		$data = PagesArchive::model()->findByPk($id);
		$this->render('viewpage',array(
			'model'=>$model, 'data' => $data, 'scenario' => 'archive'
		));
	}
	public function actionViewPopupArchive($id)
	{
		$model=new PopupsArchive;
		$data = PopupsArchive::model()->findByPk($id);
		$this->render('viewpopup',array(
			'model'=>$model, 'data' => $data, 'scenario' => 'archive'
		));
	}
	
	public function actionEditPage()
	{
		$postid = $_GET['id'];
		$model=new Pages;
		/*$countries = $model->countries();
		$country_options = CHtml::listData($countries, 'country_name', 'country_name', $groupField='');*/
		$data = Pages::model()->findByPk($postid);
		$this->render('editpage', array('data'=>$data));
	}
	
	public function actionEditBankAccount()
	{
		$postid = $_GET['id'];
		$model=new Pages;
		/*$countries = $model->countries();
		$country_options = CHtml::listData($countries, 'country_name', 'country_name', $groupField='');*/
		$data = BankAccounts::model()->findByPk($postid);
		$this->render('editbankaccount', array('data'=>$data));
	}
	
	public function actionEditPopup()
	{
		$postid = $_GET['id'];
		$model=new Popups;
		/*$countries = $model->countries();
		$country_options = CHtml::listData($countries, 'country_name', 'country_name', $groupField='');*/
		$data = Popups::model()->findByPk($postid);
		$this->render('editpopup', array('data'=>$data));
	}
        public function actionEditCategory()
	{
		$postid = $_GET['id'];
		$model=new Categories;
		$data = Categories::model()->findByPk($postid);
		$this->render('editcategory', array('data'=>$data));
	}
        public function actionEditColor()
	{
		$postid = $_GET['id'];
		$model=new Colors;
		$data = Colors::model()->findByPk($postid);
		$this->render('editcolor', array('data'=>$data));
	}
        public function actionEditCity()
	{
		$postid = $_GET['id'];
		$model=new Cities;
		$data = Cities::model()->findByPk($postid);
		$this->render('editcity', array('data'=>$data));
	}
	public function actionUpdatePage()
	{
		$model=new Pages;
		$postid = $_GET['id'];
		if(!empty($_POST))
		{

			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));
			$_POST['details'] = trim($_POST['page_details']);

			unset($_POST['page_details']);

			$attributes = $model->attributes=$_POST;

			if(Pages::model()->updateByPk($postid, $attributes)) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/pages');
			} else {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/pages');
			}
		} else {
			$this->actionEditPage();
		}
	}
	
	public function actionUpdateBankAccount()
	{
		$model=new BankAccounts;
		$postid = $_GET['id'];
		if(!empty($_POST))
		{

			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));
			$_POST['account_holder'] = trim($_POST['account_holder']);

			#unset($_POST['account_holder']);

			$attributes = $model->attributes=$_POST;

			if(BankAccounts::model()->updateByPk($postid, $attributes)) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/bankaccounts');
			} else {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/bankaccounts');
			}
		} else {
			$this->actionEditBankAccount();
		}
	}
	
	public function actionUpdatePopup()
	{
		$model=new Popups;
		$postid = $_GET['id'];
		if(!empty($_POST))
		{

			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));
			$_POST['details'] = trim($_POST['popup_details']);

			unset($_POST['popup_details']);

			$attributes = $model->attributes=$_POST;

			if(Popups::model()->updateByPk($postid, $attributes)) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/popups');
			} else {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/popups');
			}
		} else {
			$this->actionEditPopup();
		}
	}
        public function actionUpdateCategory()
	{
		$model=new Categories;
		$postid = $_GET['id'];
		if(!empty($_POST))
		{

			//Sanitize post data
			$_POST['category_name'] = strip_tags(trim($_POST['category_name']));
			$_POST['description'] = trim($_POST['description']);

			$attributes = $model->attributes=$_POST;

			if(Categories::model()->updateByPk($postid, $attributes)) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/categories');
			} else {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/categories');
			}
		} else {
			$this->actionEditCategory();
		}
	}
        
        public function actionUpdateColor()
	{
		$model=new Colors;
		$postid = $_GET['id'];
		if(!empty($_POST))
		{
			$_POST['colorName'] = trim($_POST['colorName']);

			$attributes = $model->attributes=$_POST;

			if(Colors::model()->updateByPk($postid, $attributes)) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/colors');
			} else {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/colors');
			}
		} else {
			$this->actionEditColor();
		}
	}
        public function actionUpdateCity()
	{
		$model=new Cities;
		$postid = $_GET['id'];
		if(!empty($_POST))
		{
			$_POST['city_name'] = trim($_POST['city_name']);

			$attributes = $model->attributes=$_POST;

			if(Cities::model()->updateByPk($postid, $attributes)) {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/cities');
			} else {
				//$this->actionPages();
				$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/cities');
			}
		} else {
			$this->actionEditCity();
		}
	}
	public function actionArchivePage($id)
	{
		$scenario = null;
		if (isset($_POST['scenario'])) {
			$scenario = $_POST['scenario'];
		}

		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			if($scenario == 'unarchive'){
				$model=new Pages;
				$archive_model=new PagesArchive;

				$data = PagesArchive::model()->findByPk($id);

				$attributes = $archive_model->attributes;
				foreach($attributes as $key=>$val){
					$model->$key = $data[$key];
				}

				if($model->save()) {
					$data = PagesArchive::model()->findByPk($id);
					$data->delete();
					$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/pagesarchive');
				}
			} else {

				$model=new PagesArchive;

				$data = Pages::model()->findByPk($id);
				$attributes = $model->attributes;
				foreach($attributes as $key=>$val){
					$model->$key = $data[$key];
				}

				if($model->save()) {
					$data->delete();
					$this->redirect(Yii::app()->request->urlReferrer);
				}
			}
		} else {
			$this->redirect("backend.php/site/pages");
		}
	}
	
	public function actionArchivePopup($id)
	{
		$scenario = null;
		if (isset($_POST['scenario'])) {
			$scenario = $_POST['scenario'];
		}

		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			if($scenario == 'unarchive'){
				$model=new Popups;
				$archive_model=new PopupsArchive;

				$data = PopupsArchive::model()->findByPk($id);

				$attributes = $archive_model->attributes;
				foreach($attributes as $key=>$val){
					$model->$key = $data[$key];
				}

				if($model->save()) {
					$data = PopupsArchive::model()->findByPk($id);
					$data->delete();
					$this->redirect(Yii::app()->request->baseUrl.'/backend.php/site/popupsarchive');
				}
			} else {

				$model=new PopupsArchive;

				$data = Popups::model()->findByPk($id);
				$attributes = $model->attributes;
				foreach($attributes as $key=>$val){
					$model->$key = $data[$key];
				}

				if($model->save()) {
					$data->delete();
					$this->redirect(Yii::app()->request->urlReferrer);
				}
			}
		} else {
			$this->redirect("backend.php/site/popups");
		}
	}

	public function actionPagesArchive()
	{
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if (!isset($_POST['keyword'])) {
				$_POST['keyword'] = null;
			}
			if($_POST['scenario'] == 'search') {
				$keyword = $_POST['keyword'];

				$criteria=new CDbCriteria(array('condition' => 'title LIKE "%'.$keyword.'%" OR details LIKE "%'.$keyword.'%"', 'order' => 'created_date DESC'));
			} else {
				$criteria=new CDbCriteria(array('select' => '*', 'order' => 'created_date DESC'));
			}
			$dataProvider=new CActiveDataProvider('PagesArchive',array('criteria'=>$criteria));
			$this->render('pagesarchive',array('dataProvider'=>$dataProvider));
		} else {
			$this->actionLogin();
		}
	}
	public function actionPopupsArchive()
	{
		if(Yii::app()->user->id)
		{
			if (!isset($_POST['scenario'])) {
				$_POST['scenario'] = null;
			}
			if (!isset($_POST['keyword'])) {
				$_POST['keyword'] = null;
			}
			if($_POST['scenario'] == 'search') {
				$keyword = $_POST['keyword'];

				$criteria=new CDbCriteria(array('condition' => 'title LIKE "%'.$keyword.'%" OR details LIKE "%'.$keyword.'%"', 'order' => 'created_date DESC'));
			} else {
				$criteria=new CDbCriteria(array('select' => '*', 'order' => 'created_date DESC'));
			}
			$dataProvider=new CActiveDataProvider('PopupsArchive',array('criteria'=>$criteria));
			$this->render('popupsarchive',array('dataProvider'=>$dataProvider));
		} else {
			$this->actionLogin();
		}
	}
	public function actionDeletePage($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new PagesArchive;
			$data = PagesArchive::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/site/pages");
		}
	}
	public function actionDeletePopup($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new PopupsArchive;
			$data = PopupsArchive::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/site/popups");
		}
	}
        public function actionDeleteColor($id)
	{
		if(Yii::app()->user->role == "admin") {	
			$data = Colors::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/site/colors");
		}
	}
        public function actionDeleteCity($id)
	{
		if(Yii::app()->user->role == "admin") {	
			$data = Cities::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/site/cities");
		}
	}
        public function actionDeleteDealer($id)
	{
		if(Yii::app()->user->role == "admin") {	
			$data = Dealers::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/site/dealers");
		}
	}
         public function actionDeleteCategory($id)
	{
		if(Yii::app()->user->role == "admin") {	
			$data = Categories::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/site/categories");
		}
	}
	public function actionActivatePage($id)
	{
		$model=new Pages;
		if($model->updateByPk($id,array('active'=>'1')));
			$this->actionPages();
	}
        public function actionActivateDealer($id)
	{
		$model=new Dealers;
		if($model->updateByPk($id,array('active'=>'1')));
			$this->actionDealers();
	}
	public function actionActivatePopup($id)
	{
		$model=new Popups;
		if($model->updateByPk($id,array('active'=>'1')));
			$this->actionPopups();
	}
	public function actionDeactivatePage($id)
	{
		$model=new Pages;
		if($model->updateByPk($id,array('active'=>'0')));
			$this->actionPages();
	}
        public function actionDeactivateDealer($id)
	{
		$model=new Dealers;
		if($model->updateByPk($id,array('active'=>'0')));
			$this->actionDealers();
	}
	public function actionDeactivatePopup($id)
	{
		$model=new Popups;
		if($model->updateByPk($id,array('active'=>'0')));
			$this->actionPopups();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}


	public function actionValidate_username()
	{
		$username = $_GET['username_value'];
		$result = Yii::app()->db->createCommand()
		->select('username')
		->from('tbl_user')
		->where('username="'.$username.'"')
		->queryRow();

		if($result) {
			echo "Username is unavailable";
		} else {
			echo "Username is available";
		}
	}

	public function actionValidate_email()
	{
		$email = $_GET['email_value'];
		$result = Yii::app()->db->createCommand()
		->select('email')
		->from('tbl_user')
		->where('email="'.$email.'"')
		->queryRow();

		if($result) {
			echo "Email is unavailable";
		} else {
			echo "Email is available";
		}
	}


	public function actionArchive($id)
	{
		$scenario = $_GET['scenario'];
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			if($scenario == 'unarchive'){
				$model=new Candidates;
				$archive_model=new CandidatesArchive;

				$data = CandidatesArchive::model()->findByPk($id);
				unset($data['id']);
				$attributes = $archive_model->attributes;
				foreach($attributes as $key=>$val){
					$model->$key = $data[$key];
				}

				if($model->save()) {
					$data = CandidatesArchive::model()->findByPk($id);
					$data->delete();
					$this->actionCandidatesarchive();
				}
			} else {
				$model=new CandidatesArchive;

				$data = Candidates::model()->findByPk($id);
				$attributes = $model->attributes;
				foreach($attributes as $key=>$val){
					$model->$key = $data[$key];
				}

				if($model->save()) {
					$data->delete();
					$this->redirect(Yii::app()->request->urlReferrer);
				}
			}
		} else {
			$this->redirect("backend.php/site/candidates");
		}
	}

	public function actionDelete($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new CandidatesArchive;
			$data = CandidatesArchive::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/site/candidates");
		}
	}
}