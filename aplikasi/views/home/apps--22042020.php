<style>
.modal-dialog {
	width: 1024px;
	height: 100%;
	margin: auto;
}
.modal-content {
	width: auto;
	height: auto;
	color:#333;
	overflow: auto;
}
.tinggi { font-size:10px; line-height: 5px;}

.btn.btn-danger.btn-sm1 {
	width: 35px;
	height: 35px;
}
</style>

<div class="col-md-10">
	<div class="card card-danger" style="width:100%;">		
		<div class="card-header with-border">
			<h3 class="card-title" style="color:red"><i class="fas fa-edit" data-card-widget="collapse"></i> Form Campaign</h3> 
		</div><!-- /.card-header -->	
		<div class="card-body" style="width:100%; display: none;" align="justify">
			<div class="container" align="justify">
				<!--<form method="POST" action="< ?php echo base_url() ?>index.php/Upl_Message/upload" enctype="multipart/form-data">-->
				<form id="form1" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Company Name *</label>
							<?php foreach($company->result() as $rowcompany):?>
								<input type="hidden" class="form-control form-control-sm" width="100%" id="company_id" name="company_id" readonly value="<?php echo $rowcompany->id;?>" placeholder="Nama Perusahaan *" /><input type="text" class="form-control form-control-sm" width="100%" id="companyid" name="companyid" readonly value="<?php echo $rowcompany->company_name;?>" placeholder="Nama Perusahaan *" />
							<?php endforeach;?>
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Product Name *</label>
							<select name="prod_id" id="prod_id" class="form-control form-control-sm" required placeholder="Pilih Product *">
								<option value="">Select One...</option>
								<?php foreach($product->result() as $rowproduct):?>
									<option value="<?php echo $rowproduct->id;?>"><?php echo $rowproduct->product_name;?></option>
								<?php endforeach;?>
							</select>
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Title *</label>
							<input type="text" class="form-control form-control-sm" width="100%" id="title" name="title" required placeholder="Nama Judul *" />
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Description</label>
							<textarea id="description" name="description" class="form-control form-control-sm" placeholder="Deskripsi" rows="2" maxlength="800" style="resize: none;"></textarea>
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Start Date *</label>
							<input data-date-format="YYYY-MM-DD" type="text" style="font-size:10pt;" id="startdate" name="startdate" class="form-control form-control-sm datepicker" readonly required placeholder="(yyyy-mm-dd)" />
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
					<div class="col-md-6 col-lg-6 date">
						<div class="form-group">
							<label>End Date *</label>
							<input data-date-format="YYYY-MM-DD" type="text" style="font-size:10pt;" id="endate" name="endate" class="form-control form-control-sm datepicker" readonly required placeholder="(yyyy-mm-dd)" />
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="form-group">
							<label>Template Message *</label>
							<textarea id="form_message" name="form_message" class="form-control form-control-sm" placeholder="Format Pesan Blast" required rows="3" maxlength="8000" style="resize: none;"></textarea>
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<h3 class="card-title" style="color:red"><i class="fa fa-clock"></i> Form Scheduler & Upload Batch File</h3>
			<div class="container" align="justify">
				<div class="row">
					<table id="myTable" class="table table-bordered" role="grid" style="width: 100%; font-size:9pt;">
						<thead>
							<tr>
								<!--<th width="5%"><center>Batch. </center></th>-->
								<th width="5%"><center> </center></th>
								<th width="15%"><center>Start Date *</center></th>
								<th width="15%"><center>End date *</center></th>
								<th width="15%"><center>Start Time *</center></th>
								<th width="15%"><center>End Time *</center></th>
								<th width="15%"><center>Active / Inactive *</center></th>
								<th width="15%"><center>Upload File *</center></th>
								<th width="5%"><center></center></th>
							</tr>
						</thead>
						<tbody id="isi">

						</tbody>
					</table>
					<button id="addrow" type="button" class="btn btn-primary btn-sm btn-outline-primary btn-block"> [ + ] Add Batch</button>
					<!--</form>-->
				</div>
				<!--</form>-->
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<p id="msg"></p>
        				
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<button  id="preview" class="btn btn-warning btn-sm btn-outline-primary">PREVIEW</button>&nbsp;
					</div>
				</div>
				<br />
				<div id="tablesX" class="table table-bordered table-hover" style="width:100%;">
					<table id="myTable1" class="table table-bordered" role="grid" style="width: 100%; font-size:9pt;">
						<thead>
							<tr>
								<th width="5%"><center>Id.</center></th>
								<th width="15%"><center>Phone</center></th>
								<th width="80%"><center>Template</center></th>
							</tr>
						</thead>
						<tbody id="isi">

						</tbody>
					</table>
				</div>
				<br />
				<div class="row">
					<div class="col-md-12 col-lg-12">
					<!--<input type="submit" name="import" value="Import" class="btn btn-info btn-sm" />&nbsp;-->
					<!--<button type="button" class="btn btn-primary btn-sm" onclick="save()">Save</button>&nbsp;-->
						<button  id="upload" class="btn btn-info btn-sm btn-outline-primary">UPLOAD</button>&nbsp;
						<a href="<?=base_url('index.php/Upl_Message/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">CANCEL</button></a>
					</div>
				</div>
			</div>
		</div>		
	</div>	
	<br />
	<div id="notif"><?php echo $this->session->flashdata('notif') ?></div>
	
	<div class="card card-danger" style="width:100%;">
		<div class="card-header with-border">
			<h3 class="card-title" style="color:red"><i class="fa fa-th-list"></i> View List Campaign</h3>
		</div>
	
		<div class="table table-bordered table-hover" style="width:100%;background:#eeeeee;">
			<table class="cell-border compact hover" id="Show-Tables" width="100%" style="width:100%;font-size:10pt;word-break: break-all;">
				<thead align="center">
					<tr>
						<!--<th style="width: 10%;"><center>No.</center></th>-->
						<th style="width: 15%;"><center>Company</center></th>
						<th style="width: 15%;"><center>Product</center></th>
						<th style="width: 15%;"><center>Title</center></th> 
						<th style="width: 25%;"><center>Format Message</center></th> 
						<th style="width: 10%;"><center>Status</center></th> 
						<th style="width: 10%;"><center> Action </center></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title"><b>View Detail Campaign</b></h2>
				</div>
				<div class="card-body collapsed-card">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
						<table style="width:100%; font-size:10pt;" border="0">
							<!--<tr style="padding: 2px; font-size:14pt;">
								<th align="left" style="width:25%; height: auto;">Header Information</th>
								<th align="left" style="width:3%; height: auto;"></th>
								<th align="left" style="width:72%; height: auto;"></th>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Company Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="cname1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Product Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="pname1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Title </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="title1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Format Message </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="fmsg1" rows="3" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Description </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="desc1" rows="2" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Start Date </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="start_date1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> End Date </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="end_date1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Status </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="status1" readonly /></td>
							</tr>
						</table>
					
						<br />
						<table id="sch" class="table order-list tinggi" style="width:100%; font-size:10pt;">
							<thead align="center" style="background:#ffffbb;">
								<tr valign="middle">
									<th style="width:14%;"><center>Batch No.</center></th>
									<th style="width:14%;"><center>Start Date</center></th>
									<th style="width:14%;"><center>End Date</center></th>
									<th style="width:14%;"><center>Start Time</center></th>
									<th style="width:14%;"><center>End Time</center></th>
									<th style="width:14%;"><center>Active</center></th>
									<th style="width:14%;"><center>Data Count</center></th>
								</tr>
							</thead>
							<tbody>
								<tr valign="middle">
									<!--
									<td style="width:25%;"><center><input type="text" class="form-control form-control-sm" name="batchid" readonly /></center></td>
									<td style="width:25%;"><center><input type="text" class="form-control form-control-sm" name="start_datetime" readonly /></center></td>
									<td style="width:25%;"><center><input type="text" class="form-control form-control-sm"  name="end_datetime" readonly /></center></td>
									<td style="width:25%;"><center><input type="text" class="form-control form-control-sm" name="active" readonly /></center></td>
									-->
								</tr>
							</tbody>
						</table>
						<!--
						<br />
						<table id="dtl" class="table order-list tinggi" style="width:100%; font-size:10pt;">
							<thead align="center" style="background:#ffffbb;">
								<tr height="5px" valign="middle" style="height:5px;">
									<th style="width:25%;"><center>Phone</center></th>
									<th style="width:25%;"><center>Name</center></th>
									<th style="width:25%;"><center>Overdue</center></th>
									<th style="width:25%;"><center>Amount</center></th>
								</tr>
							</thead>
							<tbody>
								<tr valign="middle">
								</tr>
							</tbody>
						</table>
						-->
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title"><b>Edit Detail Campaign</b></h2>
				</div>
				<form action="#" id="form2">
					<div class="card-body collapsed-card">
						<div id="modal-loader" style="display: none; text-align: center;">
							<img src="<?=base_url('images/ajax-loader.gif')?>">
						</div>
						<div class="card-body" align="justify">
							<table style="width:100%; font-size:10pt;" border="0">
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> Company Name </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> <input type="hidden" class="form-control form-control-sm" name="id2" required /><input type="text" class="form-control form-control-sm" name="cname2" required /></td>
								</tr>
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> Product Name </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="pname2" required /></td>
								</tr>
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> Title </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="title2" required /></td>
								</tr>
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> Template Message </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="fmsg2" rows="2" required style="resize: none;"></textarea></td>
								</tr>
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> Description </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="desc2" rows="2" style="resize: none;"></textarea></td>
								</tr>
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> Start Date </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> <input type="text" style="font-size:10pt;" id="start_date2" name="start_date2" class="form-control form-control-sm datepicker" readonly required placeholder="(yyyy-mm-dd)" /></td>
								</tr>
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> End Date </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> <input type="text" style="font-size:10pt;" id="end_date2" name="end_date2" class="form-control form-control-sm datepicker" readonly required placeholder="(yyyy-mm-dd)" /></td>
								</tr>
								<tr style="line-height: 1.0;">
									<td align="left" style="width:20%;"> Status </td>
									<td align="center" style="width:3%;">:</td>
									<td align="left" style="width:77%;"> 
										<select id="status2" name="status2" class="form-control form-control-sm" required placeholder="Actived / Inactived) ?">
											<option value="">Select One...</option>
											<option value="0">OPEN</option>
											<option value="1">START</option>
											<option value="2">COMPLETE</option>
											<option value="3">CANCELED</option>
										</select>
									</td>
								</tr>
							</table>
						
							<br />
							<table id="sch2" class="table order-list tinggi" style="width:100%; font-size:10pt;">
								<thead align="center" style="background:#ffffbb;">
									<tr height="5px" valign="middle" style="height:5px;">
										<th style="width:14%;"><center>Batch No.</center></th>
										<th style="width:14%;"><center>Start Date</center></th>
										<th style="width:14%;"><center>End Date</center></th>
										<th style="width:14%;"><center>Start Time</center></th>
										<th style="width:14%;"><center>End Time</center></th>
										<th style="width:14%;"><center>Active</center></th>
									</tr>
								</thead>
								<tbody>
									<tr height="5px" valign="middle" style="height:5px;">
										<!--
										<td style="width:25%;"><center><input type="text" class="form-control form-control-sm" name="batchid" readonly /></center></td>
										<td style="width:25%;"><center><input type="text" class="form-control form-control-sm" name="start_datetime" readonly /></center></td>
										<td style="width:25%;"><center><input type="text" class="form-control form-control-sm"  name="end_datetime" readonly /></center></td>
										<td style="width:25%;"><center><input type="text" class="form-control form-control-sm" name="active" readonly /></center></td>
										-->
									</tr>
								</tbody>
							</table>
							<!--<br />
							<table id="dtl2" class="table order-list tinggi" style="width:100%; font-size:10pt;">
								<thead align="center" style="background:#ffffbb;">
									<tr height="5px" valign="middle" style="height:5px;">
										<th style="width:25%;"><center>Phone</center></th>
										<th style="width:25%;"><center>Name</center></th>
										<th style="width:25%;"><center>Overdue</center></th>
										<th style="width:25%;"><center>Amount</center></th>
									</tr>
								</thead>
								<tbody>
									<tr valign="middle">
									</tr>
								</tbody>
							</table>
							-->
						</div>
					</div>
				
					<div class="card-footer" align="right">
						<button type="submit" class="btn btn-primary btn-sm" onclick="update()" id="Edit">Update</button>&nbsp;
						<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<link href="<?=base_url('assets/dist/css/bootstrap-datetimepicker.css')?>" rel="stylesheet">
