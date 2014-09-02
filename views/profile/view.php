<?php

use yii\helpers\Html;
use kartik\editable\Editable;
use cabbage\widgets\JqueryPlugin;

/**
 * @var yii\web\View $this
 * @var user\models\User $model
 */

$this->title = \Yii::t('user.common', 'View Profile');
$this->params['breadcrumbs'][] = $this->title;
$asset = \user\UserAsset::register($this);
?>
<div class="row">
    <div class="col-xs-6">

    </div>
</div>
<div class="row">
<div class="col-xs-12">
<!-- PAGE CONTENT BEGINS -->

<div id="user-profile-1" class="user-profile row">
<div class="col-xs-12 col-sm-3 center">
    <div>
        <span class="profile-picture">
        <?=
                        \cabbage\widgets\Editable::widget([
                            'model' => $model,
                            'attribute' => 'thumb',
                            'url' => 'user/profile/upload',
                            'type' => 'image',
                            'tag' => 'img',
                            'clientOptions' => [
                            ],
                            'options' => [
                                'class' => 'editable img-responsive editable-click editable-empty',
                                'src' => $asset->baseUrl . "/images/profile-pic.jpg",
                                'alt' => Yii::$app->user->identity->username,
                            ],
                        ]);
            ?>
        </span>


        <div class="space-4"></div>

        <div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
            <div class="inline position-relative">
                <a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-circle light-green middle"></i>
                    &nbsp;
                    <span class="white"><?= Yii::$app->user->identity->username ?></span>
                </a>

                <ul class="align-left dropdown-menu dropdown-caret dropdown-lighter">
                    <li class="dropdown-header"> Change Status</li>

                    <li>
                        <a href="#">
                            <i class="icon-circle green"></i>
                            &nbsp;
                            <span class="green">Available</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="icon-circle red"></i>
                            &nbsp;
                            <span class="red">Busy</span>
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="icon-circle grey"></i>
                            &nbsp;
                            <span class="grey">Invisible</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="space-6"></div>

    <div class="profile-contact-info">
        <div class="profile-contact-links align-left">
            <a class="btn btn-link" href="#">
                <i class="icon-plus-sign bigger-120 green"></i>
                Add as a friend
            </a>

            <a class="btn btn-link" href="#">
                <i class="icon-envelope bigger-120 pink"></i>
                Send a message
            </a>

            <a class="btn btn-link" href="#">
                <i class="icon-globe bigger-125 blue"></i>
                www.alexdoe.com
            </a>
        </div>

        <div class="space-6"></div>

        <div class="profile-social-links center">
            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Facebook">
                <i class="middle icon-facebook-sign icon-2x blue"></i>
            </a>

            <a href="#" class="tooltip-info" title="" data-original-title="Visit my Twitter">
                <i class="middle icon-twitter-sign icon-2x light-blue"></i>
            </a>

            <a href="#" class="tooltip-error" title="" data-original-title="Visit my Pinterest">
                <i class="middle icon-pinterest-sign icon-2x red"></i>
            </a>
        </div>
    </div>

    <div class="hr hr12 dotted"></div>

    <div class="clearfix">
        <div class="grid2">
            <span class="bigger-175 blue">25</span>

            <br>
            Followers
        </div>

        <div class="grid2">
            <span class="bigger-175 blue">12</span>

            <br>
            Following
        </div>
    </div>

    <div class="hr hr16 dotted"></div>
</div>

<div class="col-xs-12 col-sm-9">
<div class="center">
												<span class="btn btn-app btn-sm btn-light no-hover">
													<span class="line-height-1 bigger-170 blue"> 1,411 </span>

													<br>
													<span class="line-height-1 smaller-90"> Views </span>
												</span>

												<span class="btn btn-app btn-sm btn-yellow no-hover">
													<span class="line-height-1 bigger-170"> 32 </span>

													<br>
													<span class="line-height-1 smaller-90"> Followers </span>
												</span>

												<span class="btn btn-app btn-sm btn-pink no-hover">
													<span class="line-height-1 bigger-170"> 4 </span>

													<br>
													<span class="line-height-1 smaller-90"> Projects </span>
												</span>

												<span class="btn btn-app btn-sm btn-grey no-hover">
													<span class="line-height-1 bigger-170"> 23 </span>

													<br>
													<span class="line-height-1 smaller-90"> Reviews </span>
												</span>

												<span class="btn btn-app btn-sm btn-success no-hover">
													<span class="line-height-1 bigger-170"> 7 </span>

													<br>
													<span class="line-height-1 smaller-90"> Albums </span>
												</span>

												<span class="btn btn-app btn-sm btn-primary no-hover">
													<span class="line-height-1 bigger-170"> 55 </span>

													<br>
													<span class="line-height-1 smaller-90"> Contacts </span>
												</span>
</div>

<div class="space-12"></div>

