<script type="text/javascript" src="js/app/permissionscontroller.js"></script>
<style type="text/css">
  .role_securables_container {
    overflow: hidden;
    width: 900px;
  }

  .role_securables_container .control-label{
    margin-left: 50px;
    text-align: left;
    width: 0px;
    min-width: 120px;
    min-width: 60px;
  }

  .role_securables_container .controls {
    margin-left: 112px;
  }
</style>
<div class="tab-pane" id="permissions" ng-controller="PermissionsController">
          <!--  <div class="btn-toolbar" style="margin-bottom: 9px">
            <div class="btn-group">
              <button class='btn btn-success' data-toggle="modal" href="#permission_form"> <i class='icon-white icon-th'></i> </button>
              <button class='btn btn-info' ng-click="reload()"> <i class='icon-white icon- icon-repeat'></i> </button>
            </div>
          </div> -->
          <div>
            <div class="">
              <div class="role_securables_container">
              <form class="form-horizontal">
                <div class="pull-left">
                  <label class="control-label" for="roleId">Role:</label>
                  <div class="controls">
                    <select id="roleId" 
                      ng-change="changePermissions()"
                      ng-model="securablePermission.roleId" class='input-xlarge user_select' name="roleId"
                      ng-options='role as role.name for role in roles'
                     >
                   </select> <button class='btn btn-info' ng-click="reload('roles')"> <i class='icon-white icon- icon-repeat'></i> </button>
                  </div>
                </div>
                <div class="pull-right">
                  <label class="control-label" for="SecId">Securable:</label>
                  <div class="controls">
                    <select id="SecId" 
                      ng-change="changePermissions()"
                      ng-model="securablePermission.secId" class='input-xlarge user_select' name="SecId"
                      ng-options='securable as securable.name for securable in securables'
                     >
                   </select> <button class='btn btn-info' ng-click="reload('securables')"> <i class='icon-white icon- icon-repeat'></i> </button>
                  </div>
                </div>
                <input type="hidden" ng-model="securablePermission.id" > <!--The id if the permission -->
              </form>
              </div>
              <br>
              <h4 class='mini_table_header'>Permissions</h4>
              <table class="table table-striped table-bordered my-table permissions_table">
                <tbody >
                  <tr ng-repeat="permission in securablePermissions">
                    <td class="grid_action1"> {{$index + 1}} </td>
                    <td> {{ permission.label }} </td>
                    <td class="grid_action2"> <input type="checkbox" ng-model='permission.val' ng-true-value="1" ng-false-value="0"> </td>
                  </tr>
                </tbody>
              </table>
              <div> <button class="btn btn-success" ng-click="savePermissions()">Update Permissions</button> </div>
            </div>
          </div>
  <?php //echo View::make("components.user_form"); ?>
  </div>