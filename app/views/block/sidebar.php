<nav class="pcoded-navbar menupos-fixed menu-light brand-blue ">
    <div class="navbar-wrapper ">
        <div class="navbar-brand header-logo">
            <a href="index.html" class="b-brand">
                <img src=<?php echo _WEB_ROOT . IMG_PATH . "logo.svg" ?> alt="" class="logo images">
                <img src=<?php echo _WEB_ROOT . IMG_PATH . "logo-icon.svg" ?> alt="" class="logo-thumb images">
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item">
                    <a href=<?php echo _WEB_ROOT . "/product" ?> class="nav-link"><span class="pcoded-micon"><i class="fas fa-warehouse"></i></span><span class="pcoded-mtext">Product</span></a>
                </li>

                <?php if ($_SESSION['account']['role'] != 'staff') { ?>
                    <li class="nav-item">
                        <a href=<?php echo _WEB_ROOT . "/account" ?> class="nav-link"><span class="pcoded-micon"><i class="fas fa-user-tie"></i></span><span class="pcoded-mtext">Account</span></a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a href=<?php echo _WEB_ROOT . "/account/customer/1" ?> class="nav-link"><span class="pcoded-micon"><i class="fas fa-users"></i></span><span class="pcoded-mtext">Customer</span></a>
                </li>

                <li class="nav-item">
                    <a href=<?php echo _WEB_ROOT . "/store" ?> class="nav-link"><span class="pcoded-micon"><i class="fas fa-shopping-cart"></i></span><span class="pcoded-mtext">Store</span></a>
                </li>

                <li class="nav-item">
                    <a href=<?php echo _WEB_ROOT . "/comment" ?> class="nav-link"><span class="pcoded-micon"><i class="fas fa-comments"></i></span><span class="pcoded-mtext">Comment</span></a>
                </li>

                <!-- <li class="nav-item">
                    <a href=<?php echo _WEB_ROOT . "/authorization" ?> class="nav-link"><span class="pcoded-micon"><i class="fas fa-user-shield"></i></span><span class="pcoded-mtext">Authorization</span></a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>
