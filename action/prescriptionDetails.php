
<?php

include('../conn/conn.php');

if(isset($_POST["submit"])){
    $email = $_POST['email'];
    $descriptionNote = $_POST['descriptionNote'];
    $address = $_POST['address'];
    $dateTime = $_POST['dateTime'];
    $totleFiles = count($_FILES['prescription_images']['name']);
    $filesArray = array();

    for($i = 0; $i < $totleFiles; $i++){
        $imageName = $_FILES["prescription_images"]["name"]["$i"];
        $tmpName = $_FILES["prescription_images"]["tmp_name"]["$i"];

        $imageExtension = explode('.',$imageName);
        $imageExtension = strtolower(end($imageExtension));

        $newImageName = uniqid() . '.' .$imageExtension;

        move_uploaded_file($tmpName ,'../assets/uploads/' . $newImageName);
        $filesArray[] = $newImageName;

    }

    // Validation
    $errors = [];
    $fields = [
        'email' => $email,
        'address' => $address,
        'dateTime' => $dateTime,
    ];

    if (empty($email)) {
        $errors['reg_msg1'] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['reg_msg1'] = "Invalid email format.";
    }

    if ($totleFiles == 0 || empty($_FILES['prescription_images']['name'][0])) {
        $errors['reg_msg2'] = "At least one prescription image is required.";
    }

    if (empty($address)) {
        $errors['reg_msg3'] = "Address is required.";
    }

    if (empty($dateTime)) {
        $errors['reg_msg4'] = "Delivery time is required.";
    }

    if (!empty($errors)) {
        $query_string = http_build_query(array_merge($errors, $fields));
        header("Location: ../customerView.php?$query_string");
        exit();
    }




    $filesArray = json_encode($filesArray);
    $query = "INSERT INTO prescription_details(email ,descriptionNote ,address,dateTime,images) VALUES( '$email' , '$descriptionNote' , '$address' ,'$dateTime' ,'$filesArray')";

    mysqli_query($conn,$query);

    header('Location: ../customerView.php?pre_msg=Prescription Details Added Successfully!');
}

?>