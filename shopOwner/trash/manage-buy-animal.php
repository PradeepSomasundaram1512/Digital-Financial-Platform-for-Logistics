<?php 
    define('DIR','../');
    require_once DIR . 'config.php';
    $admin = new Admin();

    if(!isset($_SESSION['userID'])){
	    $admin -> redirect('../admin/login');
    }
    $rowcount = 0;
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
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>$('#myModal').on('shown.bs.modal', function() {
  $('#myInput').focus()
})</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<!--JS below-->

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
            <h5 class="m-0">Manage Buy Animal's</h5>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Animal's</li>
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
            <th scope="col">User Name</th>
            <th scope="col">Category</th>

            <th scope="col">Price</th>
            <th scope="col">Image</th>
            <th width="100" scope="col" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

        <?php 
          $stmt = $admin -> ret("SELECT * FROM `sellAnimal` where `sellAnimalStatusID` != 4 ");
          while($rows = $stmt -> fetch(PDO::FETCH_ASSOC)){
            $rowcount = $stmt ->rowCount();

            $sellAnimalCategoryID = $rows['sellAnimalCategoryID'];
            $userID = $rows['userID'];
            
            $stmts = $admin -> ret("SELECT * FROM `users` where `userID` = '$userID'");
            $row = $stmts -> fetch(PDO::FETCH_ASSOC);

            $stmtc = $admin -> ret("SELECT * FROM `animalCategory` where `animalCategoryID` = '$sellAnimalCategoryID'");
            $rowc = $stmtc -> fetch(PDO::FETCH_ASSOC);

            $sellAnimalPrice = $rows['sellAnimalPrice'];
            $sellAnimalStatusID = $rows['sellAnimalStatusID'];
        ?>
  <tr>
    <td><?php echo $row['userName'] ?></td>
    <td><?php echo $rowc['animalCategoryName'] ?></td>
    <td><?php echo $rows['sellAnimalPrice'] ?>/-</td>
    <td><img src="../user/usercontroller/animalImage/<?php echo $rows['sellAnimalImage']  ?>" height="100px" max-width="200px"></td>

    <td>
        <a class="btn btn-primary btn-sm" href="view-buy-animal.php?sellAnimalID=<?php echo $rows['sellAnimalID'] ?>">VIEW</a>
        <?php 
          if($sellAnimalStatusID < 2 ){ 
            ?>
        <a class="btn btn-success btn-sm" href="admincontroller/manage-buy-animal.php?acceptSellAnimalID=<?php echo $rows['sellAnimalID'] ?>">Accept</a>
        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal<?php echo $rows['sellAnimalID'] ?>" >Reject</button> 
          <?php } ?>
           <?php 
         if( $sellAnimalStatusID == 2  ){
          if ($sellAnimalStatusID != 5 ) {
            ?> 
        <a class="btn btn-success btn-sm" href="manage-UPI.php?sellAnimalID=<?php echo $rows['sellAnimalID'] ?>">Pay Now</a>
      <?php  } }

          if($sellAnimalStatusID == 5 ){ 
            if($sellAnimalStatusID != 3){
            ?> 
        <a class="btn btn-success btn-sm" href="admincontroller/manage-buy-animal.php?deliveried=<?php echo $rows['sellAnimalID'] ?>">Delivered</a>
        <?php } } ?>

        
        <div class="modal fade" id="exampleModal<?php echo $rows['sellAnimalID'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Select "Reject" below if you want to delete this record .</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-danger" href="admincontroller/manage-buy-animal.php?rejectSellAnimalID=<?php echo $rows['sellAnimalID'] ?>">Reject</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </tr>
   
  </tr>
 
  <?php
}
    
  ?>
  <?php
        if ($rowcount == 0) {
                            ?>
                            <tr>
                                <td colspan="100%" class="alert alert-danger text-center">
                                    No records
                                </td>
                            </tr>
                        <?php } ?>
  </tbody>
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
<script>
var options = {
    "key": "rzp_test_1kJUPehOrSmSWJ", // Enter the Key ID generated from the Dashboard
    "amount": "<?php echo $sellAnimalPrice*100; ?>", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "The Pet's Emporium",
    "description": "Online Payment",
    "image": "https://incevio.com/storage/images/79Kx4XS1MriIJPYzX9uCSpf9pKt8vPr2ZslrmbQ1.png", 
    "id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){
        alert('Your payment is successful !!');
      window.location.href='admincontroller/manage-buy-animal.php'
    },
    "prefill": {
        "name": "<?php echo $row['userName']; ?>",
        "email": "<?php echo $row['userEmail']; ?>",
        "contact": "9288837298"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
rzp1.on('payment.failed', function (response){
        alert(response.error.code);
        alert(response.error.description);
        alert(response.error.source);
        alert(response.error.step);
        alert(response.error.reason);
        alert(response.error.metadata.order_id);
        alert(response.error.metadata.payment_id);
});
document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>
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
