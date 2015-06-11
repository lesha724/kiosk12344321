<?php

class OtherController extends Controller
{

    public function actionPhones()
    {
        $department = Yii::app()->request->getParam('department', null);

        $phones = Tso::model()->getAllPhonesInArray($department);

        $this->render('phones', array(
            'phones' => $phones,
            'department' => $department
        ));
    }

}