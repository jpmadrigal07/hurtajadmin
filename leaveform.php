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
    .square {
      height: 12px;
      width: 12px;
      background-color: #ffffff;
      display: inline-block; 
    }
    .squarebox {
      height: 80px;
      width: 100%;
      background-color: #ffffff;
    }
    .whole-border {
    }
    .table-bordered {
        border: none !important;
    }
    .table>thead:first-child>tr:first-child>th {
        border: none !important;
        font-size: 5px !important;
    }
    .table {
        margin-bottom: 0px;
        
    }
    table.table-bordered{
    border:1px solid #000000;
  }
    #wp-text {
        color: rgba(255, 255, 255, 1) !important;
    }
    #page-break { page-break-after: always; }
    @page { size: auto;  margin: 0mm; }
    @media print {
        .table>thead:first-child>tr:first-child>th,
        #wp-text {
            color: rgba(255, 255, 255, 1) !important;
        }

        @media print and (-webkit-min-device-pixel-ratio:0) {
        .table>thead:first-child>tr:first-child>th,
        #wp-text {
            color: rgba(255, 255, 255, 1) !important;
            -webkit-print-color-adjust: exact;
        }
      }
    }
    </style>
  </head>
  <body>

     <div class="container-fluid">
        <div class="row">
        <?php for($i = 0; $i < $formcount; $i++) {
          $count++;
          if($count != 2) {
              echo '
                  <div class="col-md-12 col-sm-12 col-xs-12 whole-border">
                  <table class="table table-bordered">
                  <thead>
                  <tr style="border: none; color: white;  font-size: 10px;">
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                  <th style=" padding: 0px;">asdasd</th>
                </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="7"><center style="font-weight: 900; font-size: 11px;">HURT AJ FABRICATION ENTERPRISES AND CONSTRUCTION COMPANY</center></td>
                      <td colspan="4"><center style="font-weight: 900; font-size: 11px;">APPLICATION FOR LEAVE OF ABSENCE</center></td>
                    </tr>
                    <tr>
                      <td colspan="5" style="padding: 0px 0px 17px 4px; font-size: 12px;">NAME</td>
                      <td colspan="2" style="padding: 0px 0px 17px 4px; font-size: 12px;">POSITION</td>
                      <td colspan="2" style="padding: 0px 0px 17px 4px; font-size: 12px;">ID NO.</td>
                      <td colspan="2" style="padding: 0px 0px 17px 4px; font-size: 12px;">DATE</td>
                    </tr>
                    <tr>
                      <td colspan="7" style="padding: 0px 0px 0px 4px; font-size: 12px;">DEPARTMENT</td>
                      <td colspan="4"><center style=" font-size: 12px;">Regular ____ &nbsp; Casual _____</center></td>
                    </tr>
                    <tr>
                      <td colspan="1" style="padding: 8px 0px 8px 4px; font-size: 12px;">DATE OF LEAVE:</td>
                      <td colspan="4" style="padding: 0px 0px 0px 4px; font-size: 12px;">FROM</td>
                      <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">TO</td>
                      <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">NO. OF DAYS</td>
                    </tr>
                    <tr>
                      <td colspan="5" style="padding: 0px 0px 3px 4px; font-size: 12px;">ADDRESS WHILE ON LEAVE</td>
                      <td colspan="3" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">FOR ACCOUNTING USE<br>ONLY</center></td>
                      <td colspan="1" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">VACATION LEAVE</center></td>
                      <td colspan="1" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">SICK LEAVE</center></td>
                      <td colspan="1" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">FORCED LEAVE</center></td>
                    </tr>
                    <tr>
                      <td colspan="5" style="padding: 0px 0px 0px 4px; font-size: 12px;">REASON/S:<br/><br/><br/><br/><br/><span style=" font-size: 12px;">REMARKS:</span></td>
                      <td colspan="6" style="padding: 0px;">
                      <table class="table table-bordered" style="margin-bottom: 0px;">
                      <tbody>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;" width="39%"><span>APPLIED FOR</span></td>
                            <td style="padding: 0px 0px 0px 0px; margin: 0px 10px 0px 50px;" width="23%"><center style="font-size: 12px;">WP | WOP</td>
                            <td style="padding: 0px 0px 0px 0px;" width="16.8%"><center style="font-size: 12px;">WP | WOP</center></td>
                            <td style="padding: 0px 0px 0px 0px;"><center style="font-size: 12px;">WP | WOP</center></td>
                            </tr>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;">APPROVED</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;"><center style="font-size: 12px;"><span id="wp-text">WP</span> | <span id="wp-text">WOP</span></center></td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;"><center style="font-size: 12px;"><span id="wp-text">WP</span> | <span id="wp-text">WOP</span></center></td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;"><center style="font-size: 12px;"><span id="wp-text">WP</span> | <span id="wp-text">WOP</span></center></td>
                            </tr>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;">BAL. DEC. 31, 20___</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            </tr>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;">20___ LEAVES</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            </tr>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;">TOTAL AVAIL. LEAVES</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            </tr>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;">AVAILED LEAVES</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            </tr>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;">BALANCE_____20___</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            </tr>
                            <tr>
                            <td style="padding: 0px 0px 0px 8px; font-size: 12px;">TODAY\'S LEAVE</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                            </tr>
                            </tbody>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="11" style="padding: 0px 0px 0px 4px; font-size: 12px;">
                      NOTE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vacation Leave:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seven (7) days advance notice required.
                      <br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sick Leave:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Submit Medical Certificate for absences of two (2) or more days.
                      <br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Non-compliance of the above shall subject employee to disciplinary action<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;in accordance with company policies and procedures.
                      <br>
                      <br>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I agree that I have fully read and understood the above. I also hereby certify that&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONFORME: _________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the reason/s stated for my being absent are true to the best of my knowledge.
                      </td>
                    </tr>
                    <tr>
                      <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">REQUESTED BY:<br/><br/><center style="font-size: 12px;">Application</center></td>
                      <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">NOTED BY:<br/><br/><center style="font-size: 12px;">Immediate Supervisor</center></td>
                      <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">VERIFIED BY:<br/><br/><center style="font-size: 12px;">HR Department</center></td>
                      <td colspan="2" style="padding: 0px 0px 0px 4px; font-size: 12px;">APPROVED BY:</td>
                    </tr>
                  </tbody>
                </table>
                <hr style="margin-bottom: 2px;">
                  </div>
                
              ';
          } else {
              $count = 0;
              echo '
              <div class="col-md-12 col-sm-12 col-xs-12 whole-border">
              <table class="table table-bordered">
              <thead>
              <tr style="border: none; color: white;  font-size: 10px;">
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
              <th style=" padding: 0px;">asdasd</th>
            </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="7"><center style="font-weight: 900; font-size: 11px;">HURT AJ FABRICATION ENTERPRISES AND CONSTRUCTION COMPANY</center></td>
                  <td colspan="4"><center style="font-weight: 900; font-size: 11px;">APPLICATION FOR LEAVE OF ABSENCE</center></td>
                </tr>
                <tr>
                  <td colspan="5" style="padding: 0px 0px 17px 4px; font-size: 12px;">NAME</td>
                  <td colspan="2" style="padding: 0px 0px 17px 4px; font-size: 12px;">POSITION</td>
                  <td colspan="2" style="padding: 0px 0px 17px 4px; font-size: 12px;">ID NO.</td>
                  <td colspan="2" style="padding: 0px 0px 17px 4px; font-size: 12px;">DATE</td>
                </tr>
                <tr>
                  <td colspan="7" style="padding: 0px 0px 0px 4px; font-size: 12px;">DEPARTMENT</td>
                  <td colspan="4"><center style=" font-size: 12px;">Regular ____ &nbsp; Casual _____</center></td>
                </tr>
                <tr>
                  <td colspan="1" style="padding: 8px 0px 8px 4px; font-size: 12px;">DATE OF LEAVE:</td>
                  <td colspan="4" style="padding: 0px 0px 0px 4px; font-size: 12px;">FROM</td>
                  <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">TO</td>
                  <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">NO. OF DAYS</td>
                </tr>
                <tr>
                  <td colspan="5" style="padding: 0px 0px 3px 4px; font-size: 12px;">ADDRESS WHILE ON LEAVE</td>
                  <td colspan="3" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">FOR ACCOUNTING USE<br>ONLY</center></td>
                  <td colspan="1" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">VACATION LEAVE</center></td>
                  <td colspan="1" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">SICK LEAVE</center></td>
                  <td colspan="1" style="padding: 0px 8px 3px 8px;"><center style="font-weight: 900; font-size: 12px;">FORCED LEAVE</center></td>
                </tr>
                <tr>
                  <td colspan="5" style="padding: 0px 0px 0px 4px; font-size: 12px;">REASON/S:<br/><br/><br/><br/><br/><span style=" font-size: 12px;">REMARKS:</span></td>
                  <td colspan="6" style="padding: 0px;">
                  <table class="table table-bordered" style="margin-bottom: 0px;">
                  <tbody>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;" width="39%"><span>APPLIED FOR</span></td>
                        <td style="padding: 0px 0px 0px 0px; margin: 0px 10px 0px 50px;" width="23%"><center style="font-size: 12px;">WP | WOP</td>
                        <td style="padding: 0px 0px 0px 0px;" width="16.8%"><center style="font-size: 12px;">WP | WOP</center></td>
                        <td style="padding: 0px 0px 0px 0px;"><center style="font-size: 12px;">WP | WOP</center></td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;">APPROVED</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;"><center style="font-size: 12px;"><span id="wp-text">WP</span> | <span id="wp-text">WOP</span></center></td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;"><center style="font-size: 12px;"><span id="wp-text">WP</span> | <span id="wp-text">WOP</span></center></td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;"><center style="font-size: 12px;"><span id="wp-text">WP</span> | <span id="wp-text">WOP</span></center></td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;">BAL. DEC. 31, 20___</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;">20___ LEAVES</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;">TOTAL AVAIL. LEAVES</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;">AVAILED LEAVES</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;">BALANCE_____20___</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        </tr>
                        <tr>
                        <td style="padding: 0px 0px 0px 8px; font-size: 12px;">TODAY\'S LEAVE</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        <td style="padding: 0px 0px 0px 0px; font-size: 12px;" id="wp-text">yessir</td>
                        </tr>
                        </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="11" style="padding: 0px 0px 0px 4px; font-size: 12px;">
                  NOTE:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Vacation Leave:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seven (7) days advance notice required.
                  <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sick Leave:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Submit Medical Certificate for absences of two (2) or more days.
                  <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Non-compliance of the above shall subject employee to disciplinary action<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;in accordance with company policies and procedures.
                  <br>
                  <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I agree that I have fully read and understood the above. I also hereby certify that&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CONFORME: _________________<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;the reason/s stated for my being absent are true to the best of my knowledge.
                  </td>
                </tr>
                <tr>
                  <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">REQUESTED BY:<br/><br/><center style="font-size: 12px;">Application</center></td>
                  <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">NOTED BY:<br/><br/><center style="font-size: 12px;">Immediate Supervisor</center></td>
                  <td colspan="3" style="padding: 0px 0px 0px 4px; font-size: 12px;">VERIFIED BY:<br/><br/><center style="font-size: 12px;">HR Department</center></td>
                  <td colspan="2" style="padding: 0px 0px 0px 4px; font-size: 12px;">APPROVED BY:</td>
                </tr>
              </tbody>
            </table>
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