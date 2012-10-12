<script type="text/javascript" src="js/app/permissionscontroller.js"></script>
<div class="tab-pane" id="permissions" ng-controller="PermissionsController">
           <div class="btn-toolbar" style="margin-bottom: 9px">
            <div class="btn-group">
              <button class='btn btn-success' data-toggle="modal" href="#permission_form"> <i class='icon-white icon-th'></i> </button>
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
                  </tr>
                </tbody>
            </table>
          </div>
  <?php //echo View::make("components.user_form"); ?>
  </div>