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
                       
                        <div class="row">
                            
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-product table-bordered">
                                            <thead>
                                                <tr class='header'>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Product value</th>
                                                    <th scope="col">Edit value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form id="edit-product-form" action=<?php echo _WEB_ROOT . '/product/handle_edit_product/' . $product['id'] ?> class="edit-product-form" method="post" enctype="multipart/form-data">

                                                    <tr class="item">
                                                        <th scope="col">Name</th>
                                                        <td><?php echo $this->view->name_upper($product['name']) ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="name" type="text" class="form-control" placeholder="Enter name">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Type</th>
                                                        <td><?php echo $this->view->name_upper($product['name_type']) ?></td>
                                                        <td>
                                                            <div>
                                                                <select name="type" class="form-control">
                                                                    <option value=""></option>
                                                                    <?php foreach ($product_type as $value) { ?>

                                                                        <option value=<?php echo $value['id'] ?>>
                                                                            <?php echo $value['name_type'] ?>
                                                                        </option>

                                                                    <?php } ?>

                                                                </select>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Size</th>
                                                        <td>
                                                            <?php
                                                            $size = [];
                                                            foreach ($product['size'] as $key => $value) {
                                                                $size[] = $value['id_size'];
                                                            }
                                                            $size = implode(' - ', $size);
                                                            echo $size;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <input name="size" type="text" class="form-control" placeholder="Enter size">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Quantity</th>
                                                        <td><?php echo $product['quantity'] ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="quantity" type="text" class="form-control" placeholder="Enter quantity">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Cost</th>
                                                        <td><?php echo '$' . $product['cost'] ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="cost" type="text" class="form-control" placeholder="Enter cost">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Discount</th>
                                                        <td><?php echo $product['discount'] . '%' ?></td>
                                                        <td>
                                                            <div>
                                                                <input name="discount" type="text" class="form-control" placeholder="Enter discount">
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr class="item">
                                                        <th scope="col">Content</th>
                                                        <td class="edit-content">
                                                            <div ><?php echo $product['content'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div>
                                                                <textarea name="content" type="text" class="form-control" placeholder="Enter content" col="" rows="5"></textarea>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <?php
                                                    for ($i = 0; $i < 4; $i++) {
                                                        if (isset($product['image'][$i])) {
                                                            $img_src = $product['image'][$i]['id_image'];
                                                            $color = $product['image'][$i]['color'];
                                                            $img_edit = $img_src;
                                                        } else {
                                                            $img_edit = _WEB_ROOT . IMG_PATH . 'main/no-image.jpg';
                                                            $img_src = _WEB_ROOT . IMG_PATH . 'main/none.png';
                                                            $color = '';
                                                        }
                                                    ?>

                                                        <tr class="item">
                                                            <th scope="col">Image & color</th>
                                                            <td>
                                                                <div class="edit-image-value">
                                                                    <img src=<?php echo $img_src ?> alt="">
                                                                    <div style="background-color:<?php echo '#' . $color ?>"></div>
                                                                </div>
                                                            </td>

                                                            <td class="edit-image">

                                                                <div>
                                                                    <div class="form-group img-form">
                                                                        <label for="input-image-<?php echo $i ?>">
                                                                            <input name="image[]" type="file" class="input-image" id="input-image-<?php echo $i ?>">
                                                                            <div>
                                                                                <div class="edit-image-value">
                                                                                    <img src=<?php echo  $img_edit ?> alt="<?php echo $product['image'][$i]['public_id'] ?>" class="img-field">
                                                                                    <div class="color-check" style="background-color:<?php echo '#' . $color ?>"></div>
                                                                                </div>
                                                                            </div>
                                                                        </label>
                                                                        <?php if ($color) { ?>
                                                                            <div class="delete-image"><i class="fas fa-times"></i></div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="form-group">

                                                                        <input value="#<?php echo $color ?>" type="text" class="form-control input-color" placeholder="Enter hex color" aria-describedby="basic-addon3" name="color[]">

                                                                    </div>

                                                                </div>

                                                            </td>

                                                        </tr>

                                                    <?php } ?>

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
<script>
    var deleteImage = document.querySelectorAll('.delete-image');
    var colorField = document.querySelectorAll('.input-color');
    var image = document.querySelectorAll('.img-field');
    var checkColor = document.querySelectorAll('.color-check');

    if (deleteImage != null) {
        $('document').ready(() => {
            deleteImage.forEach((item, key) => {
                item.onclick = () => {
                    $.ajax({
                        url: '<?php echo _WEB_ROOT . '/product/delete_product_image/' . $product['id'] ?>',
                        method: 'post',
                        data: {
                            color: colorField[key].value,
                            id_image: image[key].alt
                        }
                    })
                    
                    colorField[key].value = '';
                    image[key].src='<?php echo _WEB_ROOT .IMG_PATH. 'main/no-image.jpg' ?>';
                    checkColor[key].style.backgroundColor = '';
                    item.style.display = 'none';
                }
            })
        })
    }
    
    colorField.forEach((item, key) => {
        item.onkeyup = (e) => {
            value = e.target.value.trim('#');
            checkColor[key].style.backgroundColor = value
        }
    })
</script>