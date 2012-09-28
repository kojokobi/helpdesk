<div class='container-fluid'>
	<div class='span12'>
		<fieldset>
			<legend>
				Tickets for {{currentProject.projectName}}
				<div  class='project_ticket_control pull-right'> 
					<label>Project:</label>
					<select 
						ng-model="currentProject" 
						ng-change="loadTickets()" 
						ng-options="userProject as userProject.projectName for userProject in userProjects"></select>
					<a class="btn btn-info" ng-click="showForm()"> 
						<i class="icon-white icon-tags"></i> Add Ticket</a>
				</div>
			</legend>
		</fieldset>
		<div>
			<div class="btn-group">
			  <button class="btn btn-info">Ticket Summaries</button>
			  <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
			    <span class="caret"></span>
			  </button>
			  <ul class="dropdown-menu ticket_badges">
			    <li ><a class="clearfix" href="tickets_view#all"> All  <span class='badge badge-inverse pull-right'> 100 </span> </a>  </li>
			    <li><a href="tickets_view#opened"> Open tickets <span class='badge badge-important pull-right'> 20 </span> </a>  </li>
                <li><a href="tickets_view#closed"> Closed tickets <span class='badge badge-success pull-right'> 15 </span></a>  </li>
                
              </ul>
			  </ul>
			</div>
		</div>
		<br>
		<div>
			<table class='table table-bordered table-striped my-table ticket_table'>
				<thead>
					<tr>
						<th class="grid_action1">#</th>
						<th class="ticket_status">Status</th>
						<th class="ticket_title">Title</th>
						<th class="ticket_assigned_to">Ticket Type</th>
						<th class="ticket_assigned_to">Assigned To</th>
						<th class="ticket_date">Date Issued</th>
						<th class="ticket_priority">Priority</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="ticket in tickets">
						<td> {{$index +1}} </td>
						<td> {{ticket.ticketStatus}} </td>
						<td> <a href="#ticket/{{ticket.id}}"> {{ticket.title}}  </td>
						<td> {{ticket.ticketType}} </td>
						<td> {{ticket.assignedTo}} </a>  </td>
						<td> {{ticket.createdAt}} </td>
						<td> {{ticket.priority}} </td>
					</tr>
				</tbody>
			</table>
		</div>
	
		<?php echo View::make("components.tickets_form"); ?>
	</div>
<div>