<?php

namespace backend\controllers;

use Yii;
use backend\models\Post;
use backend\models\PostCategory;
use backend\models\PostSearch;
use backend\models\Tags;
use backend\models\TagPost;
use common\components\SearchClass;
use backend\controllers\BehaviorsController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PostsController implements the CRUD actions for Post model.
 */
class PostsController extends BehaviorsController
{
    public $layout = 'admin';
    public $enableCsrfValidation = false;

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $tags = new Tags();
        if ($tags->load(Yii::$app->request->post())) {
            $tag_post = new TagPost();
            $tag_id = Tags::find()->where(['name' => $_POST['Tags']['name']])->select('id')->column();
            $tag_id = intval($tag_id[0]);
            $row = TagPost::findOne(['tag_id' => $tag_id, 'post_id' => $id]);
            if (empty($row)) {
                $tag_post->post_id = $id;
                $tag_post->tag_id = $tag_id;
                $tag_post->save();
            }
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
            'tags' => $tags,
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Post();
        $form = null;
        $request = Yii::$app->request;
         if (!empty($request->post('form1'))) {
            parse_str($request->post('form1'), $form1);
            parse_str($request->post('form2'), $form2);
            parse_str($request->post('form3'), $form3);
            $form['Post'] = array_merge($form1['Post'], $form2['Post'], $form3['Post']);
            if (empty($form['Post']['description'])) {
                $desc = strip_tags($form['Post']['content']);
                $form['Post']['description'] = $model->getShortText($desc, 400);
            }
            $searchObj  = new SearchClass();
            $index = ( $searchObj -> make_index($form['Post']['title']) );
            $index = json_encode($index);
            $form['Post']['title_index'] = $index;
        }
        if ($model->load($form)) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Запись успешно добавлена');
                return $this->redirect('/admin/posts');
            }
        }
        $model_category = new PostCategory();
        if ($model_category->load(Yii::$app->request->post())) {
            $model_category->save();
        }
        return $this->render('create-update', [
            'model' => $model,
            'model_category' => $model_category,
            'title' => 'Добавить запись',
            ]);
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = null;
        $request = Yii::$app->request;
        if (!empty($request->post('form1'))) {
            parse_str($request->post('form1'), $form1);
            parse_str($request->post('form2'), $form2);
            parse_str($request->post('form3'), $form3);
            $form['Post'] = array_merge($form1['Post'], $form2['Post'], $form3['Post']);
            if (empty($form['Post']['description'])) {
                $desc = strip_tags($form['Post']['content']);
                $form['Post']['description'] = $model->getShortText($desc, 400);
            }
             $searchObj  = new SearchClass();
            $index = ( $searchObj -> make_index($form['Post']['title']) );
            $index = json_encode($index);
            $form['Post']['title_index'] = $index;
        }

        $model_category = new PostCategory();
        if ($model_category->load(Yii::$app->request->post())) {
            $model_category->save();
        }
        if ($model->load($form)) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Запись успешно изменена');
                return $this->redirect('/admin/posts');
            }
        }else {
            return $this->render('create-update', [
                'model' => $model,
                'model_category' => $model_category,
                'title' => 'Редактировать запись',
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionCategories()
    {
        $model = new PostCategory();
        return $this->render('categories', ['model' => $model]);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
