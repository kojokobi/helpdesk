<div class="row-fluid">
            <div class="span12">
              <fieldset>
                <legend >Management</legend>
              </fieldset>
              <div class="tabbable">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#users" data-toggle="tab"> Users</a></li>
                  <li><a href="#project" data-toggle="tab"> Projects</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="users">
                    <div class="toolbar">
                      <a class='btn btn-success' data-toggle="modal" href="#user_form"> <i class='icon-white icon-user'></i> Add</a>
                      <a class='btn btn-info'> <i class='icon-white icon-user'></i> Edit</a>
                      <a class='btn btn-danger'> <i class='icon-white icon-trash'></i> Delete</a>
                    </div>
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
                          <tr>
                            <td colspan='100'>No Users created.</td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                  <div class="tab-pane" id="project">
                    <div class="toolbar">
                      <a class='btn btn-success' data-toggle="modal" href="#project_form"> <i class='icon-white icon-th-list'></i> Add</a>
                      <a class='btn btn-info'> <i class='icon-white icon-th-list'></i> Edit</a>
                      <a class='btn btn-danger'> <i class='icon-white icon-trash'></i> Delete</a>
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
                          <tr>
                            <td colspan='100'>No Projects created.</td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div><!--/span12-->
            
          </div><!--/row-->