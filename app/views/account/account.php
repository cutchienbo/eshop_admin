<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">
                            <!-- [ tabs ] start -->
                            <div class="col-sm-12">
                                <div style="display:flex; align-items:center">
                                    <h5 class="mt-4">
                                        <?php if ($type != 'customer') { ?>
                                            Account :
                                        <?php
                                        } else {
                                        ?>
                                            Customer :
                                        <?php } ?>
                                    </h5>

                                    <?php if ($type != 'customer') { ?>

                                        <div class="function" style="margin:24px 12px 8px">
                                            <a href=<?php echo _WEB_ROOT . '/account/add_account/' . $type ?>><i class="fas fa-plus" style="margin-right:4px"></i>Add </a>
                                        </div>

                                    <?php } ?>
                                </div>

                                <?php if ($type != 'customer') { ?>

                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                                        <?php if ($_SESSION['account']['role'] == 'super admin') { ?>

                                            <li class="nav-item ">
                                                <a class="nav-link <?php echo $type != 'admin' ? '' : 'active' ?>" id="pills-home-tab" href=<?php echo _WEB_ROOT . '/account/admin/1' ?>>
                                                    Admin
                                                </a>
                                            </li>

                                            <li class="nav-item ">
                                                <a class="nav-link <?php echo $type != 'staff' ? '' : 'active' ?>" id="pills-home-tab" href=<?php echo _WEB_ROOT . '/account/staff/1' ?>>
                                                    Staff
                                                </a>
                                            </li>

                                        <?php
                                        } else if ($_SESSION['account']['role'] == 'admin') {
                                        ?>

                                            <li class="nav-item ">
                                                <a class="nav-link <?php echo $type != 'staff' ? '' : 'active' ?>" id="pills-home-tab" href=<?php echo _WEB_ROOT . '/account/staff/1' ?>>
                                                    Staff
                                                </a>
                                            </li>

                                        <?php } ?>

                                        <!-- <li class="nav-item ">
                                            <a class="nav-link <?php echo $type != 'customer' ? '' : 'active' ?>" id="pills-home-tab" href=<?php echo _WEB_ROOT . '/account/customer/1' ?>>
                                                Customer
                                            </a>
                                        </li> -->

                                    </ul>

                                <?php } ?>

                                <form action=<?php echo _WEB_ROOT . $_SERVER['PATH_INFO'] ?> method="post">
                                    <ul class="nav nav-pills mb-3 store-search" id="product-tab" role="tablist">

                                        <div>
                                            <input value="<?php echo $_SESSION['account_search'] ? $_SESSION['account_search'] : '' ?>" name="name" class="form-control" type="text" placeholder="Name . . .">
                                        </div>

                                        <div class="search-button-div">
                                            <button name="store_submit" type="submit" class="search-button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>

                                    </ul>
                                </form>

                                <ul class="nav nav-product mb-3" id="product-tab" role="tablist">

                                    <table class="table table-product table-bordere account-table">
                                        <thead>
                                            <tr class='header'>
                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Account</th>

                                                <?php if ($_SESSION['account']['role'] == 'super admin') { ?>

                                                    <th scope="col">Password</th>

                                                <?php } ?>

                                                <?php if ($_SESSION['account']['role'] != 'staff') { ?>

                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone</th>

                                                <?php } ?>

                                                <?php if ($type == 'customer' && $_SESSION['account']['role'] != 'staff') { ?>

                                                    <th scope="col">Location</th>

                                                <?php } ?>

                                                <th scope="col">Status</th>

                                                <?php if ($_SESSION['account']['role'] != 'staff') { ?>

                                                    <th scope="col">Edit</th>

                                                <?php } ?>

                                                <?php if ($type == 'customer' && $_SESSION['account']['role'] == 'staff') { ?>

                                                    <th scope="col">Send</th>

                                                <?php } ?>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="<?php echo _WEB_ROOT . '/product/delete_product' ?>" method="post" id="delete-form">

                                                <?php foreach ($account as $key => $value) { ?>

                                                    <tr class="item">
                                                        <th scope="row">
                                                            <?php echo ($key + 1) + (($pagination['index'] - 1) * 3) ?>
                                                        </th>

                                                        <td class="customer-image">
                                                            <img src=<?php
                                                                        if (substr($value['image'], 0, 4) != 'http') {
                                                                            echo  _WEB_ROOT . IMG_PATH . $type . "/" . $value['image'];
                                                                        } else {
                                                                            echo $value['image'];
                                                                        }
                                                                        ?> alt="">
                                                        </td>

                                                        <td>
                                                            <?php echo $value['name'] ?>
                                                        </td>

                                                        <td style="font-weight:bold">
                                                            <?php echo $value['account'] ?>
                                                        </td>

                                                        <?php if ($_SESSION['account']['role'] == 'super admin') { ?>

                                                            <td style="font-weight:bold">
                                                                <?php echo $value['password'] ?>
                                                            </td>

                                                        <?php } ?>

                                                        <?php if ($_SESSION['account']['role'] != 'staff') { ?>

                                                            <td>
                                                                <?php echo $value['email'] ?>
                                                            </td>

                                                            <td>
                                                                <?php echo $value['phone_number'] ?>
                                                            </td>

                                                        <?php } ?>

                                                        <?php
                                                        if ($type == 'customer' && $_SESSION['account']['role'] != 'staff') {
                                                        ?>

                                                            <td>
                                                                <a style="font-size:1.2rem; margin-left:6px" href=<?php echo _WEB_ROOT . '/account/address/' . $value['id'] . '/' . $value['name'] ?>>
                                                                    <i class="fas fa-info-circle"></i>
                                                                </a>
                                                                <?php echo $value['address'] ?>
                                                            </td>

                                                        <?php
                                                        }
                                                        ?>

                                                        <td class="customer-status">
                                                            <?php if ($value['status'] == 1) { ?>
                                                                <a href=<?php echo _WEB_ROOT . '/account/change_status/' . $value['id'] . '/' . $type ?> class="active">Active</a>
                                                            <?php } else { ?>
                                                                <a href=<?php echo _WEB_ROOT . '/account/change_status/' . $value['id'] . '/' . $type ?> class="deactive">Deactive</a>
                                                            <?php } ?>
                                                        </td>

                                                        <?php if ($_SESSION['account']['role'] != 'staff' && $value['status'] == 1) { ?>

                                                            <td>
                                                                <a href=<?php echo  _WEB_ROOT . "/account/edit_account/" . $value['id'] . '/' . $type ?>>

                                                                    <i class="fas fa-edit" style="font-size:1.1rem"></i>

                                                                </a>
                                                            </td>

                                                        <?php } ?>

                                                        <?php if ($type == 'customer' && $_SESSION['account']['role'] == 'staff') { ?>

                                                            <td>
                                                                <a href=<?php echo  _WEB_ROOT . "/account/edit_account/" . $value['id'] . '/' . $type ?>>

                                                                    <i class="far fa-paper-plane" style="font-size:1.1rem"></i>

                                                                </a>
                                                            </td>


                                                        <?php } ?>

                                                    </tr>

                                                <?php } ?>


                                            </form>
                                        </tbody>
                                    </table>

                                </ul>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?php echo $pagination['index'] == 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/account' . '/' . $type . '/' . '1' ?> tabindex="-1">
                                                <i class="fas fa-angle-double-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item <?php echo $pagination['index'] == 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/account' . '/' . $type . '/' . $pagination['prev'] ?> tabindex="-1">
                                                <i class="fas fa-angle-left"></i>
                                            </a>
                                        </li>

                                        <?php for ($i = $pagination['start']; $i <= $pagination['end']; $i++) { ?>

                                            <li class="page-item <?php echo $i == $pagination['index'] ? 'active' : '' ?>">
                                                <a class="page-link" href=<?php echo _WEB_ROOT . '/account' . '/' . $type . '/' . $i ?>>
                                                    <?php echo $i ?>
                                                </a>
                                            </li>

                                        <?php } ?>

                                        <li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/account' . '/' . $type . '/' . $pagination['next'] ?>>
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        </li>
                                        <li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/account' . '/' . $type . '/' . $pagination['tabs'] ?>>
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>