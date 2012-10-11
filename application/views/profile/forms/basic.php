<div>
	<h4>Basic Info </h4>
	<div class="container-fluid">
		<div class="container-fluid">
			<div class="span6">
				<form class="form-vertical">
					
					<div class="controls my_clear">
						<div class="pull-left">
				            <label  for="title">First Name:</label>
				            <div >
				              <input type="text" id="ticket_title" class="input-xlarge" 
				              ng-model="user.firstName" ng-init="user.firstName='<?php echo Auth::user()->first_name; ?>'">
				             </div>
				         </div>
			            <div class="pull-right">
				            <label for="title">Last Name:</label>
					            <div >
					              <input type="text" id="ticket_title" class="input-xlarge" 
					              ng-model="user.lastName" ng-init="user.lastName='<?php echo Auth::user()->last_name; ?>'">
					            </div>
							</div>
					</div>
					<div class="controls my_clear">
						<div class="pull-left">
				            <label  for="title">Username:</label>
				            <div>
				              <input type="text" id="ticket_title" class="input-xlarge" 
				              ng-model="user.userName" ng-init="user.userName='<?php echo Auth::user()->user_name; ?>'">
				             </div>
				         </div>
			            <div class="pull-right">
				            <label for="title">Email:</label>
					            <div>
					              <input type="text" id="ticket_title" class="input-xlarge" 
					              ng-model="user.email" ng-init="user.email='<?php echo Auth::user()->email; ?>'">
					            </div>
							</div>
					</div>
					<input type="hidden" ng-model="user.id" ng-init="user.id='<?php echo Auth::user()->id; ?>' ">
					<button class="btn btn-info" ng-click="updateProfile(user)"> <i class="icon-inbox icon-white"></i> Update</button>  
					<span ng-show='updatingProfile'><?php echo HTML::image("img/icons/loading.gif"); ?> Saving...</span>
					
				</form>
			</div>
			<div class="span6">
				<!-- <ul class="thumbnails">
				  <li class="span4">
				    <a href="#" class="thumbnail">
				      <img src="http://placehold.it/300x200" alt="">
				    </a>
				  </li>
				</ul> -->
				<div>
					<?php echo  HTML::image("img/icons/user128.png", "", array("class"=>"img-polaroid")); ?>
				</div>
				<input type="file" name="" />   
			</div>
		</div>
	</div>

</div>
