<?php session_start()?>
<?php require_once ('../action/main_work.php')?>
<?php $userId = $_GET['userId']; ?>
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
                                <h4>Insert New Wallet Address</h4>
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
                            <form action="../action/main_work.php?option=wallet_update" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Bitcoin</div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroup" name="Bitcoin" value="<?php  $details = $for->runMysqliQuery( "SELECT * FROM wallet");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 'No Data was returned';
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[1];
                                                }
                                            }
                                            ?><?php echo $output;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Ethereum</div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroup" name="Ethereum" value="<?php  $details = $for->runMysqliQuery( "SELECT * FROM wallet");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 'No Data was returned';
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[2];
                                                }
                                            }
                                            ?><?php echo $output;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"> Perfect money</div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroup"  name="Perfect" value="<?php  $details = $for->runMysqliQuery( "SELECT * FROM wallet");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 'No Data was returned';
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[3];
                                                }
                                            }
                                            ?><?php echo $output;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">BNB</div>
                                            </div>
                                            <input type="text" class="form-control" id="inlineFormInputGroup"  name="BNB" value="<?php  $details = $for->runMysqliQuery( "SELECT * FROM wallet");
                                            if($details['error_code'] == 1){
                                                return $details['error'];
                                            }
                                            $result = $details['data'];
                                            if(mysqli_num_rows($result) == 0) {
                                                return 'No Data was returned';
                                            }else {

                                                while ($row = mysqli_fetch_array($result)) {
                                                    $output = $row[4];
                                                }
                                            }
                                            ?><?php echo $output;?>">
                                        </div>
                                    </div>
                                    <input type="hidden" name="userId" value="<?php echo $userId; ?>" />
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