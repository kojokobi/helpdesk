
<div class="span2 thesidebar">
  <div class="sidebar-nav list_view" id='nav_menu'>
    <div id="navigatingAccordion" class="accordion">
      <div class="accordion-group">
          <div class="accordion-heading <?php  if($page === "dashboard") echo " active_header"; ?>">
            <a href="#dashboardCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
             <i class='icon-picture <?php  if($page === "dashboard") echo " icon-white"; ?> '></i> Dashboard
            </a>
          </div>
          <div class="accordion-body collapse" id="dashboardCollapse" >
            <div class="accordion-inner">
              <ul>
                <li><a href="dashboard#">dashboard </a> </li>
                
              </ul>
            </div>
          </div>
        </div> 
        <div class="accordion-group">
          <div class="accordion-heading <?php  if($page === "tickets") echo " active_header"; ?>">
            <a href="#ticketsCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
              <i class='icon-tags <?php  if($page === "tickets") echo " icon-white"; ?> '></i> Tickets
            </a>
          </div>
          <div class="accordion-body collapse" id="ticketsCollapse" >
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
          <div class="accordion-heading <?php  if($page === "admin") echo " active_header"; ?>">
            <a href="#adminCollapse" data-parent="#navigatingAccordion" data-toggle="collapse" class="accordion-toggle">
             <i class='icon-th-list <?php  if($page === "admin") echo " icon-white"; ?> '></i> Admin
            </a>
          </div>
          <div class="accordion-body in" id="adminCollapse" >
            <div class="accordion-inner">
              <ul>
                <li class='nav_selected_item'><a href="admin#">Management </a> </li>
                
              </ul>
            </div>
          </div>
        </div>   
    </div>  
  </div><!--/.well -->
</div><!--/span-->