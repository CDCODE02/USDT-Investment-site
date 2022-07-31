
<?php require_once ('../action/main_work.php')?>
<?php $alluser = $for->alluser()?>

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
                            <h4>All User Table</h4>
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
                                        <th>Full Name</th>
                                        <th>UserName</th>
                                        <th>Email</th>
                                        <th>Ref code</th>
                                        <th>Referral</th>
                                        <th>Number</th>
                                        <th>Status</th>
                                        <th>Due Date</th>
                                        <th>Type of Users</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php if (is_array($alluser)){ $no = 1;?>
                                    <?php foreach ($alluser as $k=> $allusers) { ;?>
                                    <tr>
                                            <td> <?php echo $no;?></td>
                                            <td> <?php echo $allusers ->fullname ;?></td>
                                            <td> <?php echo $allusers ->username;?></td>
                                            <td> <?php echo $allusers ->email ;?></td>
                                            <td> <?php echo $allusers ->ref_id  ;?></td>
                                            <td> <?php echo $allusers ->referral ;?></td>
                                            <td> <?php echo $allusers ->number;?></td>
                                            <td> <?php echo $allusers ->status ;?></td>
                                            <td> <?php echo $allusers ->created_at ;?></td>
                                            <td> <?php echo $allusers ->type_of_user ;?></td>
                                            <td>     <div class="dropdown d-inline mr-2">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Easy Dropdown
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="promptinter.php?user_id=<?php echo $allusers->users_unique_id?>&action=deleteled">Delate</a>
                                                        <a class="dropdown-item" href="promptinter.php?user_id=<?php echo $allusers->users_unique_id?>&action=<?php echo $allusers->status === 'confirmed' ? 'pendingi':'confirmedi'; ?>"><?php echo $allusers->status === 'confirmed' ? 'pending':'confirmed'; ?></a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
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

