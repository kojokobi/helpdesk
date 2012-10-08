<style type="text/css">
	.dash_content {
		font-family: "proxima-nova", arial, sans-serif;
		position: relative;
		padding: 15px 20px;
		/*background: #49AFCD;*/
		background: #233143;
		/*background-image: -webkit-linear-gradient(#233143, #3E4859);
		background-image: -moz-linear-gradient(#233143, #3E4859);
		background-image: -o-linear-gradient(#233143, #3E4859);
		background-image: -ms-linear-gradient(#233143, #3E4859);
		background-image: linear-gradient(#233143, #3E4859);
		box-shadow: inset 0 1px 0 rgba(0, 0, 0, 0.27);*/
		color : white;
		overflow: hidden;
		text-align: center;
	}

	.dash_content ul{
		list-style: none;
	}

	.dash_content li {
		display: inline-block;
		width: 200px;
		float: left;
	}

	.dash_item {
		color: white;
		/*margin-right: 50px;*/
		/*min-width: 100px;*/
		/*width: 150px;*/
		/*float: left;*/
	}

	.dash_item h2{
		margin-bottom: 0px;
	}
	.dash_title {
		/*display: block;*/
		color: #eee;
	}

	.dash_item .dash_percent {
		font-size: 15px;
	}

	.dash_item .all {

	}
	.dash_item .success{
		color : #10e20b ;
	}

	.dash_item .unresolved{
		color : #ee0909 ;
	}

	.dash_mini_graph {
		width: 60px;
	}

	.my_container {
		padding-top: 20px;
		padding-left: 20px;
		padding-right : 20px;
		background: white;
	}

	.dash_caption {
		color: #3E576F;
		font-weight: normal;
	}

</style>
<div ng-controller="DashController">
	<div class="dash_content">
		<ul>
			<li>
				<div class="dash_item">
					<div class='pull-left dash_mini_graph'>
						<h2><span class="bar">2,4,9,7,12,10,12</span></h2>
					</div>
					<div class='pull-left'>
						<h2> {{summary.projects.count}}</h2>
						<span class="dash_title">Projects</span>
					</div>
				</div>
			</li>
			<li>
				<div class="dash_item">
					<div class='pull-left success dash_mini_graph'>
						<h2><span class="bar">2,4,9,7,12,10,12</span></h2>
						<span>100%</span>
					</div>
					<div class='pull-left'>
						<h2>{{summary.tickets.count}}</h2>
						<span class="dash_title">Tickets</span>
					</div>
					
				</div>
			</li>
			<li>
				<div class="dash_item">
					<div class='pull-left success dash_mini_graph'>
						<h2><span class="bar_good">2,4,9,7,12,10,12</span></h2>
						<span>{{summary.closed.percentage}}</span>
					</div>
					<div class='pull-left'>
						<h2>{{summary.closed.count}}</h2>
						<span class="dash_title	">Resolved Tickets</span>
					</div>
					
				</div>
			</li>
			<li>
				<div class="dash_item">
					<div class='pull-left unresolved dash_mini_graph'>
						<h2><span class="bar_bad">0,-3,-6,-4,-5,-4,-7</span></h2>
						<span>{{summary.unresolved.percentage}}</span>
					</div>
					<div class='pull-left'>
						<h2>{{summary.unresolved.count}}</h2>
						<span class="dash_title">Unresolved Tickets</span>
					</div>
					
				</div>
			</li>	
		</ul>
	</div>

	<div class='container-fluid my_container'>
		
		<div class="span6">
			<h4 class="dash_caption">Tickets Assigned To Me</h4>
			<table class='table table-bordered table-striped my-table ticket_table'>
				<thead>
					<tr>
						<th class="grid_action1">#</th>
						<th class="ticket_status">Status</th>
						<th >Title</th>
						<th class="ticket_type">Ticket Type</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="ticket in incomingTickets">
						<td>{{$index + 1}} </td>
						<td> {{ticket.ticketStatus}}</td>
						<td> <a href="tickets_view#/tickets/{{ticket.ticketId}}"> {{ticket.title}}  </td>
						<td>{{ticket.ticketType}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="span6">
			<div id="stack_div" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
		</div>
		
	</div>
	<div class='container-fluid my_container'>
		
		<div class="span6">
			<h4 class="dash_caption">Tickets From Me</h4>
			<table class='table table-bordered table-striped my-table ticket_table'>
				<thead>
					<tr>
						<th class="grid_action1">#</th>
						<th class="ticket_status">Status</th>
						<th >Title</th>
						<th class="ticket_type">Ticket Type</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="ticket in outgoingTickets">
						<td>{{$index + 1}} </td>
						<td> {{ticket.ticketStatus}}</td>
						<td> <a href="tickets_view#/tickets/{{ticket.ticketId}}"> {{ticket.title}}  </td>
						<td>{{ticket.ticketType}}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="span6">
			<div id="pie_div" style="min-width: 300px; height: 300px; margin: 0 auto"></div>
		</div>
		
	</div>
</div>