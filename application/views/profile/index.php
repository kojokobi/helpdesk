<?php echo View::make("common.header"); ?>
    <?php echo View::make("common.topmenu"); ?>
    <div class="container-fluid">
      <div class="row-fluid"> 
     <?php echo View::make("common.navigation")->with("page",""); ?>
        <div class="" id="main_pane">
          <div class="inner span12">
            <?php echo View::make("profile.main"); ?>
          </div>
        </div><!--/span-->
        
        <!-- <footer>
          <p>&copy; Axon Information Systems 2012</p>
        </footer> -->
      </div><!--/row-->
    </div><!--/.fluid-container-->

<?php echo View::make("common.footer"); ?>