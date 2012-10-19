<script type="text/javascript" src="js/app/modulepermissionscontroller.js"></script>
<style type="text/css">
  .role_modules_container {
    overflow: hidden;
    width: 900px;
  }

  .role_modules_container .control-label{
    margin-left: 50px;
    text-align: left;
    width: 0px;
    min-width: 120px;
    min-width: 60px;
  }

  .role_modules_container .controls {
    margin-left: 112px;
  }
</style>
<div class="tab-pane" id="module_permissions" ng-controller="ModulePermissionsController">
            <div class="">
              <div class="role_modules_container">
              <form class="form-horizontal">
                <div class="pull-left">
                  <label class="control-label" for="role">Role:</label>
                  <div class="controls">
                    <select id="role"  
                      ng-change="changePermissions()"
                      ng-model="modulePermission.role" class='input-xlarge user_select' name="roleId"
                      ng-options='role as role.name for role in roles'
                     >
                   </select> <button class='btn btn-info' ng-click="reload('roles')"> <i class='icon-white icon- icon-repeat'></i> </button>
                  </div>
                </div>
                <div class="pull-right">
                  <label class="control-label" for="ModuleId">Module:</label>
                  <div class="controls">
                    <select id="ModuleId" 
                      ng-change="changePermissions()"
                      ng-model="modulePermission.module" class='input-xlarge user_select' name="SecId"
                      ng-options='module as module.name for module in modules'
                     >
                   </select> <button class='btn btn-info' ng-click="reload('modules')"> <i class='icon-white icon- icon-repeat'></i> </button>
                  </div>
                </div>
                <input type="hidden" ng-model="modulePermission.id" > <!--The id if the permission -->
              </form>
              </div>
              <br>
              <h4 class='mini_table_header'>Permissions</h4>
              <table class="table table-striped table-bordered my-table permissions_table">
                <tbody >
                  <tr ng-repeat="permission in modulePermissions">
                    <td class="grid_action1"> {{$index + 1}} </td>
                    <td> {{ permission.label }} </td>
                    <td class="grid_action2"> <input type="checkbox" ng-model='permission.val' ng-true-value="1" ng-false-value="0"> </td>
                  </tr>
                </tbody>
              </table>
              <div> <button class="btn btn-success" ng-click="savePermissions()">Update Permissions</button> </div>
            </div>

  <?php //echo View::make("components.user_form"); ?>
  </div>