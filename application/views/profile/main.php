<div>
  <div class="span12">
    <fieldset>
      <legend >Profile</legend>
    </fieldset>
    <div class="tabbable">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#profile" data-toggle="tab"> Profile</a></li>
        <li><a href="#settings" data-toggle="tab"> Settings</a></li>
      </ul>
      <div class="tab-content">
        <?php echo View::make("profile.profiletab"); ?>
       	<?php echo View::make("profile.settings"); ?>
      </div>
    </div>
  </div><!--/span12-->
  
</div><!--/row-->