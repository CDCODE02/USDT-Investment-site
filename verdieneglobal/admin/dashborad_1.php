<?php
require ('../action/main_work.php');
?>
<?php require_once ('head_1.php')?>
<?php $userDetails = $for->admindetail();?>
<?php require_once ('herder_1.php')?>

<!-- start page container -->

<?php require_once ('sidebar_1.php')?>


<div class="main-content">
<div>
<script type="text/javascript" src="widget.coinlore.com/widgets/ticker-widget.js"></script><div class="coinlore-priceticker-widget" data-mcurrency="usd" data-bcolor="#fff;" data-scolor="#333" data-ccolor="#428bca" data-pcolor="#428bca"></div>
</div>
    <section class="section">
        <div class="row ">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total User</h5>
                                        <h2 class="mb-3 font-18"><?php  $details = $for->runMysqliQuery( "SELECT COUNT(*) FROM users");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 0;
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[0];
                                                }
                                            }
                                            ?><?php echo $output;?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Deposit</h5>
                                        <h2 class="mb-3 font-18"><?php  $details = $for->runMysqliQuery( "SELECT COUNT(*) FROM deposit_tb");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 0;
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[0];
                                                }
                                            }
                                            ?><?php echo $output;?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/2.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Referral</h5>
                                        <h2 class="mb-3 font-18"><?php  $details = $for->runMysqliQuery( "SELECT COUNT(*) FROM referral_tb");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 0;
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[0];
                                                }
                                            }
                                            ?><?php echo $output;?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/3.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Withdrawal</h5>
                                        <h2 class="mb-3 font-18"><?php  $details = $for->runMysqliQuery( "SELECT COUNT(*) FROM withdrawal");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 0;
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[0];
                                                }
                                            }
                                            ?><?php echo $output;?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/banner/4.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-statistic-4">
                        <div class="align-items-center justify-content-between">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                    <div class="card-content">
                                        <h5 class="font-15">Total Investment</h5>
                                        <h2 class="mb-3 font-18"><?php  $details = $for->runMysqliQuery( "SELECT COUNT(*) FROM deposit_tb WHERE status = 'confirmed'");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 0;
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[0];
                                                }
                                            }
                                            ?><?php echo $output;?></h2>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                    <div class="banner-img">
                                        <img src="assets/img/products/product-1.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php require_once ('footer_1.php')?>

<?php require_once ('script_1.php')?>

