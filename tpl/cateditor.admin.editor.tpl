<!-- BEGIN: MAIN -->
<form id="getx" method="POST"><input type="hidden" id="phpn" value="{PHP.n}"/></form>
{FILE "{PHP.cfg.themes_dir}/admin/{PHP.cfg.admintheme}/warnings.tpl"}
<div id="messageboard">
	
</div>
<div class="row">
	<div class="col-md-5">
		<div>
			<a href="{NEWCATEGORY_URL}" class="btn btn-success" id="newcategory">{PHP.L.new_category}</a>
			<div class="pull-right">
				<a class="btn btn-default" id="catsaveorder" href="#">{PHP.L.Save_order}</a>
				<a class="btn btn-default" id="catresync" href="{RESYNC_URL}">{PHP.L.Resync}</a>
			</div>
		</div>		
		<hr/>
		{TREE}	
		
	</div>
	<div class="col-md-7 fixheader-md">
		<div id="objeditor">
		{EDITOR}
		</div>
	</div>
</div>
<!-- END: MAIN -->