<?php //session_start();?>
<?php
require_once ('../action/main_work.php');
if (isset($_GET['come']))
    $userId = $_GET['come'];
$userDetails = $for->getLoggedInUserDetails($_SESSION['userUniqueId']);
?>
<?php require_once "head.php"?>

<?php require_once ('herder.php')?>


<!-- start page container -->

<?php require_once ('sidebar.php')?>


<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3>Deposit</h3>
                        </div>
                        <?php if(isset($_SESSION['formError'])){?>
                            <?php foreach($_SESSION['formError'] as $k => $eachErrorArray){?>
                                <?php foreach($eachErrorArray as $k => $eachError){?>
                                    <p class="alert alert-danger"><?php echo $eachError ?></p>
                                <?php } ?>

                            <?php } ?>
                            <?php unset($_SESSION['formError']); ?>
                        <?php } ?>

                        <?php if(isset($_GET['success'])){?>
                            <p class="alert alert-success"><?php echo trim($_GET['success']); ?></p>
                        <?php } ?>
                        <form action="../action/main_work.php?option=deposit" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                        
                        


                        
                            <div class="form-group">
                                <label>Select plan</label>
                                <select class="form-control form-control-sm" name="plan" >
                                    <?php if(isset($_SESSION['plan'])){ ?>
                                        <option value="<?php echo $_SESSION['plan']; ?>"><?php //echo $_SESSION['plan']; ?></option>
                                    <?php } ?>
                                    <!--<option></option>-->
                                    <option>Builder Plan</option>
                                    <option>Silver Plan</option>
                                    <option>Diamond Plan</option>
                                    <option>Ultimate Plan</option>
                                    <option>Business Plan</option>
                                </select>
                            </div>

                                   <div class=" form-group mb-4 " style="margin-top: 20px">
                                <h6>Amount</h6>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                        <!--<span class="input-group-text">0.00</span>-->
                                    </div>
                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="amount" value="<?php if (isset($_SESSION{'amount'})) {echo $_SESSION['amount'];}?>">
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <h5 style ="text-align:center ">USDT (TRC20):</h5>
                        <!-- <p>hdndnsdnmsdmfcmdfmwqw</p> -->
                        <br>
                        <center>
                       <div class="input-group">
                           <input type="text"  value="TRWGuAZfLfpzxeFHKLNFtrYCETydPzsSNP" id="myadd" readonly>
                              <div class="input-group-append">
                                  <button type='button' class="input-group-text bg-primary white acbtn round" onclick="mybadd();" >Copy USDT (TRC20) Address</button>
                           </div>
                         </div>
                    </center>
                    <h5 style ="text-align:center; padding-top:25px ">USDT (BEP20):</h5>
                        <!-- <p>hdndnsdnmsdmfcmdfmwqw</p> -->
                        <br>
                        <center>
                       <div class="input-group">
                           <input type="text"  value=" 0xD72BbbF31ae727b57E4aEe1C573Dd1e0bBDdb859" id="myetadd" readonly>
                              <div class="input-group-append">
                                  <button type='button' class="input-group-text bg-primary white acbtn round" onclick="myeadd();" >Copy USDT (BEP20) Address</button>
                           </div>
                         </div>
                    </center>

                    <!-- <h5 style ="text-align:center; padding-top:25px ">BNB:</h5> -->
                        <!-- <p>hdndnsdnmsdmfcmdfmwqw</p> -->
                        <!-- <br>
                        <center>
                       <div class="input-group">
                           <input type="text"  value=" bnb1g073uwh6x47pltah50khzww6p7kw6kscta4zxy" id="mybnadd" readonly>
                              <div class="input-group-append">
                                  <button type='button' class="input-group-text bg-primary white acbtn round" onclick="mynadd();" >Copy BNB Address</button>
                           </div>
                         </div>
                    </center> -->

                    <!-- <h5 style ="text-align:center; padding-top:25px ">USDT:</h5> -->
                        <!-- <p>hdndnsdnmsdmfcmdfmwqw</p> -->
                        <!-- <br>
                        <center>
                       <div class="input-group">
                           <input type="text"  value="TB9Kp2FqwfrtUkFSGnFt2idX6ZyHmQUQ2Z" id="myusadd" readonly>
                              <div class="input-group-append">
                                  <button type='button' class="input-group-text bg-primary white acbtn round" onclick="myuadd();" >Copy USDT Address</button>
                           </div>
                         </div>
                    </center>  -->
                            <br>
                            <div class="form-group">
                                <label>Select payment method</label>
                                <select class="form-control form-control-sm" name="coin" >
                                    <?php if(isset($_SESSION['coin'])){ ?>
                                        <option selected value="<?php echo $_SESSION['coin']; ?>"><?php //echo $_SESSION['coin']; ?></option>
                                    <?php } ?>
                                         <!--<option></option> -->
                                         <option>USDT (TRC20)</option> 
                                        <option>USDT (BEP20)</option>
                                        <!-- <option>Usdt</option>
                                        
                                        <option>BNB</option> -->
                                </select>
                            </div>
                            <br>
                            <h6>payment proof</h6>
                            <input accept='image/*' type="file" name="fileToUpload" id="fileToUpload">
                        <div class="card-footer">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="copier.js"></script>

<?php require_once "foote.php"?>

<?php require_once ('script.php')?>

