<?php

namespace app\controllers\admin;

use Yii;
use app\models\Category;
use app\models\Executor;
use app\models\SelCatId;
use app\models\Order;
use app\models\admin\search\OrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * OrdersController implements the CRUD actions for Order model.
 */
class OrdersController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'arrCategory' => $arrCategory,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile1 = UploadedFile::getInstance($model, 'imageFile1');
            if ($model->imageFile1){
            $model->imageFile1->saveAs('uploads/before' . $model->id . '.' . $model->imageFile1->extension);
            $model->photo_before='uploads/before'.$model->id . '.'.$model->imageFile1->extension;
           }
           $model->imageFile2 = UploadedFile::getInstance($model, 'imageFile2');
           if ($model->imageFile2){
            $model->imageFile2->saveAs('uploads/after' . $model->id . '.' . $model->imageFile2->extension);
            $model->photo_after='uploads/after'.$model->id . '.'.$model->imageFile2->extension;
           }
           if ($model->save(false)){
            return $this->redirect(['view', 'id' => $model->id]);}
        } else {
            return $this->render('create', [
                'model' => $model,
                'arrCategory' => $arrCategory,
                'arrSelCatId' => []

            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $arrCategory = ['id' => '1', 'name' => '2'];
        $arrSelCatId = ['id' => '1', 'category_id' => '2'];
        $arrExecutor = ['id' => '1', 'name' => '2'];

        $model = $this->findModel($id);

        /*$model_Category = Category::find()->orderBy('id')->all();
        foreach ($model_Category as $value) {
            $arrCategory[$value->id] = $value->name;
        }
        $model_SelCatId = SelCatId::find()->orderBy('id')->all();
        foreach ($model_SelCatId as $value) {
            $arrSelCatId[$value->category_id] = $value->category_id;
        }
        $model_Executor = Executor::find()->orderBy('id')->all();
        foreach ($model_Executor as $value) {
            $arrExecutor[$value->name] = $value->id;
        }*/

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageFile1 = UploadedFile::getInstance($model, 'imageFile1');
            if ($model->imageFile1){
            $model->imageFile1->saveAs('uploads/before' . $model->id . '.' . $model->imageFile1->extension);
            $model->photo_before='uploads/before'.$model->id . '.'.$model->imageFile1->extension;
           }
           $model->imageFile2 = UploadedFile::getInstance($model, 'imageFile2');
           if ($model->imageFile2){
            $model->imageFile2->saveAs('uploads/after' . $model->id . '.' . $model->imageFile2->extension);
            $model->photo_after='uploads/after'.$model->id . '.'.$model->imageFile2->extension;
           }
           if ($model->save(false)){
            return $this->redirect(['view', 'id' => $model->id]);}
        } else {
            return $this->render('update', [
                'model' => $model,
                'arrCategory' => $arrCategory,
                'arrSelCatId' => $arrSelCatId,
                'arrExecutor' => $arrExecutor,

            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
