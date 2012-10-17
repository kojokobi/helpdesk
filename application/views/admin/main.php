<div>
  <div class="span12">
    <fieldset>
      <legend >Management</legend>
    </fieldset>
    <div class="tabbable">
      <ul class="nav nav-tabs tab_headers">
        <li class="active"><a href="#users" data-toggle="tab"> Users</a></li>
        <li><a href="#project" data-toggle="tab"> Projects</a></li>
        <li><a href="#roles" data-toggle="tab">Roles</a></li>
        <li><a href="#modules" data-toggle="tab">Modules</a></li>
        <li><a href="#module_permissions" data-toggle="tab">Module Permissions</a></li>
        <li><a href="#securables" data-toggle="tab">Securables</a></li>
        <li><a href="#permissions" data-toggle="tab">Permissions</a></li>
        
      </ul>
      <div class="tab-content">
        <?php echo View::make("components.user_grid"); ?>
        <?php echo View::make("components.project_grid"); ?>
        <?php echo View::make("components.roles_grid"); ?>
        <?php echo View::make("components.modules_grid"); ?>
        <?php echo View::make("components.module_role_permissions"); ?>
        <?php echo View::make("components.securables_grid"); ?>
        <?php echo View::make("components.securable_permissions_grid"); ?>
      </div>
    </div>
  </div><!--/span12-->
  
</div><!--/row-->