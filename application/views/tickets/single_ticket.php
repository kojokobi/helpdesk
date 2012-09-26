<div>
	<div class="message_and_reply_box">
		<div class="single_ticket_thread">
			<div class="span12 outer">
				<div class="message original_message">
						<div class="picture_box span1">
							<?php echo HTML::image('img/icons/blue_user48.png',""); ?>
						</div>
						<div class="ticket_content span11" >
							<div class="title">First Ticket</div>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
							<div class="datebox"> Issued On: <span class="date"><?php echo Date ("Y-m-d H:i"); ?> </span> </div>
						</div>
					</div>
			</div>
		</div>
		<div class="single_ticket_thread">
			<div class="span12 outer">
				<div class="message reply">
					<div class="picture_box span1">
						<?php echo HTML::image('img/icons/blue_user48.png',""); ?>
					</div>
					<div class="ticket_content span11">
							
						<div>
							<textarea ng-model="newReply.message"></textarea>
						</div>
							
						<button class="btn btn-info" ng-click="submitReply(newReply)"> <i class="icon-white icon-share-alt"></i> </button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="thread_box">
		<h4>Thread</h4>
	</div>
<div class="single_ticket_thread my_clear" >
	<div class="span12 thread">
		<!-- start of thread block -->
		<div class="message" ng-repeat="reply in ticketThread">
			<div class="picture_box span1">
				<?php echo HTML::image('img/icons/blue_user48.png',""); ?>
			</div>
			<div class="ticket_content">
					<p>
						{{reply.message}}
					</p>
					<div class="datebox"> Issued On: <span class="date"> {{reply.createdAt}}  </span> </div>
			</div>
		</div>

		<!-- end of thread -->

	</div>
</div>
</div>

