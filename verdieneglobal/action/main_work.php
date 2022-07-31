<?php
ob_start();
session_start();
// $_SESSION['start'] = time();
// $_SESSION['expire'] = time() + (86400*100);
require_once ('DatabaseQueries.php');
require_once ('validationManager.php');
require_once ('FileHandler.php');

class main_work{

    use DatabaseQueries, validationManager, FileHandler;

    function __construct()
    {
        $this->connectToDb();
        $this->callFunctions();

    }
 function callFunctions(){
        if (isset($_GET["option"])) {
            switch ($_GET["option"]){
                case 'register':
                    $this-> registerform();
                    break;
                case 'update':
                    $this-> updateuser();
                    break;
                case 'login':
                    $this-> login();
                    break;
                case 'upload_image':
                    $this->uploadPassport();
                    break;
                case 'delete_image':
                    $this->deletePassport();
                    break;
                case 'support':
                    $this-> support();
                    break;
                case 'deposit':
                    $this-> deposit();
                    break;
                case 'withdraw':
                    $this->withdraw();
                    break;
                case 'withdrawamount':
                    $this->withdrawAmount();
                    break;
                case 'upgrate':
                    //call the function that will process the form
                    $this->reinvest();
                    break;
                case 'registers':
                    $this-> adminregister();
                    break;
                case 'delete':
                    //call the function that will process the form
                    $this->manageAccount();
                    break;
                case 'block':
                    //call the function that will process the form
                    $this->manageAccounts();
                    break;
                case 'unblock':
                    //call the function that will process the form
                    $this->manageAccountss();
                    break;
                case 'deletel':
                    //call the function that will process the form
                    $this->managewithdraw();
                    break;
                case 'pending':
                    //call the function that will process the form
                    $this->managewithdra();
                    break;
                case 'confirmed':
                    //call the function that will process the form
                    $this->managewithdr();
                    break;
                case 'deleteled':
                    //call the function that will process the form
                    $this->manageusers();
                    break;
                case 'pendingi':
                    //call the function that will process the form
                    $this->manageuser();
                    break;
                case 'confirmedi':
                    //call the function that will process the form
                    $this->manageuse();
                    break;
                case 'delete2':
                    //call the function that will process the form
                    $this->managereff();
                    break;
                case 'pendiing':
                    //call the function that will process the form
                    $this->manageref();
                    break;
                case 'confiirmed':
                    //call the function that will process the form
                    $this->managere();
                    break;
                case 'wallet':
                    //call the function that will process the form
                    $this->addwallet();
                    break;
                case 'wallet_update':
                    //call the function that will process the form
                    $this->updatewallet();
                    break;
                case 'enter_email':
                    $this-> enteremail();
                    break;
                case 'password_reset':
                    $this-> enternewpassword();
                    break;
                case 'admin':
                    //call the function that will process the form
                    $this->updateadmin();
                    break;
                case 'add':
                    //call the function that will process the form
                    $this->add();
                    break;
                case 'remove':
                    //call the function that will process the form
                    $this->remove();
                    break;
                case 'withdrawBonus':
                    $this->withdrawBonus();
                    break;
                case 'delete4':
                    //call the function that will process the form
                    $this->manbonus();
                    break;
                case 'pendiiing':
                    //call the function that will process the form
                    $this->manabonus();
                    break;
                case 'confiiirmed':
                    //call the function that will process the form
                    $this->managbonus();
                    break;
                case 'logout':
                    //call the function that will process the form
                    $this->logout();
                    break;
                case 'deletellll':
                    //call the function that will process the form
                    $this->managesupport();
                    break;

                    case 'del':
                    //call the function that will process the form
                    $this->managecapital();
                    break;
                case 'pend':
                    //call the function that will process the form
                    $this->managecapitals();
                    break;
                case 'conf':
                    //call the function that will process the form
                    $this->managecapitalss();

            }
        }
    }



    function registerform(){
       $fullname= $_SESSION['fullname']=mysqli_real_escape_string($this->dbConnection, $_POST['fullname']);
        $username= $_SESSION['username']=mysqli_real_escape_string($this->dbConnection, $_POST['username']);
        $number= $_SESSION['number']=mysqli_real_escape_string($this->dbConnection, $_POST['number']);
        $password= $_SESSION['password']=mysqli_real_escape_string($this->dbConnection, $_POST['password']);
        $password2= $_SESSION['password2']=mysqli_real_escape_string($this->dbConnection, $_POST['password2']);
        $email= $_SESSION['email']=mysqli_real_escape_string($this->dbConnection, $_POST['email']);
        $r= $_SESSION['Ref']=mysqli_real_escape_string($this->dbConnection, $_POST['Ref']);

        $thingsToValidate = [
            $fullname.'|FullName|fullname|empty',
            $username.'|Username|username|empty',
            $email.'|Email|email|empty',
            $number.'|Number|number|empty',
            $password.'|Password|password|empty',
            $password2.'|Password2|password2|empty'
        ];
        $validationStatus = $this->callValidation($thingsToValidate);
     //   print_r($validationStatus); die();
        if($validationStatus === false){
            $_SESSION['formError'] = $this->errors;
            header('location:../register.php');
            return;
        }
          //   print_r($thingsToValidate); die();

        $usernameUniqueness = $this->checkUniqueValueInDatabase('users', 'username', $username);
        if($usernameUniqueness > 0){
            $_SESSION['formError'] = ['general_error'=>['Username exists']];
            header('location:../register.php');
            return;
        }

        $emailUniqueness = $this->checkUniqueValueInDatabase('users', 'email', $email);
        if($emailUniqueness > 0){
            $_SESSION['formError'] = ['general_error'=>['Email Address exists']];
            header('location:../register.php');
            return;
        }
        // print_r($r); die();

        $users_unique_id = $this->createUniqueID('users', 'users_unique_id');

        $ref_id  = $this->createUniqueID('users', 'ref_id ');

        $hashedPasword = $this->hasHer($password);

        $createuse = $this->insertIntoUsersTable($fullname, $username, $email,$number, $hashedPasword, $users_unique_id, $ref_id, $r );
            if ($createuse['error_code'] == 1){
            $_SESSION['formError']=['general_error' =>[$createuse['error']] ];
            header('location:../register.php');
            return;
        }

        if ($createuse){
            $to  = $email;
            $d = date('Y');
            $subject = "Welcome To Stableearner";
            $message = '
                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head>
                                <body>
                    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
                    <div style="font-size: 14px;">
					<p>Welcome and congratulations on joining Stableearner; Your account has been confirmed. You can now <a href="https://www.stableearner.com/login.php">Login</a> to your account using your registered password.<br>
						Get ready to participate in profitable investment!.</p>
					<p style="">Thanks!</p>
					<p style="color:#332E2E">Best Regard<br />
                    stableearner Team<br />
                    Email: stableearner@gmail.com<br /></p>
				
			
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
		</div>
		</body>
		</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail($to,$subject, $message, $header);
            if ($retval = true) {
                header('location:../register.php?success=Registration was successful');
                // header("location:login.php");
            }else {
                return  'Internal error. Mail fail to send';
            }
            header('location:../register.php?success=Registration was successful');
        }
        $to  = 'stableearner@gmail.com';
        $d = date('Y');
        $subject = "Welcome To Stableearner";
        $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
    <div style="font-size: 14px;">
    <p>'.$username.'. has Successfully Register on Stableearner.</p>
    <p style="">Thanks For Your Compliance!</p>
    <p style="color:#332E2E">Best Regard<br />
    Stableearner Team<br />
    Email: support@stableearner.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;Stableearner <?php print ' . $d . ';?>. All Rights Reserved.</p>
</div>
</body>
</html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: support@stableearner.com>' . "\r\n";
        $retval = @mail('stableearner@gmail.com', $subject, $message, $header);
        if ($retval = true) {
            header("location:../users/dashboard.php?come=$users_unique_id");
        } else {
            return  'Internal error. Mail fail to send';
        }
        header("location:../users/dashboard.php?come=$users_unique_id");
        if ($createuse){
            $dsr = "SELECT * FROM users WHERE ref_id = '$ref_id'";
            $resu = $this->runMysqliQuery($dsr);
            if($resu['error_code'] == 1){
                return $resu['error'];
            }
            $resul = $resu['data'];
            if(mysqli_num_rows($resul) > 0) {
                while($row = mysqli_fetch_assoc($resul)){
                    $r = $row['referral'];
                }
            }
            $dsrs = "SELECT * FROM users WHERE ref_id = '$r'";
            $resus = $this->runMysqliQuery($dsrs);
            if($resus['error_code'] == 1){
                return $resus['error'];
            }
            $result = $resus['data'];
            if(mysqli_num_rows($result) == 0){
                return 'no';
            }else{
                while($row = mysqli_fetch_array($result)){
                    $refemail = $row['email'];
                    $refname = $row['username'];
                }
                $to  = $refemail;
                $d = date('Y');
                $subject = "Welcome To Stableearner";
                $message = '
                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head>
                                <body>
                    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
                    <div style="font-size: 14px;">
					<p>Hello '.$refname.' <br>
						You Reffered : '.$fullname.' <br> you will receive 1% each time he makes a deposit.</p>
					<p style="">Thanks!</p>
					<p style="color:#332E2E">Best Regard<br />
                    Stableearner Team<br />
                    Email: support@stableearner.com<br /></p>

			
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;All Rights Reserved.</p>
		</div>
		</body>
		</html>';
                $header = "MIME-Version: 1.0" . "\r\n";
                $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
                $retval = @mail($to, $subject, $message, $header);
                if ($retval = true) {
                    return  'Verification Mail sent successfully?success=Registration was successful';
                    // header("location:login.php");
                } else {
                    return  'Internal error. Mail fail to send';
                }
                header('location:../register.php?success=Registration was successful');

            }

        }
        header("location:../users/dashboard.php?come=$users_unique_id");
    }

