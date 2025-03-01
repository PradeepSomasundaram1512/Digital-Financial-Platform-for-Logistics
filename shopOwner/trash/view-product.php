<?php 
    define('DIR','../');
    require_once DIR . 'config.php';
    $admin = new Admin();

    if(!isset($_SESSION['userID'])){
	    $admin -> redirect('../admin/login');
    }

    if(isset($_GET['productID'])){
      $productID = $_GET['productID'];
    }
    elseif(isset($_SESSION['productID'])){
      $productID = $_SESSION['productID'];
    }
    else{
      header("location:manage-product.php");
    }
    
    $stms = $admin->ret("SELECT * FROM `product` WHERE `productID` = '$productID'");
    $row = $stms->fetch(PDO::FETCH_ASSOC);
    $productCategoryID = $row['productCategoryID'];

    $stmt = $admin->ret("SELECT * FROM `productCategory` WHERE `productCategoryID` = '$productCategoryID'");
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>THE PET'S EMPORIUM</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
   

  <!-- Navbar -->
  <?php include 'include/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

   <?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">View Products </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">View Products </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid"> <hr />

 <table class="table">
  <thead class="thead-dark">
    <tr>
      <td scope="col">Name</td>
      <td><?php echo $row['productName'] ?></td>
    </tr>
    <tr>
      <td scope="col">Image</td>
      <td><img src="admincontroller/productImage/<?php echo $row['productImage']  ?>" height="100px" max-width="200px"></td>
    </tr>
    <tr>
      <td scope="col">Category</td>
      <td><?php echo $rows['productCategoryName'] ?></td>
    </tr>
    <tr>
      <td scope="col">Position</td>
      <td><?php echo $row['productPosition'] ?></td>
    </tr>
    <tr>
      <td scope="col">Description</td>
      <td><?php echo $row['productDescription'] ?></td>
    </tr>
    <tr>
      <td scope="col">MRP Price</td>
      <td><?php echo $row['productMRP'] ?>/-</td>
    </tr>
    <tr>
      <td scope="col">Selling Price</td>
      <td><?php echo $row['productSellingPrice'] ?>/-</td>
    </tr>
    <tr>
      <td scope="col">Stock</td>
      <td><?php echo $row['productQuantity'] ?></td>
    </tr>
    <tr>
      <td scope="col">Action</td>
      <td><a class="btn btn-secondary btn-sm" href="update-product.php?productID=<?php echo $row['productID'] ?>">EDIT</a></td>
    </tr>

  </thead>
  <tbody>
</table>



    


      
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include 'include/footer.php'; ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="plugins/raphael/raphael.min.js"></script>
<script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
</body>
</html>
