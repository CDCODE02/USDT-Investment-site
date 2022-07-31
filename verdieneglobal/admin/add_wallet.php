<?php session_start()?>
<?php
require ('../action/main_work.php');
?>
<?php require_once "head_1.php"?>

<?php require_once ('herder_1.php')?>


<!-- start page container -->

<?php require_once ('sidebar_1.php')?>


<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Wallet</h4>
                        </div>
                        <?php if(isset($_SESSION['formError'])){?>
                            <?php foreach($_SESSION['formError'] as $k => $eachErrorArray){?>
                                <?php foreach($eachErrorArray as $k => $eachError){?>
                                    <p class="alert alert-warning"><?php echo $eachError ?></p>
                                <?php } ?>

                            <?php } ?>
                            <?php unset($_SESSION['formError']); ?>
                        <?php } ?>

                        <?php if(isset($_GET['success'])){?>
                            <p class="alert alert-success"><?php echo trim($_GET['success']); ?></p>
                        <?php } ?>
                        <form action="../action/main_work.php?option=wallet" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Bitcoin</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" name="Bitcoin" value="<?php if (isset($_SESSION{'Bitcoin'})) {echo $_SESSION['Bitcoin'];}?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Ethereum</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" name="Ethereum" value="<?php if (isset($_SESSION{'Ethereum'})) {echo $_SESSION['Ethereum'];}?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"> Perfect money</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"  name="Perfect" value="<?php if (isset($_SESSION{'Perfect'})) {echo $_SESSION['Perfect'];}?>" >
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"> Doge</div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup"  name="Dogde" value="<?php if (isset($_SESSION{'Dogde'})) {echo $_SESSION['Dogde'];}?>" >
                                    </div>
                            </div>
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">BNB</div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup"  name="BNB" value="<?php if (isset($_SESSION{'BNB'})) {echo $_SESSION['BNB'];}?>" >
                                    </div>
                                </div>
                            <button type="submit" class="btn btn-primary btn-block btn-md">Sign Up</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php require_once "footer_1.php"?>

<?php require_once ('script_1.php')?>

