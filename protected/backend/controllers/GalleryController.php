<?php

class GalleryController extends Controller
{
	public function actionIndex()
	{
		if(Yii::app()->user->id)
		{
			$criteria=new CDbCriteria(array('select' => '*', 'order' => 'sort_order ASC', 'limit' => '10'));
			$dataProvider=new CActiveDataProvider('GalleryAlbums',array('criteria'=>$criteria, 'pagination'=> false)); //'pagination'=>array('pageSize'=>10)

			$this->render('index',array('dataProvider'=>$dataProvider));
		} else {
			$this->actionLogin();
		}
	}

	public function actionAdd()
	{
		$model=new GalleryAlbums;
		$this->render('add');
	}

	public function actionSave()
	{
		$model=new GalleryAlbums;

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));
			$attributes = $model->attributes=$_POST;

			foreach($attributes as $key=>$val){
				if($_POST[$key]) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				$id = Yii::app()->db->getLastInsertId();
				mkdir("images/gallery/photos_".$id);

				$model->updateByPk($id,array('image_folder'=>'photos_'.$id));
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
		$id = $_GET['id'];
		$data = GalleryAlbums::model()->findByPk($id);

		$this->render('edit', array('data'=>$data));
	}

	public function actionUpdate()
	{
		$model=new GalleryAlbums;
		$id = $_GET['id'];

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['title'] = strip_tags(trim($_POST['title']));
			$attributes = $model->attributes=$_POST;

			if(GalleryAlbums::model()->updateByPk($id, $attributes)) {
				$this->actionIndex();
			} else {
				$this->actionIndex();
			}
		} else {
			$this->actionEdit();
		}
	}

	public function actionDelete($id)
	{
		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$dir = "images/gallery/photos_".$id."/";
			$handle = opendir($dir);
			while ($obj = readdir($handle)) {
				if ($obj != '.' && $obj != '..') {
					unlink($dir.$obj);
				}
			}
			closedir($handle);
			rmdir("images/gallery/photos_".$id);

			$model=new GalleryAlbums;
			$data = GalleryAlbums::model()->findByPk($id);
			$data->delete();

			//Delete all photos
			$photosmodel=new GalleryAlbumPhotos;
			$photosmodel->deleteAll('album_id = '.$id);

			$this->redirect(Yii::app()->request->urlReferrer);
		} else {
			$this->redirect("backend.php/gallery");
		}
	}

	public function actionActivate($id)
	{
		$model=new GalleryAlbums;
		if($model->updateByPk($id,array('active'=>'1')));

		$this->actionIndex();
	}

	public function actionDeactivate($id)
	{
		$model=new GalleryAlbums;
		if($model->updateByPk($id,array('active'=>'0')));

		$this->actionIndex();
	}

	public function actionSetDefault($id)
	{
		$model=new GalleryAlbums;
		$model->updateByPk($id,array('default_slider'=>'1'));

		// Reset all others to 0
		$query = Yii::app()->getDb()->createCommand();
		$query->update('tbl_gallery_albums', array('default_slider'=>'0'), 'id != '.$id);
		$query->execute();

		$this->actionIndex();
	}


	public function actionSort()
	{
		if (isset($_POST['items']) && is_array($_POST['items'])) {
			$i = 0;
			foreach ($_POST['items'] as $item) {
				$data = GalleryAlbums::model()->findByPk($item);
				$data->sort_order = $i;
				$data->save();
				$i++;
			}
		}
	}

	//MANAGE PHOTOS

	public function actionManagePhotos()
	{
		if(Yii::app()->user->id)
		{
			$album_id = $_GET['album_id'];

			$criteria=new CDbCriteria(array('select' => '*', 'condition' => 'album_id = '.$album_id, 'order' => 'sort_order ASC', 'limit' => '10'));
			$dataProvider=new CActiveDataProvider('GalleryAlbumPhotos',array('criteria'=>$criteria, 'pagination'=> false)); //'pagination'=>array('pageSize'=>10)

			$album_title = Yii::app()->getDb()->createCommand();
			$album_title->select('title')->from('tbl_gallery_albums');
			$album_title->where('active = 1 AND id = '.$album_id);
			$album_title = $album_title->queryRow();

			$this->render('managephotos',array('dataProvider'=>$dataProvider, 'album_id'=>$album_id, 'album_title'=>$album_title));
		} else {
			$this->actionLogin();
		}
	}

	public function actionAddPhoto($id)
	{
		$model=new GalleryAlbumPhotos;
		$this->render('addphotos', array('album_id'=>$id));
	}

	/** Get a list of supported image types and their associated  image creation function name **/
	protected function getSupportedImageTypes() {
		return array(
			'image/png'=>'imagecreatefrompng',
			'image/jpeg'=>'imagecreatefromjpeg',
			'image/jpg'=>'imagecreatefromjpeg',
			'image/gif'=>'imagecreatefromgif',
		);
	}

	public function actionSavePhoto()
	{
		$model=new GalleryAlbumPhotos;
		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['file_name'] = $_FILES['image_file']['name'];
			$_POST['caption'] = strip_tags(trim($_POST['caption']));
			$attributes = $model->attributes=$_POST;

			foreach($attributes as $key=>$val){
				if($_POST[$key]) {
					$model->$key = $_POST[$key];
				}
			}

			if($model->save()) {
				$id = $_POST['album_id'];

				if (isset($_FILES['image_file']))  // file was send from browser
				{
					$savepath = dirname(dirname(Yii::app()->basePath))."/images/gallery/photos_".$id."/";
					$filename = $_FILES['image_file']['name'];

					move_uploaded_file($_FILES['image_file']['tmp_name'], $savepath.$filename);

					// Set a maximum height and width
					$width = 970;
					$height = 215;

					// Get new dimensions
					list($width_orig, $height_orig) = getimagesize($savepath.$filename);

					$ratio_orig = $width_orig/$height_orig;

					if ($width/$height > $ratio_orig) {
						$width = $height*$ratio_orig;
					} else {
					    $height = $width/$ratio_orig;
					}

					$imgTypes = $this->getSupportedImageTypes();
					$imgCreateFunction = $imgTypes[$_FILES['image_file']['type']];

					// Resample
					$image_p = imagecreatetruecolor($width, $height);
					//$image = imagecreatefromjpeg($savepath.$filename);
					$image = $imgCreateFunction($savepath.$filename);

					$target = $savepath.$filename;
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
					imagejpeg($image_p, $target, 100);
				}
				$this->actionManagePhotos();
			} else {
				$this->actionManagePhotos();
			}
		} else {
			$this->actionAdd();
		}
	}

	public function actionEditPhoto()
	{
		$id = $_GET['id'];
		$album_id = $_GET['album_id'];
		$data = GalleryAlbumPhotos::model()->findByPk($id);

		$this->render('editphoto', array('data'=>$data, 'album_id'=>$album_id));
	}

	public function actionSortPhotos()
	{
		if (isset($_POST['items']) && is_array($_POST['items'])) {
			$i = 0;
			foreach ($_POST['items'] as $item) {
				$data = GalleryAlbumPhotos::model()->findByPk($item);
				$data->sort_order = $i;
				$data->save();
				$i++;
			}
		}
	}

	public function actionUpdatePhoto()
	{
		$model=new GalleryAlbumPhotos;
		$id = $_GET['id'];
		$album_id = $_GET['album_id'];

		//Old image file name
		$old_image = $_POST['old_image'];
		if($_GET['id'] == 13){
			$old_image  ='register.png';
		}
		if($_GET['id'] == 12){
			$old_image  ='addProduct.png';
		}
		unset($_POST['old_image']);

		if(!empty($_POST))
		{
			//Sanitize post data
			$_POST['caption'] = strip_tags(trim($_POST['caption']));
			if (empty($_FILES['image_file']['name']))
			{
				unset($_FILES);
			} else {
				$_POST['file_name'] = $_FILES['image_file']['name'];
				if($_GET['id'] == 13){
					$_POST['file_name']  ='register.png';
				}
				if($_GET['id'] == 12){
					$_POST['file_name']  ='addProduct.png';
				}
			}
			
			$attributes = $model->attributes=$_POST;
			
			GalleryAlbumPhotos::model()->updateByPk($id, $attributes);

				if (!empty($_FILES['image_file']['name']))  // file was send from browser
				{
					$savepath = "images/gallery/photos_".$album_id."/";
					$filename = $_FILES['image_file']['name'];
					if($_GET['id'] == 13){
						$filename  ='register.png';
					}
					if($_GET['id'] == 12){
						$filename  ='addProduct.png';
					}
					unlink($savepath.$old_image);
					move_uploaded_file($_FILES['image_file']['tmp_name'], $savepath.$filename);

					// Set a maximum height and width
					$width = 970;
					$height = 215;

					// Get new dimensions
					list($width_orig, $height_orig) = getimagesize($savepath.$filename);

					$ratio_orig = $width_orig/$height_orig;

					if ($width/$height > $ratio_orig) {
						$width = $height*$ratio_orig;
					} else {
					    $height = $width/$ratio_orig;
					}

					$imgTypes = $this->getSupportedImageTypes();
					$imgCreateFunction = $imgTypes[$_FILES['image_file']['type']];

					// Resample
					$image_p = imagecreatetruecolor($width, $height);
					//$image = imagecreatefromjpeg($savepath.$filename);
					$image = $imgCreateFunction($savepath.$filename);

					$target = $savepath.$filename;
					imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
					imagejpeg($image_p, $target, 100);
				}

			$this->actionManagePhotos();
		} else {
			$this->actionEditPhoto();
		}
	}

	public function actionDeletePhoto($id)
	{
		$album_id = $_GET['album_id'];

		if(Yii::app()->user->role == "admin") {		// Simple Role Based Authentication check
			$data = GalleryAlbumPhotos::model()->findByPk($id);
			$data->delete();

			//Delete all photos from file system
			$savepath = "images/gallery/photos_".$album_id."/";
			$filename = $data['file_name'];
			unlink($savepath.$filename);

			$this->actionManagePhotos($album_id);
		} else {
			$this->redirect("backend.php/gallery");
		}
	}
}