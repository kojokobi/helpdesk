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
						<h2>8</h2>
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
						<h2>150</h2>
						<span class="dash_title">Tickets</span>
					</div>
					
				</div>
			</li>
			<li>
				<div class="dash_item">
					<div class='pull-left success dash_mini_graph'>
						<h2><span class="bar_good">2,4,9,7,12,10,12</span></h2>
						<span>66.66%</span>
					</div>
					<div class='pull-left'>
						<h2>100</h2>
						<span class="dash_title	">Resolved Tickets</span>
					</div>
					
				</div>
			</li>
			<li>
				<div class="dash_item">
					<div class='pull-left unresolved dash_mini_graph'>
						<h2><span class="bar_bad">0,-3,-6,-4,-5,-4,-7</span></h2>
						<span>33.33%</span>
					</div>
					<div class='pull-left'>
						<h2>50</h2>
						<span class="dash_title">Unresolved Tickets</span>
					</div>
					
				</div>
			</li>
			
		</ul>
		
	</div>
</div>