<?php
use yii\helpers\Html;
use cabbage\widgets\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use cabbage\widgets\SideNav;
use cabbage\widgets\Nav;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
$asset = \user\UserAsset::register($this);
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
            $items = [
                [
                    'label' => '你好',
                    'content' => '4',
                    'options'=>["class"=>Nav::THEME_PURPLE],

                    'itemsOptions' => [
                        'type' => Nav::TYPE_NOTIFY,
                        'prepend' => '<i class="icon-ok"></i>进城',
                        'append' => '#',
                    ],

                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                    ]
                ],
                [
                    'label' => '你好',
                    'content' => '4',

                    'itemsOptions' => [
                        'type' => Nav::TYPE_PROGRESS,
                        'prepend' => '<i class="icon-ok"></i>进城',
                        'append' => '#',
                    ],

                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                    ]
                ],
                [
                    'label' => '你好',
                    'content' => '4',

                    'itemsOptions' => [
                        'type' => Nav::TYPE_MESSAGE,
                        'prepend' => '<i class="icon-ok"></i>进城',
                        'append' => '#',
                    ],

                    'items' => [
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon' => 'list'],
                    ]
                ],

            ];
        if (Yii::$app->user->isGuest) {
            $items[] = ['label' => Yii::t('user.common', 'welcome'), 'image' => $asset->baseUrl . '/images/user.jpg',
                'content' => '游客',
                'items' => [
                    ['label' => 'Signup', 'url' => ['/user/default/signup']],
                    ['label' => 'Login', 'url' => ['/user/default/login']
                ],
            ]];
        } else {
            $items[] = [
                'label' => Yii::t('user.common', 'welcome'),
                'image' => Yii::$app->user->identity->thumb ? Yii::$app->user->identity->thumb : $asset->baseUrl . '/images/user.jpg',
                'content' => Yii::$app->user->identity->username,
                'items' => [
                    ['label' => 'profile', 'url' => ['/user/profile/view'], 'icon'=>'user'],
                    '<li class="divider"></li>',
                    [
                        'label' => Yii::t('user.common', 'Logout').' (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/user/default/logout'],
                        'linkOptions' => ['data-method' => 'post'],
                        'icon' => 'off'
                    ],
            ]];
        }
            echo Nav::widget([
                'items' => $items,
            ]);
            NavBar::end();
        ?>


        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <div class="main-container-inner">
                <?php
                $menuItems = [
                    ['label' => 'Home', 'url' => ['/site/index'], 'icon'=>'list'],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'icon' => 'edit', 'items'=>[
                        ['label' => 'Home', 'url' => ['/site/aa'], 'icon'=>'list'],
                        ['label' => 'About', 'url' => ['/site/bb']],
                    ]],
                ];
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                    $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];

                } else {
                    $menuItems[] = [
                        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ];
                }
                echo SideNav::widget([
                    'items' => $menuItems,
                    'heading' => true,
                    'containerOptions' => ['class'=>'sidebar-fixed']
                ]);
                ?>
                <div class="main-content">
                    <div class="breadcrumbs" id="breadcrumbs">

                        <?= Breadcrumbs::widget([
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>

                        <div class="nav-search" id="nav-search">
                            <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off">
									<i class="icon-search nav-search-icon"></i>
								</span>
                            </form>
                        </div><!-- #nav-search -->
                    </div>

                    <?= Alert::widget() ?>

                    <div class="page-content">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>





    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
