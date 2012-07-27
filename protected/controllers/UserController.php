<?php

class UserController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $form = new SignupForm();

        // collect user input data
        if (isset($_POST['SignupForm'])) {
            $form->attributes = $_POST['SignupForm'];
            //var_dump($_POST);
            //var_dump($form);

            // validate user input and redirect to previous page if valid
            if ($form->validate()) {
                // TODO: validate passwords
                $user = new User();
                //$user->attributes = $_POST['SignupForm'];
                $user->username = $_POST['SignupForm']['username'];
                $user->email = $_POST['SignupForm']['email'];
                $user->password_hash = md5($_POST['SignupForm']['password']);
                $user->display_name = $_POST['SignupForm']['display_name'];
                $user->is_admin = 0;
                $user->is_active = 1;
                /*
                $user->posts_count = 0;
                $user->activated = 0;
                $user->login_key = md5($user->password_hash + $user->email);
                $user->login_key_expires_at = date('Y-m-d H:i:s', strtotime('+1 day'));
                */

                //if(isset($_POST['Users'])) {
                /*$users->attributes = array(


                        ); ;*/
                //var_dump($users);

                //if($user->validate()) {

                if ($user->save(false)) {

                    $identity = new UserIdentity($user->username, $_POST['SignupForm']['password']);
                    /*$identity->authenticate();
                                 switch($identity->errorCode)
                                 {
                                     case UserIdentity::ERROR_NONE:
                                         $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
                                         Yii::app()->user->login($identity,$duration);
                                         break;
                                     case UserIdentity::ERROR_USERNAME_INVALID:
                                         $this->addError('username','Username is incorrect.');
                                         break;
                                     default: // UserIdentity::ERROR_PASSWORD_INVALID
                                         $this->addError('password','Password is incorrect.');
                                         break;
                                 }*/
                    Yii::app()->user->login($identity);
                    $this->redirect(array('view', 'id' => $user->id));

                } else {
                    var_dump($user->getErrors());
                }

                /*} else {
                            var_dump($user->getErrors());
                        }*/


                //}


                //var_dump($user);

                //$this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
        $this->render('signup', array('form' => $form));

        /*$users=new User;
          if(isset($_POST['Users']))
          {
              $users->attributes=$_POST['Users'];
              if($users->save())
                  $this->redirect(array('show','id'=>$users->id));
          }
          $this->render('create',array('users'=>$users));*/
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new User('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['User']))
            $model->attributes = $_GET['User'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}
