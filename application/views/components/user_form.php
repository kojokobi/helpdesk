             <!-- ADD USER FORM -->
        <div class="modal hide fade" id="user_form" data-backdrop="static" data-keyboard="false">
          <div class="modal-header">
            <a class="close" data-dismiss="modal">×</a>
            <h3> {{ formTitle }} </h3>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <div class="control-group">
                <label class="control-label" for="firstName">First Name:</label>
                <div class="controls">
                  <input type="text" id="firstName" placeholder="First Name" class='input-xlarge' ng-model="newUser.firstName">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="lastName">Last Name:</label>
                <div class="controls">
                  <input type="text" id="lastName" placeholder="Last Name" class='input-xlarge' ng-model="newUser.lastName">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="userName">User Name:</label>
                <div class="controls">
                  <input type="text" id="userName" placeholder="User Name" class='input-xlarge' ng-model="newUser.userName">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="email">Email:</label>
                <div class="controls">
                  <input type="text" id="email" placeholder="Email" class='input-xlarge' ng-model="newUser.email">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password">Password:</label>
                <div class="controls">
                  <input type="password" id="password" placeholder="Password" class='input-xlarge' ng-model="newUser.password">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="jobTitleId">Job Title:</label>
                <div class="controls">
                  <select id="jobTitleId" ng-model="newUser.jobTitleId" class='input-xlarge user_select' name="jobTitleId" 
                  ng-options='jt.id as jt.name for jt in jobTitles'
                  ></select>
                  </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="roleId">Role:</label>
                <div class="controls">
                  <select id="roleId" ng-model="newUser.roleId" class='input-xlarge user_select' name="roleId"
                    ng-options='role.id as role.name for role in roles'
                   >
                 </select>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer"> 
            <button href="#" class="btn btn-success" ng-click="addUser(newUser)"><i class='icon-white icon-user'></i> Save User </button>
            <button data-dismiss="modal" href="#" class="btn"><i class='icon icon-ban-circle'></i> Cancel</button>
          </div>
        </div>
        <!-- END OF ADD USER FORM -->