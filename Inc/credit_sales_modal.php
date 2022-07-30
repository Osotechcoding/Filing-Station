<!-- [ varying-modal ] start -->
			<div class="modal fade" id="add_credit_sold_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Enter Transaction Details </h2>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
                                <div id="_server_result_"></div>
									<form id="add_credit_sales_form">
									<div class="modal-body">
										 <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="action" value="upload_credit_sold_now">
                                    <div class="form-group">
                                        <label for="seller_id">Seller <span class="fas fa-user-secret"></span></label>
                                         <select name="seller_id" id="seller_id" class="custom-select">
                                         	<option value="">Choose...</option>
                                        	<?php echo $Actions->staff_in_dropdown();?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                 
                                    <div class="form-group">
                                        <label for="buyer_id">Buyer <span class="fas fa-truck"></span></label>
                                         <select name="buyer_id" id="buyer_id" class="custom-select">
                                            <option value="">Choose...</option>
                                           <?php echo $Actions->creditors_in_dropdown();?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                 
                                    <div class="form-group">
                                        <label for="__fuel_id">Fuel Type <span class="fas fa-gas-pump"></span></label>
                                         <select name="fuel_id" id="__fuel_id" class="custom-select">
                                            <option value="">Choose...</option>
                                           <?php echo $Actions->fuel_in_dropdown();?>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="hidden" name="price_of_litre" id="price_of_litre">
                                    
                                        <label for="_litre_">Litre(s) Bought <span class="fas fa-phone"></span></label>
                                        <input type="number" autocomplete="off" class="form-control" id="_litre_" name="litre" placeholder="10 Litres">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sold_amount">Total Amount <span class="fas fa-envelope-open"></span></label>
                                        <input type="text" autocomplete="off" name="sold_amount" class="form-control" id="sold_amount" readonly>
                                    </div>
                                </div>
                               <div class="col-md-6">
                                 
                                    <div class="form-group">
                                        <label for="pump_id">Sales Point <span class="fas fa-gas-pump"></span></label>
                                         <select name="pump_id" id="pump_id" class="custom-select">
                                            <option value="">Choose...</option>
                                           <?php echo $Actions->fetch_pumps_in_dropdown();?>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
											
									</div>
									<div class="modal-footer">
										<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-success mb-1 __loading_rolling__">Submit</button>
									</div>
								</form>
								</div>
							</div>
						</div>
			<!-- [ varying-modal ] end -->