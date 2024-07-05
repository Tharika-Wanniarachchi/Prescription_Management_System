<?php
include('../conn/conn.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){ // Checking form submission
    $fullName = $_POST['fullName'];
    $dob = $_POST['dob'];
    $contactNumber = $_POST['contactNumber'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];

    if(isset($_POST["submit"])){
        $errors = [];
        $fields = [
            'fullName' => $fullName,
            'dob' => $dob,
            'contactNumber' => $contactNumber,
            'email' => $email,
            'address' => $address,
            'user_type' => $user_type,
            'password' => $password
        ];

        // Check if the first name is empty
        if (empty($fullName)) {
            $errors['reg_msg1'] = "Full name is required.";
        }

        // Check if the last name is empty
        if (empty($dob)) {
            $errors['reg_msg2'] = "Date of Birth is required.";
        }

        // Check if the contact number is empty or invalid
        if (empty($contactNumber)) {
            $errors['reg_msg3'] = "Contact number is required.";
        } elseif (!preg_match('/^0\d{9}$/', $contactNumber)) {
            $errors['reg_msg3'] = "Contact number must be in the format 0XXXXXXXXX.";
        }

        // Check if the address is empty
        if (empty($address)) {
            $errors['reg_msg4'] = "Address is required.";
        }

          // Check if the address is empty
          if (empty($user_type)) {
            $errors['reg_msg5'] = "User_type is required.";
        }


        // Check if the email is empty
        if (empty($email)) {
            $errors['reg_msg6'] = "Email is required.";
        } else {
            // Check if the email already exists
            $check_user_query = "SELECT * FROM user WHERE email= '$email'";
            $check_user_result = mysqli_query($conn, $check_user_query);

            if (mysqli_num_rows($check_user_result) > 0) {
                $errors['reg_msg6'] = "email is already in use.";
            }
        }

        // Check if the password is empty
        if (empty($password)) {
            $errors['reg_msg7'] = "Password is required.";
        }

        // If there are any errors, redirect back with the error messages and form values
        if (!empty($errors)) {
            $query_string = http_build_query(array_merge($errors, $fields));
            header("Location: ../registration.php?$query_string");
            exit();
        }
    }

    // Check if the user_id exists in the user table
    $check_user_query = "SELECT * FROM user WHERE email= '$email'";
    $check_user_result = mysqli_query($conn, $check_user_query);

    if (mysqli_num_rows($check_user_result) > 0) {
        header('Location: ../registration.php?reg_msg=User Already Exists');
        exit();
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (fullName, dob, contactNumber, email, address,user_type, password) VALUES ('$fullName', '$dob', '$contactNumber', '$email', '$address', '$user_type' ,'$hashedPassword')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header('Location: ../loginform.php?reg_msg=User successfully Registered!');
            exit();
        } else {
            die(mysqli_error($conn));
            exit();
        }
    }
}
?>
