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
					<!-- IF {ADMIN_STRUCTURE_COUNT} --><span class="pull-right small"> ({ADMIN_STRUCTURE_COUNT})</span><!-- ENDIF -->	
				</a>
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
