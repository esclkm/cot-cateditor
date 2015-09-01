<!-- BEGIN: MAIN -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">{PHP.L.Modules}</h4>
    </div>
    <div class="panel-body">
        <!-- BEGIN: ADMIN_STRUCTURE_EXT -->
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2 margintop10 marginbottom10">
            <a href="{ADMIN_STRUCTURE_EXT_URL}" class="thumbicons">
                <!-- IF {ADMIN_STRUCTURE_EXT_ICO} -->
                <img src="{ADMIN_STRUCTURE_EXT_ICO}"/>
                <!-- ELSE -->
                <img src="{PHP.cfg.system_dir}/admin/img/plugins32.png"/>
                <!-- ENDIF -->
                {ADMIN_STRUCTURE_EXT_NAME}
            </a>
        </div>
        <!-- END: ADMIN_STRUCTURE_EXT -->
        <!-- BEGIN: ADMIN_STRUCTURE_EMPTY -->
        <div class="well">{PHP.L.adm_listisempty}</div>
        <!-- END: ADMIN_STRUCTURE_EMPTY -->
    </div>
</div>
<!-- END: MAIN -->