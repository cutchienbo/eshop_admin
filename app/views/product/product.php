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
								<div style="display:flex; align-items:center">
									<h5 class="mt-4">Best Seller : </h5>
								</div>

								<ul class="nav nav-pills mb-3 store-search" id="pills-tab" role="tablist">

									<div>
										<select name="year" class="form-control best-seller-year">

											<option value="" selected hidden>Year...</option>
											<option value=""></option>

											<?php for ($i = 2018; $i < 2024; $i++) { ?>

												<option value=<?php echo $i ?>>
													<?php echo $i ?>
												</option>

											<?php } ?>

										</select>
									</div>

									<div>
										<select name="precious" class="form-control best-seller-precious">

											<option value="" selected hidden>Precious...</option>
											<option value=""></option>

											<?php for ($i = 1; $i < 5; $i++) { ?>

												<option value=<?php echo $i ?>>
													<?php echo $i ?>
												</option>

											<?php } ?>

										</select>
									</div>

									<div>
										<select name="month" class="form-control best-seller-month">

											<option value="" selected hidden>Month...</option>
											<option value=""></option>

											<?php for ($i = 1; $i < 13; $i++) { ?>

												<option value=<?php echo $i ?>>
													<?php echo $i ?>
												</option>

											<?php } ?>

										</select>
									</div>

									<div class="search-button-div">
										<button name="store_submit" type="submit" class="search-button best-seller-sort">
											<i class="fas fa-search"></i>
										</button>
									</div>

								</ul>

								<ul class="nav nav-pills mb-3 best-seller" id="pills-tab" role="tablist">

									<li class="nav-item top-1">
										<!-- <h4>1</h4>
										<img src=<?php echo _WEB_ROOT . IMG_PATH . 'product/backpack.jpg' ?> alt="">
										<div class="best-seller-info">
											<p class="best-seller-name">Backpack</p>
											<p class="purchases">1000+</p>
										</div>
										<i class="fas fa-crown"></i> -->
									</li>
									<li class="nav-item top-2">
										<!-- <h4>2</h4>
										<img src=<?php echo _WEB_ROOT . IMG_PATH . 'product/backpack.jpg' ?> alt="">
										<div class="best-seller-info">
											<p class="best-seller-name">Backpack</p>
											<p class="purchases">1000+</p>
										</div>
										<i class="fas fa-chess-queen"></i> -->
									</li>
									<li class="nav-item top-3">
										<!-- <h4>3</h4>
										<img src=<?php echo _WEB_ROOT . IMG_PATH . 'product/backpack.jpg' ?> alt="">
										<div class="best-seller-info">
											<p class="best-seller-name">Backpack</p>
											<p class="purchases">1000+</p>
										</div>
										<i class="fas fa-chess-knight"></i> -->
									</li>

								</ul>



								<div style="display:flex; align-items:center">
									<h5 class="mt-4">Type Of Product : </h5>
									<div class="function" style="margin:24px 12px 8px">
										<a href=<?php echo  _WEB_ROOT . '/product/add_product_type' ?>><i class="fas fa-plus" style="margin-right:4px"></i>Add </a>
									</div>
								</div>

								<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

									<li class="nav-item ">
										<a class="nav-link <?php echo $active ? '' : 'active' ?>" id="pills-home-tab" href=<?php echo _WEB_ROOT . '/product' ?>>
											<img src=<?php echo  _WEB_ROOT . IMG_PATH . "product_type/full.png" ?> alt="">
											All
										</a>
									</li>

									<?php foreach ($product_type as $key => $value) { ?>

										<li class="nav-item product-type-item">
											<a class="nav-link <?php echo $active == $value['id'] ? 'active' : '' ?>" id="pills-home-tab" href=<?php echo _WEB_ROOT . '/product' . '/1' . '/' . $value['id'] ?>>
												<img src=<?php echo  _WEB_ROOT . IMG_PATH . "product_type/" . $value['image'] ?> alt="">
												<?php echo ucfirst($value['name_type']) ?>

											</a>
											<?php if ($active == $value['id']) { ?>
												<a href=<?php echo  _WEB_ROOT . "/product/edit_product_type/" . $value['id'] ?> class="product-type-edit">
													<i class="fas fa-edit"></i>
												</a>
												<a href=<?php echo  _WEB_ROOT . "/product/handle_delete_product_type/" . $value['id'] . "/" . $value['image'] ?> class="product-type-delete">
													<i class="fas fa-times-circle"></i>
												</a>
											<?php } ?>
										</li>

									<?php } ?>

								</ul>

								<div style="display:flex; align-items:center; justify-content:space-between">
									<div style="display:flex; align-items:center;">
										<h5 class="mt-4">Product : </h5>
										<div class="function" style="margin:24px 12px 8px">
											<a href=<?php echo _WEB_ROOT . '/product/add_product' ?>>
												<i class="fas fa-plus" style="margin-right:4px"></i>
												Add
											</a>

											<button class="btn delete-btn" style="margin:0 !important" type="submit" form="delete-form">
												<i class="fas fa-trash-alt"></i>
												Delete
											</button>


										</div>
									</div>
									<div>
										<div class="search-field" style="margin:24px 0px 8px">
											<i class="fas fa-search"></i>
											Search Form
										</div>
									</div>
								</div>

								<ul class="nav nav-product mb-3 search-form none" id="product-tab" role="tablist">
									<form action=<?php echo _WEB_ROOT . '/product/index/1/search' ?> method="post" class="row" style="width:100%">

										<div class="col-4">
											<div class="price">

												<div class="price-content">
													<p>Price:</p>
													<p id="min-value"></p>
													<p>-</p>
													<p id="max-value"></p>

												</div>

												<div class="range-slider">
													<input name="min_price" class="price-filter min-price" type="range" value=<?php echo $_SESSION['product_search']['min_price'] ?> min=<?php echo $_SESSION['product_search']['min_price'] ?> max=<?php echo $_SESSION['product_search']['max_price'] ?> step="1">
													<input name="max_price" class="price-filter max-price" type="range" value=<?php echo $_SESSION['product_search']['max_price'] ?> min=<?php echo $_SESSION['product_search']['min_price'] ?> max=<?php echo $_SESSION['product_search']['max_price'] ?> step="1">
												</div>

											</div>

											<div class="price number-size">

												<div class="size-content">

													<p>Number size:</p>
													<p id="min-size"></p>
													<p>-</p>
													<p id="max-size"></p>

												</div>

												<div class="range-slider">
													<input name="min_size" class="size-filter min-size" type="range" value=<?php echo $_SESSION['product_search']['min_size'] ?> min="19" max="45" step="1">
													<input name="max_size" class="size-filter max-size" type="range" value=<?php echo $_SESSION['product_search']['max_size'] ?> min="19" max="45" step="1">
												</div>
											</div>

											<div class="char-size option">
												<div>
													<?php foreach ($size_list as $key => $value) { ?>

														<div>
															<p><?php echo $value ?></p>
															<input type="checkbox" class="char-size-input" name="char_size[]" value=<?php echo $value ?> <?php echo in_array($value, $_SESSION['product_search']['char_size']) ? 'checked' : '' ?>>
														</div>

													<?php } ?>
												</div>
											</div>
										</div>

										<div class="col-4 search-input">

											<div>
												<input value="<?php echo $_SESSION['product_search']['name'] ?>" name="name" class="form-control" type="text" placeholder="Name . . .">
											</div>

											<div>
												<input value="<?php echo $_SESSION['product_search']['quantity'] ?>" name="quantity" class="form-control" type="text" placeholder="Quantity . . .">
											</div>

											<div>
												<input value="<?php echo $_SESSION['product_search']['star'] ?>" maxlength="1" min="1" max="5" name="star" class="form-control" type="text" placeholder="Star . . .">
											</div>

										</div>

										<div class="col-4 search-input">

											<div>
												<select name="type" class="form-control">

													<option value="">Type . . .</option>

													<?php foreach ($product_type as $key => $value) { ?>

														<option <?php echo $value['id'] == $_SESSION['product_search']['type'] ? 'selected' : '' ?> value=<?php echo $value['id'] ?>>
															<?php echo $value['name_type'] ?>
														</option>

													<?php } ?>

												</select>
											</div>

											<div>
												<input value="<?php echo $_SESSION['product_search']['discount'] ?>" min="0" max="100" maxlength="3" name="discount" class="form-control" type="text" placeholder="Discount . . .">
											</div>

											<div class="search-submit">
												<div class="deleted-button">
													Deleted
													<input class="deleted-checkbox" type="checkbox" name="deleted" <?php echo $_SESSION['product_search']['deleted'] == '1' ? '' : 'checked' ?>>
													<i class="fas fa-check <?php echo $_SESSION['product_search']['deleted'] ? 'none' : '' ?>"></i>
												</div>
												<button type="submit" class="search-button">
													<i class="fas fa-search"></i>
												</button>
											</div>

										</div>


									</form>
								</ul>

								<ul class="nav nav-product mb-3" id="product-tab" role="tablist">

									<table class="table table-product table-bordere">
										<thead>
											<tr class='header'>
												<?php if ($product[0]['status']) { ?>

													<th scope="col">
														<input type="checkbox" class="check-all" check='false'>
													</th>

												<?php } ?>

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

												<?php if ($product[0]['status']) { ?>

													<th scope="col">Edit</th>

												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<form action="<?php echo _WEB_ROOT . '/product/delete_product' ?>" method="post" id="delete-form">

												<?php foreach ($product as $key => $value) { ?>

													<tr class="item">
														<?php if ($value['status']) { ?>

															<td scope="col">
																<input class="product-check" type="checkbox" name="check[]" value=<?php echo $value['id'] ?>>
															</td>

														<?php } ?>

														<th scope="row">
															<?php echo ($key + 1) + (($pagination['index'] - 1) * $pagination['max_record']) ?>
														</th>
														<td>
															<img src="<?php echo $value['id_image'][0]['id_image'] ?>" alt="">
														</td>
														<td>
															<?php echo ucfirst($value['name']) ?>
														</td>
														<td>
															<?php echo ucfirst($value['name_type']) ?>
														</td>
														<td class="color-list">
															<div>
																<?php
																foreach ($value['id_image'] as $key => $item) { ?>

																	<div style="background-color:<?php echo '#' . $item['color'] ?>">
																	</div>

																<?php } ?>
															</div>
														</td>
														<td class="size-list">
															<?php if (!empty($value['size'][0]['id_size'])) { ?>

																<div>
																	<?php foreach ($value['size'] as $key => $item) { ?>

																		<div>
																			<?php echo $item['id_size'] ?>
																		</div>

																	<?php } ?>
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
														<?php if ($value['status']) { ?>

															<td>
																<a href=<?php echo  _WEB_ROOT . "/product/edit_product/" . $value['id'] ?>>

																	<i class="fas fa-edit" style="font-size:1.1rem"></i>

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
											<a class="page-link" href=<?php echo _WEB_ROOT . '/product'  . '/1' . $pagination['path'] ?> tabindex="-1">
												<i class="fas fa-angle-double-left"></i>
											</a>
										</li>
										<li class="page-item <?php echo $pagination['index'] == 1 ? 'disabled' : '' ?>">
											<a class="page-link" href=<?php echo _WEB_ROOT . '/product' . '/' . $pagination['prev'] . $pagination['path'] ?> tabindex="-1">
												<i class="fas fa-angle-left"></i>
											</a>
										</li>

										<?php for ($i = $pagination['start']; $i <= $pagination['end']; $i++) { ?>

											<li class="page-item <?php echo $i == $pagination['index'] ? 'active' : '' ?>">
												<a class="page-link" href=<?php echo _WEB_ROOT . '/product' . '/' . $i . $pagination['path']  ?>>
													<?php echo $i ?>
												</a>
											</li>

										<?php } ?>

										<li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
											<a class="page-link" href=<?php echo _WEB_ROOT . '/product' . '/' . $pagination['next']  . $pagination['path'] ?>>
												<i class="fas fa-angle-right"></i>
											</a>
										</li>
										<li class="page-item <?php echo $pagination['index'] == $pagination['tabs'] ? 'disabled' : '' ?>">
											<a class="page-link" href=<?php echo _WEB_ROOT . '/product' . '/' . $pagination['tabs'] . $pagination['path'] ?>>
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

<script>
	var bestSellerSortBtn = document.querySelector('.best-seller-sort');
	var top1 = document.querySelector('.best-seller .top-1');
	var top2 = document.querySelector('.best-seller .top-2');
	var top3 = document.querySelector('.best-seller .top-3');
	var yearSelect = document.querySelector('.best-seller-year');
	var preciousSelect = document.querySelector('.best-seller-precious');
	var monthSelect = document.querySelector('.best-seller-month');
	var date = new Date();

	yearSelect.value = date.getFullYear();
	monthSelect.value = date.getMonth();
	preciousSelect.value = (Math.ceil((date.getMonth()+1)/3));

	addBestSeller();

	bestSellerSortBtn.onclick = () => {
		addBestSeller(yearSelect.value, preciousSelect.value, monthSelect.value);
	}

	function addBestSeller(year = '', precious = '', month = '') {
		$.ajax({
			url: "<?php echo _WEB_ROOT . '/product/best_seller' ?>",
			dataType: 'json',
			method: 'post',
			data:{
				year:year,
				precious:precious,
				month:month
			},
			success: (result) => {

				if(result){
					top1.innerHTML = `
				<h4>1</h4>
				<img src="${result[0].image}" alt="">
				<div class="best-seller-info">
					<p class="best-seller-name">${result[0].name}</p>
					<p class="purchases">${result[0].count}+</p>
				</div>
				<i class="fas fa-crown"></i>
				`;

				top2.innerHTML = `
				<h4>2</h4>
				<img src="${result[1].image}" alt="">
				<div class="best-seller-info">
					<p class="best-seller-name">${result[1].name}</p>
					<p class="purchases">${result[1].count}+</p>
				</div>
				<i class="fas fa-chess-queen"></i>
				`;

				top3.innerHTML = `
				<h4>3</h4>
				<img src="${result[2].image}" alt="">
				<div class="best-seller-info">
					<p class="best-seller-name">${result[2].name}</p>
					<p class="purchases">${result[2].count}+</p>
				</div>
				<i class="fas fa-chess-knight"></i>
				`;
				}
			}
		})
	}

	var deletedBtn = document.querySelector('.deleted-button');
	var deletedCheckBox = document.querySelector('.deleted-checkbox');
	var deletedCheckIcon = document.querySelector('.deleted-button i');

	deletedBtn.onclick = () => {
		if (deletedCheckBox.checked) {
			deletedCheckBox.checked = false;
		} else {
			deletedCheckBox.checked = true;
		}
		deletedCheckIcon.classList.toggle('none');
		console.log(deletedCheckBox.checked)
	}

	var checkAll = document.querySelector('.check-all');
	var checkProducts = document.querySelectorAll('.product-check');
	var deleteBtn = document.querySelector('.delete-btn');

	deleteBtn.disabled = true;
	deleteBtn.classList.add('disabled');

	checkAll.onclick = () => {
		if (checkAll.check) {

			checkProducts.forEach((item, key) => {
				item.checked = false
			})

			deleteBtn.disabled = true;
			deleteBtn.classList.add('disabled');
			checkAll.check = false;
		} else {

			checkProducts.forEach((item, key) => {
				item.checked = true
			})

			deleteBtn.disabled = false;
			deleteBtn.classList.remove('disabled');
			checkAll.check = true;
		}
	}

	checkProducts.forEach((item, key) => {
		item.onclick = () => {
			let check = false;

			for (itemCheck of checkProducts) {
				if (itemCheck.checked) {
					check = true;
					break;
				} else {
					check = false;
				}
			}

			if (check) {
				deleteBtn.disabled = false;
				deleteBtn.classList.remove('disabled');
				item.check = true;
			} else {
				deleteBtn.disabled = true;
				deleteBtn.classList.add('disabled');
				item.check = false;
			}
		}
	})

	var searchBtn = document.querySelector('.search-field');
	var searchField = document.querySelector('.search-form');

	searchBtn.onclick = () => {
		searchField.classList.toggle('none');
	}

	let minValue = document.getElementById("min-value");
	let maxValue = document.getElementById("max-value");

	let minSize = document.getElementById("min-size");
	let maxSize = document.getElementById("max-size");

	function validateRange(minPrice, maxPrice) {
		if (minPrice >= maxPrice) {

			// Swap to Values
			let tempValue = maxPrice;
			maxPrice = minPrice;
			minPrice = tempValue;
		}

		minValue.innerHTML = "$" + minPrice;
		maxValue.innerHTML = "$" + maxPrice;
	}

	function validateRangeSize(minPrice, maxPrice) {
		if (minPrice > maxPrice) {

			// Swap to Values
			let tempValue = maxPrice;
			maxPrice = minPrice;
			minPrice = tempValue;
		}

		if (minPrice == 19) {
			minPrice = 0;
		}

		if (maxPrice == 19) {
			maxPrice = 0;
		}

		minSize.innerHTML = minPrice;
		maxSize.innerHTML = maxPrice;
	}

	const inputElements = document.querySelectorAll(".price-filter");
	const inputSize = document.querySelectorAll(".size-filter");

	inputSize.forEach((element) => {
		element.addEventListener("change", (e) => {
			let minPrice = parseInt(inputSize[0].value);
			let maxPrice = parseInt(inputSize[1].value);

			validateRangeSize(minPrice, maxPrice);
			handleInputData()
		});
	});

	inputElements.forEach((element) => {
		element.addEventListener("change", (e) => {
			let minPrice = parseInt(inputElements[0].value);
			let maxPrice = parseInt(inputElements[1].value);

			validateRange(minPrice, maxPrice);
			handleInputData();
		});
	});

	validateRange(inputElements[0].value, inputElements[1].value);
	validateRangeSize(inputSize[0].value, inputSize[1].value);
</script>