<!-- [ varying-modal ] start -->
<div class="modal fade" id="update_meter_reading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
				<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-calculator"></i> Calculate & Submit Sales </h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
                <div class="server_response_"></div>
				<form id="submit_updated_sales_form">
				<div class="modal-body">
			<div class="row">
              <div class="col-md-6">
             <input type="hidden" name="action" value="submit_sales_detail">
             <input type="hidden" name="u_price" id="u_litre_price">
             <input type="hidden" name="u_aid" id="u_aid_id">
             <input type="hidden" name="u_staff" id="u_attendant_id">
             <input type="hidden" name="u_fuel" id="u_fuel_id">
             <input type="hidden" name="u_pump_id" id="u_pump_id">
            <div class="form-group">
                <label>Pump Desc<span class="fas fa-gas-pump"></span></label>
                 <input type="text"readonly class="form-control" name="u_pump_desc" id="u_pump_desc">
            </div>
                                </div>
         <div class="col-md-6">
            <div class="form-group">
                <label for="u_bsales">Meter Reading (Before Sales <span class="fas fa-tachometer-alt-half"></span>)</label>
                <input type="text" class="form-control" id="u_bsales" readonly name="bfs">
            </div>
        </div>
             <div class="col-md-6">
                <div class="form-group">
                  <label for="after_sales_"><span class="text-c-red">After Sales (Meter Reading) <i class="fas fa-gas-pump"></i></span></label>
                  <input type="number" placeholder="enter meter value" class="form-control" name="afs" id="after_sales_">
                </div>
            </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="u_sold_litre">Total Litres Sold <span class="fas fa-tachometer-alt"></span></label>
                <input type="text" class="form-control" name="u_litre" id="u_sold_litre" value="0" readonly>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="u_fuel_type">Fuel Desc <span class="fas fa-gas-pump"></span></label>
                <input type="text" class="form-control" name="u_fuel_type" id="u_fuel_type" readonly>
            </div>
        </div>
     <div class="col-md-6">
        <div class="form-group">
            <label for="u_money_make">Monetary Value <span class="fas fa-money-bill"></span></label>
            <input type="text" class="form-control" name="mmk" id="u_money_make" readonly>
        </div>
    </div>
            </div>
            	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn  btn-success __loading_btn__"> Submit Sales</button>
				</div>
			</form>
			</div>
		</div>
	</div>
<!-- [ varying-modal ] end -->