    function login(){
        $email= $_SESSION['email']=mysqli_real_escape_string($this->dbConnection, $_POST['email']);
        $password= $_SESSION['password']=mysqli_real_escape_string($this->dbConnection, $_POST['password']);

        $thingsToValidate = [
            $email.'|Email|email|empty',
            $password.'|Password|Passwords|empty'
        ];
        $validationStatus = $this->callValidation($thingsToValidate);
        //print_r($validationStatus);die();
        if($validationStatus === false) {
            $_SESSION['formError'] = $this->errors;
            header('location:../login.php');
            return;
            // print_r($back);die();
        }
        // print_r($validationStatus); die();
        $hashedPasword = $this->hasHer($password);

        $calllogin = $this->loginHandler($email,$hashedPasword);
        if ($calllogin['error_code']== 1 ){
            $_SESSION['formError'] = ['general_error'=>[$calllogin['error']]];
            header('location:../login.php');

        }
        $queryResult = $calllogin['data'];
        if(mysqli_num_rows($queryResult) == 1){
            //create the login sessions
            while($row = mysqli_fetch_object($queryResult)){
                $users_unique_id = $row->users_unique_id;
                $fullname = $row->fullname;
                $email = $row->email;
                $username = $row->username;
                $ref_id = $row->ref_id;
                $r = $row->referral;
                $bal = $row->balance;
                $interest = $row->interest;
                $main_amount = $row->main_amount;
                $_SESSION['userUniqueId'] = $users_unique_id;
                $_SESSION['userFullname'] = $fullname;
                $_SESSION['userEmail'] = $email;
                $_SESSION['userUsername'] = $username;
                $_SESSION['userRef_id'] = $ref_id;
                $_SESSION['Ref'] = $r;
                $_SESSION['balance'] = $bal;
                $_SESSION['main_amount'] = $main_amount;
                $typeOfUser = $row->type_of_user;


            }
            if($typeOfUser === 'users'){
                //redirect the user to admin dashboard
                header("location:../users/dashboard.php?come=$users_unique_id");
            }else{
                //redirect the user to his dashboard
                header('location:../admin/dashborad_1.php');
            }
        }else{
            $_SESSION['formError'] = ['general_error'=>['Incorrect Username/Email or Password']];
            header('location:../login.php');
        }

    }
    function valdateSession($foider){
        if(!isset($_SESSION['userUniqueId'])){
            $_SESSION['formError'] = ['general_error'=>['Please Login to continue']];
            //print_r($_SESSION['formError']); die();
            header('location:'.$foider);
        }
    }

    function valdatereff($foider){
        if(!isset($_SESSION['userRef_id'])){
            $_SESSION['formError'] = ['general_error'=>['Please Login to continue']];
            //print_r($_SESSION['formError']); die();
            header('location:'.$foider);
        }else{
            $currentTime = time();
            if($currentTime > $_SESSION['expire']){
                session_destroy();
                header('location:../login.php');
            }
        }
    }


    //this function is to upload a passport
    function uploadPassport(){

        //call d upload method
        $fileUpload = $this->FileUploader('passport', ['jpg', 'png', 'gif', 'jpeg'], 2000000, '3megabyte', '../images/');

        if ($fileUpload['error_code'] == 1) {
            # code...
            
            $_SESSION['formError'] = ['general_error'=>[$fileUpload['error']]];
            header('location:../users/profile.php');
            return;
        }

        //run an update on the users row
        $userId = $_SESSION['userUniqueId'];
        $imageName = $fileUpload['data'];

        
        $query = "UPDATE users SET image_name = '$imageName' WHERE users_unique_id = '$userId'";
        $updateDetails = $this->runMysqliQuery($query);

        if ($updateDetails['error_code'] == 1) {
            # code...
            $_SESSION['formError'] = ['general_error'=>[$updateDetails['error'] ]];
            header('location:../users/profile.php');
            return;
        }

        header('location:../users/profile.php?success=Image upload was successful');
    }
    
    function deletePassport(){

        $imageName = "../images/prof_icon.png";
//print_r($imageName); die();
        $userId = $_SESSION['userUniqueId'];
            $query = "UPDATE users SET image_name = '$imageName' WHERE users_unique_id = '$userId'";
            $details = $this->runMysqliQuery($query);
            
            if ($details['error_code'] == 1) {
                # code...
                $_SESSION['formError'] = ['general_error'=>[$details['error'] ]];
                header('location:../users/profile.php');
                return;
            }
            header('location:../users/profile.php?success=Image was deleted');
        
    }
    
