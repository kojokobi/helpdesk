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
		width: 150px;
		/*float: left;*/
	}

	.dash_item h2{
		margin-bottom: 0px;
	}
	.dash_title {
		display: block;
		color: #999;
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
</style>

<div>
	
	<div class="dash_content">
		<ul>
			<li>
				<div class="dash_item">
					<h2>8</h2>
					<span class='dash_title'>Projects</span>
					<span class="dash_percent success">100</span>
				</div>
			</li>
			<li>
				<div class="dash_item">
					<h2>150</h2>
					<span class='dash_title'>Tickets</span>
					<span class="dash_percent success">100%</span>
				</div>
			</li>
			<li>
				<div class="dash_item">
					<h2>50</h2>
					<span class="dash_title">Resolved Tickets</span>
					<span class="dash_percent success">33.33%</span>
				</div>
			</li>
			<li>
				<div class="dash_item">
					<h2>100</h2>
					<span class="dash_title">Unresolved Tickets</span>
					<span class="dash_percent unresolved">66.66%</span>
				</div>
			</li>
		</ul>
		
	</div>
</div>