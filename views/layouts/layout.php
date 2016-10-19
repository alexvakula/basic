<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Тимчасовий підробіток <b>(073)110 21 30</b>, <b>(067)999 15 80</b><br>E-mail, Skype:t.pidrobitok@gmail.com,<br> https://vk.com/t_pidrobitok',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-fixed-top',      //navbar-inverse
	'style' => 'background-color: orange;',
        ],
	
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Головна', 'url' => ['/site/index'], 'options' => ['style' => 'font-weight: bold;']],
//            ['label' => 'Каталог', 'url' => ['/catalog/index']],

!Yii::$app->user->isGuest ? ( 
 //           ['label' => 'Admin', 'items' => [
               ['label' => 'Виконавці', 'url' => ['/admin/executors/index'], 'options' => ['style' => 'font-weight: bold;']]
) : (''),
!Yii::$app->user->isGuest ? ( 
               ['label' => 'Замовники', 'url' => ['/admin/customers/index'], 'options' => ['style' => 'font-weight: bold;']]
) : (''),
!Yii::$app->user->isGuest ? ( 
               ['label' => 'Замовлення', 'url' => ['/admin/orders/index'], 'options' => ['style' => 'font-weight: bold;']]
) : (''),
!Yii::$app->user->isGuest ? ( 
                ['label' => 'Категорії', 'url' => ['/admin/categories/index'], 'options' => ['style' => 'font-weight: bold;']]	
//                ['label' => 'Обрані Категорії', 'url' => ['/admin/sel-cat-id/index']],
//                ['label' => 'Атрибути', 'url' => ['/admin/attributes/index']],
//                ['label' => 'Значення', 'url' => ['/admin/values/index']],
//                ['label' => 'Tags', 'url' => ['/admin/tags/index']],
//                ['label' => 'Executor Tags', 'url' => ['/admin/executor-tags/index']],
//            ]] 
) : (''),
//            ['label' => 'Про нас', 'url' => ['/site/about']],
//            ['label' => 'Зв\'язатись', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                ['label' => 'Увійти', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Вийти (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Vakula <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
