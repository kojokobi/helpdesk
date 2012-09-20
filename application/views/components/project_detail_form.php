
<div class="modal fade hide" id="projectDetails" data-backdrop="static" data-keyboard="false">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Project Details</h3>
  </div>
  <div class="modal-body project_detail" >
    <div class='project_item_group'>
      <label>Title:  </label>
      <div class="controls">
        <!-- <input type="text" class="input-xlarge uneditable-input" ng-model="currentProject.name"/> -->
        <span class="input-xlarge uneditable-input"> {{currentProject.name}} <span>
      </div>
    </div>
    <div class="project_item_group">
      <label>New Group:</label>
      <div class='controls'>
        <input type="text" class="input-xlarge" ng-model="currentProject.newGroup"/>  
        <a href="#" class="" ng-click="addGroup(currentProject)"><i class="icon icon-plus-sign"></i></a>
      </div>
    </div>

    <div class='user_group project_item_group'>
      <div class='pull-left'>
        <label>User:</label>
        <div class='user_group_control'>
          <select id="user_group_user" ng-model="userGroup.userId" class='input-small' name="user_group_user"
                    ng-options='user.id as user.firstName for user in users'
          ></select>
        </div>
      </div>
      <div class='user_group_control_right'>
        <label>Group:</label>
        <div class=''>
          <select id="user_group_group" ng-model="userGroup.projectGroupId" class='input-small' name="user_group_group"
                    ng-options='group.id as group.name for group in userGroups'
          ></select>
           <a href="#" class="" ng-click="addUserToGroup(userGroup)"><i class="icon icon-plus-sign"></i></a>
        </div>
      </div>
    </div>

    <div class='project_item_group'>
      <table class='table table-striped table-bordered my-table user_group_table'>
        <thead>
          <tr>
            <th>User</th>
            <th>Group</th>
            <th class="action"></th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="prus in projectUsers">
            <td> {{ prus.name }}</td>
            <td> {{ prus.group }} </td>
            <td> <a href="#"> <i class='icon icon-remove'></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
    <input type="hidden" name="projectId" ng-model="currentProject.projectId">
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary">Done</a>
  </div>
</div>