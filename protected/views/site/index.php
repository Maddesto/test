<?php
/* @var $this SiteController */
$this->pageTitle=Yii::app()->name;
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
                array('label'=>'Мои задачи', 'url'=>'/', 'active'=>true),
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

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
    'id'=>'modalGrid',
    'dataProvider'=>$model->search(Entity::ACT_STATUS_USED,true),
    'template'=>"{items}{pager}",
        'filter'=>$model,
    'columns'=>array(
        array(
            'name' => 'id',
            'type' => 'raw',
            'header'=>'ID',
            'htmlOptions'=>array('style'=>'width: 150px'),
        ),
        array(
            'name' => 'entity_title',
            'type' => 'raw',
            'value'=>function($data) {
                    echo CHtml::link($data->getTitle(), Yii::app()->baseUrl . "/entity/$data->id");
                },
            'header'=>'Название записи',
            'filter'=>false,
            'htmlOptions'=>array('style'=>'width: 150px'),
        ),
        array(
            'name' => 'segment_id',
            'type' => 'raw',
            'value'=>'$data->segment->name',
            'header'=>'Сегмент',
            'htmlOptions'=>array('style'=>'width: 150px'),
        ),
        array(
            'name' => 'company',
            'type' => 'raw',
            'value'=>'$data->segment->name',
            'header'=>'Компания',
            'htmlOptions'=>array('style'=>'width: 150px'),
        ),
        array(
            'name' => 'date_inwork',
            'type' => 'raw',
            'header'=>'Дата взятия в работу',
            'htmlOptions'=>array('style'=>'width: 150px'),
        ),
    ),
)); ?>


