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

<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode($message); ?>
</div>