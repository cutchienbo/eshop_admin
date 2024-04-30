<header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
        <a href=<?php echo 'product'; ?> class="b-brand">
            <img src=<?php echo _WEB_ROOT.IMG_PATH."logo.svg"?> alt="" class="logo images">
            <img src=<?php echo _WEB_ROOT.IMG_PATH."logo-icon.svg"?> alt="" class="logo-thumb images">
        </a>
    </div>
    <a class="mobile-menu" id="mobile-header" href="#!">
        <i class="feather icon-more-horizontal"></i>
    </a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
           <h4>
                <?php echo strtoupper($_SESSION['account']['role']) ?>
           </h4>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if($_SESSION['account']['role'] != 'super admin'){ ?>

                <li>
                    <img src=<?php echo _WEB_ROOT.IMG_PATH.$_SESSION['account']['role'].'/'.$_SESSION['account']['image'] ?> alt="">
                    <?php echo $_SESSION['account']['name'] ?>
                </li>

            <?php } ?>
            <li class="log-out">
                <a href=<?php echo _WEB_ROOT.'/login/log_out' ?>><i class="feather icon-log-out"></i></a>
            </li>
        </ul>
    </div>
</header>