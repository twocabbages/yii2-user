<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var user\models\User $model
 */

$this->title = Yii::t('user.common', 'Update User') . ': ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('user.common', 'Update');
?>
<div class="user-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
