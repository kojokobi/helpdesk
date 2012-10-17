<script type="text/javascript" src="js/app/rolescontroller.js"></script>
<div class="tab-pane" id="roles" ng-controller="RolesController">
           <div class="btn-toolbar" style="margin-bottom: 9px">
            <div class="btn-group">
              <button class='btn btn-success' ng-click="showNewRole" data-toggle="modal" href="#role_form"> <i class='icon-white icon-th'></i> </button>
              <button class='btn btn-info' ng-click="reload()"> <i class='icon-white icon- icon-repeat'></i> </button>
            </div>
          </div>
          <div>
            <table class='table table-striped table-bordered my-table'>
                <thead>
                  <tr>
                    <th class="grid_action1">#</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Date Created</th>
                    <th class='grid_action2'></th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td colspan='100'>No Users created.</td>
                  </tr> -->
                  <tr ng-repeat="role in roles">
                    <td> {{$index + 1}} </td>
                    <td> {{role.name}} </td>
                    <td> {{role.description}} </td>
                    <td> {{role.createdAt}} </td>
                    <td> 
                        <a href="#"  ng-click="editRole(role)"> <i class='icon icon-pencil'> </a></i> 
                        <a href="#"  ng-click="deleteRole(role)"> <i class='icon icon-remove'> </a></i> 
                    </td>
                  </tr>
                </tbody>
            </table>
          </div>
  <?php echo View::make("components.role_form"); ?>
  </div>