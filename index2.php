<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "image_upload");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
    //Get Pdf name
    $pdf= $_FILES['pdf']['name'];
       $targetpdf = "pdf/".basename($pdf);
       $extension =pathinfo($pdf,PATHINFO_EXTENSION);
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    $image_text = mysqli_real_escape_string($db, $_POST['image_text']);
    
    $Contributor = mysqli_real_escape_string($db, $_POST['Contributor']);
    // image file directory
    $target = "images/".basename($image);

    $sql = "INSERT INTO images (image, image_text , Contributor , pdf) VALUES ('$image', '$image_text','$Contributor', '$pdf')";
    // execute query
    mysqli_query($db, $sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }
    if(!in_array($extension,['zip','pdf','doc'])){
      echo "Your File extension must be pdf zip or doc";
    }
      if (move_uploaded_file($_FILES['pdf']['tmp_name'], $targetpdf)) {
      $msg = "pdf uploaded successfully";
    }else{
      $msg = "Failed to upload image";
    }

  }

  $result = mysqli_query($db, "SELECT * FROM images");
?>
<!DOCTYPE html>
<html>
<head>
<title>Image Upload</title>
<style type="text/css">
   #content{
    width: 80%;
    margin: 20px auto;
 
   }

   #img_div{
    width: 100%;
    padding: 5px;

    border: 1px solid #cbcbcb;
   }
   #img_div:after{
    content: "";
    display: block;
    clear: both;
   }
   img{
    float: left;
    margin: 5px;
    width: 450px;
    height: 240px;
   }
</style>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/e872fa63b1.js" crossorigin="anonymous"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <header class="header">
        <nav class="navbar navbar-expand-lg navbar-default fixed-top" style=" font-family: 'Poppins', sans-serif; "
            height="30vh  ">
            <a class="navbar-brand scrollTo" href="#Registration" style="padding-left: 30px;color: #fff;"><h3>E Learn</h3></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                <span><i class="fa fa-navicon" style="color:#fff; font-size:20px;"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active mx-auto">                
                        <a class="nav-link scrollTo"
                            style="font-weight: bold;font-size: 18px;margin-right: 30px;color: #000;"
                            href="#">ABOUT <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link scrollTo"
                            style="font-weight: bold;font-size: 18px;margin-right: 30px;color: #000;"
                            href="#">Quizer</a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link" style="font-weight: bold;font-size: 18px;margin-right: 30px;color: #000;"
                            href="index.html" target="_blank">home</a>
                    </li>
                    <li class="nav-item mx-auto">
                        <a class="nav-link  scrollTo"
                            style="font-weight: bold;font-size: 18px;margin-right: 30px;color: #000;"
                            href="#contactus">CONTACT US</a>
                    </li>


            </div>
        </nav>
        <div class="text-box">
    <a href="index3.html" class="btn btn-white btn-animated">Upload</a>
    </div>

</header>

  <center><h1>Contributions </h1></center><br><br>
<div id="content">
  <?php
    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
        echo "<img src='images/".$row['image']."' > ";
        echo "<h4>".$row['Contributor']."</h4> ";
        echo "<p>".$row['image_text']."</p> ";
   
        
      echo "</div>";
      echo "<br>";
    }
  ?>
    </div>
 <footer id="footer " class="d-flex-column text-center" style="background: #C0C0C0;color:#000;  width: 100%;
  padding-right: 15px;
  padding-left: 15px;
  margin-right: auto;
  margin-left: auto;
}
">

  <!--Social buttons-->
  
  <!--/.Social buttons-->
  <hr class="mb-0">
 <div class="container-fluid  text-left text-md-center">
    <div class="row">
      <!--First column-->
      <div class="col-md-3 mx-auto shfooter">
        <h5 class="my-2 font-weight-bold d-none d-md-block">why us</h5>
        <div class="d-md-none title" data-target="#Product" data-toggle="collapse">
          <div class="mt-3 font-weight-bold">why us
            <div class="float-right navbar-toggler">
              <i class="fas fa-angle-down"></i>
              <i class="fas fa-angle-up"></i>
            </div>
          </div>
        </div>
        <ul class="list-unstyled collapse" id="Product">
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">Learning </a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">Moto</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">Teachers</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">typos</a></li>
        </ul>
      </div>
      <!--/.First column-->
      <hr class="clearfix w-100 d-md-none mb-0">
      <!--Second column-->
      <div class="col-md-3 mx-auto shfooter">
        <h5 class="my-2 font-weight-bold d-none d-md-block">menu</h5>
        <div class="d-md-none title" data-target="#Company" data-toggle="collapse">
          <div class="mt-3 font-weight-bold">menu
            <div class="float-right navbar-toggler">
              <i class="fas fa-angle-down"></i>
              <i class="fas fa-angle-up"></i>
            </div>
          </div>
        </div>
        <ul class="list-unstyled collapse" id="Company">
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">home</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">about us</a></li>
        
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">latest</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">contact us</a></li>
        </ul>
      </div>
      <!--/.Second column-->
      <hr class="clearfix w-100 d-md-none mb-0">
      <!--Third column-->
      <div class="col-md-3 mx-auto shfooter">
        <h5 class="my-2 font-weight-bold d-none d-md-block">get help</h5>
        <div class="d-md-none title" data-target="#Resources" data-toggle="collapse">
          <div class="mt-3 font-weight-bold">Resources
            <div class="float-right navbar-toggler">
              <i class="fas fa-angle-down"></i>
              <i class="fas fa-angle-up"></i>
            </div>
          </div>
        </div>
        <ul class="list-unstyled collapse" id="Resources">
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">Blog</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">Courses</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">audio</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">videos</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">Teachers</a></li>
        </ul>
      </div>
      <!--/.Third column-->
      <hr class="clearfix w-100 d-md-none mb-0">
      <!--Fourth column-->
      <div class="col-md-3 mx-auto shfooter">
        <h5 class="my-2 font-weight-bold d-none d-md-block">Get Help</h5>
        <div class="d-md-none title" data-target="#Get-Help" data-toggle="collapse">
          <div class="mt-3 font-weight-bold">Get Help
            <div class="float-right navbar-toggler">
              <i class="fas fa-angle-down"></i>
              <i class="fas fa-angle-up"></i>
            </div>
          </div>
        </div>
        <ul class="list-unstyled collapse" id="Get-Help">
          <li><a href="#" target="_blank"   style="color:rgba(0,0,0,0.8)">get in touch</a></li>
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">talk to us</a></li>
   
          <li><a href="#"  style="color:rgba(0,0,0,0.8)">Login</a></li>
        </ul>
      </div>
      <!--/.Fourth column-->
    </div>
  </div>
  <!--/.Footer Links-->

    


</footer>
</div>
</body>
</html>