<link href="<?=base_url('assets/dist/css/propeller.css')?>" rel="stylesheet">

<script type="text/javascript" src="<?=base_url('assets/dist/js/jquery.dataTables.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/dist/js/propeller.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/dist/js/moment.js')?>" language="javascript"></script>
<!--<script type="text/javascript" src="< ?=base_url('assets/dist/js/moment-with-locales.js')?>" language="javascript"></script>-->
<script type="text/javascript" src="<?=base_url('assets/dist/js/bootstrap-datetimepicker.js')?>" language="javascript"></script>
<script type="text/javascript" class="init">
var dataTable;
var dataTable1;
$(document).ready(function()
{
	var i = 1;
    $("#addrow").on("click", function () 
	{
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><center><div class="border-checkbox-group border-checkbox-group-default"><input class="border-checkbox" type="checkbox" id="checkbox" name="checkbox[]" /></div></center></td>';

        cols += '<td><input type="text" data-date-format="YYYY-MM-DD" style="font-size:10pt;" id="start_date'+i+'" name="start_date['+i+']" class="form-control form-control-sm datepicker1" required placeholder="(yyyy-mm-dd)" /><span class="help-block" style="color:red;"></span></td>';

        cols += '<td><input type="text" data-date-format="YYYY-MM-DD" style="font-size:10pt;" id="end_date'+i+'" name="end_date['+i+']" class="form-control form-control-sm datepicker2" required placeholder="(yyyy-mm-dd)" /><span class="help-block" style="color:red;"></span></td>';

        cols += '<td><input type="text" style="font-size:10pt;" id="starttime'+i+'" name="starttime['+i+']" class="form-control form-control-sm timepicker" required placeholder="(HH:mm:ss)" /><span class="help-block" style="color:red;"></span></td>';

        cols += '<td><input type="text" style="font-size:10pt;" id="endtime'+i+'" name="endtime['+i+']" class="form-control form-control-sm timepicker" required placeholder="(HH:mm:ss)" /><span class="help-block" style="color:red;"></span></td>';
        
		cols += '<td><select id="status1'+i+'" name="status1['+i+']" class="form-control form-control-sm" required placeholder="Actived / Inactived) ?"><option value="">Select One...</option><option value="1">ACTIVE</option><option value="0">INACTIVE</option></select><span class="help-block" style="color:red;"></span></td>';
        
		cols += '<td><input type="file" id="userfile'+i+'" name="userfile['+i+']" class="form-control-sm" required accept=".xls, .xlsx" placeholder="Jenis Dokumen .xls atau .xlsx " /><span class="help-block" style="color:red;"></span></td>';

		//cols += '<td><input type="file" id="userfile" name="userfile" class="form-control-sm" required accept=".xls, .xlsx" placeholder="Jenis Dokumen .xls atau .xlsx " /><span class="help-block" style="color:red;"></span></td>';

        cols += '<td><center><button id="ibtnDel" class="btn btn-danger btn-outline-danger btn-sm1"><i class="fa fa-trash"></i> </button></center></td>';
        newRow.append(cols);
        $("#myTable").append(newRow);
        
        //$('#myTable').append($('#myTable').find("tr:last").clone());
		i++;
    });

    $("#myTable").on("click", "#ibtnDel", function (event) 
	{
        $(this).closest("tr").remove();       
        i -= 1
    });

	$('body').on('focus','.datepicker1', function()
	{
		$(this).datepicker({
			dateFormat: 'yy-mm-dd', yearRange: '1990:2100', ignoreReadonly: true, minDate: $('#startdate').val(), maxDate: $('#endate').val()
		});
	});

	$('body').on('focus','.datepicker2', function()
	{
		$(this).datepicker({
			dateFormat: 'yy-mm-dd', yearRange: '1990:2100', ignoreReadonly: true, minDate: $('#startdate').val(), maxDate: $('#endate').val()
		});
	});

	$('body').on('focus','.datepicker3', function()
	{
		$(this).datepicker({
			dateFormat: 'yy-mm-dd', yearRange: '1990:2100', ignoreReadonly: true, minDate: $('#start_date2').val(), maxDate: $('#end_date2').val()
		});
	});

	$('body').on('focus','.datepicker4', function()
	{
		$(this).datepicker({
			dateFormat: 'yy-mm-dd', yearRange: '1990:2100', ignoreReadonly: true, minDate: $('#start_date2').val(), maxDate: $('#end_date2').val()
		});
	});

	$('body').on('focus','.datepicker', function()
	{
		//$(this).removeClass("hasDatepicker");
		$(this).datepicker({
			dateFormat: 'yy-mm-dd', yearRange: '1990:2100', ignoreReadonly: true
		});
	});

	$('body').on('focus','.timepicker', function()
	{
		$(this).datetimepicker({
			format: 'HH:mm:ss', inline: true,
		});
	});

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
			"url": "<?php echo site_url('Upl_Message/dtTables')?>",
			"type": "POST",
			"data": function ( data ) {}     
		},
		"columnDefs": 
		[
			//{ 
				//"targets": 0, //first column - No
				//"width": "10%",
				//"className": "text-center", //set alignment column to center
			//},
			{ 
				"targets": 0, //second column - Company Name
				"orderable": true, //set orderable
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 1, //third column - Product Name
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 2, //fourth column - Title
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 3, //fifth column - Format Message
				"width": "25%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 4, //fifth column - Status
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 5, //fifth column - Action
				"width": "10%",
				"className": "text-center", //set alignment column to center
			}
		],
		"order": [[ 1, 'asc' ]],
		"autoWidth": true
	});
});

