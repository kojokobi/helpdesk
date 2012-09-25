<?php $attr = array();
    function print_active($page, $header){
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
          <div class="accordion-heading <?php  print_active($page, "dashboard"); ?>">
            <a href="#dashboardCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
             <i class='icon-picture <?php  if($page === "dashboard") echo " icon-white"; ?> '></i> Dashboard
            </a>
          </div>
          <div class="accordion-body <?php open_menu($page,"dashboard"); ?>" id="dashboardCollapse" >
            <div class="accordion-inner">
              <ul>
                <li><a href="dashboard#">dashboard </a> </li>
                
              </ul>
            </div>
          </div>
        </div> 
        <div class="accordion-group">
          <div class="accordion-heading <?php  print_active($page, "tickets"); ?>">
            <a href="#ticketsCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
              <i class='icon-tags <?php  if($page === "tickets") echo " icon-white"; ?> '></i> Tickets
            </a>
          </div>
          <div class="accordion-body <?php open_menu($page,"tickets"); ?>" id="ticketsCollapse" >
            <div class="accordion-inner">
             <ul class="ticket_badges">
                <li><a href="tickets#unassigned"> Unassigned tickets</a> <span class='badge pull-right'> 35 </span> </li>
                <li><a href="tickets#assigned"> Assigned tickets</a> <span class='badge badge-info pull-right'> 30 </span> </li>
                <li><a href="tickets#opened"> Open tickets </a> <span class='badge badge-warning pull-right'> 20 </span> </li>
                <li><a href="tickets#closed"> Closed tickets</a> <span class='badge badge-success pull-right'> 15 </span> </li>
                <li><a href="tickets#all"> All tickets</a> <span class='badge badge-info pull-right'> 100 </span> </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="accordion-group">
          <div class="accordion-heading <?php  print_active($page, "admin"); ?>">
            <a href="#adminCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
             <i class='icon-th-list <?php  if($page === "admin") echo " icon-white"; ?> '></i> Admin
            </a>
          </div>
          <div class="accordion-body <?php open_menu($page,"admin"); ?>" id="adminCollapse" >
            <div class="accordion-inner">
              <ul>
                <li class=''><a href="admin#">Management </a> </li>
                
              </ul>
            </div>
          </div>
        </div>   
    </div>  
  </div><!--/.well -->
</div><!--/span-->