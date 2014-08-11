<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\SignupForm */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login-container">
    <div id="signup-box" class="signup-box widget-box no-border visible">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header green lighter bigger">
                    <i class="icon-group blue"></i>
                    <?= \Yii::t('user.login', 'New User Registration') ?>
                </h4>

                <div class="space-6"></div>
                <p> <?= Yii::t('user.login', 'Enter your details to begin:') ?> </p>

                <?php $form = ActiveForm::begin([
                    'id' => 'form-signup',
                    'formConfig' => [
                        'labelSpan' => ActiveForm::NOT_SET,
                        'deviceSize' => ActiveForm::NOT_SET,
                        'showLabels' => false,
                    ],
                    'fieldConfig' => ['autoPlaceholder'=>true],

                ]); ?>

                <fieldset>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $form->field($model, 'username', [
                                'addon' => ['append' => ['content'=>'<i class="icon-user"></i>']],
                            ]) ?>
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $form->field($model, 'email', [
                                'addon' => ['append' => ['content'=>'<i class="icon-envelope"></i>']],
                            ]) ?>
                        </span>
                    </label>
                    <label class="block clearfix">
                        <span class="block input-icon input-icon-right">
                            <?= $form->field($model, 'password', [
                                'addon' => ['append' => ['content'=>'<i class="icon-lock"></i>']],
                            ]) ?>
                        </span>
                    </label>


                    <div class="clearfix">

                        <?= Html::resetButton( "<i class=\"icon-refresh\"></i>" . Yii::t('user.common', 'reset'), ['class'=>'width-30 pull-left btn btn-sm'])?>
                        <?= Html::submitButton( "<i class=\"icon-arrow-right icon-on-right\"></i>" . Yii::t('user.common', 'submit'), ['class'=>'width-65 pull-right btn btn-sm btn-success'])?>

                    </div>
                    </fieldset>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="toolbar center">
                <?= Html::a("<i class=\"icon-arrow-left\"></i>" . Yii::t('user.login', 'Back to login'), ['login'], ['class'=>'back-to-login-link']) ?>
            </div>
        </div>
        <!-- /widget-body -->
    </div>

</div>
