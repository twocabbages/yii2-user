<?php
use yii\helpers\Html;
use cabbage\widgets\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use cabbage\widgets\SideNav;
use cabbage\widgets\Nav;
use cabbage\widgets\AceAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
AceAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="navbar-fixed">
    <?php $this->beginBody() ?>
        <?php
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                ],
            ]);
            NavBar::end();
        ?>

        <?= Alert::widget() ?>

        <div class="container">
            <?= $content ?>
        </div>


    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
