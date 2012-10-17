<div class="tab-pane active" id="users" ng-controller="UserController">
           <div class="btn-toolbar" style="margin-bottom: 9px">
            <div class="btn-group">
              <button class='btn btn-success' ng-click="showNewUser()" data-toggle="modal" href="#user_form"> <i class='icon-white icon-user'></i> </button>
              <button class='btn btn-info' ng-click="reload()"> <i class='icon-white icon- icon-repeat'></i> </button>
            </div>
          </div>
          <div>
            <table class='table table-striped table-bordered my-table'>
                <thead>
                  <tr>
                    <th class="grid_action1">#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Projects</th>
                    <th class='grid_action2'></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td colspan='100'>No Users created.</td>
                  </tr> -->
                  <tr ng-repeat="user in users">
                    <td> {{$index + 1}} </td>
                    <td> {{user.firstName}} </td>
                    <td> {{user.lastName}} </td>
                    <td> {{user.userName}} </td>
                    <td> {{user.email}} </td>
                    <td> {{user.numProjects}} </td>
                    <td> 
                      <a href="#"  ng-click="editUser(user)"> <i class='icon icon-pencil'> </a></i> 
                      <a href="#"  ng-click="deleteUser(user)"> <i class='icon icon-remove'> </a></i> 
                    </td>
                  </tr>
                </tbody>
            </table>
          </div>
  <?php echo View::make("components.user_form"); ?>
  </div>