[ varying-modal ] start -->
<div class="modal fade" id="set_price_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h2 class="modal-title" id="exampleModalLabel"><i class="fas fa-chart-line"></i> Fuel Price Control Module </h2>
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div id="server_response_"></div>
<form id="price_update_form">
	<input type="hidden" name="action" value="update_litre_price_now">
<div class="modal-body">
<div class="table-responsive">
<table class="table table-striped text-center">
<thead>
	<tr>
		<th>Fuel Type</th>
		<th>Current Price Per Litre</th>
		<th>New Price Per Litre</th>
		
	</tr>
</thead>
<tbody>

	 <?php $fuel_price = $Actions->fetch_fuel_price(); 

                        if ($fuel_price!=NULL) {
                         foreach ($fuel_price as $plist) {?>
                         <tr>
		<td><input type="hidden" name="id[]" value="<?php echo $plist->id?>"> <input type="hidden" name="fid[]" value="<?php echo $plist->fId ?>"> <h5><?php echo ucfirst($plist->fuel_type);?></h5></td>
		<td><input type="text" name="default_price[]" id="default_price" value="<?php echo number_format($plist->litre_price,2);?>" class="form-control" style="border: 1px solid grey;" readonly></td>
		<td><input type="text" name="new_price[]" id="new_price" class="form-control" placeholder="New Price here..."></td>
		
	</tr>
                                    <?php 
                                           
                                        }
                                    }
                                     ?>
</tbody>
</table>
</div>

</div>
<div class="modal-footer">
<button type="button" class="btn  btn-secondary" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-success btn-md __loading_btn__"><i class="fas fa-retweet"></i> Update Price</button>
</div>
</form>
</div>
</div>
</div>
<!-- [ varying-modal ] end -->
<!-- https://www.youtube.com/watch?v=1Rs2ND1ryYc -->
<!-- style="background-color: #2ca67a;"