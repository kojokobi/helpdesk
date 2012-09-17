<div class="modal fade hide" id="projectDetails" data-backdrop="static" data-keyboard="false">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Project Details</h3>
  </div>
  <div class="modal-body project_detail" >
    <div class='project_item_group'>
      <label>Title:  </label>
      <div class="controls">
        <input type="text" class="input-xlarge" value="Axon Desk"/>
      </div>
    </div>
    <div class="project_item_group" >
      <label>New Group:</label>
      <div class='controls'>
        <input type="text" class="input-xlarge" />  
        <a href="#" class=""><i class="icon icon-plus-sign"></i></a>
      </div>
    </div>

    <div class='user_group project_item_group'>
      <div class='pull-left'>
        <label>User:</label>
        <div class='user_group_control'>
          <select name="" class='input-small' id='user_group_user'>
            <option>Kojo Mensah</option>
          </select>
        </div>
      </div>
      <div class='user_group_control_right'>
        <label>Group:</label>
        <div class=''>
          <select name="" class='input-small'>
            <option>Group 1</option>
          </select>
           <a href="#" class=""><i class="icon icon-plus-sign"></i></a>
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
          <tr>
            <td>Kojo Kumah</td>
            <td>Axon</td>
            <td> <a href="#"> <i class='icon icon-remove'></i></a> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn btn-primary">Done</a>
  </div>
</div>