<?php 
session_start();
// Database connection
include('../config/puri-conn.php');
include "includes/header.php" 
?>
    <!-- breadcrumb -->
    <section class="w3l-about-breadcrumb">
        <div class="breadcrumb-bg breadcrumb-bg-about">
            <div class="container py-lg-5 py-sm-4">
                <div class="w3breadcrumb-gids text-center">
                    <div class="w3breadcrumb-info mt-5">
                        <h2 class="w3ltop-title pt-4">Code Vendors</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="index.php">Home</a></li>
                            <li class="active"><span class="fas fa-angle-double-right mx-2"></span> Buy Coupon Code </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//breadcrumb--> 

<style>
   .badge-position {
  position: absolute;
  top: 5px;
  right: 25%;
}
a .btn{
    cursor: pointer !important;
}
.card{
    background: #fff !important;
}
.card-img-top{
    border-radius: 100% !important;
    width: 40% !important;
    height: 40% !important;
    border: 1px solid #E25D1A;
   align-items: center !important;
}

.mb-16{
    margin-bottom: 60px !important;
}
.profile-img {
    width: 100% !important;
    height: 200px !important;
    object-fit: cover;
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 20px !important;
}

</style>

<div class="w3l-team-main py-5" id="team">
        <div class="container py-md-5 py-3">
            <div class="header-secw3 text-center">
                <div class="header-secw3 text-center">
                    <h6 class="title-subhny mb-2">Our Vendors</h6>
                    <p>Chat any of our verified vendors to get your coupons code from them.</p>
                    <p><b class="color-primary">Note:</b> Do not pay to anyone not on this page. We will not be responsible for any fraudlent actions. </p>
 
                </div>

            </div>
            <div class="row w3ls_team_grids text-center">
            <?php 
                    $query="SELECT * FROM `users` WHERE `is_vendor`= '1' AND `phone` != '' ";
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                    ?>
               <div class="col-md-3 col-6 w3_agile_team_grid mt-md-5 mt-4">
                  <div class="box4">
                    
                          <img src="admin/profilepics/<?php echo $row['user_picture'];?>" alt=" " class="profile-img radius-image">
                   
                      <div class="box-content">
                          <h3 class="title"><?php echo htmlentities($row['username']);?></h3>
                          <ul class="icon">
                              <li>
                                  <a href="" class="fab fa-whatsapp btn-primary" onclick="window.location.href='https://wa.me/<?php echo htmlentities($row['phone']);?>?text=Hello+<?php echo htmlentities($row['username']);?>+good+day+I+want+to+make+payment+for+Puriearn+coupon+code';"></a>
                              </li>
                          </ul>
                      </div>
                  </div>

                
                  <a class="btn btn-primary w-100" onclick="window.location.href='https://wa.me/<?php echo htmlentities($row['phone']);?>?text=Hello+<?php echo htmlentities($row['username']);?>+good+day+I+want+to+make+payment+for+Puriearn+coupon+code';">Message</a>
              </div>

                <?php } 
                    }else{
                      echo"No Vendor Found!";
                  }
                  ?>
                
            </div>
        </div>
    </div>
    <!--//team-sec-->


      <?php include "includes/footer.php" ?>
