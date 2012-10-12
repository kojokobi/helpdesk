<!-- ROLE FORM -->
  <div class="modal hide fade" id="role_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>{{formTitle}} </h3>
    </div>
    <div class="modal-body">
      <form class="form-horizontal">
        <div class="control-group">
          <label class="control-label" for="title">Name:</label>
          <div class="controls">
            <input type="text" id="title" placeholder="Name" class='input-xlarge' ng-model="newRole.name">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="description">Description:</label>
          <div class="controls">
            <!-- <input type="text" id="description" placeholder="Description" class='input-xlarge'> -->
            <textarea id="description" class='input-xlarge' rows="6" ng-model="newRole.description"></textarea>
          </div>
        </div>
        <input type="hidden" ng-model="newRole.id">
      </form>
    </div>
    <div class="modal-footer">
      <button href="#" class="btn btn-success" ng-click="addRole(newRole)"><i class='icon-white icon-th'></i> Save Role </button>
      <button href="#" class="btn" data-dismiss="modal"><i class='icon icon-ban-circle'></i> Cancel</button>
    </div>
  </div>  
    <!-- ROLE FORM -->