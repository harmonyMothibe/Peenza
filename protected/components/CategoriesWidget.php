<?php 

class CategoriesWidget extends CWidget {

    public function run() {
        $models = Categories::model()->findAll();
        $this->render('categories', array(
            'models'=>$models   
        ));
    }
}
?>