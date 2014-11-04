<?php Yii::app()->clientScript->registerCssFile('/css/login.css'); ?>

<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'null', // null or 'inverse'
    'brand'=>'',
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Мои задачи', 'url'=>'/'),
                array('label'=>'Сегменты', 'url'=>array('/segment'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                array('label'=>'Сотрудники', 'url'=>array('/user'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                array('label'=>'Компании', 'url'=>array('/company'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                array('label'=>'Контакты', 'url'=>array('/contact'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                array('label'=>'Логи', 'url'=>array('/logs'), 'visible'=>Yii::app()->user->checkAccess('admin')),
                array('label'=>'Настройки', 'url'=>array('#','visible'=>Yii::app()->user->isGuest)),
                array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)

            ),
        ),
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'block'=>true, // display a larger alert block?
    'fade'=>true, // use transitions?
    'alerts'=>array( // configurations per alert type
    'closeText'=>'&times;',
    'error'=>array('block'=>  true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
    ),
)); ?>

<h1>Авторизация</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <?php echo $form->error($model,'message', array('class' => 'alert alert-error')); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email', array('class' => 'alert alert-error')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password', array('class' => 'alert alert-error')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Вход'); ?>

        <a class="indent-left20" href="/site/forgot">Забыли пароль?</a>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

