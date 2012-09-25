<div>
	<fieldset>
		<legend>
			Tickets
			<div  class='project_ticket_control pull-right'> 
				<input type= "hidden"  value="<?php echo Auth::user()->id; ?>" ng-model="app.userId" id="currentUser"/>
				<label>Project:</label>
				<select ng-model="currentProjectId" ng-options="userProject.id as userProject.name for userProject in userProjects"></select>
				<a href="#tickets_form" data-toggle="modal" class="btn btn-info"> 
					<i class="icon-white icon-tags"></i> Add Ticket</a>
			</div>
		</legend>
	</fieldset>
	<div>
		<table class='table table-bordered table-striped my-table ticket_table'>
			<thead>
				<tr>
					<th class="grid_action1">#</th>
					<th class="ticket_status">Status</th>
					<th class="ticket_title">Title</th>
					<th class="ticket_assigned_to">Assigned To</th>
					<th class="ticket_date">Date Issued</th>
					<th class="ticket_priority">Priority</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="ticket in tickets">
					<td> {{$index +1}} </td>
					<td> {{ticket.status}} </td>
					<td> <a href="#ticket/{{ticket.id}}"> {{ticket.title}}  </td>
					<td> {{ticket.assignedTo}} </a>  </td>
					<td> {{ticket.issuedDate}} </td>
					<td> {{ticket.priority}} </td>
				</tr>
			</tbody>
		</table>
	</div>
	
	<?php echo View::make("components.tickets_form"); ?>
</div>