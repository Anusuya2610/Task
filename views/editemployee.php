



<?php include_once( 'includes/top.php'); 


 // Check existence of id parameter before processing further
    if(isset($_GET["editid"]) && !empty(trim($_GET["editid"]))){
        // Include config file
        
        // Prepare a select statement
        $query = "SELECT * FROM employee WHERE id = '".$_GET['editid']."' ";
        $exe   = mysqli_query($conn, $query);
        $data  = mysqli_fetch_array($exe);


       if(!mysqli_num_rows($exe) > 0) {
            echo "<script>alert('Employee not fount try again later !!!');</script>";
            echo "<script>window.location.href='http://localhost/emp_portal/index.php'</script>";
       }
        
    } else{
        
    }


    
    
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Employee</h1>

    <form class="user" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Employee Name </label>
                <input type="text" class="form-control form-control-user" value="<?php echo $data['name']; ?>" id="name" name="name" placeholder="Employee Name"  required="" oninvalid="this.setCustomValidity('Please Enter Employee Name')" oninput="setCustomValidity('')">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Employee Id </label>
                <input type="text" class="form-control form-control-user" value="<?php  echo $data['employee_id']; ?>" id="emp_id" name="emp_id" placeholder="Enter Employee Id"  required="" oninvalid="this.setCustomValidity('Please Enter Employee Id')" oninput="setCustomValidity('')">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Designation </label>
                <input type="text" class="form-control form-control-user" value="<?php  echo $data['designation']; ?>" id="designation" name="designation" placeholder="Employee designation" pattern="[A-Za-z]+" required="" oninvalid="this.setCustomValidity('Please Enter Employee Designation')" oninput="setCustomValidity('')">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Email </label>
                <input type="email" class="form-control form-control-user" value="<?php  echo $data['email']; ?>" id="email" name="email" placeholder="Email Address" required="" oninvalid="this.setCustomValidity('Please Enter Employee Email Address')" oninput="setCustomValidity('')">
            </div>
        </div>
        <h1 class="h3 mb-4 text-gray-800">Documents </h1> <label>Attachments Should be in pdf/excel/word Format </label>  
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Degree certificate </label>
                <input type="file" class="form-control form-control-file form-control-range" name="degree_certificate" placeholder="Email Address" required="" oninvalid="this.setCustomValidity('Please Choose Degree Certificate ')" oninput="setCustomValidity('')">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Resume </label>
                <input type="file" class="form-control form-control-file form-control-range" name="resume" placeholder="Email Address" required="" oninvalid="this.setCustomValidity('Please Choose Resume  ')" oninput="setCustomValidity('')">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Passport Copy</label>
                <input type="file" class="form-control form-control-file form-control-range" name="passport_copy" placeholder="Email Address" required="" oninvalid="this.setCustomValidity('Please Choose Passport Copy ')" oninput="setCustomValidity('')">
            </div>
        </div>
        <input type="submit" name="submit" value="Add Employee" class="btn btn-primary btn-user btn-block">
    </form>

</div>


<?php include_once( 'includes/bottom.php') ?>