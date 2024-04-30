<div class="pcoded-main-container">
	<div class="pcoded-wrapper">
		<div class="pcoded-content">
			<div class="pcoded-inner-content">
				<div class="main-body">
					<div class="page-wrapper">
						<div class="row">
							<!-- [ tabs ] start -->
							<div class="col-sm-12">
								<div style="display:flex; align-items:center; justify-content:space-between">
									<h5 class="mt-4">Store : </h5>
								</div>

								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
									<li class="nav-item">
										<a class="nav-link <?php echo $status == '1' ? 'active' : '' ?>" id="pills-home-tab" data-toggle="pill" href=<?php echo _WEB_ROOT . '/store/1/' . $pagination['index'] ?> role="tab" aria-controls="pills-home" aria-selected="true">
											Pending
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link <?php echo $status == '2' ? 'active' : '' ?>" id="pills-home-tab" data-toggle="pill" href=<?php echo _WEB_ROOT . '/store/2/' . $pagination['index'] ?> role="tab" aria-controls="pills-home" aria-selected="true">
											Preparing
										</a>
									</li>
									<li class="nav-item ">
										<a class="nav-link <?php echo $status == '3' ? 'active' : '' ?>" id="pills-profile-tab" data-toggle="pill" href=<?php echo _WEB_ROOT . '/store/3/' . $pagination['index'] ?> role="tab" aria-controls="pills-profile" aria-selected="false">
											Delivering
										</a>
									</li>
									<li class="nav-item ">
										<a class="nav-link <?php echo $status == '4' ? 'active' : '' ?>" id="pills-contact-tab" data-toggle="pill" href=<?php echo _WEB_ROOT . '/store/4/' . $pagination['index'] ?> role="tab" aria-controls="pills-contact" aria-selected="false">
											Delivered
										</a>
									</li>
									<li class="nav-item ">
										<a class="nav-link <?php echo $status == '5' ? 'active' : '' ?>" id="pills-contact-tab" data-toggle="pill" href=<?php echo _WEB_ROOT . '/store/5/' . $pagination['index'] ?> role="tab" aria-controls="pills-contact" aria-selected="false">
											Cancelled
										</a>
									</li>
								</ul>

								<form action=<?php echo _WEB_ROOT . $_SERVER['PATH_INFO'] ?> method="post">
									<ul class="nav nav-pills mb-3 store-search" id="pills-tab" role="tablist">

										<div>
											<select name="year" class="form-control">

												<option <?php echo $_SESSION['orders_search']['year'] == '' ? 'selected' : '' ?> value="" selected hidden>Year...</option>
												<option value=""></option>

												<?php for ($i = 2018; $i < 2024; $i++) { ?>

													<option <?php echo $_SESSION['orders_search']['year'] == $i ? 'selected' : '' ?> value=<?php echo $i ?>>
														<?php echo $i ?>
													</option>

												<?php } ?>

											</select>
										</div>

										<div>
											<select name="month" class="form-control">

												<option <?php echo $_SESSION['orders_search']['month'] == '' ? 'selected' : '' ?> value="" selected hidden>Month...</option>
												<option value=""></option>

												<?php for ($i = 1; $i < 13; $i++) { ?>

													<option <?php echo $_SESSION['orders_search']['month'] == $i ? 'selected' : '' ?> value=<?php echo $i ?>>
														<?php echo $i ?>
													</option>

												<?php } ?>

											</select>
										</div>

										<div>
											<select name="day" class="form-control">

												<option <?php echo $_SESSION['orders_search']['day'] == '' ? 'selected' : '' ?> value="" selected hidden>Day...</option>
												<option value=""></option>

												<?php for ($i = 1; $i < 32; $i++) { ?>

													<option <?php echo $_SESSION['orders_search']['day'] == $i ? 'selected' : '' ?> value=<?php echo $i ?>>
														<?php echo $i ?>
													</option>

												<?php } ?>

											</select>
										</div>

										<div class="search-button-div">
											<button name="store_submit" type="submit" class="search-button">
												<i class="fas fa-search"></i>
											</button>
										</div>

									</ul>
								</form>

								<ul class="nav nav-product mb-3" id="product-tab" role="tablist">

									<table class="table table-product table-bordere">
										<thead>
											<tr class='header'>
												<th scope="col">#</th>
												<th scope="col">Receiver</th>
												<th scope="col">Phone</th>
												<th scope="col">Location</th>
												<th scope="col">Cost</th>
												<th scope="col">Date</th>
												<th scope="col">Detail</th>

												<?php if ($status < 3) { ?>

													<th scope="col">Edit</th>

												<?php } ?>

												<?php if ($status < 4) { ?>

													<th scope="col">Delete</th>

												<?php } ?>

												<?php if ($status < 4 && $status > 0) { ?>

													<th scope="col">Browse</th>

												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<form action="<?php echo _WEB_ROOT . '/store/delete_product' ?>" method="post" id="delete-form">

												<?php foreach ($orders as $key => $value) { ?>

													<tr class="item">

														<th scope="row">
															<?php echo ($key + 1) + (($pagination['index'] - 1) * 10) ?>
														</th>

														<td style="font-weight:bold">
															<?php echo $value['receiver'] ?>
														</td>
														<td>
															<?php echo  $value['phone_number'] ?>
														</td>

														<td>
															<?php echo $value['location'] ?>
														</td>
														<td>
															<?php echo '$' . $value['cost'] ?>
														</td>
														<td>
															<?php echo  $value['create_date'] ?>
														</td>
														<td>
															<a href=<?php echo _WEB_ROOT . '/store/detail_order/' . $value['id_cart'] . '/' . $value['id_customer'] . '/1' ?>>
																<i class="feather icon-info" style="font-size:1.2rem"></i>
															</a>
														</td>

														<?php if ($status < 3) { ?>

															<td>
																<a href=<?php echo _WEB_ROOT . '/store/edit_order/' . $value['id_cart'] . '/' . $value['id_customer'] . '/' . $status . '/' . $pagination['index'] ?>>
																	<i class="feather icon-edit" style="font-size:1.2rem"></i>
																</a>
															</td>

														<?php } ?>

														<?php if ($status < 4) { ?>

															<td>
																<a href=<?php echo _WEB_ROOT . '/store/cancel_order/' . $value['id_cart'] . '/' . $value['id_customer'] . '/' . $status . '/' . $pagination['index'] ?>>
																	<i class="feather icon-trash" style="font-size:1.2rem"></i>
																</a>
															</td>

														<?php } ?>

														<?php if ($status < 4 && $status > 0) { ?>

															<td>
																<a href=<?php echo _WEB_ROOT . '/store/change_status/' . $value['id_cart'] . '/' . $value['id_customer'] . '/' . $status . '/' . $pagination['index'] ?>>
																	<i class="feather icon-check-circle" style="font-size:1.2rem"></i>
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
											<a class="page-link" href=<?php echo _WEB_ROOT . '/store' . '/' . $status . '/' . '1' ?> tabindex="-1">
												<i class="fas fa-angle-double-left"></i>
											</a>
										</li>
										<li class="page-item <?php echo $pagination['index'] == 1 ? 'disabled' : '' ?>">
											<a class="page-link" href=<?php echo _WEB_ROOT . '/store' . '/' . $status . '/' . $pagination['prev'] ?> tabindex="-1">
												<i class="fas fa-angle-left"></i>
											</a>
										</li>

										<?php for ($i = $pagination['start']; $i <= $pagination['end']; $i++) { ?>

											<li class="page-item <?php echo $i == $pagination['index'] ? 'active' : '' ?>">
												<a class="page-link" href=<?php echo _WEB_ROOT . '/store' . '/' . $status . '/' . $i ?>>
													<?php echo $i ?>
												</a>
											</li>

										<?php } ?>

										<li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
											<a class="page-link" href=<?php echo _WEB_ROOT . '/store' . '/' . $status . '/' . $pagination['next'] ?>>
												<i class="fas fa-angle-right"></i>
											</a>
										</li>
										<li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
											<a class="page-link" href=<?php echo _WEB_ROOT . '/store' . '/' . $status . '/' . $pagination['tabs'] ?>>
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