    function getLoggedInUserDetails($userID){
        $query = "SELECT * FROM users WHERE users_unique_id = '$userID'";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            $row = mysqli_fetch_object($result);
            return $row;
        }
        // print_r($query); die();

    }
    function getLoggedInUserreff($userID){
        $query = "SELECT * FROM users WHERE ref_id = '$userID'";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            $row = mysqli_fetch_object($result);
            return $row;
        }
        // print_r($query); die();

    }

    function updateuser()
    {
        $fullname = mysqli_real_escape_string($this->dbConnection, $_POST['fullname']);
        $username = mysqli_real_escape_string($this->dbConnection, $_POST['username']);
        $email = mysqli_real_escape_string($this->dbConnection, $_POST['email']);
        $userId = mysqli_real_escape_string($this->dbConnection, $_POST['userId']);

        $thingsToValidate = [
            $fullname.'|FullName|fullname|empty',
            $username.'|Username|username|empty',
            $email.'|Email|email|empty',
        ];

        $validationStatus = $this->callValidation($thingsToValidate);
        if($validationStatus === false){
            $_SESSION['formError'] = $this->errors;
            header('location:../users/update.php');
            return;
        }


        $query = "UPDATE users SET fullname = '$fullname', username = '".$username."', email = '$email' WHERE users_unique_id = '$userId'";
        $updateDetails = $this->runMysqliQuery($query);
        if($updateDetails['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $updateDetails['error']]];
            header("location:../users/update.php");
            return;
        }
        header ('location:../users/update.php?&success=Profile was updated successfully');
    }

    function alluser(){
        $UserDetails = [];
        $query = "SELECT * FROM users";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }
    function allreferral(){
        $UserDetails = [];
        $query = "SELECT * FROM referral_tb	";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }
    function url(){
        $url = "https://blockchain.info/stats?format=json";
        $stats = file_get_contents($url);
        $json = json_decode($stats,true);
        $btcvalum = $json['market_price_usd'];
        $_SESSION['btc_value'] = $btcvalum;
        return $btcvalum;
    }
    /* function BTC($amount){
         $btcValue = $this->url();
         $currBTC = $amount / $btcValue;
         return $currBTC;
     }*/
    function deposit()
    {
        $plan = $_SESSION['plan'] = mysqli_real_escape_string($this->dbConnection, $_POST['plan']);
        $btc = $_SESSION['coin'] = mysqli_real_escape_string($this->dbConnection, $_POST['coin']);
        $amount = $_SESSION['amount'] = mysqli_real_escape_string($this->dbConnection, $_POST['amount']);

        $thingsToValidate = [
            $plan . '|Plan|plan|empty',
            $btc . '|Coin|coin|empty',
            $amount . '|Amount|amount|empty',

        ];
        //     print_r($thingsToValidate);die();

        $validationStatus = $this->callValidation($thingsToValidate);
        if ($validationStatus === false) {
            $_SESSION['formError'] = $this->errors;
            header('location:../users/deposit.php');
            return;
        }
        //  print_r($validationStatus);die();
        $deposit_id = $this->createUniqueID('deposit_tb', 'deposit_id');
        $ref_id = $_SESSION['userRef_id'];
        $bal = $_SESSION['balance'];
        $r = $_SESSION['Ref'];
        $users_unique_id = $_SESSION['userUniqueId'];
        $username = $_SESSION['userUsername'];
        $btc_amount = 0;
        $email = $_SESSION['userEmail'];
        
        if($plan === 'Builder Plan'  &&( $amount > 100 ||  $amount < 10) ){
            $_SESSION['formError'] = ['general_error'=>['Please Amount should be between $10-$100']];
            header('location:../users/deposit.php');
            return;
    }
        if($plan === 'Silver Plan'  && ($amount > 1000 ||  $amount < 101)){
            $_SESSION['formError'] = ['general_error'=>['Please Amount should be between $101-$1,000']];
            header('location:../users/deposit.php');
            return;
    }
        if($plan === 'Diamond Plan'  && ($amount > 10000 ||  $amount < 1001)){
            $_SESSION['formError'] = ['general_error'=>['Please Amount should be between $1,001-$10,000']];
            header('location:../users/deposit.php');
             return;
    }
        if($plan === 'Ultimate Plan'  && ($amount > 10001 ||  $amount < 100000)){
            $_SESSION['formError'] = ['general_error'=>['Please Amount should be between $10,001-$100,000']];
            header('location:../users/deposit.php');
             return;
    }
         if($plan === 'Business Plan'  && ($amount < 100001)){
            $_SESSION['formError'] = ['general_error'=>['Please Amount should be between $100,001-Unlimted Amount']];
            header('location:../users/deposit.php');
             return;
    }

        $fileUpload = $this->FileUploader('fileToUpload', ['jpg', 'png', 'gif', 'jpeg'], 2000000, '3megabyte', '../images/');
        if($fileUpload['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[$fileUpload['error']]];
            header('location:../users/deposit.php');
            return;
        }
        $imageName = $fileUpload['data'];



        $query = "INSERT INTO deposit_tb (id,users_unique_id,deposit_id,username,email,plan,coin_type,referral,ref_id,amount,interest,image)VALUES(null,'" . $users_unique_id . "','" . $deposit_id . "','" . $username . "','" . $email . "','".$plan."','" . $btc . "','" . $r . "','" . $ref_id . "','" . $amount . "','" . $btc_amount . "','" . $imageName . "') ";
        $results = $this->runMysqliQuery($query);
        //print_r($result);die();
        if ($results['error_code'] == 1) {
            $_SESSION['formError'] = ['general_error' => [$results['error']]];
            header('location:../users/deposit.php');
            return;
        }


        if ($results) {
            $to  = $email;
            $d = date('Y');
            $ego = $amount;
            $subject = "Deposited To stableearner";
            $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner"/></h6>
    <div style="font-size: 14px;">
    <p>Hello '.$username.' You have Successfully Deposited  amount of $ '.$ego.', You are meant to copy the wallet address showing on your Dashboard and deposite the Amount equivalent so that your transaction can be confirmed and your Interest can start Accruing.</p>
    <p style="color:#332E2E">Best Regard<br />
    stableearner Team<br />
    Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail($to, $subject, $message, $header);
            if ($retval = true) {
                header("location:../users/deposit.php?success=deposit was successful");
            } else {
                return  'Internal error. Mail fail to send';
            }
            header("location:../users/deposit.php?success=deposit was successful");
        }
        $to  = 'stableearner@gmail.com';
        $d = date('Y');
        $use = $username;
        $ego = $amount;
        $subject = "Deposited To Stableearner";
        $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
    <div style="font-size: 14px;">
    <p>'.$username.'. has Successfully Deposited on Stableearner amount is $ '.$ego.',.</p>
    <p style="">Thanks For Your Compliance!</p>
    <p style="color:#332E2E">Best Regard<br />
    stableearner Team<br />
    Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
        $retval = @mail('stableearner@gmail.com', $subject, $message, $header);
        if ($retval = true) {
            header("location:../users/deposit.php?success=deposit was successful");
        } else {
            return  'Internal error. Mail fail to send';
        }



        header("location:../users/deposit.php?success=deposit was successful");

    }
     function allwithdrawbonus(){
        $UserDetails = [];
        $query = "SELECT * FROM with_bonus";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }

    
     function GetfName($userId){
        $query = "SELECT * FROM users WHERE users_unique_id = '$userId'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return [
                'count'=>0,
                'data'=>[]
            ];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return [
                'count'=>0,
                'data'=>[]
            ];
        }else{
            while($row = mysqli_fetch_array($result)){
                $r = $row['referral'];
            }
                $dsr = "SELECT * FROM users WHERE ref_id = '$r'";
             //   print_r($dsr);die();
                $resu = $this->runMysqliQuery($dsr);
                if($resu['error_code'] == 1){
                    return [
                        'count'=>0,
                        'data'=>[]
                    ];
                }
                $resul = $resu['data'];
                if(mysqli_num_rows($resul) > 0) {
                    while($rows = mysqli_fetch_assoc($resul)){
                       $refObject = $rows;
                    }
                    return [
                        'count'=>mysqli_num_rows($resul),
                        'data'=>$refObject
                    ];
                }
                //   print_r($username);die();
            return [
                'count'=>0,
                'data'=>[]
            ];
        }
    }


    function deycounter(){
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' AND day_counter < 360";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $id = $row['id'];
                //print_r($id);die();
                $day_on = date('D');
                $count_value = $row['day_counter'];
                $new_countValue = $count_value + 1;
                $querys = "UPDATE deposit_tb SET day_counter = '".$new_countValue."' WHERE id = '".$id."' AND status = 'confirmed' AND day_counter < 360 ";
                $details = $this->runMysqliQuery($querys);

                if($details['error_code'] == 1){
                    $_SESSION['formError'] = ['general_error'=>[ $details['error'] ] ];
                    header("location:../counter.php");
                    return;
                }

                //header("location:../counter.php?success=deycounter one is successful");

            }
        }

    }
    function BuilderPlain(){
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' AND day_counter < 360 AND plan = 'Builder Plan'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $id = $row['id'];
                $day_on = date('D');
                $amount = $row['amount'];
                $plan = $row['plan'];
                $interest = $row['interest'];
                if($plan == 'Builder Plan'){
                    $dayInt = ($amount/100)*3.5;
                }
                $main_interest = $interest + $dayInt;
                $querys = "UPDATE deposit_tb SET interest = '".$main_interest."' WHERE id = '".$id."' AND status = 'confirmed' AND day_counter < 360 AND plan = 'Builder Plan'";
                $details = $this->runMysqliQuery($querys);//run the query

                if($details['error_code'] == 1){
                    $_SESSION['formError'] = ['general_error'=>[ $details['error'] ] ];
                    header("location:../counter.php");
                    return;
                }
                // header("location:../counter.php?success=premiunplan one is successful");

            }
        }

    }

    function SilverPlain(){
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' AND day_counter < 290 AND plan = 'Silver Plan'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 0;
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $day_on = date('D');
                $id = $row['id'];
                $amount = $row['amount'];
                $plan = $row['plan'];
                $interest = $row['interest'];
                // if($plan == 'Silver Plan'){
                //     $dayInt = ($amount/100)*4.5;
                // }
                $dayInt = ($amount/100) * 4.5;
                $main_interest = $interest + $dayInt;
                //   print_r($main_interest);die();
                $querys = "UPDATE deposit_tb SET interest = '".$main_interest."' WHERE id = '".$id."' AND status = 'confirmed' AND day_counter < 360 AND plan = 'Silver Plan'";
                $details = $this->runMysqliQuery($querys);//run the query

                if($details['error_code'] == 1){
                    $_SESSION['formError'] = ['general_error'=>[ $details['error'] ] ];
                    header("location:../counter.php");
                    return;
                }
                // header("location:../counter.php?success=premiunplan one is successful");

            }
        }

    }

    function DiamondPlain(){
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' AND day_counter < 360 AND plan = 'Diamond Plan'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $id = $row['id'];
                $day_on = date('D');
                $amount = $row['amount'];
                $plan = $row['plan'];
                if($plan == 'Diamond Plan'){
                    $dayInt = ($amount/100)*6.5;
                }
                $main_interest = $amount + $dayInt;
                $querys = "UPDATE deposit_tb SET interest = '".$main_interest."' WHERE id = '".$id."' AND status = 'confirmed' AND day_counter < 360 AND plan = 'Diamond Plan'";
                $details = $this->runMysqliQuery($querys);//run the query

                if($details['error_code'] == 1){
                    $_SESSION['formError'] = ['general_error'=>[ $details['error'] ] ];
                    header("location:../counter.php");
                    return;
                }
                // header("location:../counter.php?success=premiunplan one is successful");

            }
        }

    }

    function UltimatePlain(){
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' AND day_counter < 360 AND plan = 'Ultimate Plan'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $id = $row['id'];
                $day_on = date('D');
                $amount = $row['amount'];
                $plan = $row['plan'];
                if($plan == 'Ultimate Plan'){
                    $dayInt = ($amount/100)*8.5;
                }
                $main_interest = $amount + $dayInt;
                $querys = "UPDATE deposit_tb SET interest = '".$main_interest."' WHERE id = '".$id."' AND status = 'confirmed' AND day_counter < 360 AND plan = 'Ultimate Plan'";
                $details = $this->runMysqliQuery($querys);//run the query

                if($details['error_code'] == 1){
                    $_SESSION['formError'] = ['general_error'=>[ $details['error'] ] ];
                    header("location:../counter.php");
                    return;
                }
                // header("location:../counter.php?success=premiunplan one is successful");

            }
        }

    }

    function BusinessPlain(){
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' AND day_counter < 360 AND plan = 'Business Plan'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $id = $row['id'];
                $day_on = date('D');
                $amount = $row['amount'];
                $plan = $row['plan'];
                if($plan == 'Business Plan'){
                    $dayInt = ($amount/100)*10;
                }
                $main_interest = $amount + $dayInt;
                $querys = "UPDATE deposit_tb SET interest = '".$main_interest."' WHERE id = '".$id."' AND status = 'confirmed' AND day_counter < 360 AND plan = 'Business Plan'";
                $details = $this->runMysqliQuery($querys);//run the query

                if($details['error_code'] == 1){
                    $_SESSION['formError'] = ['general_error'=>[ $details['error'] ] ];
                    header("location:../counter.php");
                    return;
                }
                // header("location:../counter.php?success=premiunplan one is successful");

            }
        }

    }

    
    function ref(){
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' AND ref = 0";
        $details = $this->runMysqliQuery($query);//run the query
        // print_r($details);die();
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) > 0) {

            while($row = mysqli_fetch_assoc($result)){
                $username = $row['username'];
                $users_unique_id = $row['users_unique_id'];
                $plan = $row['plan'];
                $coin_type = $row['coin_type'];
                $amount = $row['amount'];
                $r = $row['referral'];
                $ref_id = $row['ref_id'];
                if ($r != "non"){

                    if ($plan == 'Builder Plan' ){
                        $amo = ($amount/100)*1;
                    }elseif ($plan == 'Silver Plan' ){
                        $amo = ($amount/100)*1;
                    }elseif ($plan == 'Diamond Plan' ){
                        $amo = ($amount/100)*1;
                    }elseif ($plan == 'Ultimate Plan' ){
                        $amo = ($amount/100)*1;
                    }elseif ($plan == 'Ultimate Plan' ){
                        $amo = ($amount/100)*1;
                    }

                    $a = $amo;

                    $referral_id = $this->createUniqueID('referral_tb', 'referral_id');

                    $querys = "INSERT INTO referral_tb (id,referral_id,users_unique_id,plan,coin_type,amount,referral,ref_id,ref_amount,username) VALUES (null,  '".$referral_id."','".$users_unique_id."','".$plan."', '".$coin_type."', '".$amount."', '".$r."', '".$ref_id."', '".$a."','".$username."')";
                    $resultss = $this->runMysqliQuery($querys);
                    if ($resultss['error_code'] == 1) {
                        $_SESSION['formError'] = ['general_error' => [$resultss['error']]];
                        header('location:../users/counter.php');
                        return;
                    }
//                    print_r($resultss);die();
                    if ($resultss){
                        $naw = 1;
                        $quer = "UPDATE deposit_tb SET ref ='".$naw."'WHERE referral = '".$r."'  AND  plan = '".$plan."'";
                        $results = $this->runMysqliQuery($quer);
                        if($results['error_code'] == 1){
                            return $results['error'];
                        }
                    }
                    //  header("location:../users/counter.php?success");
                }
            }
        }
    }

    function countref(){
        $query = "SELECT * FROM users";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_array($result); $i++) {
                $ref_id = $row['ref_id'];
                $users_unique_id = $row['users_unique_id'];
                $querys = "SELECT COUNT(ref) FROM deposit_tb WHERE referral = '".$ref_id."'";
                //    print_r($querys);die();
                $detail = $this->runMysqliQuery($querys);//run the query
                if($detail['error_code'] == 1){
                    return $detail['error'];
                }
                $resul = $detail['data'];
                //   print_r($resul);die();
                if(mysqli_num_rows($resul) == 0) {
                    return 'No Data was returned';
                }
                if($resul){
                    //  print_r($resul);die();
                    for ($i=0; $ro = mysqli_fetch_array($resul); $i++) {
                        $amount = $ro[0];
                        $quers = "UPDATE users SET num_ref ='".$amount."' WHERE users_unique_id  = '".$users_unique_id."'" ;
                        $detai = $this->runMysqliQuery($quers);//run the query
                        if($detai['error_code'] == 1){
                            $_SESSION['formError'] = ['general_error'=>[ $detai['error'] ] ];
                            header("location:../counter.php");
                            return;
                        }
                    }
                }
            }
        }
    }

    function counrff($userId){
        $query = "SELECT * FROM users  WHERE users_unique_id = '".$userId."'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else {
            while ($row = mysqli_fetch_array($result)) {
                $ref_id = $row['ref_id'];
                $dsr = "SELECT COUNT(referral) FROM users WHERE referral = '$ref_id'";
                //  print_r($dsr);die();
                $resu = $this->runMysqliQuery($dsr);
                if($resu['error_code'] == 1){
                    return $resu['error'];
                }
                $resul = $resu['data'];
                if(mysqli_num_rows($resul) > 0) {
                    while ($row = mysqli_fetch_array($resul)) {
                        $output = $row[0];
                        //         print_r($output);die();
                    }
                    return $output;
                }
            }
        }
    }

    function reinvest(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);
        $option = trim($_GET['option']);
        if($option === 'upgrate'){
        $query = "SELECT * FROM deposit_tb WHERE deposit_id = '$user_id'";
        $message = "your are successfully Re_invest";
    }
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $id = $row['id'];
                $amount = $row['amount'];
                $interest = $row['interest'];
                $day_counter = $row['day_counter'];
            }
            $reamount = $amount + $interest;
        $querys = "UPDATE deposit_tb SET amount = '".$reamount."',interest = 0, day_counter = 0 WHERE deposit_id = '".$user_id."'";
       // print_r($querys);die();
        $detailss = $this->runMysqliQuery($querys);
       //print_r($detailss);die();
        if($detailss['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $detailss['error'] ] ];
            header("location:../users/button_reinvest.php?success");
            return;
    }
    header("location:../users/no_button_invest.php?success=$message");
   }
}


