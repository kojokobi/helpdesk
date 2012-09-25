<!-- TICKETS FORM -->
    <div class="modal hide fade" id="tickets_form" data-backdrop="static" data-keyboard="false">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3> New Ticket </h3>
      </div>
      <div class="modal-body">
        <form class="form-vertical">
          <input type="hidden" ng-model="newTicket.projectId">
          <div class="control-group">
            <label class="control-label" for="title">Title:</label>
            <div class="controls">
              <input type="text" id="ticket_title" class='title_field' ng-model="newTicket.title">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="message">Describe the Problem:</label>
            <div class="controls">
              <textarea id="ticket_message" class='message_field' rows="6" ng-model="newTicket.message"></textarea>
            </div>
          </div>
          <div class="controls my_clear">
              <div class="pull-left">
                <label>Type:</label>
                <div>
                  <select class="ticket_combo" ng-model="newTicket.ticketId" ng-options='ticketType.id as ticketType.name for ticketType in ticketTypes'>
                  </select>
                </div>
              </div>
              <div class="pull-left">
                  <label>Priority:</label>
                  <div>
                    <select class="ticket_combo" ng-model="newTicket.priorityId" ng-options='priorityType.id as priorityType.name for priorityType in priorityTypes'>
                    </select>
                </div>
              </div>
              <div class="pull-right">
                  <label>Who is Responsible?:</label>
                  <div>
                   <select ng-model="newTicket.assignedId" ng-options='user.id as user.name for user in projectUsers'>

                </select>
                </div>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- <a href="#add_tickets" class="btn btn-success" ng-click="addTicket(newTicket)"><i class='icon-white icon-tags'></i> Create Ticket </a> -->
        <button class="btn btn-success" ng-click="addTicket(newTicket)"><i class='icon-white icon-tags'></i> Create Ticket </button>
        <button class="btn"><i class='icon icon-ban-circle'></i> Cancel</button>
      </div>
    </div>
    <!-- END OF ADD TICKETS FORM -->