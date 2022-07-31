<?php require_once ('../action/main_work.php')?>
<?php $for->valdateSession('../login.php')?>
<?php if(isset($_GET['user_id'])) //take the use back to profile page }; ?>
<?php $userId = $_GET['user_id']; ?>
<?php $userDetails = $for->getLoggedInDepositDetails($userId); ?>
<?php require_once "head_1.php"?>

<?php require_once ('herder_1.php')?>


<!-- start page container -->

<?php require_once ('sidebar_1.php')?>


<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Update Profile</h3>
                        </div>
                        <div class="card-body">
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
                            <form action="../action/main_work.php?option=admin" method="post">
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">UserName</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control"name="username" value="<?php echo ucwords($userDetails->username ) ?>" placeholder="username">
                                    </div>
                                </div>
                                <input type="hidden" name="user_id" value="<?php echo $userId; ?>" />
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">plan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="plan" value="<?php echo ucwords($userDetails->plan) ?>" placeholder="plan">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">interest</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" class="form-control" name="interest" value="<?php echo ucwords($userDetails->amount) ?>" placeholder="interest">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button type="submit" name="" class="btn btn-primary">update
                                        </button>
                                    </div>
                                </div>
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

