<?php include_once( 'includes/top.php'); 


    if(count($_POST) > 0)
    {  

            //getting the post values
            $name                 = $_POST['name'];
            $emp_id               = $_POST['emp_id'];
            $designation          = $_POST['designation'];
            $email                = $_POST['email'];
            $degree_certificate   = $_FILES["degree_certificate"]["name"];
            $passport_copy        = $_FILES["passport_copy"]["name"];
            $resume               = $_FILES["resume"]["name"];


        $select = mysqli_query($conn, "SELECT `email` FROM `employee` WHERE `email` = '".$_POST['email']."'") or exit(mysqli_error($conn));
        if(!mysqli_num_rows($select)) {


            $file_validation = 1;

            foreach ($_FILES as $key => $value) {
                $extension = substr($value['name'],strlen($value['name'])-4,strlen($value['name']));
                $allowed_extensions = array(".pdf",".word",".excel",".doc",".docx");
                if(!in_array($extension,$allowed_extensions))
                {
                    echo "<script>alert('Invalid format. Only pdf / excel / word format allowed');</script>";
                    $file_validation = 0;
                }
            }
            

            if($file_validation) {

                $curr           = date("Y-m-d H:i:s");
                $today          = date("Y-m-d");
                $query = "INSERT INTO employee SET 
                        name            = '".$name."',
                        employee_id     = '".$emp_id."',
                        designation     = '".$designation."',
                        email           = '".$email."',
                        created_at      = '".$curr."',
                        updated_at      = '".$curr."' ";

                $rows       = mysqli_query($conn,$query);
                $last_id    = mysqli_insert_id($conn);

                if($last_id) {

                    foreach ($_FILES as $f_key => $data) {
                            // Rename the image file
                            $imgnewfile=md5($data['name']).time().$extension;
                            // Code for move image into directory
                            move_uploaded_file($data["tmp_name"],"../assets/attachments/".$imgnewfile);
                            // Query for data insertion
                            
                             $doc_query = "INSERT INTO employee_details SET 
                                emp_id        = '".$last_id."',
                                file_name     = '".$imgnewfile."',
                                file_path     = 'http://localhost/emp_portal/assets/attachments',
                                created_date  = '".$today."',
                                created_at    = '".$curr."',
                                updated_at    = '".$curr."' ";
                             $exe = mysqli_query($conn, $doc_query);
                            
                        }
                    echo "<script>alert('Employee Created Successfully!!!');</script>";
                    echo "<script type='text/javascript'> document.location ='http://localhost/emp_portal/index.php'; </script>";
                } else {
                    echo "<script>alert('Something Went Wrong. Please try again');</script>";
                }
            }

        } else {
            echo "<script>alert('Entered email id already exist. Please try another');</script>";
        }
    }
    
?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add Employee</h1>

    <form class="user" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Employee Name </label>
                <input type="text" class="form-control form-control-user" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" id="name" name="name" placeholder="Employee Name"  required="" oninvalid="this.setCustomValidity('Please Enter Employee Name')" oninput="setCustomValidity('')">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Employee Id </label>
                <input type="text" class="form-control form-control-user" value="<?php if(isset($_POST['emp_id'])) { echo $_POST['emp_id']; }  ?>" id="emp_id" name="emp_id" placeholder="Enter Employee Id"  required="" oninvalid="this.setCustomValidity('Please Enter Employee Id')" oninput="setCustomValidity('')">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Designation </label>
                <input type="text" class="form-control form-control-user" value="<?php if(isset($_POST['designation'])) { echo $_POST['designation']; }  ?>" id="designation" name="designation" placeholder="Employee designation" pattern="[A-Za-z]+" required="" oninvalid="this.setCustomValidity('Please Enter Employee Designation')" oninput="setCustomValidity('')">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label> Email </label>
                <input type="email" class="form-control form-control-user" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; }  ?>" id="email" name="email" placeholder="Email Address" required="" oninvalid="this.setCustomValidity('Please Enter Employee Email Address')" oninput="setCustomValidity('')">
            </div>
        </div>
        <h1 class="h3 mb-4 text-gray-800">Documents  </h1> <label>Attachments Should be in pdf/excel/word Format </label>

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