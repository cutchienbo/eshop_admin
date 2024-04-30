<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">

                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Edit <?php echo ucfirst($type) ?></h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/account" ?>><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#">Edit <?php echo ucfirst($type) ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-product table-bordered">
                                            <thead>
                                                <tr class='header'>
                                                    <th scope="col">#</th>
                                                    <th scope="col"><?php echo ucfirst($type) ?> value</th>
                                                    <th scope="col">Edit value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form id="edit-product-form" action=<?php echo _WEB_ROOT . '/account/handle_edit_account/' . $account['id'] . '/' . $type ?> class="edit-product-form" method="post" enctype="multipart/form-data">

                                                    <tr class="item">
                                                        <th scope="col">Image</th>
                                                        <td>
                                                            <img src=<?php echo _WEB_ROOT . IMG_PATH . $type . '/' . $account['image'] ?> alt="">
                                                        </td>
                                                        <td>
                                                            <div class="form-group img-form">

                                                                <label for="input-image">

                                                                    <input name="image" type="file" class="form-control input-image" id="input-image">
                                                                    <div>
                                                                        <img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field">
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Name</th>
                                                        <td><?php echo $account['name'] ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="name" type="text" class="form-control" placeholder="Enter name">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Account</th>
                                                        <td>
                                                            <?php
                                                            echo $account['account']
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input name="account" type="text" class="form-control" placeholder="Enter account">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Password</th>
                                                        <td><?php echo $account['password'] ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="password" type="password" class="form-control" placeholder="Enter password">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Email</th>
                                                        <td><?php echo $account['email'] ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="email" type="email" class="form-control" placeholder="Enter email">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Phone</th>
                                                        <td><?php echo $account['phone_number'] ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="phone_number" type="number" class="form-control" placeholder="Enter phone number">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </form>

                                            </tbody>
                                        </table>

                                        <?php if (isset($_SESSION['edit_errors'])) { ?>

                                            <ul class="error-list">

                                                <?php foreach($_SESSION['edit_errors'] as $error){ ?>

                                                    <li><?php echo $error ?></li>

                                                <?php } ?>

                                            </ul>

                                        <?php } ?>

                                        <div style="display:flex; justify-content:end">
                                            <button style="margin:0 !important; padding:12px 48px !important" form="edit-product-form" type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>