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
                                            <h5 class="m-b-10">Edit Address</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/account/address" ?>><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#">Edit Address</a></li>
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
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Edit address</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form id="edit-product-form" action=<?php echo _WEB_ROOT . '/account/handle_edit_address/' . $customer_id . '/' . $address_id.'/'.$name ?> class="edit-product-form" method="post" enctype="multipart/form-data">

                                                    <tr class="item">
                                                        <th scope="col">Address</th>
                                                        <td>
                                                            <?php echo $address ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input required name="address" type="text" class="form-control" placeholder="Enter address">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                </form>

                                            </tbody>
                                        </table>

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