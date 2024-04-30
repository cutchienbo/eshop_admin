<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                
                        <div class="row">

                            <div class="col-sm-12">
                                <div style="display:flex; align-items:center; justify-content:space-between">
                                    <h5 class="mt-4">Comment Filter : </h5>
                                </div>

                                <ul class="nav nav-pills mb-3 comment-add" id="pills-tab" role="tablist">
                                    <div>
                                        <input form="unvalid" value="" name="string" class="form-control" type="text" placeholder="String...">
                                        <button class="btn btn-primary" form="unvalid" type="submit">Add</button>
                                    </div>
                                </ul>

                                <div class="card">
                                    <div class="card-body">


                                        <table class="table table-product">
                                            <thead>
                                                <tr class='header'>
                                                    <th scope="col">#</th>
                                                    <th scope="col">String</th>
                                                    <th scope="col">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <form id="unvalid" action=<?php echo _WEB_ROOT . '/comment/add_unvalid' ?> class="edit-product-form" method="post" enctype="multipart/form-data">
                                                    <?php foreach ($unvalid_words as $key => $value) { ?>

                                                        <tr class="item">
                                                            <th scope="col"><?php echo $key + 1 ?></th>
                                                            <td><?php echo $value['unvalid_string'] ?></td>
                                                            <td>
                                                                <a href=<?php echo _WEB_ROOT . '/comment/delete_unvalid/' . $value['unvalid_string'] ?> style="font-size:1.2rem">
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </a>
                                                            </td>
                                                        </tr>

                                                    <?php } ?>
                                                </form>

                                            </tbody>
                                        </table>

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