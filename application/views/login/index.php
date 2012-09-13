<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<style type="text/css">
		
		.login {
			width:  330px;
			margin: auto;
			margin-top : 250px;
		}

		.panel {
			border: 1px solid #D6D6D6;
			box-shadow: 0 1px 3px rgba(100, 100, 100, 0.1);
			margin-bottom: 15px;
			border-radius: 3px 3px 0 0;
			overflow: visible;
			position: relative;
		}

		.panel_header {
			padding: 10px 15px;
			background-color: #F8F8F8;
			background-image: -moz-linear-gradient(top, #FDFDFD, #F6F6F6);
			background-image: -ms-linear-gradient(top, #FDFDFD, #F6F6F6);
			background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#FDFDFD), to(#F6F6F6));
			background-image: -webkit-linear-gradient(top, #FDFDFD, #F6F6F6);
			background-image: -o-linear-gradient(top, #FDFDFD, #F6F6F6);
			background-image: linear-gradient(top, #FDFDFD, #F6F6F6);
			border-bottom: 1px solid #D6D6D6;
			color: #555;
			text-shadow: 0 1px 0 white;
			font-size: 14px;
			font-weight: bold;
		}

		.panel_header span.login_icon {
			display: inline-block;
			padding: 10px;
			margin: -10px 10px -10px -10px;
			border-right: 1px solid #D6D6D6;
		}

		.panel_body {
			background-color: white;
			padding: 15px;
		}

		.form-horizontal .controls { 
			margin-left: 0px;
		}
		
		.form-actions {
			margin: 0 -15px -33px;
			padding: 15px;
			text-align: center;
		}
		.instructions {
			color: #B94A48;
		}

	</style>
</head>
<body>
	<div class="container-fluid">
      	<div class="row-fluid">
      		<div class="span12">
				<div  class='panel login'>
					<div class="panel_header">
						<span class="login_icon"><i class="icon-lock"></i></span>Login
					</div>
					<div class="panel_body">
						<form action="/login" method='post' class="form-horizontal">
							<p class='instructions'>Please enter details to login</p>
						<fieldset>
							<div class="control-group">
					            <div class="controls">
					              <div class="input-prepend">
					                <span class="add-on"><i class="icon-user"></i></span><input class="span3" name="username" id="username" type="text" placeholder="username">
					              </div>
					              
					            </div>
					        </div>
					        <div class="control-group">
					            <div class="controls">
					              <div class="input-prepend">
					                <span class="add-on"><i class="icon-random"></i></span><input class="span3" name='password' id="password" type="password" placeholder="password">
					              </div>
					              
					            </div>
					        </div>
					        <div class='form-actions'>
					        	<input type="submit" value="Login" class='btn btn-primary'>
					        </div>
						</fieldset>
						
					</form>
					</div>
					
				</div>
			<div>
		</div><!--/row-->
		    
    </div><!--/.fluid-container-->
</body>
</html>