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
    && !isset($_GET["settings"])     
    )

// IF ADMIN LEVEL
  || (isset($_GET["dashboard"]) && trim($_GET["dashboard"]) != "focus") 
  
  || (isset($_GET["ageing"]) && trim($_GET["ageing"]) != "focus")  

  || (isset($_GET["employee"]) && trim($_GET["employee"]) != "focus") 

  || (isset($_GET["payroll"]) && trim($_GET["payroll"]) != "focus") 

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
} else if (isset($_GET["payroll"]) && isset($_GET["add"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["add"]) == "payroll"){
  $pheading = "Upload Payroll"; 
} else if (isset($_GET["payroll"]) && isset($_GET["view"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["view"]) == "payroll"){
  $pheading = "View Payroll"; 
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
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Payroll<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&add=payroll">Import Payroll</a>
                                </li>
                                <li>
                                    <a href="account.php?id=<?php echo $id; ?>&payroll=focus&view=payroll">View Payroll</a>
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
                                                <input type="text" class="form-control" name="date" id="add-collectibles-invoice-date" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label">Maturity Date</label>
                                              <div class="input-group date" id="datePicker2">
                                                <input type="text" class="form-control" name="date" id="add-collectibles-maturity-date" />
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
                                                <input type="text" class="form-control" name="date" id="add-collectibles-delivery-date" />
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
                                                <input type="text" class="form-control" name="date" id="add-collectibles-or-date" />
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
                                        <table class="table table-striped">
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
                                        <table class="table table-striped">
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
                                        <table class="table table-striped">
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
                        <div class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&employee=focus&view=employee">View Employee</a></div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="col-md-6 col-md-offset-3">
                                        <form role="form" onsubmit="return false;">
                                            <span id="addEmployeeStatus"></span>
                                            <div class="form-group">
                                                <label class="control-label">Name</label>
                                                <input type="text" class="form-control" id="add-employee-name" placeholder="">
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
                                              <div class="input-group date" id="datePicker1">
                                                <input type="text" class="form-control" name="date" id="add-employee-birthday" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" class="form-control" id="add-employee-contact" placeholder="">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <input type="text" class="form-control" id="add-employee-address" placeholder="">
                                            </div>
                                            <div class="form-group">
                                              <label class="control-label">Date Hired</label>
                                              <div class="input-group date" id="datePicker2">
                                                <input type="text" class="form-control" name="date" id="add-employee-hired-date" />
                                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                              </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="addEmployeeBtn" style="width: 100%;" onclick="addEmployeeRecord()">ADD</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
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
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&employee=focus&add=employee">Add Employee</a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="date" placeholder="Search Employee" id="search-employee"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-search"></span></span>
                                        </div>
                                        <hr>
                                        <div id="employee-search-result">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Employee ID</th>
                                                    <th>Name</th>
                                                    <th>Gender</th>
                                                    <th>Date of Birth</th>
                                                    <th>Phone</th>
                                                    <th>Address</th>
                                                    <th>Date Hired</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT * FROM hurtajadmin_employee WHERE employee_status = '1' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $recid = $row["id"];
                                                    $empid = $row["employee_id"];
                                                    $name = $row["employee_name"];
                                                    $gender = $row["employee_gender"];
                                                    $birthday = $row["employee_birthday"];
                                                    $address = $row["employee_address"];
                                                    $contact = $row["employee_phone"];
                                                    $datehired = $row["employee_date_hired"];

                                                    $editbirthday = date("m/d/Y", strtotime($birthday));
                                                    $editdatehired = date("m/d/Y", strtotime($datehired));

                                                    $birthday = date("F d, Y", strtotime($birthday));
                                                    $datehired = date("F d, Y", strtotime($datehired));
                                                    
                                                    $gendertext = "";

                                                    if($gender == "1") {
                                                        $gendertext = "Male";
                                                    } else if($gender == "2") {
                                                        $gendertext = "Female";
                                                    }

                                                    echo '
                                                    <tr>
                                                    <td>'.$empid.'</td>
                                                    <td>'.$name.'</td>           
                                                    <td>'.$gendertext.'</td>
                                                    <td>'.$birthday.'</td>
                                                    <td>'.$address.'</td>
                                                    <td>'.$contact.'</td>
                                                    <td>'.$datehired.'</td>
                                                    <td>Payroll Settings | <a href="javascript:void(0)" onclick="openEmployeeEditDialog('.$recid.',\''.$name.'\',\''.$gender.'\',\''.$editbirthday.'\',\''.$address.'\',\''.$contact.'\',\''.$editdatehired.'\')">Edit</a> | <a href="javascript:void(0)" onclick="openEmployeeDeleteDialog('.$recid.')">Delete</a></td>
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
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["add"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["add"]) == "payroll") { ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&view=payroll">View Payroll</a></div>
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
            <?php } else if (isset($_GET["payroll"]) && isset($_GET["view"]) && trim($_GET["payroll"]) == "focus" && trim($_GET["view"]) == "payroll") { ?>
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><?php echo $pheading; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading"><a type="button" class="btn btn-danger" href="account.php?id=<?php echo $id; ?>&payroll=focus&add=payroll">Import Payroll</a></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <div class="input-group date" id="datePicker1">
                                            <input type="text" class="form-control" name="date" placeholder="Search from date (Pay Period)" id="search-payroll-from" autocomplete="off"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <br>
                                        <div class="input-group date" id="datePicker2">
                                            <input type="text" class="form-control" name="date" placeholder="Search to date (Pay Period)" id="search-payroll-to" autocomplete="off"/>
                                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                        <hr>
                                        <div id="payroll-search-result">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Pay Period</th>
                                                    <th>Date Added</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT DISTINCT payroll_payperiod_1, payroll_payperiod_2 FROM hurtajadmin_payroll WHERE payroll_status = '1' ORDER BY id DESC";
                                                $query = mysqli_query($db_conn, $sql);
                                                $count = 0;
                                                while($row = mysqli_fetch_array($query)) {  
                                                    $count++; 
                                                    $payperiod1 = $row["payroll_payperiod_1"];
                                                    $payperiod2 = $row["payroll_payperiod_2"];

                                                    $sql1 = "SELECT * FROM hurtajadmin_payroll WHERE payroll_payperiod_1 = '$payperiod1' AND payroll_payperiod_2 = '$payperiod2' AND payroll_status = '1' LIMIT 1";
                                                    $query1 = mysqli_query($db_conn, $sql1);
            
                                                    while($row1 = mysqli_fetch_array($query1)) {
                                                        $dateadded = $row1["payroll_date_added"];
                                                    }  

                                                    $payperiod1 = date("F d, Y", strtotime($payperiod1));
                                                    $payperiod2 = date("F d, Y", strtotime($payperiod2));
                                                    $dateadded = date("F d, Y", strtotime($dateadded));

                                                    echo '
                                                    <tr>
                                                    <td>'.$count.'</td>
                                                    <td>'.$payperiod1.' - '.$payperiod2.'</td>           
                                                    <td>'.$dateadded.'</td>
                                                    <td>More | Delete</td>
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
                        <table class="table table-striped">
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
                              <div class="input-group date" id="datePicker1">
                                <input type="text" class="form-control" name="date" id="edit-collectibles-invoice-date" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label">Maturity Date</label>
                          <div class="input-group date" id="datePicker2">
                            <input type="text" class="form-control" name="date" id="edit-collectibles-maturity-date" />
                            <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">DR Number</label>
                        <input type="text" class="form-control" id="edit-collectibles-dr-number" placeholder="">
                    </div>
                    <div class="form-group">
                      <label class="control-label">Delivery Date</label>
                      <div class="input-group date" id="datePicker3">
                        <input type="text" class="form-control" name="date" id="edit-collectibles-delivery-date" />
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
                  <div class="input-group date" id="datePicker4">
                    <input type="text" class="form-control" name="date" id="edit-collectibles-or-date" />
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
    <div class="modal fade bd-example-modal-sm" id="editEmployee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Employee</h5>
          </div>
          <div class="modal-body">
            <span id="editEmployeeStatus"></span>
            <input type="hidden" class="form-control" id="edit-employee-id">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form role="form" onsubmit="return false;">
                            <div class="form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" id="edit-employee-name" placeholder="">
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
                              <div class="input-group date" id="datePicker5">
                                <input type="text" class="form-control" name="date" id="edit-employee-birthday" />
                                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Phone</label>
                            <input type="text" class="form-control" id="edit-employee-contact" placeholder="">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Address</label>
                            <input type="text" class="form-control" id="edit-employee-address" placeholder="">
                        </div>
                        <div class="form-group">
                          <label class="control-label">Date Hired</label>
                          <div class="input-group date" id="datePicker6">
                            <input type="text" class="form-control" name="date" id="edit-employee-hired-date" />
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
            <button type="button" class="btn btn-primary" id="editEmployeeBtn" onclick="editEmployeeRecord()">Update</button>
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
        var name = _("add-employee-name").value;
        var gender = _("add-employee-gender").value;
        var birthday = _("add-employee-birthday").value;
        var contact = _("add-employee-contact").value;
        var address = _("add-employee-address").value;
        var hired = _("add-employee-hired-date").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("addEmployeeStatus");
        var button = _("addEmployeeBtn");
        status.innerHTML = load;
        if (name == "" || gender == "" || birthday == "" || contact == "" || address == "" || hired == "") {
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
          ajax.send("addemployeename="+name+"&addemployeegender="+gender+"&addemployeebirthday="+birthday+"&addemployeecontact="+contact+"&addemployeeaddress="+address+"&addemployeehired="+hired);
        }
      }

      function openEmployeeEditDialog(rid, name, gender, birthday, address, contact, datehired) {
        $('#editEmployee').modal('show');
        _("edit-employee-id").value = rid;
        _("edit-employee-name").value = name;
        _("edit-employee-gender").value = gender;
        _("edit-employee-birthday").value = birthday;
        _("edit-employee-address").value = address;
        _("edit-employee-contact").value = contact;
        _("edit-employee-hired-date").value = datehired;
      }

      function editEmployeeRecord() {
        var rid = _("edit-employee-id").value;
        var name = _("edit-employee-name").value;
        var gender = _("edit-employee-gender").value;
        var birthday = _("edit-employee-birthday").value;
        var address = _("edit-employee-address").value;
        var contact = _("edit-employee-contact").value;
        var datehired = _("edit-employee-hired-date").value;
        var load = '<center><i class="fa fa-circle-o-notch fa-spin" style="color: #999; margin-bottom: 10px;"></i><center>';
        var error = '<div style="color: red; margin-bottom: 10px;">Incomplete Parameters.</div>';
        var status = _("editCompanyStatus");
        var button = _("editCompanyBtn");
        status.innerHTML = load;
        if (rid == "" || name == "" || gender == "" || birthday == "" || address == "" || contact == "" || datehired == "") {
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
          ajax.send("editemployeeid="+rid+"&editemployeename="+name+"&editemployeegender="+gender+"&editemployeebirthday="+birthday+"&editemployeeaddress="+address+"&editemployeecontact="+contact+"&editemployeedatehired="+datehired);
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

        $('#search-employee').keyup(function(e){  
            var txtSearch = $(this).val();
            console.log(txtSearch);
            $.ajax({ 
                url:"parsers/searchemployee.php",  
                method:"post",  
                data:{search:txtSearch},  
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


    </script>
</body>

</html>
