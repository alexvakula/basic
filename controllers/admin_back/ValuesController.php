<?php

namespace app\controllers\admin;

use Yii;
use app\models\Value;
use app\models\admin\search\ValueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ValuesController implements the CRUD actions for Value model.
 */
class ValuesController extends Controller
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
     * Lists all Value models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ValueSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Value model.
     * @param integer $executor_id
     * @param integer $attribute_id
     * @return mixed
     */
    public function actionView($executor_id, $attribute_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($executor_id, $attribute_id),
        ]);
    }

    /**
     * Creates a new Value model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param integer $executor_id
     * @return mixed
     */
    public function actionCreate($executor_id = null)
    {
        $model = new Value();
        $model->executor_id = $executor_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['admin/executors/view', 'id' => $model->executor_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Value model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $executor_id
     * @param integer $attribute_id
     * @return mixed
     */
    public function actionUpdate($executor_id, $attribute_id)
    {
        $model = $this->findModel($executor_id, $attribute_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['admin/executors/view', 'id' => $model->executor_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Value model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $executor_id
     * @param integer $attribute_id
     * @return mixed
     */
    public function actionDelete($executor_id, $attribute_id)
    {
        $this->findModel($executor_id, $attribute_id)->delete();

        return $this->redirect(['admin/executors/view', 'id' => $executor_id]);
    }

    /**
     * Finds the Value model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $executor_id
     * @param integer $attribute_id
     * @return Value the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($executor_id, $attribute_id)
    {
        if (($model = Value::findOne(['executor_id' => $executor_id, 'attribute_id' => $attribute_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
