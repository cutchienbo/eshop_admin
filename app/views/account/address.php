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
                                    <h5 class="mt-4">Address : <em><?php echo $customer_name ?></em> </h5>

                                    <div class="function" style="margin:24px 12px 8px">
                                        <a href="#" class="add-address"><i class="fas fa-plus" style="margin-right:4px"></i>Add </a>
                                    </div>

                                    <form method="post" action=<?php echo _WEB_ROOT . '/account/add_address/' . $customer_id . '/' . $customer_name ?>>
                                        <div class="add-address-input none">
                                            <input type="text" class="form-control" name="address" required>
                                            <button type="submit">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <ul class="nav nav-product mb-3" id="product-tab" role="tablist">

                                    <table class="table table-product table-bordere">
                                        <thead>
                                            <tr class='header'>
                                                <th scope="col">#</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                                <th scope="col">Default</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="<?php echo _WEB_ROOT . '/product/delete_product' ?>" method="post" id="delete-form">

                                                <?php foreach ($address as $key => $value) { ?>

                                                    <tr class="item">
                                                        <th scope="row">
                                                            <?php echo $key + 1 ?>
                                                        </th>

                                                        <td>
                                                            <?php echo $value['location'] ?>

                                                            <?php if ($value['status']) { ?>
                                                                <span class="default-address">Default</span>
                                                            <?php } ?>
                                                        </td>

                                                        <td>
                                                            <a href=<?php echo _WEB_ROOT.'/account/edit_address/' . $value['id'] . '/' . $value['id_customer'] . '/' . $customer_name ?>>
                                                                <i class="fas fa-edit" style="font-size:1.2rem"></i>
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <a href=<?php echo _WEB_ROOT . '/account/delete_address/' . $value['id'] . '/' . $value['id_customer'] . '/' . $customer_name ?>>
                                                                <i class="fas fa-trash-alt" style="font-size:1.2rem"></i>
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <?php if (!$value['status']) { ?>
                                                                <a href=<?php echo _WEB_ROOT . '/account/set_default_address/' . $value['id'] . '/' . $value['id_customer'] . '/' . $customer_name ?>>
                                                                    <i class="fas fa-check-circle" style="font-size:1.2rem"></i>
                                                                </a>
                                                            <?php } ?>
                                                        </td>

                                                    </tr>

                                                <?php } ?>


                                            </form>
                                        </tbody>
                                    </table>

                                </ul>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var addAddressField = document.querySelector('.add-address-input');
    var addAddressBtn = document.querySelector('.add-address');

    addAddressBtn.onclick = () => {
        addAddressField.classList.toggle('none');
    }
</script>