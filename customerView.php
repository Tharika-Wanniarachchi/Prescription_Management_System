<?php
include('./conn/conn.php');
session_start();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediLink</title>
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
    </style>


     <script>
        $(document).ready(function() {
            $('.viewQuotation').on('click', function() { 
                var pre_id = $(this).attr('id');
                
                $.ajax({
                    url: 'action/displayQuotations.php',
                    type: 'POST',
                    data: { pre_id: pre_id },
                    success: function (response) {
                        
                        $('#quotationBody').html(response);
                        
                        $("#prescriptionSection").show();
                        $("#prescriptionManage").show();
                        $("#quotationSection").hide();
                        $("#customer_quotationSection").show();

                        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#response').html('Error: ' + textStatus + ' - ' + errorThrown);
                    }
                });
            });

        });
        
    </script>
     


</head>
<body>
    <nav class="nav justify-content-around p-3 fs-5">
        <div class="d-flex ">
            <a class="nav-link" href="#customer-prescription" id="goToindex">Logo</a>
        </div>
        <div class="d-flex ">
            <a class="nav-link active" aria-current="page" href="#customer-prescription"  id="goToPrescription">Prescription Management</a>
        </div>
        <div class="d-flex">
            <li class="nav-item dropdown" id="goToProfile" style="display:flex; justify-content: center; align-items: center;">
                <i class="fa-solid fa-user"></i>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <a class="nav-link dropdown-toggle" href="#customer-prescription" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['user_name']; ?>
                    </a>
                <?php else: ?>
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                <?php endif; ?>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="loginform.php">Log Out</a></li>
                </ul>
            </li>
        </div>
    </nav>
    

    

    <!-- Prescription Deatils Upload start -->
    <div class="container" id="customer-prescription">
        <div class="card m-5 p-5">
        <div id="" class="form-text text-success text-center p-2 mb-2"  style="font-size: 18px; background:#E0FBE2;">
            <?php
                if(isset($_GET['pre_msg'])){
                    $display_pre_msg = $_GET['pre_msg'];  
                    echo $display_pre_msg; 
                }
            ?>
        </div>    
            <form action="./action/prescriptionDetails.php" method="POST"  enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                    <div id="" class="form-text text-danger "  style="font-size: 12px;">
                        <?php
                            if(isset($_GET['reg_msg1'])){
                                $display_reg_msg = $_GET['reg_msg1'];  
                                echo $display_reg_msg; 
                            }
                        ?>
                    </div>                
                </div>
                
                <div class="mb-3">
                    <label for="prescription_images" class="form-label">Upload Prescription</label>
                    <input class="form-control" type="file" id="prescription_images"  name="prescription_images[]" accept=".jpg , .jpeg , .png" multiple>
                    <small class="form-text text-muted text-warning">You can upload up to 5 images.</small>
                    <div id="" class="form-text text-danger "  style="font-size: 12px;">
                        <?php
                            if(isset($_GET['reg_msg2'])){
                                $display_reg_msg = $_GET['reg_msg2'];  
                                echo $display_reg_msg; 
                            }
                        ?>
                    </div>                

                </div>
                <div class="mb-3">
                    <label for="descriptionNote" class="form-label">Description Note</label>
                    <textarea class="form-control" id="descriptionNote" name="descriptionNote" rows="3"></textarea>
                
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address">
                    <div id="" class="form-text text-danger "  style="font-size: 12px;">
                        <?php
                            if(isset($_GET['reg_msg3'])){
                                $display_reg_msg = $_GET['reg_msg3'];  
                                echo $display_reg_msg; 
                            }
                        ?>
                    </div>                

                </div>
                <div class="mb-3">
                    <label for="dateTime" class="form-label">Delivery Time slot</label>
                    <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
                    <div id="" class="form-text text-danger "  style="font-size: 12px;">
                        <?php
                            if(isset($_GET['reg_msg4'])){
                                $display_reg_msg = $_GET['reg_msg4'];  
                                echo $display_reg_msg; 
                            }
                        ?>
                    </div>                

                </div>
                
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

      
        
    </div>
    <!-- Prescription Upload System  end-->

    
    <!-- sent Prescription display start -->
    <div class="m-5" id="customer-prescription">

        <div id="quotationBody"></div>
        
        <table class="table">
            <thead  class=" table-primary">
              <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Email</th>
                <th scope="col">Prescription</th>
                <th scope="col">Details</th>
                <th scope="col">Address</th>
                <th scope="col">Date & Time</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $rows = mysqli_query($conn, "SELECT * FROM prescription_details");
                    ?>
                <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?php echo $row["pre_id"]; ?></td>
                    <td><?php echo $row["email"]; ?></td>
                    <td class="row row-cols-1 row-cols-md-2 g-4" width="250px">
                        <?php
                        foreach (json_decode($row["images"]) as $image) : ?>
                        <img src="./assets/uploads/<?php echo $image; ?>">
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo $row["descriptionNote"]; ?></td>
                    <td><?php echo $row["address"]; ?></td>
                    <td><?php echo $row["dateTime"]; ?></td>
                    <td>
                        <button class="btn btn-success viewQuotation"  id="<?php echo $row['pre_id']; ?>" data-images='<?php echo json_encode(json_decode($row["images"])); ?>'>View Quotation</button>
                    </td>    
                </tr>
                <?php endforeach; ?>
            </tbody>  
        </table>

    
        
    </div>





    <!-- jquery Cdn -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Sweet Alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="./assets/js/Script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
