<!-- SECURABLE FORM -->
  <div class="modal hide fade" id="securable_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>{{formTitle}} </h3>
    </div>
    <div class="modal-body">
      <form class="form-horizontal">
        <div class="control-group">
          <label class="control-label" for="name">Name:</label>
          <div class="controls">
            <input type="text" id="name" placeholder="Name" class='input-xlarge' ng-model="newSec.name">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="displayName">Display Name:</label>
          <div class="controls">
            <input type="text" id="displayName" placeholder="Display Name" class='input-xlarge' ng-model="newSec.displayName">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="moduleId">Module:</label>
          <div class="controls">
            <select id="moduleId" ng-model="newSec.moduleId" class='input-xlarge user_select' name="moduleId"
              ng-options='module.id as module.name for module in modules'
             >
           </select>
          </div>
        </div>
      
        <input type="hidden" ng-model="newSec.id">
        
      </form>
    </div>
    <div class="modal-footer">
      <button href="#" class="btn btn-success" ng-click="addSecurable(newSec)"><i class='icon-white icon-th'></i> Save Securable </button>
      <button href="#" class="btn" data-dismiss="modal"><i class='icon icon-ban-circle'></i> Cancel</button>
    </div>
  </div>
<!-- END OF SECURABLE FORM -->