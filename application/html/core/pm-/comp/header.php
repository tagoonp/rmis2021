<nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-dark">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="javascript:void(0);"><i class="ficon bx bx-menu"></i></a></li>
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main hidden-xs" href="./"><i class="ficon bx bx-home" style="font-size: 1.8em;"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.php" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon bx bx-chat"></i></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon bx bx-search"></i></a>
                            <div class="search-input">
                                <div class="search-input-icon"><i class="bx bx-search primary"></i></div>
                                <input class="input" id="search_box" type="text" placeholder="ค้นหาด้วยรหัส REC หรือ รหัสรายงาน ..." tabindex="-1" data-search="template-search">
                                <div class="search-input-close"><i class="bx bx-x"></i></div>
                                <ul class="search-list"></ul>
                            </div>
                        </li>
                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name"><?php echo $current_user['fname']." ".$current_user['lname']; ?></span><span class="badge badge-light-success round user-status text-muted"><?php echo $role; ?></span></div>
                                <span>
                                    <?php 
                                    if($current_user['profile']==''){
                                        ?><img class="round" src="../../../app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="40" width="40"></span><?php
                                    }else{
                                        ?><img class="round" src="<?php echo $current_user['profile'];?>" alt="avatar" height="40" width="40"></span><?php
                                    }
                                    ?>
                                    
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0"><a class="dropdown-item" href="page-user-profile"><i class="bx bx-user mr-50"></i> แก้ไขข้อมูลส่วนตัว</a>
                            <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="../../../api/session?stage=destroysession"><i class="bx bx-power-off mr-50"></i> ออกจากระบบ</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>