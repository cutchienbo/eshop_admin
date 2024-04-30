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
                                            <h5 class="m-b-10">Add Product</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/product" ?>><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Add Product</a></li>
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
                                            <div class="col-md-12 card-body-add">
                                                <form style="display: flex;" class="row add-product" method="post" enctype="multipart/form-data" action=<?php echo _WEB_ROOT . '/product/handle_add_product' ?>>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputName">Name</label>
                                                            <input name="name" required type="text" class="form-control" id="exampleInputName" placeholder="Enter name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputType">Type</label>
                                                            <select name="type" required class="form-control" aria-placeholder="Type of product">
                                                                <option value=""></option>
                                                                <?php foreach ($product_type as $value) { ?>

                                                                    <option value=<?php echo $value['id'] ?>>
                                                                        <?php echo $value['name_type'] ?>
                                                                    </option>

                                                                <?php } ?>

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputQuantity">Quantity</label>
                                                            <input name="quantity" required type="number" class="form-control" id="exampleInputQuantity" placeholder="Enter quantity">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputCost">Cost</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">$</span>
                                                                </div>
                                                                <input name="cost" required type="number" class="form-control" id="exampleInputCost" placeholder="Enter cost">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputDiscount">Discount</label>
                                                            <div class="input-group mb-3">
                                                                <input name="discount" type="number" class="form-control" id="exampleInputDiscount" placeholder="Enter discount">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">%</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputSize">Size</label>
                                                            <input name="size" type="text" class="form-control input-size" id="exampleInputSize" placeholder="Enter size">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputContent">Content</label>
                                                            <textarea name="content" required type="text" class="form-control" id="exampleInputContent" placeholder="Enter content" col="" rows="5"></textarea>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="new_item" class="form-check-input" type="checkbox" value="1" id="flexCheckIndeterminate">
                                                            <label class="form-check-label" for="flexCheckIndeterminate">
                                                                New item
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="trending_item" class="form-check-input" type="checkbox" value="1" id="flexCheckIndeterminate">
                                                            <label class="form-check-label" for="flexCheckIndeterminate">
                                                                Trending Item
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="col-md-8">
                                                        New Image
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group img-form">
                                                                    <label for="input-image-one">
                                                                        <input name="image[]" type="file" class="input-image" id="input-image-one">
                                                                        <div>
                                                                            <img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field">
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">#</span>
                                                                        </div>
                                                                        <input type="text" class="form-control input-color" placeholder="Enter hex color" aria-describedby="basic-addon3" name="color[]">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text input-color-span" id="basic-addon3">
                                                                                <div class="color-check">

                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group img-form">
                                                                    <label for="input-image-two">
                                                                        <input name="image[]" type="file" class="input-image" id="input-image-two">
                                                                        <div>
                                                                            <img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field">
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">#</span>
                                                                        </div>
                                                                        <input type="text" class="form-control input-color" placeholder="Enter hex color" aria-describedby="basic-addon3" name="color[]">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text input-color-span" id="basic-addon3">
                                                                                <div class="color-check">

                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group img-form">
                                                                    <label for="input-image-three">
                                                                        <input name="image[]" type="file" class="input-image" id="input-image-three">
                                                                        <div>
                                                                            <img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field">
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">#</span>
                                                                        </div>
                                                                        <input type="text" class="form-control input-color" placeholder="Enter hex color" aria-describedby="basic-addon3" name="color[]">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text input-color-span" id="basic-addon3">
                                                                                <div class="color-check">

                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group img-form">
                                                                    <label for="input-image-four">
                                                                        <input name="image[]" type="file" class="input-image" id="input-image-four">
                                                                        <div>
                                                                            <img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field">
                                                                        </div>
                                                                    </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">#</span>
                                                                        </div>
                                                                        <input type="text" class="form-control input-color" placeholder="Enter hex color" aria-describedby="basic-addon3" name="color[]">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text input-color-span" id="basic-addon3">
                                                                                <div class="color-check">

                                                                                </div>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary submit-add">Add</button>
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