<div>
  <div class="span12">
    <fieldset>
      <legend >Management</legend>
    </fieldset>
    <div class="tabbable">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#users" data-toggle="tab"> Users</a></li>
        <li><a href="#project" data-toggle="tab"> Projects</a></li>
      </ul>
      <div class="tab-content">
        <?php echo View::make("components.user_grid"); ?>
       <?php echo View::make("components.project_grid"); ?>
      </div>
    </div>
  </div><!--/span12-->
  
</div><!--/row-->