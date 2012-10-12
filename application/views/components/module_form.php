<!-- MODULE FORM -->
    <div class="modal hide fade" id="module_form" data-backdrop="static" data-keyboard="false">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>{{formTitle}} </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="control-group">
            <label class="control-label" for="title">Name:</label>
            <div class="controls">
              <input type="text" id="name" placeholder="Name" class='input-xlarge' ng-model="newModule.name">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="description">Description:</label>
            <div class="controls">
              <textarea id="description" class='input-xlarge' rows="6" ng-model="newModule.description"></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="description">List Order:</label>
            <div class="controls">
              <input type="number" id="listOrder" class='input-xlarge' ng-model="newModule.listOrder">
            </div>
          </div>
          <input type="hidden" ng-model="newModule.id">
        </form>
      </div>
      <div class="modal-footer">
        <button href="#" class="btn btn-success" ng-click="addModule(newModule)"><i class='icon-white icon-th'></i> Save Module </button>
        <button href="#" class="btn" data-dismiss="modal"><i class='icon icon-ban-circle'></i> Cancel</button>
      </div>
    </div>
<!-- END OF MODULE FORM -->