function withdrawAmount(){
    $wallet= $_SESSION['wallet']=mysqli_real_escape_string($this->dbConnection, $_POST['wallet']);
    $coin= $_SESSION['coin']=mysqli_real_escape_string($this->dbConnection, $_POST['coin']);
    $amount= $_SESSION['amount']=mysqli_real_escape_string($this->dbConnection, $_POST['amount']);
    $userId= $_SESSION['userId']=mysqli_real_escape_string($this->dbConnection, $_POST['userId']);

    $thingsToValidate = [
        $wallet.'|Wallet|wallet|empty',
        $coin.'|Coin|coin|empty',
        $amount.'|Amount|amount|empty',
    ];

    $validationStatus = $this->callValidation($thingsToValidate);
    if($validationStatus === false) {
        $_SESSION['formError'] = $this->errors;
        header('location:../users/withdrawamount.php');
        return;
    }

    $drawal_deposit_id= $this->createUniqueID('with_amount', 'withdraw_id');
    $users_unique_id = $_SESSION['userUniqueId'];
    $username = $_SESSION['userUsername'];
    $email = $_SESSION['userEmail'];

    $query = "SELECT * FROM deposit_tb WHERE deposit_id = '".$userId."'";
    $details = $this->runMysqliQuery($query);//run the query
    if($details['error_code'] == 1){
        return $details['error'];
    }
    $result = $details['data'];
    if(mysqli_num_rows($result) == 0) {
        return 'No Data was returned';
    }
    if($result){
        for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
            $deposit_id = $row['deposit_id'];
            $plan = $row['plan'];
            $day_counter = $row['day_counter'];
            $bal = $row['amount'];
       //   print_r($day_counter);die();
    }
}
   if(($plan === 'Builder Plan' && $day_counter >= 5) ||  ($plan === 'Silver Plan' && $day_counter >= 7) ||  ($plan === 'Diamond Plan' && $day_counter >= 10) ||  ($plan === 'Ultimate Plan' && $day_counter >= 14) ||  ($plan === 'Business Plan' && $day_counter >= 21)){
    $querys = "INSERT INTO with_amount (id,withdraw_id,users_unique_id,username,email,wallet,coin_type,amount)VALUES(null,'".$drawal_deposit_id."','".$users_unique_id."','".$username."','".$email."','".$wallet."','".$coin."','".$amount."') ";
    $resul = $this->runMysqliQuery($querys);
    //  print_r($result);die();

    if($resul['error_code'] == 1){
        $_SESSION['formError'] = ['general_error'=>[ $resul['error'] ] ];
        header('location:../users/withdrawamount.php');
        return;
    }
    $dequery = "SELECT * FROM deposit_tb  WHERE deposit_id = '$deposit_id'";
    $dedetails = $this->runMysqliQuery($dequery);
    if($dedetails['error_code'] == 1){
        return $dedetails['error'];
    }
    $deresult = $dedetails['data'];
    if(mysqli_num_rows($deresult) == 0){
        return 'No Data was returned';
    }if($deresult){
        for ($i=0; $rows = mysqli_fetch_assoc($deresult); $i++){
            $interest  = $rows['amount'];
        }
        $int = ($bal - $amount);
        $quers = "UPDATE deposit_tb SET amount ='".$int."' WHERE deposit_id  = '".$deposit_id."'" ;
     //   print_r($quers);die();
        $detai = $this->runMysqliQuery($quers);//run the query
        if($detai['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $detai['error'] ] ];
            header("location:../users/withdrawamount.php");
            return;
        }
    
    if ($detai) {
        $to  = $email;
        $ego = $amount;
        $d = date('Y');
        $subject = "withdraw To Stableearner";
        $message = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>
            <body>
<h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
<div style="font-size: 14px;">
 <p>You have Successfully Created a withdrawal Ticket on stableearner  Amount $'.$ego.'., You are meant to wait for a period of 30 min so that the Money equivalent will be sent to your Wallet address on your Dashboard.</p>
<p style="">Thanks For Your Compliance!</p>
<p style="color:#332E2E">Best Regard<br />
stableearner Team<br />
Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
        $retval = @mail($to, $subject, $message, $header);
        if ($retval = true) {
            header("location:../users/withdrawamount.php?success=withdrawal was successful");
        } else {
            return  'Internal error. Mail fail to send';
        }
        header("location:../users/withdrawamount.php?success=withdrawal was successful");
        // return("Deposite Successfully");
    }
    $to  = 'stableearner@gmail.com';
    $d = date('Y');
    $use = $username;
    $ego = $amount;
    $subject = "withdraw To Stableearner";
    $message = '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>
            <body>
<h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
<div style="font-size: 14px;">
 <p>'.$use.'. has Successfully Withdraw on stableearner amount is $'.$ego.'</p>
<p style="">Thanks For Your Compliance!</p>
<p style="color:#332E2E">Best Regard<br />
stableearner Team<br />
Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
    $header = "MIME-Version: 1.0" . "\r\n";
    $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
    $retval = @mail('stableearner@gmail.com', $subject, $message, $header);
    if ($retval = true) {
        header("location:../users/withdrawamount.php?success=withdrawal was successful");
    } else {
        return  'Internal error. Mail fail to send';
    }


    header('location:../users/withdrawamount.php?success=withdrawal was successful');
}
    }else{
        $_SESSION['formError'] = ['general_error'=>['your are not allow to withdraw']];
        header('location:../users/withdrawamount.php');
    }




}




    function withdraw(){
        $wallet= $_SESSION['wallet']=mysqli_real_escape_string($this->dbConnection, $_POST['wallet']);
        $coin= $_SESSION['coin']=mysqli_real_escape_string($this->dbConnection, $_POST['coin']);
        $amount= $_SESSION['amount']=mysqli_real_escape_string($this->dbConnection, $_POST['amount']);
        $userId= $_SESSION['userId']=mysqli_real_escape_string($this->dbConnection, $_POST['userId']);

        $thingsToValidate = [
            $wallet.'|Wallet|wallet|empty',
            $coin.'|Coin|coin|empty',
            $amount.'|Amount|amount|empty',
        ];

        $validationStatus = $this->callValidation($thingsToValidate);
        if($validationStatus === false) {
            $_SESSION['formError'] = $this->errors;
            header('location:../users/withdraw.php');
            return;
        }

        $drawal_deposit_id= $this->createUniqueID('withdrawal', 'withdraw_id');
        $users_unique_id = $_SESSION['userUniqueId'];
        $username = $_SESSION['userUsername'];
        $email = $_SESSION['userEmail'];

        $query = "SELECT * FROM deposit_tb WHERE deposit_id = '".$userId."'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $deposit_id = $row['deposit_id'];
                $plan = $row['plan'];
                $day_counter = $row['day_counter'];
                $bal = $row['interest'];
           //   print_r($day_counter);die();
        }
    }
       if(($plan === 'Builder Plan' && $day_counter >= 5) ||  ($plan === 'Silver Plan' && $day_counter >= 7) ||  ($plan === 'Diamond Plan' && $day_counter >= 10) ||  ($plan === 'Ultimate Plan' && $day_counter >= 14) ||  ($plan === 'Business Plan' && $day_counter >= 21)){
        $querys = "INSERT INTO withdrawal (id,withdraw_id,users_unique_id,username,email,wallet,coin_type,amount)VALUES(null,'".$drawal_deposit_id."','".$users_unique_id."','".$username."','".$email."','".$wallet."','".$coin."','".$amount."') ";
        $resul = $this->runMysqliQuery($querys);
        //  print_r($result);die();

        if($resul['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $resul['error'] ] ];
            header('location:../users/withdraw.php');
            return;
        }
        $dequery = "SELECT * FROM deposit_tb  WHERE deposit_id = '$deposit_id'";
        $dedetails = $this->runMysqliQuery($dequery);
        if($dedetails['error_code'] == 1){
            return $dedetails['error'];
        }
        $deresult = $dedetails['data'];
        if(mysqli_num_rows($deresult) == 0){
            return 'No Data was returned';
        }if($deresult){
            for ($i=0; $rows = mysqli_fetch_assoc($deresult); $i++){
                $interest  = $rows['interest'];
            }
            $int = ($bal - $amount);
            $quers = "UPDATE deposit_tb SET interest ='".$int."' WHERE deposit_id  = '".$deposit_id."'" ;
         //   print_r($quers);die();
            $detai = $this->runMysqliQuery($quers);//run the query
            if($detai['error_code'] == 1){
                $_SESSION['formError'] = ['general_error'=>[ $detai['error'] ] ];
                header("location:../users/withdraw.php");
                return;
            }
        
        if ($detai) {
            $to  = $email;
            $ego = $amount;
            $d = date('Y');
            $subject = "withdraw To Stableearner";
            $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
    <div style="font-size: 14px;">
     <p>You have Successfully Created a withdrawal Ticket on stableearner  Amount $'.$ego.'., You are meant to wait for a period of 30 min so that the Money equivalent will be sent to your Wallet address on your Dashboard.</p>
    <p style="">Thanks For Your Compliance!</p>
    <p style="color:#332E2E">Best Regard<br />
    stableearner Team<br />
    Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail($to, $subject, $message, $header);
            if ($retval = true) {
                header("location:../users/withdraw.php?success=withdrawal was successful");
            } else {
                return  'Internal error. Mail fail to send';
            }
            header("location:../users/withdraw.php?success=withdrawal was successful");
            // return("Deposite Successfully");
        }
        $to  = 'stableearner@gmail.com';
        $d = date('Y');
        $use = $username;
        $ego = $amount;
        $subject = "withdraw To Stableearner";
        $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
    <div style="font-size: 14px;">
     <p>'.$use.'. has Successfully Withdraw on stableearner amount is $'.$ego.'</p>
    <p style="">Thanks For Your Compliance!</p>
    <p style="color:#332E2E">Best Regard<br />
    stableearner Team<br />
    Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
        $retval = @mail('stableearner@gmail.com', $subject, $message, $header);
        if ($retval = true) {
            header("location:../users/withdraw.php?success=withdrawal was successful");
        } else {
            return  'Internal error. Mail fail to send';
        }


        header('location:../users/withdraw.php?success=withdrawal was successful');
    }
        }else{
            $_SESSION['formError'] = ['general_error'=>['your are not allow to withdraw']];
            header('location:../users/withdraw.php');
        }

        
        
       // print_r('jhwdasjksjkak.accordion-box');die();
       /*  if(($plan === 'Silver Plan') && ($day_counter > 7)){
             $_SESSION['formError'] = ['general_error'=>['your are not allow to withdraw']];
        header('location:../users/withdraw.php');
                return;
        }
        if(($plan === 'Diamond Plan') && ($day_counter > 10)){
            header('location:../users/withdraw.php?success=your are not allow to withdraw');
                return;
        }
        if(($plan === 'Ultimate Plan') && ($day_counter < 14)){
            header('location:../users/withdraw.php?success=your are not allow to withdraw');
                return;
        }
        if(($plan === 'Business Plan') && ($day_counter < 21)){
            header('location:../users/withdraw.php?success=your are not allow to withdraw');
                return;
        }*/
        


}

