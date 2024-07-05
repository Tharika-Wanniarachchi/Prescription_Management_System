<?php

session_start();


include('../conn/conn.php'); // Include your database connection script

$pre_id = $_POST['pre_id'];

// Fetch all records from the drugs table
$sql = "SELECT drug, Quantity, Amount FROM drugs where pre_id='$pre_id'";
$result = mysqli_query($conn, $sql);


// Initialize an empty array
$imageArray = array();

$sql_img = "SELECT images FROM prescription_details where pre_id='$pre_id'";
$result_img = mysqli_query($conn, $sql_img);

// Check if there are records
if (mysqli_num_rows($result_img) > 0) {
    // Output data of each row
    while ($row = mysqli_fetch_assoc($result_img)) {

        // Remove the square brackets
        $string = trim($row['images'], '[]');
        $imageArray = array_map('trim', explode(',', str_replace('"', '', $string)));


    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">

    
    <!-- Style CSS -->
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

     <!-- Include SweetAlert CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     
    <style>
        /* Add your custom styles for loading animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* semi-transparent black */
            z-index: 1000; /* ensure it's above other content */
            display: none; /* initially hidden */
        }
        .loading-spinner {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border: 3px solid #f3f3f3; /* Light grey */
            border-top: 3px solid #3498db; /* Blue */
            border-radius: 50%;
            animation: spin 1s linear infinite; /* CSS animation for spinning effect */
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .error {
            color: red;
            font-size: 10px;
            display:flex;
            justify-content:flex-end;
        }
    </style>
</head>

<body>
<div class="card m-5 p-5"  id="prescriptionManage">
            <div class="row">
                <div class="col-md-6" id="prescriptionSection" >
                    <div class="card p-3">
                        <div class="row card main-image">
                            <div class="container col-md-6" id="mainImageContainer">
                                
                            <img id="mainImage" src="assets/uploads/<?php echo $imageArray[0]; ?>" class="card-img-top mt-2" alt="image1" onclick="">
                            
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-4 g-2 mt-2"id="thumbnailsContainer">
                            

                            <div class="col">
                                <div class="card ">
                                    <img src="assets/uploads/<?php echo $imageArray[1]; ?>" class="card-img-top" alt="image2" onclick="swapImage(this)">
                                </div>
                            </div>

                            <div class="col">
                                <div class="card ">
                                    <img src="assets/uploads/<?php echo $imageArray[2]; ?>" class="card-img-top" alt="image2" onclick="swapImage(this)">
                                </div>
                            </div>

                            <div class="col">
                                <div class="card ">
                                    <img src="assets/uploads/<?php echo $imageArray[3]; ?>" class="card-img-top" alt="image2" onclick="swapImage(this)">
                                </div>
                            </div>
                            <div class="col">
                                <div class="card ">
                                    <img src="assets/uploads/<?php echo $imageArray[4]; ?>" class="card-img-top" alt="image2" onclick="swapImage(this)">
                                </div>
                            </div>        
                        </div>

                    </div>
                </div>
                
                <div class="col-md-6" id="quotationSection" >
                    <div class="row">
                        <div class="col-md-12 card">
                        <table class="table table-light" id="quotationTable">
                            <thead>
                                <tr>
                                    <th scope="col">Drug</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>

                            <tbody id="quotationBody">

                                <?php
                                
                                // Initialize total amount variable
                                $totalAmount = 0.00;

                                // Check if there are records
                                if (mysqli_num_rows($result) > 0) {
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Sum up total amount
                                        $totalAmount += $row['Amount'];

                                        // Output table row for each record
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['drug']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['Quantity']) . '</td>';
                                        echo '<td>' . number_format($row['Amount'], 2) . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="3">No records found</td></tr>';
                                }

                                // Display total amount in the footer
                                echo '<tr>';
                                echo '<th colspan="2">Total</td>';
                                echo '<th id="totalAmount">' . number_format($totalAmount, 2) . '</td>';
                                echo '</tr>';
                                
                                ?>

                            </tbody>
                            
                        </table>
                        </div>
                    </div>
                    <div class="row">

                    <div id="error-message" class="text-danger mt-3 text-center" ></div>

                        <div class="col-md-4"></div>
                        <div class="col-md-8 mt-5">
                        <form id="quotationForm" method="POST" action="./action/addQuotation.php">
                             <div class="drug d-flex" style="display:flex; justify-content:flex-end">
                                 <input type="hidden" class="form-control" id="pre_id" name="pre_id"  value="<?php echo $pre_id?>" style="width: 200px;">
                             </div>
                            <div class="drug d-flex" style="display:flex; justify-content:flex-end">
                                <label for="drugname" class="mx-3 mt-2">Drug</label>
                                <input type="text" class="form-control" id="drugname" name="drugname" placeholder="Drug name" autocomplete="off" style="width: 200px;" ><br>
                            </div>
                            <div id="drugNameError" class="error"></div>
                            <div class="drug d-flex mt-3" style="display:flex; justify-content:flex-end">
                                <label for="quantityPrice" class="mx-3 mt-2">Price Per Unit * Quantity</label>
                                <input type="text" class="form-control" id="quantityPrice" name="quantityPrice" placeholder="e.g. 10.00*20" autocomplete="off" style="width: 200px;" >
                            </div>
                            <div id="drugQuantityPriceError" class="error"></div>

                            <div class="drug d-flex mt-3" style="display:flex; justify-content:flex-end">
                                <button type="submit" id="addQuotation" name="submit" style="width: 100px;" class="btn btn-primary add_btn">Add</button>
                            </div>
                        </form>  
                         </div>
                    </div>
                    <hr/>
                    <div class="drug d-flex mt-3" style=" display:flex; justify-content:flex-end">
                        <button id="sendquotation" class="btn btn-success" style="width: 200px;">Send Quotation</button>

                        <!-- Loading overlay and spinner -->
                        <div class="loading-overlay" id="loadingOverlay">
                            <div class="loading-spinner"></div>
                        </div>
                        
                    </div>
                </div>

                
                <div class="col-md-6" id="customer_quotationSection" >
                    <div class="row">
                        <div class="col-md-12 card">
                        <table class="table table-light" id="quotationTable">
                            <thead>
                                <tr>
                                    <th scope="col">Drug</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>

                            <tbody id="quotationBody">

                                <?php
                                
                                // Initialize total amount variable
                                $totalAmount = 0.00;
                                $pre_id = $_POST['pre_id'];

                                $sql = "SELECT drug, Quantity, Amount FROM drugs where pre_id='$pre_id'";
                                $result = mysqli_query($conn, $sql);
                                
                                
                                // Check if there are records
                                if (mysqli_num_rows($result) > 0) {
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Sum up total amount
                                        $totalAmount += $row['Amount'];

                                        // Output table row for each record
                                        echo '<tr>';
                                        echo '<td>' . htmlspecialchars($row['drug']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['Quantity']) . '</td>';
                                        echo '<td>' . number_format($row['Amount'], 2) . '</td>';
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="3">No records found</td></tr>';
                                }

                                // Display total amount in the footer
                                echo '<tr>';
                                echo '<th colspan="2">Total</td>';
                                echo '<th id="totalAmount">' . number_format($totalAmount, 2) . '</td>';
                                echo '</tr>';
                                
                                ?>

                            </tbody>
                            
                        </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>

                        <div class=" col-md-4 drug d-flex mt-3" style=" display:flex; justify-content:flex-end">
                            <button id="acceptquotation" class="btn btn-success" style="width: 200px;">Accept Quotation</button>
                        </div>
                     
                        <div class=" col-md-4 drug d-flex mt-3" style=" display:flex; justify-content:flex-end">
                            <button id="rejectquotation" class="btn btn-danger" style="width: 200px;">Reject Quotation</button>
                        </div>
                               <!-- Loading overlay and spinner -->
                        <div class="loading-overlay" id="loadingOverlay">
                            <div class="loading-spinner"></div>
                        </div>  
        
         
                    </div>   
                                    
                </div>
            </div>
           
</div> 



<!-- jquery Cdn -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Sweet Alert cdn -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
<script>

    
$(document).ready(function() {

    $('#quotationForm').on('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

        if (validateForm()) { // Call the validation function
            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false, // Do not process the data
                contentType: false, // Do not set content type
                success: function(response) {
                    // Handle the response from the server
                    //alert('Form submitted successfully!');

                    updatedDetails(); // Call the function to perform the second AJAX request
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Handle any errors
                    alert('Error: ' + textStatus + ' - ' + errorThrown);
                    console.log(jqXHR.responseText);
                }
            });
        } 
    });

    // Function to validate form fields
    function validateForm() {
        var isValid = true;

        // Reset any previous error messages
        $('.error').text('');

        // Validate drugname field
        if ($('#drugname').val().trim() === '') {
            $('#drugNameError').text('Please enter a drug name.');
            isValid = false;
        }

        // Validate quantityPrice field
        var quantityPrice = $('#quantityPrice').val().trim();
                if (quantityPrice === '') {
                    $('#drugQuantityPriceError').text('Please enter price per unit * quantity.');
                    isValid = false;
                } else {
                    // Check if quantityPrice matches the format number.number*number
                    var regex = /^\d+\.\d+\*\d+$/; // Regular expression for format like 10.00*20
                    if (!regex.test(quantityPrice)) {
                        $('#drugQuantityPriceError').text('Please enter the price per unit * quantity in the format like 10.00*20.');
                        isValid = false;
                    }
                }
        return isValid;
    }

    function updatedDetails() {
        var pre_id = <?php echo $pre_id; ?>;
        $.ajax({
            url: 'action/update_quote.php',
            type: 'POST',
            data: { pre_id: pre_id },
            success: function(response) {
                $('#quotationSection').html(response);
                // Optionally, you can update the quotation table with the new data here
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#response').html('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    }



    $('#sendquotation').click(function() {
        $('#loadingOverlay').fadeIn();

        var pre_id = <?php echo $pre_id; ?>;
        $.ajax({
            url: 'sendmail.php',
            type: 'POST',
            data: { pre_id: pre_id },
            success: function(response) {
                $('#loadingOverlay').fadeOut();
                console.log(response);
                if (response === 'email sent!') {
                    Swal.fire({
                        title: "Successful Send Email!",
                        text: "The email has been sent successfully!",
                        icon: "success"
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loadingOverlay').fadeOut();
                $('#response').html('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    
    $('#acceptquotation').click(function() {
        $('#loadingOverlay').fadeIn();

        var pre_id = <?php echo $pre_id; ?>;
        $.ajax({
            url: 'sendemailPharmacy.php',
            type: 'POST',
            data: { pre_id: pre_id },
            success: function(response) {
                $('#loadingOverlay').fadeOut();
                console.log(response);
                if (response === 'email sent!') {
                    Swal.fire({
                        title: "Successful Send Email!",
                        text: "Accepted Quotation successfully!",
                        icon: "success"
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loadingOverlay').fadeOut();
                $('#response').html('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });

    $('#rejectquotation').click(function() {
        $('#loadingOverlay').fadeIn();

        var pre_id = <?php echo $pre_id; ?>;
        $.ajax({
            url: 'rejectmail.php',
            type: 'POST',
            data: { pre_id: pre_id },
            success: function(response) {
                $('#loadingOverlay').fadeOut();
                console.log(response);
                if (response === 'email sent!') {
                    Swal.fire({
                        title: "Reject Quotation successfully!",
                        text: "Successful Send Email!",
                        icon: "error"
                    })
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $('#loadingOverlay').fadeOut();
                $('#response').html('Error: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });



});


</script>

</body>
</html>
