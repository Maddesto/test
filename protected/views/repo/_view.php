<?php
/* @var $this UserAttitudesController */
/* @var $data UserAttitudes */
?>

<div class="view">

	<p><b><big><big><?php echo CHtml::link(CHtml::encode($data['name']), '/repo/view/'.$data['owner']['login'].'/'.$data['name']); ?></big></big></b>
	<?php echo CHtml::link(CHtml::encode($data['homepage']), $data['homepage']); ?>
	<?php echo CHtml::link(CHtml::encode($data['owner']['login']), '/contributor/view/'.$data['owner']['login'].'/'.$data['id']); ?></p>
	<p>
	<?php echo CHtml::encode($data['description']); ?>
	</p>
	<p>
	Watchers: <?php echo CHtml::encode($data['watchers_count']); ?>
	<span style="margin-left: 30%;">Forks: <?php echo CHtml::encode($data['forks_count']); ?></span>
	</p>
	<?php echo CHtml::button('Like',[
                          'class'=>'btn like',
                          'style'=>'display:'.((in_array($data['id'], $likes))?'none':'block'),
                          'id'=>$data['id']
                  		]);
						echo CHtml::button('unLike',[
                          'class'=>'btn unlike',
                          'style'=>'position:absolute; rigth:10px; bottom:10px; display:'.((in_array($data['id'], $likes))?'block':'none'),
                          'id'=>$data['id']
                 ]);?>

</div>