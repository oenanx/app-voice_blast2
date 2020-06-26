<style>
.modal-dialog {
	width: 100%;
	height: 100%;
	padding: auto;
	margin: auto;
}
.modal-content {
	height: 100%;
    overflow-y: scroll;
	border-radius: 10px;
	color:#333;
	overflow: auto;
}
</style>
<div id="layoutSidenav_content">
	<main>
		<!--<div class="col-md-10">-->
			<div class="card card-danger" style="width:100%;">
				<div class="card-header with-border">
					<h3 class="card-title" style="color:gray"><i class="fas fa-edit" data-card-widget="collapse"></i> Input Master Customer</h3>
				</div>
		   
				<div class="card-body" style="width:100%; display: none;" align="justify">
					<div style="color:red">
						<?php if(isset($error)){print $error;}?>
					</div>
					<form action="#" id="form1">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Customer Name *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="cpy_name" name="cpy_name" required placeholder="Nama Perusahaan *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Phone / Fax. *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="ph_fax" name="ph_fax" required placeholder="Telephone / Fax *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Customer Email *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="cpy_email" name="cpy_email" required placeholder="Email Perusahaan *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Billing Email *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="bill_email" name="bill_email" required placeholder="Email Billing *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Customer Address *</label>
									<textarea id="addr" name="addr" class="form-control form-control-sm" placeholder="Alamat Perusahaan" required rows="3" maxlength="800" style="resize: none;"></textarea>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Billing Address *</label>
									<textarea id="addr_bill" name="addr_bill" class="form-control form-control-sm" placeholder="Alamat Pembillingan" required rows="3" maxlength="800" style="resize: none;"></textarea>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Start Date *</label>
									<input type="text" style="font-size:10pt;" id="startdate" name="startdate" class="form-control form-control-sm datetimepicker" required placeholder="(yyyy-mm-dd HH:mm:ss)" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 date">
								<div class="form-group">
									<label>End Date *</label>
									<input type="text" style="font-size:10pt;" id="enddate" name="enddate" class="form-control form-control-sm datetimepicker" required placeholder="(yyyy-mm-dd HH:mm:ss)" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Select Product API *</label>
									<select name="api_id" id="api_id" class="form-control form-control-sm" required placeholder="Pilih Product API *">
										<option value="">Select One...</option>
										<?php foreach($product->result() as $rowproduct):?>
											<option value="<?php echo $rowproduct->id;?>"><?php echo $rowproduct->title;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Select Sender No. *</label>
									<select name="senderno" id="senderno" class="form-control form-control-sm" required placeholder="Pilih Sender No. *">
										<option value="">Select One...</option>
										<?php foreach($sender->result() as $rowsender):?>
											<option value="<?php echo $rowsender->id;?>"><?php echo $rowsender->senderno;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Capacity Count Current *</label>
									<input type="number" class="form-control form-control-sm" width="100%" id="capacity" name="capacity" required placeholder="Kapasitas count current *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Notes</label>
									<textarea id="notes" name="notes" class="form-control form-control-sm" placeholder="Info Tambahan" rows="3" maxlength="800" style="resize: none;"></textarea>
								</div>
							</div>
						</div>
						<br />
					</form>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-sm" onclick="save()" id="Simpan">Save</button>&nbsp;
							<a href="<?=base_url('index.php/M_Company/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">Cancel</button></a>
						</div>
					</div>
				</div>
			</div>	
			<br />	
			<div class="card card-danger" style="width:100%;">
				<div id="notif" style="display: none;"></div>
				<div class="card-header with-border">
					<h3 class="card-title" style="color:gray"><i class="fa fa-th-list"></i> List of Customer</h3>
				</div>

				<div class="table table-bordered table-hover" style="background:#eeeeee;">
					<table class="display" id="Show-Tables" width="100%" style="width:100%;font-size:10pt;">
						<thead align="center">
							<tr>
								<!--<th style="width: 5%;"><center>No.</center></th>-->
								<th style="width: 20%;"><center>Registration #</center></th>
								<th style="width: 30%;"><center>Customer Name</center></th>
								<th style="width: 20%;"><center>Phone / Fax</center></th>
								<th style="width: 15%;"><center>Count Current</center></th>
								<th style="width: 10%;"><center>Status</center></th>
								<th style="width: 5%;"><center> Action </center></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		<!--</div>-->
	</main>