$('#preview').on('click', function()
{
	var Checked = $('input[name="checkbox[]"]:checked').length;
	if(Checked > 0)
	{ //jika checked lebih besar dari 0
		var myObj_d = [];
		var i = 1;
		var form_Data = new FormData();
		var form_message = $('#form_message').val();
		form_Data.append('form_message', form_message);

		$('input[name="checkbox[]"]:checked').each(function(index,obj)
		{
			//alert(i);
			var ins = $('#userfile'+i).prop('files').length;
			var id = $(obj).val();
		
			for(var a=0; a< ins; a++)
			{	
			var file_data = $('#userfile'+i).prop('files')[a];
			form_Data.append('file[]', file_data);
			}
			i++;
		});

		$.ajax(
		{
			url: '<?php echo site_url('Upl_Message/preview')?>', // point to server-side controller method
			cache: false,
			contentType: false,
			processData: false,
			data: form_Data,
			type: 'post',
			dataType: "JSON",
			success: function(response) 
			{	
				//alert(response);
				//var html = '<option value="">Select Batch No.</option>';
				var z;
				for(z = 0; z < response.length; z++)
				{
					//html += '<option value='+data[i].batchid+'>'+data[i].batchid+'</option>';
					var newRow = $("<tr>");
					var cols = "";

					cols += '<td>'+response[z]['id']+'</td>';

					cols += '<td>'+response[z]['phone']+'</td>';

					cols += '<td>'+response[z]['template']+'</td>';

					newRow.append(cols);
					$("#myTable1").append(newRow);
				}
			}
		});
		return false;		
	}
	else
	{
		alert('Tidak ada item yang di pilih');
	}
});


