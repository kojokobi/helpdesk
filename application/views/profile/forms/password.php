<div>
	<h4>Password Change</h4>
	<div class="container-fluid">
		<div class="container-fluid">
			<div class="span6">
				<form class="form-vertical">
					<div class="control-group">
				            <label  for="title">Old Password:</label>
				            <div>
				              <input type="password" id="ticket_title" class="input-xlarge" ng-model="password.oldPassword">
				            </div>
				    </div>
					<div class="controls my_clear">
						<div class="pull-left">
				            <label  for="title">New Password:</label>
				            <div >
				              <input type="password" id="ticket_title" class="input-xlarge" ng-model="password.newPassword">
				             </div>
				         </div>
			            <div class="pull-right">
				            <label for="title">Confirm New Password:</label>
					            <div >
					              <input type="password" id="ticket_title" class="input-xlarge" ng-model="password.confirmPassword">
					            </div>
							</div>
					</div>
					<input type="hidden" ng-model="password.userId" ng-init="password.userId='<?php echo Auth::user()->id; ?>' ">
					<button class="btn btn-info" ng-click="changePassword(password)"> <i class="icon-random icon-white"></i> Change</button>
				</form>
			</div>
		</div>
	</div>
</div>