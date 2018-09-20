<?php
include_once("include/loginstatus.php");
if (!isset($_SESSION["userid"])) {
  header("location: index.php");
  exit();
}

// VARIABLES
$id = "";
$accname = "";
$email = "";
$password = "";
$ip = "";
$datereg = "";
$lastlogin = "";
$level = "";
$pheading = "";
$pbody = "";
$fname = "";
$admin_count = 0;
$user_count = 0;
$seller_count = 0;
$supplier_count = 0;

// GET USER ID
if(isset($_GET["id"])){
  $id = preg_replace('#[^a-z0-9-]#i', '', $_GET['id']);
} else {
  header("location: index.php");
  exit(); 
}

// SELECT USER INFO
$sql_user = "SELECT * FROM hurtajadmin_user WHERE id='$id' LIMIT 1";
$user_query = mysqli_query($db_conn, $sql_user);
while ($row = mysqli_fetch_array($user_query, MYSQLI_ASSOC)) {
  $id = $row["id"];
  $fname = $row["user_fname"];
  $email = $row["user_email"];
  $password = $row["user_pass"];
  $ip = $row["user_ip"];
  $datereg = $row["user_date_created"];
  $lastlogin = $row["user_last_login"];
  $level = $row["user_level"];
}

// CHECK TO SEE IF THE VIEWER IS THE ACCOUNT USER
$isOwner = "No";

if($id == $log_id && $user_ok == true){
  $isOwner = "Yes";
}

// $sql_admin_count = "SELECT * FROM marketcart_user WHERE user_level='1'";
// $query_admin_count = mysqli_query($db_conn, $sql_admin_count);
// $admin_count = mysqli_num_rows($query_admin_count);

// $sql_user_count = "SELECT * FROM marketcart_user WHERE user_level='2'";
// $query_user_count = mysqli_query($db_conn, $sql_user_count);
// $user_count = mysqli_num_rows($query_user_count);

// $sql_seller_count = "SELECT * FROM marketcart_user WHERE user_level='3'";
// $query_seller_count = mysqli_query($db_conn, $sql_seller_count);
// $seller_count = mysqli_num_rows($query_seller_count);

// $sql_supplier_count = "SELECT * FROM marketcart_user WHERE user_level='4'";
// $query_supplier_count = mysqli_query($db_conn, $sql_supplier_count);
// $supplier_count = mysqli_num_rows($query_supplier_count);

