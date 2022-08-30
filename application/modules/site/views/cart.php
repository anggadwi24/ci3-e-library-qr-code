<!-- Cart contant start -->
			<div class="contant">
				<div id="banner-part" class="banner inner-banner">
					<div class="container">
						<div class="bread-crumb-main">
							<h1 class="banner-title">Keranjang Belanja</h1>
							<div class="breadcrumb">
			                    <ul class="inline">
			                        <li><a href="<?= base_url() ?>">Home</a></li>
			                        <li>Keranjang Belanja</li>
			                    </ul>
			                </div>
						</div>
					</div>
				</div>
				<div class="ptb-100">
					<div class="container">
						<div class="cart-item-table commun-table">
				            <div class="table-responsive" id="cartData">
				              <table class="table border mb-0">
				                <thead>
				                  <tr>
				                    <th class="align-left">#</th>
				                    <th class="align-left">Produk</th>
				                    <th>Harga</th>
				                    <th>Jumlah</th>
				                    <th>Sub Total</th>
				                    <th>#</th>
				                  </tr>
				                </thead>
				                <tbody>
				                	
				                  <tr>
				                    <td class="align-left">
				                      <a href="product-page.html">
				                        <div class="product-image">
				                          <img alt="Eshoper" src="images/1.jpg">
				                        </div>
				                      </a>
				                    </td>
				                    <td class="align-left">
				                      <div class="product-title"> 
				                        <a href="product-page.html">Men's Full Sleeves Collar Shirt</a> 
				                      </div>
				                    </td>
				                    <td>
				                      <ul>
				                        <li>
				                          <div class="base-price price-box"> 
				                            <span class="price">$80.00</span> 
				                          </div>
				                        </li>
				                      </ul>
				                    </td>
				                    <td>
				                      <div class="input-box">
				                        <select data-id="100" class="quantity_cart" name="quantity_cart">
				                          <option selected="" value="1">1</option>
				                          <option value="2">2</option>
				                          <option value="3">3</option>
				                          <option value="4">4</option>
				                        </select>
				                      </div>
				                    </td>
				                    <td>
				                        <div class="total-price price-box"> 
				                        <span class="price">$80.00</span> 
				                      </div>
				                    </td>
				                    <td>
				                    	<a href="javascript:void(0)" class="btn small btn-color">
					                    	<i title="Remove Item From Cart" data-id="100" class="fa fa-trash cart-remove-item"></i>
					                	</a>
				                    </td>
				                  </tr>
				                  
				                </tbody>
				              </table>
				            </div>
				        </div>
				        <div class="mb-30">
					       
				        </div>

				        <hr>

				        <div class="mtb-30">
					        <div class="row">
					          <div class="col-md-12">
					            <div class="cart-total-table commun-table">
					              <div class="table-responsive">
					                <table class="table border">
					                  <thead>
					                    <tr>
					                      <th colspan="2">Total</th>
					                    </tr>
					                  </thead>
					                  <tbody>
					                    <tr>
					                      <td>Total Produk</td>
					                      <td>
					                        <div class="price-box"> 
					                          <span class="price" id="total">$160.00</span> 
					                        </div>
					                      </td>
					                    </tr>
					                    <tr>
					                      <td><b>Jumlah Pembayaran</b></td>
					                      <td>
					                        <div class="price-box"> 
					                          <span class="price" id="subtotal"><b>$160.00</b></span> 
					                        </div>
					                      </td>
					                    </tr>
					                  </tbody>
					                </table>
					              </div>
					            </div>
					          </div>
					        </div>
					    </div>
					    <hr>
					    <div class="mt-30">
							<div class="row">
						        <div class="col-md-6">
						            <div class="mt-30"> 
						              <a href="<?= base_url('product') ?>" class="btn btn-color">
						                <i class="fa fa-angle-left"></i><span>Lanjut Belanja</span>
						              </a> 
						            </div>
						        </div>
						        <div class="col-md-6">
									<div class="right-side mt-30" id="buttonCheckout"> 
						        </div>
					        </div>
					        
					    </div>
					</div>
				</div>
			</div>
			<!-- Cart contant end -->