<?php echo View::make("common.header"); ?>
    <?php echo View::make("common.topmenu"); ?>
    <div class="container-fluid">
      <div class="row-fluid">
      <?php echo View::make("common.navigation")->with("page","dashboard"); ?>
        <div id="main_pane">
          <div class="inner span12 dash_overides">
            <?php echo View::make("dashboard.main"); ?>
          </div>
        </div><!--/span-->
        
      </div><!--/row-->
    </div><!--/.fluid-container-->

<?php echo View::make("common.footer"); ?>