<div>
	<div class="message_and_reply_box">
		<div class="single_ticket_thread">
			<div class="span12 outer">
				<div class="message original_message">
						<div class="picture_box span1">
							<?php echo HTML::image('img/icons/blue_user32.png',""); ?>
						</div>
						<div class="ticket_content" >
							<div class="title"> {{originalTicket.title}} 
								<span class='pull-right'> {{ }} </span>
							</div>
							<p> {{originalTicket.message}} </p>
							<div class="statusbox"> Status: <span class="status"> {{originalTicket.ticketStatus}}  </span> </div>
							<div class="datebox"> Issued On: <span class="date"> {{ originalTicket.createdAt}} </span> </div>
						</div>
					</div>
			</div>
		</div>
		<div class="single_ticket_thread" ng-hide="projectClosed">
			<div class="span12 outer">
				<div class="message reply">
					<div class="picture_box span1">
						<?php echo HTML::image('img/icons/blue_user32.png',""); ?>
					</div>
					<div class="ticket_content span11">
							
						<div>
							<textarea ng-model="newReply.message"></textarea>
						</div>
						<div class="form-inline">

							<label>Submit As:</label> 
							<select 
							ng-model="newReply.status"
							ng-options="status as status.name for status in ticketStatuses"></select>
							<button class="btn btn-info" ng-click="submitReply(newReply)"> <i class="icon-white icon-share-alt"></i> </button>
						</div>
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
				<?php echo HTML::image('img/icons/blue_user32.png',""); ?>
			</div>
			<div class="ticket_content">
					<p>
						{{reply.message}}
					</p>
					<div class="statusbox"> Status: <span class="status"> {{reply.ticketStatus}}  </span> </div>
					<div class="datebox"> Issued On: <span class="date"> {{reply.createdAt}}  </span> </div>
			</div>
		</div>

		<!-- end of thread -->

	</div>
</div>
</div>

