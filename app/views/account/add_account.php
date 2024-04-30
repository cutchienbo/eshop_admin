<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Add <?php echo ucfirst($role) ?></h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/account" ?>><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Add Customer</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 card-body-add" style="justify-content:center">
                                                <form method="post" enctype="multipart/form-data" action=<?php echo _WEB_ROOT . '/account/handle_add_account/' . $role ?>>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="exampleInputName">Name</label>
                                                                <input required type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter name">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputAccount">Account</label>
                                                                <input required type="text" name="account" class="form-control" id="exampleInputAccount" placeholder="Enter account">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPassword">Password</label>
                                                                <input required type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Enter password">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputEmail">Email</label>
                                                                <input type="email" name="email" class="form-control" id="exampleInputEmail" placeholder="Enter email">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleInputPhone">Phone</label>
                                                                <input type="number" name="phone_number" class="form-control" id="exampleInputPhone" placeholder="Enter phone number">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">

                                                            <?php if ($_SESSION['account']['role'] == 'customer') { ?>

                                                                <div class="form-group">
                                                                    <label for="exampleInputLocation">Location</label>

                                                                    <textarea class="form-control" name="location" id="exampleInputLocation" cols="30" rows="5" placeholder="Enter location"></textarea>
                                                                </div>

                                                            <?php } ?>

                                                            <div class="form-group img-form">

                                                                <label for="input-image-three">

                                                                    <input name="image" type="file" class="input-image " id="input-image-three">
                                                                    <div>
                                                                        <img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field customer-image-add">
                                                                    </div>

                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php if (isset($_SESSION['add_errors'])) { ?>

                                                        <ul class="error-list">

                                                            <?php foreach ($_SESSION['add_errors'] as $error) { ?>

                                                                <li><?php echo $error ?></li>

                                                            <?php } ?>

                                                        </ul>

                                                    <?php } ?>

                                                    <button type="submit" class="btn btn-primary" style="margin-top:24px">Add</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ form-element ] end -->
                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>