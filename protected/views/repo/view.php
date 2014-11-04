<?php
/* @var $this RepoController */

$this->breadcrumbs=array(
	'Repo',
);
?>
<script>
    $(document).ready(function(){
		$('.like').click(function(){
			id = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "/userLikes/like",
                data: {'id': id, 'repo': '<?=$repo['id']?>'}
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
                data: {'id': id, 'repo': '<?=$repo['id']?>'}
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
<h1><?=$repo['owner']['login'] .'/'.$repo['name']?></h1>
<ul>
	<li>
		Description: <?=$repo['description']?>
	</li>
	<li>
		watchers: <?=$repo['watchers_count']?>
	</li>
	<li>
		forks: <?=$repo['forks_count']?>
	</li>
	<li>
		open issues: <?=$repo['open_issues']?>
	</li>
	<li>
		homepage: <?=CHtml::link($repo['homepage'], $repo['homepage'])?>
	</li>
	<li>
		GitHub repo: <?=CHtml::link($repo['url'], $repo['url'])?>
	</li>
	<li>
		created at: <?=$repo['created_at']?>
	</li>
</ul>
</div>
<div id="right-column">
<h1>Contributors:</h1>
	<table>
		<?php foreach ($contributors as $contributor):?>
		<tr>
			<td>
				<?=CHtml::link($contributor['login'], '/contributor/view/'.$contributor['login'].'/'.$repo['id'])?>
			</td>
			<td>
				<?php echo CHtml::button('Like',[
                          'class'=>'btn like',
                          'style'=>'display:'.((in_array($contributor['id'], $likes))?'none':' '),
                          'id'=>$contributor['id']
                  		]);
						echo CHtml::button('unLike',[
                          'class'=>'btn unlike',
                          'style'=>'display:'.((in_array($contributor['id'], $likes))?'':'none'),
                          'id'=>$contributor['id']
                  		]);?>
			</td>
		</tr>
		<?php endforeach;?>
	</table>
</div>
