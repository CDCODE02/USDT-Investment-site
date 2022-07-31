
<?php require_once('../action/main_work.php') ?>
<?php
if (isset($_GET['come']))
	$userId = $_GET['come'];
$userDetails = $for->selectsingleuser($userId);
$userDetail = $for->counrff($userId);
$userDetailss = $for->sumbalances($userId);

$userDetailsss = $for->sumreff($userId);
$userDetailsssamo = $for->meanamount($userId);
$userDetailssswithd = $for->meanwithdrwa($userId);
$userDetailsssinves = $for->meanwithinvest($userId);
?>
<?php require_once "head.php" ?>

<?php require_once('herder.php') ?>


<!-- start page container -->

<?php require_once('sidebar.php') ?>
<div class="main-content">

	<section class="section">
		<div class="row">
			<input type="hidden" name="userId" value="<?php echo $userId; ?>" />
			<div class="col-lg-4 col-md-4 col-12 text-center mb-lg-0 mb-md-0 mb-5">
				<div class="single-buy-box">
					<div class="single-buy-box-header">
						<h5>BUILDER PLAN</h5>
					</div>
					<div class="single-buy-box-dec">
						<h2>2.5%</h2>
						<h2>WEEKLY</h2>
						<P>Minimum: $10</P>
						<p>Maximum: $100</p>
						<p>WITHDRAW WEEKLY</p>
						<div>1% Referral Commission</div><br>
						<a href="deposit.php" class="btn-style btn-filled btn-filled-2 mb-5" style="b">Purchase plan</a>
					</div>
				</div>
			</div>
			<!-- end single buy box -->
			<div class="col-lg-4 col-md-4 col-12 text-center mb-lg-0 mb-md-0 mb-5">
				<div class="single-buy-box">
					<div class="single-buy-box-header">
						<h5>SILVER PLAN</h5>
					</div>
					<div class="single-buy-box-dec">
						<h2>3%</h2>
						<h2>WEEKLY</h2>
						<P>Minimum: $101</P>
						<p>Maximum: $1000</p>
						<p>WITHDRAW WEEKLY</p>
						<div>1% Referral Commission</div><br>
						<a href="deposit.php" class="btn-style btn-filled btn-filled-2 mb-5">Purchase plan</a>
					</div>
				</div>
			</div>
			<!-- end single buy box -->
			<div class="col-lg-4 col-md-4 col-12 text-center mb-lg-0 mb-md-0 mb-5">
				<div class="single-buy-box">
					<div class="single-buy-box-header">
						<h5>DIAMOND PLAN</h5>
					</div>
					<div class="single-buy-box-dec">
						<h2>3.5%</h2>
						<h2>WEEKLY</h2>
						<P>Minimum: $1001</P>
						<p>Maximum: $10,000</p>
						<p>WITHDRAW WEEKLY</p>
						<div>1% Referral Commission</div><br>
						<a href="deposit.php" class="btn-style btn-filled btn-filled-2 mb-5">Purchase plan</a>
					</div>
				</div>
			</div>
			<div style="margin-top: 50px;" class="col-lg-4 col-md-4 col-12 text-center mb-lg-0 mb-md-0 mb-5">
				<div class="single-buy-box">
					<div class="single-buy-box-header">
						<h5>ULTIMATE PLAN</h5>
					</div>
					<div class="single-buy-box-dec">
						<h2>4%</h2>
						<h2>WEEKLY</h2>
						<P>Minimum: $10001</P>
						<p>Maximum: $100,000</p>
						<p>WITHDRAW WEEKLY</p>
						<div>1% Referral Commission</div><br>
						<a href="deposit.php" class="btn-style btn-filled btn-filled-2 mb-5">Purchase plan</a>
					</div>
				</div>
			</div>
			<div style="margin-top: 50px;" class="col-lg-4 col-md-4 col-12 text-center mb-lg-0 mb-md-0 mb-5">
				<div class="single-buy-box">
					<div class="single-buy-box-header">
						<h5>BUSINESS PLAN</h5>
					</div>
					<div class="single-buy-box-dec">
						<h2>5%</h2>
						<h2>WEEKLY</h2>
						<P>Minimum: $100001</P>
						<p>Maximum: UNLIMITED</p>
						<p>WITHDRAW WEEKLY</p>
						<div>1% Referral Commission</div><br>
						<a href="deposit.php" class="btn-style btn-filled btn-filled-2 mb-5">Purchase plan</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>


<?php require_once "foote.php" ?>

<?php require_once('script.php') ?>