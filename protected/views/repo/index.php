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
                url: "/repoLikes/like",
                data: {'id': id}
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
                url: "/repoLikes/unlike",
                data: {'id': id}
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

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'viewData' => array('likes' => $likes)
)); ?>