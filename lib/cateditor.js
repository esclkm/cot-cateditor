var sysxk = null;
var phpn = null;
var parentid = 0;

function cte_json_load( data )
{
//	sysxk = data.x;
	if(data.message)
	{
		$('#messageboard').append('<div class="alert alert-'+data.status+' alert-dismissible fade in">'+
			'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
				'<span aria-hidden="true">&times;</span>'+
			'</button>' + data.message +'</div>');
	}
	if(data.editor)
	{
		$('#objeditor').html(data.editor);
	}
	if(data.id > 0)
	{
		parentid = data.id;
	}
	if(data.x)
	{
		sysxk = data.x;
	}	

	console.log(data);
}

function collapseItem(li)
{
	var lists = li.children(this.options.listNodeName);
	if (lists.length) {
		li.addClass(this.options.collapsedClass);
		li.children('[data-action="collapse"]').hide();
		li.children('[data-action="expand"]').show();
		li.children(this.options.listNodeName).hide();
	}
};

$(document).ready(function(){
	$('.dd').nestable({ maxDepth : 15 });
	//$('.dd').nestable('collapseAll');
	$('.dd').on('change', function() {
	//	alert($('.dd').nestable('serialize'));
	});
	sysxk = $('#getx [name=x]').val();
	phpn = $('#phpn').val();
	console.log(sysxk);
	console.log(phpn);
	

});
$(document).on('click', '.alert .close', function(e) {
	$(this).parent().hide();
});

$(document).on('click', '.dd-item>a', function(e) {
	var href = $(this).data('ajaxhref');
	console.log(href);
	$.get( href, function( data ) {
		cte_json_load(data);
	});
	return false;
});

$(document).on('click', '#catsaveorder', function(e) {
	$.post( "index.php?r=cateditor&n="+phpn+"&a=reorder", { x: sysxk, data: $('.dd').nestable('serialize') } )
		.done(function( data ) {
		  cte_json_load(data);
	});
	return false;
});

$(document).on('click', '#newcategory', function(e) {
	var href = "index.php?r=cateditor&n="+phpn+"&parentid="+parentid;
	console.log(href);
	$.get( href, function( data ) {
		cte_json_load(data);
	});
	return false;
});
