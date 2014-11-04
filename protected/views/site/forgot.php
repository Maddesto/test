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

<div class="form">
    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'forgotForm',
        'type'=>'inline',
        'htmlOptions'=>array('class'=>'well'),
    )); ?>
    <?php echo $form->error($model, 'email', array('class' => 'alert alert-error', 'style' => 'display: block')); ?>

    <?php echo $form->textFieldRow($model, 'email', array('class'=>'input-medium', 'prepend'=>'<i class="icon-envelope"></i>')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Отправить')); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array('buttonType'=>'link', 'url' => Yii::app()->createUrl('/site/login'), 'label'=>'Отмена')); ?>

    <?php $this->endWidget(); ?>
</div><!-- form -->

