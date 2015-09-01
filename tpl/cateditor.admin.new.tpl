<!-- BEGIN: MAIN -->
<h2 class="fixheader-md">{PHP.L.new_category}</h2>
<form name="addstructure" id="addstructure" action="{ADMIN_STRUCTURE_URL_FORM_ADD}" method="post" enctype="multipart/form-data">
	
		<div class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-4 control-label">{PHP.L.Title}:</label>
				<div class="col-sm-8">
					{ADMIN_STRUCTURE_TITLE}<small>{PHP.L.adm_required}</small>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">{PHP.L.Code}:</label>
				<div class="col-sm-8">
					{ADMIN_STRUCTURE_CODE}<small>({PHP.L.auto_generation})</small>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">{PHP.L.parent_category}:</label>
				<div class="col-sm-8">
					{ADMIN_STRUCTURE_PARENT}
				</div>
			</div>				


			<div class="form-group">
				<label class="col-sm-4 control-label">{PHP.L.Locked}:</label>
				<div class="col-sm-8">
					{ADMIN_STRUCTURE_LOCKED}
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-4 control-label">{PHP.L.Description}:</label>
				<div class="col-sm-8">
					{ADMIN_STRUCTURE_DESC}
				</div>
			</div>				
			<div class="form-group">
				<label class="col-sm-4 control-label">{PHP.L.Icon}:</label>
				<div class="col-sm-8">
					{ADMIN_STRUCTURE_ICON}
				</div>
			</div>	
			<div class="form-group">
				<label class="col-sm-4 control-label">{PHP.L.TPL}:</label>
				<div class="col-sm-8">{ADMIN_STRUCTURE_TPL}</div>
			</div>	

			<!-- BEGIN: EXTRAFLD -->
			<div class="form-group">
				<label class="col-sm-4 control-label">{ADMIN_STRUCTURE_EXTRAFLD_TITLE}:</label>
				<div class="col-sm-8">
					{ADMIN_STRUCTURE_EXTRAFLD}
				</div>
			</div>				
			<!-- END: EXTRAFLD -->
		</div>
			
		<div class="action_bar valid">
			<button type="submit" class="submit btn btn-success">{PHP.L.Add}</button>
		</div>

</form>

<!-- END: MAIN -->