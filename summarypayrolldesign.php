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
    h3,h2{
        font-family: "Times New Roman", Times, serif;
    }
    p{
        font-family: "Times New Roman", Times, serif;
        font-size: 15px;
        text-align: justify;
    }
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
                    <th style="width: 50px;">NO.</th>
                    <th style="width: 250px;">EMPLOYEE</th>
                    <th style="width: 250px;">PAY PERIOD</th>
                    <th style="width: 80px;">DAYS OF WORK</th>
                    <th style="width: 80px;">DAYS PRESENT</th>
                    <th style="width: 80px;">OVER TIME</th>
                    <th style="width: 80px;">SSS</th>
                    <th style="width: 80px;">SSS LOAN</th>
                    <th style="width: 80px;">PAG-IBIG</th>
                    <th style="width: 80px;">PAG-IBIG LOAN</th>
                    <th style="width: 80px;">PHIL HEALTH</th>
                    <th style="width: 80px;">TAX</th>
                    <th style="width: 80px;">LESS LATES</th>
                    <th style="width: 80px;">CASH LOAN</th>
                    <th style="width: 90px;">CASH ADVANCE</th>
                    <th style="width: 80px;">SUNDAY</th>
                    <th style="width: 100px;">RATE PER HOUR</th>
                    <th style="width: 250px;">PAYROLL PERIOD</th>
                    <th style="width: 100px;">RATE PER DAY</th>
                    <th style="width: 80px;">HOLIDAY</th>
                    <th style="width: 80px; font-size: 12px;">S N WORKING</th>
                    <th style="width: 80px;">DAILY</th>
                    <th style="width: 90px;">OVERTIME PAY</th>
                    <th style="width: 80px;">SUNDAY</th>
                    <th style="width: 80px;">HOLIDAY</th>
                    <th style="width: 80px; font-size: 12px;">S N WORKING</th>
                    <th style="width: 80px;">GROSS</th>
                    <th style="width: 90px; font-size: 12px;">TOTAL DEDUCIONS</th>
                    <th style="width: 80px;">NET</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td style="text-align: left;">ASANZA, RYAN</td>
                    <td style="text-align: left;">John</td>
                    <td style="text-align: center;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: left;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                    <td style="text-align: right;">John</td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td style="width: 50px;"></td>
                    <td style="width: 250px;"></td>
                    <td style="width: 250px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;">123123</td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;">123123</td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;">123123</td>
                    <td style="width: 80px;">123123</td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;">45456</td>
                    <td style="width: 90px;">456456</td>
                    <td style="width: 80px;"></td>
                    <td style="width: 100px;"></td>
                    <td style="width: 250px;"></td>
                    <td style="width: 100px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;"></td>
                    <td style="width: 80px;">12123</td>
                    <td style="width: 90px;">123123</td>
                    <td style="width: 80px;">123123</td>
                    <td style="width: 80px;">123123</td>
                    <td style="width: 80px;">123123</td>
                    <td style="width: 80px;"></td>
                    <td style="width: 90px;">123123</td>
                    <td style="width: 80px;">123123</td>
                </tr>
            </tbody>
        </table>

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
