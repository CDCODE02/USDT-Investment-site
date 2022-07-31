<?php // session_start()?>
<?php require_once ('../action/main_work.php')?>
<?php if (isset($_GET['user_id']))
    $userId = $_GET['user_id'];
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
                        <form action="../action/main_work.php?option=withdrawBonus" method="post">
                            <div class="card-header">
                                <h3>Withdraw Bonus</h3>
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
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Wallet Address</label>
                                    <input type="text" class="form-control" name="wallet" value="<?php if (isset($_SESSION{'wallet'})) {echo $_SESSION['wallet'];}?>">
                                </div>
                                <div class="form-group">
                                    <label>Select payment method</label>
                                    <select class="form-control form-control-sm" name="coin" >
                                        <?php if(isset($_SESSION['coin'])){ ?>
                                            <option selected value="<?php echo $_SESSION['coin']; ?>"><?php echo $_SESSION['coin']; ?></option>
                                        <?php } ?>
                                        <option>Bitcoin</option>
                                        <option>Ethereum</option>
                                        <option>Perfect money</option>
                                    </select>
                                </div>
                                <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
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
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php require_once "foote.php"?>

<?php require_once ('script.php')?>