$(document).ready(function (e) 
{
    $('#upload').on('click', function () 
	{
    	var Checked = $('input[name="checkbox[]"]:checked').length;
        if(Checked > 0)
		{ //jika checked lebih besar dari 0
			var myObj_d = [];
			var i = 1;
			var form_Data = new FormData();
			var company_id = $('#company_id').val();
			var prod_id = $('#prod_id').val();
			var title = $('#title').val();
			var form_message = $('#form_message').val();
			var startdate = $('#startdate').val();
			var endate = $('#endate').val();
			var description = $('#description').val();
			form_Data.append('company_id', company_id);
			form_Data.append('prod_id', prod_id);
			form_Data.append('title', title);
			form_Data.append('form_message', form_message);
			form_Data.append('startdate', startdate);
			form_Data.append('endate', endate);
			form_Data.append('description', description);

			//var files = $("#upload-file")[0].files;
			$('input[name="checkbox[]"]:checked').each(function(index,obj)
			{
				//alert(i);
		        var ins = $('#userfile'+i).prop('files').length;
		        var id = $(obj).val();
			

				for(var a=0; a< ins; a++)
		    	{	
		    	//var portfolio_values = document.getElementById('fileupload').files[i];
		    	var file_data = $('#userfile'+i).prop('files')[a];
				form_Data.append('file[]', file_data);
				var start_date = $('input[name="start_date['+i+']"]').val();
				var end_date = $('input[name="end_date['+i+']"]').val();
				var starttime = $('input[name="starttime['+i+']"]').val();
				var endtime = $('input[name="endtime['+i+']"]').val();
				var status1 = $('select[name="status1['+i+']"]').val();
				form_Data.append('start_date[]', start_date);
				form_Data.append('end_date[]', end_date);
				form_Data.append('starttime[]', starttime);
				form_Data.append('endtime[]', endtime);
				form_Data.append('status1[]', status1);
				}
		        //var file_data = $('#userfile'+i).prop('files')[0];
		        ////alert(file_data.length);
		        //var form_data = new FormData();
		        
		       // form_Data.append('file[]', file_data);
		        i++;
		    });
	        $.ajax(
			{
	            url: '<?php echo site_url('Upl_Message/upload')?>', // point to server-side controller method
	            dataType: 'text', // what to expect back from the server
	            cache: false,
	            contentType: false,
	            processData: false,
	            data: form_Data,
	            type: 'post',
	            dataType: "JSON",
	            success: function (response) 
				{
	                if(response.status) //if success close modal and reload ajax table
					{
						$("#notif").html('<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Data Berhasil di simpan !</h6></div>').show();
						$('#form1')[0].reset();
						reload_table();
					}
	            },
	            error: function (response) 
				{
	                reload_table();
					$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Data gagal disimpan, cek kembali... !!!</h6></div>').show();

					return false;
	            }
	        });
	    }
	    else
		{
			alert('Tidak ada item yang di pilih');
		}
    });
});


