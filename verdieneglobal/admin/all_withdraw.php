
<?php require_once ('../action/main_work.php')?>
<?php $alluser = $for->allwithdraw()?>

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
                            <h4>Withdraw Table</h4>
                            <br>
                            <br>
                            <!--<div class="card-header-form">-->
                            <!--    <form>-->
                            <!--        <div class="input-group">-->
                            <!--            <input type="text" class="form-control" placeholder="Search">-->
                            <!--            <div class="input-group-btn">-->
                            <!--                <button class="btn btn-primary"><i class="fas fa-search"></i></button>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </form>-->
                            <!--</div>-->
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th class="text-center">
                                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                                       class="custom-control-input" id="checkbox-all">
                                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th>UserName</th>
                                        <th>Wellet Address</th>
                                        <th>Coin</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php if (is_array($alluser)){ $no = 1;?>
                                        <?php foreach ($alluser as $k=> $allusers) { ;?>
                                            <tr>
                                            <td> <?php echo $no;?></td>
                                            <td> <?php echo $allusers ->username;?></td>
                                            <td> <?php echo $allusers -> wallet;?></td>
                                            <td> <?php echo $allusers ->coin_type ;?></td>
                                            <td> $<?php echo number_format($allusers ->amount) ;?></td>
                                            <td> <?php echo $allusers ->status ;?></td>
                                            <td> <?php echo $allusers ->created_at ;?></td>
                                            <td>           <div class="btn-group mb-2">
                                                    <button class="btn btn-danger dropdown-toggle" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                        Easy Dropdown
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="prompt.php?user_id=<?php echo $allusers->withdraw_id  ?>&action=deletel">Delate</a>
                                                        <a class="dropdown-item" href="prompt.php?user_id=<?php echo $allusers->withdraw_id  ?>&action=<?php echo $allusers->status === 'confirmed' ? 'pending':'confirmed'; ?>"><?php echo $allusers->status === 'confirmed' ? 'pending':'confirmed'; ?></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php $no++; } ?>
                                        </tr>
                                    <?php }else{ ?>
                                        <tr>
                                            <td colspan="10"><p class="text-center alert-danger alert"><?php echo $alluser; ?></p></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?php require_once "footer_1.php"?>

<?php require_once ('script_1.php')?>
