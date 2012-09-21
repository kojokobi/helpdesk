<div ng-controller="TicketController">

	<fieldset>
		<legend>
			Tickets
			<div  class='project_ticket_control pull-right'> 
				
				<label>Project:</label>
				<select></select>
				<a href="#tickets_form" data-toggle="modal" class="btn btn-info"> 
					<i class="icon-white icon-tags"></i> Add Ticket</a>
			</div>
		</legend>
	</fieldset>
	<div>
		<table class='table table-bordered table-striped my-table'>
			<thead>
				<tr>
					<th>#</th>
					<th>Status</th>
					<th>Title</th>
					<th>Description</th>
					<th></th>
				</tr>
			</thead>
		</table>
	</div>
	
	<?php echo View::make("components.tickets_form"); ?>
</div>