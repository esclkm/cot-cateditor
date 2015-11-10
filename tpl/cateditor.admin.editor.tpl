<!-- BEGIN: MAIN -->
<form id="getx" method="POST"><input type="hidden" id="phpn" value="{PHP.n}"/></form>
{FILE "{PHP.cfg.themes_dir}/admin/{PHP.cfg.admintheme}/warnings.tpl"}
<div id="messageboard">
	
</div>
<div class="row">
	<div class="col-md-5">
		<div class="panel panel-default">
			<div class="panel-body panel-nopadding">
				<a href="{NEWCATEGORY_URL}" class="btn btn-success btn-block" id="newcategory">{PHP.L.new_category}</a>

				{TREE}
			</div>
			<div class="panel-footer">
				<a class="btn btn-default" id="catsaveorder" href="#">{PHP.L.Save_order}</a>
				<a class="btn btn-default" id="catresync" href="{RESYNC_URL}">{PHP.L.Resync}</a>				
			</div>
		</div>
		
	</div>
	<div class="col-md-7 fixheader-md">
		<div class="panel panel-default">
			<div class="panel-body">
				<div id="objeditor">
				{EDITOR}
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END: MAIN -->