// ROUTE
if(

  (
    !isset($_GET["dashboard"]) 
    && !isset($_GET["ageing"])
    && !isset($_GET["employee"])
    && !isset($_GET["payroll"])     
    && !isset($_GET["leave"]) 
    && !isset($_GET["settings"])     
    )

// IF ADMIN LEVEL
  || (isset($_GET["dashboard"]) && trim($_GET["dashboard"]) != "focus") 
  
  || (isset($_GET["ageing"]) && trim($_GET["ageing"]) != "focus")  

  || (isset($_GET["employee"]) && trim($_GET["employee"]) != "focus") 

  || (isset($_GET["payroll"]) && trim($_GET["payroll"]) != "focus")

  || (isset($_GET["leave"]) && trim($_GET["leave"]) != "focus")  

  || (isset($_GET["settings"]) && trim($_GET["settings"]) != "focus") 

  ) {
  $pheading = "Erorr 404";
  $pbody = "Page not found.";
} else if (isset($_GET["dashboard"]) && trim($_GET["dashboard"]) == "focus"){
  $pheading = "Dashboard";
} else if (isset($_GET["ageing"]) && isset($_GET["add"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["add"]) == "company"){
  $pheading = "Add Ageing > Company"; 
} else if (isset($_GET["ageing"]) && isset($_GET["add"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["add"]) == "collectibles"){
  $pheading = "Add Ageing > Collectibles"; 
} else if (isset($_GET["ageing"]) && isset($_GET["view"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["view"]) == "company"){
  $pheading = "View Ageing > Company"; 
} else if (isset($_GET["ageing"]) && isset($_GET["view"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["view"]) == "collectibles"){
  $pheading = "View Ageing > Collectibles"; 
} else if (isset($_GET["ageing"]) && isset($_GET["view"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["view"]) == "paidcollectibles"){
  $pheading = "View Ageing > Paid Collectibles"; 
} else if (isset($_GET["employee"]) && isset($_GET["add"]) && trim($_GET["employee"]) == "focus" && trim($_GET["add"]) == "employee"){
  $pheading = "Add Employee"; 
} else if (isset($_GET["employee"]) && isset($_GET["view"]) && trim($_GET["employee"]) == "focus" && trim($_GET["view"]) == "employee"){
  $pheading = "View Employee"; 
} else if (isset($_GET["employee"]) && isset($_GET["cash"]) && trim($_GET["employee"]) == "focus" && trim($_GET["cash"]) == "employee"){
  $pheading = "Cash Loan/Advance"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "attendance"){
  $pheading = "Import Attendance"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "payslip"){
  $pheading = "Generate Payslip"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "summary"){
  $pheading = "Summary"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "sss"){
  $pheading = "SSS Contribution"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "philhealth"){
  $pheading = "PhilHealth Contribution"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "pagibig"){
  $pheading = "Pag-IBIG Contribution"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "tax"){
  $pheading = "Withholding Tax"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "holidays"){
  $pheading = "Holidays"; 
} else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "holidayrate"){
  $pheading = "Holiday Rate"; 
} else if (isset($_GET["leave"]) && isset($_GET["action"]) && trim($_GET["leave"]) == "focus" && trim($_GET["action"]) == "form"){
  $pheading = "Generate Leave Form"; 
} else if (isset($_GET["leave"]) && isset($_GET["action"]) && trim($_GET["leave"]) == "focus" && trim($_GET["action"]) == "request"){
  $pheading = "Request Employee Leave"; 
} else if (isset($_GET["leave"]) && isset($_GET["action"]) && trim($_GET["leave"]) == "focus" && trim($_GET["action"]) == "history"){
  $pheading = "Employee Leave History"; 
} else if (isset($_GET["settings"]) && trim($_GET["settings"]) == "focus"){
  $pheading = "Account Settings";
} else {
  $pheading = "Erorr 404";
  $pbody = "Page not found.";
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

    <title>Hurt AJ Admin - <?php echo $pheading; ?></title>

    <link rel="icon" type="image/png" href="image/logoonly.png" />

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $fname; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="account.php?id=<?php echo $id; ?>&dashboard=focus"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-plus fa-fw"></i> Add Ageing<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&ageing=focus&add=company">Company</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&ageing=focus&add=collectibles">Collectibles</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-eye fa-fw"></i> View Ageing<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&ageing=focus&view=company">Company</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&ageing=focus&view=collectibles">Collectibles</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&ageing=focus&view=paidcollectibles">Paid Collectibles</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Employee<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&employee=focus&add=employee">Add Employee</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&employee=focus&view=employee">View Employee</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&employee=focus&cash=employee">Cash Loan/Advance</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Payroll<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=attendance">Import Attendance</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip">Generate Payslip</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=summary">Summary</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=sss">SSS Contribution</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=philhealth">PhilHealth Contribution</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=pagibig">Pag-IBIG Contribution</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=tax">Withholding Tax</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=holidays">Holidays</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&action=holidayrate">Holiday Rate</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Leave Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&leave=focus&action=form">Generate Leave Form</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&leave=focus&action=request">Request Employee Leave</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&leave=focus&action=history">Employee Leave History</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="account.php?id=<?php echo $id; ?>&settings=focus"><i class="fa fa-cog fa-fw"></i> Account Settings</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?php if (isset($_GET["dashboard"]) && trim($_GET["dashboard"]) == "focus") { ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $pheading; ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $admin_count; ?></div>
                                        <div>Admin Account</div>
                                    </div>
                                </div>
                            </div>
                            <a href="#">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"><?php echo $supplier_count; ?></div>
                                        <div>Employee Count</div>
                                    </div>
                                </div>
                            </div>
                            <a href="account.php?id=<?php echo $id; ?>&lists=focus&active=suppliers">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            <?php } else if (isset($_GET["ageing"]) && isset($_GET["add"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["add"]) == "company") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&ageing=focus&view=company">View Company Lists</a></div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="col-md-6 col-md-offset-3">
                                        <form role="form" onsubmit="return false;">
                                            <span id="addCompanyStatus"></span>
                                            <div class="form-group">
                                                <label class="control-label">Company Name</label>
                                                <input type="text" class="form-control" id="add-company-name" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Full Address</label>
                                                <input type="text" class="form-control" id="add-company-address" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Contact Number</label>
                                                <input type="text" class="form-control" id="add-company-contact" placeholder="">
                                            </div>
                                            <button type="button" class="btn btn-primary" id="addCompanyBtn" style="width: 100%;" onclick="addCompanyRecord()">ADD</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <br>
            <?php } else if (isset($_GET["ageing"]) && isset($_GET["add"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["add"]) == "collectibles") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&ageing=focus&view=collectibles">View Collectibles Lists</a></div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="col-md-6 col-md-offset-3">
                                        <form role="form" onsubmit="return false;">
                                            <span id="addCollectiblesStatus"></span>
                                            <div class="form-group">
                                                <label class="control-label">Company</label>
                                                <select class="form-control" id="add-collectibles-company">
                                                    <option value=""></option>
                                                    <?php
                                                        $sql = "SELECT * FROM hurtajadmin_company WHERE company_status = '1' ORDER BY id DESC";
                                                        $query = mysqli_query($db_conn, $sql);
                                                        while($row = mysqli_fetch_array($query)) {
                                                            $cid = $row["id"];
                                                            $companyname = $row["company_name"];

                                                            echo '<option value="'.$cid.'">'.$companyname.'</option>';
                                                        }
                                                    ?>  
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Total Amount</label>
                                                <input type="text" class="form-control" id="add-collectibles-total-amount" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">P.O Number</label>
                                                <input type="text" class="form-control" id="add-collectibles-po-number" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Invoice Number</label>
                                                <input type="text" class="form-control" id="add-collectibles-invoice-number" placeholder="">
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label">Invoice Date</label>
                                              <div class="input-group date" id="datePicker1">
                                                <input type="text" class="form-control" name="date" id="add-collectibles-invoice-date" autocomplete="off" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label">Maturity Date</label>
                                              <div class="input-group date" id="datePicker2">
                                                <input type="text" class="form-control" name="date" id="add-collectibles-maturity-date" autocomplete="off" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">DR Number</label>
                                                <input type="text" class="form-control" id="add-collectibles-dr-number" placeholder="">
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label">Delivery Date</label>
                                              <div class="input-group date" id="datePicker3">
                                                <input type="text" class="form-control" name="date" id="add-collectibles-delivery-date" autocomplete="off" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Remarks/Paid</label>
                                                <input type="text" class="form-control" id="add-collectibles-remarks" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">O.R Number</label>
                                                <input type="text" class="form-control" id="add-collectibles-or-number" placeholder="">
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label">O.R Date</label>
                                              <div class="input-group date" id="datePicker4">
                                                <input type="text" class="form-control" name="date" id="add-collectibles-or-date" autocomplete="off" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="addCollectiblesBtn" style="width: 100%;" onclick="addCollectiblesRecord()">ADD</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <br>
            <?php } else if (isset($_GET["ageing"]) && isset($_GET["view"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["view"]) == "company") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&ageing=focus&add=company">Add Company</a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date" placeholder="Search Company" id="search-company"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-search"></span></span>
                                        </div>
                                        <hr>
                                        <div id="company-search-result">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Contact Number</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_company WHERE company_status = '1' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $name = $row["company_name"];
                                                    $address = $row["company_address"];
                                                    $contact = $row["company_contact"];
                                                    $date = $row["company_date_added"];
                                                    $newDate = date("F d, Y H:i A", strtotime($date));

                                                    echo '
                                                    <tr>
                                                    <td>'.$count.'</td>
                                                    <td>'.$name.'</td>           
                                                    <td>'.$address.'</td>
                                                    <td>'.$contact.'</td>
                                                    <td>'.$newDate.'</td>
                                                    <td><a href="javascript:void(0)" onclick="openCompanyEditDialog('.$recid.',\''.$name.'\',\''.$address.'\',\''.$contact.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCompanyDeleteDialog('.$recid.')">Delete</a></td>
                                                    </tr>
                                                    ';   

                                                  }
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            <?php } else if (isset($_GET["ageing"]) && isset($_GET["view"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["view"]) == "collectibles") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&ageing=focus&add=collectibles">Add Collectibles</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&ageing=focus&view=paidcollectibles">View Paid Collectibles</a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date" placeholder="Search Company, P.O Name or Invoice Number" id="search-collectibles"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-search"></span></span>
                                        </div>
                                        <hr>
                                        <div id="collectibles-search-result">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Client/Company</th>
                                                    <th>Total Amount</th>
                                                    <th>Invoice Date</th>
                                                    <th>Maturity Date</th>
                                                    <th>Days Left</th>
                                                    <th>Days Exceed</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_collectibles WHERE collectibles_status = '1' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $companyid = $row["company_id"];

                                                    $sql1 = "SELECT * FROM hurtajadmin_company WHERE id = '$companyid' ORDER BY id DESC";
                                                    $query1 = mysqli_query($db_conn, $sql1);
                                                    while($row1 = mysqli_fetch_array($query1)) {
                                                        $companyname = $row1["company_name"];
                                                    }

                                                    $totalamount = $row["collectibles_total_amount"];
                                                    $ponumber = $row["collectibles_po_number"];
                                                    $invocenumber = $row["collectibles_invoice_number"];
                                                    $invoicedate = $row["collectibles_invoice_date"];
                                                    $maturitydate = $row["collectibles_maturity_date"];
                                                    $drnumber = $row["collectibles_dr_number"];
                                                    $deliverydate = $row["collectibles_delivery_date"];
                                                    $remarkspaid = $row["collectibles_remarks_paid"];
                                                    $ornumber = $row["collectibles_or_number"];
                                                    $ordate = $row["collectibles_or_date"];
                                                    $dateadded = $row["collectibles_date_added"];

                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($maturitydate);
                                                    $datediff = $your_date - $now;
                                                    $datediff = round($datediff / (60 * 60 * 24));

                                                    $exceeddays = 0;
                                                    $leftdays = 0;

                                                    if($datediff < 0) {
                                                        $exceeddays = abs($datediff);
                                                    } else if($datediff > 0) {
                                                        $leftdays = $datediff;
                                                    }

                                                    if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "0000-00-00 00:00:00") {
                                                        $invoicedate = date("F d, Y", strtotime($invoicedate));
                                                        $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
                                                    } else {
                                                        $invoicedate = "";
                                                        $editinvoicedate = "";
                                                    }

                                                    if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "0000-00-00 00:00:00") {
                                                        $maturitydate = date("F d, Y", strtotime($maturitydate));
                                                        $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
                                                    } else {
                                                        $maturitydate = "";
                                                        $editmaturitydate = "";
                                                    }

                                                    if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "0000-00-00 00:00:00") {
                                                        $deliverydate = date("F d, Y", strtotime($deliverydate));
                                                        $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
                                                    } else {
                                                        $deliverydate = "";
                                                        $editdeliverydate = "";
                                                    }

                                                    if($ordate != "" && $ordate != "1970-01-01 01:00:00" && $ordate != "0000-00-00 00:00:00") {
                                                        $ordate = date("F d, Y", strtotime($ordate));
                                                        $editordate = date("m/d/Y", strtotime($ordate));
                                                    } else {
                                                        $ordate = "";
                                                        $editordate = "";
                                                    }

                                                    $dateadded = date("F d, Y", strtotime($dateadded));

                                                    echo '
                                                    <tr>
                                                    <td>'.$count.'</td>
                                                    <td>'.$companyname.'</td>           
                                                    <td>'.$totalamount.'</td>
                                                    <td>'.$invoicedate.'</td>
                                                    <td>'.$maturitydate.'</td>
                                                    <td>'.$leftdays.'</td>
                                                    <td>'.$exceeddays.'</td>
                                                    <td><a href="javascript:void(0)" onclick="openCollectiblesInfoDialog(\''.$count.'\',\''.$companyname.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$invoicedate.'\',\''.$maturitydate.'\',\''.$drnumber.'\',\''.$deliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$ordate.'\')">More</a> | <a href="javascript:void(0)" onclick="openCollectiblesEditDialog(\''.$recid.'\',\''.$companyid.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$editinvoicedate.'\',\''.$editmaturitydate.'\',\''.$drnumber.'\',\''.$editdeliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$editordate.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCollectiblesMarkPaidDialog('.$recid.')">Paid</a> | <a href="javascript:void(0)" onclick="openCollectiblesDeleteDialog('.$recid.')">Delete</a></td>
                                                    </tr>
                                                    ';   

                                                  }
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            <?php } else if (isset($_GET["ageing"]) && isset($_GET["view"]) && trim($_GET["ageing"]) == "focus" && trim($_GET["view"]) == "paidcollectibles") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&ageing=focus&view=collectibles">View Collectibles</a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date" placeholder="Search Company, P.O Name or Invoice Number" id="search-paid-collectibles"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-search"></span></span>
                                        </div>
                                        <hr>
                                        <div id="paid-collectibles-search-result">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Client/Company</th>
                                                    <th>Total Amount</th>
                                                    <th>Invoice Date</th>
                                                    <th>Maturity Date</th>
                                                    <th>Days Left</th>
                                                    <th>Days Exceed</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_collectibles WHERE collectibles_status = '2' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $companyid = $row["company_id"];

                                                    $sql1 = "SELECT * FROM hurtajadmin_company WHERE id = '$companyid' ORDER BY id DESC";
                                                    $query1 = mysqli_query($db_conn, $sql1);
                                                    while($row1 = mysqli_fetch_array($query1)) {
                                                        $companyname = $row1["company_name"];
                                                    }

                                                    $totalamount = $row["collectibles_total_amount"];
                                                    $ponumber = $row["collectibles_po_number"];
                                                    $invocenumber = $row["collectibles_invoice_number"];
                                                    $invoicedate = $row["collectibles_invoice_date"];
                                                    $maturitydate = $row["collectibles_maturity_date"];
                                                    $drnumber = $row["collectibles_dr_number"];
                                                    $deliverydate = $row["collectibles_delivery_date"];
                                                    $remarkspaid = $row["collectibles_remarks_paid"];
                                                    $ornumber = $row["collectibles_or_number"];
                                                    $ordate = $row["collectibles_or_date"];
                                                    $dateadded = $row["collectibles_date_added"];

                                                    $now = time(); // or your date as well
                                                    $your_date = strtotime($maturitydate);
                                                    $datediff = $your_date - $now;
                                                    $datediff = round($datediff / (60 * 60 * 24));

                                                    $exceeddays = 0;
                                                    $leftdays = 0;

                                                    if($datediff < 0) {
                                                        $exceeddays = abs($datediff);
                                                    } else if($datediff > 0) {
                                                        $leftdays = $datediff;
                                                    }

                                                    if($invoicedate != "" && $invoicedate != "1970-01-01 01:00:00" && $invoicedate != "0000-00-00 00:00:00") {
                                                        $invoicedate = date("F d, Y", strtotime($invoicedate));
                                                        $editinvoicedate = date("m/d/Y", strtotime($invoicedate));
                                                    } else {
                                                        $invoicedate = "";
                                                        $editinvoicedate = "";
                                                    }

                                                    if($maturitydate != "" && $maturitydate != "1970-01-01 01:00:00" && $maturitydate != "0000-00-00 00:00:00") {
                                                        $maturitydate = date("F d, Y", strtotime($maturitydate));
                                                        $editmaturitydate = date("m/d/Y", strtotime($maturitydate));
                                                    } else {
                                                        $maturitydate = "";
                                                        $editmaturitydate = "";
                                                    }

                                                    if($deliverydate != "" && $deliverydate != "1970-01-01 01:00:00" && $deliverydate != "0000-00-00 00:00:00") {
                                                        $deliverydate = date("F d, Y", strtotime($deliverydate));
                                                        $editdeliverydate = date("m/d/Y", strtotime($deliverydate));
                                                    } else {
                                                        $deliverydate = "";
                                                        $editdeliverydate = "";
                                                    }

                                                    if($ordate != "" && $ordate != "1970-01-01 01:00:00" && $ordate != "0000-00-00 00:00:00") {
                                                        $ordate = date("F d, Y", strtotime($ordate));
                                                        $editordate = date("m/d/Y", strtotime($ordate));
                                                    } else {
                                                        $ordate = "";
                                                        $editordate = "";
                                                    }

                                                    $dateadded = date("F d, Y", strtotime($dateadded));

                                                    echo '
                                                    <tr>
                                                    <td>'.$count.'</td>
                                                    <td>'.$companyname.'</td>           
                                                    <td>'.$totalamount.'</td>
                                                    <td>'.$invoicedate.'</td>
                                                    <td>'.$maturitydate.'</td>
                                                    <td>'.$leftdays.'</td>
                                                    <td>'.$exceeddays.'</td>
                                                    <td><a href="javascript:void(0)" onclick="openCollectiblesInfoDialog(\''.$count.'\',\''.$companyname.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$invoicedate.'\',\''.$maturitydate.'\',\''.$drnumber.'\',\''.$deliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$ordate.'\')">More</a> | <a href="javascript:void(0)" onclick="openCollectiblesEditDialog(\''.$recid.'\',\''.$companyid.'\',\''.$totalamount.'\',\''.$ponumber.'\',\''.$invocenumber.'\',\''.$editinvoicedate.'\',\''.$editmaturitydate.'\',\''.$drnumber.'\',\''.$editdeliverydate.'\',\''.$remarkspaid.'\',\''.$ornumber.'\',\''.$editordate.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCollectiblesMarkUnpaidDialog('.$recid.')">Unpaid</a> | <a href="javascript:void(0)" onclick="openCollectiblesDeleteDialog('.$recid.')">Delete</a></td>
                                                    </tr>
                                                    ';   

                                                  }
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            <?php } else if (isset($_GET["employee"]) && isset($_GET["add"]) && trim($_GET["employee"]) == "focus" && trim($_GET["add"]) == "employee") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                        <div id="my-request" class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" id="AddNewEmployeeBtn" href="account.php?id=<?php echo $log_id; ?>&employee=focus&view=employee">Master Lists</a></div>
                            <div class="panel-body">
                                <div class="col-md-6 col-md-offset-3">
                                    <form id="loginForm" onsubmit="return false;">
                                        <span id="addEmployeeStatus"></span>
                                        <div class="form-group">
                                            <label class="control-label">First Name</label>
                                            <input type="text" class="form-control" id="add-employee-fname" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Middle Name</label>
                                            <input type="text" class="form-control" id="add-employee-mname" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Last Name</label>
                                            <input type="text" class="form-control" id="add-employee-lname" placeholder="">
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label">Gender</label>
                                                <select class="form-control" id="add-employee-gender">
                                                    <option value=""></option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label">Date of Birth</label>
                                              <div class="input-group date" id="datePicker5">
                                                <input type="text" class="form-control" name="date" id="add-employee-birthday" autocomplete="off" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                        <div class="form-group">
                                            <label class="control-label">Contact</label>
                                            <input type="text" class="form-control" id="add-employee-contact" placeholder="">
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <input type="text" class="form-control" id="add-employee-address" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Status</label>
                                            <select class="form-control" id="add-employee-status">
                                                <option value=""></option>
                                                <option value="1">Active</option>
                                                <option value="2">Resigned</option>
                                                <option value="3">Terminated</option>
                                                <option value="4">AWOL</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Join Date</label>
                                            <div class="date">
                                                <div class="input-group date" id="datePicker6">
                                                <input type="text" class="form-control" name="date" id="add-employee-hired-date" autocomplete="off"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Start Date (Optional)</label>
                                            <div class="date">
                                                <div class="input-group date" id="datePicker7">
                                                <input type="text" class="form-control" name="date" id="add-employee-start-date" autocomplete="off"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">End Date (Optional)</label>
                                            <div class="date">
                                                <div class="input-group date" id="datePicker8">
                                                <input type="text" class="form-control" name="date" id="add-employee-end-date" autocomplete="off" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label">TIN I.D (Optional)</label>
                                                <input type="text" class="form-control" id="add-employee-tin" placeholder="">
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label">Pag-IBIG I.D (Optional)</label>
                                                <input type="text" class="form-control" id="add-employee-pagibig" placeholder="">
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label">PhilHealth I.D (Optional)</label>
                                                <input type="text" class="form-control" id="add-employee-philhealth" placeholder="">
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label">SSS I.D (Optional)</label>
                                                <input type="text" class="form-control" id="add-employee-sss" placeholder="">
                                        </div>
                                        <button type="button" class="btn btn-primary" id="addEmployeeBtn" style="width: 100%;" onclick="addEmployeeRecord()">ADD</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <br>
            <?php } else if (isset($_GET["employee"]) && isset($_GET["view"]) && trim($_GET["employee"]) == "focus" && trim($_GET["view"]) == "employee") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $log_id; ?>&employee=focus&add=employee">Add Employee</a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="form-group">
                                            <select class="form-control" id="select-filter">
                                                <option value="">Select Filter</option>
                                                <option value="name">Filter by Name</option>
                                                <option value="status">Filter by Status</option>
                                            </select>
                                        </div>
                                        <div class="form-group" id="select-filter-search" hidden="true">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date" placeholder="Search Employee" id="search-employee" autocomplete="off" />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-search"></span></span>
                                        </div>
                                        </div>
                                        <div class="form-group" id="select-filter-status" hidden="true"><!--Status-->
                                            <select class="form-control" id="select-status">
                                                <option value="">Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="2">Resigned</option>
                                                <option value="3">Terminated</option>
                                                <option value="4">AWOL</option>
                                            </select>
                                        </div>
                                        <hr>
                                        <div id="employee-search-result">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_status != '5' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $empid = $row["employee_id"];
                                                    $fname = $row["employee_fname"];
                                                    $mname = $row["employee_mname"];
                                                    $lname = $row["employee_lname"];
                                                    $gender = $row["employee_gender"];
                                                    $birthday = $row["employee_birthday"];
                                                    $address = $row["employee_address"];
                                                    $contact = $row["employee_phone"];
                                                    $datehired = $row["employee_date_hired"];
                                                    $datestart = $row["employee_date_start"];
                                                    $dateend = $row["employee_date_end"];
                                                    $stats = $row["employee_status"];

                                                    $tinid = "";
                                                    $pagibigid = "";
                                                    $philhealthid = "";
                                                    $sssid = "";
                                                    
                                                    if($birthday == "0000-00-00 00:00:00" || $birthday == "1970-01-01 00:00:00" || $birthday == "1970-01-01 01:00:00") {
                                                        $birthday = "";
                                                    } else {
                                                        $birthday = date("m/d/Y", strtotime($birthday));
                                                    }
                                                    
                                                    if($datehired == "0000-00-00 00:00:00" || $datehired == "1970-01-01 00:00:00" || $datehired == "1970-01-01 01:00:00") {
                                                        $datehired = "";
                                                    } else {
                                                        $datehired = date("m/d/Y", strtotime($datehired));
                                                    }

                                                    if($datestart == "0000-00-00 00:00:00" || $datestart == "1970-01-01 00:00:00" || $datestart == "1970-01-01 01:00:00") {
                                                        $datestart = "";
                                                    } else {
                                                        $datestart = date("m/d/Y", strtotime($datestart));
                                                    }

                                                    if($dateend == "0000-00-00 00:00:00" || $dateend == "1970-01-01 00:00:00" || $dateend == "1970-01-01 01:00:00") {
                                                        $dateend = "";
                                                    } else {
                                                        $dateend = date("m/d/Y", strtotime($dateend));
                                                    }
                                                    
                                                    $gendertext = "";
                                                    if($gender == "1") {
                                                        $gendertext = "Male";
                                                    } else if($gender == "2") {
                                                        $gendertext = "Female";
                                                    }
                                                    $statstext = "";
                                                    if($stats == "1") {
                                                        $statstext = "Active";
                                                    } else if($stats == "2") {
                                                        $statstext = "Resigned";
                                                    } else if($stats == "3") {
                                                        $statstext = "Terminated";
                                                    } else if($stats == "4") {
                                                        $statstext = "AWOL";
                                                    }
                                                    $mnameinitial = substr($mname, 0, 1);
                                                    $perhour = 0;
                                                    $tax = "";
                                                    $pagibig = "";
                                                    $sss = "";
                                                    $philhealth = "";
                                                    $sundayhoursworked1 = 0;
                                                    $sundayhoursworked2 = 0;
                                                    $firstcycleholidayhoursworked1 = 0;
                                                    $firstcycleholidayhoursworked2 = 0;
                                                    $firstcycleholidaybonushours1 = 0;
                                                    $firstcycleholidaybonushours2 = 0;
                                                    $secondcycleholidayhoursworked1 = 0;
                                                    $secondcycleholidayhoursworked2 = 0;
                                                    $secondcycleholidaybonushours1 = 0;
                                                    $secondcycleholidaybonushours2 = 0;
                                                    $taxcont1 = 0;
                                                    $ssscont1 = 0;
                                                    $philhealthcont1 = 0;
                                                    $pagibigcont1 = 0;
                                                    $taxcont2 = 0;
                                                    $ssscont2 = 0;
                                                    $philhealthcont2 = 0;
                                                    $pagibigcont2 = 0;
                                                    $hoursworked1 = 0;
                                                    $hoursworked2 = 0;
                                                    $otcount1 = 0;
                                                    $utcount1 = 0;
                                                    $otcount2 = 0;
                                                    $xotcount1 = 0;
                                                    $xotcountbase1 = 0;
                                                    $xotcount2 = 0;
                                                    $xotcountbase2 = 0;
                                                    $utcount2 = 0;
                                                    $dailycount1 = 0;
                                                    $dailycount2 = 0;
                                                    $latecount1 = 0;
                                                    $latecount2 = 0;
                                                    $disabled = "";
                                                    $currentprevyear = "";
                                                    $previousmonth = date("m", strtotime("-1 months"));
                                                    $month = date("m");
                                                    $year = date("Y");
                                                    if($month == "1") {
                                                        $currentprevyear = $year-1;
                                                    } else {
                                                        $currentprevyear = $year;
                                                    }
                                                    $cashloanfirstcycle = 0;
                                                    $cashloansecondcycle = 0;
                                                    $cashadvancefirstcycle = 0;
                                                    $cashadvancesecondcycle = 0;
                                                    $holidayfirstcycle = 0;
                                                    $holidaysecondcycle = 0;

                                                    // $firstcycledate1 = $previousmonth."/26/".$currentyear;
                                                    // $firstcycledate2 = $currentmonth."/11/".$currentyear;
                                                    $firstcycledate1 = "12/26/2017"; //this is cycle 25 to 10
                                                    $firstcycledate2 = "1/11/2018";
                                                    $firstcycledate1 = date("Y-m-d H:i:s", strtotime($firstcycledate1));
                                                    $firstcycledate2 = date("Y-m-d H:i:s", strtotime($firstcycledate2));
                                                    // $secondcycledate1 = $currentmonth."/11/".$currentyear;
                                                    // $secondcycledate2 = $currentmonth."/26/".$currentyear;
                                                    $secondcycledate1 = "1/11/2018"; //this is cycle 11 to 25
                                                    $secondcycledate2 = "1/26/2018";
                                                    $secondcycledate1 = date("Y-m-d H:i:s", strtotime($secondcycledate1));
                                                    $secondcycledate2 = date("Y-m-d H:i:s", strtotime($secondcycledate2));
                                                    $sql01 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$firstcycledate1' AND attendance_date_in_out < '$firstcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
                                                    $query01 = mysqli_query($db_conn, $sql01);
                                                    $count01 = mysqli_num_rows($query01);
                                                    while($row01 = mysqli_fetch_array($query01)) {
                                                        $datein = $row01["attendance_date_in_out"];

                                                        $dateindate = date("Y-m-d", strtotime($datein));

                                                        $latecount1 = $latecount1 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

                                                        if($latecount1 < 0.01) {
                                                            $latecount1 = 0;
                                                        }

                                                        $sqlout = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$datein') AND attendance_value = '1' AND attendance_status = '1'";
                                                        $queryout = mysqli_query($db_conn, $sqlout);
                                                        $countout = mysqli_num_rows($queryout);
                                                        if($countout > 0) {
                                                            while($rowout = mysqli_fetch_array($queryout)) {
                                                                $attendanceidout = $rowout["id"];  
                                                                $dateout = $rowout["attendance_date_in_out"];
                                                            }
                                                            $hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);
                                                               
                                                            if($hourdiff > 8){ // this is for overtime 
                                                                $otcount1 = $hourdiff - 8;
                                                                $dailycount1 = $hourdiff - $otcount1;
                                                            } else if($hourdiff < 8){ // this is for undertime
                                                                $utcount1 = $hourdiff;
                                                                $dailycount1 = $hourdiff;
                                                            } else {
                                                                $dailycount1 = $hourdiff;
                                                            }
                                                            
                                                            $hoursworked1 = $hoursworked1+$dailycount1;
                                                            $sqlhol1 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '1' AND holidays_status = '1'";
                                                            $queryhol1 = mysqli_query($db_conn, $sqlhol1);
                                                            $counthol1 = mysqli_num_rows($queryhol1);
                                                            if($counthol1 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '1'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase1 = $xotcount1 + $otcount1;

                                                                $xotcount1 = $xotcount1 + $otcount1 + ($otcount1 * 0.30);
                                                                
                                                                $firstcycleholidaybonus1 = ($holratepercentage / 100) * $hourdiff;
                                                                $firstcycleholidayhoursworked1 = $firstcycleholidayhoursworked1+$hourdiff;
                                                                if($firstcycleholidayhoursworked1 > 8) {
                                                                    $firstcycleholidayhoursworked1 = 8;
                                                                }
                                                                $firstcycleholidaybonushours1 = $firstcycleholidayhoursworked1+$firstcycleholidaybonus1;
                                                                // $hoursworked1 = $hoursworked1+$firstcycleholidaybonus1;
                                                            } 
                                                            $sqlhol2 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '2' AND holidays_status = '1'";
                                                            $queryhol2 = mysqli_query($db_conn, $sqlhol2);
                                                            $counthol2 = mysqli_num_rows($queryhol2);
                                                            if($counthol2 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '2'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase1 = $xotcount1 + $otcount1;

                                                                $xotcount1 = $xotcount1 + $otcount1 + ($otcount1 * 0.30);
                                                                
                                                                $firstcycleholidaybonus2 = ($holratepercentage / 100) * $hourdiff;
                                                                $firstcycleholidayhoursworked2 = $firstcycleholidayhoursworked2+$hourdiff;
                                                                if($firstcycleholidayhoursworked2 > 8) {
                                                                    $firstcycleholidayhoursworked2 = 8;
                                                                }
                                                                $firstcycleholidaybonushours2 = $firstcycleholidayhoursworked2+$firstcycleholidaybonus2;
                                                                // $hoursworked1 = $hoursworked1+$firstcycleholidaybonus2;
                                                            }

                                                            if($counthol1 < 1 && $counthol2 < 1) {
                                                                $xotcountbase1 = $xotcount1 + $otcount1;
                                                                $xotcount1 = $xotcount1 + $otcount1;
                                                            }

                                                        } 
                                                    }
                                                    $sql02 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$secondcycledate1' AND attendance_date_in_out < '$secondcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
                                                    $query02 = mysqli_query($db_conn, $sql02);
                                                    $count02 = mysqli_num_rows($query02);
                                                    while($row02 = mysqli_fetch_array($query02)) {
                                                        $datein = $row02["attendance_date_in_out"];

                                                        $dateindate = date("Y-m-d", strtotime($datein));

                                                        $latecount2 = $latecount2 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

                                                        if($latecount2 < 0.01) {
                                                            $latecount2 = 0;
                                                        }

                                                        $sqlout = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$datein') AND attendance_value = '1' AND attendance_status = '1'";
                                                        $queryout = mysqli_query($db_conn, $sqlout);
                                                        $countout = mysqli_num_rows($queryout);
                                                        if($countout > 0) {
                                                            while($rowout = mysqli_fetch_array($queryout)) {
                                                                $attendanceidout = $rowout["id"];  
                                                                $dateout = $rowout["attendance_date_in_out"];
                                                            }
                                                            $hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);
                                                              
                                                            if($hourdiff > 8){ // this is for overtime 
                                                                $otcount2 = $hourdiff - 8;
                                                                $dailycount2 = $hourdiff - $otcount2;
                                                            }else if($hourdiff < 8){ // this is for undertime
                                                                $utcount2 = $hourdiff;
                                                                $dailycount2 = $hourdiff;
                                                            }else{
                                                                $dailycount2 = $hourdiff;
                                                            }
                                                            
                                                            $hoursworked2 = $hoursworked2+$dailycount2;
                                                            $sqlhol1 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '1' AND holidays_status = '1'";
                                                            $queryhol1 = mysqli_query($db_conn, $sqlhol1);
                                                            $counthol1 = mysqli_num_rows($queryhol1);
                                                            if($counthol1 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '1'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase2 = $xotcount2 + $otcount2;

                                                                $xotcount2 = $xotcount2 + $otcount2 + ($otcount2 * 0.30);
                                                            
                                                                $secondcycleholidaybonus1 = ($holratepercentage / 100) * $dailycount2;
                                                                $secondcycleholidayhoursworked1 = $secondcycleholidayhoursworked1+$hourdiff;
                                                                if($secondcycleholidayhoursworked1 > 8) {
                                                                    $secondcycleholidayhoursworked1 = 8;
                                                                }
                                                                $secondcycleholidaybonushours1 = $secondcycleholidaybonushours1+$secondcycleholidaybonus1;
                                                                // $hoursworked2 = $hoursworked2+$secondcycleholidaybonus1;

                                                            }

                                                            $sqlhol2 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '2' AND holidays_status = '1'";
                                                            $queryhol2 = mysqli_query($db_conn, $sqlhol2);
                                                            $counthol2 = mysqli_num_rows($queryhol2);
                                                            if($counthol2 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '2'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase2 = $xotcount2 + $otcount2;

                                                                $xotcount2 = $xotcount2 + $otcount2 + ($otcount2 * 0.30);
                                                            
                                                                $secondcycleholidaybonus2 = ($holratepercentage / 100) * $dailycount2;
                                                                $secondcycleholidayhoursworked2 = $secondcycleholidayhoursworked2+$hourdiff;
                                                                if($secondcycleholidayhoursworked2 > 8) {
                                                                    $secondcycleholidayhoursworked2 = 8;
                                                                }
                                                                $secondcycleholidaybonushours2 = $secondcycleholidaybonushours2+$secondcycleholidaybonus2;
                                                                // $hoursworked2 = $hoursworked2+$secondcycleholidaybonus2;
                                                            }

                                                            if($counthol1 < 1 && $counthol2 < 1) {
                                                                $xotcountbase2 = $xotcount2 + $otcount2;
                                                                $xotcount2 = $xotcount2 + $otcount2;
                                                            }



                                                        } 
                                                    }
                                                    $sql1 = "SELECT * FROM hurtajadmin_employee_settings WHERE employee_id = '$empid'";
                                                    $query1 = mysqli_query($db_conn, $sql1);
                                                    $count1 = mysqli_num_rows($query1);
                                                    if($count1 > 0) {
                                                        while($row1 = mysqli_fetch_array($query1)) {  
                                                            $perhour = $row1["employee_settings_perhour"];
                                                            $tax = $row1["employee_settings_tax"];
                                                            $pagibig = $row1["employee_settings_pagibig"];
                                                            $sss = $row1["employee_settings_sss"];
                                                            $philhealth = $row1["employee_settings_philhealth"];
                                                        }
                                                    }

                                                    $sql_leave = "SELECT * FROM hurtajadmin_leave WHERE employee_id = '$empid' AND leave_status = '2' AND YEAR(leave_date) = YEAR(CURDATE())";
                                                    $query_leave = mysqli_query($db_conn, $sql_leave);
                                                    $countleave1 = mysqli_num_rows($query_leave);
                                                    $countleave2 = 5-$countleave1;


                                                    $sundayStartDate1 = date('Y-m-d', strtotime($firstcycledate1));
                                                    $sundayEndDate1 = date('Y-m-d', strtotime($firstcycledate2));

                                                    $sundayStartDate2 = date('Y-m-d', strtotime($secondcycledate1));
                                                    $sundayEndDate2 = date('Y-m-d', strtotime($secondcycledate2));
                                                    

                                                    $sundays1 = array();

                                                    while ($sundayStartDate1 <= $sundayEndDate1) {
                                                        if (date('w', strtotime($sundayStartDate1)) == 0) {
                                                            $sundays1[] = date('Y-m-d', strtotime($sundayStartDate1));
                                                        }

                                                        $sundayStartDate1 = date('Y-m-d H:i:s', strtotime($sundayStartDate1 . ' +1 day'));
                                                    }

                                                    if(count($sundays1) > 0) {
                                                        for($i = 0; $i < count($sundays1); $i++) {
                                                            $sundaydate1 = $sundays1[$i];
                                                            $sqlsd1 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND date(attendance_date_in_out) = '$sundaydate1' AND attendance_value = '0' AND attendance_status = '1' LIMIT 1";
                                                            $querysd1 = mysqli_query($db_conn, $sqlsd1);
                                                            $countsd1 = mysqli_num_rows($querysd1);
                                                            while($rowsd1 = mysqli_fetch_array($querysd1)) {
                                                                $dateinsd1 = $rowsd1["attendance_date_in_out"];
                                                                $sqloutsd1 = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$dateinsd1') AND attendance_value = '1' AND attendance_status = '1' LIMIT 1";
                                                                $queryoutsd1 = mysqli_query($db_conn, $sqloutsd1);
                                                                $countoutsd1 = mysqli_num_rows($queryoutsd1);
                                                                if($countoutsd1 > 0) {
                                                                    while($rowoutsd1 = mysqli_fetch_array($queryoutsd1)) {
                                                                        $attendanceidoutsd1 = $rowoutsd1["id"];  
                                                                        $dateoutsd = $rowoutsd1["attendance_date_in_out"];
                                                                    }

                                                                    $hourdiff1 = round((strtotime($dateoutsd1) - strtotime($dateinsd1))/3600, 1);
                                                                    if($hourdiff1 > 8) {
                                                                        $hourdiff1 = 8;
                                                                    }
                                                                    $sundayhoursworked1 = $sundayhoursworked1 + $hourdiff1;
                                                                }
                                                                    
                                                            }
                                                        }
                                                    }

                                                    $sundays2 = array();

                                                    while ($sundayStartDate2 <= $sundayEndDate2) {
                                                        if (date('w', strtotime($sundayStartDate2)) == 0) {
                                                            $sundays2[] = date('Y-m-d', strtotime($sundayStartDate2));
                                                        }

                                                        $sundayStartDate2 = date('Y-m-d H:i:s', strtotime($sundayStartDate2 . ' +1 day'));
                                                    }

                                                    if(count($sundays2) > 0) {
                                                        for($i = 0; $i < count($sundays2); $i++) {
                                                            $sundaydate2 = $sundays2[$i];
                                                            $sqlsd2 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND date(attendance_date_in_out) = '$sundaydate2' AND attendance_value = '0' AND attendance_status = '1' LIMIT 1";
                                                            $querysd2 = mysqli_query($db_conn, $sqlsd2);
                                                            $countsd2 = mysqli_num_rows($querysd2);
                                                            while($rowsd2 = mysqli_fetch_array($querysd2)) {
                                                                $dateinsd2 = $rowsd2["attendance_date_in_out"];
                                                                $sqloutsd2 = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$dateinsd2') AND attendance_value = '1' AND attendance_status = '1' LIMIT 1";
                                                                $queryoutsd2 = mysqli_query($db_conn, $sqloutsd2);
                                                                $countoutsd2 = mysqli_num_rows($queryoutsd2);
                                                                if($countoutsd2 > 0) {
                                                                    while($rowoutsd2 = mysqli_fetch_array($queryoutsd2)) {
                                                                        $attendanceidoutsd2 = $rowoutsd2["id"];  
                                                                        $dateoutsd2 = $rowoutsd2["attendance_date_in_out"];
                                                                    }

                                                                    $hourdiff2 = round((strtotime($dateoutsd2) - strtotime($dateinsd2))/3600, 1);
                                                                    if($hourdiff2 > 8) {
                                                                        $hourdiff2 = 8;
                                                                    }
                                                                    $sundayhoursworked2 = $sundayhoursworked2 + $hourdiff2;
                                                                }
                                                                    
                                                            }
                                                        }
                                                    }

                                                    $otpay1 = $perhour * $xotcount1; // this is base on per hour not ot per hour
                                                    $otpay2 = $perhour * $xotcount2; // this is base on per hour not ot per hour
                                                    $bimonthsalary1 = (($hoursworked1-$sundayhoursworked1-$firstcycleholidayhoursworked1-$firstcycleholidayhoursworked2)*$perhour)+($xotcount1*$perhour)+($sundayhoursworked1*$perhour)+(($firstcycleholidayhoursworked1+$firstcycleholidaybonushours1)*$perhour)+(($firstcycleholidayhoursworked2+$firstcycleholidaybonushours2)*$perhour);

                                                    $bimonthsalary2 = (($hoursworked2-$sundayhoursworked2-$secondcycleholidayhoursworked1-$secondcycleholidayhoursworked2)*$perhour)+($xotcount2*$perhour)+($sundayhoursworked2*$perhour)+(($secondcycleholidayhoursworked1+$secondcycleholidaybonushours1)*$perhour)+(($secondcycleholidayhoursworked2+$secondcycleholidaybonushours2)*$perhour);

                                                    if($tax == '1') {
                                                        $sql2 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary1 >= tax_contribution_range_from AND $bimonthsalary1 <= tax_contribution_range_to";
                                                        $query2 = mysqli_query($db_conn, $sql2);
                                                        $count2 = mysqli_num_rows($query2);
                                                        if($count2 > 0) {
                                                            while($row2 = mysqli_fetch_array($query2)) {  
                                                                $taxcont1 = $row2["tax_contribution_contribution"];
                                                                if($taxcont1 == "") {
                                                                    $taxcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql21 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary2 >= tax_contribution_range_from AND $bimonthsalary2 <= tax_contribution_range_to";
                                                        $query21 = mysqli_query($db_conn, $sql21);
                                                        $count21 = mysqli_num_rows($query21);
                                                        if($count21 > 0) {
                                                            while($row21 = mysqli_fetch_array($query21)) {  
                                                                $taxcont2 = $row21["tax_contribution_contribution"];
                                                                if($taxcont2 == "") {
                                                                    $taxcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($sss == '1') {
                                                        $sql3 = "SELECT * FROM hurtajadmin_sss_contribution WHERE $bimonthsalary1 >= sss_contribution_range_from AND $bimonthsalary1 <= sss_contribution_range_to";
                                                        $query3 = mysqli_query($db_conn, $sql3);
                                                        $count3 = mysqli_num_rows($query3);
                                                        if($count3 > 0) {
                                                            while($row3 = mysqli_fetch_array($query3)) {  
                                                                $ssscont1 = $row3["sss_contribution_contribution"];
                                                                if($ssscont1 == "") {
                                                                    $ssscont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql31 = "SELECT * FROM hurtajadmin_sss_contribution WHERE $bimonthsalary2 >= sss_contribution_range_from AND $bimonthsalary2 <= sss_contribution_range_to";
                                                        $query31 = mysqli_query($db_conn, $sql31);
                                                        $count31 = mysqli_num_rows($query31);
                                                        if($count31 > 0) {
                                                            while($row31 = mysqli_fetch_array($query31)) {  
                                                                $ssscont2 = $row31["sss_contribution_contribution"];
                                                                if($ssscont2 == "") {
                                                                    $ssscont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($philhealth == '1') {
                                                        $sql4 = "SELECT * FROM hurtajadmin_philhealth_contribution WHERE $bimonthsalary1 >= philhealth_contribution_range_from AND $bimonthsalary1 <= philhealth_contribution_range_to";
                                                        $query4 = mysqli_query($db_conn, $sql4);
                                                        $count4 = mysqli_num_rows($query4);
                                                        if($count4 > 0) {
                                                            while($row4 = mysqli_fetch_array($query4)) {  
                                                                $philhealthcont1 = $row4["philhealth_contribution_contribution"];
                                                                if($philhealthcont1 == "") {
                                                                    $philhealthcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql41 = "SELECT * FROM hurtajadmin_philhealth_contribution WHERE $bimonthsalary2 >= philhealth_contribution_range_from AND $bimonthsalary2 <= philhealth_contribution_range_to";
                                                        $query41 = mysqli_query($db_conn, $sql41);
                                                        $count41 = mysqli_num_rows($query41);
                                                        if($count41 > 0) {
                                                            while($row41 = mysqli_fetch_array($query41)) {  
                                                                $philhealthcont2 = $row41["philhealth_contribution_contribution"];
                                                                if($philhealthcont2 == "") {
                                                                    $philhealthcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($pagibig == '1') {
                                                        $sql5 = "SELECT * FROM hurtajadmin_pagibig_contribution WHERE $bimonthsalary1 >= pagibig_contribution_range_from AND $bimonthsalary1 <= pagibig_contribution_range_to";
                                                        $query5 = mysqli_query($db_conn, $sql5);
                                                        $count5 = mysqli_num_rows($query5);
                                                        if($count5 > 0) {
                                                            while($row5 = mysqli_fetch_array($query5)) {  
                                                                $pagibigcont1 = $row5["pagibig_contribution_contribution"];
                                                                if($pagibigcont1 == "") {
                                                                    $pagibigcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql51 = "SELECT * FROM hurtajadmin_pagibig_contribution WHERE $bimonthsalary2 >= pagibig_contribution_range_from AND $bimonthsalary2 <= pagibig_contribution_range_to";
                                                        $query51 = mysqli_query($db_conn, $sql51);
                                                        $count51 = mysqli_num_rows($query51);
                                                        if($count51 > 0) {
                                                            while($row51 = mysqli_fetch_array($query51)) {  
                                                                $pagibigcont2 = $row51["pagibig_contribution_contribution"];
                                                                if($pagibigcont2 == "") {
                                                                    $pagibigcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $sql6 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$firstcycledate1' AND cash_loan_advance_date < '$firstcycledate2' AND employee_id = '$empid' AND cash_loan_advance_status='1'";
                                                    $query6 = mysqli_query($db_conn, $sql6);
                                                    $count6 = mysqli_num_rows($query6);
                                                    if($count6 > 0) {
                                                        while($row6 = mysqli_fetch_array($query6)) {  
                                                            $cltype = $row6["cash_loan_advance_type"];
                                                            if($cltype == "1") {
                                                                $cashloanfirstcycle = $cashloanfirstcycle+$row6["cash_loan_advance_amount"];
                                                            } else if($cltype == "2") {
                                                                $cashadvancefirstcycle = $cashadvancefirstcycle+$row6["cash_loan_advance_amount"];
                                                            }
                                                            
                                                        }
                                                    }
                                                    $sql7 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$secondcycledate1' AND cash_loan_advance_date < '$secondcycledate2' AND employee_id = '$empid' AND cash_loan_advance_status='1'";
                                                    $query7 = mysqli_query($db_conn, $sql7);
                                                    $count7 = mysqli_num_rows($query7);
                                                    if($count7 > 0) {
                                                        while($row7 = mysqli_fetch_array($query7)) {  
                                                            $cltype = $row7["cash_loan_advance_type"];
                                                            if($cltype == "1") {
                                                                $cashloansecondcycle = $cashloansecondcycle+$row7["cash_loan_advance_amount"];
                                                            } else if($cltype == "2") {
                                                                $cashadvancesecondcycle = $cashadvancesecondcycle+$row7["cash_loan_advance_amount"];
                                                            }
                                                        }
                                                    }
                                                    $sql8 = "SELECT SUM(id) AS regularholidaytotal FROM hurtajadmin_holidays WHERE holidays_date >= '$firstcycledate1' AND holidays_date < '$firstcycledate2' AND holidays_type = '1' AND holidays_status = '1'";
                                                    $query8 = mysqli_query($db_conn, $sql8);
                                                    $count8 = mysqli_num_rows($query8);
                                                    if($count8 > 0) {
                                                        while($row8 = mysqli_fetch_array($query8)) {  
                                                            $holidayfirstcycle = $row8["regularholidaytotal"];
                                                        }
                                                    }
                                                    $sql9 = "SELECT SUM(id) AS regularholidaytotal FROM hurtajadmin_holidays WHERE holidays_date >= '$secondcycledate1' AND holidays_date < '$secondcycledate2' AND holidays_type = '1' AND holidays_status = '1'";
                                                    $query9 = mysqli_query($db_conn, $sql9);
                                                    $count9 = mysqli_num_rows($query9);
                                                    if($count9 > 0) {
                                                        while($row9 = mysqli_fetch_array($query9)) {  
                                                            $holidaysecondcycle = $row9["regularholidaytotal"];
                                                        }
                                                    }

                                                    $hoursworked = $hoursworked1+$hoursworked2+$xotcountbase1+$xotcountbase2; 
                                                    $deductions1 = (float)$taxcont1+(float)$pagibigcont1+(float)$ssscont1+(float)$philhealthcont1;
                                                    $deductions2 = (float)$taxcont2+(float)$pagibigcont2+(float)$ssscont2+(float)$philhealthcont2;
                                                    $payroll_settings_paycheck_deducted_1 = 0;
                                                    $payroll_settings_paycheck_base_1 = 0;
                                                    $payroll_settings_paycheck_deducted_2 = 0;
                                                    $payroll_settings_paycheck_base_2= 0;
                                                    
                                                    if($perhour > 0) {
                                                        if($deductions1 > 0 && ($cashloanfirstcycle > 0 || $cashadvancefirstcycle > 0) && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1-$cashloanfirstcycle-$cashadvancefirstcycle;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 > 0 && $cashloanfirstcycle < 1 && $cashadvancefirstcycle < 1 && $hoursworked1 > 0) {
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 < 1 && ($cashloanfirstcycle > 0 || $cashadvancefirstcycle > 0)  && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$cashloanfirstcycle-$cashadvancefirstcycle;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 < 1 && $cashloanfirstcycle < 1 && $cashadvancefirstcycle < 1  && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else {
                                                            $payroll_settings_paycheck_deducted_1 = "0";
                                                        }
                                                    } else {
                                                        $payroll_settings_paycheck_deducted_1 = "0";
                                                    }

                                                    if($perhour > 0) {
                                                        if($deductions2 > 0 && ($cashloansecondcycle > 0 || $cashadvancesecondcycle > 0) && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2-$cashloansecondcycle-$cashadvancesecondcycle;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 > 0 && $cashloansecondcycle < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 < 1 && ($cashloansecondcycle > 0 || $cashadvancesecondcycle > 0) && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$cashadvancesecondcycle;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 < 1 && $cashloansecondcycle < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else {
                                                            $payroll_settings_paycheck_deducted_2 = "0";
                                                        }
                                                    } else {
                                                        $payroll_settings_paycheck_deducted_2 = "0";
                                                    }

                                                    echo '
                                                    <tr>
                                                    <td>'.$empid.'</td>
                                                    <td>'.$fname.' '.$mnameinitial.'. '.$lname.'</td>           
                                                    <td>'.$gendertext.'</td>
                                                    <td>'.$statstext.'</td>
                                                    <td><a href="javascript:void(0)" onclick="openEmployeeMore(\''.$empid.'\',\''.$fname.' '.$mnameinitial.'. '.$lname.'\',\''.$gendertext.'\',\''.$birthday.'\',\''.$contact.'\',\''.$address.'\',\''.$datehired.'\',\''.$datestart.'\',\''.$dateend.'\',\''.$countleave1.'\',\''.$countleave2.'\',\''.$statstext.'\')">More</a> | <a href="javascript:void(0)"  onclick="openEmployeePayrollSettingsDialog(\''.$empid.'\',\''.$recid.'\',\''.$fname.' '.$mnameinitial.'. '.$lname.'\',\''.$perhour.'\',\''.$tax.'\',\''.$pagibig.'\',\''.$sss.'\',\''.$philhealth.'\',\''.$hoursworked.'\',\''.$bimonthsalary1.'\',\''.$bimonthsalary2.'\')">Payroll Settings</a> | <a href="javascript:void(0)" onclick="openEmployeeEditDialog('.$recid.',\''.$empid.'\',\''.$fname.'\',\''.$mname.'\',\''.$lname.'\',\''.$gender.'\',\''.$birthday.'\',\''.$address.'\',\''.$contact.'\',\''.$datehired.'\',\''.$datestart.'\',\''.$dateend.'\',\''.$stats.'\',\''.$tinid.'\',\''.$pagibigid.'\',\''.$philhealthid.'\',\''.$sssid.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openEmployeeDeleteDialog('.$recid.')">Delete</a></td></tr>
                                                    ';   

                                                  }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            <?php } else if (isset($_GET["employee"]) && isset($_GET["cash"]) && trim($_GET["employee"]) == "focus" && trim($_GET["cash"]) == "employee") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="javascript:void(0)" onclick="openCashLoanAdvanceAddDialog()">Add New Loan/Advance</a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date" placeholder="Search Employee Name or Employee ID" id="search-cash-advance-loan" autocomplete="off" />
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-search"></span></span>
                                        </div>
                                        <hr>
                                        <div id="cash-advance-loan-search-result">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE   cash_loan_advance_status = '1' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $empid = $row["employee_id"];
                                                    $type = $row["cash_loan_advance_type"];
                                                    $amount = $row["cash_loan_advance_amount"];
                                                    $date = $row["cash_loan_advance_date"];
                                                    $newDate = date("F d, Y H:i A", strtotime($date));

                                                    $sql1 = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' LIMIT 1";
                                                    $query1 = mysqli_query($db_conn, $sql1);;
                                                    while($row1 = mysqli_fetch_array($query1)) {  
                                                        $fname = $row1["employee_fname"];
                                                        $mname = $row1["employee_mname"];
                                                        $lname = $row1["employee_lname"];
                                                    }

                                                    $mnameinitial = substr($mname, 0, 1);

                                                    $typetext = "";

                                                    if($type == "1") {
                                                        $typetext = "Loan";
                                                    } else if($type == "2") {
                                                        $typetext = "Advance";
                                                    }

                                                    echo '
                                                    <tr>
                                                    <td>'.$count.'</td>
                                                    <td>'.$empid.'</td>           
                                                    <td>'.$fname.' '.$mname.'. '.$lname.'</td>
                                                    <td>'.$typetext.'</td>
                                                    <td>₱'.number_format($amount, 2, '.', ',').'</td>
                                                    <td>'.$newDate.'</td>
                                                    <td><a href="javascript:void(0)" onclick="openCashLoanAdvanceEditDialog('.$recid.',\''.$empid.'\',\''.$type.'\',\''.$amount.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openCashLoanAdvanceDeleteDialog('.$recid.')">Delete</a></td>
                                                    </tr>
                                                    ';   

                                                  }
                                                ?>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "attendance") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip">Generate Payslip</a></div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="col-md-6 col-md-offset-3">
                                        <p>Upload your biometrics excel file here...</p>
                                        <form method="POST" id="form-import" action="parsers/importpayroll.php" enctype="multipart/form-data">
                                            <input id="importPayrollFile" name="file" class="form-control upload-input" placeholder="File Path.." disabled="disabled"  />
                                            <div class="fileUpload btn btn-default">
                                                <span>Choose File</span>
                                                <input id="importPayrollHiddenBtn" type="file" name="file" class="upload" />
                                            </div>
                                            <div class="form-group">
                                                <input id="import-payroll-sheet-number" type="number" name="import-payroll-sheet-number" class="form-control" placeholder="Sheet Number" />
                                            </div>
                                            <button type="submit" name="import-payroll-submit-excel" id="importPayrollBtn" disabled="disabled" class="btn btn-primary btn-block">Upload</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && !isset($_GET["type"]) && !isset($_GET["to"]) && !isset($_GET["empid"]) && !isset($_GET["month"]) && !isset($_GET["cycle"]) && !isset($_GET["year"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "payslip") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="my-request" class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=attendance">Import Attendance</a></div>
                            <div class="panel-body">
                                <div class="col-md-6 col-md-offset-3">
                                    <form id="loginForm" onsubmit="return false;">
                                        <span id="paySlipPageStatus"></span>
                                        <div class="form-group">
                                          <label class="control-label">Payment Type</label>
                                          <select class="form-control" name="payrollType" id="payrollType">
                                            <option value=""></option>
                                            <option value="1">Regular</option>
                                            <option value="2">13th month</option>
                                          </select>
                                        </div>
                                        <div class="form-group" hidden="true" id="payrollToDiv">
                                          <label class="control-label">Payment to</label>
                                          <select class="form-control" name="payrollType" id="payrollTo">
                                            <option value=""></option>
                                            <option value="1">all employee</option>
                                            <option value="2">an employee</option>
                                          </select>
                                        </div>
                                        <div class="form-group" hidden="true" id="payrollEmpIDDiv">
                                            <label class="control-label">Employee ID</label>
                                            <input type="text" class="form-control" name="date" id="payrollEmpID"/>
                                        </div>
                                        <div class="form-group" hidden="true" id="payrollMonthDiv">
                                            <label class="control-label">Month</label>
                                            <select class="form-control" name="payrollMonth" id="payrollMonth">
                                            <option value=""></option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                          </select>
                                        </div>
                                        <div class="form-group" hidden="true" id="payrollCycleDiv">
                                            <label class="control-label">Cycle</label>
                                            <select class="form-control" name="payrollCycle" id="payrollCycle">
                                            <option value=""></option>
                                            <option value="1">26-10</option>
                                            <option value="2">11-25</option>
                                          </select>
                                        </div>
                                        <div class="form-group" hidden="true" id="payrollYearDiv">
                                            <label class="control-label">Year</label>
                                            <select class="form-control" name="payrollCycle" id="payrollYear">
                                            <option value=""></option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                          </select>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="paySlipPageBtn" style="width: 100%" onclick="generatePaySlipPage();">Generate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && isset($_GET["type"]) && isset($_GET["to"]) && isset($_GET["empid"]) && isset($_GET["month"]) && isset($_GET["cycle"]) && isset($_GET["year"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "payslip") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <?php

                        $type = $_GET["type"];
                        $to = $_GET["to"];
                        $headerinfo = "";
                        $printbtn = "";

                        if($type == "1") {

                            $empid = $_GET["empid"];
                            $month = $_GET["month"];
                            $cycle = $_GET["cycle"];
                            $year = $_GET["year"];
                            $monthtext = "";
                            $prevmonthtext = "";
                            $daytext1 = "";
                            $daytext2 = "";

                            $prevmonth = "";
                            $prevyear = "";
                            if($month == "1") {
                               $prevmonth = "12";
                               $prevyear = $year-1;
                               $prevyear = ", ".$prevyear;
                            } else {
                               $prevmonth = $month-1; 
                            }

                            if($cycle == "1") {
                                $daytext1 = "26";
                                $daytext2 = "10";
                            } else if($cycle == "2") {
                                $daytext1 = "11";
                                $daytext2 = "25";
                            }

                            if($month == "1") {
                                $monthtext = "Jan";
                            } else if($month == "2") {
                                $monthtext = "Feb";
                            } else if($month == "3") {
                                $monthtext = "Mar";
                            } else if($month == "4") {
                                $monthtext = "Apr";
                            } else if($month == "5") {
                                $monthtext = "May";
                            } else if($month == "6") {
                                $monthtext = "Jun";
                            } else if($month == "7") {
                                $monthtext = "Jul";
                            } else if($month == "8") {
                                $monthtext = "Aug";
                            } else if($month == "9") {
                                $monthtext = "Sep";
                            } else if($month == "10") {
                                $monthtext = "Oct";
                            } else if($month == "11") {
                                $monthtext = "Nov";
                            } else if($month == "12") {
                                $monthtext = "Dec";
                            }

                            if($prevmonth == "1") {
                                $prevmonthtext = "Jan";
                            } else if($prevmonth == "2") {
                                $prevmonthtext = "Feb";
                            } else if($prevmonth == "3") {
                                $prevmonthtext = "Mar";
                            } else if($prevmonth == "4") {
                                $prevmonthtext = "Apr";
                            } else if($prevmonth == "5") {
                                $prevmonthtext = "May";
                            } else if($prevmonth == "6") {
                                $prevmonthtext = "Jun";
                            } else if($prevmonth == "7") {
                                $prevmonthtext = "Jul";
                            } else if($prevmonth == "8") {
                                $prevmonthtext = "Aug";
                            } else if($prevmonth == "9") {
                                $prevmonthtext = "Sep";
                            } else if($prevmonth == "10") {
                                $prevmonthtext = "Oct";
                            } else if($prevmonth == "11") {
                                $prevmonthtext = "Nov";
                            } else if($prevmonth == "12") {
                                $prevmonthtext = "Dec";
                            }

                            if($month < 10) {
                               $month = "0".$month;
                            }

                            if($prevmonth < 10) {
                               $prevmonth = "0".$prevmonth;
                            }

                            if($to == "1") {

                                if($cycle == "1") {

                                    $headerinfo = '<div class="col-md-6"><span style="font-size: 22px;"><b>Date Cycle:</b> '.$prevmonthtext.' '.$daytext1.''.$prevyear.' - '.$monthtext.' '.$daytext2.', '.$year.'</span></div><div class="col-md-6"><span style="font-size: 22px;"><b>Type:</b> Regular</span></div>';

                                    $printbtn = '<a type="button" class="btn btn-danger" href="payslip.php?type='.$type.'&to='.$to.'&empid=0&month='.$month.'&cycle='.$cycle.'&year='.$year.'" target="_blank">Print</a>';

                                } else if($cycle == "2") {

                                    $headerinfo = '<div class="col-md-6"><span style="font-size: 22px;"><b>Date Cycle:</b> '.$monthtext.' '.$daytext1.' - '.$monthtext.' '.$daytext2.', '.$year.'</span></div><div class="col-md-6"><span style="font-size: 22px;"><b>Type:</b> Regular</span></div>';

                                    $printbtn = '<a type="button" class="btn btn-danger" href="payslip.php?type='.$type.'&to='.$to.'&empid=0&month='.$month.'&cycle='.$cycle.'&year='.$year.'" target="_blank">Print</a>';

                                }


                            } else if($to == "2") {

                                $headerinfo = '<div class="col-md-6"><span style="font-size: 22px;"><b>Date Cycle:</b> '.$prevmonthtext.' '.$daytext1.''.$prevyear.' - '.$monthtext.' '.$daytext2.', '.$year.'</span></div><div class="col-md-3"><span style="font-size: 22px;"><b>Employee ID:</b> '.$empid.'</span></div><div class="col-md-3"><span style="font-size: 22px;"><b>Type:</b> Regular</span></div>';

                                $printbtn = '<a type="button" class="btn btn-danger" href="payslip.php?type='.$type.'&to='.$to.'&empid='.$empid.'&month='.$month.'&cycle='.$cycle.'&year='.$year.'" target="_blank">Print</a>';

                            }

                        } else if($type == "2") {
                            $empid = $_GET["empid"];
                            $year = $_GET["year"];

                            if($to == "1") {

                                $headerinfo = '<div class="col-md-6"><span style="font-size: 22px;"><b>Year:</b> '.$year.'</span></div><div class="col-md-6"><span style="font-size: 22px;"><b>Type:</b> 13th Month</span></div>';

                                $printbtn = '<a type="button" class="btn btn-danger" href="payslip.php?type='.$type.'&to='.$to.'&empid=0&month=0&cycle=0&year='.$year.'" target="_blank">Print</a>';

                            } else if($to == "2") {

                                $headerinfo = '<div class="col-md-4"><span style="font-size: 22px;"><b>Year:</b> '.$year.'</span></div>
                                        <div class="col-md-4"><span style="font-size: 22px;"><b>Employee ID:</b> '.$empid.'</span></div><div class="col-md-4"><span style="font-size: 22px;"><b>Type:</b> 13th Month</span></div>';

                                $printbtn = '<a type="button" class="btn btn-danger" href="payslip.php?type='.$type.'&to='.$to.'&empid='.$empid.'&month=0&cycle=0&year='.$year.'" target="_blank">Print</a>';

                            }
                        }

                        
                    ?>

                    <div class="row">
                    <div class="col-lg-12">
                        <div id="my-request" class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-default" href="account.php?id=<?php echo $log_id; ?>&payroll=focus&action=payslip">Back</a> <?php echo $printbtn; ?></div>
                            <div class="panel-body">
                                <div class="row">
                                    <?php echo $headerinfo; ?>
                                </div>
                                
                                <hr>
                                    <table class="table table-bordered">
                                            <thead>
                                            <?php if($type == "1") { ?>
                                              <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Basic Pay</th>
                                                <th>Overtime Pay</th>
                                                <th>Deductions</th>
                                              </tr>
                                            <?php } else if($type == "2") { ?>
                                                <tr>
                                                <th>Employee ID</th>
                                                <th>Name</th>
                                                <th>Basic Pay</th>
                                                <th>Overtime Pay</th>
                                                <th>13th Month Pay</th>
                                              </tr>
                                            <?php } ?>
                                        </thead>
                                        <tbody>
                                            <?php

                                            if($type == "1") {
                                                if($to == "1") {
                                                    $sql = "SELECT * FROM hurtajadmin_employee ORDER BY id DESC";
                                                } else if($to == "2") {
                                                    $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' ORDER BY id DESC";
                                                }
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $empid = $row["employee_id"];
                                                    $fname = $row["employee_fname"];
                                                    $mname = $row["employee_mname"];
                                                    $lname = $row["employee_lname"];
                                                    $gender = $row["employee_gender"];
                                                    $birthday = $row["employee_birthday"];
                                                    $address = $row["employee_address"];
                                                    $contact = $row["employee_phone"];
                                                    $datehired = $row["employee_date_start"];
                                                    $dateend = $row["employee_date_end"];
                                                    $stats = $row["employee_status"];
                                                    $tinid = "";
                                                    $pagibigid = "";
                                                    $philhealthid = "";
                                                    $sssid = "";
                                                    $editbirthday = date("m/d/Y", strtotime($birthday));
                                                    $editdatehired = date("m/d/Y", strtotime($datehired));
                                                    if($dateend == "0000-00-00 00:00:00" || $dateend == "1970-01-01 01:00:00") {
                                                        $editdateend = "";
                                                    } else {
                                                        $editdateend = date("m/d/Y", strtotime($dateend));
                                                    }
                                                    $birthday = date("F d, Y", strtotime($birthday));
                                                    $datehired = date("F d, Y", strtotime($datehired));
                                                    
                                                    $gendertext = "";
                                                    if($gender == "1") {
                                                        $gendertext = "Male";
                                                    } else if($gender == "2") {
                                                        $gendertext = "Female";
                                                    }
                                                    $statstext = "";
                                                    if($stats == "1") {
                                                        $statstext = "Active";
                                                    } else if($stats == "2") {
                                                        $statstext = "Resigned";
                                                    } else if($stats == "3") {
                                                        $statstext = "Terminated";
                                                    } else if($stats == "4") {
                                                        $statstext = "AWOL";
                                                    }
                                                    $mnameinitial = substr($mname, 0, 1);
                                                    $perhour = 0;
                                                    $tax = "";
                                                    $pagibig = "";
                                                    $sss = "";
                                                    $philhealth = "";
                                                    $sundayhoursworked = 0;
                                                    $firstcycleholidayhoursworked1 = 0;
                                                    $firstcycleholidayhoursworked2 = 0;
                                                    $firstcycleholidaybonushours1 = 0;
                                                    $firstcycleholidaybonushours2 = 0;
                                                    $secondcycleholidayhoursworked1 = 0;
                                                    $secondcycleholidayhoursworked2 = 0;
                                                    $secondcycleholidaybonushours1 = 0;
                                                    $secondcycleholidaybonushours2 = 0;
                                                    $taxcont1 = 0;
                                                    $ssscont1 = 0;
                                                    $philhealthcont1 = 0;
                                                    $pagibigcont1 = 0;
                                                    $taxcont2 = 0;
                                                    $ssscont2 = 0;
                                                    $philhealthcont2 = 0;
                                                    $pagibigcont2 = 0;
                                                    $hoursworked1 = 0;
                                                    $hoursworked2 = 0;
                                                    $otcount1 = 0;
                                                    $utcount1 = 0;
                                                    $otcount2 = 0;
                                                    $xotcount1 = 0;
                                                    $xotcountbase1 = 0;
                                                    $xotcount2 = 0;
                                                    $xotcountbase2 = 0;
                                                    $utcount2 = 0;
                                                    $dailycount1 = 0;
                                                    $dailycount2 = 0;
                                                    $latecount1 = 0;
                                                    $latecount2 = 0;
                                                    $disabled = "";
                                                    $currentprevyear = "";
                                                    if($month == "1") {
                                                        $currentprevyear = $year-1;
                                                    } else {
                                                        $currentprevyear = $year;
                                                    }
                                                    $cashloanfirstcycle = 0;
                                                    $cashloansecondcycle = 0;
                                                    $cashadvancefirstcycle = 0;
                                                    $cashadvancesecondcycle = 0;
                                                    $holidayfirstcycle = 0;
                                                    $holidaysecondcycle = 0;

                                                    $firstcycledate1 = $prevmonth."/26/".$currentprevyear;
                                                    $firstcycledate2 = $month."/11/".$year;
                                                    // $firstcycledate1 = "12/26/2017"; //this is cycle 25 to 10
                                                    // $firstcycledate2 = "1/11/2018";
                                                    $firstcycledate1 = date("Y-m-d H:i:s", strtotime($firstcycledate1));
                                                    $firstcycledate2 = date("Y-m-d H:i:s", strtotime($firstcycledate2));
                                                    $secondcycledate1 = $month."/11/".$year;
                                                    $secondcycledate2 = $month."/26/".$year;
                                                    // $secondcycledate1 = "1/11/2018"; //this is cycle 11 to 25
                                                    // $secondcycledate2 = "1/26/2018";
                                                    $secondcycledate1 = date("Y-m-d H:i:s", strtotime($secondcycledate1));
                                                    $secondcycledate2 = date("Y-m-d H:i:s", strtotime($secondcycledate2));
                                                    $sql01 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$firstcycledate1' AND attendance_date_in_out < '$firstcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
                                                    $query01 = mysqli_query($db_conn, $sql01);
                                                    $count01 = mysqli_num_rows($query01);
                                                    while($row01 = mysqli_fetch_array($query01)) {
                                                        $datein = $row01["attendance_date_in_out"];

                                                        $dateindate = date("Y-m-d", strtotime($datein));

                                                        $latecount1 = $latecount1 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

                                                        if($latecount1 < 0.01) {
                                                            $latecount1 = 0;
                                                        }

                                                        $sqlout = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$datein') AND attendance_value = '1' AND attendance_status = '1'";
                                                        $queryout = mysqli_query($db_conn, $sqlout);
                                                        $countout = mysqli_num_rows($queryout);
                                                        if($countout > 0) {
                                                            while($rowout = mysqli_fetch_array($queryout)) {
                                                                $attendanceidout = $rowout["id"];  
                                                                $dateout = $rowout["attendance_date_in_out"];
                                                            }
                                                            $hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);
                                                               
                                                            if($hourdiff > 8){ // this is for overtime 
                                                                $otcount1 = $hourdiff - 8;
                                                                $dailycount1 = $hourdiff - $otcount1;
                                                            } else if($hourdiff < 8){ // this is for undertime
                                                                $utcount1 = $hourdiff;
                                                                $dailycount1 = $hourdiff;
                                                            } else {
                                                                $dailycount1 = $hourdiff;
                                                            }
                                                            
                                                            $hoursworked1 = $hoursworked1+$dailycount1;
                                                            $sqlhol1 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '1' AND holidays_status = '1'";
                                                            $queryhol1 = mysqli_query($db_conn, $sqlhol1);
                                                            $counthol1 = mysqli_num_rows($queryhol1);
                                                            if($counthol1 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '1'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase1 = $xotcount1 + $otcount1;

                                                                $xotcount1 = $xotcount1 + $otcount1 + ($otcount1 * 0.30);
                                                                
                                                                $firstcycleholidaybonus1 = ($holratepercentage / 100) * $hourdiff;
                                                                $firstcycleholidayhoursworked1 = $firstcycleholidayhoursworked1+$hourdiff;
                                                                if($firstcycleholidayhoursworked1 > 8) {
                                                                    $firstcycleholidayhoursworked1 = 8;
                                                                }
                                                                $firstcycleholidaybonushours1 = $firstcycleholidayhoursworked1+$firstcycleholidaybonus1;
                                                                // $hoursworked1 = $hoursworked1+$firstcycleholidaybonus1;
                                                            } 
                                                            $sqlhol2 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '2' AND holidays_status = '1'";
                                                            $queryhol2 = mysqli_query($db_conn, $sqlhol2);
                                                            $counthol2 = mysqli_num_rows($queryhol2);
                                                            if($counthol2 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '2'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase1 = $xotcount1 + $otcount1;

                                                                $xotcount1 = $xotcount1 + $otcount1 + ($otcount1 * 0.30);
                                                                
                                                                $firstcycleholidaybonus2 = ($holratepercentage / 100) * $hourdiff;
                                                                $firstcycleholidayhoursworked2 = $firstcycleholidayhoursworked2+$hourdiff;
                                                                if($firstcycleholidayhoursworked2 > 8) {
                                                                    $firstcycleholidayhoursworked2 = 8;
                                                                }
                                                                $firstcycleholidaybonushours2 = $firstcycleholidayhoursworked2+$firstcycleholidaybonus2;
                                                                // $hoursworked1 = $hoursworked1+$firstcycleholidaybonus2;
                                                            }

                                                            if($counthol1 < 1 && $counthol2 < 1) {
                                                                $xotcountbase1 = $xotcount1 + $otcount1;
                                                                $xotcount1 = $xotcount1 + $otcount1;
                                                            }

                                                        } 
                                                    }
                                                    $sql02 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$secondcycledate1' AND attendance_date_in_out < '$secondcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
                                                    $query02 = mysqli_query($db_conn, $sql02);
                                                    $count02 = mysqli_num_rows($query02);
                                                    while($row02 = mysqli_fetch_array($query02)) {
                                                        $datein = $row02["attendance_date_in_out"];

                                                        $dateindate = date("Y-m-d", strtotime($datein));

                                                        $latecount2 = $latecount2 + round((strtotime($datein) - strtotime($dateindate." 08:00:00"))/3600, 1);

                                                        if($latecount2 < 0.01) {
                                                            $latecount2 = 0;
                                                        }

                                                        $sqlout = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$datein') AND attendance_value = '1' AND attendance_status = '1'";
                                                        $queryout = mysqli_query($db_conn, $sqlout);
                                                        $countout = mysqli_num_rows($queryout);
                                                        if($countout > 0) {
                                                            while($rowout = mysqli_fetch_array($queryout)) {
                                                                $attendanceidout = $rowout["id"];  
                                                                $dateout = $rowout["attendance_date_in_out"];
                                                            }
                                                            $hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);
                                                              
                                                            if($hourdiff > 8){ // this is for overtime 
                                                                $otcount2 = $hourdiff - 8;
                                                                $dailycount2 = $hourdiff - $otcount2;
                                                            }else if($hourdiff < 8){ // this is for undertime
                                                                $utcount2 = $hourdiff;
                                                                $dailycount2 = $hourdiff;
                                                            }else{
                                                                $dailycount2 = $hourdiff;
                                                            }
                                                            
                                                            $hoursworked2 = $hoursworked2+$dailycount2;
                                                            $sqlhol1 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '1' AND holidays_status = '1'";
                                                            $queryhol1 = mysqli_query($db_conn, $sqlhol1);
                                                            $counthol1 = mysqli_num_rows($queryhol1);
                                                            if($counthol1 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '1'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase2 = $xotcount2 + $otcount2;

                                                                $xotcount2 = $xotcount2 + $otcount2 + ($otcount2 * 0.30);
                                                            
                                                                $secondcycleholidaybonus1 = ($holratepercentage / 100) * $dailycount2;
                                                                $secondcycleholidayhoursworked1 = $secondcycleholidayhoursworked1+$hourdiff;
                                                                if($secondcycleholidayhoursworked1 > 8) {
                                                                    $secondcycleholidayhoursworked1 = 8;
                                                                }
                                                                $secondcycleholidaybonushours1 = $secondcycleholidaybonushours1+$secondcycleholidaybonus1;
                                                                // $hoursworked2 = $hoursworked2+$secondcycleholidaybonus1;

                                                            }

                                                            $sqlhol2 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '2' AND holidays_status = '1'";
                                                            $queryhol2 = mysqli_query($db_conn, $sqlhol2);
                                                            $counthol2 = mysqli_num_rows($queryhol2);
                                                            if($counthol2 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '2'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $xotcountbase2 = $xotcount2 + $otcount2;

                                                                $xotcount2 = $xotcount2 + $otcount2 + ($otcount2 * 0.30);
                                                            
                                                                $secondcycleholidaybonus2 = ($holratepercentage / 100) * $dailycount2;
                                                                $secondcycleholidayhoursworked2 = $secondcycleholidayhoursworked2+$hourdiff;
                                                                if($secondcycleholidayhoursworked2 > 8) {
                                                                    $secondcycleholidayhoursworked2 = 8;
                                                                }
                                                                $secondcycleholidaybonushours2 = $secondcycleholidaybonushours2+$secondcycleholidaybonus2;
                                                                // $hoursworked2 = $hoursworked2+$secondcycleholidaybonus2;
                                                            }

                                                            if($counthol1 < 1 && $counthol2 < 1) {
                                                                $xotcountbase2 = $xotcount2 + $otcount2;
                                                                $xotcount2 = $xotcount2 + $otcount2;
                                                            }



                                                        } 
                                                    }
                                                    $sql1 = "SELECT * FROM hurtajadmin_employee_settings WHERE employee_id = '$empid'";
                                                    $query1 = mysqli_query($db_conn, $sql1);
                                                    $count1 = mysqli_num_rows($query1);
                                                    if($count1 > 0) {
                                                        while($row1 = mysqli_fetch_array($query1)) {  
                                                            $perhour = $row1["employee_settings_perhour"];
                                                            $tax = $row1["employee_settings_tax"];
                                                            $pagibig = $row1["employee_settings_pagibig"];
                                                            $sss = $row1["employee_settings_sss"];
                                                            $philhealth = $row1["employee_settings_philhealth"];
                                                        }
                                                    }

                                                    if($cycle == "1") {
                                                        $sundayStartDate = date('Y-m-d', strtotime($firstcycledate1));
                                                        $sundayEndDate = date('Y-m-d', strtotime($firstcycledate2));
                                                    } else if($cycle == "2") {
                                                        $sundayStartDate = date('Y-m-d', strtotime($secondcycledate1));
                                                        $sundayEndDate = date('Y-m-d', strtotime($secondcycledate2));
                                                    }

                                                    $sundays = array();

                                                    while ($sundayStartDate <= $sundayEndDate) {
                                                        if (date('w', strtotime($sundayStartDate)) == 0) {
                                                            $sundays[] = date('Y-m-d', strtotime($sundayStartDate));
                                                        }

                                                        $sundayStartDate = date('Y-m-d H:i:s', strtotime($sundayStartDate . ' +1 day'));
                                                    }

                                                    if(count($sundays) > 0) {
                                                        for($i = 0; $i < count($sundays); $i++) {
                                                            $sundaydate = $sundays[$i];
                                                            $sqlsd = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND date(attendance_date_in_out) = '$sundaydate' AND attendance_value = '0' AND attendance_status = '1' LIMIT 1";
                                                            $querysd = mysqli_query($db_conn, $sqlsd);
                                                            $countsd = mysqli_num_rows($querysd);
                                                            while($rowsd = mysqli_fetch_array($querysd)) {
                                                                $dateinsd = $rowsd["attendance_date_in_out"];
                                                                $sqloutsd = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$dateinsd') AND attendance_value = '1' AND attendance_status = '1' LIMIT 1";
                                                                $queryoutsd = mysqli_query($db_conn, $sqloutsd);
                                                                $countoutsd = mysqli_num_rows($queryoutsd);
                                                                if($countoutsd > 0) {
                                                                    while($rowoutsd = mysqli_fetch_array($queryoutsd)) {
                                                                        $attendanceidoutsd = $rowoutsd["id"];  
                                                                        $dateoutsd = $rowoutsd["attendance_date_in_out"];
                                                                    }

                                                                    $hourdiff = round((strtotime($dateoutsd) - strtotime($dateinsd))/3600, 1);
                                                                    if($hourdiff > 8) {
                                                                        $hourdiff = 8;
                                                                    }
                                                                    $sundayhoursworked = $sundayhoursworked + $hourdiff;
                                                                }
                                                                    
                                                            }
                                                        }
                                                    }

                                                    $otpay1 = $perhour * $xotcount1; // this is base on per hour not ot per hour
                                                    $otpay2 = $perhour * $xotcount2; // this is base on per hour not ot per hour
                                                    $bimonthsalary1 = (($hoursworked1-$sundayhoursworked-$firstcycleholidayhoursworked1-$firstcycleholidayhoursworked2)*$perhour)+($xotcount1*$perhour)+($sundayhoursworked*$perhour)+(($firstcycleholidayhoursworked1+$firstcycleholidaybonushours1)*$perhour)+(($firstcycleholidayhoursworked2+$firstcycleholidaybonushours2)*$perhour);

                                                    $bimonthsalary2 = (($hoursworked2-$sundayhoursworked-$secondcycleholidayhoursworked1-$secondcycleholidayhoursworked2)*$perhour)+($xotcount2*$perhour)+($sundayhoursworked*$perhour)+(($secondcycleholidayhoursworked1+$secondcycleholidaybonushours1)*$perhour)+(($secondcycleholidayhoursworked2+$secondcycleholidaybonushours2)*$perhour);

                                                    if($tax == '1') {
                                                        $sql2 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary1 >= tax_contribution_range_from AND $bimonthsalary1 <= tax_contribution_range_to";
                                                        $query2 = mysqli_query($db_conn, $sql2);
                                                        $count2 = mysqli_num_rows($query2);
                                                        if($count2 > 0) {
                                                            while($row2 = mysqli_fetch_array($query2)) {  
                                                                $taxcont1 = $row2["tax_contribution_contribution"];
                                                                if($taxcont1 == "") {
                                                                    $taxcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql21 = "SELECT * FROM hurtajadmin_tax_contribution WHERE $bimonthsalary2 >= tax_contribution_range_from AND $bimonthsalary2 <= tax_contribution_range_to";
                                                        $query21 = mysqli_query($db_conn, $sql21);
                                                        $count21 = mysqli_num_rows($query21);
                                                        if($count21 > 0) {
                                                            while($row21 = mysqli_fetch_array($query21)) {  
                                                                $taxcont2 = $row21["tax_contribution_contribution"];
                                                                if($taxcont2 == "") {
                                                                    $taxcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($sss == '1') {
                                                        $sql3 = "SELECT * FROM hurtajadmin_sss_contribution WHERE $bimonthsalary1 >= sss_contribution_range_from AND $bimonthsalary1 <= sss_contribution_range_to";
                                                        $query3 = mysqli_query($db_conn, $sql3);
                                                        $count3 = mysqli_num_rows($query3);
                                                        if($count3 > 0) {
                                                            while($row3 = mysqli_fetch_array($query3)) {  
                                                                $ssscont1 = $row3["sss_contribution_contribution"];
                                                                if($ssscont1 == "") {
                                                                    $ssscont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql31 = "SELECT * FROM hurtajadmin_sss_contribution WHERE $bimonthsalary2 >= sss_contribution_range_from AND $bimonthsalary2 <= sss_contribution_range_to";
                                                        $query31 = mysqli_query($db_conn, $sql31);
                                                        $count31 = mysqli_num_rows($query31);
                                                        if($count31 > 0) {
                                                            while($row31 = mysqli_fetch_array($query31)) {  
                                                                $ssscont2 = $row31["sss_contribution_contribution"];
                                                                if($ssscont2 == "") {
                                                                    $ssscont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($philhealth == '1') {
                                                        $sql4 = "SELECT * FROM hurtajadmin_philhealth_contribution WHERE $bimonthsalary1 >= philhealth_contribution_range_from AND $bimonthsalary1 <= philhealth_contribution_range_to";
                                                        $query4 = mysqli_query($db_conn, $sql4);
                                                        $count4 = mysqli_num_rows($query4);
                                                        if($count4 > 0) {
                                                            while($row4 = mysqli_fetch_array($query4)) {  
                                                                $philhealthcont1 = $row4["philhealth_contribution_contribution"];
                                                                if($philhealthcont1 == "") {
                                                                    $philhealthcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql41 = "SELECT * FROM hurtajadmin_philhealth_contribution WHERE $bimonthsalary2 >= philhealth_contribution_range_from AND $bimonthsalary2 <= philhealth_contribution_range_to";
                                                        $query41 = mysqli_query($db_conn, $sql41);
                                                        $count41 = mysqli_num_rows($query41);
                                                        if($count41 > 0) {
                                                            while($row41 = mysqli_fetch_array($query41)) {  
                                                                $philhealthcont2 = $row41["philhealth_contribution_contribution"];
                                                                if($philhealthcont2 == "") {
                                                                    $philhealthcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    if($pagibig == '1') {
                                                        $sql5 = "SELECT * FROM hurtajadmin_pagibig_contribution WHERE $bimonthsalary1 >= pagibig_contribution_range_from AND $bimonthsalary1 <= pagibig_contribution_range_to";
                                                        $query5 = mysqli_query($db_conn, $sql5);
                                                        $count5 = mysqli_num_rows($query5);
                                                        if($count5 > 0) {
                                                            while($row5 = mysqli_fetch_array($query5)) {  
                                                                $pagibigcont1 = $row5["pagibig_contribution_contribution"];
                                                                if($pagibigcont1 == "") {
                                                                    $pagibigcont1 = 0;
                                                                }
                                                            }
                                                        }
                                                        $sql51 = "SELECT * FROM hurtajadmin_pagibig_contribution WHERE $bimonthsalary2 >= pagibig_contribution_range_from AND $bimonthsalary2 <= pagibig_contribution_range_to";
                                                        $query51 = mysqli_query($db_conn, $sql51);
                                                        $count51 = mysqli_num_rows($query51);
                                                        if($count51 > 0) {
                                                            while($row51 = mysqli_fetch_array($query51)) {  
                                                                $pagibigcont2 = $row51["pagibig_contribution_contribution"];
                                                                if($pagibigcont2 == "") {
                                                                    $pagibigcont2 = 0;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    $sql6 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$firstcycledate1' AND cash_loan_advance_date < '$firstcycledate2' AND employee_id = '$empid' AND cash_loan_advance_status='1'";
                                                    $query6 = mysqli_query($db_conn, $sql6);
                                                    $count6 = mysqli_num_rows($query6);
                                                    if($count6 > 0) {
                                                        while($row6 = mysqli_fetch_array($query6)) {  
                                                            $cltype = $row6["cash_loan_advance_type"];
                                                            if($cltype == "1") {
                                                                $cashloanfirstcycle = $cashloanfirstcycle+$row6["cash_loan_advance_amount"];
                                                            } else if($cltype == "2") {
                                                                $cashadvancefirstcycle = $cashadvancefirstcycle+$row6["cash_loan_advance_amount"];
                                                            }
                                                            
                                                        }
                                                    }
                                                    $sql7 = "SELECT * FROM hurtajadmin_cash_loan_advance WHERE cash_loan_advance_date >= '$secondcycledate1' AND cash_loan_advance_date < '$secondcycledate2' AND employee_id = '$empid' AND cash_loan_advance_status='1'";
                                                    $query7 = mysqli_query($db_conn, $sql7);
                                                    $count7 = mysqli_num_rows($query7);
                                                    if($count7 > 0) {
                                                        while($row7 = mysqli_fetch_array($query7)) {  
                                                            $cltype = $row7["cash_loan_advance_type"];
                                                            if($cltype == "1") {
                                                                $cashloansecondcycle = $cashloansecondcycle+$row7["cash_loan_advance_amount"];
                                                            } else if($cltype == "2") {
                                                                $cashadvancesecondcycle = $cashadvancesecondcycle+$row7["cash_loan_advance_amount"];
                                                            }
                                                        }
                                                    }
                                                    $sql8 = "SELECT SUM(id) AS regularholidaytotal FROM hurtajadmin_holidays WHERE holidays_date >= '$firstcycledate1' AND holidays_date < '$firstcycledate2' AND holidays_type = '1' AND holidays_status = '1'";
                                                    $query8 = mysqli_query($db_conn, $sql8);
                                                    $count8 = mysqli_num_rows($query8);
                                                    if($count8 > 0) {
                                                        while($row8 = mysqli_fetch_array($query8)) {  
                                                            $holidayfirstcycle = $row8["regularholidaytotal"];
                                                        }
                                                    }
                                                    $sql9 = "SELECT SUM(id) AS regularholidaytotal FROM hurtajadmin_holidays WHERE holidays_date >= '$secondcycledate1' AND holidays_date < '$secondcycledate2' AND holidays_type = '1' AND holidays_status = '1'";
                                                    $query9 = mysqli_query($db_conn, $sql9);
                                                    $count9 = mysqli_num_rows($query9);
                                                    if($count9 > 0) {
                                                        while($row9 = mysqli_fetch_array($query9)) {  
                                                            $holidaysecondcycle = $row9["regularholidaytotal"];
                                                        }
                                                    }

                                                    
                                                    if(($bimonthsalary1 != 0 && $cycle == "1") || ($bimonthsalary2 != 0 && $cycle == "2")) {
                                                        $deductions1 = (float)$taxcont1+(float)$pagibigcont1+(float)$ssscont1+(float)$philhealthcont1;
                                                        $deductions2 = (float)$taxcont2+(float)$pagibigcont2+(float)$ssscont2+(float)$philhealthcont2;
                                                    } else {
                                                        $deductions1 = 0;
                                                        $deductions2 = 0;
                                                    }
                                                    $payroll_settings_paycheck_deducted_1 = 0;
                                                    $payroll_settings_paycheck_base_1 = 0;
                                                    $payroll_settings_paycheck_deducted_2 = 0;
                                                    $payroll_settings_paycheck_base_2= 0;
                                                    
                                                    if($perhour > 0) {
                                                        if($deductions1 > 0 && ($cashloanfirstcycle > 0 || $cashadvancefirstcycle > 0) && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1-$cashloanfirstcycle-$cashadvancefirstcycle;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 > 0 && $cashloanfirstcycle < 1 && $cashadvancefirstcycle < 1 && $hoursworked1 > 0) {
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$deductions1;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 < 1 && ($cashloanfirstcycle > 0 || $cashadvancefirstcycle > 0)  && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = ($perhour*$hoursworked1+$perhour*$xotcount1)-$cashloanfirstcycle-$cashadvancefirstcycle;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else if($deductions1 < 1 && $cashloanfirstcycle < 1 && $cashadvancefirstcycle < 1  && $hoursworked1 > 0) { 
                                                            $payroll_settings_paycheck_deducted_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                            $payroll_settings_paycheck_base_1 = $perhour*$hoursworked1+$perhour*$xotcount1;
                                                        } else {
                                                            $payroll_settings_paycheck_deducted_1 = "0";
                                                        }
                                                    } else {
                                                        $payroll_settings_paycheck_deducted_1 = "0";
                                                    }

                                                    if($perhour > 0) {
                                                        if($deductions2 > 0 && ($cashloansecondcycle > 0 || $cashadvancesecondcycle > 0) && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2-$cashloansecondcycle-$cashadvancesecondcycle;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 > 0 && $cashloansecondcycle < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$deductions2;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 < 1 && ($cashloansecondcycle > 0 || $cashadvancesecondcycle > 0) && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = ($perhour*$hoursworked2+$perhour*$xotcount2)-$cashadvancesecondcycle;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else if($deductions2 < 1 && $cashloansecondcycle < 1 && $cashadvancesecondcycle < 1 && $hoursworked2 > 0) { 
                                                            $payroll_settings_paycheck_deducted_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                            $payroll_settings_paycheck_base_2 = $perhour*$hoursworked2+$perhour*$xotcount2;
                                                        } else {
                                                            $payroll_settings_paycheck_deducted_2 = "0";
                                                        }
                                                    } else {
                                                        $payroll_settings_paycheck_deducted_2 = "0";
                                                    }

                                                    $bimonthdeductedsalaryfinal = "";
                                                    $bimonthbasesalaryfinal = "";
                                                    $cashloanfinal = "";
                                                    $cashadvancefinal = "";
                                                    $deductionfinal = "";
                                                    $daysofwork = "";
                                                    $hoursworked = "";
                                                    $othoursworked = "";
                                                    $otbasedhoursworked = "";
                                                    $regularholidayfinal = "";
                                                    $regularholidaybonushoursfinal = "";
                                                    $specialholidayfinal = "";
                                                    $specialholidaybonushoursfinal = "";
                                                    $otpayfinal = "";
                                                    $latecountfinal = "";

                                                    $taxcontfinal = "0";
                                                    $pagibigcontfinal = "0";
                                                    $ssscontfinal = "0";
                                                    $philhealthcontfinal = "0";

                                                    if($cycle == "1") {
                                                        $bimonthdeductedsalaryfinal = $payroll_settings_paycheck_deducted_1;
                                                        $bimonthbasesalaryfinal = $payroll_settings_paycheck_base_1;
                                                        $cashloanfinal = $cashloanfirstcycle;
                                                        $cashadvancefinal = $cashadvancefirstcycle;
                                                        $deductionfinal = $deductions1;
                                                        $datediff = strtotime($firstcycledate2) - strtotime($firstcycledate1);
                                                        $daysofwork = $datediff / (60 * 60 * 24) - 2;
                                                        $hoursworked = $hoursworked1;
                                                        $othoursworked = $xotcount1;
                                                        $otbasedhoursworked = $xotcountbase1;
                                                        $regularholidayfinal = $firstcycleholidayhoursworked1;
                                                        $regularholidaybonushoursfinal = $firstcycleholidaybonushours1;
                                                        $specialholidayfinal = $firstcycleholidayhoursworked2;
                                                        $specialholidaybonushoursfinal = $firstcycleholidaybonushours2;
                                                        $otpayfinal = $otpay1;
                                                        $latecountfinal = $latecount1;

                                                        if($bimonthdeductedsalaryfinal != 0) {
                                                            $taxcontfinal = $taxcont1;
                                                            $pagibigcontfinal = $pagibigcont1;
                                                            $ssscontfinal = $ssscont1;
                                                            $philhealthcontfinal = $philhealthcont1;
                                                        }
                                                    } else if($cycle == "2") {
                                                        $bimonthdeductedsalaryfinal = $payroll_settings_paycheck_deducted_2;
                                                        $bimonthbasesalaryfinal = $payroll_settings_paycheck_base_2;
                                                        $cashloanfinal = $cashloansecondcycle;
                                                        $cashadvancefinal = $cashadvancesecondcycle;
                                                        $deductionfinal = $deductions2;
                                                        $datediff = strtotime($secondcycledate2) - strtotime($secondcycledate1);
                                                        $daysofwork = $datediff / (60 * 60 * 24) - 2;
                                                        $hoursworked = $hoursworked2;
                                                        $othoursworked = $xotcount2;
                                                        $otbasedhoursworked = $xotcountbase2;
                                                        $regularholidayfinal = $secondcycleholidayhoursworked1;
                                                        $regularholidaybonushoursfinal = $secondcycleholidaybonushours1;
                                                        $specialholidayfinal = $secondcycleholidayhoursworked2;
                                                        $specialholidaybonushoursfinal = $secondcycleholidaybonushours2;
                                                        $otpayfinal = $otpay2;
                                                        $latecountfinal = $latecount2;

                                                        if($bimonthdeductedsalaryfinal != 0) {
                                                            $taxcontfinal = $taxcont2;
                                                            $pagibigcontfinal = $pagibigcont2;
                                                            $ssscontfinal = $ssscont2;
                                                            $philhealthcontfinal = $philhealthcont2;
                                                        }
                                                    }

                                                    echo '
                                                        <tr>
                                                            <td>'.$empid.'</td>
                                                            <td>'.$fname.' '.$mnameinitial.'. '.$lname.'</td>
                                                            <td>₱'.number_format((($hoursworked-$sundayhoursworked-$regularholidayfinal-$specialholidayfinal)*$perhour)+($sundayhoursworked*$perhour)+(($regularholidayfinal+$regularholidaybonushoursfinal)*$perhour)+(($specialholidayfinal+$specialholidaybonushoursfinal)*$perhour), 2, '.', ',').'</td>
                                                            <td>₱'.number_format($othoursworked*$perhour, 2, '.', ',').'</td>
                                                            <td><a href="javascript:void(0)" onclick="showModalViewDeduction(\''.$taxcontfinal.'\',\''.$pagibigcontfinal.'\',\''.$ssscontfinal.'\',\''.$philhealthcontfinal.'\');">View</a></td>
                                                        </tr>
                                                    ';
                                                }
                                            } else if($type == "2") {
                                                if($to == "1") {
                                                    $sql = "SELECT * FROM hurtajadmin_employee ORDER BY id DESC";
                                                } else if($to == "2") {
                                                    $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' ORDER BY id DESC";
                                                }
                                                        $query = mysqli_query($db_conn, $sql);
                                                        $count = 0;
                                                        while($row = mysqli_fetch_array($query)) {  
                                                            $count++; 
                                                            $recid = $row["id"];
                                                            $empid = $row["employee_id"];
                                                            $fname = $row["employee_fname"];
                                                            $mname = $row["employee_mname"];
                                                            $lname = $row["employee_lname"];
                                                            $gender = $row["employee_gender"];
                                                            $birthday = $row["employee_birthday"];
                                                            $address = $row["employee_address"];
                                                            $contact = $row["employee_phone"];
                                                            $datehired = $row["employee_date_hired"];
                                                            $datestart = $row["employee_date_start"];
                                                            $dateend = $row["employee_date_end"];
                                                            $stats = $row["employee_status"];
                                                            
                                                            $mnameinitial = substr($mname, 0, 1);

                                                            if($birthday == "0000-00-00 00:00:00" || $birthday == "1970-01-01 00:00:00" || $birthday == "1970-01-01 01:00:00") {
                                                                $birthday = "";
                                                            } else {
                                                                $birthday = date("m/d/Y", strtotime($birthday));
                                                            }
                                                            
                                                            if($datehired == "0000-00-00 00:00:00" || $datehired == "1970-01-01 00:00:00" || $datehired == "1970-01-01 01:00:00") {
                                                                $datehired = "";
                                                            } else {
                                                                $datehired = date("m/d/Y", strtotime($datehired));
                                                            }

                                                            if($datestart == "0000-00-00 00:00:00" || $datestart == "1970-01-01 00:00:00" || $datestart == "1970-01-01 01:00:00") {
                                                                $datestart = "";
                                                            } else {
                                                                $datestart = date("m/d/Y", strtotime($datestart));
                                                            }

                                                            if($dateend == "0000-00-00 00:00:00" || $dateend == "1970-01-01 00:00:00" || $dateend == "1970-01-01 01:00:00") {
                                                                $dateend = "";
                                                            } else {
                                                                $dateend = date("m/d/Y", strtotime($dateend));
                                                            }
                                                            
                                                            $gendertext = "";

                                                            if($gender == "1") {
                                                                $gendertext = "Male";
                                                            } else if($gender == "2") {
                                                                $gendertext = "Female";
                                                            }

                                                            $statstext = "";

                                                            if($stats == "1") {
                                                                $statstext = "Active";
                                                            } else if($stats == "2") {
                                                                $statstext = "Resigned";
                                                            } else if($stats == "3") {
                                                                $statstext = "Terminated";
                                                            } else if($stats == "4") {
                                                                $statstext = "AWOL";
                                                            }
                                                            
                                                            $mnameinitial = substr($mname, 0, 1);
                                                            $perhour = 0;
                                                            $hoursworked = 0;
                                                            $otcount = 0;
                                                            $utcount= 0;
                                                            $xotcount = 0;
                                                            $dailycount = 0;

                                                            $firstcycledate1 = "01/01/".$year;
                                                            $firstcycledate2 = "12/31/".$year;
                                                            $firstcycledate1 = date("Y-m-d H:i:s", strtotime($firstcycledate1));
                                                            $firstcycledate2 = date("Y-m-d H:i:s", strtotime($firstcycledate2));
                                                            $sql01 = "SELECT DISTINCT DATE(attendance_date_in_out), attendance_date_in_out, attendance_value FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND attendance_date_in_out >= '$firstcycledate1' AND attendance_date_in_out < '$firstcycledate2' AND attendance_value = '0' AND attendance_status = '1'";
                                                            $query01 = mysqli_query($db_conn, $sql01);
                                                            $count = mysqli_num_rows($query01);
                                                            while($row01 = mysqli_fetch_array($query01)) {
                                                                $datein = $row01["attendance_date_in_out"];
                                                                $sqlout = "SELECT id, attendance_date_in_out FROM hurtajadmin_attendance WHERE employee_id = '$empid' AND DATE(attendance_date_in_out) = DATE('$datein') AND attendance_value = '1' AND attendance_status = '1'";
                                                                $queryout = mysqli_query($db_conn, $sqlout);
                                                                $countout = mysqli_num_rows($queryout);
                                                                if($countout > 0) {
                                                                    while($rowout = mysqli_fetch_array($queryout)) {
                                                                        $attendanceidout = $rowout["id"];  
                                                                        $dateout = $rowout["attendance_date_in_out"];
                                                                    }
                                                                    $hourdiff = round((strtotime($dateout) - strtotime($datein))/3600, 1);

                                                            if($hourdiff > 8){ // this is for overtime 
                                                                $otcount = $hourdiff - 8;
                                                                $dailycount = $hourdiff - $otcount;
                                                            }else if($hourdiff < 8){ // this is for undertime
                                                                $utcount = $hourdiff;
                                                                $dailycount = $hourdiff;
                                                            }else{
                                                                $dailycount = $hourdiff;
                                                            }
                                                            $xotcount = $xotcount + $otcount;
                                                            $hoursworked = $hoursworked+$dailycount;
                                                            $sqlhol1 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '1' AND holidays_status = '1'";
                                                            $queryhol1 = mysqli_query($db_conn, $sqlhol1);
                                                            $counthol1 = mysqli_num_rows($queryhol1);
                                                            if($counthol1 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '1'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $holidaybonus = ($holratepercentage / 100) * $hourdiff;
                                                                $hoursworked = $hoursworked+$holidaybonus;
                                                            }
                                                            $sqlhol2 = "SELECT id FROM hurtajadmin_holidays WHERE DATE(holidays_date) = DATE('$datein') AND holidays_type = '2' AND holidays_status = '1'";
                                                            $queryhol2 = mysqli_query($db_conn, $sqlhol2);
                                                            $counthol2 = mysqli_num_rows($queryhol2);
                                                            if($counthol2 > 0) {
                                                                $sqlholrate = "SELECT * FROM hurtajadmin_holiday_rate WHERE id = '2'";
                                                                $queryholrate = mysqli_query($db_conn, $sqlholrate);
                                                                $holratepercentage = 0;
                                                                while($rowholrate = mysqli_fetch_array($queryholrate)) {
                                                                    $holratepercentage = $rowholrate["holiday_rate_percent"];  
                                                                }

                                                                $holidaybonus = ($holratepercentage / 100) * $hourdiff;
                                                                $hoursworked = $hoursworked+$holidaybonus;
                                                            }
                                                        } 
                                                    }


                                                    $sql1 = "SELECT * FROM hurtajadmin_employee_settings WHERE employee_id = '$empid'";
                                                    $query1 = mysqli_query($db_conn, $sql1);
                                                    $count1 = mysqli_num_rows($query1);
                                                    if($count1 > 0) {
                                                        while($row1 = mysqli_fetch_array($query1)) {  
                                                            $perhour = $row1["employee_settings_perhour"];
                                                        }
                                                    }
                                            
                                                    // 160 hours worked from attendance
                                                    // $bimonthsalary = $perhour*$hoursworked;
                                                    $otpay = $perhour * $xotcount; // this is base on per hour not ot per hour
                                                    $tertint = $perhour*$hoursworked+$otpay;
                                                 
                                                    echo '
                                                    <tr>
                                                    <td>'.$empid.'</td>
                                                    <td>'.$fname.' '.$mnameinitial.'. '.$lname.'</td>
                                                    <td>₱'.number_format($tertint-$otpay, 2, '.', ',').'</td>
                                                    <td>₱'.number_format($otpay, 2, '.', ',').'</td>
                                                    <td>₱'.number_format($tertint/12, 2, '.', ',').'</td>
                                                    </tr>
                                                    ';
                                                }
                                            }
                                                ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div><!-- /.col-->
                </div><!-- /.row -->
                <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "summary") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="my-request" class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=attendance">Import Attendance</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip">Generate Payslip</a></div>
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <h2>Payroll</h2>
                                    <hr>
                                    <form id="loginForm" onsubmit="return false;">
                                        <span id="summaryPayrollStatus"></span>
                                        <div class="form-group">
                                            <label class="control-label">Month</label>
                                            <select class="form-control" id="summaryPayrollMonth">
                                            <option value=""></option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Cycle</label>
                                            <select class="form-control" id="summaryPayrollCycle">
                                            <option value=""></option>
                                            <option value="1">26-10</option>
                                            <option value="2">11-25</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Year</label>
                                            <select class="form-control" id="summaryPayrollYear">
                                            <option value=""></option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                          </select>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="summaryPayrollBtn" style="width: 100%" onclick="generateSummaryPayroll();">Generate Summary</button>
                                    </form>
                                </div>
                                <div class="col-md-6">
                                    <h2>Contribution</h2>
                                    <hr>
                                    <form id="loginForm" onsubmit="return false;">
                                        <span id="summaryContributionStatus"></span>
                                        <div class="form-group">
                                            <label class="control-label">Month</label>
                                            <select class="form-control" id="summaryContributionMonth">
                                            <option value=""></option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Year</label>
                                            <select class="form-control" id="summaryContributionYear">
                                            <option value=""></option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                          </select>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="summaryContributionBtn" style="width: 100%" onclick="generateContributionPayroll();">Generate Summary</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "sss") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="my-request" class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=philhealth">Philhealth Contribution</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=pagibig">Pag-IBIG Contribution</a>  <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=tax">Withholding Tax</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip">Generate Payslip</a></div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Range Of Compensation</th>
                                    <th>Employee Contribution</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ssscontribution1 = "";
                                $ssscontribution2 = "";
                                $ssscontribution3 = "";
                                $ssscontribution4 = "";
                                $ssscontribution5 = "";
                                $ssscontribution6 = "";
                                $ssscontribution7 = "";
                                $ssscontribution8 = "";
                                $ssscontribution9 = "";
                                $ssscontribution10 = "";
                                $ssscontribution11 = "";
                                $ssscontribution12 = "";
                                $ssscontribution13 = "";
                                $ssscontribution14 = "";
                                $ssscontribution15 = "";
                                $ssscontribution16 = "";
                                $ssscontribution17 = "";
                                $ssscontribution18 = "";
                                $ssscontribution19 = "";
                                $ssscontribution20 = "";
                                $ssscontribution21 = "";
                                $ssscontribution22 = "";
                                $ssscontribution23 = "";
                                $ssscontribution24 = "";
                                $ssscontribution25 = "";
                                $ssscontribution26 = "";
                                $ssscontribution27 = "";
                                $ssscontribution28 = "";
                                $ssscontribution29 = "";
                                $ssscontribution30 = "";
                                $ssscontribution31 = "";
                                $sql = "SELECT * FROM hurtajadmin_sss_contribution";
                                $query = mysqli_query($db_conn, $sql);
                                $count = 0;
                                while($row = mysqli_fetch_array($query)) { 
                                    $count++;
                                    if($count == 1) {
                                        $ssscontribution1 = $row["sss_contribution_contribution"];
                                    } else if($count == 2) {
                                        $ssscontribution2 = $row["sss_contribution_contribution"];
                                    } else if($count == 3) {
                                        $ssscontribution3 = $row["sss_contribution_contribution"];
                                    } else if($count == 4) {
                                        $ssscontribution4 = $row["sss_contribution_contribution"];
                                    } else if($count == 5) {
                                        $ssscontribution5 = $row["sss_contribution_contribution"];
                                    } else if($count == 6) {
                                        $ssscontribution6 = $row["sss_contribution_contribution"];
                                    } else if($count == 7) {
                                        $ssscontribution7 = $row["sss_contribution_contribution"];
                                    } else if($count == 8) {
                                        $ssscontribution8 = $row["sss_contribution_contribution"];
                                    } else if($count == 9) {
                                        $ssscontribution9 = $row["sss_contribution_contribution"];
                                    } else if($count == 10) {
                                        $ssscontribution10 = $row["sss_contribution_contribution"];
                                    } else if($count == 11) {
                                        $ssscontribution11 = $row["sss_contribution_contribution"];
                                    } else if($count == 12) {
                                        $ssscontribution12 = $row["sss_contribution_contribution"];
                                    } else if($count == 13) {
                                        $ssscontribution13 = $row["sss_contribution_contribution"];
                                    } else if($count == 14) {
                                        $ssscontribution14 = $row["sss_contribution_contribution"];
                                    } else if($count == 15) {
                                        $ssscontribution15 = $row["sss_contribution_contribution"];
                                    } else if($count == 16) {
                                        $ssscontribution16 = $row["sss_contribution_contribution"];
                                    } else if($count == 17) {
                                        $ssscontribution17 = $row["sss_contribution_contribution"];
                                    } else if($count == 18) {
                                        $ssscontribution18 = $row["sss_contribution_contribution"];
                                    } else if($count == 19) {
                                        $ssscontribution19 = $row["sss_contribution_contribution"];
                                    } else if($count == 20) {
                                        $ssscontribution20 = $row["sss_contribution_contribution"];
                                    } else if($count == 21) {
                                        $ssscontribution21 = $row["sss_contribution_contribution"];
                                    } else if($count == 22) {
                                        $ssscontribution22 = $row["sss_contribution_contribution"];
                                    } else if($count == 23) {
                                        $ssscontribution23 = $row["sss_contribution_contribution"];
                                    } else if($count == 24) {
                                        $ssscontribution24 = $row["sss_contribution_contribution"];
                                    } else if($count == 25) {
                                        $ssscontribution25 = $row["sss_contribution_contribution"];
                                    } else if($count == 26) {
                                        $ssscontribution26 = $row["sss_contribution_contribution"];
                                    } else if($count == 27) {
                                        $ssscontribution27 = $row["sss_contribution_contribution"];
                                    } else if($count == 28) {
                                        $ssscontribution28 = $row["sss_contribution_contribution"];
                                    } else if($count == 29) {
                                        $ssscontribution29 = $row["sss_contribution_contribution"];
                                    } else if($count == 30) {
                                        $ssscontribution30 = $row["sss_contribution_contribution"];
                                    } else if($count == 31) {
                                        $ssscontribution31 = $row["sss_contribution_contribution"];
                                    }

                                }
                                ?>
                                <tr>
                                    <td>1,000.00 - 1,249.99</td>
                                    <td><?php echo $ssscontribution1 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(1, '1,000.00 - 1,249.99', '<?php if($ssscontribution1 != "-") echo $ssscontribution1; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1,250.00 - 1,749.99</td>
                                    <td><?php echo $ssscontribution2 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(2, '1,250.00 - 1,749.99', '<?php if($ssscontribution2 != "-") echo $ssscontribution2; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1,750.00 - 2,249.99</td>
                                    <td><?php echo $ssscontribution3 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(3, '1,750.00 - 2,249.99', '<?php if($ssscontribution3 != "-") echo $ssscontribution3; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2,250.00 - 2,749.99</td>
                                    <td><?php echo $ssscontribution4 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(4, '2,250.00 - 2,749.99', '<?php if($ssscontribution4 != "-") echo $ssscontribution4; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2,750.00 - 3,249.99</td>
                                    <td><?php echo $ssscontribution5 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(5, '2,750.00 - 3,249.99', '<?php if($ssscontribution5 != "-") echo $ssscontribution5; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3,250.00 - 3,749.99</td>
                                    <td><?php echo $ssscontribution6 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(6, '3,250.00 - 3,749.99', '<?php if($ssscontribution6 != "-") echo $ssscontribution6; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3,750.00 - 4,249.99</td>
                                    <td><?php echo $ssscontribution7 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(7, '3,750.00 - 4,249.99', '<?php if($ssscontribution7 != "-") echo $ssscontribution7; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4,250.00 - 4,749.99</td>
                                    <td><?php echo $ssscontribution8 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(8, '4,250.00 - 4,749.99', '<?php if($ssscontribution8 != "-") echo $ssscontribution8; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4,750.00 - 5,249.99</td>
                                    <td><?php echo $ssscontribution9 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(9, '4,750.00 - 5,249.99', '<?php if($ssscontribution9 != "-") echo $ssscontribution9; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5,250.00 - 5,749.99</td>
                                    <td><?php echo $ssscontribution10 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(10, '5,250.00 - 5,749.99', '<?php if($ssscontribution10 != "-") echo $ssscontribution10; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5,750.00 - 6,249.99</td>
                                    <td><?php echo $ssscontribution11 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(11, '5,750.00 - 6,249.99', '<?php if($ssscontribution11 != "-") echo $ssscontribution11; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6,250.00 - 6,749.99</td>
                                    <td><?php echo $ssscontribution12 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(12, '6,250.00 - 6,749.99', '<?php if($ssscontribution12 != "-") echo $ssscontribution12; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6,750.00 - 7,249.99</td>
                                    <td><?php echo $ssscontribution13 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(13, '6,750.00 - 7,249.99', '<?php if($ssscontribution13 != "-") echo $ssscontribution13; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7,250.00 - 7,749.99</td>
                                    <td><?php echo $ssscontribution14 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(14, '7,250.00 - 7,749.99', '<?php if($ssscontribution14 != "-") echo $ssscontribution14; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7,750.00 - 8,249.99</td>
                                    <td><?php echo $ssscontribution15 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(15, '7,750.00 - 8,249.99', '<?php if($ssscontribution15 != "-") echo $ssscontribution15; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8,250.00 - 8,749.99</td>
                                    <td><?php echo $ssscontribution16 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(16, '8,250.00 - 8,749.99', '<?php if($ssscontribution16 != "-") echo $ssscontribution16; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8,750.00 - 9,249.99</td>
                                    <td><?php echo $ssscontribution17 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(17, '8,750.00 - 9,249.99', '<?php if($ssscontribution17 != "-") echo $ssscontribution17; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9,250.00 - 9,749.99</td>
                                    <td><?php echo $ssscontribution18 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(18, '9,250.00 - 9,749.99', '<?php if($ssscontribution18 != "-") echo $ssscontribution18; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9,750.00 - 10,249.99</td>
                                    <td><?php echo $ssscontribution19 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(19, '9,750.00 - 10,249.99', '<?php if($ssscontribution19 != "-") echo $ssscontribution19; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10,250.00 - 10,749.99</td>
                                    <td><?php echo $ssscontribution20 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(20, '10,250.00 - 10,749.99', '<?php if($ssscontribution20 != "-") echo $ssscontribution20; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10,750.00 - 11,249.99</td>
                                    <td><?php echo $ssscontribution21 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(21, '10,750.00 - 11,249.99', '<?php if($ssscontribution21 != "-") echo $ssscontribution21; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11,250.00 - 11,749.99</td>
                                    <td><?php echo $ssscontribution22 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(22, '11,250.00 - 11,749.99', '<?php if($ssscontribution22 != "-") echo $ssscontribution22; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11,750.00 - 12,249.99</td>
                                    <td><?php echo $ssscontribution23 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(23, '11,750.00 - 12,249.99', '<?php if($ssscontribution23 != "-") echo $ssscontribution23; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>12,250.00 - 12,749.99</td>
                                    <td><?php echo $ssscontribution24 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(24, '12,250.00 - 12,749.99', '<?php if($ssscontribution24 != "-") echo $ssscontribution24; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>12,750.00 - 13,249.99</td>
                                    <td><?php echo $ssscontribution25 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(25, '12,750.00 - 13,249.99', '<?php if($ssscontribution25 != "-") echo $ssscontribution25; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>13,250.00 - 13,749.99</td>
                                    <td><?php echo $ssscontribution26 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(26, '13,250.00 - 13,749.99', '<?php if($ssscontribution26 != "-") echo $ssscontribution26; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>13,750.00 - 14,249.99</td>
                                    <td><?php echo $ssscontribution27 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(27, '13,750.00 - 14,249.99', '<?php if($ssscontribution27 != "-") echo $ssscontribution27; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>14,250.00 - 14,749.99</td>
                                    <td><?php echo $ssscontribution28 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(28, '14,250.00 - 14,749.99', '<?php if($ssscontribution28 != "-") echo $ssscontribution28; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>14,750.00 - 15,294.99</td>
                                    <td><?php echo $ssscontribution29 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(29, '14,750.00 - 15,294.99', '<?php if($ssscontribution29 != "-") echo $ssscontribution29; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>15,250.00 - 15,794.99</td>
                                    <td><?php echo $ssscontribution30 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(30, '15,250.00 - 15,794.99', '<?php if($ssscontribution30 != "-") echo $ssscontribution30; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>15,750.00 - 1,000,000.00</td>
                                    <td><?php echo $ssscontribution31 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditSSSContributionDialog(31, '15,750.00 - 1,000,000.00', '<?php if($ssscontribution31 != "-") echo $ssscontribution31; ?>')">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "philhealth") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="my-request" class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=sss">SSS Contribution</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=pagibig">Pag-IBIG Contribution</a>  <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=tax">Withholding Tax</a>  <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip">Generate Payslip</a></div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Range Of Compensation</th>
                                    <th>Employee Contribution</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $philhealthcontribution1 = "";
                                $philhealthcontribution2 = "";
                                $philhealthcontribution3 = "";
                                $philhealthcontribution4 = "";
                                $philhealthcontribution5 = "";
                                $philhealthcontribution6 = "";
                                $philhealthcontribution7 = "";
                                $philhealthcontribution8 = "";
                                $philhealthcontribution9 = "";
                                $philhealthcontribution10 = "";
                                $philhealthcontribution11 = "";
                                $philhealthcontribution12 = "";
                                $philhealthcontribution13 = "";
                                $philhealthcontribution14 = "";
                                $philhealthcontribution15 = "";
                                $philhealthcontribution16 = "";
                                $philhealthcontribution17 = "";
                                $philhealthcontribution18 = "";
                                $philhealthcontribution19 = "";
                                $philhealthcontribution20 = "";
                                $philhealthcontribution21 = "";
                                $philhealthcontribution22 = "";
                                $philhealthcontribution23 = "";
                                $philhealthcontribution24 = "";
                                $philhealthcontribution25 = "";
                                $philhealthcontribution26 = "";
                                $philhealthcontribution27 = "";
                                $philhealthcontribution28 = "";
                                $philhealthcontribution29 = "";
                                $philhealthcontribution30 = "";
                                $philhealthcontribution31 = "";
                                $philhealthcontribution32 = "";
                                $philhealthcontribution33 = "";
                                $sql = "SELECT * FROM hurtajadmin_philhealth_contribution";
                                $query = mysqli_query($db_conn, $sql);
                                $count = 0;
                                while($row = mysqli_fetch_array($query)) { 
                                    $count++;
                                    if($count == 1) {
                                        $philhealthcontribution1 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 2) {
                                        $philhealthcontribution2 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 3) {
                                        $philhealthcontribution3 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 4) {
                                        $philhealthcontribution4 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 5) {
                                        $philhealthcontribution5 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 6) {
                                        $philhealthcontribution6 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 7) {
                                        $philhealthcontribution7 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 8) {
                                        $philhealthcontribution8 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 9) {
                                        $philhealthcontribution9 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 10) {
                                        $philhealthcontribution10 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 11) {
                                        $philhealthcontribution11 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 12) {
                                        $philhealthcontribution12 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 13) {
                                        $philhealthcontribution13 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 14) {
                                        $philhealthcontribution14 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 15) {
                                        $philhealthcontribution15 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 16) {
                                        $philhealthcontribution16 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 17) {
                                        $philhealthcontribution17 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 18) {
                                        $philhealthcontribution18 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 19) {
                                        $philhealthcontribution19 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 20) {
                                        $philhealthcontribution20 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 21) {
                                        $philhealthcontribution21 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 22) {
                                        $philhealthcontribution22 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 23) {
                                        $philhealthcontribution23 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 24) {
                                        $philhealthcontribution24 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 25) {
                                        $philhealthcontribution25 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 26) {
                                        $philhealthcontribution26 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 27) {
                                        $philhealthcontribution27 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 28) {
                                        $philhealthcontribution28 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 29) {
                                        $philhealthcontribution29 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 30) {
                                        $philhealthcontribution30 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 31) {
                                        $philhealthcontribution31 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 32) {
                                        $philhealthcontribution32 = $row["philhealth_contribution_contribution"];
                                    } else if($count == 33) {
                                        $philhealthcontribution33 = $row["philhealth_contribution_contribution"];
                                    }

                                }
                                ?>
                                <tr>
                                    <td>0.00 - 8,999.99</td>
                                    <td><?php echo $philhealthcontribution1 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(1, '0.00 - 8,999.99', '<?php if($philhealthcontribution1 != "-") echo $philhealthcontribution1; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9,000.00 - 9,999.99</td>
                                    <td><?php echo $philhealthcontribution2 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(2, '9,000.00 - 9,999.99', '<?php if($philhealthcontribution2 != "-") echo $philhealthcontribution2; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10,000.00 - 10,999.99</td>
                                    <td><?php echo $philhealthcontribution3 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(3, '10,000.00 - 10,999.99', '<?php if($philhealthcontribution3 != "-") echo $philhealthcontribution3; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11,000.00 - 11,999.99</td>
                                    <td><?php echo $philhealthcontribution4 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(4, '11,000.00 - 11,999.99', '<?php if($philhealthcontribution4 != "-") echo $philhealthcontribution4; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>12,000.00 - 12,999.99</td>
                                    <td><?php echo $philhealthcontribution5 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(5, '12,000.00 - 12,999.99', '<?php if($philhealthcontribution5 != "-") echo $philhealthcontribution5; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>13,000.00 - 13,999.99</td>
                                    <td><?php echo $philhealthcontribution6 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(6, '13,000.00 - 13,999.99', '<?php if($philhealthcontribution6 != "-") echo $philhealthcontribution6; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>14,000.00 - 14,999.99</td>
                                    <td><?php echo $philhealthcontribution7 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(7, '14,000.00 - 14,999.99', '<?php if($philhealthcontribution7 != "-") echo $philhealthcontribution7; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>15,000.00 - 15,999.99</td>
                                    <td><?php echo $philhealthcontribution8 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(8, '15,000.00 - 15,999.99', '<?php if($philhealthcontribution8 != "-") echo $philhealthcontribution8; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>16,000.00 - 16,999.99</td>
                                    <td><?php echo $philhealthcontribution9 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(9, '16,000.00 - 16,999.99', '<?php if($philhealthcontribution9 != "-") echo $philhealthcontribution9; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>17,000.00 - 17,999.99</td>
                                    <td><?php echo $philhealthcontribution10 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(10, '17,000.00 - 17,999.99', '<?php if($philhealthcontribution10 != "-") echo $philhealthcontribution10; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>18,000.00 - 18,999.99</td>
                                    <td><?php echo $philhealthcontribution11 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(11, '18,000.00 - 18,999.99', '<?php if($philhealthcontribution11 != "-") echo $philhealthcontribution11; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>19,000.00 - 19,999.99</td>
                                    <td><?php echo $philhealthcontribution12 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(12, '19,000.00 - 19,999.99', '<?php if($philhealthcontribution12 != "-") echo $philhealthcontribution12; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>20,000.00 - 20,999.99</td>
                                    <td><?php echo $philhealthcontribution13 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(13, '20,000.00 - 20,999.99', '<?php if($philhealthcontribution13 != "-") echo $philhealthcontribution13; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>21,000.00 - 21,999.99</td>
                                    <td><?php echo $philhealthcontribution14 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(14, '21,000.00 - 21,999.99', '<?php if($philhealthcontribution14 != "-") echo $philhealthcontribution14; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>22,000.00 - 22,999.99</td>
                                    <td><?php echo $philhealthcontribution15 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(15, '22,000.00 - 22,999.99', '<?php if($philhealthcontribution15 != "-") echo $philhealthcontribution15; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>23,000.00 - 23,999.99</td>
                                    <td><?php echo $philhealthcontribution16 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(16, '23,000.00 - 23,999.99', '<?php if($philhealthcontribution16 != "-") echo $philhealthcontribution16; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>24,000.00 - 24,999.99</td>
                                    <td><?php echo $philhealthcontribution17 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(17, '24,000.00 - 24,999.99', '<?php if($philhealthcontribution17 != "-") echo $philhealthcontribution17; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>25,000.00 - 25,999.99</td>
                                    <td><?php echo $philhealthcontribution18 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(18, '25,000.00 - 25,999.99', '<?php if($philhealthcontribution18 != "-") echo $philhealthcontribution18; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>26,000.00 - 26,999.99</td>
                                    <td><?php echo $philhealthcontribution19 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(19, '26,000.00 - 26,999.99', '<?php if($philhealthcontribution19 != "-") echo $philhealthcontribution19; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>27,000.00 - 27,999.99</td>
                                    <td><?php echo $philhealthcontribution20 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(20, '27,000.00 - 27,999.99', '<?php if($philhealthcontribution20 != "-") echo $philhealthcontribution20; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>28,000.00 - 28,999.99</td>
                                    <td><?php echo $philhealthcontribution21 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(21, '28,000.00 - 28,999.99', '<?php if($philhealthcontribution21 != "-") echo $philhealthcontribution21; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>29,000.00 - 29,999.99</td>
                                    <td><?php echo $philhealthcontribution22 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(22, '29,000.00 - 29,999.99', '<?php if($philhealthcontribution22 != "-") echo $philhealthcontribution22; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>30,000.00 - 30,999.99</td>
                                    <td><?php echo $philhealthcontribution23 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(23, '30,000.00 - 30,999.99', '<?php if($philhealthcontribution23 != "-") echo $philhealthcontribution23; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>31,000.00 - 31,999.99</td>
                                    <td><?php echo $philhealthcontribution24 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(24, '31,000.00 - 31,999.99', '<?php if($philhealthcontribution24 != "-") echo $philhealthcontribution24; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>32,000.00 - 32,999.99</td>
                                    <td><?php echo $philhealthcontribution25 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(25, '32,000.00 - 32,999.99', '<?php if($philhealthcontribution25 != "-") echo $philhealthcontribution25; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>33,000.00 - 33,999.99</td>
                                    <td><?php echo $philhealthcontribution26 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(26, '33,000.00 - 33,999.99', '<?php if($philhealthcontribution26 != "-") echo $philhealthcontribution26; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>34,000.00 - 34,999.99</td>
                                    <td><?php echo $philhealthcontribution27 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(27, '34,000.00 - 34,999.99', '<?php if($philhealthcontribution27 != "-") echo $philhealthcontribution27; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>35,000.00 - 35,999.99</td>
                                    <td><?php echo $philhealthcontribution28 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(28, '35,000.00 - 35,999.99', '<?php if($philhealthcontribution28 != "-") echo $philhealthcontribution28; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>36,000.00 - 36,999.99</td>
                                    <td><?php echo $philhealthcontribution29 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(29, '36,000.00 - 36,999.99', '<?php if($philhealthcontribution29 != "-") echo $philhealthcontribution29; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>37,000.00 - 37,999.99</td>
                                    <td><?php echo $philhealthcontribution30 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(30, '37,000.00 - 37,999.99', '<?php if($philhealthcontribution30 != "-") echo $philhealthcontribution30; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>38,000.00 - 38,999.99</td>
                                    <td><?php echo $philhealthcontribution31 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(31, '38,000.00 - 38,999.99', '<?php if($philhealthcontribution31 != "-") echo $philhealthcontribution31; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>39,000.00 - 39,999.99</td>
                                    <td><?php echo $philhealthcontribution32 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(32, '39,000.00 - 39,999.99', '<?php if($philhealthcontribution32 != "-") echo $philhealthcontribution32; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>40,000.00 - 1,000,000.00</td>
                                    <td><?php echo $philhealthcontribution33 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPhilHealthContributionDialog(33, '40,000.00 - 1,000,000.00', '<?php if($philhealthcontribution33 != "-") echo $philhealthcontribution33; ?>')">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "pagibig") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="my-request" class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=sss">SSS Contribution</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=philhealth">Philhealth Contribution</a>  <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=tax">Withholding Tax</a>  <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip">Generate Payslip</a></div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Range Of Compensation</th>
                                    <th>Employee Contribution</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pagibigcontribution1 = "";
                                $pagibigcontribution2 = "";
                                $sql = "SELECT * FROM hurtajadmin_pagibig_contribution";
                                $query = mysqli_query($db_conn, $sql);
                                $count = 0;
                                while($row = mysqli_fetch_array($query)) { 
                                    $count++;
                                    if($count == 1) {
                                        $pagibigcontribution1 = $row["pagibig_contribution_contribution"];
                                    } else if($count == 2) {
                                        $pagibigcontribution2 = $row["pagibig_contribution_contribution"];
                                    }
                                }
                                ?>
                                <tr>
                                    <td>0.00 - 1,500.00</td>
                                    <td><?php echo $pagibigcontribution1 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPagibigContributionDialog(1, '0.00 - 1,500.00', '<?php if($pagibigcontribution1 != "-") echo $pagibigcontribution1; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1,501.00 - 1,000,000.00</td>
                                    <td><?php echo $pagibigcontribution2 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditPagibigContributionDialog(2, '1,501.00 - 1,000,000.00', '<?php if($pagibigcontribution2 != "-") echo $pagibigcontribution2; ?>')">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "tax") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="my-request" class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=philhealth">Philhealth Contribution</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=pagibig">Pag-IBIG Contribution</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=sss">SSS Contribution</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip">Generate Payslip</a></div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Range Of Compensation</th>
                                    <th>Employee Contribution</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $taxcontribution1 = "";
                                $taxcontribution2 = "";
                                $taxcontribution3 = "";
                                $taxcontribution4 = "";
                                $taxcontribution5 = "";
                                $sql = "SELECT * FROM hurtajadmin_tax_contribution";
                                $query = mysqli_query($db_conn, $sql);
                                $count = 0;
                                while($row = mysqli_fetch_array($query)) { 
                                    $count++;
                                    if($count == 1) {
                                        $taxcontribution1 = $row["tax_contribution_contribution"];
                                    } else if($count == 2) {
                                        $taxcontribution2 = $row["tax_contribution_contribution"];
                                    } else if($count == 3) {
                                        $taxcontribution3 = $row["tax_contribution_contribution"];
                                    } else if($count == 4) {
                                        $taxcontribution4 = $row["tax_contribution_contribution"];
                                    } else if($count == 5) {
                                        $taxcontribution5 = $row["tax_contribution_contribution"];
                                    }
                                }
                                ?>
                                <tr>
                                    <td>0.00 - 10,417.00</td>
                                    <td><?php echo $taxcontribution1 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditTaxContributionDialog(1, '0.00 - 1,500.00', '<?php if($taxcontribution1 != "-") echo $taxcontribution1; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10,418.00 - 16,667.00</td>
                                    <td><?php echo $taxcontribution2 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditTaxContributionDialog(2, '1,501.00 - 1,000,000.00', '<?php if($taxcontribution2 != "-") echo $taxcontribution2; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>16,668.00 - 33,333.00</td>
                                    <td><?php echo $taxcontribution3 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditTaxContributionDialog(3, '16,668.00 - 33,333.00', '<?php if($taxcontribution3 != "-") echo $taxcontribution3; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>33,334.00 - 83,333.00</td>
                                    <td><?php echo $taxcontribution4 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditTaxContributionDialog(4, '33,334.00 - 83,333.00', '<?php if($taxcontribution4 != "-") echo $taxcontribution4; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>83,334.00 - 333,333.00</td>
                                    <td><?php echo $taxcontribution5 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditTaxContributionDialog(5, '83,334.00 - 333,333.00', '<?php if($taxcontribution5 != "-") echo $taxcontribution5; ?>')">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "holidays") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=holidayrate">Holiday Rate</a> <a type="button" class="btn btn-primary" href="javascript:void(0)" onclick="openAddHolidayDialog()">Add New Holiday</a></div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Type</th>
                                                    <th>Date</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_holidays WHERE holidays_status = '1' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $name = $row["holidays_name"];
                                                    $type = $row["holidays_type"];
                                                    $date = $row["holidays_date"];
                                                    $dateadded = $row["holidays_date_added"];
                                                    $stats = $row["holidays_status"];
                                                    $newDate = "";
                                                    if($type == "1") {
                                                        $newDate = date("F d", strtotime($date));
                                                        $editdate = date("m/d/Y", strtotime($date));
                                                    } else if($type == "2") {
                                                        $newDate = date("F d, Y", strtotime($date));
                                                        $editdate = date("m/d/Y", strtotime($date));
                                                    }
                                                    $newDateAdded = date("F d, Y", strtotime($dateadded));
                                                    $typetext = "";
                                                    if($type == "1") {
                                                        $typetext = "Regular Holiday";
                                                    } else if($type == "2") {
                                                        $typetext = "Special Non-working Holiday";
                                                    }
                                                
                                                    echo '
                                                    <tr>
                                                    <td>'.$count.'</td>
                                                    <td>'.$name.'</td>     
                                                    <td>'.$typetext.'</td>
                                                    <td>'.$newDate.'</td>
                                                    <td>'.$newDateAdded.'</td> 
                                                    <td><a href="javascript:void(0)" onclick="openEditHolidayDialog(\''.$recid.'\',\''.$name.'\',\''.$type.'\',\''.$editdate.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openDeleteHolidayDialog('.$recid.')">Delete</a></td>
                                                    </tr>
                                                    ';   
                                                  }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    <br>
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["action"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["action"]) == "holidayrate") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div id="my-request" class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&action=holidays">Holidays</a></div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>Type</th>
                                    <th>Rate Percentage</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $holidayrate1 = "";
                                $holidayrate2 = "";
                                $sql = "SELECT * FROM hurtajadmin_holiday_rate";
                                $query = mysqli_query($db_conn, $sql);
                                $count = 0;
                                while($row = mysqli_fetch_array($query)) { 
                                    $count++;
                                    if($count == 1) {
                                        $holidayrate1 = $row["holiday_rate_percent"];
                                    } else if($count == 2) {
                                        $holidayrate2 = $row["holiday_rate_percent"];
                                    }

                                }
                                ?>
                                <tr>
                                    <td>Regular Holiday</td>
                                    <td><?php echo $holidayrate1 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditHolidayRateDialog('1', 'Regular Holiday', '<?php echo $holidayrate1; ?>')">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Special Non-Working Holiday</td>
                                    <td><?php echo $holidayrate2 ?></td>
                                    <td>
                                        <a href="javascript:void(0)" onclick="openEditHolidayRateDialog('2', 'Special Non-Working Holiday', '<?php echo $holidayrate2; ?>')">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
            <?php } else if (isset($_GET["leave"]) && isset($_GET["action"]) && !isset($_GET["updatehistoryid"]) && trim($_GET["leave"]) == "focus" && trim($_GET["action"]) == "request") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <div id="my-request" class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&leave=focus&action=history">View History</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&leave=focus&action=form">Generate Leave Form</a></div>
                            <div class="panel-body">
                                <div class="col-md-6 col-md-offset-3">
                                    <form id="loginForm" onsubmit="return false;">
                                        <span id="addLeaveStatus"></span>
                                        <div class="form-group">
                                                <label class="control-label">Employee ID</label>
                                                <input type="text" class="form-control" name="date" id="leave-request-employee-id"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Type</label>
                                            <select class="form-control" id="leave-request-type">
                                                <option value=""></option>
                                                <option value="1">Sick</option>
                                                <option value="2">Vacation</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Leave Start</label>
                                            <div class="date">
                                                <div class="input-group date" id="datePicker19">
                                                    <input type="text" class="form-control" name="date" id="leave-request-start" autocomplete="off"/>
                                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Leave End</label>
                                            <div class="date">
                                                <div class="input-group date" id="datePicker20">
                                                    <input type="text" class="form-control" name="date" id="leave-request-end" autocomplete="off"/>
                                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Date Filed</label>
                                            <div class="date">
                                                <div class="input-group date" id="datePicker21">
                                                    <input type="text" class="form-control" name="date" id="leave-request-date" autocomplete="off"/>
                                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label">Reason</label>
                                                <textarea class="form-control" rows="5" id="leave-request-reason"></textarea>
                                        </div>
                                        
                                        <button type="button" class="btn btn-primary" id="encodeLeaveBtn" style="width: 100%" onclick="addLeaveRecord()">Request</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col-->
                </div><!-- /.row -->
<!--leave view -->
                <?php } else if (isset($_GET["leave"]) && isset($_GET["action"]) && !isset($_GET["updatehistoryid"]) && trim($_GET["leave"]) == "focus" && trim($_GET["action"]) == "history") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="my-request" class="panel panel-default">
                                <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&leave=focus&action=request">Request Employee Leave</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&leave=focus&action=form">Generate Leave Form</a></div>
                                <div class="panel-body">
                                    <div class="form-group">
                                            <select class="form-control" id="select-filter-leave">
                                                <option value="">Select Filter</option>
                                                <option value="nameleave">Filter by Name</option>
                                                <option value="dateleave">Filter by Date</option>
                                            </select>
                                        </div>
                                    <div class="form-group" id="text-search-leave" hidden="true">  
                                      <input type="text" name="record-search-text" value="" id="search-leave" placeholder="Search Employee ID or Name..." class="form-control" autofocus />  
                                    </div>
                                    <div class="form-group" id="select-filter-date-leave" hidden="true">
                                                <div class="input-group date" id="datePicker22">
                                                <input type="text" class="form-control" name="date" id="select-date-leave"  autocomplete="off"/>
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                    </div>
                                    <hr>
                                    <div id="leave-search-result">
                                    <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Date Filed</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_leave WHERE leave_status = '1' OR leave_status = '2' OR leave_status = '3' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $empid = $row["employee_id"];
                                                    $ltype = $row["leave_type"];
                                                    $ldate = $row["leave_date"];
                                                    $lstart = $row["leave_start"];
                                                    $lend = $row["leave_end"];
                                                    $lreason = $row["leave_reason"];
                                                    $lremarks = $row["leave_remarks"];
                                                    $lstatus = $row["leave_status"];
                                                    $editldate = date("F d, Y", strtotime($ldate));
                                                    $editlstart = date("m/d/Y", strtotime($lstart));
                                                    $editlend = date("m/d/Y", strtotime($lend));
                                                    
                                                    $sql_l = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' ORDER BY id DESC";
                                                    $query_l = mysqli_query($db_conn, $sql_l);
                                                    while($rowl = mysqli_fetch_array($query_l)) {
                                                    $lfname = $rowl["employee_fname"];
                                                    $lmname = $rowl["employee_mname"];
                                                    $llname = $rowl["employee_lname"];
                                                    }
                                                    $typetext = "";
                                                    if($ltype == "1") {
                                                        $typetext = "Sick";
                                                    } else if($ltype == "2") {
                                                        $typetext = "Vacation";
                                                    }
                                                    $statstext = "";
                                                    $leave_link = "";
                                                    if($lstatus == "1") {
                                                        $statstext = "Pending";
                                                        $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveApproveDialog('.$recid.')">Approve</a> | <a href="javascript:void(0)"  onclick="openLeaveDeclineDialog('.$recid.')">Decline</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
                                                    } else if($lstatus == "2") {
                                                        $statstext = "Approved";
                                                        $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
                                                    } else if($lstatus == "3") {
                                                        $statstext = "Declined";
                                                        $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a> | <a href="account.php?id='.$log_id.'&leave=focus&action=history&updatehistoryid='.$recid.'">Update History</a> | <a href="javascript:void(0)" onclick="openLeaveDeleteDialog('.$recid.')">Delete</a>';
                                                    }
                                                    $lmnameinitial = substr($lmname, 0, 1);
                                                        
                                                    echo '
                                                    <tr>
                                                    <td>'.$empid.'</td>
                                                    <td>'.$lfname.' '.$lmnameinitial.'. '.$llname.'</td>
                                                    <td>'.$editldate.'</td>       
                                                    <td>'.$statstext.'</td>   
                                                    <td>'.$leave_link.'</td>
                                                    </tr>
                                                    ';   
                                                  }
                                                ?>
                                            </tbody>
                                        </table>
                                       </div>
                                </div>
                            </div>
                        </div><!-- /.col-->
                    </div><!-- /.row -->
                <?php } else if (isset($_GET["leave"]) && isset($_GET["action"]) && !isset($_GET["updatehistoryid"]) && trim($_GET["leave"]) == "focus" && trim($_GET["action"]) == "form") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <div id="my-request" class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&leave=focus&action=history">View History</a> <a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&leave=focus&action=request">Request Employee Leave</a></div>
                            <div class="panel-body">
                                <div class="col-md-6 col-md-offset-3">
                                    <form id="loginForm" onsubmit="return false;">
                                        <span id="leaveFormStatus"></span>
                                        <div class="form-group">
                                                <label class="control-label">Form Count</label>
                                                <input type="number" class="form-control" name="date" id="leave-form-count"/>
                                        </div>
                                        <button type="button" class="btn btn-primary" id="encodeLeaveBtn" style="width: 100%" onclick="openLeaveForm()">Generate/Print</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.col-->
                </div><!-- /.row -->
            <?php } else if (isset($_GET["leave"]) && isset($_GET["action"]) && isset($_GET["updatehistoryid"]) && trim($_GET["leave"]) == "focus" && trim($_GET["action"]) == "history") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                    <div class="col-lg-12">
                        <div id="my-request" class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-default" href="#" onclick="goBack()">Back</a></div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Date Updated</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                    <th>Record Mark</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $leaveid = $_GET["updatehistoryid"];
                                                $sql0 = "SELECT * FROM hurtajadmin_leave WHERE id = '$leaveid' LIMIT 1";
                                                $query0 = mysqli_query($db_conn, $sql0);
                                                while($row0 = mysqli_fetch_array($query0)) { 
                                                    $empid = $row0["employee_id"]; 
                                                }
                                                $sql = "SELECT * FROM hurtajadmin_leave_update_history WHERE leave_id = '$leaveid' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $ltype = $row["leave_update_history_type"];
                                                    $ldate = $row["leave_update_history_date"];
                                                    $lstart = $row["leave_update_history_start"];
                                                    $lend = $row["leave_update_history_end"];
                                                    $lreason = $row["leave_update_history_reason"];
                                                    $lremarks = $row["leave_update_history_remarks"];
                                                    $lstatus = $row["leave_update_history_status"];
                                                    $editldate = date("F d, Y | h:i:s A", strtotime($ldate));
                                                    $editlstart = date("m/d/Y", strtotime($lstart));
                                                    $editlend = date("m/d/Y", strtotime($lend));
                                                    
                                                    $sql_l = "SELECT * FROM hurtajadmin_employee WHERE employee_id = '$empid' ORDER BY id DESC";
                                                    $query_l = mysqli_query($db_conn, $sql_l);
                                                    while($rowl = mysqli_fetch_array($query_l)) {
                                                    $lfname = $rowl["employee_fname"];
                                                    $lmname = $rowl["employee_mname"];
                                                    $llname = $rowl["employee_lname"];
                                                    }
                                                    $typetext = "";
                                                    if($ltype == "1") {
                                                        $typetext = "Sick";
                                                    } else if($ltype == "2") {
                                                        $typetext = "Vacation";
                                                    }
                                                    $statstext = "";
                                                    $leave_link = "";
                                                    if($lstatus == "1") {
                                                        $statstext = "Pending";
                                                        $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog2(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog2(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a>';
                                                    } else if($lstatus == "2") {
                                                        $statstext = "Approved";
                                                        $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog2(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog2(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a>';
                                                    } else if($lstatus == "3") {
                                                        $statstext = "Declined";
                                                        $leave_link = '<a href="javascript:void(0)" onclick="openLeaveViewDialog2(\''.$recid.'\',\''.$editlstart.'\',\''.$editlend.'\',\''.$ltype.'\',\''.$lreason.'\',\''.$lfname.'\',\''.$lmname.'\',\''.$llname.'\',\''.$empid.'\',\''.$lstatus.'\')">Details</a> | <a href="javascript:void(0)" onclick="openLeaveRemarksDialog2(\''.$recid.'\',\''.$lremarks.'\')">Remarks</a>';
                                                    }
                                                    $lmnameinitial = substr($lmname, 0, 1);

                                                    $recordmark = "Old";

                                                    if($count == 1) {
                                                        $recordmark = "Updated";
                                                    }
                                                        
                                                    echo '
                                                    <tr>
                                                    <td>'.$empid.'</td>
                                                    <td>'.$lfname.' '.$lmnameinitial.'. '.$llname.'</td>
                                                    <td>'.$editldate.'</td>       
                                                    <td>'.$statstext.'</td>   
                                                    <td>'.$leave_link.'</td>   
                                                    <td>'.$recordmark.'</td>
                                                    </tr>
                                                    ';   
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                            </div>
                        </div>
                    </div><!-- /.col-->
                </div><!-- /.row -->
            <?php } else if (isset($_GET["settings"]) && trim($_GET["settings"]) == "focus") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&dashboard=focus">Dashboard</a></div>
                                <div class="panel-body">
                                    <div class="col-md-6 col-md-offset-3">
                                        <form role="form" onsubmit="return false;">
                                        <span id="updateAccStatus"></span>              
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="update-acc-email" placeholder="Email" value="<?php echo $email; ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" id="update-acc-pass" placeholder="Password" value="<?php echo $password; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="updateAccBtn" style="width: 100%" onclick="updateSettings()">Update</button>  
                                            </form> 
                                        </div>
                                </div>
                            </div>
                        </div><!-- /.col-->
                    </div><!-- /.row -->
            <?php } ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="editCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
          </div>
          <div class="modal-body">
            <span id="editCategoryStatus"></span>
            <input type="hidden" class="form-control" id="edit-company-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <span id="editCompanyStatus"></span>
                            <div class="form-group">
                                <label class="control-label">Company Name</label>
                                <input type="text" class="form-control" id="edit-company-name" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Full Address</label>
                                <input type="text" class="form-control" id="edit-company-address" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Contact Number</label>
                                <input type="text" class="form-control" id="edit-company-contact" placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editCompanyBtn" onclick="editCompanyRecord()">Update</button>
          </div>
        </div>
      </div>
    </div> 

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="deleteCompany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
          </div>
          <div class="modal-body">
            <span id="deleteCompanyStatus"></span>
            <input type="hidden" class="form-control" id="delete-company-id">
            <p>Are you sure with this?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="deleteCompanyBtn" onclick="deleteCompanyRecord()">Yes</button>
          </div>
        </div>
      </div>
    </div> 

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="infoCollectibles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">More Information</h5>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client/Company</th>
                                    <th>Total Amount</th>
                                    <th>P.O Number</th>
                                    <th>Invoice Number</th>
                                    <th>Invoice Date</th>
                                    <th>Maturity Date</th>
                                    <th>DR Number</th>
                                    <th>Delivery Date</th>
                                    <th>Remarks/Paid</th>
                                    <th>OR Number</th>
                                    <th>OR Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><p id="morecollrid"><p></td>
                                    <td><p id="morecollcompany"><p></td>           
                                    <td><p id="morecolltotalamount"><p></td>
                                    <td><p id="morecollponumber"><p></td>
                                    <td><p id="morecollinvoicenumber"><p></td>
                                    <td><p id="morecollinvoicedate"><p></td>
                                    <td><p id="morecollmaturitydate"><p></td>
                                    <td><p id="morecolldrnumber"><p></td>           
                                    <td><p id="morecolldeliverydate"><p></td>
                                    <td><p id="morecollremarks"><p></td>
                                    <td><p id="morecollornumber"><p></td>
                                    <td><p id="morecollordate"><p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal more employee -->
    <div class="modal fade bd-example-modal-lg" id="moreEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">More Information</h5>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Full Name</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Contact</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="moreempid"></td>
                        <td id="moreempname"></td>     
                        <td id="moreempgender"></td> 
                        <td id="moreempbday"></td>
                        <td id="moreempcontact"></td>   
                        <td id="moreempaddress"></td>  
                    </tr>     
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>     
                        <th>Date Hired</th>
                        <th>Date Start</th>
                        <th>Date End</th>
                        <th>Remaining Leave</th>
                        <th>Leave Used</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>     
                        <td id="moreemphired"></td>
                        <td id="moreempstart"></td>
                        <td id="moreempend"></td>   
                        <td id="moreempremainingleave"></td>
                        <td id="moreempleaveused"></td>   
                        <td id="moreempstat"></td>
                    </tr>     
                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal more employee -->
    <div class="modal fade bd-example-modal-md" id="viewDeductions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Deductions</h5>
          </div>
          <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tax</th>
                        <th>Pag-IBIG</th>
                        <th>SSS</th>
                        <th>Philhealth</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td id="viewdedtax"></td>
                        <td id="viewdedpagibig"></td>     
                        <td id="viewdedsss"></td> 
                        <td id="viewdedphilhealth"></td>   
                    </tr>     

                </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="markPaidCollectibles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mark as Paid (Collectibles)</h5>
          </div>
          <div class="modal-body">
            <span id="markPaidCollectiblesStatus"></span>
            <input type="hidden" class="form-control" id="mark-paid-collectibles-id">
            <p>Are you sure with this?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="markPaidCollectiblesBtn" onclick="markPaidCollectiblesRecord()">Yes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="markUnpaidCollectibles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Mark as Unpaid (Collectibles)</h5>
          </div>
          <div class="modal-body">
            <span id="markUnpaidCollectiblesStatus"></span>
            <input type="hidden" class="form-control" id="mark-unpaid-collectibles-id">
            <p>Are you sure with this?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="markUnpaidCollectiblesBtn" onclick="markUnpaidCollectiblesRecord()">Yes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="deleteCollectibles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Company</h5>
          </div>
          <div class="modal-body">
            <span id="deleteCollectiblesStatus"></span>
            <input type="hidden" class="form-control" id="delete-collectibles-id">
            <p>Are you sure with this?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="deleteCollectiblesBtn" onclick="deleteCollectiblesRecord()">Yes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="editCollectibles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Collectibles</h5>
          </div>
          <div class="modal-body">
            <span id="editCollectiblesStatus"></span>
            <input type="hidden" class="form-control" id="edit-collectibles-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="control-label">Company</label>
                                <select class="form-control" id="edit-collectibles-company">
                                    <option value=""></option>
                                    <?php
                                    $sql = "SELECT * FROM hurtajadmin_company WHERE company_status = '1' ORDER BY id DESC";
                                    $query = mysqli_query($db_conn, $sql);
                                    while($row = mysqli_fetch_array($query)) {
                                        $cid = $row["id"];
                                        $companyname = $row["company_name"];

                                        echo '<option value="'.$cid.'">'.$companyname.'</option>';
                                    }
                                    ?>  
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Total Amount</label>
                                <input type="text" class="form-control" id="edit-collectibles-total-amount" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">P.O Number</label>
                                <input type="text" class="form-control" id="edit-collectibles-po-number" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Invoice Number</label>
                                <input type="text" class="form-control" id="edit-collectibles-invoice-number" placeholder="">
                            </div>
                            <div class="form-group">
                              <label class="control-label">Invoice Date</label>
                              <div class="input-group date" id="datePicker11">
                                <input type="text" class="form-control" name="date" id="edit-collectibles-invoice-date" autocomplete="off" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Maturity Date</label>
                          <div class="input-group date" id="datePicker12">
                            <input type="text" class="form-control" name="date" id="edit-collectibles-maturity-date" autocomplete="off" />
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">DR Number</label>
                        <input type="text" class="form-control" id="edit-collectibles-dr-number" placeholder="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Delivery Date</label>
                      <div class="input-group date" id="datePicker13">
                        <input type="text" class="form-control" name="date" id="edit-collectibles-delivery-date" autocomplete="off" />
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Remarks/Paid</label>
                    <input type="text" class="form-control" id="edit-collectibles-remarks" placeholder="">
                </div>
                <div class="form-group">
                    <label class="control-label">O.R Number</label>
                    <input type="text" class="form-control" id="edit-collectibles-or-number" placeholder="">
                </div>
                <div class="form-group">
                  <label class="control-label">O.R Date</label>
                  <div class="input-group date" id="datePicker14">
                    <input type="text" class="form-control" name="date" id="edit-collectibles-or-date" autocomplete="off" />
                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editCollectiblesBtn" onclick="editCollectiblesRecord()">Update</button>
          </div>
        </div>
      </div>
    </div> 

     <!-- Modal -->
    <div class="modal fade bd-example-modal-md" id="editPayrollSettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Payroll Settings</h5>
          </div>
          <div class="modal-body">
             <form id="loginForm" onsubmit="return false;">
                <div class="form-group">
                    <span id="editPayrollSettingsStatus"></span>
                    <input type="hidden" class="form-control" id="payroll-settings-employee-id">
                    <input type="hidden" class="form-control" id="payroll-settings-eid">

                    <label class="control-label">Employee Name</label>
                    <input type="text" class="form-control" id="payroll-settings-employee-name" disabled="disabled">
                </div>
                <div class="form-group">
                    <label class="control-label">Salary Amount per Hour</label>
                    <input type="text" class="form-control" id="payroll-settings-salary-hour">
                </div>
                <div class="form-group">
                    <label class="control-label">Tax</label>
                    <select class="form-control" id="payroll-settings-tax" >
                        <option value=""></option>
                        <option value="1">Deducted</option>
                        <option value="2">Not to Deduct</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Pag-ibig</label>
                    <select class="form-control" id="payroll-settings-pagibig">
                        <option value=""></option>
                        <option value="1">Deducted</option>
                        <option value="2">Not to Deduct</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">SSS</label>
                    <select class="form-control" id="payroll-settings-sss">
                        <option value=""></option>
                        <option value="1">Deducted</option>
                        <option value="2">Not to Deduct</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">PhilHealth</label>
                    <select class="form-control" id="payroll-settings-philhealth">
                        <option value=""></option>
                        <option value="1">Deducted</option>
                        <option value="2">Not to Deduct</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Number of Hours Worked (<?php echo date("F", strtotime("-1 months")); ?> 26 - <?php echo date("F"); ?> 25)</label>
                    <input type="text" class="form-control" id="payroll-settings-worked" disabled="disabled">
                </div>
                <div class="form-group">
                    <label class="control-label">Total Pay Amount 1 (<?php echo date("F", strtotime("-1 months")); ?> 26 - <?php echo date("F"); ?> 10)</label>
                    <input type="text" class="form-control" id="payroll-settings-paycheck-1" disabled="disabled">
                </div>
                <div class="form-group">
                    <label class="control-label">Total Pay Amount 2 (<?php echo date("F"); ?> 11 - <?php echo date("F"); ?> 25)</label>
                    <input type="text" class="form-control" id="payroll-settings-paycheck-2" disabled="disabled">
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editPayrollSettingsBtn" onclick="editPayrollSettingsRecord()">Update</button>
          </div>
      </div>
    </div>
    </div>

     <!-- Modal -->
    <div class="modal fade bd-example-modal-md" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
          </div>
          <div class="modal-body">
                <span id="editEmployeeStatus"></span>
           <form role="form" onsubmit="return false;">
            <input type="hidden" class="form-control" id="edit-employee-eid">
            <div class="form-group">
                <label class="control-label">Employee ID</label>
                <input type="text" class="form-control" id="edit-employee-id" disabled>
            </div>
            <div class="form-group">
                <label class="control-label">First Name</label>
                <input type="text" class="form-control" id="edit-employee-fname" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">Middle Name</label>
                <input type="text" class="form-control" id="edit-employee-mname" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">Last Name</label>
                <input type="text" class="form-control" id="edit-employee-lname" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">Gender</label>
                <select class="form-control" id="edit-employee-gender">
                    <option value=""></option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Date of Birth</label>
                <div class="input-group date" id="datePicker15">
                    <input type="text" class="form-control" name="date" id="edit-employee-birthday" autocomplete="off"/>
                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Contact</label>
                <input type="text" class="form-control" id="edit-employee-contact" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">Address</label>
                <input type="text" class="form-control" id="edit-employee-address" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">Status</label>
                <select class="form-control" id="edit-employee-status">
                    <option value=""></option>
                    <option value="1">Active</option>
                    <option value="2">Resigned</option>
                    <option value="3">Terminated</option>
                    <option value="4">AWOL</option>
                </select>
            </div>
            <div class="form-group">
                <label class="control-label">Join Date</label>
                <div class="date">
                    <div class="input-group date" id="datePicker16">
                        <input type="text" class="form-control" name="date" id="edit-employee-hired-date" autocomplete="off" />
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">Start Date</label>
                <div class="date">
                    <div class="input-group date" id="datePicker17">
                        <input type="text" class="form-control" name="date" id="edit-employee-start-date" autocomplete="off" />
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">End Date</label>
                <div class="date">
                    <div class="input-group date" id="datePicker18">
                        <input type="text" class="form-control" name="date" id="edit-employee-end-date" autocomplete="off" />
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label">TIN I.D (Optional)</label>
                <input type="text" class="form-control" id="edit-employee-tin" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">Pag-IBIG I.D (Optional)</label>
                <input type="text" class="form-control" id="edit-employee-pagibig" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">PhilHealth I.D (Optional)</label>
                <input type="text" class="form-control" id="edit-employee-philhealth" placeholder="">
            </div>
            <div class="form-group">
                <label class="control-label">SSS I.D (Optional)</label>
                <input type="text" class="form-control" id="edit-employee-sss" placeholder="">
            </div>
           </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="editEmployeeBtn" onclick="editEmployeeRecord()">Update</button>
        </div>
      </div>
    </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="addCashLoanAdvance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Cash Loan/Advance</h5>
          </div>
          <div class="modal-body">
            <span id="addCashLoanAdvanceStatus"></span>
            <form role="form" onsubmit="return false;">
                <div class="form-group">
                    <label class="control-label">Employee ID</label>
                    <input type="text" class="form-control" id="add-cash-loan-advance-empid">
                </div>
                <div class="form-group">
                <label class="control-label">Status</label>
                <select class="form-control" id="add-cash-loan-advance-type">
                    <option value=""></option>
                    <option value="1">Loan</option>
                    <option value="2">Advance</option>
                </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Amount</label>
                    <input type="text" class="form-control" id="add-cash-loan-advance-amount">
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="addCashLoanAdvanceBtn" onclick="addCashLoanAdvanceRecord()">Add</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="editCashLoanAdvance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Cash Loan/Advance</h5>
          </div>
          <div class="modal-body">
            <span id="editCashLoanAdvanceStatus"></span>
            <form role="form" onsubmit="return false;">
                <input type="hidden" id="edit-cash-loan-advance-rid">
                <div class="form-group">
                    <label class="control-label">Employee ID</label>
                    <input type="text" class="form-control" id="edit-cash-loan-advance-empid">
                </div>
                <div class="form-group">
                <label class="control-label">Status</label>
                <select class="form-control" id="edit-cash-loan-advance-type">
                    <option value=""></option>
                    <option value="1">Loan</option>
                    <option value="2">Advance</option>
                </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Amount</label>
                    <input type="text" class="form-control" id="edit-cash-loan-advance-amount">
                </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editCashLoanAdvanceBtn" onclick="editCashLoanAdvanceRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="deleteCashLoanAdvance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Cash Loan/Advance</h5>
          </div>
          <div class="modal-body">
            <span id="deleteCashLoanAdvanceStatus"></span>
            <input type="hidden" class="form-control" id="delete-cash-loan-advance-id">
            <p>Are you sure with this?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="deleteCashLoanAdvanceBtn" onclick="deleteCashLoanAdvanceRecord()">Yes</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-sm" id="deleteEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Employee</h5>
          </div>
          <div class="modal-body">
            <span id="deleteEmployeeStatus"></span>
            <input type="hidden" class="form-control" id="delete-employee-id">
            <p>Are you sure with this?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="deleteEmployeeBtn" onclick="deleteEmployeeRecord()">Yes</button>
          </div>
        </div>
      </div>
    </div>

    <!--Modal edit sss con-->
  <div class="modal fade bd-example-modal-sm" id="editSSSContribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit SSS Contribution</h5>
          </div>
          <div class="modal-body">
            <span id="editSSSContributionStatus"></span>
            <input type="hidden" class="form-control" id="edit-sss-contribution-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="control-label">Range Of Compensation</label>
                                <input type="text" class="form-control" id="edit-sss-contribution-range" placeholder="" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Employee Contribution</label>
                                <input type="text" class="form-control" id="edit-sss-contribution-amount" placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editSSSContributionBtn" onclick="editSSSContributionRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>
 <!--end edit sss con-->

<!--Modal edit phl health -->
    <div class="modal fade bd-example-modal-sm" id="editPhilHealthContribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit PhilHealth Contribution</h5>
          </div>
          <div class="modal-body">
            <span id="editPhilHealthContributionStatus"></span>
            <input type="hidden" class="form-control" id="edit-philhealth-contribution-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="control-label">Range Of Compensation</label>
                                <input type="text" class="form-control" id="edit-philhealth-contribution-range" placeholder="" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Employee Contribution</label>
                                <input type="text" class="form-control" id="edit-philhealth-contribution-amount" placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editPhilHealthContributionBtn" onclick="editPhilHealthContributionRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>
<!--Modal end edit phl health -->

<!--Modal edit pagibig con -->
    <div class="modal fade bd-example-modal-sm" id="editPagibigContribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Pag-IBIG Contribution</h5>
          </div>
          <div class="modal-body">
            <span id="editPagibigContributionStatus"></span>
            <input type="hidden" class="form-control" id="edit-pagibig-contribution-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="control-label">Range Of Compensation</label>
                                <input type="text" class="form-control" id="edit-pagibig-contribution-range" placeholder="" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Employee Contribution</label>
                                <input type="text" class="form-control" id="edit-pagibig-contribution-amount" placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editPagibigContributionBtn" onclick="editPagibigContributionRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>
<!--Modal end edit pagibig con -->

<!--Modal edit tax -->
    <div class="modal fade bd-example-modal-sm" id="editTaxContribution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Tax Contribution</h5>
          </div>
          <div class="modal-body">
            <span id="editTaxContributionStatus"></span>
            <input type="hidden" class="form-control" id="edit-tax-contribution-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="control-label">Range Of Compensation</label>
                                <input type="text" class="form-control" id="edit-tax-contribution-range" placeholder="" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Employee Contribution</label>
                                <input type="text" class="form-control" id="edit-tax-contribution-amount" placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editTaxContributionBtn" onclick="editTaxContributionRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>
<!--Modal end edit tax -->
<!--Modal edit holiday -->
    <div class="modal fade bd-example-modal-sm" id="addHoliday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Holiday</h5>
          </div>
          <div class="modal-body">
            <span id="addHolidayStatus"></span>
            <div class="row">
                <div class="col-lg-12">
                  <form role="form" onsubmit="return false;">
                    <span id="addHolidayStatus"></span>
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" id="add-holiday-name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control" id="add-holiday-type">
                            <option value=""></option>
                            <option value="1">Regular Holiday</option>
                            <option value="2">Special Non-working Holiday</option>
                        </select>
                    </div>
                    <div class="form-group" id="holidaydate3" hidden="true">
                        <label class="control-label">Date (Don't mind the year, just pick a date)</label>
                        <div class="input-group date" id="datePicker8">
                            <input type="text" class="form-control" name="date" placeholder="" id="add-holiday-date-1" autocomplete="off"/>
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group" id="holidaydate4" hidden="true">
                        <label class="control-label">Date</label>
                        <div class="input-group date" id="datePicker9">
                            <input type="text" class="form-control" name="date" placeholder="" id="add-holiday-date-2" autocomplete="off"/>
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </form>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="addHolidayBtn" onclick="addHolidayRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>
<!--Modal end edit holiday-->
<!--Modal edit holiday -->
    <div class="modal fade bd-example-modal-sm" id="editHoliday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Holiday</h5>
          </div>
          <div class="modal-body">
            <span id="editHolidayStatus"></span>
            <input type="hidden" class="form-control" id="edit-holiday-id">
            <div class="row">
                <div class="col-lg-12">
                  <form role="form" onsubmit="return false;">
                    <span id="addHolidayStatus"></span>
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" class="form-control" id="edit-holiday-name" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Type</label>
                        <select class="form-control" id="edit-holiday-type">
                            <option value=""></option>
                            <option value="1">Regular Holiday</option>
                            <option value="2">Special Non-working Holiday</option>
                        </select>
                    </div>
                    <div class="form-group" id="holidaydate5" hidden="true">
                        <label class="control-label">Date (Don't mind the year, just pick a date)</label>
                        <div class="input-group date" id="datePicker23">
                            <input type="text" class="form-control" name="date" placeholder="" id="edit-holiday-date-1" autocomplete="off"/>
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group" id="holidaydate6" hidden="true">
                        <label class="control-label">Date</label>
                        <div class="input-group date" id="datePicker24">
                            <input type="text" class="form-control" name="date" placeholder="" id="edit-holiday-date-2" autocomplete="off"/>
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </form>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editHolidayBtn" onclick="editHolidayRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>
<!--Modal end edit holiday-->

<!--Modal edit tax -->
    <div class="modal fade bd-example-modal-sm" id="editHolidayRate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Holiday Rate</h5>
          </div>
          <div class="modal-body">
            <span id="editHolidayRateStatus"></span>
            <input type="hidden" class="form-control" id="edit-holiday-rate-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="control-label">Type</label>
                                <input type="text" class="form-control" id="edit-holiday-rate-type" placeholder="" disabled="disabled">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Rate Percentage (%)</label>
                                <input type="text" class="form-control" id="edit-holiday-rate-percentage" placeholder="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="editHolidayRateBtn" onclick="editHolidayRateRecord()">Update</button>
          </div>
        </div>
      </div>
    </div>
<!--Modal end edit tax -->


<!--Modal delete holiday -->
    <div class="modal fade bd-example-modal-sm" id="deleteHoliday" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Holiday</h5>
          </div>
          <div class="modal-body">
            <span id="deleteHolidayStatus"></span>
            <input type="hidden" class="form-control" id="delete-holiday-id">
            <p>Are you sure with this?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="deleteHolidayBtn" onclick="deleteHolidayRecord()">Yes</button>
          </div>
        </div>
      </div>
    </div>
<!--view modal leave-->
    <div class="modal fade bd-example-modal-md" id="viewLeave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave Details</h5>
              </div>
              <div class="modal-body">
                <span id="updateLeaveStatus"></span>
                <input type="hidden" class="form-control" id="view-leave-id">
                <div class="form-group">
                    <label class="control-label">Employee ID</label>
                    <input type="text" class="form-control" name="" id="view-leave-empid" disabled="disabled">
                </div>
                <div class="form-group">
                    <label class="control-label">Employee Name</label>
                    <input type="text" class="form-control" name="" id="view-leave-name" disabled="disabled">
                </div>
                <div class="form-group">
                    <label class="control-label">Leave Start</label>
                    <div class="date">
                        <div class="input-group date" id="datePicker22">
                            <input type="text" class="form-control" name="date" id="view-leave-start" placeholder="">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Leave End</label>
                    <div class="date">
                        <div class="input-group date" id="datePicker23">
                            <input type="text" class="form-control" name="date" id="view-leave-end" placeholder="">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Type</label>
                    <select class="form-control" id="view-leave-type">
                        <option value=""></option>
                        <option value="1">Sick</option>
                        <option value="2">Vacation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Reason</label>
                    <input type="textarea" class="form-control" name="" id="view-leave-reason">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateLeaveBtn" onclick="updateLeaveRecord()">Update</button>
              </div>
            </div>
          </div>
        </div>
    <div class="modal fade bd-example-modal-md" id="viewLeave2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave Details</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label class="control-label">Employee ID</label>
                    <input type="text" class="form-control" name="" id="view-leave-empid-2" disabled="disabled">
                </div>
                <div class="form-group">
                    <label class="control-label">Employee Name</label>
                    <input type="text" class="form-control" name="" id="view-leave-name-2" disabled="disabled">
                </div>
                <div class="form-group">
                    <label class="control-label">Leave Start</label>
                    <div class="date">
                        <div class="input-group date" id="datePicker22">
                            <input type="text" class="form-control" name="date" id="view-leave-start-2" placeholder="" disabled="disabled">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Leave End</label>
                    <div class="date">
                        <div class="input-group date" id="datePicker23">
                            <input type="text" class="form-control" name="date" id="view-leave-end-2" placeholder="" disabled="disabled">
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">Type</label>
                    <select class="form-control" id="view-leave-type-2" disabled="disabled">
                        <option value=""></option>
                        <option value="1">Sick</option>
                        <option value="2">Vacation</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="control-label">Reason</label>
                    <input type="textarea" class="form-control" name="" id="view-leave-reason-2" disabled="disabled">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    <div class="modal fade bd-example-modal-md" id="viewLeaveRemarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave Remarks</h5>
              </div>
              <div class="modal-body">
                <span id="updateLeaveRemarksStatus"></span>
                <input type="hidden" class="form-control" id="view-leave-remarks-id">
                <div class="form-group">
                    <label class="control-label">Remarks</label>
                    <textarea class="form-control" name="" id="view-leave-remarks-remarks"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateLeaveRemarksBtn" onclick="updateLeaveRemarksRecord()">Update</button>
              </div>
            </div>
          </div>
        </div>
    <div class="modal fade bd-example-modal-md" id="viewLeaveRemarks2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave Remarks</h5>
              </div>
              <div class="modal-body">
                <div class="form-group">
                    <label class="control-label">Remarks</label>
                    <textarea class="form-control" name="" id="view-leave-remarks-remarks-2" disabled="disabled"></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!--modal delete leave-->
    <div class="modal fade bd-example-modal-sm" id="deleteLeave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Leave</h5>
              </div>
              <div class="modal-body">
                <span id="deleteLeaveStatus"></span>
                <input type="hidden" class="form-control" id="delete-leave-id">
                <p>Are you sure with this?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="deleteLeaveBtn" onclick="deleteLeaveRecord()">Yes</button>
              </div>
            </div>
          </div>
        </div>
<!--modal approve leave-->
    <div class="modal fade bd-example-modal-sm" id="approveLeave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve Leave</h5>
              </div>
              <div class="modal-body">
                <span id="approveLeaveStatus"></span>
                <input type="hidden" class="form-control" id="approve-leave-id">
                <p>Are you sure you would like to approve this leave?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="approveLeaveBtn" onclick="approveLeaveRecord()">Yes</button>
              </div>
            </div>
          </div>
        </div>
<!--modal decline leave-->
    <div class="modal fade bd-example-modal-sm" id="declineLeave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Decline Leave</h5>
              </div>
              <div class="modal-body">
                <span id="declineLeaveStatus"></span>
                <input type="hidden" class="form-control" id="decline-leave-id">
                <p>Are you sure with this?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="declineLeaveBtn" onclick="declineLeaveRecord()">Yes</button>
              </div>
            </div>
          </div>
        </div>
<!--Modal end delete holiday-->
   
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

    <script src="js/main.js"></script>
    <script src="js/ajax.js"></script>
    <script src="js/inputmask.js"></script>

    <script type="text/javascript">

      $("#add-holiday-type").change(function () { 
            var filterleaveValue = $("#add-holiday-type").val();
            console.log(filterleaveValue);
            if (filterleaveValue == "1") {
                $("#holidaydate3").show();
                $("#holidaydate4").hide();
            } else if (filterleaveValue == "2") {
                $("#holidaydate3").hide();
                $("#holidaydate4").show();
            }
      });

      $("#edit-holiday-type").change(function () { 
            var filterleaveValue = $("#edit-holiday-type").val();
            console.log(filterleaveValue);
            if (filterleaveValue == "1") {
                $("#holidaydate5").show();
                $("#holidaydate6").hide();
            } else if (filterleaveValue == "2") {
                $("#holidaydate5").hide();
                $("#holidaydate6").show();
            }
      });

      function openCompanyDeleteDialog(rid) {
        $('#deleteCompany').modal('show');
        _("delete-company-id").value = rid;
      }

      function deleteCompanyRecord() {
        var rid = _("delete-company-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("deleteCompanyStatus");
        var button = _("deleteCompanyBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=company";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("deletecompanyid="+rid);
        }
      }

      function openCashLoanAdvanceEditDialog(rid, empid, type, amount) {
        $('#editCashLoanAdvance').modal('show');
        _("edit-cash-loan-advance-rid").value = rid;
        _("edit-cash-loan-advance-empid").value = empid;
        _("edit-cash-loan-advance-type").value = type;
        _("edit-cash-loan-advance-amount").value = amount;
      }

      function editCashLoanAdvanceRecord() {
        var rid = _("edit-cash-loan-advance-rid").value;
        var empid = _("edit-cash-loan-advance-empid").value;
        var type = _("edit-cash-loan-advance-type").value;
        var amount = _("edit-cash-loan-advance-amount").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editCashLoanAdvanceStatus");
        var button = _("editCashLoanAdvanceBtn");
        status.innerHTML = load;
        if (rid == "" || empid == "" || type == "" || amount == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&employee=focus&cash=employee";
                  } else if (ajax.responseText == "noemployee"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">No employee found with this ID</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editcashloanadvancerid="+rid+"&editcashloanadvanceempid="+empid+"&editcashloanadvancetype="+type+"&editcashloanadvanceamount="+amount);
        }
      }

      function openCashLoanAdvanceDeleteDialog(rid) {
        $('#deleteCashLoanAdvance').modal('show');
        _("delete-cash-loan-advance-id").value = rid;
      }

      function deleteCashLoanAdvanceRecord() {
        var rid = _("delete-cash-loan-advance-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("deleteCashLoanAdvanceStatus");
        var button = _("deleteCashLoanAdvanceBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&employee=focus&cash=employee";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("deletecashloanadvnaceid="+rid);
        }
      }

      function openCompanyEditDialog(rid, name, address, contact) {
        $('#editCompany').modal('show');
        _("edit-company-id").value = rid;
        _("edit-company-name").value = name;
        _("edit-company-address").value = address;
        _("edit-company-contact").value = contact;
      }

      function editCompanyRecord() {
        var rid = _("edit-company-id").value;
        var name = _("edit-company-name").value;
        var address = _("edit-company-address").value;
        var contact = _("edit-company-contact").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editCompanyStatus");
        var button = _("editCompanyBtn");
        status.innerHTML = load;
        if (rid == "" || name == "" || address == "" || contact == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=company";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editcompanyid="+rid+"&editcompanyname="+name+"&editcompanyaddress="+address+"&editcompanycontact="+contact);
        }
      }

      function addCompanyRecord() {
        var name = _("add-company-name").value;
        var address = _("add-company-address").value;
        var contact = _("add-company-contact").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("addCompanyStatus");
        var button = _("addCompanyBtn");
        status.innerHTML = load;
        if (name == "" || address == "" || contact == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successinsert"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=company";
                  } else if (ajax.responseText == "exist"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Company information has already exist!</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("addcompanyname="+name+"&addcompanyaddress="+address+"&addcompanycontact="+contact);
        }
      }

      function openCollectiblesInfoDialog(rid, companyname, totalamount, ponumber, invocenumber, invoicedate, maturitydate, drnumber, deliverydate, remarkspaid, ornumber, ordate) {
        $('#infoCollectibles').modal('show');
        _("morecollrid").innerHTML = rid;
        _("morecollcompany").innerHTML = companyname;
        _("morecolltotalamount").innerHTML = totalamount;
        _("morecollponumber").innerHTML = ponumber;
        _("morecollinvoicenumber").innerHTML = invocenumber;
        _("morecollinvoicedate").innerHTML = invoicedate;
        _("morecollmaturitydate").innerHTML = maturitydate;
        _("morecolldrnumber").innerHTML = drnumber;
        _("morecolldeliverydate").innerHTML = deliverydate;
        _("morecollremarks").innerHTML = remarkspaid;
        _("morecollornumber").innerHTML = ornumber;
        _("morecollordate").innerHTML = ordate;
      }

      function addCollectiblesRecord() {
        var company = _("add-collectibles-company").value;
        var totalamount = _("add-collectibles-total-amount").value;
        var ponumber = _("add-collectibles-po-number").value;
        var invoicenumber = _("add-collectibles-invoice-number").value;
        var invoicedate = _("add-collectibles-invoice-date").value;
        var maturitydate = _("add-collectibles-maturity-date").value;
        var drnumber = _("add-collectibles-dr-number").value;
        var deliverydate = _("add-collectibles-delivery-date").value;
        var remarkspaid = _("add-collectibles-remarks").value;
        var ornumber = _("add-collectibles-or-number").value;
        var ordate = _("add-collectibles-or-date").value;

        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("addCollectiblesStatus");
        var button = _("addCollectiblesBtn");
        status.innerHTML = load;
        if (company == "" || totalamount == "" || ponumber == "" || invoicenumber == "" || invoicedate == "" || maturitydate == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successinsert"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=collectibles";
                  } else if (ajax.responseText == "exist"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Collectibles information has already exist!</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("addcollectiblescompany="+company+"&addcollectiblestotalamount="+totalamount+"&addcollectiblesponumber="+ponumber+"&addcollectiblesinvoicenumber="+invoicenumber+"&addcollectiblesinvoicedate="+invoicedate+"&addcollectiblesmaturitydate="+maturitydate+"&addcollectiblesdrnumber="+drnumber+"&addcollectiblesdeliverydate="+deliverydate+"&addcollectiblesremarks="+remarkspaid+"&addcollectiblesornumber="+ornumber+"&addcollectiblesordate="+ordate);
        }
      }

      function openCollectiblesMarkPaidDialog(rid) {
        $('#markPaidCollectibles').modal('show');
        _("mark-paid-collectibles-id").value = rid;
      }

      function markPaidCollectiblesRecord() {
        var rid = _("mark-paid-collectibles-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("markPaidCollectiblesStatus");
        var button = _("markPaidCollectiblesBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=paidcollectibles";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("markpaidcollectiblesid="+rid);
        }
      }

      function openCollectiblesMarkUnpaidDialog(rid) {
        $('#markUnpaidCollectibles').modal('show');
        _("mark-unpaid-collectibles-id").value = rid;
      }

      function markUnpaidCollectiblesRecord() {
        var rid = _("mark-unpaid-collectibles-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("markUnpaidCollectiblesStatus");
        var button = _("markUnpaidCollectiblesBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=collectibles";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("markunpaidcollectiblesid="+rid);
        }
      }

      function openCollectiblesDeleteDialog(rid) {
        $('#deleteCollectibles').modal('show');
        _("delete-collectibles-id").value = rid;
      }

      function deleteCollectiblesRecord() {
        var rid = _("delete-collectibles-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("deleteCollectiblesStatus");
        var button = _("deleteCollectiblesBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=collectibles";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("deletecollectiblesid="+rid);
        }
      }

      function openCollectiblesEditDialog(rid, companyid, totalamount, ponumber, invocenumber, invoicedate, maturitydate, drnumber, deliverydate, remarkspaid, ornumber, ordate) {
        $('#editCollectibles').modal('show');
        _("edit-collectibles-id").value = rid;
        _("edit-collectibles-company").value = companyid;
        _("edit-collectibles-total-amount").value = totalamount;
        _("edit-collectibles-po-number").value = ponumber;
        _("edit-collectibles-invoice-number").value = invocenumber;
        _("edit-collectibles-invoice-date").value = invoicedate;
        _("edit-collectibles-maturity-date").value = maturitydate;
        _("edit-collectibles-dr-number").value = drnumber;
        _("edit-collectibles-delivery-date").value = deliverydate;
        _("edit-collectibles-remarks").value = remarkspaid;
        _("edit-collectibles-or-number").value = ornumber;
        _("edit-collectibles-or-date").value = ordate;
      }

      function editCollectiblesRecord() {
        var rid = _("edit-collectibles-id").value;
        var companyid = _("edit-collectibles-company").value;
        var totalamount = _("edit-collectibles-total-amount").value;
        var ponumber = _("edit-collectibles-po-number").value;
        var invoicenumber = _("edit-collectibles-invoice-number").value;
        var invoicedate = _("edit-collectibles-invoice-date").value;
        var maturitydate = _("edit-collectibles-maturity-date").value;
        var drnumber = _("edit-collectibles-dr-number").value;
        var deliverydate = _("edit-collectibles-delivery-date").value;
        var remarkspaid = _("edit-collectibles-remarks").value;
        var ornumber = _("edit-collectibles-or-number").value;
        var ordate = _("edit-collectibles-or-date").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editCollectiblesStatus");
        var button = _("editCollectiblesBtn");
        status.innerHTML = load;
        if (companyid == "" || totalamount == "" || ponumber == "" || invoicenumber == "" || invoicedate == "" || maturitydate == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&ageing=focus&view=collectibles";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editcollectiblesid="+rid+"&editcollectiblescompany="+companyid+"&editcollectiblestotalamount="+totalamount+"&editcollectiblesponumber="+ponumber+"&editcollectiblesinvoicenumber="+invoicenumber+"&editcollectiblesinvoicedate="+invoicedate+"&editcollectiblesmaturitydate="+maturitydate+"&editcollectiblesdrnumber="+drnumber+"&editcollectiblesdeliverydate="+deliverydate+"&editcollectiblesremarks="+remarkspaid+"&editcollectiblesornumber="+ornumber+"&editcollectiblesordate="+ordate);
        }
      }

      function addEmployeeRecord() {
        var fname = _("add-employee-fname").value;
        var mname = _("add-employee-mname").value;
        var lname = _("add-employee-lname").value;
        var gender = _("add-employee-gender").value;
        var birthday = _("add-employee-birthday").value;
        var contact = _("add-employee-contact").value;
        var address = _("add-employee-address").value;
        var hired = _("add-employee-hired-date").value;
        var start = _("add-employee-start-date").value;
        var end = _("add-employee-end-date").value;
        var tin = _("add-employee-tin").value;
        var pagibig = _("add-employee-pagibig").value;
        var philhealth = _("add-employee-philhealth").value;
        var sss = _("add-employee-sss").value;
        var emp_status = _("add-employee-status").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("addEmployeeStatus");
        var button = _("addEmployeeBtn");
        status.innerHTML = load;
        if (fname == "" || mname == "" || lname == "" || gender == "" || birthday == "" || contact == "" || address == "" || hired == "" || emp_status == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successinsert"){
                      window.location = "account.php?id=<?php echo $id; ?>&employee=focus&view=employee";
                  } else if (ajax.responseText == "exist"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Company information has already exist!</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("addemployeefname="+fname+"&addemployeemname="+mname+"&addemployeelname="+lname+"&addemployeegender="+gender+"&addemployeebirthday="+birthday+"&addemployeecontact="+contact+"&addemployeeaddress="+address+"&addemployeehired="+hired+"&addemployeestart="+start+"&addemployeeend="+end+"&addemployeeemp_status="+emp_status+"&addemployeetin="+tin+"&addemployeepagibig="+pagibig+"&addemployeephilhealth="+philhealth+"&addemployeesss="+sss);
        }
      }

      function openEmployeeMore(empid, fullname, gender, bday, contact, address, hired, start, end, leaveused, remainingleave, stats) {
        $('#moreEmployee').modal('show');
        _("moreempid").innerHTML = empid;
        _("moreempname").innerHTML = fullname;
        _("moreempgender").innerHTML = gender;
        _("moreempbday").innerHTML = bday;
        _("moreempcontact").innerHTML = contact;
        _("moreempaddress").innerHTML = address;
        _("moreemphired").innerHTML = hired;
        _("moreempstart").innerHTML = start;
        _("moreempend").innerHTML = end;
        _("moreempremainingleave").innerHTML = remainingleave;
        _("moreempleaveused").innerHTML = leaveused;
        _("moreempstat").innerHTML = stats;
      }

      function openEmployeePayrollSettingsDialog(empid, eid, name, perhour, tax, pagibig, sss, philhealth, worked, paycheck1, paycheck2) {
        $('#editPayrollSettings').modal('show');
        _("payroll-settings-employee-id").value = empid;
        _("payroll-settings-eid").value = eid;
        _("payroll-settings-employee-name").value = name;
        _("payroll-settings-salary-hour").value = perhour;
        _("payroll-settings-tax").value = tax;
        _("payroll-settings-pagibig").value = pagibig;
        _("payroll-settings-sss").value = sss;
        _("payroll-settings-philhealth").value = philhealth;
        _("payroll-settings-worked").value = worked;
        _("payroll-settings-paycheck-1").value = paycheck1;
        _("payroll-settings-paycheck-2").value = paycheck2;
      }

      function editPayrollSettingsRecord() {
        var empid = _("payroll-settings-employee-id").value;
        var eid = _("payroll-settings-eid").value;
        var salaryhour = _("payroll-settings-salary-hour").value;
        var tax = _("payroll-settings-tax").value;
        var pagibig = _("payroll-settings-pagibig").value;
        var sss = _("payroll-settings-sss").value;
        var philhealth = _("payroll-settings-philhealth").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editPayrollSettingsStatus");
        var button = _("editPayrollSettingsBtn");
        status.innerHTML = load;
        if (empid == "" || salaryhour == "" || tax == "" || pagibig == "" || sss == "" || philhealth == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&employee=focus&view=employee";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editpayrollsettingsempid="+empid+"&editpayrollsettingseid="+eid+"&editpayrollsettingssalaryhour="+salaryhour+"&editpayrollsettingstax="+tax+"&editpayrollsettingspagibig="+pagibig+"&editpayrollsettingssss="+sss+"&editpayrollsettingsphilhealth="+philhealth);
        }
      }

      function openEmployeeEditDialog(rid, empid, fname, mname, lname, gender, birthday, address, contact, datehired, datestart, dateend,stats,tin,pagibig,philhealth,sss) {
        console.log(stats);
        $('#editEmployee').modal('show');
        _("edit-employee-eid").value = rid;
        _("edit-employee-id").value = empid;
        _("edit-employee-fname").value = fname;
        _("edit-employee-mname").value = mname;
        _("edit-employee-lname").value = lname;
        _("edit-employee-gender").value = gender;
        _("edit-employee-birthday").value = birthday;
        _("edit-employee-address").value = address;
        _("edit-employee-contact").value = contact;
        _("edit-employee-hired-date").value = datehired;
        _("edit-employee-start-date").value = datestart;
        _("edit-employee-end-date").value = dateend;
        _("edit-employee-status").value = stats;
        _("edit-employee-tin").value = tin;
        _("edit-employee-pagibig").value = pagibig;
        _("edit-employee-philhealth").value = philhealth;
        _("edit-employee-sss").value = sss;
      }

      function editEmployeeRecord() {
        var rid = _("edit-employee-eid").value;
        var fname = _("edit-employee-fname").value;
        var mname = _("edit-employee-mname").value;
        var lname = _("edit-employee-lname").value;
        var gender = _("edit-employee-gender").value;
        var birthday = _("edit-employee-birthday").value;
        var address = _("edit-employee-address").value;
        var contact = _("edit-employee-contact").value;
        var datehired = _("edit-employee-hired-date").value;
        var datestart = _("edit-employee-start-date").value;
        var dateend = _("edit-employee-end-date").value;
        var emp_status = _("edit-employee-status").value;
        var tin = _("edit-employee-tin").value;
        var pagibig = _("edit-employee-pagibig").value;
        var philhealth = _("edit-employee-philhealth").value;
        var sss = _("edit-employee-sss").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editEmployeeStatus");
        var button = _("editEmployeeBtn");
        status.innerHTML = load;
        if (rid == "" || fname == "" || mname == "" || lname == "" || gender == "" || birthday == "" || address == "" || contact == "" || datehired == "" || emp_status == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&employee=focus&view=employee";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editemployeeid="+rid+"&editemployeefname="+fname+"&editemployeemname="+mname+"&editemployeelname="+lname+"&editemployeegender="+gender+"&editemployeebirthday="+birthday+"&editemployeeaddress="+address+"&editemployeecontact="+contact+"&editemployeedatehired="+datehired+"&editemployeedatestart="+datestart+"&editemployeedateend="+dateend+"&editemployeestatus="+emp_status+"&editemployeetin="+tin+"&editemployeepagibig="+pagibig+"&editemployeephilhealth="+philhealth+"&editemployeesss="+sss);
        }
      }

      function openCashLoanAdvanceAddDialog() {
        $('#addCashLoanAdvance').modal('show');
      }

      function addCashLoanAdvanceRecord() {
        var empid = _("add-cash-loan-advance-empid").value;
        var type = _("add-cash-loan-advance-type").value;
        var amount = _("add-cash-loan-advance-amount").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("addCashLoanAdvanceStatus");
        var button = _("addCashLoanAdvanceBtn");
        status.innerHTML = load;
        if (empid == "" || type == "" || amount == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successinsert"){
                      window.location = "account.php?id=<?php echo $id; ?>&employee=focus&cash=employee";
                  } else if (ajax.responseText == "noemployee"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">No employee found with this ID</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("addcashloanadvanceempid="+empid+"&addcashloanadvancetype="+type+"&addcashloanadvanceamount="+amount);
        }
      }

      function openEmployeeDeleteDialog(rid) {
        $('#deleteEmployee').modal('show');
        _("delete-employee-id").value = rid;
      }

      function deleteEmployeeRecord() {
        var rid = _("delete-employee-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("deleteEmployeeStatus");
        var button = _("deleteEmployeeBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&employee=focus&view=employee";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("deleteemployeeid="+rid);
        }
      }

      function updateSettings() {
        var email = _("update-acc-email").value;
        var password = _("update-acc-pass").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        _("updateAccStatus").innerHTML = load;
          if (email == "" || password == "") {
                _("updateAccStatus").innerHTML = error;
          } else {
                _("updateAccBtn").disabled = true;
                _("updateAccStatus").innerHTML = load;
                var ajax = ajaxObj("POST", "parsers/account.php");
                ajax.onreadystatechange = function() {
                  if(ajaxReturn(ajax) == true) {
                      if (ajax.responseText == "successinsert"){
                        window.location = "account.php?id=<?php echo $id; ?>&settings=focus";
                      } else if (ajax.responseText == "samedata"){
                        _("updateAccBtn").disabled = false;
                        _("updateAccStatus").innerHTML = '<div style="color: red; margin-bottom: 10px;">No changes detected!</div>';
                      } else {
                          _("updateAccBtn").disabled = false;
                          _("updateAccStatus").innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                      }
                  }
                }
          ajax.send("updateemail="+email+"&password="+password);
          }
      }

      $(document).ready(function() {
        $('#datePicker1')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker2')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker3')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker4')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker5')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker6')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker7')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker8')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker9')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker10')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker11')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker12')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker13')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker14')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker15')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker16')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker17')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker18')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker19')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker20')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker21')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker22')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker23')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      $(document).ready(function() {
        $('#datePicker24')
        .datepicker({
          format: 'mm/dd/yyyy'
        })
        .on('changeDate', function(e) {
              // Revalidate the date field
              $('#eventForm').formValidation('revalidateField', 'date');
            });
      });

      function openLeaveDeleteDialog(rid) {
        $('#deleteLeave').modal('show');
        _("delete-leave-id").value = rid;
        }
      function deleteLeaveRecord() {
        var rid = _("delete-leave-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("deleteLeaveStatus");
        var button = _("deleteLeaveBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&leave=focus&action=history";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("deleteleaveeid="+rid);
        }
      }
    function openLeaveViewDialog(rid,lstart,lend,ltype,lreason,lfname,lmname,llname,empid,lstatus) { //new to improve
        $('#viewLeave').modal('show');
        _("view-leave-id").value = rid;
        _("view-leave-name").value = lfname+" "+lmname+" "+llname;
        _("view-leave-empid").value = empid;
        _("view-leave-start").value = lstart;
        _("view-leave-end").value = lend;
        _("view-leave-type").value = ltype;
        _("view-leave-reason").value = lreason;
        if(lstatus == "1" || lstatus == "3") {
            _("updateLeaveBtn").disabled = true;
        } else {
            _("updateLeaveBtn").disabled = false;
        }
    }
    function openLeaveViewDialog2(rid,lstart,lend,ltype,lreason,lfname,lmname,llname,empid,lstatus) { //new to improve
        $('#viewLeave2').modal('show');
        _("view-leave-name-2").value = lfname+" "+lmname+" "+llname;
        _("view-leave-empid-2").value = empid;
        _("view-leave-start-2").value = lstart;
        _("view-leave-end-2").value = lend;
        _("view-leave-type-2").value = ltype;
        _("view-leave-reason-2").value = lreason;
    }
    function updateLeaveRecord() {
        var rid = _("view-leave-id").value;
        var start = _("view-leave-start").value;
        var end = _("view-leave-end").value;
        var type = _("view-leave-type").value;
        var reason = _("view-leave-reason").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("updateLeaveStatus");
        var button = _("updateLeaveBtn");
        status.innerHTML = load;
        if (start == "" || end == "" || type == "" || reason == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&leave=focus&action=history";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editleaverid="+rid+"&editleavestart="+start+"&editleaveend="+end+"&editleavetype="+type+"&editleavereason="+reason);
        }
      }
      function openLeaveRemarksDialog(rid,lremarks) { //new to improve
        $('#viewLeaveRemarks').modal('show');
        _("view-leave-remarks-id").value = rid;
        _("view-leave-remarks-remarks").value = lremarks;
      }
      function openLeaveRemarksDialog2(rid, lremarks) { //new to improve
        $('#viewLeaveRemarks2').modal('show');
        _("view-leave-remarks-remarks-2").value = lremarks;
      }
      function updateLeaveRemarksRecord() {
        var rid = _("view-leave-remarks-id").value;
        var remarks = _("view-leave-remarks-remarks").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("updateLeaveRemarksStatus");
        var button = _("updateLeaveRemarksBtn");
        status.innerHTML = load;
        if (remarks == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&leave=focus&action=history";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editleaveremarksrid="+rid+"&editleaveremarksremarks="+remarks);
        }
      }
    function openLeaveApproveDialog(rid) {
        $('#approveLeave').modal('show');
        _("approve-leave-id").value = rid;
    }
      function approveLeaveRecord() {
        var rid = _("approve-leave-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("approveLeaveStatus");
        var button = _("approveLeaveBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&leave=focus&action=history";
                  } else if (ajax.responseText == "allused"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">All 5 leaves of this employee this year are already used!</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("approveleaveeid="+rid);
        }
      }
    function openLeaveDeclineDialog(rid) {
        $('#declineLeave').modal('show');
        _("decline-leave-id").value = rid;
        }
      function declineLeaveRecord() {
        var rid = _("decline-leave-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("declineLeaveStatus");
        var button = _("declineLeaveBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&leave=focus&action=history";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("declineleaveeid="+rid);
        }
      }
      
      function addLeaveRecord() {
        var empid = _("leave-request-employee-id").value;
        var lrtype = _("leave-request-type").value;
        var lrstart = _("leave-request-start").value;
        var lrend = _("leave-request-end").value;
        var lrdate = _("leave-request-date").value;
        var lrreason = _("leave-request-reason").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("addLeaveStatus");
        var button = _("encodeLeaveBtn");
        status.innerHTML = load;
        if (empid == "" || lrtype == "" || lrstart == "" || lrend == "" || lrdate == "" || lrreason == "" ) {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successinsert"){
                      window.location = "account.php?id=<?php echo $id; ?>&leave=focus&action=history";
                  } else if (ajax.responseText == "nofound"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Employee ID connot be found!</div>';
                  } else if (ajax.responseText == "allused"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">All 5 leaves of this employee this year are already used!</div>';
                  }  else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("addleaveempid="+empid+"&addleavelrtype="+lrtype+"&addleavelrstart="+lrstart+"&addleavelrend="+lrend+"&addleavelrdate="+lrdate+"&addleavelrreason="+lrreason);
        }
      }

      function openLeaveForm() {
        var formcount = _("leave-form-count").value;
        var status = _("leaveFormStatus");
        if (formcount == "") {
            status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        } else {
            window.open("leaveform.php?count="+formcount, '_blank');
        }
      }

      $('#add-collectibles-total-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#edit-collectibles-total-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
       });
      $('#payroll-settings-salary-hour').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#payroll-settings-paycheck-1').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#payroll-settings-paycheck-2').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#edit-sss-contribution-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#edit-philhealth-contribution-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#edit-pagibig-contribution-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#edit-tax-contribution-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#add-cash-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });
      $('#add-cash-loan-advance-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });

      $('#edit-cash-loan-advance-amount').inputmask("numeric", {
            radixPoint: ".",
            groupSeparator: ",",
            digits: 2,
            autoGroup: true,
            prefix: '₱', //No Space, this will truncate the first character
            rightAlign: false,
            oncleared: function () { self.Value(''); }
      });

      $('#search-collectibles').keyup(function(e){  
            var txtSearch = $(this).val();
            console.log(txtSearch);
            $.ajax({ 
                url:"parsers/searchcollectibles.php",  
                method:"post",  
                data:{search:txtSearch},  
                dataType:"text",  
                success:function(data) {
                    $('#collectibles-search-result').html(data); 
                }  
            });
       });

        $('#search-leave').keyup(function(e){  
            var txtleaveSearch = $(this).val();
            console.log(txtleaveSearch);
            $.ajax({ 
                url:"parsers/searchleave.php", 
                method:"post",  
                data:{search:txtleaveSearch},  
                dataType:"text",  
                success:function(data) {
                    $('#leave-search-result').html(data); 
                }  
            });
        });

       $('#select-date-leave').change(function(e){ 
            var dateValue = $("#select-date-leave").val();
            console.log(dateValue);
            $.ajax({ 
                url:"parsers/searchleave.php",  
                method:"post",  
                data:{datepicker:dateValue},  
                dataType:"text",  
                success:function(data) {
                    $('#leave-search-result').html(data); 
                }  
            });
        });

        $("#select-filter-leave").change(function () { 
                    var filterleaveValue = $("#select-filter-leave").val();
         
                    if (filterleaveValue == "") {
                        window.location = "account.php?id=<?php echo $id; ?>&leave=focus&action=history";
                    }else if (filterleaveValue == "nameleave") {
                        $("#text-search-leave").show();
                        $("#select-filter-date-leave").hide();
                    } else if (filterleaveValue == "dateleave") {
                        $("#select-filter-date-leave").show();
                        $("#text-search-leave").hide();
                    } 
        });  

      $('#search-paid-collectibles').keyup(function(e){  
            var txtSearch = $(this).val();
            console.log(txtSearch);
            $.ajax({ 
                url:"parsers/searchpaidcollectibles.php",  
                method:"post",  
                data:{search:txtSearch},  
                dataType:"text",  
                success:function(data) {
                    $('#paid-collectibles-search-result').html(data); 
                }  
            });
       });  

      $(function () {
            $("#importPayrollFile, #import-payroll-sheet-number").bind("propertychange change click keyup input paste", function () {      
              if ($("#importPayrollFile").val() != "" && $("#import-payroll-sheet-number").val() != "")
                  $('#importPayrollBtn').removeAttr('disabled');
              else
                  $('#importPayrollBtn').attr('disabled', 'disabled');    
              });
        });

        $('#search-payroll-from').change(function(e){  
               var txtSearchFrom = $(this).val();
               var txtSearchTo = $('#search-payroll-to').val();
            if(txtSearchTo != "") {
                $.ajax({ 
                    url:"parsers/searchpayroll.php",  
                    method:"post",  
                    data:{search1:txtSearchFrom,search2:txtSearchTo},  
                    dataType:"text",  
                    success:function(data) {
                        $('#payroll-search-result').html(data); 
                    }  
                });

            }

          });  

        $('#search-payroll-to').change(function(e){  
               var txtSearchTo = $(this).val();
               var txtSearchFrom = $('#search-payroll-from').val();
            if(txtSearchFrom != "") {
                $.ajax({ 
                    url:"parsers/searchpayroll.php",  
                    method:"post",  
                    data:{search1:txtSearchFrom,search2:txtSearchTo},  
                    dataType:"text",  
                    success:function(data) {
                        $('#payroll-search-result').html(data); 
                    }  
                });

            }

          });

        $("#select-filter").change(function () { //ITO
            var filterValue = $("#select-filter").val();
            if (filterValue == "name") {
                $("#select-filter-search").show();
                $("#select-filter-status").hide();
            } else if (filterValue == "status") {
                $("#select-filter-status").show();
                $("#select-filter-search").hide();
            }
        });

        $("#payrollType").change(function () { 
                console.log($("#payrollType").val());      
                if ($("#payrollType").val() == "1") {
                    $('#payrollToDiv').show();
                    if ($("#payrollTo").val() == "2") {
                        $('#payrollEmpIDDiv').show();
                    } else {
                        $('#payrollEmpIDDiv').hide();
                    }
                    $('#payrollMonthDiv').show();
                    $('#payrollCycleDiv').show();
                    $('#payrollYearDiv').show();
                } else if ($("#payrollType").val() == "2") {
                    $('#payrollToDiv').show();
                    $('#payrollMonthDiv').hide();
                    $('#payrollCycleDiv').hide();
                    $('#payrollYearDiv').show();
                }
        });

        $("#payrollTo").change(function () {    
                if ($("#payrollTo").val() == "2") {
                    $('#payrollEmpIDDiv').show();
                } else {
                    $('#payrollEmpIDDiv').hide();
                }
        });

        function generatePaySlipPage() {
            var type = _("payrollType").value;
            var to = _("payrollTo").value;
            var empid = _("payrollEmpID").value;
            var month = _("payrollMonth").value;
            var cycle = _("payrollCycle").value;
            var year = _("payrollYear").value;
            var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
            var status = _("paySlipPageStatus");
            var button = _("paySlipPageBtn");
            if(type == "1") {
                if(to == "1") {
                    if (month == "" || cycle == "" || year == "") {
                        status.innerHTML = error;
                    } else {
                        window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip&type="+type+"&to="+to+"&empid=0&month="+month+"&cycle="+cycle+"&year="+year;
                    }
                } else if(to == "2") {
                    if (empid == "" || month == "" || cycle == "" || year == "") {
                        status.innerHTML = error;
                    } else {
                        window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip&type="+type+"&to="+to+"&empid="+empid+"&month="+month+"&cycle="+cycle+"&year="+year;
                    }
                }
            } else if(type == "2" || type == "3") {
                if(to == "1") {
                    if (year == "") {
                        status.innerHTML = error;
                    } else {
                        window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip&type="+type+"&to="+to+"&empid=0&month=0&cycle=0&year="+year;
                    }
                } else if(to == "2") {
                    if (empid == "" || year == "") {
                        status.innerHTML = error;
                    } else {
                        window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=payslip&type="+type+"&to="+to+"&empid="+empid+"&month=0&cycle=0&year="+year;
                    }
                }
            } else {
                status.innerHTML = error;
            }
        }

        function showModalViewDeduction(tax, pagibig, sss, philhealth) {
            $("#viewDeductions").modal("show");
            _("viewdedtax").innerHTML = "₱"+tax;
            _("viewdedpagibig").innerHTML = "₱"+pagibig;
            _("viewdedsss").innerHTML = "₱"+sss;
            _("viewdedphilhealth").innerHTML = "₱"+philhealth;
        }

        $('#search-employee').keyup(function(e){  
            var txtSearch = $(this).val();
            console.log(txtSearch);
            $.ajax({ 
                url:"parsers/searchemployee.php",  
                method:"post",  
                data:{search:txtSearch,type:"1"},  
                dataType:"text",  
                success:function(data) {
                    $('#employee-search-result').html(data); 
                }  
            });
        });

        $('#search-cash-advance-loan').keyup(function(e){  
            var txtSearch = $(this).val();
            console.log(txtSearch);
            $.ajax({ 
                url:"parsers/searchcashadvanceloan.php",  
                method:"post",  
                data:{search:txtSearch},  
                dataType:"text",  
                success:function(data) {
                    $('#cash-advance-loan-search-result').html(data); 
                }  
            });
        });

        $('#select-status').change(function(e){  
            var txtSearch = $("#select-status").val();
            $.ajax({ 
                url:"parsers/searchemployee.php",  
                method:"post",  
                data:{search:txtSearch,type:"2"},  
                dataType:"text",  
                success:function(data) {
                    $('#employee-search-result').html(data); 
                }  
            });
        });   

  
        $('#search-company').keyup(function(e){  
            var txtSearch = $(this).val();
            $.ajax({ 
                url:"parsers/searchcompany.php",  
                method:"post",  
                data:{search:txtSearch},  
                dataType:"text",  
                success:function(data) {
                    $('#company-search-result').html(data); 
                }  
            });
        });  

      document.getElementById("importPayrollHiddenBtn").onchange = function () {
            document.getElementById("importPayrollFile").value = this.value;
      };

      function openEditSSSContributionDialog(rid, range, amount) {
        $('#editSSSContribution').modal('show');
        _("edit-sss-contribution-id").value = rid;
        _("edit-sss-contribution-range").value = range;
        _("edit-sss-contribution-amount").value = amount;
      }
      function editSSSContributionRecord() {
        var rid = _("edit-sss-contribution-id").value;
        var amount = _("edit-sss-contribution-amount").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editSSSContributionStatus");
        var button = _("editSSSContributionBtn");
        status.innerHTML = load;
        if (rid == "" || amount == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=sss";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editssscontributionid="+rid+"&editssscontributionamount="+amount);
        }
      }
      function openEditPhilHealthContributionDialog(rid, range, amount) {
        $('#editPhilHealthContribution').modal('show');
        _("edit-philhealth-contribution-id").value = rid;
        _("edit-philhealth-contribution-range").value = range;
        _("edit-philhealth-contribution-amount").value = amount;
      }
      function editPhilHealthContributionRecord() {
        var rid = _("edit-philhealth-contribution-id").value;
        var amount = _("edit-philhealth-contribution-amount").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editPhilHealthContributionStatus");
        var button = _("editPhilHealthContributionBtn");
        status.innerHTML = load;
        if (rid == "" || amount == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=philhealth";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editphilhealthcontributionid="+rid+"&editphilhealthcontributionamount="+amount);
        }
      }
      function openEditPagibigContributionDialog(rid, range, amount) {
        $('#editPagibigContribution').modal('show');
        _("edit-pagibig-contribution-id").value = rid;
        _("edit-pagibig-contribution-range").value = range;
        _("edit-pagibig-contribution-amount").value = amount;
      }
      function editPagibigContributionRecord() {
        var rid = _("edit-pagibig-contribution-id").value;
        var amount = _("edit-pagibig-contribution-amount").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editPagibigContributionStatus");
        var button = _("editPagibigContributionBtn");
        var amountnew = amount.replace("₱","");
        amountnew = amountnew.replace(",","");
        amountnew = parseFloat(amountnew);
        status.innerHTML = load;
        if (rid == "" || amount == "") {
            status.innerHTML = error;
        } else {
            if (amountnew > 100) {
                status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Maximum contribution value is 100.</div>';
            } else {
                button.disabled = true;
                status.innerHTML = load;
                var ajax = ajaxObj("POST", "parsers/account.php");
                ajax.onreadystatechange = function() {
                  if(ajaxReturn(ajax) == true) {
                      if (ajax.responseText == "successupdate"){
                          window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=pagibig";
                      } else {
                          button.disabled = false;
                          status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                      }
                  }
                }
              ajax.send("editpagibigcontributionid="+rid+"&editpagibigcontributionamount="+amount);
            }
        }
      }
      function openEditTaxContributionDialog(rid, range, amount) {
        $('#editTaxContribution').modal('show');
        _("edit-tax-contribution-id").value = rid;
        _("edit-tax-contribution-range").value = range;
        _("edit-tax-contribution-amount").value = amount;
      }
      function editTaxContributionRecord() {
        var rid = _("edit-tax-contribution-id").value;
        var amount = _("edit-tax-contribution-amount").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editTaxContributionStatus");
        var button = _("editTaxContributionBtn");
        if (rid == "" || amount == "") {
            status.innerHTML = error;
        } else {
                button.disabled = true;
                status.innerHTML = load;
                var ajax = ajaxObj("POST", "parsers/account.php");
                ajax.onreadystatechange = function() {
                  if(ajaxReturn(ajax) == true) {
                      if (ajax.responseText == "successupdate"){
                          window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=tax";
                      } else {
                          button.disabled = false;
                          status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                      }
                  }
                }
              ajax.send("edittaxcontributionid="+rid+"&edittaxcontributionamount="+amount);
            
        }
      }

      function openAddHolidayDialog() {
        $('#addHoliday').modal('show');
      }

      function addHolidayRecord() {
        var name = _("add-holiday-name").value;
        var type = _("add-holiday-type").value;
        var date1 = _("add-holiday-date-1").value;
        var date2 = _("add-holiday-date-2").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("addHolidayStatus");
        var button = _("addHolidayBtn");
        status.innerHTML = load;
        if (name == "" || type == "") {
            status.innerHTML = error;
        } else if (type == "1" && date1 == "") {
            status.innerHTML = error;
        } else if (type == "2" && date2 == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successinsert"){
                      window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=holidays";
                  } else if (ajax.responseText == "exist"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Holiday is already exist!</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("addholidayname="+name+"&addholidaytype="+type+"&addholidaydate1="+date1+"&addholidaydate2="+date2);
        }
      }
      function openEditHolidayDialog(rid, name, type, date) {
        $('#editHoliday').modal('show');
        _("edit-holiday-id").value = rid;
        _("edit-holiday-name").value = name;
        _("edit-holiday-type").value = type;
        if(type == "1") {
            _("edit-holiday-date-1").value = date;
            $('#holidaydate5').show();
            $('#holidaydate6').hide();
        } else if(type == "2") {
            _("edit-holiday-date-2").value = date;
            $('#holidaydate5').hide();
            $('#holidaydate6').show();
        }
      }
      function editHolidayRecord() {
        var rid = _("edit-holiday-id").value;
        var name = _("edit-holiday-name").value;
        var type = _("edit-holiday-type").value;
        var date1 = _("edit-holiday-date-1").value;
        var date2 = _("edit-holiday-date-2").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editHolidayStatus");
        var button = _("editHolidayBtn");
        status.innerHTML = load;
        if (name == "" || type == "") {
            status.innerHTML = error;
        } else if (type == "1" && date1 == "") {
            status.innerHTML = error;
        } else if (type == "2" && date2 == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=holidays";
                  } else if (ajax.responseText == "exist"){
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Same data found!</div>';
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editholidayid="+rid+"&editholidayname="+name+"&editholidaytype="+type+"&editholidaydate1="+date1+"&editholidaydate2="+date2);
        }
      }
      function openEditHolidayRateDialog(rid, type, percentage) {
        $('#editHolidayRate').modal('show');
        _("edit-holiday-rate-type").value = type;
        _("edit-holiday-rate-id").value = rid;
        _("edit-holiday-rate-percentage").value = percentage;
      }
      function editHolidayRateRecord() {
        var rid = _("edit-holiday-rate-id").value;
        var percent = _("edit-holiday-rate-percentage").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editHolidayRateStatus");
        var button = _("editHolidayRateBtn");
        status.innerHTML = load;
        if (rid == "" || percent == "") {
            status.innerHTML = error;
        } else if (parseInt(percent) < 1 || parseInt(percent) > 100) {
            status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Rate must be between 1 and 100.</div>';
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=holidayrate";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("editholidayrateid="+rid+"&editholidayratepercent="+percent);
        }
      }
      function openDeleteHolidayDialog(rid) {
        $('#deleteHoliday').modal('show');
        _("delete-holiday-id").value = rid;
      }
      function deleteHolidayRecord() {
        var rid = _("delete-holiday-id").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("deleteHolidayStatus");
        var button = _("deleteHolidayBtn");
        status.innerHTML = load;
        if (rid == "") {
            status.innerHTML = error;
        } else {
            button.disabled = true;
            status.innerHTML = load;
            var ajax = ajaxObj("POST", "parsers/account.php");
            ajax.onreadystatechange = function() {
              if(ajaxReturn(ajax) == true) {
                  if (ajax.responseText == "successupdate"){
                      window.location = "account.php?id=<?php echo $id; ?>&payroll=focus&action=holidays";
                  } else {
                      button.disabled = false;
                      status.innerHTML = '<div style="color: red; margin-bottom: 10px;">Unknown error! Error Details: '+ ajax.responseText +'</div>';
                  }
              }
            }
          ajax.send("deleteholidayid="+rid);
        }
      }

      function generateSummaryPayroll() {
            var month = _("summaryPayrollMonth").value;
            var cycle = _("summaryPayrollCycle").value;
            var year = _("summaryPayrollYear").value;
            if (month == "" || cycle == "" || year == "") {
               _("summaryPayrollStatus").innerHTML = '<div style="color: red; margin-bottom: 10px;">Incomplete parameters!</div>';
            } else {
              window.open("summarypayroll.php?month="+ month +"&cycle="+ cycle +"&year="+ year, '_blank');
            }
      }

      function generateContributionPayroll() {
            var month = _("summaryContributionMonth").value;
            var year = _("summaryContributionYear").value;
            if (month == "" || year == "") {
               _("summaryContributionStatus").innerHTML = '<div style="color: red; margin-bottom: 10px;">Incomplete parameters!</div>';
            } else {
              window.open("summarycontribution.php?month="+ month +"&year="+ year, '_blank');
            }
      }

      function goBack() {
        window.history.back();
      }

    </script>
</body>

</html>
