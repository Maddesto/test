<?php
/* @var $this ContributorController */

$this->breadcrumbs=array(
	'User',
);
?>
<script>
    $(document).ready(function(){
		$('.like').click(function(){
			id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "/userLikes/like",
                data: {'id': id, 'repo': '<?=$user['repo']?>'}
            }).done(function (res) {
            	if(res.result){
	            	$('#'+id+'.unlike').show();
	            	$('#'+id+'.like').hide();
            	}
            	id = null;
                });
        });	
		$('.unlike').click(function () {
			id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "/userLikes/unlike",
                data: {'id': id, 'repo': '<?=$user['repo']?>'}
            })
                .done(function (res) {
                    if(res.result){
                    	$('#'+id+'.unlike').hide();
                    	$('#'+id+'.like').show();
                     }
                    id = null;
                });
        });	
    });
</script>
<div id="left-column">
	<div id="user-image">
	<?php 
	echo CHtml::image($user['avatar_url'], 'User avatar');
	?>
	</div>

	<div id="user-button">
	<?php echo CHtml::button('Like',[
	                          'class'=>'btn like',
	                          'style'=>'display:'.(($user['like'])?'none':' '),
	                          'id'=>$user['id']
	                  		]);
		echo CHtml::button('unLike',[
	                          'class'=>'btn unlike',
	                          'style'=>'display:'.(($user['like'])?'':'none'),
	                          'id'=>$user['id']
	                       ]);?>
	</div>
</div>
<div id="right-column">
<h1> <?=$user['name']?></h1>
<ul>
<li><?=$user['login']?></li>
<li>Company: <?=$user['company']?></li>
<li>Blog: <?php echo CHtml::link($user['blog'],$user['blog'])?></li>
<li>Followers <?=$user['followers']?></li>
</ul>
</div>

