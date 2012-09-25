<div class="tab-pane" id="project" ng-controller="ProjectController">         
  <div class="btn-toolbar" style="margin-bottom: 9px">
    <div class="btn-group">
      <a class='btn btn-success' data-toggle="modal" href="#project_form"> <i class='icon-white icon-th-list'></i></a>
      <a class='btn btn-info'> <i class='icon-white icon-pencil'></i></a>
      <a class='btn btn-danger'> <i class='icon-white icon-trash'></i></a>
    </div>
  </div>
  <table  class='table table-striped table-bordered my-table'>
      <thead>
        <tr>
          <th class="grid_action1">#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Date Created</th>
          <th class='action'></th>
        </tr>
      </thead>
      <tbody>
        <!-- <tr>
          <td colspan='100'>No Projects created.</td>
        </tr> -->

        <tr ng-repeat="project in projects">
            <td> {{ $index + 1}}</td>
            <td> {{project.name}} </td>
            <td> {{project.description }} </td>
            <td> {{project.createdAt}} </td>
            <td> <a href="#"  ng-click="updateProjectDetails(project)"> <i class='icon icon-pencil'> </a></i> </td>
        </tr>
      </tbody>
  </table>

<?php echo View::make("components.project_form");  ?>
<?php echo View::make("components.project_detail_form");  ?>

</div>