<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg wrapper">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title"><b>View Detail Customer</b></h2>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
						<table style="width:100%; font-size:12pt;" border="0">
							<!--<tr style="padding: 2px; font-size:14pt;">
								<th align="left" style="width:25%; height: auto;">Company Information</th>
								<th align="left" style="width:3%; height: auto;"></th>
								<th align="left" style="width:72%; height: auto;"></th>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Registration No. </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="regis1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Customer Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="cpy_name1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Phone / Fax. </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="phone1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Customer Address </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="cpy_addr1" rows="2" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Billing Address </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="bill_addr1" rows="2" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Customer Email </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="cpy_email1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Billing Email </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="bill_email1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Sender No. </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="send1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Product API </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="api1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Start Date </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="startdate1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> End Date </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="enddate1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Count Current </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="current1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Notes </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="notes1" rows="2" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Status </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="status1" readonly /></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="card-footer" align="right">
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>
	
<div id="view-modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg wrapper">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title"><b>Edit Detail Customer</b></h2>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
					<form action="#" id="form2">
						<table style="width:100%; font-size:12pt;" border="0">
							<!--<tr style="padding: 2px; font-size:14pt;">
								<th align="left" style="width:25%; height: auto;">Company Information</th>
								<th align="left" style="width:3%; height: auto;"></th>
								<th align="left" style="width:72%; height: auto;"></th>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Customer Name * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="hidden" class="form-control form-control-sm" name="id2" readonly /><input type="text" class="form-control form-control-sm" name="cpy_name2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Phone / Fax. * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="phone2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Cust. Address * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="cpy_addr2" rows="2" required style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Billing Address * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="bill_addr2" rows="2" required style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Customer Email * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="cpy_email2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Billing Email * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="bill_email2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Start Date * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm datetimepicker" name="startdate2" required placeholder="(yyyy-mm-dd HH:mm:ss)" /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> End Date * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm datetimepicker" name="enddate2" required placeholder="(yyyy-mm-dd HH:mm:ss)" /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Notes </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="notes2" rows="2" style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Product API * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> 
									<select name="api_id2" id="api_id22" class="form-control form-control-sm" required placeholder="Pilih Product API *">
										<option value="">Select One...</option>
										<?php foreach($product->result() as $rowproduct):?>
											<option value="<?php echo $rowproduct->id;?>"><?php echo $rowproduct->title;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Sender Number * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> 
									<select name="senderno2" id="senderno2" class="form-control form-control-sm" required placeholder="Pilih Sender No. *">
										<option value="">Select One...</option>
										<?php foreach($sender->result() as $rowsender):?>
											<option value="<?php echo $rowsender->id;?>"><?php echo $rowsender->senderno;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Count Current * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="number" class="form-control form-control-sm" name="current2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Status * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> 
									<select id="status2" name="status2" class="form-control form-control-sm" required placeholder="Actived / Inactived) ?">
										<option value="">Select One...</option>
										<option value="1">ACTIVE</option>
										<option value="0">INACTIVE</option>
									</select>
								</td>
							</tr>
						</table>
					</form>
					</div>
				</div>
				<div class="card-footer" align="right">
					<button type="submit" class="btn btn-primary btn-sm" onclick="update()" id="Edit">Update</button>&nbsp;
					<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<link href="<?=base_url('assets/dist/css/bootstrap-datetimepicker.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/dist/css/propeller.css')?>" rel="stylesheet">

<script type="text/javascript" src="<?=base_url('assets/dist/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/dist/js/propeller.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/dist/js/moment-with-locales.js')?>" language="javascript"></script>
<script type="text/javascript" src="<?=base_url('assets/dist/js/bootstrap-datetimepicker.js')?>" language="javascript"></script>
<script type="text/javascript" class="init">
var dataTable;
/*
$(function () {
	$('#startdate').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss', ignoreReadonly: true});
	$('#enddate').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss', ignoreReadonly: true});
});
*/
$(document).ready(function() 
{
	$('body').on('focus','.datetimepicker', function(){
		$(this).datetimepicker({
			format: 'YYYY-MM-DD HH:mm:00', inline: true
		});
	});
	
/* 	$('#enddate').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss', ignoreReadonly: true});

	$('#startdate2').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss', ignoreReadonly: true});

	$('#enddate2').datetimepicker({format: 'YYYY-MM-DD HH:mm:ss', ignoreReadonly: true});
*/
	dataTable =  $('#Show-Tables').DataTable( 
	{
		"processing": true,
		"language": 
		{ 
			"processing": "Mohon tunggu sebentar sedang memproses data..."
		},
		"serverSide": true,
		"ordering": false, 
		"pagingType": "simple_numbers",
		"ajax": {
			"url": "<?php echo site_url('M_Company/dtTables')?>",
			"type": "POST",
			"data": function ( data ) {}     
		},
		"columnDefs": 
		[
			//{ 
				//"targets": 0, //first column - No
				//"width": "5%",
				//"className": "text-center", //set alignment column to center
			//},
			{ 
				"targets": 0, //second column - Reg_no
				"orderable": true, //set orderable
				"width": "20%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 1, //second column - Company Name
				"orderable": true, //set orderable
				"width": "30%",
				"className": "text-left", //set alignment column to center
			},
			{ 
				"targets": 2, //third column - Phone / Fax
				"orderable": true, //set orderable
				"width": "20%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 3, //third column - Count Current
				"orderable": true, //set orderable
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 4, //fourth column - Status
				"orderable": true, //set orderable
				"width": "20%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 5, //fifth column - Action
				"width": "5%",
				"className": "text-center", //set alignment column to center
			}
		],
		"order": [[ 1, 'asc' ]]
		//"autoWidth": true
	});
});

