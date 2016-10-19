<?php

namespace app\controllers\admin;

use Yii;
use app\models\ExecutorTag;
use app\models\admin\search\ExecutorTagSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ExecutorTagsController implements the CRUD actions for ExecutorTag model.
 */
class ExecutorTagsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ExecutorTag models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExecutorTagSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ExecutorTag model.
     * @param integer $executor_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionView($executor_id, $tag_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($executor_id, $tag_id),
        ]);
    }

    /**
     * Creates a new ExecutorTag model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ExecutorTag();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'executor_id' => $model->executor_id, 'tag_id' => $model->tag_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ExecutorTag model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $executor_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionUpdate($executor_id, $tag_id)
    {
        $model = $this->findModel($executor_id, $tag_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'executor_id' => $model->executor_id, 'tag_id' => $model->tag_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ExecutorTag model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $executor_id
     * @param integer $tag_id
     * @return mixed
     */
    public function actionDelete($executor_id, $tag_id)
    {
        $this->findModel($executor_id, $tag_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ExecutorTag model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $executor_id
     * @param integer $tag_id
     * @return ExecutorTag the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($executor_id, $tag_id)
    {
        if (($model = ExecutorTag::findOne(['executor_id' => $executor_id, 'tag_id' => $tag_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
