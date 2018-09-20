<?php
include_once("include/loginstatus.php");
if (!isset($_SESSION["userid"])) {
  header("location: index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>HURT AJ FABRICATION - Summary of Payroll</title>
    <!-- FavIcon -->
    <link rel="icon" type="image/png" href="image/logoonly.png" />
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
    @page { size: auto;  margin: 15px 0mm; }

    table{
        border: 1px solid black;
        table-layout: fixed;
        width: 200px;
        margin: 0px;
    }

    th {
        border: 1px solid black;
        text-align: center;
    }

    body {
        padding: 0;
    }
    
    </style>

  </head>
  <body>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 200px;">CONTRIBUTION</th>
                    <th style="width: 100px;"></th>
                    <th colspan="8">EMPLOYEE</th>
                    <th colspan="5">EMPLOYER</th>
                    <th colspan="3">TOTAL</th>
                </tr>
                <tr>
                    <th rowspan="2" style="width: 200px;">EMPLOYEE</th>
                    <th rowspan="2" style="width: 100px;">MONTH</th>
                    <th colspan="2">SSS</th>
                    <th colspan="2">PAG-IBIG</th>
                    <th colspan="2">PHILHEALTH</th>
                    <th colspan="2">TAX</th>
                    <th colspan="3">SSS</th>
                    <th rowspan="2" colspan="1">PAG-IBIG</th>
                    <th rowspan="2" colspan="1">PHIL<br>HEALTH</th>
                    <th rowspan="2" colspan="1">SSS-EC</th>
                    <th rowspan="2" colspan="1">PAG-IBIG</th>
                    <th rowspan="2" colspan="1">PHIL<br>HEALTH</th>
                </tr>
                <tr>
                    <th>26-10</th>
                    <th>11-25</th>
                    <th>26-10</th>
                    <th>11-25</th>
                    <th>29-10</th>
                    <th>11-25</th>
                    <th></th>
                    <th></th>
                    <th>EE</th>
                    <th>ER</th>
                    <th>EC</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="col-md-4">

        <div class="col-md-6">
            <span>SSS Total Contribution</span>
        </div>
        <div class="col-md-6">
            <strong>asdasdasd</strong>
        </div>

        <div class="col-md-6">
            <span>Pag-ibig Total Contribution</span>
        </div>
        <div class="col-md-6">
            <strong>asdasdasd</strong>
        </div>

        <div class="col-md-6">
            <span>PhilHealth Total Contribution</span>
        </div>
        <div class="col-md-6">
            <strong>asdasdasd</strong>
        </div>

        <div class="col-md-6">
            <span>Withholding Tax</span>
        </div>
        <div class="col-md-6">
            <strong>asdasdasd</strong>
        </div>

        </div>

        <div class="col-md-8">

        <center><h2><strong>26,390.65</strong></h2>
        <p>TOTAL</p></center>

        </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        //window.onload = function() { window.print(); }
    </script>
  </body>
</html>
