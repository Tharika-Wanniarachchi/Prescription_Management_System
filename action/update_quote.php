<?php

include('../conn/conn.php'); // Include your database connection script

$pre_id = $_POST['pre_id'];

// Fetch all records from the drugs table
$sql = "SELECT drug, Quantity, Amount FROM drugs where pre_id='$pre_id'";
$result = mysqli_query($conn, $sql);

?>

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
                <button type="button" style="width: 200px;" class="btn btn-success" onclick="sendQuotation()">Send Quotation</button>
            </div>
        </div>
    </div>


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
});

</script>
