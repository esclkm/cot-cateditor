<!-- BEGIN: MAIN -->
<h2 class="fixheader-md">{ADMIN_STRUCTURE_HEADER}</h2>
<form name="savestructure" id="savestructure" action="{ADMIN_STRUCTURE_UPDATE_FORM_URL}" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="col-lg-12">
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
					<label class="col-sm-4 control-label">{PHP.L.Locked}:</label>
					<div class="col-sm-8">
						{ADMIN_STRUCTURE_LOCKED}
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
		</div>		
		<div class="col-lg-12">
			<!-- BEGIN: CONFIG -->


			<h3>{PHP.L.Configuration}</h3>{CONFIG_HIDDEN}
			{ADMIN_CONFIG_EDIT_CUSTOM}

			<div class="form-horizontal">
				<!-- BEGIN: ADMIN_CONFIG_ROW -->
				<!-- BEGIN: ADMIN_CONFIG_FIELDSET_BEGIN -->
				<h4>{ADMIN_CONFIG_FIELDSET_TITLE}</h4>
				<!-- END: ADMIN_CONFIG_FIELDSET_BEGIN -->
				<!-- BEGIN: ADMIN_CONFIG_ROW_OPTION -->
					<div class="form-group">
						<label class="col-sm-4 control-label" title="
							<!-- IF {PHP.config_owner} == 'module'-->&#123;PHP.cfg.{PHP.config_cat}.{PHP.config_name}&#125;<!-- ENDIF-->
							<!-- IF {PHP.config_owner} == 'plug'-->&#123;PHP.cfg.plugin.{PHP.config_cat}.{PHP.config_name}&#125;<!-- ENDIF-->
							<!-- IF {PHP.config_owner} == 'core'-->&#123;PHP.cfg.{PHP.config_name}&#125;<!-- ENDIF-->
							">{ADMIN_CONFIG_ROW_CONFIG_TITLE}:</label>
						<div class="col-sm-7">
							{ADMIN_CONFIG_ROW_CONFIG}
							<div class="adminconfigmore">{ADMIN_CONFIG_ROW_CONFIG_MORE}</div>
						</div>
						<div class="col-sm-1">
				<!--			<a href="{ADMIN_CONFIG_ROW_CONFIG_MORE_URL}" title="{PHP.L.Reset}"><i class="fa fa-undo"></i></a> -->
						</div>
					</div>
				<!-- END: ADMIN_CONFIG_ROW_OPTION -->
				<!-- END: ADMIN_CONFIG_ROW -->
			</div>
		</div>
	</div>
	<!-- END: CONFIG -->
	<div class="action_bar valid">
		<input type="submit" class="submit btn btn-success" value="{PHP.L.Update}" />
		<div class="pull-right">
			<!-- IF {ADMIN_STRUCTURE_OPTIONS_URL} --><a href="{ADMIN_STRUCTURE_OPTIONS_URL}" title="{PHP.L.Edit}" class="btn btn-info"><i class="fa fa-pencil"></i> {PHP.L.Edit}</a><!-- ENDIF -->
			<!-- IF {ADMIN_STRUCTURE_RIGHTS_URL} --><a href="{ADMIN_STRUCTURE_RIGHTS_URL}" title="{PHP.L.short_rights}" target="_blank" class="btn btn-default"><i class="fa fa-lock"></i> {PHP.L.Rights}</a><!-- ENDIF -->
			<!-- IF {ADMIN_STRUCTURE_JUMPTO_URL} --><a href="{ADMIN_STRUCTURE_JUMPTO_URL}" title="{PHP.L.short_open}" target="_blank" class="btn btn-default"><i class="fa fa-external-link"></i> {PHP.L.Open}</a><!-- ENDIF -->
			<!-- IF {PHP.n} == 'page' --><a href="{PHP.structure_code|cot_url('page', 'm=add&c=$this')}" title="{PHP.L.Add}" target="_blank" class="btn btn-default"><i class="fa fa-plus-circle"></i>  {PHP.L.Add}</a><!-- ENDIF -->
			<!-- IF {ADMIN_STRUCTURE_DEL_URL} --><a href="{ADMIN_STRUCTURE_DEL_URL}" title="{PHP.L.short_delete}" class="confirmLink btn btn-danger"><i class="fa fa-trash-o"></i> {PHP.L.Delete}</a><!-- ENDIF -->
		</div>
	</div>
		
</form>

<!-- END: MAIN -->