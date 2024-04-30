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
                                            <h5 class="m-b-10">Edit Order Location</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/store" ?>><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Edit Oder Location</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- [ form-element ] start -->
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-product table-bordered">
                                            <thead>
                                                <tr class='header'>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Order value</th>
                                                    <th scope="col">Edit value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form id="edit-order" action=<?php echo _WEB_ROOT . '/store/handle_edit_order/' . $id_cart . '/' . $id_customer .'/'.$status.'/'.$page?> class="edit-product-form" method="post" enctype="multipart/form-data">
                                                    <tr class="item">
                                                        <th scope="col">Location</th>
                                                        <td><?php echo $location ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="location" type="text" class="form-control" placeholder="Enter location">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </form>

                                            </tbody>
                                        </table>
                                        <div style="display:flex; justify-content:end">
                                            <button style="margin:0 !important; padding:12px 48px !important" form="edit-order" type="submit" class="btn btn-primary">Save</button>
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