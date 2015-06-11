<?php

class TimeTableController extends Controller
{
    public $defaultAction = 'teacher';

    public function actionTeacher()
    {
        $model = new TimeTableForm;
        $model->scenario = 'teacher';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = array();
        if (! empty($model->teacher))
            list($minMax, $timeTable) = $model->generateTeacherTimeTable();


        $this->render('teacher', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function actionGroup()
    {
        $model = new TimeTableForm;
        $model->scenario = 'group';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = $maxLessons = array();
        if (! empty($model->group))
            list($minMax, $timeTable, $maxLessons) = $model->generateGroupTimeTable();


        $this->render('group', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'maxLessons' => $maxLessons,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function actionStudent()
    {
        $model = new TimeTableForm;
        $model->scenario = 'student';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = $maxLessons = array();
        if (! empty($model->student))
            list($minMax, $timeTable) = $model->generateStudentTimeTable();


        $this->render('student', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function actionClassroom()
    {
        $model = new TimeTableForm;
        $model->scenario = 'classroom';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = $maxLessons = array();
        if ($model->validate())
            list($minMax, $timeTable) = $model->generateClassroomTimeTable();


        $this->render('classroom', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function actionFreeClassroom()
    {
        $model = new TimeTableForm;
        $model->scenario = 'free-classroom';

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $classrooms = $occupiedRooms = array();
        if (isset($_REQUEST['TimeTableForm'])){

            $model->attributes=$_REQUEST['TimeTableForm'];

            if ($model->validate()) {
                $classrooms    = A::model()->getClassRooms($model->filial, $model->housing);
                $occupiedRooms = A::model()->getOccupiedRooms($model);
            }
        }


        $this->render('freeClassroom', array(
            'model'         => $model,
            'classrooms'    => $classrooms,
            'occupiedRooms' => $occupiedRooms,
        ));
    }
}