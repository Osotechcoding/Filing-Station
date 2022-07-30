<?php 
//ajax_actions

require_once '../Classes/Actions.php';

@Session::init();
$Actions = new Actions();

if (isset($_POST['action']) && $_POST['action'] !="") {
	
	switch ($_POST['action']) {
		case 'reg_admin_now':
			$result =$Actions->register($_POST);
			if ($result) {
				echo $result;
			}
			break;
			
			case 'login_admin_now':
			$result =$Actions->login($_POST);
			if ($result) {
				echo $result;
			}
			break;

			case 'set_2FAuth_':
			$result =$Actions->set_2FAuth($_POST);
			if ($result) {
				echo $result;
			}
			break;

			case 'logout':
			$Actions->logout();
			break;
			// send_reset_link
			case 'send_reset_link':
			$result =$Actions->admin_forgot_password($_POST);
			if ($result) {
				echo $result;
			}
			break;
			//reset_password_now
			case 'reset_password_now':
			$result =$Actions->admin_reset_password($_POST);
			if ($result) {
				echo $result;
			}
			break;
			//create pump create_pump($data)
			case 'create_pump_now':
			$result =$Actions->create_pump($_POST);
			if ($result) {
				echo $result;
			}
			break;

			//update new litre price 
			case 'update_litre_price_now':
			$result =$Actions->update_new_price($_POST);
			if ($result) {
				echo $result;
			}
			break;

			//add_creditor_now
			case 'add_creditor_now':
			$result =$Actions->register_creditor($_POST);
			if ($result) {
				echo $result;
			}
			break;

			//upload_credit_sold_now
			case 'upload_credit_sold_now':
			$result =$Actions->upload_credit_sold($_POST);
			if ($result) {
				echo $result;
			}
			break;

				//upload_credit_sold_now
			case 'remove_customer':
			$result =$Actions->delete_customer($_POST['cId']);
			if ($result) {
				echo $result;
			}
			break;
			
			//assign_meter_to_staff
			case 'assign_meter_to_staff':
			$result =$Actions->assign_to_duty_pump($_POST);
			if ($result) {
				echo $result;
			}
			break;

			case 'fetch_allo_by_Id':
			$result =$Actions->get_all_allocationById($_POST);
			if ($result) {
			echo $result;
			}
			break;
			//submit_sales_details
			case 'submit_sales_detail':
			$result =$Actions->submit_sales_details($_POST);
			if ($result) {
			echo $result;
			}
			break;

			//show current fuel type
			case 'show_litre_price':
			$result =$Actions->show_fuel_price_byId($_POST['id']);
			if ($result) {
				echo $result;
			}
			break;

			//show current fuel type
			case 'fetch_price_now':
			$result =$Actions->fetch_fuel_price_byId($_POST['fuelId']);
			if ($result) {
				echo $result;
			}
			break;
			//save_money_now
			case 'save_money_now':
			$result =$Actions->bank_saving($_POST);
			if ($result) {
				echo $result;
			}
			break;
			//update pump 
			case 'update_pump_now':
			$result =$Actions->update_pump($_POST);
			if ($result) {
				echo $result;
			}
			break;

			//update pump 
			case 'update_staff_now':
			$result =$Actions->update_staff_details($_POST);
			if ($result) {
				echo $result;
			}
			break;

			//update pump 
			case 'show_edit_staff_form':
			$result =$Actions->get_staff_by_id($_POST['staff_id']);
			if ($result) {
				echo '<div class="col-md-6">
                                    <div class="form-group">
                                        <label for="post">Designation <span class="fas fa-briefcase"></span></label>
                                         <select name="office" id="post" class="custom-select">
                                         	<option value="">Choose...</option>
                                        	<option value="'.$result->designation.'" selected>'.$result->designation.'</option>
                                        	<option value="Manager">Manager</option>
                                        	<option value="Attendant">Attendant</option>
                                        	<option value="Messenger">Messenger</option>
                                        	<option value="Security">Security</option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                     <input type="hidden" name="staff_id" id="staff_id" value="'.$result->staff_id.'">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="fullname">Fullname <span class="fas fa-user-secret"></span></label>
                                        <input type="text" name="staff_name" class="form-control" id="fullname" value="'.$result->full_name.'">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label>Phone Number <span class="fas fa-phone"></span></label>
                                        <input type="text" class="form-control" name="staff_phone" value="'.$result->phone.'">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label for="email">Email <span class="fas fa-envelope-open"></span></label>
                                        <input type="text" name="staff_email" class="form-control" id="email" value="'.$result->email.'">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    	<!-- fas fa-thermometer-half -->
                                        <label >Address <span class="fas fa-map-marker-alt"></span></label>
                                        <textarea name="staff_address"  class="form-control">'.$result->address.'</textarea>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                      <label for=""><span class="text-c-red"> Qualification <i class="fas fa-graduation-cap"></i></span></label>
                                       <select name="education" class="custom-select">
                                        	<option>Phd Holder</option>
                                        	<option selected>'.$result->qualification.'</option>
                                        	<option>BSc Holder</option>
                                        	<option>Degree Holder</option>
                                        	<option>HND Holder</option>
                                        	<option>OND Holder</option>
                                        	<option>NCE Holder</option>
                                        	<option>WASSCE Holder</option>
                                        	<option>PRY SCHOOL CERT</option>
                                        </select>
                                    </div>
                                </div>';
			}
			break;

			//create new staff 
			case 'create_staff_now':
			$result =$Actions->register_staff($_POST);
			if ($result) {
				echo $result;
			}
			break;

			//create_fuel_now
			case 'create_fuel_now':
			$result =$Actions->create_fuel($_POST);
			if ($result) {
				echo $result;
			}
			break;

			case 'show_pump_update':
			$result =$Actions->fetch_pump_byId($_POST['pump_id']);
			if ($result) {
				echo '<div class="col-md-6">
                                    <input type="hidden" name="action" value="update_pump_now">
                                   <input type="hidden" name="pump_id" value="'.$result->pumpId.'">
                                   <input type="hidden" name="fid" value="'.$result->fuel.'">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="pump_name">Pump Desc <span class="fas fa-gas-pump"></span></label>
                                        <input type="text" class="form-control" name="pump_desc" value="'.$result->pump_desc.'">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="fied">Fuel Type <span class="fas fa-user-plus"></span></label>
                                        <select name="fied" id="fied" class="custom-select" disabled>
                                            <option value="">Choose...</option>
                                            <option value="'.$result->fuel_type.'" selected>'.$result->fuel_type.'</option>
                                           '.$Actions->fuel_in_dropdown().'
                                        </select>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="status">Pump Status <span class="fas fa-user-plus"></span></label>
                                        <select name="status" id="status" class="custom-select">
                                            <option value="">Choose...</option>
                                            <option value="'.$result->status.'" selected>'.$result->status.'</option>
                                            <option value="active">Active</option>
                                            <option value="pending">Pending</option>
                                            <option value="faulty">Faulty</option>
                                            <option value="damaged">Damaged</option>
                                        </select>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <!-- fas fa-thermometer-half -->
                                        <label for="code">Pump Code <span class="fas fa-diagnoses"></span></label>
                                        <input type="text" class="form-control" name="code" value="'.$result->pcode.'">
                                    </div>
                                </div>';
			}
			break;
		
		default:
			// code...
			break;
	}
}
