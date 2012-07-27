<?php

class ForumController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    const PAGE_SIZE = 10;

    /**
     * @var string specifies the default action to be 'list'.
     */
    public $defaultAction = 'list';

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
        $model = new Forum;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Forum'])) {
            $model->attributes = $_POST['Forum'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
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

        if (isset($_POST['Forum'])) {
            $model->attributes = $_POST['Forum'];
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
        $dataProvider = new CActiveDataProvider('Forum');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Forum('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Forum']))
            $model->attributes = $_GET['Forum'];

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
        $model = Forum::model()->with('topics', 'topicsCount')->findByPk($id);
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
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'forum-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Lists all forums.
     */
    public function actionList()
    {

        /*$forums = Forum::model()->with('topics_count')->findAll(array(
              'select' => 'id, name, description, posts_count',
              'order' => 'position',
              ));*/

        $forums = Forum::model()->with('topicsCount', 'postsCount', 'last_post')->findAll();

        //die(var_dump($forums[0]->last_post));

        //die(var_dump($forums[0]->topics_count, $forums[0]->posts_count));

        //Topic::model()->with('last_post');

        /*foreach($forums as $forum) {
              $topics = Topic::model()->with('last_post')->findBySql('SELECT * FROM topics WHERE forum_id = :forum_id ORDER BY replied_at DESC LIMIT 1', array(':forum_id' => $forum->id));
              var_dump($topics);
          }*/

        //die(var_dump($forums[2]->last_post));


        // SELECT replied_at, replied_by, last_post_id FROM topics WHERE forum_id = 1 ORDER BY replied_at DESC LIMIT 1;

        //var_dump($forums[2]->topics[0]->attributes);

        /*$last_posts = Post::model()->findAll(array(

              ));

          SELECT *
          FROM posts
          GROUP BY topic_id
          ORDER BY updated_at
          LIMIT 0 , 30*/


        /*$this->render('list', array(
              'forums' => $forums,
              //'last_posts' => $last_posts
          ));*/

        $pages = $this->paginate(forum::model()->count(), self::PAGE_SIZE);
        //$forumList = Forum::model()->findAll($this->getListCriteria($pages));
        $this->render('list', array('forums' => $forums, 'pages' => $pages));
    }
}
