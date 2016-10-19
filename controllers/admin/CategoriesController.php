<?php

namespace app\controllers\admin;

use Yii;
use app\models\Category;
use app\models\admin\search\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use creocoder\nestedsets\NestedSetsQueryBehavior;

/**
 * CategoriesController implements the CRUD actions for Category model.
 */
class CategoriesController extends Controller
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      /*  $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }   */
       $model = new Category();

        if ( ! empty(Yii::$app->request->post('Category'))) 
        {
            $post            = Yii::$app->request->post('Category');
            $model->name     = $post['name'];
            $model->position = $post['position'];
            $parent_id       = $post['parentId'];

            if (empty($parent_id))
                $model->makeRoot();
            else
            {
                $parent = Category::findOne($parent_id);
                $model->appendTo($parent);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                'model' => $model,
            ]);
 
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

       $model = $this->findModel($id);

        if ( ! empty(Yii::$app->request->post('Category'))) 
        {
            $post            = Yii::$app->request->post('Category');

            $model->name     = $post['name'];
            $model->position = $post['position'];
            $parent_id       = $post['parentId'];

            if ($model->save())            
            {
                if (empty($parent_id))
                {
                    if ( ! $model->isRoot())
                        $model->makeRoot();
                }
                else // move node to other root 
                {
                    if ($model->id != $parent_id)
                    {
                        $parent = Category::findOne($parent_id);
                        $model->appendTo($parent);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
  /*      $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }  */
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->isRoot())
            $model->deleteWithChildren();
        else 
            $model->delete();

        return $this->redirect(['index']);
	
/*        $this->findModel($id)->delete();

        return $this->redirect(['index']);    */
    }
 	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];
 
		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


public function actionStructure()

    {

        $model = new Category();

        return $this->render('structure', [

            'data' => $model->getStructure() ,

            ]);

    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