function selectsinglereffbouns($userId){
    $querys = "SELECT * FROM users WHERE ref_id = '".$userId."'";
    $details = $this->runMysqliQuery($querys);//run the query
    if($details['error_code'] == 1){
        return $details['error'];
    }
    $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
        while($row = mysqli_fetch_object($result)){
            $ref_id = $row->ref_id;
        }
        $UserDetails = "";
        $dsr = "SELECT * FROM referral_tb WHERE referral = '".$ref_id."'";
        $detail = $this->runMysqliQuery($dsr);//run the query
        if($detail['error_code'] == 1){
            return $detail['error'];
        }
        $resul = $detail['data'];
      //  print_r($resul);die();
       return $resul;
       // print_r($UserDetails);die();

    }
}

    function withdrawBonus(){
        $wallet= $_SESSION['wallet']=mysqli_real_escape_string($this->dbConnection, $_POST['wallet']);
        $coin= $_SESSION['coin']=mysqli_real_escape_string($this->dbConnection, $_POST['coin']);
        $amount= $_SESSION['amount']=mysqli_real_escape_string($this->dbConnection, $_POST['amount']);
        $userId= $_SESSION['userId']=mysqli_real_escape_string($this->dbConnection, $_POST['userId']);

        $thingsToValidate = [
            $wallet.'|Wallet|wallet|empty',
            $coin.'|Coin|coin|empty',
            $amount.'|Amount|amount|empty',
        ];

        $validationStatus = $this->callValidation($thingsToValidate);
        if($validationStatus === false) {
            $_SESSION['formError'] = $this->errors;
            header('location:../users/withdraw_bonus.php');
            return;
        }
        $querys = "SELECT * FROM referral_tb WHERE referral_id = '".$userId."'";
        $details = $this->runMysqliQuery($querys);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 0;
        }else{
            while($row = mysqli_fetch_object($result)){
                $referral = $row->referral;
                $ref_amount = $row->ref_amount;
            }
            $query = "SELECT * FROM users WHERE ref_id = '".$referral."'";
            $detail = $this->runMysqliQuery($query);//run the query
            if($detail['error_code'] == 1){
                return $detail['error'];
            }
            $resul = $detail['data'];
            if(mysqli_num_rows($resul) == 0){
                return 0;
            }else{
                while($rows = mysqli_fetch_object($resul)){
                    $email = $rows->email;
                    $username = $rows->username;
                }

        $drawal_referral_id = $this->createUniqueID('with_bonus', 'withbouns_id');
    
        $int = $ref_amount - $amount;

        $queryy = "INSERT INTO with_bonus (id,withbouns_id,username,email,wallet,coin_type,amount)VALUES(null,'".$drawal_referral_id."','".$username."','".$email."','".$wallet."','".$coin."','".$amount."') ";
        $resultt = $this->runMysqliQuery($queryy);
        //  print_r($result);die();

        if($resultt['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $resultt['error'] ] ];
            header('location:../users/withdraw_bonus.php');
            return;
        }
        $quers = "UPDATE referral_tb SET ref_amount ='".$int."' WHERE referral_id = '".$userId."'" ;
     //   print_r($quers);die();
        $detai = $this->runMysqliQuery($quers);//run the query
        if($detai['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $detai['error'] ] ];
            header("location:../users/withdraw_bonus.php");
            return;
        }



        if ($resultt) {
            $to  = $email;
            $ego = $amount;
            $d = date('Y');
            $subject = "withdraw To Stableearner";
            $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
    <div style="font-size: 14px;">
     <p>You have Successfully Created a withdrawal Ticket on stableearner  Amount $'.$ego.'., You are meant to wait for a period of 30 min so that the Money equivalent will be sent to your Wallet address on your Dashboard.</p>
    <p style="">Thanks For Your Compliance!</p>
    <p style="color:#332E2E">Best Regard<br />
    stableearner Team<br />
    Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail($to, $subject, $message, $header);
            if ($retval = true) {
                header("location:../users/withdraw_bonus.php?success=withdrawal was successful");
            } else {
                return  'Internal error. Mail fail to send';
            }
            header("location:../users/withdraw_bonus.php?success=withdrawal was successful");
            // return("Deposite Successfully");
        }
        $to  = 'stableearner@gmail.com';
        $d = date('Y');
        $use = $username;
        $ego = $amount;
        $subject = "withdraw To Stableearner";
        $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
    <div style="font-size: 14px;">
     <p>'.$use.'. has Successfully Withdraw on stableearner amount is $'.$ego.'</p>
    <p style="">Thanks For Your Compliance!</p>
    <p style="color:#332E2E">Best Regard<br />
    stableearner Team<br />
    Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
        $retval = @mail('stableearner@gmail.com', $subject, $message, $header);
        if ($retval = true) {
            header("location:../users/withdraw_bonus.php?success=withdrawal was successful");
        } else {
            return  'Internal error. Mail fail to send';
        }


        header('location:../users/withdraw_bonus.php?success=withdrawal was successful');

    }
}
}

    
    function selectdrawatable($id){
        $UserDetails = "";
        $query = "SELECT * FROM withdrawal WHERE users_unique_id = '".$id."'AND status = 'confirmed'";
        // print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $UserDetails = $details['data'];
        //print_r($query);die();

        return $UserDetails;
    }


    function alldeposit(){
        $UserDetails = [];
        $query = "SELECT * FROM deposit_tb";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }
    function alldepositwithcom(){
        $UserDetails = [];
        $query = "SELECT * FROM deposit_tb WHERE status = 'confirmed' ORDER BY id DESC LIMIT 8";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }
    function allinvest(){
        $UserDetails = [];
        $query = "SELECT * FROM deposit_tb WHERE status ='confirmed'";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    
    }

    function allwithdrawamount(){
        $UserDetails = [];
        $query = "SELECT * FROM with_amount";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }


    function allwithdraw(){
        $UserDetails = [];
        $query = "SELECT * FROM withdrawal";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }
    function allwithdrawwithcom(){
        $UserDetails = [];
        $query = "SELECT * FROM withdrawal WHERE status = 'confirmed' ORDER BY id DESC LIMIT 8";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
                //print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }


  function manageAccount(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'delete'){
            $query = "DELETE FROM deposit_tb WHERE deposit_id = '".$user_id."'";
            $message = "User have been deleted successfully";
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/status.php");
            return;
        }
        header("location:../admin/status.php?success=$message");

    }
    function manageAccounts(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'block'){
            $query = "UPDATE deposit_tb	 SET status = 'pending' WHERE deposit_id = '".$user_id."'";
            $message = "User have been pending successfully";

        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/status.php");
            return;
        }
        header("location:../admin/status.php?success=$message");

    }

    function manageAccountss(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'unblock'){
            $query = "UPDATE deposit_tb	 SET status = 'confirmed' WHERE deposit_id = '".$user_id."'";
            header("location:../admin/status.php?success=Users have been confirmed successfully");

            //run the query
            $result = $this->runMysqliQuery($query);
            //print_r($result);die();
            if($result['error_code'] == 1){
                $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
                header("location:../admin/status.php?success=User have been confirmed successfully");
                return;
            }
            $select = "SELECT * FROM deposit_tb WHERE deposit_id = '".$user_id."'";
            $details = $this->runMysqliQuery($select);
            // print_r($result);die();
            if($details['error_code'] == 1){
                return $details['error'];
            }
            $result = $details['data'];
            if(mysqli_num_rows($result) == 0) {
                return 'No Data was returned';
            }
            if($result) {
                for ($i = 0; $row = mysqli_fetch_array($result); $i++) {
                    $email = $row['email'];
                    $amount = $row['amount'];
                    $username = $row['username'];
                    $referral = $row['referral'];
                }
                $to  = $email;
                $d = date('Y');
                $ego = $amount;
                $subject = "Welcome To Stableearner";
                $message = '
                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head>
                                <body>
                    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
                    <div style="font-size: 14px;">
					<p>Hello '.$username.'. Your Deposit of $'.$ego.'. have been confirmed</p>
					<p style="">Thanks!</p>
					<p style="color:#332E2E">Best Regard<br />
                    stableearner Team<br />
                    Email: stableearner@gmail.com<br /></p>
				
			
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
		</div>
		</body>
		</html>';
                $header = "MIME-Version: 1.0" . "\r\n";
                $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
                $retval = @mail($to, $subject, $message, $header);
                if ($retval = true) {
                    return  "location:../admin/status.php?success=User have been un-blocked successfully";
                    // header("location:login.php");
                } else {
                    return   "location:../admin/status.php?success=User have been un-blocked successfully";
                }
                header("location:../admin/status.php?success=User have been un-blocked successfully");
            }
            header("location:../admin/status.php?success=User have been un-blocked successfully");

            // header("location:../admin/status.php?success=$message");

            $to  = 'stableearner@gmail.com';
            $d = date('Y');
            $subject = "Welcome To Stableearner";
            $message = '
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
    <div style="font-size: 14px;">
    <p>'.$username.'. deposit of .'.$ego.'. has been Successfully confirmed.</p>
    <p style="">Thanks For Your Compliance!</p>
    <p style="color:#332E2E">Best Regard<br />
    stableearner Team<br />
    Email: stableearner@gmail.com<br /></p>


<p style="float:left;
width:100%;
text-align:center;
font-family: \'Roboto Condensed\', sans-serif;
">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
</div>
</body>
</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail('stableearner@gmail.com', $subject, $message, $header);
            if ($retval = true) {
                return  "location:../admin/status.php?success=User have been un-blocked successfully";
            } else {
                return  "location:../admin/status.php?success=User have been un-blocked successfully";
            }
            return  "location:../admin/status.php?success=User have been un-blocked successfully";
        }
        if($result){
            $dsrs = "SELECT * FROM users WHERE ref_id = '$referral'";
            $resus = $this->runMysqliQuery($dsrs);
            if($resus['error_code'] == 1){
                return $resus['error'];
            }
            $results = $resus['data'];
            if(mysqli_num_rows($results) == 0){
                return 'no';
            }else{
                while($row = mysqli_fetch_array($results)){
                    $refemail = $row['email'];
                    $refname = $row['username'];
                }
                $to  = $refemail;
                $d = date('Y');
                $subject = "Welcome To Stableearner";
                $message = '
                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head>
                                <body>
                    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner "/></h6>
                    <div style="font-size: 14px;">
					<p>Hello '.$refname.' <br>
						You Reffered : '.$fullname.' <br> you have  receive 1% of deposit.</p>
					<p style="">Thanks!</p>
					<p style="color:#332E2E">Best Regard<br />
                    stableearner Team<br />
                    Email: stableearner@gmail.com<br /></p>

			
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;All Rights Reserved.</p>
		</div>
		</body>
		</html>';
                $header = "MIME-Version: 1.0" . "\r\n";
                $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $header .= 'From: stableearner <support@cryptovaultinvestment7gmail.com>' . "\r\n";
                $retval = @mail($to, $subject, $message, $header);
                if ($retval = true) {
                    return  'location:../admin/status.php?success=User have been un-blocked successfully';
                    // header("location:login.php");
                } else {
                    return  'location:../admin/status.php?success=User have been un-blocked successfully';
                }
            }
            header("location:../admin/status.php?success=User have been un-blocked successfully");
        }
        header("location:../admin/status.php?success=User have been un-blocked successfully");

    }

    function managewithdraw(){
        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'deletel'){
            $query = "DELETE FROM withdrawal WHERE withdraw_id = '".$user_id."'";
             header("location:../admin/statuss.php?success=$message");
        }else if($option === 'confirmed'){
            $query = "UPDATE withdrawal SET status = 'confirmed' WHERE withdraw_id  = '".$user_id."'";
            $message = "User have been confirmed successfully";
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statuss.php");
            return;
        }
        header("location:../admin/statuss.php?success=$message");

    }
    function managewithdra(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'pending'){
            $query = "UPDATE withdrawal SET status = 'pending' WHERE withdraw_id = '".$user_id."'";
            $message = "User have been pending successfully";

        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statuss.php");
            return;
        }
        header("location:../admin/statuss.php?success=$message");

    }
    function managewithdr(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'confirmed'){
            $query = "UPDATE withdrawal	 SET status = 'confirmed' WHERE withdraw_id = '".$user_id."'";
            header("location:../admin/statuss.php?success=User have been confirmed successfully");
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statuss.php");
            return;
        }
        $select = "SELECT * FROM withdrawal WHERE withdraw_id = '".$user_id."'";
        $details = $this->runMysqliQuery($select);
        // print_r($result);die();
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $results = $details['data'];
        if(mysqli_num_rows($results) == 0) {
            return 'No Data was returned';
        }
        if($results) {
            for ($i = 0; $row = mysqli_fetch_array($results); $i++) {
                $email = $row['email'];
                $amount = $row['amount'];
                $users_unique_id = $row['users_unique_id'];
            }
             $queryss = "SELECT * FROM users WHERE users_unique_id = '".$users_unique_id."'";
           // print_r($queryss);die();
            $detailss = $this->runMysqliQuery($queryss);//run the query
            if($detailss['error_code'] == 1){
                return $detailss['error'];
            }
            $resultss = $detailss['data'];
            if(mysqli_num_rows($resultss) == 0){
                return 'No Data was returned';
            }else{
                while($rows = mysqli_fetch_array($resultss)){
                    $bal = $rows['balance'];
                }
            }
            $int = ($bal - $amount);

            $querysss = "UPDATE users SET balance = '".$int."' WHERE users_unique_id = '".$users_unique_id."'";
            $resultsss = $this->runMysqliQuery($querysss);
            if($resultsss['error_code'] == 1){
                $_SESSION['formError'] = ['general_error'=>[ $resultsss['error'] ] ];
                header("location:../users/withdraw.php");
                return;
            }
            
            $to  = $email;
            $d = date('Y');
            $ego = $amount;
            $subject = "Welcome To Stableearner";
            $message = '
                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head>
                                <body>
                    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner"/></h6>
                    <div style="font-size: 14px;">
					<p>Your withdrawal of $'.$ego.' have be confirmed</p>
					<p style="">Thanks!</p>
					<p style="color:#332E2E">Best Regard<br />
                    stableearner Team<br/>
                    Email: stableearner@gmail.com<br /></p>
				
			
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
		</div>
		</body>
		</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail($to, $subject, $message, $header);
            if ($retval = true) {
                return  "location:../admin/statuss.php?success=User have been un-blocked successfully";
                // header("location:login.php");
            } else {
                return  "location:../admin/statuss.php?success=User have been un-blocked successfully";
            }
            header("location:../admin/statuss.php?success=User have been un-blocked successfully");
        }


        header("location:../admin/statuss.php?success=$message");

    }
    function manbonus(){
        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'delete4'){
            $query = "DELETE FROM with_bonus WHERE withbouns_id = '".$user_id."'";
            $message = "User have been deleted successfully";
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/status_bonus.php");
            return;
        }
        header("location:../admin/status_bonus.php?success=$message");

    }
    function manabonus(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'pendiiing'){
            $query = "UPDATE with_bonus SET status = 'pending' WHERE withbouns_id = '".$user_id."'";
            $message = "User have been pending successfully";

        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/status_bonus.php");
            return;
        }
        header("location:../admin/status_bonus.php?success=$message");

    }
    function managbonus(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'confiiirmed'){
            $query = "UPDATE with_bonus	SET status = 'confirmed' WHERE withbouns_id = '".$user_id."'";
            $message =("location:../admin/status_bonus.php?success=User have been confirmed successfully");
              }
        //run the query
        $result = $this->runMysqliQuery($query);
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/status_bonus.php?success=User have been confirmed successfully");
            return;
        }
        $select = "SELECT * FROM with_bonus WHERE withbouns_id = '".$user_id."'";
        $details = $this->runMysqliQuery($select);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $results = $details['data'];
        if(mysqli_num_rows($results) == 0) {
            return 0;
        }
        if($results) {
            for ($i = 0; $row = mysqli_fetch_array($results); $i++) {
           //     print_r($row);die();
                $email = $row['email'];
                $amount = $row['amount'];
            }
            
            //         print_r($resultsss);die();
         

            $to  = $email;
            $d = date('Y');
            $ego = $amount;
            $subject = "Welcome To Stableearner";
            $message = '
                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head>
                                <body>
                    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner"/></h6>
                    <div style="font-size: 14px;">
					<p>You withdrawal of $'.$ego.'have be confirmed</p>
					<p style="">Thanks!</p>
					<p style="color:#332E2E">Best Regard<br />
                    Stableearner Team<br/>
                    Email: stableearner@gmail.com<br /></p>
				
			
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
		</div>
		</body>
		</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail($to, $subject, $message, $header);
            if ($retval = true) {
                return  "location:../admin/status_bonus.php?success=User have been un-blocked successfully";
                // header("location:login.php");
            } else {
                return  "location:../admin/status_bonus.php?success=User have been un-blocked successfully";
            }
        return "location:../admin/status_bonus.php?success=User have been un-blocked successfully";
    }


        header("location:../admin/status_bonus.php?success=User have been un-blocked successfully");


    }

    function manageusers(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'deleteled'){
            $query = "DELETE FROM users WHERE users_unique_id = '".$user_id."'";
            $message = "User have been deleted successfully";
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statusinter.php");
            return;
        }
        header("location:../admin/statusinter.php?success=$message");

    }
    function manageuser(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'pendingi'){
            $query = "UPDATE users SET status = 'pending' WHERE users_unique_id = '".$user_id."'";
            $message = "User have been pending successfully";

        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statusinter.php");
            return;
        }
        header("location:../admin/statusinter.php?success=$message");

    }
    function manageuse(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'confirmedi'){
            $query = "UPDATE users SET status = 'confirmed' WHERE users_unique_id  = '".$user_id."'";
            $message = "User have been confirmed successfully";
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statusinter.php");
            return;
        }
        header("location:../admin/statusinter.php?success=$message");

    }
    
    function managereff(){
        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'delete2'){
            $query = "DELETE FROM referral_tb WHERE referral_id  = '".$user_id."'";
            $message = "User have been deleted successfully";
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statuswith.php");
            return;
        }
        header("location:../admin/statuswith.php?success=$message");

    }
    function manageref(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'pendiing'){
            $query = "UPDATE referral_tb SET status = 'pending' WHERE referral_id = '".$user_id."'";
            $message = "User have been pending successfully";

        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statuswith.php");
            return;
        }

        header("location:../admin/statuswith.php?success=$message");

    }
    function managere(){

        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'confiirmed'){
            $query = "UPDATE referral_tb SET status = 'confirmed' WHERE referral_id = '".$user_id."'";
            $message = "User have been confirmed successfully";
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statuswith.php");
            return;
        }

        $select = "SELECT * FROM referral_tb WHERE referral_id = '".$user_id."'";
        $details = $this->runMysqliQuery($select);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result) {
            for ($i = 0; $row = mysqli_fetch_array($result); $i++) {
                $referral = $row['referral'];
                $ref_amount = $row['ref_amount'];

            }
        }
        $dsrs = "SELECT * FROM users WHERE ref_id = '$referral'";
        $resus = $this->runMysqliQuery($dsrs);
        if($resus['error_code'] == 1){
            return $resus['error'];
        }
        $result = $resus['data'];
        if(mysqli_num_rows($result) == 0){
            return 'no';
        }else {
            while ($row = mysqli_fetch_array($result)) {
                $email = $row['email'];
                $refname = $row['username'];
            }
            $to  = $email;
            $d = date('Y');
            $subject = "Welcome To Stableearner";
            $message = '
                                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                                <html xmlns="http://www.w3.org/1999/xhtml">
                                <head>
                                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                </head>
                                <body>
                    <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner"/></h6>
                    <div style="font-size: 14px;">
				<p>Your referral of $'.$ref_amount.'have been deposit into balance</p>
					<p style="">Thanks!</p>
					<p style="color:#332E2E">Best Regard<br />
                    Stableearner Team<br/>
                    Email: stableearner@gmail.com<br /></p>
				
			
			<p style="float:left;
			width:100%;
			text-align:center;
			font-family: \'Roboto Condensed\', sans-serif;
			">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
		</div>
		</body>
		</html>';
            $header = "MIME-Version: 1.0" . "\r\n";
            $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
            $retval = @mail($to, $subject, $message, $header);
            if ($retval = true) {
                return  "location:../admin/statuswith.php?success=User have been un-blocked successfully";
                // header("location:login.php");
            } else {
                return  "location:../admin/statuswith.php?success=User have been un-blocked successfully";
            }
            header("location:../admin/statuss.php?success=User have been un-blocked successfully");
        }

        header("location:../admin/statuswith.php?success=$message");

    }
    
    function getLoggedInDepositDetails($userID){
        $query = "SELECT * FROM deposit_tb WHERE deposit_id = '$userID'";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            $row = mysqli_fetch_object($result);
            return $row;
        }
    }
    function updateadmin()
    {
        $username = mysqli_real_escape_string($this->dbConnection, $_POST['username']);
        $plan = mysqli_real_escape_string($this->dbConnection, $_POST['plan']);
        $interest = mysqli_real_escape_string($this->dbConnection, $_POST['interest']);
        $userId = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $thingsToValidate = [
            $username.'|Username|username|empty',
            $plan.'|Plan|plan|empty',
            $interest.'|Interest|interest|empty',
        ];

        $validationStatus = $this->callValidation($thingsToValidate);
        if($validationStatus === false){
            $_SESSION['formError'] = $this->errors;
            header('location:../users/update.php');
            return;
        }


        $query = "UPDATE deposit_tb SET username = '".$username."', plan = '$plan' , amount = '$interest' WHERE deposit_id = '$userId'";
        $updateDetails = $this->runMysqliQuery($query);
        if($updateDetails['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $updateDetails['error']]];
            header("location:../admin/de_profile.php");
            return;
        }
        header ('location:../admin/all_deposit.php?&success=Profile was updated successfully');
    }


    function updatewallet()
    {
        $Bitcoin = mysqli_real_escape_string($this->dbConnection, $_POST['Bitcoin']);
        $Ethereum = mysqli_real_escape_string($this->dbConnection, $_POST['Ethereum']);
        $Perfect = mysqli_real_escape_string($this->dbConnection, $_POST['Perfect']);
        $BNB = mysqli_real_escape_string($this->dbConnection, $_POST['BNB']);
        $userId = mysqli_real_escape_string($this->dbConnection, $_POST['userId']);

        $thingsToValidate = [
            $Bitcoin.'|Bitcoin|bitcoin|empty',
            $Ethereum.'|Ethereum|ethereum|empty',
            $Perfect.'|Perfect|perfect|empty',
            $BNB.'|BNB|bnb|empty',
        ];

        $validationStatus = $this->callValidation($thingsToValidate);
        if($validationStatus === false){
            $_SESSION['formError'] = $this->errors;
            header('location:../admin/wallet_update.php');
            return;
        }


        $query = "UPDATE wallet SET Bitcoin = '$Bitcoin', Ethereum = '".$Ethereum."', Perfect = '$Perfect' ,BNB = '$BNB' WHERE id = '$userId'";
        $updateDetails = $this->runMysqliQuery($query);
        // print_r($query);die();

        if($updateDetails['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $updateDetails['error'] ]];
            header("location:../admin/wallet_update.php");
            return;
        }

        header ('location:../admin/wallet_profile.php?&success=Profile was updated successfully');


    }
    

    function support(){
       $fullname= $_SESSION['fullname']=mysqli_real_escape_string($this->dbConnection, $_POST['fullname']);
        $email= $_SESSION['email']=mysqli_real_escape_string($this->dbConnection, $_POST['email']);
        $message= $_SESSION['message']=mysqli_real_escape_string($this->dbConnection, $_POST['message']);

        $thingsToValidate = [
            $fullname.'|FullName|fullname|empty',
            $email.'|Email|email|empty',
            $message.'|Message|message|empty',
        ];
        $validationStatus = $this->callValidation($thingsToValidate);
        if($validationStatus === false){
            $_SESSION['formError'] = $this->errors;
            header('location:../contact.php');
            return;
        }
        //       print_r($_SESSION); die();
        // print_r($r); die();
        $createuse = $this->insertIntosuppost($fullname, $email, $message);
        if ($createuse['error_code'] == 1){
            $_SESSION['formError']=['general_error' =>[$createuse['error']] ];
            header('location:../contact.php');
            return;
        }
        header('location:../contact.php?success=messages was successful');

    }
    function allsupport(){
        $UserDetails = [];
        $query = "SELECT * FROM support";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails[] = $row;
//                print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }

    
    function selectWithdrwallsingle($id){
        $UserDetails = "";
        $query = "SELECT * FROM withdrawal WHERE users_unique_id ='".$id."' ";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        //print_r($details);die();
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];

        return $result;
//        if(mysqli_num_rows($result) == 0){
//            return 'No Data was returned';
//        }else{
//            while($row = mysqli_fetch_assoc($result)){
//                $UserDetails = $row;
//               // print_r($UserDetails);die();
//            }
//            return $UserDetails;
//        }

    }


    function selectdeposittable($id){
        $UserDetails = "";
        $query = "SELECT * FROM deposit_tb WHERE users_unique_id ='".$id."' ";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        //print_r($details);die();
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];

        return $result;
//        if(mysqli_num_rows($result) == 0){
//            return 'No Data was returned';
//        }else{
//            while($row = mysqli_fetch_assoc($result)){
//                $UserDetails = $row;
//               // print_r($UserDetails);die();
//            }
//            return $UserDetails;
//        }

    }

    function selectdeposittableinterest($id){
        $UserDetails = "";
        $query = "SELECT * FROM deposit_tb WHERE users_unique_id ='".$id."' AND status = '0' ";
        //print_r($query);die();
        $details = $this->runMysqliQuery($query);//run the query
        //print_r($details);die();
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];

        return $result;
//        if(mysqli_num_rows($result) == 0){
//            return 'No Data was returned';
//        }else{
//            while($row = mysqli_fetch_assoc($result)){
//                $UserDetails = $row;
//               // print_r($UserDetails);die();
//            }
//            return $UserDetails;
//        }

    }

    function selectsingleuser($userId){
        $querys = "SELECT * FROM users WHERE users_unique_id = '".$userId."' ";
        $details = $this->runMysqliQuery($querys);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails = $row;
                //               print_r($UserDetails);die();
            }
            return $UserDetails;
        }
    }

    function enteremail(){
        $email= $_SESSION['email']=mysqli_real_escape_string($this->dbConnection, $_POST['email']);
        $thingsToValidate = [
            $email.'|Email|email|empty',
        ];
        $validationStatus = $this->callValidation($thingsToValidate);
        if($validationStatus === false) {
            $_SESSION['formError'] = $this->errors;
            header('location:../reset.php');
        }
        $query = "SELECT email FROM users WHERE email='".$email."'";
        $back= $this->runMysqliQuery($query);
        if($back['error_code'] == 1){
            header('location:../reset.php?');
        }
        $result = $back['data'];
        if(mysqli_num_rows($result) == 0){
            return 'No Data was returned';
        }
        else{
            $row = mysqli_fetch_object($result);
            //  print_r($row);die();
            header('location:../new_password.php?userid='.$email);

        }
    }
    function enternewpassword(){

        $password = $_SESSION['password']=mysqli_real_escape_string($this->dbConnection, $_POST['password']);
        $new_password = $_SESSION['new_password']=mysqli_real_escape_string($this->dbConnection, $_POST['new_password']);
        $userId = $_SESSION['userid']=mysqli_real_escape_string($this->dbConnection, $_POST['userId']);

        $thingsToValidate = [
            $password.'|Password|password|empty',
            $new_password.'|New_password|new password|empty',
        ];
        $validationStatus = $this->callValidation($thingsToValidate);

        if($validationStatus === false) {
            $_SESSION['formError'] = $this->errors;
            header('location:../new_password.php');
        }
        $hashedPasword = $this->hasHer($password);
        $query = "UPDATE users SET password='".$hashedPasword."' WHERE email='".$userId."' ";
        $back = $this->runMysqliQuery($query);
        if($back['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $back['error'] ]];
            header("location:../new_password.php");
            return;
        }

        header ('location:../new_password.php?&success=New_password was updated successfully');

    }
    function logout(){
        //session_destroy();
        header('location:../login.php?success=you have successfully logged out');
    }


    function sumbalances($userId){
        $query = "SELECT * FROM deposit_tb WHERE users_unique_id = '".$userId."' ";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 0;
        }else {
            while ($row = mysqli_fetch_array($result)) {
                $querys = "SELECT SUM(interest) FROM deposit_tb WHERE users_unique_id = '".$userId."' AND status = 'confirmed'";
                $detail = $this->runMysqliQuery($querys);//run the query
                if($detail['error_code'] == 1){
                    return $detail['error'];
                }
                $resul = $detail['data'];
                if(mysqli_num_rows($resul) == 0) {
                    return 'No Data was returned';
                }else {
                    while ($rows = mysqli_fetch_array($resul)) {
                        $output = $rows[0];
                    }
                    return  $output;
                }
            }
        }
    
    }

    function meanamount($userId){
        $query = "SELECT * FROM deposit_tb WHERE users_unique_id = '".$userId."' ";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 0;
        }else {
            while ($row = mysqli_fetch_array($result)) {
                $querys = "SELECT SUM(amount) FROM deposit_tb WHERE users_unique_id = '".$userId."' AND status = 'confirmed'";
                $detail = $this->runMysqliQuery($querys);//run the query
                if($detail['error_code'] == 1){
                    return $detail['error'];
                }
                $resul = $detail['data'];
                if(mysqli_num_rows($resul) == 0) {
                    return 'No Data was returned';
                }else {
                    while ($rows = mysqli_fetch_array($resul)) {
                        $output = $rows[0];
                    }
                    return  $output;
                }
            }
        }
    
    }

    function meanwithdrwa($userId){
        $query = "SELECT * FROM withdrawal WHERE users_unique_id = '".$userId."' ";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 0;
        }else {
            while ($row = mysqli_fetch_array($result)) {
                $querys = "SELECT SUM(amount) FROM withdrawal WHERE users_unique_id = '".$userId."'";
                $detail = $this->runMysqliQuery($querys);//run the query
                if($detail['error_code'] == 1){
                    return $detail['error'];
                }
                $resul = $detail['data'];
                if(mysqli_num_rows($resul) == 0) {
                    return 'No Data was returned';
                }else {
                    while ($rows = mysqli_fetch_array($resul)) {
                        $output = $rows[0];
                    }
                    return  $output;
                }
            }
        }
    
    }

    
    function meanwithinvest($userId){
        $query = "SELECT * FROM deposit_tb WHERE users_unique_id = '".$userId."' ";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 0;
        }else {
            while ($row = mysqli_fetch_array($result)) {
                $querys = "SELECT COUNT(username) FROM deposit_tb WHERE users_unique_id  = '$userId'";
                $detail = $this->runMysqliQuery($querys);//run the query
                if($detail['error_code'] == 1){
                    return $detail['error'];
                }
                $resul = $detail['data'];
                if(mysqli_num_rows($resul) == 0) {
                    return 'No Data was returned';
                }else {
                    while ($rows = mysqli_fetch_array($resul)) {
                        $output = $rows[0];
                    }
                    return  $output;
                }
            }
        }
    
    }

    function sumreff($userId){
        $query = "SELECT * FROM users WHERE  users_unique_id = '".$userId."'";
        $details = $this->runMysqliQuery($query);//run the query
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_array($result); $i++) {
              //  print_r($row);die();
                $ref_id = $row['ref_id'];
                $querys = "SELECT SUM(ref_amount) FROM referral_tb WHERE referral = '".$ref_id."'";
              //  print_r($querys);die();
                $detail = $this->runMysqliQuery($querys);//run the query
                if($detail['error_code'] == 1){
                    return $detail['error'];
                }
                $resul = $detail['data'];
                if(mysqli_num_rows($resul) == 0) {
                    return 'No Data was returned';
                }
                if($resul){
                    for ($i=0; $ro = mysqli_fetch_array($resul); $i++) {
                        $amount = $ro[0];
                     //  print_r($amount);die();
                    }
                    return  $amount;
                }
            }
        }
    }

    function managesupport(){
        $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

        $option = trim($_GET['option']);
        if($option === 'deletellll'){
            $query = "DELETE FROM support WHERE id = '".$user_id."'";
             header("location:../admin/statussupport.php?success=$message");
        }

        //run the query
        $result = $this->runMysqliQuery($query);
        //print_r($result);die();
        if($result['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
            header("location:../admin/statussupport.php");
            return;
        }
        header("location:../admin/statussupport.php?success=$message");

    }

    function admindetail(){
        $query = "SELECT * FROM users WHERE type_of_user = 'admin'";
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 0;
        }else{
            while($row = mysqli_fetch_object($result)){
                $UserDetails = $row;
                //               print_r($UserDetails);die();
            }
        }
        return  $UserDetails;
    }

    function seeallreff($userId){
        $UserDetails = [];
        $query = "SELECT * FROM users WHERE ref_id = '".$userId."'";
        // print_r($query);die();
        $details = $this->runMysqliQuery($query);
        if($details['error_code'] == 1){
            return $details['error'];
        }
        $result = $details['data'];
        if(mysqli_num_rows($result) == 0) {
            return 'No Data was returned';
        }
        if($result){
            for ($i=0; $row = mysqli_fetch_assoc($result); $i++){
                $ref_id = $row['ref_id'];
                // print_r($row);die();
        $querys = "SELECT * FROM referral_tb WHERE  referral = '".$ref_id."'";
        $detail = $this->runMysqliQuery($querys);
        if($detail['error_code'] == 1){
        return $detail['error'];
        }
        $resul = $detail['data'];
        // print_r($resul);die();
        if(mysqli_num_rows($resul) == 0) {
            return 'No Data was returned';
        }else{
            while($rows = mysqli_fetch_array($resul)){
                 $UserDetails[] = $rows;
                // print_r($UserDetails);die();
            }
    }
}
}
return  $UserDetails;
}




