<!DOCTYPE html>
<html lang="en" ng-app="helpdesk">
  <head>
    <meta charset="utf-8">
    <title> Axon Desk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/helpdesk_style.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.pnotify.default.css" media="all" rel="stylesheet" type="text/css" />

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
    

    <!-- header scripts go here -->
    <!-- libraries -->
    <script type="text/javascript" src='js/libs/angular.js'></script>
    <script type="text/javascript" src='js/libs/angular-resource.js'></script>
    <!-- end of libs -->
    
    <!-- Libraries -->
    <?php 
        //ajax uploader
        echo HTML::style("js/libs/ajaxuploader/fineuploader.css");
        
        echo HTML::script("js/libs/ajaxuploader/js/header.js");
        echo HTML::script("js/libs/ajaxuploader/js/util.js");
        echo HTML::script("js/libs/ajaxuploader/js/button.js");
        echo HTML::script("js/libs/ajaxuploader/js/handler.base.js");
        echo HTML::script("js/libs/ajaxuploader/js/handler.form.js");
        echo HTML::script("js/libs/ajaxuploader/js/handler.xhr.js");
        echo HTML::script("js/libs/ajaxuploader/js/uploader.basic.js");
        echo HTML::script("js/libs/ajaxuploader/js/dnd.js");
        echo HTML::script("js/libs/ajaxuploader/js/uploader.js");
     ?>

    <!-- app scripts -->
    <script type="text/javascript" src="js/app/statusservice.js"></script>
    <script type="text/javascript" src="js/app/app.js"></script>
    <script type="text/javascript" src="js/app/services.js"></script>
    <script type="text/javascript" src="js/app/usercontroller.js"></script>
    <script type="text/javascript" src="js/app/projectcontroller.js"></script>
    <script type="text/javascript" src="js/app/ticketcontroller.js"></script>
    <script type="text/javascript" src="js/app/ticketdetailscontroller.js"></script>
    <script type="text/javascript" src="js/app/dashcontroller.js"></script>
    <script type="text/javascript" src="js/app/profilecontroller.js"></script>
    <script type="text/javascript" src="js/app/myhelpers.js"></script>

    <!-- end of app scripts -->


  </head>

  <body>