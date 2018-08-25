<?php
include_once("include/loginstatus.php");
// If user is already logged in
if (isset($_SESSION["userid"])) {
  header("location: account.php?id=".$_SESSION["userid"]."&dashboard=focus");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Hurt AJ Admin - Log In</title>

    <link rel="icon" type="image/png" href="image/logoonly.png" />

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css?refresh=123" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <br>
                <center><img class="img-responsive" src="image/main_logo.png" height="200" width="200" alt="MarketCart Logo"></center>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Log In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" onsubmit="return false;">
                            <fieldset>
                                <span id="statuslog"></span>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" id="elog" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="plog" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button id="logBtn" class="btn btn-lg btn-primary btn-block" onclick="login()">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>

    <script>
        function login() {
          var e = _("elog").value;
          var p = _("plog").value;
          var status = _("statuslog");
          status.innerHTML = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i></center>';
          if (e == "" || p == "") {
            status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
          } else {
            _("logBtn").disabled = true;
            status.innerHTML = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i></center>';
            var ajax = ajaxObj("POST", "parsers/login.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                if (ajax.responseText == "login_failed"){
                  status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Wrong Username or Password.</div>';
                  _("logBtn").disabled = false;
                } else {
                  window.location = "account.php?id="+ajax.responseText+"&dashboard=focus";
                }
              }
            }
            ajax.send("e="+e+"&p="+p);
          }
        }
    </script>

</body>

</html>
