<?php

namespace backend\controllers;

use common\models\Project;
use backend\models\ProjectSearch;
use backend\jobs\MyJob;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Project models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                if ($model->save()) {
                    $model->saveImage();
                    Yii::$app->session->setFlash('success', 'Success Yii!');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Success at update!');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /* The `actionTest` function is a controller action that sends an email using Yii's built-in mailer
    component. It takes an optional parameter `` which is used as the email subject. The
    function composes an email with a plain text and HTML body, and sends it to a specified email
    address. It then returns a JSON-encoded response indicating whether the email was sent
    successfully or not. This function can be used for testing email functionality in a Yii
    application. */
    public function actionTest($message = 'example')
    {
        $emailResult = Yii::$app->mailer->compose()
            ->setFrom('from@domain.com')
            ->setTo('to@domain.com')
            ->setSubject($message)
            ->setTextBody('Plain text content')
            ->setHtmlBody('<b>HTML content</b>')
            ->send();
        
        return json_encode([
            'test' => $emailResult
        ]);
    }

    public function actionFirstTwig()
    {
        return $this->render('firsttwig.twig', ['message' => 'Twig test message!']);
    }

    public function actionQueue($message = '')
    {
        $result = Yii::$app->queue->push(new MyJob([
            'message' => $message
        ]));
        
        return json_encode([
            'result' => $result
        ]);
    }

    public function actionTestRedis()
    {
        $result = Yii::$app->redis->set('name', 'gustavo');
        return json_encode([
            'redis result' => $result
        ]);
    }
}
