<?php $name = strlen($userDetails->username) ; ?>
<body>
<div class="loader"></div>
<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar sticky">
            <div class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg-12
									collapse-btn "> <i data-feather="align-justify"></i></a></li><br>
                    <li style="color:darkblue; font-size:15px; font-family: Times New Roman, Times, serif; padding-top:8px;margin-left:2px">
                     <!--<p>Welcome:<?php echo $userDetails->username?></p>-->
                     <p>Welcome:<?php if ($name <= 8) {
                         # code...
                         echo $userDetails->username;
                     //break;
                     }else {
                         # code...
                         $name = substr($userDetails->username,0,8);
                         echo $name;
                     }
                     
                       ?></p>
                    </li>
                    <!--<li style="color:darkblue; front-size:15px; padding-top:8px;margin-left:2px"> -->
                    <!-- <p></p>-->
                    <!--</li>-->
                </ul>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown " style="margin-left:3px"
                      class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img style="width:35px; border-radius:50px; margin-right:5px; padding-bottom:1px" src="../images/<?php echo $userDetails->image_name; ?>" ></span></a>
                                                                                                        
                </li>
            </ul>
        </nav>