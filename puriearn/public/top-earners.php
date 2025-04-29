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
                        <h2 class="w3ltop-title pt-4">Top Earners</h2>
                        <ul class="breadcrumbs-custom-path">
                            <li><a href="index.php">Home</a></li>
                            <li class="active"><span class="fas fa-angle-double-right mx-2"></span> Leadership Board</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--//breadcrumb--> 
<style>
    .card{
        border-radius: 18px !important;
        border: 1px solid #E25D1A;
        margin-top: -5px !important;
        margin-bottom: -5px !important;
        max-height: 100px !important;
        padding: -50px;
    }
    .card-img{
        max-width: 100px !important;
        height: 100px !important;
        magrgin-left: -20px;
    }
    
    .card-text{
        padding-top: -50px !important;
    }
    
    
        .absolute {
        position: absolute;
    }
    .relative {
        position: relative;
    }
    
    
    .small{
        font-size: 12px !important;
        color: #fff;
    }
    .bold{
        font-weight: semibold !important;
    }
    .bolder{
        font-weight: bold !important;
    }
</style>

 <!-- feature with photo1 -->
 <section class="w3l-feature-with-photo-1">
        <div class="feature-with-photo-hny py-5">
            <div class="container py-lg-5">
    

                    <?php 
                    //$query = "SELECT * FROM `users` WHERE `ref_bonus` >= 4500 ORDER BY `ref_bonus` DESC LIMIT 10";
                     
                    $query = "SELECT u.username, u.user_picture, SUM(e.amount) AS total_earning
                    FROM earning_history e
                    JOIN users u ON e.user_id = u.id
                    GROUP BY u.username, u.user_picture
                    HAVING total_earning >= 10000
                    ORDER BY total_earning DESC
                    LIMIT 200";    
                    $result=mysqli_query($con,$query);
                    $cnt=1;
                    if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_array($result)){
                        $username = $row['username'];
                        $userPicture = $row['user_picture'];
                        $totalEarning = $row['total_earning'];

                    ?>
<div class="col-sm-6 col-md-4 mb-4" style="background:#06b32a;border-radius:10px;">
    <div class="col-md-4 absolute ">
        <img src="admin/profilepics/<?php echo $row['user_picture'];?>" 
        class="card-img rounded-circle img-fluid p-2">
    </div>
    <div class="col-md-8 text-end">
      <div class="card-body  ">
        <div>
          <p class="card-text text-black bold text-white"
          style="text-transform:uppercase;"><?php echo $username;?></p>
        </div>
        <div class="mt-3">
          <p class="card-text text-black text-white" style="font-weight:600;font-size:20px;">
            ₦<?php echo number_format($totalEarning);?></p>
        </div>
      </div>
    </div>
</div>


<?php } 
                    }else{
                      echo"No Record Found!";
                  }
                  ?>

</div>
                </div>
                </div>
                </div>
</section>
<!-- Terms-area end -->

<script>
function goToLink(url) {
  window.location = url;
}
</script>

<?php include "includes/footer.php" ?>
