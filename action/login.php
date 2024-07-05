<?php
include('../conn/conn.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(isset($_POST['submit'])){
        // Check if fields are empty
        if(empty($email)) {
            header('Location: ../loginform.php?user_msg=email is required!&pw_msg=Password is required!#loginForm');
            exit();
        }
        if (empty($password)) {
            header('Location: ../loginform.php?user_msg=email is required!&pw_msg=Password is required!#loginForm');
            exit();
        }
        
    }

    // Prepare and execute the SQL query to select the hashed password for the provided email
    $query = "SELECT `password` , `user_type` FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        // Check if the email exists in the database
        if (mysqli_num_rows($result) > 0) {
            // Fetch the stored hashed password
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];
            $loggin_user_type = $row['user_type'];

            // Verify the password using password_verify function
            if (password_verify($password, $stored_password)) {
                // Retrieve the user's name from the database
                $name_query = "SELECT `fullName`, `dob` FROM `user` WHERE `email` = '$email'";
                $name_result = mysqli_query($conn, $name_query);

                if ($name_result && mysqli_num_rows($name_result) > 0) {
                    $user_data = mysqli_fetch_assoc($name_result);
                    $user_fullName = $user_data['fullName'];
                    
                    // Store the user's name in a session variable
                    $_SESSION['user_name'] = $user_fullName ;
                }

                // Redirect based on user type
                if ($loggin_user_type == 'Pharmacy') {

                    header('Location: ../pharmacyView.php');

                } else if ($loggin_user_type == 'Customer') {

                    header('Location: ../customerView.php');

                }
                exit();

            } else {
                // Incorrect password
                header('Location: ../loginform.php?login_msg2=Incorrect password!');
                exit();
            }

        } else {
            // User not found
            header('Location: ../loginform.php?login_msg2=User Not Found!');
            exit();
        }
    } else {
        // Handle database query error
        echo "Error: " . mysqli_error($conn);
    }
}
?>
