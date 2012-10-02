<?php 
    function print_selected_item($page, $header){
      $selectedItem = "";
      if($page===$header)
        $selectedItem = " nav_selected_item";
      echo $selectedItem;
    }
    function print_active_header($page, $header){
      $active_header = "";
      if($page===$header)
        $active_header = " active_header ";
      echo $active_header;
    }

    function open_menu($page,$header) {
        $opener  = " collapse";
        if($page === $header)
          $opener = "in ";
        echo $opener;
    }
 ?>

<div class="thesidebar">
  <div class="sidebar-nav list_view" id='nav_menu'>
    <div id="navigatingAccordion" class="accordion">
      <div class="accordion-group">
          <div class="accordion-heading <?php  print_active_header($page, "dashboard"); ?>">
            <a href="#dashboardCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
             <i class='icon-picture <?php  if($page === "dashboard") echo " icon-white"; ?> '></i>Dashboard
            </a>
          </div>
          <div class="accordion-body <?php open_menu($page,"dashboard"); ?>" id="dashboardCollapse" >
            <div class="accordion-inner">
              <ul>
                <li class='<?php print_selected_item($page,"dashboard"); ?>' ><a href="dashboard_view#"><i class='icon-arrow-right'></i>dashboard </a> </li>
              </ul>
            </div>
          </div>
        </div> 
        <div class="accordion-group">
          <div class="accordion-heading <?php  print_active_header($page, "tickets"); ?>">
            <a href="#ticketsCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
              <i class='icon-tags <?php  if($page === "tickets") echo " icon-white"; ?> '></i> Tickets
            </a>
          </div>
          <div class="accordion-body <?php open_menu($page,"tickets"); ?>" id="ticketsCollapse" >
            <div class="accordion-inner">
             <ul class="ticket_badges">
                <li class='<?php print_selected_item($page,"tickets"); ?>' ><a href="tickets_view#"> <i class='icon-arrow-right'></i>view tickets</a>  </li>
                </ul>
            </div>
          </div>
        </div>
        <div class="accordion-group">
          <div class="accordion-heading <?php  print_active_header($page, "admin"); ?>">
            <a href="#adminCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
             <i class='icon-th-list <?php  if($page === "admin") echo " icon-white"; ?> '></i> Admin
            </a>
          </div>
          <div class="accordion-body <?php open_menu($page,"admin"); ?>" id="adminCollapse" >
            <div class="accordion-inner">
              <ul>
                <li class='<?php print_selected_item($page,"admin"); ?>'><a href="admin_view#"><i class='icon-arrow-right'></i>management </a> </li>
              </ul>
            </div>
          </div>
        </div>   
    </div>  
  </div><!--/.well -->
</div><!--/span-->