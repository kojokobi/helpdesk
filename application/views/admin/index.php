<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/helpdesk_style.css" rel="stylesheet" type="text/css">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png">
  </head>

  <body>
    <!-- Beginning of header -->
    <div class="navbar navbar-inverse navbar-fixed-top"  ng-controller="ProfileCtrl">
      <div class="navbar-inner">
          <div class="container-fluid">
            <a class="brand" href="/">AXON Help Desk</a>
            <div class="nav-collapse">
              <ul class="nav pull-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                      Logged in as<span class='username'> Selasie </span>
                    <b class="caret"></b>
                    </a>
                 
                  <ul class="dropdown-menu">
                   <li> <a href="/logout"> <i class="icon-off"></i> Sign out</a> </li>
                  </ul>
                </li>
          </ul>
            </div><!--/.nav-collapse -->
          </div>
      </div>
    </div>
    <!-- Beginning of header -->

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span2">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span10">
          <div class="row-fluid">
            <div class="span12">
              <fieldset>
                <legend >Admin</legend>
              </fieldset>
              <div class="tabbable">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#users" data-toggle="tab"> <i class='icon icon-user'></i> Manage Users</a></li>
                  <li><a href="#project" data-toggle="tab"><i class='icon icon-th-list'></i> Manage Projects</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="users">
                    <div class="toolbar">
                      <a class='btn btn-success' data-toggle="modal" href="#user_form"> <i class='icon-white icon-user'></i> Add</a>
                      <a class='btn btn-info'> <i class='icon-white icon-user'></i> Edit</a>
                      <a class='btn btn-danger'> <i class='icon-white icon-trash'></i> Delete</a>
                    </div>
                    <table my-table class='table table-striped table-bordered'>
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
                    </table>
                  </div>
                  <div class="tab-pane" id="project">
                    <div class="toolbar">
                      <a class='btn btn-success' data-toggle="modal" href="#project_form"> <i class='icon-white icon-th-list'></i> Add</a>
                      <a class='btn btn-info'> <i class='icon-white icon-th-list'></i> Edit</a>
                      <a class='btn btn-danger'> <i class='icon-white icon-trash'></i> Delete</a>
                    </div>
                    <table my-table class='table table-striped table-bordered'>
                        <thead>
                          <tr>
                            <!-- <th>#</th> -->
                            <th>Title</th>
                            <th>Description</th>
                            <th>Date Created</th>
                          </tr>
                        </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div><!--/span12-->
            
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <!-- ADD USER FORM -->
      <div class="modal hide fade" id="user_form" data-backdrop="static" data-keyboard="false">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">×</a>
          <h3>Add User</h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="firstName">First Name:</label>
              <div class="controls">
                <input type="text" id="firstName" placeholder="First Name" class='input-xlarge'>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="lastName">Last Name:</label>
              <div class="controls">
                <input type="text" id="lastName" placeholder="Last Name" class='input-xlarge'>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="userName">User Name:</label>
              <div class="controls">
                <input type="text" id="userName" placeholder="User Name" class='input-xlarge'>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="email">Email:</label>
              <div class="controls">
                <input type="text" id="email" placeholder="Email" class='input-xlarge'>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="password">Password:</label>
              <div class="controls">
                <input type="password" id="password" placeholder="Password" class='input-xlarge'>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer"> 
          <a href="#" class="btn btn-success"><i class='icon-white icon-user'></i> Save User </a>
          <a href="#" class="btn"><i class='icon icon-ban-circle'></i> Cancel</a>
        </div>
      </div>
      <!-- END OF ADD USER FORM -->

      <!-- ADD PROJECT FORM -->
      <div class="modal hide fade" id="project_form" data-backdrop="static" data-keyboard="false">
        <div class="modal-header">
          <a class="close" data-dismiss="modal">×</a>
          <h3>Add Project</h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <div class="control-group">
              <label class="control-label" for="title">Title:</label>
              <div class="controls">
                <input type="text" id="title" placeholder="Title" class='input-xlarge'>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label" for="description">Description:</label>
              <div class="controls">
                <!-- <input type="text" id="description" placeholder="Description" class='input-xlarge'> -->
                <textarea id="description" class='input-xlarge' rows="10"></textarea>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#" class="btn btn-success"><i class='icon-white icon-th-list'></i> Save Project </a>
          <a href="#" class="btn"><i class='icon icon-ban-circle'></i> Cancel</a>
        </div>
      </div>
      <!-- END OF ADD PAROJECT FORM -->
      <hr>

      <footer>
        <p>&copy; Company 2012</p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>

  </body>
</html>
