
<?php if(isset($_GET['user_id']) && isset($_GET['action'])){
    $userid = $_GET['user_id'];
    $action = $_GET['action'];
}

?>
<div id="content" class="main-content">
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Delete Warning</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap-3.4.1/css/bootstrap.min.css" />
    </head>
    <body>

    <section class="container">

        <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">
            <div class="row" style="margin-top: 50px">
                <h2 class="text-center text-danger">WARNING</h2>
                <h3 class="text-center text-light alert alert-warning"> Do you really want to continue?</h3>
            </div>
            <div class="text-center" style="margin-top: 10px">
                <form action="../action/main_work.php?option=<?php echo $action ;?>" method="post">
                    <input name="user_id" type="hidden" value="<?php echo $userid ;?>">
                    <button type="submit" class="btn-info-<?php if($action === 'delete2'){ print 'danger'; } else{ echo 'success'; } ?> btn-lg">Yes</button>
                    <a href="support.php" class="btn btn-success btn-lg">No</a>
                </form>

            </div>
        </div>

    </section>
    </body>
    </html>

</div>
<!-- end page container -->


