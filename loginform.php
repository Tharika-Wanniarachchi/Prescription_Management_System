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
        <div class="login-container col-md-6 col-sm-8">
            <div class="login-img col-md-6">
                <img src="./assets/images/login.jpg" alt="login">
            </div>
            <!-- Login form -->
            <div class="login" id="loginForm">
                <div style="color:rgb(2, 161, 2); font-size: 18px; font-weight: 500; display:flex; justify-content: center;align-items: center;">
                    <?php
                        if(isset($_GET['success_msg'])){
                            $display_msg=$_GET['success_msg'];
                            echo $display_msg;
                        }
                    ?>
                </div>
                <div  style="color:rgb(168, 6, 6); font-size: 18px; font-weight: 500; display:flex; justify-content: center;align-items: center;">
                    <?php
                        if(isset($_GET['login_msg2'])){
                            $display_login_msg=$_GET['login_msg2']; 
                            echo $display_login_msg; 
                        }
                    ?>
                </div>
                <div style="padding-bottom:10px;font-size: 18px; font-weight: 500; display:flex; justify-content: center;align-items: center;" class="text-success">
                        <?php
                            if(isset($_GET['reg_msg'])){
                                $display_reg_msg = $_GET['reg_msg']; 
                                echo $display_reg_msg; 
                            }
                        ?>
                </div>
                
                <h1 class="text-center form-topic">Login</h1>
                <div class="login-form">
                    <form action="./action/login.php" method="POST">
                        <div class="form-group">
                            <label for="email">Username:</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your Email" autocomplete="off">
                            <div  style="color:red; font-size: 12px; font-weight: 400; ">
                                <?php
                                    if(isset($_GET['user_msg'])){
                                        $display_user_msg=$_GET['user_msg']; 
                                        echo $display_user_msg;   
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your Password" autocomplete="off">
                            <div  style="color:red; font-size: 12px; font-weight: 400;">
                                <?php
                                    if(isset($_GET['pw_msg'])){
                                        $display_pw_msg=$_GET['pw_msg'];  
                                        echo $display_pw_msg; 
                                    }
                                ?>
                            </div>
                            
                        </div>
                        <p class="registrationForm" onclick="showRegistrationForm()">Don't have an account? <span>Register now</span></p>
                        <button type="submit" name="submit" class="btn btn btn-style login-btn form-control">Login</button>
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