function reload_table()
{
	dataTable.ajax.reload(null,false); //reload datatable ajax 
}
	
function view_trx(id)
{
	$('.help-block').empty(); // clear error string
	//$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('Upl_Message/view_trx/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="cname1"]').val(data.company_name);

			$('[name="pname1"]').val(data.product_name);

			$('[name="title1"]').val(data.title);

			$('[name="fmsg1"]').val(data.format_message);

			$('[name="desc1"]').val(data.description);

			$('[name="start_date1"]').val(data.start_date);

			$('[name="end_date1"]').val(data.end_date);

			$('[name="status1"]').val(data.status_name);

			$("#sch tbody tr").remove();
			$.ajax(
			{
				url : "<?php echo site_url('Upl_Message/view_trx_sch/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data2)
				{
					//alert(data.length);
					var trHTML = '';
					for(var j = 0; j < data2.length;  j++ ) 
					{
						trHTML += 
							'<tr>'+
							//'<td align="center"></td>' + 
							
							'<td style="width:14%;" align="center">' + data2[j].batchid + '</td>' + 
							
							'<td style="width:14%;" align="center">' + data2[j].startdate + '</td>' + 
							
							'<td style="width:14%;" align="center">' + data2[j].enddate + '</td>' + 
							
							'<td style="width:14%;" align="center">' + data2[j].start_datetime + '</td>' + 
							
							'<td style="width:14%;" align="center">' + data2[j].end_datetime + '</td>' + 
							
							'<td style="width:14%;" align="center">' + data2[j].active + '</td>' + 
							
							'<td style="width:14%;" align="center">' + data2[j].jml_data + '</td>' + 

							'</tr>';
					}
					$('#sch').append(trHTML);
				},
			})

			$("#dtl tbody tr").remove();
			$.ajax(
			{
				url : "<?php echo site_url('Upl_Message/view_trx_dtl/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data1)
				{
					//alert(data.length);
					var trHTML = '';
					for(var k = 0; k < data1.length;  k++ ) 
					{
						trHTML += 
							'<tr>'+
							//'<td align="center"></td>' + 
							
							'<td style="width:25%;" align="center">' + data1[k].phone + '</td>' + 
							
							'<td style="width:25%;" align="center">' + data1[k].name + '</td>' + 
							
							'<td style="width:25%;" align="center">' + data1[k].overdue + '</td>' + 
							
							'<td style="width:25%;" align="center">' + data1[k].amount + '</td>' + 
							
							'</tr>';
					}
					$('#dtl').append(trHTML);
				},
			})

			$('#view-modal').modal('show'); // show bootstrap modal when complete loaded
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
};

