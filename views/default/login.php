<?php
use yii\helpers\Html;
use yii\captcha\Captcha;
use kartik\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var user\models\LoginForm $model
 */
$this->title = \Yii::t('user.common', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-container">
    <div class="center">
        <h1>
            <i class="icon-leaf green"></i>
            <span class="red">Ace</span>
            <span class="white">Application</span>
        </h1>
        <h4 class="blue">© Company Name</h4>
    </div>
    <div class="space-6"></div>
    <div id="login-box" class="login-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header blue lighter bigger">
                    <i class="icon-coffee green"></i>
                    <?= Html::encode(Yii::t('user.common', 'Please Enter Your Information')) ?>
                </h4>

                <div class="space-6"></div>

                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'formConfig' => [
                        'labelSpan' => ActiveForm::NOT_SET,
                        'deviceSize' => ActiveForm::NOT_SET,
                        'showLabels' => false,
                    ],
                    'fieldConfig' => [
                        'template' => "{input}",
                    ],
                ]); ?>
                    <fieldset>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <?= $form->field($model, 'username', [
                                    'addon' => ['append' => ['content'=>'<i class="icon-user"></i>']],
                                ])->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>
                            </span>
                        </label>

                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <?= $form->field($model, 'password', [
                                    'addon' => ['append' => ['content'=>'<i class="icon-lock"></i>']],
                                ])->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>
                            </span>
                        </label>

                        <?php if ($model->scenario == 'withCaptcha'): ?>
                            <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <?=
                                $form->field($model, 'verifyCode')->widget(Captcha::className(), ['captchaAction' => 'default/captcha', 'options' => ['class' => 'form-control'],]) ?>
                            </span>
                            </label>
                        <?php endif; ?>


                        <div class="space"></div>

                        <div class="clearfix">
                            <label class="inline">
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            </label>

                            <?= Html::submitButton("<i class=\"icon-key\"></i>" . Yii::t('user.common', 'Login'), ['class'=>'width-35 pull-right btn btn-sm btn-primary'])?>
                        </div>

                        <div class="space-4"></div>
                    </fieldset>
                <?php ActiveForm::end(); ?>

                <div class="social-or-login center">
                    <span class="bigger-110"><?= Yii::t('user.login', 'Or Login Using') ?></span>
                </div>

                <div class="social-login center">
                    <a class="btn btn-primary">
                        <i class="icon-facebook"></i>
                    </a>

                    <a class="btn btn-info">
                        <i class="icon-twitter"></i>
                    </a>

                    <a class="btn btn-danger">
                        <i class="icon-google-plus"></i>
                    </a>
                </div>
            </div><!-- /widget-main -->

            <div class="toolbar clearfix">
                <div>
                    <?= Html::a("<i class=\"icon-arrow-left\"></i>" . Yii::t('user.login', 'I forgot my password'), ['signup'], ['class'=>'forgot-password-link']) ?>
                </div>

                <div>
                    <?= Html::a("<i class=\"icon-arrow-right\"></i>" . Yii::t('user.login', 'I want to register'), ['signup'], ['class'=>'forgot-password-link']) ?>
                </div>
            </div>
        </div><!-- /widget-body -->
    </div><!-- /login-box -->

</div>
