<?php require_once ('../action/main_work.php')?>
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
                            <h4>Update Wallet Address</h4>
                        </div>
                        <form >
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">Bitcoin</div>
                                        </div>
                                        <input type="text" class="form-control" id="inlineFormInputGroup"readonly name="Bitcoin" value="<?php  $details = $for->runMysqliQuery("SELECT * FROM wallet");
                                        if($details['error_code'] == 1){
                                            print_r($details);die();
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
                                        <input type="text" class="form-control" id="inlineFormInputGroup" readonly name="Ethereum" value="<?php  $details = $for->runMysqliQuery("SELECT * FROM wallet");
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
                                        <input type="text" class="form-control" id="inlineFormInputGroup" readonly name="Perfect" value="<?php  $details = $for->runMysqliQuery("SELECT * FROM wallet");
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
                                        <input type="text" class="form-control" id="inlineFormInputGroup" readonly name="BNB" value="<?php  $details = $for->runMysqliQuery("SELECT * FROM wallet");
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
                                <button class="btn btn-primary"> <div>
                                        <a class="btn btn-primary "href="wallet_update.php?userId=<?php  $details = $for->runMysqliQuery( "SELECT * FROM wallet");
                                        if($details['error_code'] == 1){
                                            return $details['error'];
                                        }
                                        $result = $details['data'];
                                        if(mysqli_num_rows($result) == 0) {
                                            return 'No Data was returned';
                                        }else {

                                            while ($row = mysqli_fetch_array($result)) {
                                                $output = $row[0];
                                            }
                                        }
                                        ?><?php echo $output;?>">click here to update</a>
                                    </div></button>
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
