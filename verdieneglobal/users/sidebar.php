<div class="main-sidebar sidebar-style-2" style="width:180px">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand" style="padding-top: -30px">
            <a href="dashboard.php?come=<?php echo $userDetails->users_unique_id?>"> <img alt="image" src="../images/IMG.jpeg" 
            style="width:150px;height:100px; margin-left:7px; padding-bottom:16px; margin-right:80px" class="header-logo" /> <span
                    class="logo-name"></span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <h5 class="menu-header"></h5>
            <li class="dropdown active">
                <a href="dashboard.php?come=<?php echo $userDetails->users_unique_id?>" class="nav-link" style=""><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="profile.php" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>My Profile</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="profile.php">profile</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Invest</span></a>
                <ul class="dropdown-menu">
                <li><a class="nav-link" href="plan.php?come=<?php echo $userDetails->users_unique_id?>">Plans</a></li>
                    <!-- <li><a class="nav-link" href="deposit.php?come=<?php echo $userDetails->users_unique_id?>">Deposit</a></li> -->
                    <li><a class="nav-link" href="select_all_deposit.php?come=<?php echo $userDetails->users_unique_id?>">Deposit Made</a></li>

                </ul>
            </li>
            <li class="dropdown" >
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="mail"></i><span>Withdraw</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="withdraw_interest.php?come=<?php echo $userDetails->users_unique_id?>">Withdraw profit</a></li>
                    <li><a class="nav-link" href="with_bouns_table.php?come=<?php echo $userDetails->ref_id?>">Withdraw Bonus</a></li>
                    <li><a class="nav-link" href="seeallwithdraw.php?come=<?php echo $userDetails->users_unique_id?>">Withdrawals</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="seeallref.php?come=<?php echo $userDetails->ref_id?>"><i data-feather="user"></i>Referral</a></li>
            <!-- <li class="dropdown active">
                <a href="../users/wallet_profile.php?come=<?php echo $userDetails->users_unique_id?>" class="nav-link"><i data-feather="monitor"></i><span>Wallet</span></a>
            </li> -->
            <li><a class="nav-link" href="../action/main_work.php?option=logout"><i data-feather="file"></i><span>Logout</span></a></li>
            <li class="language-switcher language-switcher-s1 toggle-wrap " >
                <!-- GTranslate: https://gtranslate.io/ -->

                                    <div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

            </li>

        </ul>
    </aside>
</div>