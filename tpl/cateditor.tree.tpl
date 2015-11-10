<!-- BEGIN: MAIN -->
<div class="dd">
<!-- BEGIN: CATS -->
	<ol class="dd-list">
		<!-- BEGIN: ROW -->
		<li  class="dd-item  dd3-item<!-- IF {ADMIN_STRUCTURE_SELECTED}--> active<!-- ENDIF -->" data-id="{ADMIN_STRUCTURE_ID}" >
				<div class="dd-handle dd3-handle">Drag</div> 
				<div class="dd3-content">
					
					<a href="{ADMIN_STRUCTURE_EDIT_URL}" data-ajaxhref="{ADMIN_STRUCTURE_AJAX_EDIT_URL}" title="{ADMIN_STRUCTURE_TITLE}">
						{ADMIN_STRUCTURE_TITLE}

					</a>
					<div class="pull-right">
						<!-- IF {ADMIN_STRUCTURE_COUNT} --><span class="small"> {ADMIN_STRUCTURE_COUNT}</span> <!-- ENDIF -->
						<a href="{ADMIN_STRUCTURE_OPEN_URL}" title="{PHP.L.short_open}" target="_blank"><i class="fa fa-external-link"></i></a> &nbsp;

						<!-- IF {PHP.n} == 'page' -->
						<a href="{ADMIN_STRUCTURE_CODE|cot_url('page', 'm=add&c=$this')}" title="{PHP.L.Add}" target="_blank"><i class="fa fa-plus-circle"></i></a> &nbsp;
						<!-- ENDIF -->					
						<a href="{ADMIN_STRUCTURE_RIGHTS_URL}" title="{PHP.L.short_rights}" target="_blank"><i class="fa fa-lock"></i></a>

					</div>
				</div>
			<!-- IF {ADMIN_STRUCTURE_CHILDREN} -->
				{ADMIN_STRUCTURE_CHILDREN}
			<!-- ENDIF -->
		</li>
		<!-- END: ROW -->
	</ol>
<!-- END: CATS -->	
</div>

<!-- END: MAIN -->