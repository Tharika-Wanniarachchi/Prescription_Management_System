

function ViewPrescription(button){
// Get the images from the button's data attribute
    var images = JSON.parse(button.getAttribute('data-images'));
    // document.getElementById('pre_id').value = preId;

    // Update the prescription section with images
    updatePrescriptionSection(images);

    // Show the prescription section only
    document.getElementById("prescriptionManage").style.display = "block";
    document.getElementById("prescriptionSection").style.display = "block";
    document.getElementById("quotationSection").style.display = "none";
}

function CalculateQuotation(button){
    // Get the images from the button's data attribute
    var images = JSON.parse(button.getAttribute('data-images'));

    // Update the prescription section with images
    updatePrescriptionSection(images);

    // Show both the prescription section and the quotation section
    document.getElementById("prescriptionManage").style.display = "block";
    document.getElementById("prescriptionSection").style.display = "block";
    document.getElementById("quotationSection").style.display = "block";
}

function updatePrescriptionSection(images) {
    // Get the main image container and the thumbnails container
    var mainImageContainer = document.getElementById("mainImageContainer");
    var thumbnailsContainer = document.getElementById("thumbnailsContainer");

    // Clear any existing images
    mainImageContainer.innerHTML = '';
    thumbnailsContainer.innerHTML = '';

    // Create and append the main image
    var mainImage = document.createElement('img');
    mainImage.id = 'mainImage';
    mainImage.src = './assets/uploads/' + images[0];
    mainImage.classList.add('card-img-top', 'mt-2');
    mainImage.alt = 'Prescription Image';
    mainImageContainer.appendChild(mainImage);

    // Create and append the thumbnails
    images.slice(1).forEach(function(image) {
        var colDiv = document.createElement('div');
        colDiv.classList.add('col');
        var cardDiv = document.createElement('div');
        cardDiv.classList.add('card');
        var img = document.createElement('img');
        img.src = './assets/uploads/' + image;
        img.classList.add('card-img-top');
        img.alt = 'Thumbnail Image';
        img.onclick = function() {
            swapImage(this);
        };
        cardDiv.appendChild(img);
        colDiv.appendChild(cardDiv);
        thumbnailsContainer.appendChild(colDiv);
    });
}

function swapImage(clickedImage) {
    var mainImage = document.getElementById("mainImage");
    var tempSrc = mainImage.src;
    mainImage.src = clickedImage.src;
    clickedImage.src = tempSrc;
}

$("#prescriptionSection").hide();
$("#quotationSection").hide();
$("#prescriptionManage").hide();
$("#customer_quotationSection").hide();


$('.viewPrescription').on('click', function() {
    var pre_id = $(this).attr('id');
    
    $.ajax({
        url: 'action/displayQuotations.php',
        type: 'POST',
        data: { pre_id: pre_id },
        success: function (response) {
            
            $('#quotationBody').html(response);
            
            $("#prescriptionSection").show();
            $("#prescriptionManage").show();
            $("#quotationSection").show();
            $("#customer_quotationSection").hide();

            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $('#response').html('Error: ' + textStatus + ' - ' + errorThrown);
        }
    });


});











