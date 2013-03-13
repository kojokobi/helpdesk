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
						ng-options="userProject as userProject.projectName for userProject in userProjects">
					</select>
						<a class="btn btn-info" ng-click="showForm()"> 
						<i class="icon-white icon-tags"></i> Add Ticket</a>
				</div>
			</legend>
		</fieldset>
		<div>
			
			<div class="btn-group" data-toggle="buttons-radio">
			  <button type="button" class="btn {{ changeTicketClass('all') }} active" ng-click="selectTicketStatus('all')">all ({{ count('all') }})</button>
			  <button type="button" class="btn {{ changeTicketClass('open') }}" ng-click="selectTicketStatus('open')">open ({{ count('open') }})</button>
			  <button type="button" class="btn {{ changeTicketClass('pending') }}" ng-click="selectTicketStatus('pending')">pending ({{ count('pending') }})</button>
			  <button type="button" class="btn {{ changeTicketClass('resolved') }}" ng-click="selectTicketStatus('resolved')">resolved ({{ count('resolved') }})</button>
			  <button type="button" class="btn {{ changeTicketClass('unresolved') }}" ng-click="selectTicketStatus('unresolved')">unresolved ({{ count('unresolved') }})</button>
			  <button type="button" class="btn {{ changeTicketClass('closed') }}" ng-click="selectTicketStatus('closed')">closed ({{ count('closed') }})</button>
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
						<th class="ticket_assigned_to">From</th>
						<th class="ticket_assigned_to">Assigned To</th>
						<th class="ticket_date">Date Issued</th>
						<th class="ticket_priority">Priority</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="ticket in tickets">
						<td> {{$index +1}} </td>
						<td> <span ng-class="checkStatus(ticket.ticketStatus)"> {{ ticket.ticketStatus | lowercase }} </span></td>
						<td> <a href="#/tickets/{{ticket.id}}"> {{ticket.title}}  </td>
						<td> {{ticket.ticketType | lowercase }} </td>
						<td> {{ticket.assignedFrom }}</td>
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