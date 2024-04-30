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
                                            <h5 class="m-b-10">Edit Product</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/product" ?>><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Edit Product</a></li>
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
                                        <div class="row">
                                            <div class="col-md-6">
                                                <form>
                                                    <div class="form-group">
                                                        <p style="margin-left:8px">
                                                            <b>Name:</b><?php echo $product_type['name_type'] ?>
                                                        </p>
                                                    </div>
                                                    <div class="form-group" style="display:flex; flex-direction:column">
                                                        <p style="margin-left:8px">
                                                            <b>Image:</b>
                                                        </p>
                                                        <img style="margin-left:8px; width:100px;height:100px; border-radius:4px" src=<?php echo  _WEB_ROOT . IMG_PATH . 'product_type/' . $product_type['image'] ?> alt="">
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-md-6 card-body-add">
                                                <form enctype="multipart/form-data" method="post" action=<?php echo _WEB_ROOT.'/product/handle_edit_product_type/'.$product_type['id'] ?>>
                                                    <div class="form-group">
                                                        <label for="exampleInputNewName">New Name</label>
                                                        <input name="new_name" type="text" class="form-control" id="exampleInputNewName" placeholder="Enter name">
                                                    </div>
                                                    New Image
                                                    <div class="form-group img-form">
                                                    
                                                        <label for="input-image">
                                                           
                                                            <input name="new_image" type="file" class="form-control" id="input-image" class="input-image">
                                                            <div>
                                                                <img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field">
                                                            </div>
                                                        </label>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
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