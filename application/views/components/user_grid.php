<div class="tab-pane active" id="users" ng-controller="UserController">
           <div class="btn-toolbar" style="margin-bottom: 9px">
            <div class="btn-group">
              <a class='btn btn-success' data-toggle="modal" href="#user_form"> <i class='icon-white icon-user'></i> </a>
              <a class='btn btn-info'> <i class='icon-white icon-pencil'></i> </a>
              <a class='btn btn-danger'> <i class='icon-white icon-trash'></i> </a>
            </div>
          </div>
          <div>
            <table class='table table-striped table-bordered my-table'>
                <thead>
                  <tr>
                    <!-- <th>#</th> -->
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. Projects</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- <tr>
                    <td colspan='100'>No Users created.</td>
                  </tr> -->
                  <tr ng-repeat="user in users">
                    <td> {{user.firstName}} </td>
                    <td> {{user.lastName}} </td>
                    <td> {{user.userName}} </td>
                    <td> {{user.email}} </td>
                    <td> {{user.numProjects}} </td>
                  </tr>
                </tbody>
            </table>
          </div>
  <?php echo View::make("components.user_form"); ?>
  </div>