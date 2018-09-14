<?php
include_once("include/loginstatus.php");
if (!isset($_SESSION["userid"])) {
  header("location: index.php");
  exit();
}

$formcount = $_GET["count"];
$count = 0;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Hurt AJ Admin - Print Leave Form</title>
    <!-- FavIcon -->
    <link rel="icon" type="image/png" href="img/fav.png" />
    <!-- Bootstrap -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    h3,h2{
        font-family: "Times New Roman", Times, serif;
    }
    p{
        font-family: "Times New Roman", Times, serif;
        font-size: 15px;
        text-align: justify;
    }
    .square {
      height: 12px;
      width: 12px;
      background-color: #ffffff;
      border: 1px solid #000000;
      display: inline-block; 
    }
    .squarebox {
      height: 80px;
      width: 100%;
      background-color: #ffffff;
      border: 1px solid #000000;
    }
    .whole-border {
      border: 1px solid #000000; 
      padding-bottom: 15px;
    }
    #page-break { page-break-after: always; }
    @page { size: auto;  margin: 0mm; }
    </style>
  </head>
  <body>

     <div class="container-fluid">
        <div class="row">
        <?php for($i = 0; $i < $formcount; $i++) {
          $count++;
          if($count != 6) {
              echo '
                  <div class="col-md-6 col-sm-6 col-xs-6 whole-border">
                    <h3>Leave Form</h3>
                    <p style="font-size: 12px;">HURT AJ ENTERPRISES CORPORATION</p>
                    <hr> 
                    <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-4">
                            Employee ID:<br>
                            From (Date):<br>
                            To (Date):<br><br>
                            Type:
                     </div>
                     <div class="col-md-8 col-sm-8 col-xs-8">
                            _______________________________<br>
                            _______________________________<br>
                            _______________________________<br><br>
                            Sick <div class="square"></div> &nbsp; &nbsp; &nbsp; Vacation <div class="square"></div>
                     </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <br>Reason:
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="squarebox"></div>
                        </div>
                    </div>
                  </div>
              ';
          } else {
              $count = 0;
              echo '
                  <div class="col-md-6 col-sm-6 col-xs-6 whole-border" style="margin-bottom: 3px;">
                    <h3>Leave Form</h3>
                    <p style="font-size: 12px;">HURT AJ ENTERPRISES CORPORATION</p>
                    <hr> 
                    <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-4">
                            Employee ID:<br>
                            From (Date):<br>
                            To (Date):<br><br>
                            Type:
                     </div>
                     <div class="col-md-8 col-sm-8 col-xs-8">
                            _______________________________<br>
                            _______________________________<br>
                            _______________________________<br><br>
                            Sick <div class="square"></div> &nbsp; &nbsp; &nbsp; Vacation <div class="square"></div>
                     </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <br>Reason:
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="squarebox"></div>
                        </div>
                    </div>
                  </div>
              ';
          }
        } ?> 
        </div>       
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.onload = function() { window.print(); }
    </script>
  </body>
</html>