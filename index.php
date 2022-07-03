<?php

//including the database connection file
include("config/dbconnection.php");
$_POST = array();

if(isset($_GET['delid']))
  {
    $delid = $_GET['delid'];
    $query = "DELETE FROM employee WHERE id='".$delid."' ";
    $exe = mysqli_query($conn,$query);
    $att_query = "DELETE FROM employee_details WHERE emp_id='".$delid."' ";
    $att_exe = mysqli_query($conn,$att_query);
    echo "<script>alert('Record Deleted successfully');</script>";
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Employees List</title>

    <!-- Custom fonts for this template-->
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once( 'views/includes/sidebar.php')?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once( 'views/includes/header.php')?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <a class="btn btn-primary" href="http://localhost/emp_portal/views/addemployee.php" style="float: right;" > Add Employee</a>
                    <h1 class="h3 mb-4 text-gray-800">Employees List</h1>


                    <p style="font-size:16px; color:red" align="center"></p>

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                            <tr>
                                <th>S no.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Designation</th>
                                <th>Employee Code</th>
                                <th>Action</th>
                            </tr>

                            <?php $ret=mysqli_query($conn, "SELECT * FROM employee"); $cnt=1; while ($row=mysqli_fetch_array($ret)) { ?>

                            	<tr>
	                                <td>
	                                    <?php echo $cnt;?>
	                                </td>
	                                <td>
	                                    <?php echo ucfirst($row['name']);?>
	                                </td>
	                                <td>
	                                    <?php echo $row['email'];?>
	                                </td>
	                                <td>
	                                    <?php echo $row['designation'];?>
	                                </td>
	                                <td>
	                                    <?php echo $row['employee_id'];?>
	                                </td>
	                                <td>
	                                	<a href="http://localhost/emp_portal/views/editemployee.php?editid=<?php echo $row['id'];?>" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a> |
	                                	<a href="http://localhost/emp_portal/views/employeedetails.php?editid=<?php echo $row['id'];?>" data-toggle="tooltip" title="View Details"><i class="fas fa-eye"></i></a> |
                                    	<a href="http://localhost/emp_portal/index.php?delid=<?php echo $row['id'];?>" data-toggle="tooltip" title="Delete!" onclick="return confirm('Do you really want to delete');" style="color:red"><i class="fas fa-trash-alt"></i></a>
                                	</td>
	                            <tr>
                            <?php $cnt=$cnt+1; } ?>

                            <?php if(!mysqli_num_rows($ret) > 0) { ?>
                            	<tr>
                            		<td colspan="6" style="text-align: center;">
                            			No Record Found!
                            		</td>
                            	</tr>
                            <?php } ?>

                        </table>

                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="assets/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>
