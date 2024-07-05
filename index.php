
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediLink</title>
    <link rel="icon" href="assets/images/logo.png" type="image/x-icon">

    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- font-awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
 
   <style>
    /* *******************home page section********************* */

    @import url('https://fonts.googleapis.com/css2?family=Playwrite+AU+VIC:wght@100..400&display=swap'); 
       .cover-page{
            height: 100vh;
        }

        .home {
            background-image: url("assets/images/cover.png") !important;
            display: flex;
            position: relative;
            align-items: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            font-family: 'poppins';
            height: 95vh;
            width: 100%;
            padding-top: 30px;
            
        }

        #indexPage {
            margin-top: 30px;
        }

        .main{
            font-size:50px;
            font-weight: 500;
            color: #5E4A93;
            font-family: "Playwrite AU VIC", cursive;
            
        }

        .sub_topic{
            font-size:30px;
            font-weight: 500;
            color: #564b8f; 
        }
       

        .content-home button{
            background: linear-gradient(to right, #5E4A93 ,#015D68 ,#00AFC8);
            color: white;
            padding: 10px 40px;
            font-size:25px;
            font-weight: 600;
            border-radius: 10px;
            margin-top: 20px;
            border: 2px solid #5F5184;
        }
        .content-home i{
            color: rgb(195, 194, 194);
            margin-left: 10px;
        }

        .logo{
            align-items: end;
            margin-bottom:70px;
        }

        .logo h1{
            color:#0578c1;
        } 
/* home end */
    </style>
</head>

<body class="home">

 <!-- Home  page section Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-6 content-home">
                <div class="logo d-flex">
                    <img src="./assets/images/logo.png" alt="logo" width="200px">
                    <h1 class=" main">MediLink</h1>
                </div>
                <!-- <p class=" sub_topic mb-4">Experience the future of pharmacy management with MediLink. Our innovative platform allows you to upload your medical prescriptions effortlessly. We ensure that your prescriptions are accurately reviewed and promptly delivered to your doorstep. </p><br> -->
                <h3 class=" sub_topic mb-4">Do you want your loved ones to have their medicines delivered to their homes quickly?</h1>
                <button class="mt-6" id="getstart" onclick="showLoginForm()">Register Now <i class="fa-solid fa-circle-chevron-right"></i></button><br>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
<!-- Home  page section end -->
    

    
       

    <script>
        // Constant variables
        const loginForm = document.getElementById('loginForm');

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
