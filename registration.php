<?php 
    include './conn/conn.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration and Login System</title>

    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- font-awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>
    
<div class="main-container">
    <div class="reg-container col-md-6 col-sm-8 ">
        <div class="login-img  col-md-6">
            <img src="./assets/images/login.jpg" alt="login">
        </div>
        <div class="registration " id="registrationForm">
                <h1 class="text-center form-topic">Registration</h1>
                <div class="registration-form">
                    <form action="./action/add-user.php" method="POST">
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="fullName">Full Name:</label>
                                <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full name" autocomplete="off" value="<?php echo isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg1'])){
                                            $display_reg_msg = $_GET['reg_msg1'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="dob">Date Of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" placeholder="Date Of Birth" autocomplete="off" value="<?php echo isset($_POST['dob']) ? htmlspecialchars($_POST['dob']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg2'])){
                                            $display_reg_msg = $_GET['reg_msg2'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="contactNumber">Contact Number:</label>
                                <input type="number" class="form-control" id="contactNumber" name="contactNumber" maxlength="11" autocomplete="off" placeholder="077 1167 156" value="<?php echo isset($_POST['contactNumber']) ? htmlspecialchars($_POST['contactNumber']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg3'])){
                                            $display_reg_msg = $_GET['reg_msg3'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="updateEmail">Email:</label>
                                <input type="email" class="form-control" id="updateEmail" name="email" autocomplete="off" placeholder="example@gmail.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg6'])){
                                            $display_reg_msg = $_GET['reg_msg6'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" autocomplete="off" placeholder="address" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                            <div style="color:red; font-size: 12px; font-weight: 400;">
                                    <?php
                                        if(isset($_GET['reg_msg4'])){
                                            $display_reg_msg = $_GET['reg_msg4'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="user_type">User Type:</label><br>
                                <select name="user_type" class="u_type">
                                    <option value="Customer">Customer</option>
                                    <option value="Pharmacy">Pharmacy</option>

                                </select>
                                <div id="" class="form-text text-danger "  style="font-size: 12px;">
                                    <?php
                                        if(isset($_GET['reg_msg5'])){
                                            $display_reg_msg = $_GET['reg_msg5'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="registerPassword">Password:</label>
                                <input type="password" class="form-control" id="registerPassword" name="password" autocomplete="off" placeholder="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : ''; ?>">
                                <div style="font-size: 12px; font-weight: 400;" class="text-danger">
                                    <?php
                                        if(isset($_GET['reg_msg7'])){
                                            $display_reg_msg = $_GET['reg_msg7'];  
                                            echo $display_reg_msg; 
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <p class="registrationForm" onclick="showLoginForm()">Already have an account? <span> Log in</span></p>
                        <button type="submit" name="submit" class="btn btn btn-style login-register form-control">Register</button>
                    </form>
                </div>
        </div>
    </div>
</div>

<script>
    // Constant variables
    const loginForm = document.getElementById('loginForm');
    const registrationForm = document.getElementById('registrationForm');

    function showRegistrationForm() {
        window.location.href = 'registration.php';
    }

    function showLoginForm() {
        window.location.href = 'loginform.php';
    }
</script>

<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

</body>
</html>
