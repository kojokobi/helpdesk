<!-- ADD PROJECT FORM -->
    <div class="modal hide fade" id="project_form" data-backdrop="static" data-keyboard="false" ng-controller="ProjectController">
      <div class="modal-header">
        <a class="close" data-dismiss="modal">×</a>
        <h3>{{formTitle}} </h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="control-group">
            <label class="control-label" for="title">Title:</label>
            <div class="controls">
              <input type="text" id="title" placeholder="Title" class='input-xlarge' ng-model="newProject.name">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="description">Description:</label>
            <div class="controls">
              <!-- <input type="text" id="description" placeholder="Description" class='input-xlarge'> -->
              <textarea id="description" class='input-xlarge' rows="10" ng-model="newProject.description"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-success" ng-click="addProject(newProject)"><i class='icon-white icon-th-list'></i> Save Project </a>
        <a href="#" class="btn"><i class='icon icon-ban-circle'></i> Cancel</a>
      </div>
    </div>
    <!-- END OF ADD PAROJECT FORM -->