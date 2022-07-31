
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
            <div class="col-xs-6 col-xs-offset-3">
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

            </div>
        </div>
        <div class="text-center" style="margin-top: 10px">
            <a href="all_withdrawamount.php" class="btn btn-success btn-lg">Back To Users Page</a>

        </div>
    </div>

</section>
</body>
</html>