<div class="profile-user-info profile-user-info-striped">
    <div class="profile-info-row">
        <div class="profile-info-name"> <?= Yii::t('user.common', 'Username') ?></div>

        <div class="profile-info-value">
            <?php
            echo \kartik\editable\Editable::widget([
                'model' => $model,
                'attribute' => 'username',
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                'formOptions' => ['action' => ['editable']]
            ]);
            ?>
        </div>
    </div>


    <div class="profile-info-row">
        <div class="profile-info-name"> <?= Yii::t('user.common', 'Email') ?></div>

        <div class="profile-info-value">
            <?php
            echo \kartik\editable\Editable::widget([
                'model' => $model,
                'attribute' => 'email',
                'inputType' => \kartik\editable\Editable::INPUT_TEXT,
                'formOptions' => ['action' => ['editable']]
            ]);
            ?>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"> <?= Yii::t('user.common', 'Last Visit Time') ?> </div>

        <div class="profile-info-value">
            <span><?= $model->last_visit_time ?></span>
        </div>
    </div>

    <div class="profile-info-row">
        <div class="profile-info-name"><?= Yii::t('user.common', 'Status') ?></div>

        <div class="profile-info-value">
            <span><?= $model->getStatus() ?></span>
        </div>
    </div>
</div>

<div class="space-20"></div>

<div class="widget-box transparent">
<div class="widget-header widget-header-small">
    <h4 class="blue smaller">
        <i class="icon-rss orange"></i>
        Recent Activities
    </h4>

    <div class="widget-toolbar action-buttons">
        <a href="#" data-action="reload">
            <i class="icon-refresh blue"></i>
        </a>

        &nbsp;
        <a href="#" class="pink">
            <i class="icon-trash"></i>
        </a>
    </div>
</div>

<div class="widget-body">
<div class="widget-main padding-8">

<?php
JqueryPlugin::widget([
    'id' => 'profile-feed-1',
    'plugin' => JqueryPlugin::PLUGIN_SLIM_SCROLL,
    'options' => [
        'height' => '250px',
        'alwaysVisible' => true
    ],
]);
?>
<div id="profile-feed-1" class="profile-feed">
<div class="profile-activity clearfix">
    <div>
        <img class="pull-left" alt="Alex Doe's avatar" src="assets/avatars/avatar5.png">
        <a class="user" href="#"> Alex Doe </a>
        changed his profile photo.
        <a href="#">Take a look</a>

        <div class="time">
            <i class="icon-time bigger-110"></i>
            an hour ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <img class="pull-left" alt="Susan Smith's avatar" src="assets/avatars/avatar1.png">
        <a class="user" href="#"> Susan Smith </a>

        is now friends with Alex Doe.
        <div class="time">
            <i class="icon-time bigger-110"></i>
            2 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <i class="pull-left thumbicon icon-ok btn-success no-hover"></i>
        <a class="user" href="#"> Alex Doe </a>
        joined
        <a href="#">Country Music</a>

        group.
        <div class="time">
            <i class="icon-time bigger-110"></i>
            5 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <i class="pull-left thumbicon icon-picture btn-info no-hover"></i>
        <a class="user" href="#"> Alex Doe </a>
        uploaded a new photo.
        <a href="#">Take a look</a>

        <div class="time">
            <i class="icon-time bigger-110"></i>
            5 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <img class="pull-left" alt="David Palms's avatar" src="assets/avatars/avatar4.png">
        <a class="user" href="#"> David Palms </a>

        left a comment on Alex's wall.
        <div class="time">
            <i class="icon-time bigger-110"></i>
            8 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <i class="pull-left thumbicon icon-edit btn-pink no-hover"></i>
        <a class="user" href="#"> Alex Doe </a>
        published a new blog post.
        <a href="#">Read now</a>

        <div class="time">
            <i class="icon-time bigger-110"></i>
            11 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <img class="pull-left" alt="Alex Doe's avatar" src="assets/avatars/avatar5.png">
        <a class="user" href="#"> Alex Doe </a>

        upgraded his skills.
        <div class="time">
            <i class="icon-time bigger-110"></i>
            12 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <i class="pull-left thumbicon icon-key btn-info no-hover"></i>
        <a class="user" href="#"> Alex Doe </a>

        logged in.
        <div class="time">
            <i class="icon-time bigger-110"></i>
            12 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <i class="pull-left thumbicon icon-off btn-inverse no-hover"></i>
        <a class="user" href="#"> Alex Doe </a>

        logged out.
        <div class="time">
            <i class="icon-time bigger-110"></i>
            16 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>

<div class="profile-activity clearfix">
    <div>
        <i class="pull-left thumbicon icon-key btn-info no-hover"></i>
        <a class="user" href="#"> Alex Doe </a>

        logged in.
        <div class="time">
            <i class="icon-time bigger-110"></i>
            16 hours ago
        </div>
    </div>

    <div class="tools action-buttons">
        <a href="#" class="blue">
            <i class="icon-pencil bigger-125"></i>
        </a>

        <a href="#" class="red">
            <i class="icon-remove bigger-125"></i>
        </a>
    </div>
</div>
</div>

</div>
</div>
</div>

<div class="hr hr2 hr-double"></div>

<div class="space-6"></div>

<div class="center">
    <a href="#" class="btn btn-sm btn-primary">
        <i class="icon-rss bigger-150 middle"></i>
        <span class="bigger-110">View more activities</span>

        <i class="icon-on-right icon-arrow-right"></i>
    </a>
</div>
</div>
</div>


<!-- PAGE CONTENT ENDS -->
</div>
<!-- /.col -->
</div>
