<?php echo View::make("common.header"); ?>
    <?php echo View::make("common.topmenu"); ?>
    <div class="container-fluid">
      <div class="row-fluid">
      <?php echo View::make("common.navigation")->with("page","tickets"); ?>
        <div class="span10" id="main_pane">
          <?php echo View::make("tickets.main"); ?>
        </div><!--/span-->
        <!-- <footer>
          <p>&copy; Axon Information Systems 2012</p>
        </footer> -->
      </div><!--/row-->
    </div><!--/.fluid-container-->

<?php echo View::make("common.footer"); ?>