<?php

namespace app\controllers\admin;

use app\models\Attribute;
use app\models\Value;
use Yii;
use app\models\Executor;
use app\models\admin\search\ExecutorSearch;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * ExecutorsController implements the CRUD actions for Executor model.
 */
class ExecutorsController extends Controller
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
/*public function actionUpload()
    {
        $model = new Executor();

        if (Yii::$app->request->isPost) {

            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
        }

        return $this->render('upload', ['model' => $model]);
    }*/
    /**
     * Lists all Executor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ExecutorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Executor model.
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
     * Creates a new Executor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
    public function actionCreate()
    {
        $model = new Executor();


        $values = $this->initValues($model);
        $post = Yii::$app->request->post();

        if ($model->load($post) && $model->save() && Model::loadMultiple($values, $post)) {


 $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            $model->imageFile->saveAs('uploads/photo' . $model->id . '.' . $model->imageFile->extension);
            $model->photo='uploads/photo'.$model->id. '.'.$model->imageFile->extension;
            



            $this->processValues($values, $model);
            if ($model->save(false)){
        return $this->redirect(['view', 'id' => $model->id]);}
        } else {
            return $this->render('create', [
                'model' => $model,
                'values' => $values,
            ]);
        }
      
    }

    /**
     * Updates an existing Executor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $values = $this->initValues($model);

        $post = Yii::$app->request->post();
        if ($model->load($post) && $model->save() && Model::loadMultiple($values, $post)) {

          $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
          if ($model->imageFile){
            $model->imageFile->saveAs('uploads/photo' . $model->id . '.' . $model->imageFile->extension);
            $model->photo='uploads/photo'.$model->id . '.'.$model->imageFile->extension;
           }

            $this->processValues($values, $model);
            if ($model->save(false)){
            return $this->redirect(['view', 'id' => $model->id]);}
        } else {
            return $this->render('update', [
                'model' => $model,
                'values' => $values,
            ]);
        }
    }

    /**
     * Deletes an existing Executor model.
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
     * Finds the Executor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Executor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Executor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @param Executor $model
     * @return Value[]
     */
    private function initValues(Executor $model)
    {
        /** @var Value[] $values */
        $values = $model->getValues()->with('executorAttribute')->indexBy('attribute_id')->all();
        $attributes = Attribute::find()->indexBy('id')->all();

        foreach (array_diff_key($attributes, $values) as $attribute) {
            $values[$attribute->id] = new Value(['attribute_id' => $attribute->id]);
        }

        foreach ($values as $value) {
            $value->setScenario(Value::SCENARIO_TABULAR);
        }
        return $values;
    }

    /**
     * @param Value[] $values
     * @param Executor $model
     */
    private function processValues($values, Executor $model)
    {
        foreach ($values as $value) {
            $value->executor_id = $model->id;
            if ($value->validate()) {
                if (!empty($value->value)) {
                    $value->save(false);
                } else {
                    $value->delete();
                }
            }
        }
    }
    /**
     * @param Executor $model
     * @return SelCatId[]
     */
    private function initSelCatId(Executor $model)
    {
        /** @var SelCatId[] $selcatid */
        $SelCatId = $model->getSelCatId()->with('executorCategory')->indexBy('category_id')->all();
        $categories = Category::find()->indexBy('id')->all();

        foreach (array_diff_key($categories, $SelCatId) as $category) {
            $selcatid[$category->id] = new SelCatId(['category_id' => $category->id]);
        }

        foreach ($selcatid as $selcatid) {
            $selcatid->setScenario(SelCatId::SCENARIO_TABULAR);
        }
        return $values;
    }

    /**
     * @param SelCatId[] $selcatid
     * @param Executor $model
     */
    private function processSelCatId($selcatid, Executor $model)
    {
        foreach ($selcatid as $selcatid) {
            $selcatid->executor_id = $model->id;
            if ($selcatid->validate()) {
                if (!empty($selcatid->selcatid)) {
                    $selcatid->save(false);
                } else {
                    $selcatid->delete();
                }
            }
        }
    }

}
