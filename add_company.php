<link rel="stylesheet" href="assets/css/popup_style.css"> 
           <style>
.footer1 {
  position: fixed;
  bottom: 0;
  width: 100%;
  color: #5c4ac7;
  text-align: center;
}

</style>
<?php include './constant/layout/head.php'; ?>


<?php
session_start();

// Assuming you have already established a database connection
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "store1";
$con = mysqli_connect($localhost, $username, $password, $dbname);

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $regNo = $_POST['reg_no'];
    $companyName = $_POST['c_name'];
    $companyAddress = $_POST['c_address'];
    $companyCity = $_POST['c_city'];
    $companyPhNo = $_POST['c_phno'];
    $companyEmail = $_POST['c_email'];
    $listingStatus = $_POST['listing_status'];
    $companyGstNo = $_POST['c_gst_no'];
    $companyDescription = $_POST['c_description'];
    $ownerName = $_POST['owner_name'];

    // Handle file uploads
    $ownerPhoto = $_FILES['owner_photo']['name'];
    $ownerSignPhoto = $_FILES['owner_sign_photo']['name'];
    $companyLogo = $_FILES['company_logo']['name'];

    $targetDirectory = './company_details/';
    $ownerPhotoTarget = $targetDirectory . basename($ownerPhoto);
    $ownerSignPhotoTarget = $targetDirectory . basename($ownerSignPhoto);
    $companyLogoTarget = $targetDirectory . basename($companyLogo);

    // Move uploaded files to the target directory
    if (
        move_uploaded_file($_FILES['owner_photo']['tmp_name'], $ownerPhotoTarget) &&
        move_uploaded_file($_FILES['owner_sign_photo']['tmp_name'], $ownerSignPhotoTarget) &&
        move_uploaded_file($_FILES['company_logo']['tmp_name'], $companyLogoTarget)
    ) {
        // Files uploaded successfully
        $insertQuery = "INSERT INTO `company` (`reg_no`, `c_name`, `c_address`, `c_city`, `c_phno`, `c_email`, `listing_status`, `c_gst_no`, `c_description`, `owner_name`, `owner_photo`, `owner_sign_photo`, `company_logo`) 
        VALUES ('$regNo', '$companyName', '$companyAddress', '$companyCity', '$companyPhNo', '$companyEmail', '$listingStatus', '$companyGstNo', '$companyDescription', '$ownerName', '$ownerPhoto', '$ownerSignPhoto', '$companyLogo')";

        // Execute the insert query
        $result = mysqli_query($con, $insertQuery);

        if ($result) {
            // Company added successfully
            echo "Company added successfully!";
            
            // Create a login entry
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            
            $insertLoginQuery = "INSERT INTO `users` (`username`, `password`, `email`, `company_id`) 
            VALUES ('$username', '$password', '$companyEmail', '$regNo')";
            
            $loginResult = mysqli_query($con, $insertLoginQuery);
            
            if ($loginResult) {
                // Login entry added successfully
                echo "Login entry added successfully!";
            } else {
                // Failed to add login entry
                echo "Failed to add login entry: " . mysqli_error($con);
            }
        } else {
            // Failed to add company
            echo "Failed to add company: " . mysqli_error($con);
        }
    } else {
        // Failed to upload one or more files
        echo "Failed to upload files.";
    }
}
?>



    <div id="main-wrapper">
        <div class="unix-login">

            <div class="container-fluid" style="background-image: url('./assets/uploadImage/Logo/banner2.jpg');
 background-color: #cccccc;">
                <div class="row justify-content-center">
                
                    <div class="col-lg-12">
                     
                        <div class="login-content card">

                        <div class="text-center">
                        <h3 class="text-dark">Add Your Company</h3>
                      </div>
                            <div class="login-form">
                                <form action="add_company.php" method="post" id="loginForm" enctype= multipart/form-data>

                                    <div class="card p-2 m-3">
                                <div class="row">

                              
                                  


                                      <div class="form-group col-md-6">
                                        <label lass="col-sm-3 control-label">Reg No</label>
                                        <input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="reg_no" required="">
     
                                    </div>
                                 

                                  
                                    <div class="form-group col-md-6">
                                        <label lass="col-sm-3 control-label">Company Name</label>
                                        <input type="text" name="c_name" id="c_name" class="form-control" placeholder="Company Name" required="">
     
                                    </div>
                            
                           


                              
                                    <div class="form-group col-md-6">
                                        <label class="col-sm-3 control-label">Company Add</label>
                                        <textarea name="c_address" id="" cols="30" rows="20" id="c_address" class="form-control"></textarea>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label lass="col-sm-3 control-label">Company City</label>
                                        <input type="text" name="c_city" id="c_city" class="form-control" placeholder="city" required="">
     
                                    </div>               <div class="form-group col-md-6">
                                        <label lass="col-sm-3 control-label">Ph.No</label>
                                        <input type="number" name="c_phno" id="c_phno" class="form-control" placeholder="Ph.No" required="">
     
                                    </div>               <div class="form-group col-md-6">
                                        <label lass="col-sm-3 control-label">Email</label>
                                        <input type="email" name="c_email" id="c_email" class="form-control" placeholder="company email" required="">
     
                                    </div> 
                                                  <div class="form-group col-md-6">
                                        <label lass="col-sm-3 control-label">listing status</label>
                                        <select name="listing_status" id="listing_status" class="form-control" placeholder="status" required="">
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
     
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label lass="col-sm-3 control-label">Gst No</label>
                                        <input type="text" name="c_gst_no" id="c_gst_no" class="form-control" placeholder="company gst no" required="">
     
                                    </div>         
                                     <div class="form-group col-md-12">
                                        <label lass="col-sm-3 control-label">Short Description</label>
                                        <input type="text" name="c_description" id="c_description" class="form-control" placeholder="description" required="">
     
                                    </div>

                                    </div>
                                    <div class="form-group">
                                        <label lass="col-sm-3 control-label">Owner Name</label>
                                        <input type="text" name="owner_name" id="owner_name" class="form-control" placeholder="owner_name" required="">
     
                                    </div>     
                                           <div class="form-group">
                                        <label lass="col-sm-3 control-label">Owner Photo</label>
                                        <input type="file" name="owner_photo" id="owner_photo" class="form-control" placeholder="owner_photo" required="">
     
                                    </div>      
                                          <div class="form-group">
                                        <label lass="col-sm-3 control-label">Owner Sign</label>
                                        <input type="file" name="owner_sign_photo" id="owner_sign_photo" class="form-control" placeholder="owner_sign_photo" required="">
     
                                    </div>
                                    <div class="form-group">
                                        <label lass="col-sm-3 control-label">Company Logo</label>
                                        <input type="file" name="company_logo" id="company_logo" class="form-control" placeholder="company_logo" required="">
     
                                    </div>
                              </div>
                                <div class="card p-2 m-3">

                               
                                    <div class="form-group">
                                        <label lass="col-sm-3 control-label">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required="">
     
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required="">
                                    </div>
                                    </div>
                                   
                                    <button type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Add Company</button>
                                    
                           
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><center>
 <footer class="footer1"><b>GSM</b>
            
            </footer> </center>
    </div>
    
    
    
    
    <script src="./assets/js/lib/jquery/jquery.min.js"></script>
    
    <script src="./assets/js/lib/bootstrap/js/popper.min.js"></script>
    <script src="./assets/js/lib/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="./assets/js/jquery.slimscroll.js"></script>
    
    <script src="./assets/js/sidebarmenu.js"></script>
    
    <script src="./assets/js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    
    <script src="./assets/js/custom.min.js"></script>
</body>

</html>
