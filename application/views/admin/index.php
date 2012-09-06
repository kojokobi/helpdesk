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
                      <button class='btn btn-primary'> <i class='icon-white icon-user'></i> Add</button>
                      <button class='btn btn-info'> <i class='icon-white icon-user'></i> Edit</button>
                      <button class='btn btn-danger'> <i class='icon-white icon-trash'></i> Delete</button>
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
                      <button class='btn btn-primary'> <i class='icon-white icon-th-list'></i> Add</button>
                      <button class='btn btn-info'> <i class='icon-white icon-th-list'></i> Edit</button>
                      <button class='btn btn-danger'> <i class='icon-white icon-trash'></i> Delete</button>
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
