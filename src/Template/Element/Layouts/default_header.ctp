<header id="topnav">

    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">

                <li class="dropdown notification-list">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle nav-link">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>

                <li class="d-none d-sm-block">
                    <form class="app-search">
                        <div class="app-search-box">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <button class="btn" type="submit">
                                        <i class="fe-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>



                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="fe-bell noti-icon"></i>
                        <span class="badge badge-success rounded-circle noti-icon-badge">4</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h5 class="m-0">
                                <span class="float-right">
                                    <a href="" class="text-dark">
                                        <small>Clear All</small>
                                    </a>
                                </span>Notification
                            </h5>
                        </div>

                        <div class="slimscroll noti-scroll">

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-soft-primary text-primary">
                                    <i class="mdi mdi-comment-account-outline"></i>
                                </div>
                                <p class="notify-details">Doug Dukes commented on Admin Dashboard
                                    <small class="text-muted">1 min ago</small>
                                </p>
                            </a>

                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                            View all
                            <i class="fi-arrow-right"></i>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <?= $this->Html->image('/css/assets/images/users/avatar-1.jpg', ['class' => 'rounded-circle']) ?>
                        <span class="pro-user-name ml-1">
                            Nik Patel <i class="mdi mdi-chevron-down"></i> 
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">สวัสดี :)</h6>
                        </div>

                        <!-- item-->
                        <a href="<?=SITEURL?>account" class="dropdown-item notify-item">
                            <i class="remixicon-account-circle-line"></i>
                            <span>บัญชีของฉัน</span>
                        </a>

                        <!-- item-->
                        <a href="<?=SITEURL?>setting" class="dropdown-item notify-item">
                            <i class="remixicon-settings-3-line"></i>
                            <span>ตั้งค่าระบบ</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="remixicon-wallet-line"></i>
                            <span>My Wallet <span class="badge badge-success float-right">3</span> </span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="remixicon-logout-box-line"></i>
                            <span>ออกจากระบบ</span>
                        </a>

                    </div>
                </li>            

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="<?=SITEURL?>" class="logo text-center">
                    <span class="logo-lg">
                        <?=$this->Html->image('/css/assets/images/logo-light.png',['height'=>'20'])?>
                        
                        <!-- <span class="logo-lg-text-light">Xeria</span> -->
                    </span>
                    <span class="logo-sm">
                        <!-- <span class="logo-sm-text-dark">X</span> -->
                        <?=$this->Html->image('/css/assets/images/logo-sm.png',['height'=>'24'])?>
                    </span>
                </a>
            </div>


            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->

    <div class="topbar-menu">
        <div class="container-fluid">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">

                    <li class="">
                        <a href="<?=SITEURL?>dashboard">
                            <i class="remixicon-dashboard-line"></i>Dashboards
                        </a>
                        
                    </li>

                    <li class="has-submenu">
                        <a href="#">
                            <i class="remixicon-stack-line"></i>คำสั่งซื้อ <div class="arrow-down"></div>
                        </a>
                        <ul class="submenu">
                            <li>
                                <?=$this->Html->link('คำสั่งซื้อทั้งหมด',['controller'=>'order'])?>
                            </li>
                            
                        </ul>
                    </li>

                    

                    <li class="has-submenu">
                        <a href="#"> <i class="remixicon-file-copy-2-line"></i>คลัง/สินค้า <div class="arrow-down"></div></a>
                        <ul class="submenu megamenu">
                            <li>
                                <ul>
                                    <li>
                                        <a href="<?=SITEURL?>product-cat">ประเภท/กลุ่มสินค้า</a>
                                    </li>
                                    <li>
                                        <a href="<?=SITEURL?>brands">ยี่ห้อสินค้า</a>
                                    </li>
                                    <li>
                                        <a href="<?=SITEURL?>product">สินค้า/ต้นทุน</a>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <ul>
                                    <li>
                                        <a href="<?=SITEURL?>warehouse">คลังสินค้า</a>
                                    </li>
                                    <li>
                                        <a href="<?=SITEURL?>goods-receive">นำเข้า/รับสินค้า</a>
                                    </li><li>
                                        <a href="<?=SITEURL?>goods-shipment">ส่งออก/ย้ายสินค้า</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- End navigation menu -->

                <div class="clearfix"></div>
            </div>
            <!-- end #navigation -->
        </div>
        <!-- end container -->
    </div>
    <!-- end navbar-custom -->
</header>