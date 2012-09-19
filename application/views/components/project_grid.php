
 <div class="tab-pane" id="project" ng-controller="ProjectController">
          <div class="toolbar">
            <a class='btn btn-success' data-toggle="modal" href="#project_form"> <i class='icon-white icon-th-list'></i></a>
            <a class='btn btn-info'> <i class='icon-white icon-pencil'></i></a>
            <a class='btn btn-danger'> <i class='icon-white icon-trash'></i></a>

            <a class='btn btn-inverse pull-right' data-toggle="modal" href="#projectDetails"> <i class='icon-white icon-user'></i> Project Details </a>
          </div>
          <table  class='table table-striped table-bordered my-table'>
              <thead>
                <tr>
                  <!-- <th>#</th> -->
                  <th>Title</th>
                  <th>Description</th>
                  <th>Date Created</th>
                </tr>
              </thead>
              <tbody>
                <!-- <tr>
                  <td colspan='100'>No Projects created.</td>
                </tr> -->

                <tr ng-repeat="project in projects">
                    <td> {{project.name}} </td>
                    <td> {{project.description }} </td>
                    <td> {{project.createdAt}} </td>
                </tr>
              </tbody>
          </table>
    
    <?php echo View::make("components.project_form");  ?>
    <?php echo View::make("components.project_detail_form");  ?>

</div>
