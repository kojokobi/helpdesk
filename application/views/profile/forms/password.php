<div>
	<h4>Basic Info</h4>
	<div class="container-fluid">
		<div class="container-fluid">
			<div class="span6">
				<form class="form-vertical">
					<div class="control-group">
				            <label  for="title">Old Password:</label>
				            <div>
				              <input type="text" id="ticket_title" class="input-xlarge" ng-model="password.oldPassword">
				            </div>
				    </div>
					<div class="controls my_clear">
						<div class="pull-left">
				            <label  for="title">New Password:</label>
				            <div >
				              <input type="text" id="ticket_title" class="input-xlarge" ng-model="user.newPassword">
				             </div>
				         </div>
			            <div class="pull-right">
				            <label for="title">Confirm New Password:</label>
					            <div >
					              <input type="text" id="ticket_title" class="input-xlarge" ng-model="user.confirmPassword">
					            </div>
							</div>
					</div>
					<button class="btn btn-info" ng-click=""> <i class="icon-random icon-white"></i> Change</button>
				</form>
			</div>
		</div>
	</div>
</div>