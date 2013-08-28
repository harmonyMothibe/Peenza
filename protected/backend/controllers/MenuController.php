<?php

class MenuController extends Controller
{
	public function actionIndex()
	{
		if(Yii::app()->user->id)
		{
			$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'parent_id = 0', 'order' => 'sort_order ASC', 'limit' => '10'));
			$dataProvider=new CActiveDataProvider('Menus',array('criteria'=>$criteria, 'pagination'=> false)); //'pagination'=>array('pageSize'=>10)

			$childitems = Yii::app()->getDb()->createCommand();
			$childitems->selectDistinct('parent_id')->from('tbl_menus');
			$childitems->where('parent_id > 0 ');
			$childitems->order('sort_order ASC');
			$childitems = $childitems->queryAll();

			$parentitems = Yii::app()->getDb()->createCommand();
			$parentitems->selectDistinct('id, title')->from('tbl_menus');
			$parentitems->where('active = 1 AND parent_id = 0');
			$parentitems->order('sort_order ASC');
			$parentitems = $parentitems->queryAll();

			foreach($parentitems as $parentitem) {
				foreach($childitems as $childitem) {
					if($childitem['parent_id'] == $parentitem['id']) {
						$parent_array[] = array('id'=>$parentitem['id'], 'title'=>$parentitem['title']);
					}
				}
			}
			if(!empty($parent_array)) {
				$parentitems = CHtml::listData($parent_array, 'id', 'title', $groupField='');
			} else {
				$parentitems = array();
			}
			$this->render('index',array('dataProvider'=>$dataProvider, 'parentitems'=>$parentitems));
		} else {
			$this->actionLogin();
		}
	}

	public function actionSubMenus($menu_id=null)
	{

		if(!empty($_POST['parent_id'])) {
			$menu_id = $_POST['parent_id'];
		} elseif(!empty($_GET['parent_id'])) {
			$menu_id = $_GET['parent_id'];
		} else {
			$this->actionIndex();
			exit;
		}

		if(Yii::app()->user->id)
		{
			$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'parent_id = '.$menu_id, 'order' => 'sort_order ASC', 'limit' => '10'));
			$dataProvider=new CActiveDataProvider('Menus',array('criteria'=>$criteria, 'pagination'=> false)); //'pagination'=>array('pageSize'=>10)

			$childitems = Yii::app()->getDb()->createCommand();
			$childitems->selectDistinct('parent_id')->from('tbl_menus');
			$childitems->where('parent_id > 0 ');
			$childitems->order('sort_order ASC');
			$childitems = $childitems->queryAll();

			$parentitems = Yii::app()->getDb()->createCommand();
			$parentitems->selectDistinct('id, title')->from('tbl_menus');
			$parentitems->where('active = 1 AND parent_id = 0');
			$parentitems->order('sort_order ASC');
			$parentitems = $parentitems->queryAll();

			foreach($parentitems as $parentitem) {
				foreach($childitems as $childitem) {
					if($childitem['parent_id'] == $parentitem['id']) {
						$parent_array[] = array('id'=>$parentitem['id'], 'title'=>$parentitem['title']);
					}
				}
			}
			$parentitems = CHtml::listData($parent_array, 'id', 'title', $groupField='');

			$parent_title = Yii::app()->getDb()->createCommand();
			$parent_title->select('title')->from('tbl_menus');
			$parent_title->where('active = 1 AND id = '.$menu_id);
			$parent_title = $parent_title->queryRow();

			$this->render('submenus',array('dataProvider'=>$dataProvider, 'parentitems'=>$parentitems, 'parent_title'=>$parent_title));
		} else {
			$this->actionLogin();
		}
	}

	public function actionAdd()
	{
		$model=new Menus;
		$content_pages = $model->get_pages();
		$gallery_albums = $model->get_albums();

		$menus = $model->get_menus();
		$parent_menus = CHtml::listData($menus, 'id', 'title', $groupField='');
		$pages = CHtml::listData($content_pages, 'id', 'title', $groupField='');
		$albums = CHtml::listData($gallery_albums, 'id', 'title', $groupField='');

		$data = array(
			'parent_id'=>null,
		);

		$this->render('add', array(
			'parent_menus'=>$parent_menus,
			'pages'=>$pages,
			'albums'=>$albums,
			'data'=>$data,
		));
	}

	public function actionSave()
	{
		$model=new Menus;

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));
			$attributes = $model->attributes=$_POST;

			if(!empty($_POST['gallery_id'])) {
				$_POST['page_id'] = $_POST['gallery_id'];
				unset($_POST['gallery_id']);
			}

			foreach($attributes as $key=>$val){
				if($_POST[$key]) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				$this->actionIndex();
			} else {
				$this->actionIndex();
			}
		} else {
			$this->actionAdd();
		}
	}

	public function actionEdit()
	{
		$menuid = $_GET['id'];
		$model=new Menus;
		$data = Menus::model()->findByPk($menuid);
		$menus = $model->get_menus();
		$parent_menus = CHtml::listData($menus, 'id', 'title', $groupField='');
		$content_pages = $model->get_pages();
		$gallery_albums = $model->get_albums();

		$pages = CHtml::listData($content_pages, 'id', 'title', $groupField='');
		$albums = CHtml::listData($gallery_albums, 'id', 'title', $groupField='');

		//Check for child menu items
		$childitems = Yii::app()->getDb()->createCommand();
		$childitems->selectDistinct('parent_id')->from('tbl_menus');
		$childitems->where('active = 1 AND parent_id = '.$menuid);
		$childitems = $childitems->queryAll();
		$haschild = count($childitems);

		$this->render('edit', array('data'=>$data, 'parent_menus'=>$parent_menus, 'pages'=>$pages, 'albums'=>$albums, 'haschild'=>$haschild));
	}

	public function actionUpdate()
	{
		$model=new Menus;
		$menuid = $_GET['id'];

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));
			if(!empty($_POST['gallery_id'])) {
				$_POST['page_id'] = $_POST['gallery_id'];
				unset($_POST['gallery_id']);
			}

			$attributes = $model->attributes=$_POST;

			if(Menus::model()->updateByPk($menuid, $attributes)) {
				$this->actionIndex();
			} else {
				$this->actionIndex();
			}
		} else {
			$this->actionEdit();
		}
	}

	public function actionView($id)
	{
		$model=new Blog;
		$data = Blog::model()->findByPk($id);
		$this->render('view',array(
			'model'=>$model, 'data' => $data
		));
	}

	public function actionViewArchive($id)
	{
		$model=new BlogArchive;
		$data = BlogArchive::model()->findByPk($id);
		$this->render('view',array(
			'model'=>$model, 'data' => $data, 'scenario' => 'archive'
		));
	}

	public function actionArchive($id)
	{
		$scenario = $_GET['scenario'];

		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			if($scenario == 'unarchive'){
				$model=new Blog;
				$archive_model=new BlogArchive;

				$data = BlogArchive::model()->findByPk($id);

				unset($data['id']);
				$attributes = $archive_model->attributes;
				foreach($attributes as $key=>$val){
					$model->$key = $data[$key];
				}

				if($model->save()) {
					$data = BlogArchive::model()->findByPk($id);
					$data->delete();
					$this->redirect(Yii::app()->request->baseUrl.'/backend.php/blog/archives');
				}
			} else {
				$model=new BlogArchive;

				$data = Blog::model()->findByPk($id);
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
			$this->redirect("backend.php/blog");
		}
	}

	public function actionDelete($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new Menus;
			$data = Menus::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/menus");
		}
	}

	public function actionDeleteArchive($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$model=new BlogArchive;
			$data = BlogArchive::model()->findByPk($id);
			$data->delete();
			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/blog");
		}
	}

	public function actionActivate($id)
	{
		$model=new Menus;
		if($model->updateByPk($id,array('active'=>'1')));

		if($_GET['parent_id']){
			$this->actionSubMenus($_GET['parent_id']);
		} else {
			$this->actionIndex();
		}
	}

	public function actionDeactivate($id)
	{
		$model=new Menus;
		if($model->updateByPk($id,array('active'=>'0')));

		if($_GET['parent_id']){
			$this->actionSubMenus($_GET['parent_id']);
		} else {
			$this->actionIndex();
		}
	}

	public function actionSort()
	{
		if (isset($_POST['items']) && is_array($_POST['items'])) {
			$i = 0;
			foreach ($_POST['items'] as $item) {
				$data = Menus::model()->findByPk($item);
				$data->sort_order = $i;
				$data->save();
				$i++;
			}
		}
	}

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}