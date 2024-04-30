<!-- <?php 
	echo '<pre>';
	print_r($product);
	echo '</pre>';
?> -->

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="row">
                            <!-- [ tabs ] start -->
                            <div class="col-sm-12">
                                <div class="page-header">
                                    <div class="page-block">
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <div class="page-header-title">
                                                    <h5 class="m-b-10">Oder Detail</h5>
                                                </div>
                                                <ul class="breadcrumb">
                                                    <li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/store" ?>><i class="feather icon-home"></i></a></li>
                                                    <li class="breadcrumb-item"><a href="#!">Oder Detail</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <ul class="nav nav-product mb-3" id="product-tab" role="tablist">

                                    <table class="table table-product table-bordere">
                                        <thead>
                                            <tr class='header'>

                                                <th scope="col">#</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Color</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Star</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Cost</th>
                                                <th scope="col">Discount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form action="<?php echo _WEB_ROOT . '/product/delete_product' ?>" method="post" id="delete-form">
                                           
                                                <?php foreach ($product as $key => $value) { ?>
                                                   
                                                    <tr class="item">

                                                        <th scope="row">
                                                            <?php echo ($key + 1) + (($pagination['index'] - 1) * 10) ?>
                                                        </th>
                                                        <td>
                                                            <img src=<?php echo $value['id_image'][0]['id_image'] ?> alt="">
                                                        </td>
                                                        <td>
                                                            <?php echo ucfirst($value['name']) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo ucfirst($value['name_type']) ?>
                                                        </td>
                                                        <td class="color-list">
                                                            <div>
                                                                <div style="background-color:<?php echo '#' . $value['color'] ?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="size-list">
                                                            <?php if (!empty($value['size'])) { ?>

                                                                <div>

                                                                    <?php echo $value['size'] ?>

                                                                </div>

                                                            <?php } ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $value['star'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $value['quantity'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo '$' . $value['cost'] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $value['discount'] ? $value['discount'] . '%' : '0%' ?>
                                                        </td>

                                                    </tr>

                                                <?php } ?>


                                            </form>
                                        </tbody>
                                    </table>
                                </ul>

                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item <?php echo $pagination['index'] == 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/store' . "/" . '1' ?> tabindex="-1">
                                                <i class="fas fa-angle-double-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item <?php echo $pagination['index'] == 1 ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/store' . "/" . $pagination['prev'] ?> tabindex="-1">
                                                <i class="fas fa-angle-left"></i>
                                            </a>
                                        </li>

                                        <?php for ($i = $pagination['start']; $i <= $pagination['end']; $i++) { ?>

                                            <li class="page-item <?php echo $i == $pagination['index'] ? 'active' : '' ?>">
                                                <a class="page-link" href=<?php echo _WEB_ROOT . '/store' . "/" . $i ?>>
                                                    <?php echo $i ?>
                                                </a>
                                            </li>

                                        <?php } ?>

                                        <li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/store' . "/" . $pagination['next'] ?>>
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        </li>
                                        <li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
                                            <a class="page-link" href=<?php echo _WEB_ROOT . '/store' . "/" . $pagination['tabs'] ?>>
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                            <!-- [ tabs ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>