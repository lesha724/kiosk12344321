<?php

class SiteController extends Controller
{

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

    public function actionUserPhoto()
    {
        $id   = Yii::app()->request->getParam('_id', null);
        $type = Yii::app()->request->getParam('type', null);

        if (is_null($id) || is_null($type))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        Users::model()->renderPhoto($id, $type);
    }
}