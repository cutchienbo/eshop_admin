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
											<h5 class="m-b-10">Add Product Type</h5>
										</div>
										<ul class="breadcrumb">
											<li class="breadcrumb-item"><a href=<?php echo _WEB_ROOT . "/product" ?>><i class="feather icon-home"></i></a></li>
											<li class="breadcrumb-item"><a href="#!">Add Product Type</a></li>
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
												<form action=<?php echo _WEB_ROOT . '/product/handle_add_product_type' ?> method="post" enctype="multipart/form-data">
													<div class="col-md-3">
														<div class="form-group">
															<label for="exampleInputName">Name</label>
															<input required name="type_name" type="text" class="form-control" id="exampleInputName" placeholder="Enter name">
														</div>
														New Image
														<div class="form-group img-form">

															<label for="input-image">

																<input name="type_image" type="file" class="form-control" id="input-image" class="input-image">
																<div>
																	<img src=<?php echo  _WEB_ROOT . IMG_PATH . 'main/no-image.jpg' ?> alt="" class="img-field">
																</div>
															</label>
														</div>
													</div>
													<button type="submit" class="btn btn-primary">Add</button>
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