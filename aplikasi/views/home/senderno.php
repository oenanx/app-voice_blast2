<style>
.modal-dialog {
	width: 100%;
	height: 100%;
	padding: auto;
	margin: auto;
}
.modal-content {
	height: auto;
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
					<h3 class="card-title" style="color:gray"><i class="fas fa-edit" data-card-widget="collapse"></i> Input Master Sender Number</h3>
				</div>
		   
				<div class="card-body" style="width:100%; display: none;" align="justify">
					<div style="color:red">
						<?php if(isset($error)){print $error;}?>
					</div>
					<form action="#" id="form1">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Select Product API *</label>
									<select name="api_id" id="api_id" class="form-control form-control-sm" required placeholder="Pilih Api *">
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
									<label>Sender No in Cpaas. *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="senderno" name="senderno" required placeholder="Sender No yang di daftarkan di aplikasi Telin *" />
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
									<label>Trial / Live *</label>
									<select name="trial" id="trial" class="form-control form-control-sm" required placeholder="Pilih Trial / Live *">
										<option value="">Select One...</option>
										<option value="0">Trial</option>
										<option value="1">Live</option>
									</select>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Description *</label>
									<textarea id="description" name="description" class="form-control form-control-sm" placeholder="Deskripsi" required rows="3" maxlength="800" style="resize: none;"></textarea><span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
							</div>
						</div>
						<br />
					</form>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-sm" onclick="save()" id="Simpan">Save</button>&nbsp;
							<a href="<?=base_url('index.php/M_Senderno/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">Cancel</button></a>
						</div>
					</div>
				</div>
			</div>	
			<br />	
			<div class="card card-danger" style="width:100%;">
				<div id="notif" style="display: none;"></div>
				<div class="card-header with-border">
					<h3 class="card-title" style="color:gray"><i class="fa fa-th-list"></i> List of Sender Number</h3>
				</div>

				<div class="table table-bordered table-hover" style="background:#eeeeee;">
					<table class="display" id="Show-Tables" width="100%" style="width:100%;font-size:10pt;">
						<thead align="center">
							<tr>
								<th style="width: 20%;"><center>Product API</center></th>
								<th style="width: 15%;"><center>Sender No.</center></th>
								<th style="width: 15%;"><center>Count Current</center></th>
								<th style="width: 25%;"><center>Description</center></th>
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
	<div class="modal-dialog modal-lg wrapper" role="document">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h2 class="card-title"><b>View Detail Sender Number</b></h2>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
						<table style="width:100%; font-size:12pt;" border="0">
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Product API </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" name="product_name1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Sender No in Cpaas </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" name="senderno1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Capacity Count Current </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" name="capacity1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Description </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <textarea class="form-control form-control-sm" name="description1" rows="2" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Trial / Live </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" name="trial1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Status </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" name="status1" readonly /></td>
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
					<h2 class="card-title"><b>Edit Detail Sender Number</b></h2>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
					<form action="#" id="form2">
						<table style="width:100%; font-size:12pt;" border="0">
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Product API </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="hidden" class="form-control form-control-sm" id="id2" name="id2" readonly /> 
									<select name="product_name2" id="product_name2" class="form-control form-control-sm" required placeholder="Pilih Product API *">
										<option value="">Select One...</option>
										<?php foreach($product->result() as $rowproduct):?>
											<option value="<?php echo $rowproduct->id;?>"><?php echo $rowproduct->title;?></option>
										<?php endforeach;?>
									</select>
								</td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Sender No in Cpaas </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" id="senderno2" name="senderno2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Capacity Count Current </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="number" class="form-control form-control-sm" id="capacity2" name="capacity2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Description </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <textarea class="form-control form-control-sm" id="description2" name="description2" rows="2" required style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Trial / Live * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> 
									<select id="trial2" name="trial2" class="form-control form-control-sm" required placeholder="Trial / Live ?">
										<option value="">Select One...</option>
										<option value="0">Trial</option>
										<option value="1">Live</option>
									</select>
								</td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Status * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> 
									<select id="status2" name="status2" class="form-control form-control-sm" required placeholder="Actived / Inactived) ?">
										<option value="">Select One...</option>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
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
$(document).ready(function() 
{
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
			"url": "<?php echo site_url('M_Senderno/dtTables')?>",
			"type": "POST",
			"data": function ( data ) {}     
		},
		"columnDefs": 
		[
			{ 
				"targets": 0, //first column - No
				"width": "20%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 1, //second column - Reg_no
				//"orderable": true, //set orderable
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 2, //second column - Company Name
				//"orderable": true, //set orderable
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 3, //third column - Phone / Fax
				//"orderable": true, //set orderable
				"width": "25%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 4, //fourth column - Status
				//"orderable": true, //set orderable
				"width": "10%",
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
	
function view_sender(id)
{
	$('.help-block').empty(); // clear error string
	//$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_Senderno/view_send/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="product_name1"]').val(data.product_name);

			$('[name="senderno1"]').val(data.senderno);

			$('[name="capacity1"]').val(data.capacity);

			$('[name="description1"]').val(data.description);

			$('[name="trial1"]').val(data.trial);

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
		url : "<?php echo site_url('M_Senderno/delete_send/')?>" + id,
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

function edit_sender(id)
{
    $('.help-block').empty(); // clear error string
    //$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('M_Senderno/view_send/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id2"]').val(data.id);

			$('[name="product_name2"]').val(data.product_id);

			$('[name="senderno2"]').val(data.senderno);

			$('[name="capacity2"]').val(data.capacity);

			$('[name="description2"]').val(data.description);

			$('[name="trial2"]').val(data.ftrial);

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

    url = "<?php echo site_url('M_Senderno/update_send')?>";
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
        url : "<?php echo site_url('M_Senderno/ins_send')?>",
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