function reload_table()
{
	dataTable.ajax.reload(null,false); //reload datatable ajax 
}
	
function view_company(id)
{
	$('.help-block').empty(); // clear error string
	//$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_Company/view_cpy/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="regis1"]').val(data.reg_no);

			$('[name="cpy_name1"]').val(data.company_name);

			$('[name="cpy_addr1"]').val(data.address);

			$('[name="bill_addr1"]').val(data.address_billing);

			$('[name="phone1"]').val(data.phone_fax);

			$('[name="cpy_email1"]').val(data.email_company);

			$('[name="bill_email1"]').val(data.email_billing);

			$('[name="send1"]').val(data.senderno);

			$('[name="api1"]').val(data.title);

			$('[name="notes1"]').val(data.notes);

			$('[name="startdate1"]').val(data.start_date);

			$('[name="enddate1"]').val(data.end_date);
			
			$('[name="current1"]').val(data.count_current);

			$('[name="status1"]').val(data.active);

			$('#view-modal').modal('show'); // show bootstrap modal when complete loaded
			//$('.modal-title').text('View Aset'); // Set title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
};

function del_company(id)
{
	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_Company/delete_cpy/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$("#notif").html('<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data sudah dihapus !</h4></div>').show();
			reload_table();
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data gagal dihapus, ada kesalahan... !!!</h4></div>').show();
			reload_table();
		}
	});
};

function edit_company(id)
{
    $('.help-block').empty(); // clear error string
    //$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('M_Company/view_cpy/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id2"]').val(data.id);

			$('[name="cpy_name2"]').val(data.company_name);

			$('[name="cpy_addr2"]').val(data.address);

			$('[name="bill_addr2"]').val(data.address_billing);

			$('[name="phone2"]').val(data.phone_fax);

			$('[name="cpy_email2"]').val(data.email_company);

			$('[name="bill_email2"]').val(data.email_billing);

			$('[name="notes2"]').val(data.notes);

			$('[name="startdate2"]').val(data.start_date);

			$('[name="enddate2"]').val(data.end_date);

			$('[name="senderno2"]').val(data.senderno_id);

			$('[name="api_id2"]').val(data.api_id);

			$('[name="current2"]').val(data.count_current);

			$('[name="status2"]').val(data.factive);

            $('#view-modal-edit').modal('show'); // show bootstrap modal when complete loaded
            //$('.modal-title').text('Edit Aset'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });	
};

function update()
{
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    var url;

    url = "<?php echo site_url('M_Company/update_cpy')?>";
	$.ajax({
		url : url,
		type: "POST",
		data: $('#form2').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$("#notif").html('<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data berhasil di ubah !</h4></div>').show();
				$('#view-modal-edit').modal('hide');
				reload_table();
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data gagal diubah, ada kesalahan... !!!</h4></div>').show();
			reload_table();
			//alert('Error Update data from ajax');
		}
	});
}

function save()
{
    $.ajax(
	{
        url : "<?php echo site_url('M_Company/ins_cpy')?>",
        type: "POST",
        data: $('#form1').serialize(),
        dataType: "JSON",
        success: function(data)
        {
			if(data.status) //if success close modal and reload ajax table
            {
                $("#notif").html('<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Data Berhasil di simpan !</h6></div>').show();
                $('#form1')[0].reset();
                reload_table();
            }

           	if(data.status_data_sama == false) //if success close modal and reload ajax table
            {
                reload_table();
            	$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon ti-close"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Data Perusahaan Sudah Ada... !</h6></div>').show();
            }
           	if(data.status == false)
		    { 
		    	
	           	for (var i = 0; i < data.inputerror.length; i++) 
	            {
	                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
	                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
	            }
	        }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
			reload_table();
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Data gagal disimpan, cek kembali... !!!</h6></div>').show();

			return false;
		}
	});
}

</script>