function managecapital(){
    $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

    $option = trim($_GET['option']);
    if($option === 'del'){
        $query = "DELETE FROM with_amount WHERE withdraw_id = '".$user_id."'";
         header("location:../admin/ss.php?success=$message");
    }

    //run the query
    $result = $this->runMysqliQuery($query);
    //print_r($result);die();
    if($result['error_code'] == 1){
        $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
        header("location:../admin/ss.php");
        return;
    }
    header("location:../admin/ss.php?success=$message");

}
function managecapitals(){

    $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

    $option = trim($_GET['option']);
    if($option === 'pend'){
        $query = "UPDATE with_amount SET status = 'pending' WHERE withdraw_id = '".$user_id."'";
        $message = "User have been pending successfully";

    }

    //run the query
    $result = $this->runMysqliQuery($query);
    //print_r($result);die();
    if($result['error_code'] == 1){
        $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
        header("location:../admin/ss.php");
        return;
    }
    header("location:../admin/ss.php?success=$message");

}
function managecapitalss(){

    $user_id = mysqli_real_escape_string($this->dbConnection, $_POST['user_id']);

    $option = trim($_GET['option']);
    if($option === 'conf'){
        $query = "UPDATE with_amount SET status = 'confirmed' WHERE withdraw_id = '".$user_id."'";
        header("location:../admin/ss.php?success=User have been confirmed successfully");
    }

    //run the query
    $result = $this->runMysqliQuery($query);
    //print_r($result);die();
    if($result['error_code'] == 1){
        $_SESSION['formError'] = ['general_error'=>[ $result['error'] ] ];
        header("location:../admin/ss.php");
        return;
    }
    $select = "SELECT * FROM withdrawal WHERE withdraw_id = '".$user_id."'";
    $details = $this->runMysqliQuery($select);
    // print_r($result);die();
    if($details['error_code'] == 1){
        return $details['error'];
    }
    $results = $details['data'];
    if(mysqli_num_rows($results) == 0) {
        return 'No Data was returned';
    }
    if($results) {
        for ($i = 0; $row = mysqli_fetch_array($results); $i++) {
            $email = $row['email'];
            $amount = $row['amount'];
            $users_unique_id = $row['users_unique_id'];
        }
         $queryss = "SELECT * FROM users WHERE users_unique_id = '".$users_unique_id."'";
       // print_r($queryss);die();
        $detailss = $this->runMysqliQuery($queryss);//run the query
        if($detailss['error_code'] == 1){
            return $detailss['error'];
        }
        $resultss = $detailss['data'];
        if(mysqli_num_rows($resultss) == 0){
            return 'No Data was returned';
        }else{
            while($rows = mysqli_fetch_array($resultss)){
                $bal = $rows['balance'];
            }
        }
        $int = ($bal - $amount);

        $querysss = "UPDATE users SET balance = '".$int."' WHERE users_unique_id = '".$users_unique_id."'";
        $resultsss = $this->runMysqliQuery($querysss);
        if($resultsss['error_code'] == 1){
            $_SESSION['formError'] = ['general_error'=>[ $resultsss['error'] ] ];
            header("location:../users/all_withdrawamount.php");
            return;
        }
        
        $to  = $email;
        $d = date('Y');
        $ego = $amount;
        $subject = "Welcome To Stableearner";
        $message = '
                            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                            <html xmlns="http://www.w3.org/1999/xhtml">
                            <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            </head>
                            <body>
                <h6 align="center"><img src="https://www.stableearner.com/images/IMG.jpeg" alt="stableearner"/></h6>
                <div style="font-size: 14px;">
                <p>Your withdrawal of $'.$ego.' have be confirmed</p>
                <p style="">Thanks!</p>
                <p style="color:#332E2E">Best Regard<br />
                Stableearner Team<br/>
                Email: stableearner@gmail.com<br /></p>
            
        
        <p style="float:left;
        width:100%;
        text-align:center;
        font-family: \'Roboto Condensed\', sans-serif;
        ">&copy;<?php print ' . $d . ';?>All Rights Reserved.</p>
    </div>
    </body>
    </html>';
        $header = "MIME-Version: 1.0" . "\r\n";
        $header .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $header .= 'From: stableearner <support@stableearner.com>' . "\r\n";
        $retval = @mail($to, $subject, $message, $header);
        if ($retval = true) {
            return  "location:../admin/statuss.php?success=User have been un-blocked successfully";
            // header("location:login.php");
        } else {
            return  "location:../admin/statuss.php?success=User have been un-blocked successfully";
        }
        header("location:../admin/statuss.php?success=User have been un-blocked successfully");
    }


    header("location:../admin/ss.php?success=$message");

}



}
$for = new main_work();
?>