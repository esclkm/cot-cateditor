<!-- BEGIN: MAIN -->
<h3>{PHP.L.Modules}</h3>
<!-- BEGIN: ADMIN_STRUCTURE_EMPTY -->
<div class="well">{PHP.L.adm_listisempty}</div>
<!-- END: ADMIN_STRUCTURE_EMPTY -->
<!-- IF {ADMIN_STRUCTURE_EXT_NAME} -->
<div class="list-group">
	<!-- BEGIN: ADMIN_STRUCTURE_EXT -->
	<a href="{ADMIN_STRUCTURE_EXT_URL}" class="list-group-item">
		<!-- IF {ADMIN_STRUCTURE_EXT_ICO} -->
		<img src="{ADMIN_STRUCTURE_EXT_ICO}"/>
		<!-- ELSE -->
		<img src="{PHP.cfg.system_dir}/admin/img/plugins32.png"/>
		<!-- ENDIF -->
		{ADMIN_STRUCTURE_EXT_NAME}
	</a>
	<!-- END: ADMIN_STRUCTURE_EXT -->
</div>
<!-- ENDIF -->
<!-- END: MAIN -->