function del_trx(id)
{
	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('Upl_Message/delete_api/')?>" + id,
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

function edit_trx(id)
{
	$('.help-block').empty(); // clear error string
	//$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('Upl_Message/view_trx/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="id2"]').val(data.id);
			$('[name="cname2"]').val(data.company_name);
			$('[name="pname2"]').val(data.product_name);
			$('[name="title2"]').val(data.title);
			$('[name="fmsg2"]').val(data.format_message);
			$('[name="desc2"]').val(data.description);
			$('[name="start_date2"]').val(data.start_date);
			$('[name="end_date2"]').val(data.end_date);
			$('[name="status2"]').val(data.status_id);

			$("#sch2 tbody tr").remove();
			$.ajax(
			{
				url : "<?php echo site_url('Upl_Message/view_trx_sch/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data2)
				{
					//alert(data.length);
					var trHTML = '';
					for(var l = 0; l < data2.length;  l++ ) 
					{
						trHTML += 
							'<tr>'+
							//'<td align="center"></td>' + 
							
							'<td style="width:14%;" align="center"><input type="hidden" style="font-size:10pt;" id="batchid2" name="batchid2" class="form-control form-control-sm timepicker" required value="' + data2[l].batchid + '" />' + data2[l].batchid + '</td>' + 
							
							'<td style="width:14%;" align="center"><input type="text" style="font-size:10pt;" id="startdate2" name="startdate2" class="form-control form-control-sm datepicker3" required placeholder="(HH:mm:ss)" value="' + data2[l].startdate + '" /></td>' + 
							
							'<td style="width:14%;" align="center"><input type="text" style="font-size:10pt;" id="enddate2" name="enddate2" class="form-control form-control-sm datepicker4" required placeholder="(HH:mm:ss)" value="' + data2[l].enddate + '" /></td>' + 
							
							'<td style="width:14%;" align="center"><input type="text" style="font-size:10pt;" id="starttime2" name="starttime2" class="form-control form-control-sm timepicker" required placeholder="(HH:mm:ss)" value="' + data2[l].start_datetime + '" /></td>' + 
							
							'<td style="width:14%;" align="center"><input type="text" style="font-size:10pt;" id="endtime2" name="endtime2" class="form-control form-control-sm timepicker" required placeholder="(HH:mm:ss)" value="' + data2[l].end_datetime + '" /></td>' + 
							
							'<td style="width:14%;" align="center">' + 
									'<select id="active2" name="active2" class="form-control form-control-sm" required placeholder="Actived / Inactived) ?">' + 
										'<option value="' + data2[l].factive + '">' + data2[l].active + '</option>' + 
										'<option value="">Select One...</option>' + 
										'<option value="0">INACTIVED</option>' + 
										'<option value="1">ACTIVED</option>' + 
									'</select>' + 
							'</td>' + 
							
							'</tr>';
					}
					$('#sch2').append(trHTML);
				},
			})

			$("#dtl2 tbody tr").remove();
			$.ajax(
			{
				url : "<?php echo site_url('Upl_Message/view_trx_dtl/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data1)
				{
					//alert(data.length);
					var trHTML = '';
					for(var m = 0; m < data1.length;  m++ ) 
					{
						trHTML += 
							'<tr>'+
							'<td style="width:25%;" align="center"><input type="hidden" style="font-size:10pt;" id="schid2" name="schid2" class="form-control form-control-sm" value="' + data1[m].trx_schedule_id + '" /><input type="text" style="font-size:10pt;" id="phone2" name="phone2" class="form-control form-control-sm" required placeholder="No telephone" value="' + data1[m].phone + '" /></td>' + 
							
							'<td style="width:25%;" align="center"><input type="text" style="font-size:10pt;" id="name2" name="name2" class="form-control form-control-sm" required placeholder="Nama" value="' + data1[m].name + '" /></td>' + 
							
							'<td style="width:25%;" align="center"><input type="text" style="font-size:10pt;" id="overdue2" name="overdue2" class="form-control form-control-sm" required placeholder="Jumlah hari terlambat bayar" value="' + data1[m].overdue + '" /></td>' + 
							
							'<td style="width:25%;" align="center"><input type="text" style="font-size:10pt;" id="amount2" name="amount2" class="form-control form-control-sm" required placeholder="Jumlah Amount" value="' + data1[m].amount + '" /></td>' + 
							
							'</tr>';
					}
					$('#dtl2').append(trHTML);
				},
			})

			$('#view-modal-edit').modal('show'); // show bootstrap modal when complete loaded
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

    url = "<?php echo site_url('Upl_Message/update_api')?>";
	$.ajax({
		url : url,
		type: "POST",
		data: $('#form2').serialize(),
		dataType: "JSON",
		success: function(data)
		{
			if(data.status) //if success close modal and reload ajax table
			{
				$('#view-modal-edit').modal('hide');
				$("#notif").html('<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data berhasil di ubah !</h4></div>').show();
                $('#form2')[0].reset();
				reload_table();
			}

           	//if(data.status_data_sama == false) //if success close modal and reload ajax table
            //{
                //reload_table();
            	//$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon ti-close"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> User Name Tidak boleh sama Atau Konfirmasi Password tidak sama !</h6></div>').show();
            //}
			
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
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data gagal diubah, ada kesalahan... !!!</h4></div>').show();
			reload_table();
			//alert('Error Update data from ajax');

			return false;
		}
	});
}

</script>
