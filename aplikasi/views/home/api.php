<style>
.modal-dialog {
	width: 100%;
	height: 100%;
	padding: auto;
	margin: auto;
}
.modal-content {
	width: 100%;
	height: 100%;
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
					<h3 class="card-title" style="color:gray"><i class="fas fa-edit" data-card-widget="collapse"></i> Input New Api</h3>
				</div>
		   
				<div class="card-body" style="width:100%; display: none;" align="justify">
					<div style="color:red">
						<?php if(isset($error)){print $error;}?>
					</div>
					<form action="#" id="form1">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Product API Title *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="title" name="title" required placeholder="Title Product API *" />
									<span class="help-block" style='color:red;'></span>							
									<!--<select id="prod_id" name="prod_id" class="form-control form-control-sm" required placeholder="Nama Product">
										<option value="">Select One...</option>
										< ?php foreach($product->result() as $rowproduct):?>
											<option value="< ?php echo $rowproduct->id;?>">< ?php echo $rowproduct->product_name;?></option>
										< ?php endforeach;?>
									</select><span class="help-block" style='color:red;'></span>-->
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>API Authentication *</label>
									<textarea class="form-control form-control-sm" id="api_auth" name="api_auth" rows="3" required maxlength="1000" style="resize: none;"></textarea>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>API URL *</label>
									<textarea class="form-control form-control-sm" id="api_url" name="api_url" rows="3" required maxlength="1000" style="resize: none;"></textarea>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Web Service *</label>
									<textarea class="form-control form-control-sm" id="web_svc" name="web_svc" rows="3" required maxlength="1000" style="resize: none;"></textarea>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>API Note</label>
									<textarea class="form-control form-control-sm" id="api_keterangan" name="api_keterangan" rows="3" maxlength="1000" style="resize: none;"></textarea>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
								</div>
							</div>
						</div>
						<br />
					</form>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-sm" onclick="save()" id="Simpan">Save</button>&nbsp;
							<a href="<?=base_url('index.php/M_Api/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">Cancel</button></a>
						</div>
					</div>
				</div>
			</div>	
			<br />
			<div class="card card-danger" style="width:100%;">	
				<div id="notif" style="display: none;"></div>
				<div class="card-header with-border">
					<h3 class="card-title" style="color:gray"><i class="fa fa-th-list"></i> List of Api</h3>
				</div>
			
				<div class="table table-bordered table-hover" style="width:100%;background:#eeeeee;">
					<table class="cell-border compact hover" id="Show-Tables" width="100%" style="width:100%;font-size:10pt;word-break: break-all;">
						<thead align="center">
							<tr>
								<th style="width: 5%;"><center>No.</center></th>
								<th style="width: 15%;"><center>Product API Title</center></th>
								<th style="width: 30%;"><center>API Auth.</center></th>
								<!--<th style="width: 20%;"><center>API Url.</center></th> 
								<th style="width: 19%;"><center>Web Service</center></th>--> 
								<th style="width: 5%;"><center>Status</center></th> 
								<th style="width: 5%;"><center> Action </center></th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		<!--</div>-->
	</main>

<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><b>View Detail Product API</b></h4>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
						<table style="width:100%; font-size:12pt;" border="0">
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Product API Title</td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="title1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> API Authentication </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="auth1" rows="4" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> API URL </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="url1" rows="4" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Web Service </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="svc1" rows="3" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> API Note </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="api_keterangan1" rows="3" readonly style="resize: none;"></textarea></td>
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><b>Edit Detail Product API</b></h4>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
					<form action="#" id="form2">
						<table style="width:100%; font-size:12pt;" border="0">
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Product API Title * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="hidden" class="form-control form-control-sm" id="id2" name="id2" readonly />
									<input type="text" class="form-control form-control-sm" width="100%" id="title2" name="title2" required placeholder="Title Product API *" />
									<span class="help-block" style='color:red;'></span>							
									<!--<select id="prod2" name="prod2" class="form-control form-control-sm" required placeholder="Nama Product">
										<option value="">Select One...</option>
										< ?php foreach($product->result() as $rowproduct):?>
											<option value="< ?php echo $rowproduct->id;?>">< ?php echo $rowproduct->product_name;?></option>
										< ?php endforeach;?>
									</select><span class="help-block" style='color:red;'></span>-->
								</td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> API Authentication * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <textarea class="form-control form-control-sm" id="auth2" name="auth2" rows="4" required style="resize: none;"></textarea><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> API URL * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <textarea class="form-control form-control-sm" id="url2" name="url2" rows="4" required style="resize: none;"></textarea><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Web Service * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <textarea class="form-control form-control-sm" id="svc2" name="svc2" rows="3" required style="resize: none;"></textarea><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> API Note * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <textarea class="form-control form-control-sm" id="api_keterangan2" name="api_keterangan2" rows="3" required style="resize: none;"></textarea><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Status * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> 
									<select id="status2" name="status2" class="form-control form-control-sm" required placeholder="Actived / Inactived ?">
										<option value="">Select One...</option>
										<option value="1">ACTIVE</option>
										<option value="0">INACTIVE</option>
									</select><span class="help-block" style='color:red;'></span>
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

<link href="<?=base_url('assets/dist/css/propeller.css')?>" rel="stylesheet">
<script type="text/javascript" src="<?=base_url('assets/dist/js/jquery.dataTables.js')?>"></script>
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
			"url": "<?php echo site_url('M_Api/dtTables')?>",
			"type": "POST",
			"data": function ( data ) {}     
		},
		"columnDefs": 
		[
			{ 
				"targets": 0, //first column - No
				"width": "5%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 1, //second column - Prod. Name
				"orderable": true, //set orderable
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 2, //third column - API Auth
				"width": "30%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 3, //fifth column - Status
				"width": "5%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 4, //fifth column - Action
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
	
function view_api(id)
{
	$('.help-block').empty(); // clear error string
	//$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_Api/view_apis/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="title1"]').val(data.title);

			$('[name="auth1"]').val(data.api_auth);

			$('[name="url1"]').val(data.api_url);

			$('[name="svc1"]').val(data.webservice);

			$('[name="api_keterangan1"]').val(data.api_keterangan);

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

function del_api(id)
{
	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_Api/delete_api/')?>" + id,
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

function edit_api(id)
{
    $('.help-block').empty(); // clear error string
    //$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('M_Api/view_apis/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id2"]').val(data.id);

			$('[name="title2"]').val(data.title);

			$('[name="auth2"]').val(data.api_auth);

			$('[name="url2"]').val(data.api_url);

			$('[name="svc2"]').val(data.webservice);

			$('[name="api_keterangan2"]').val(data.api_keterangan);

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

    url = "<?php echo site_url('M_Api/update_api')?>";
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

           	if(data.status_data_sama == false) //if success close modal and reload ajax table
            {
                reload_table();
            	$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon ti-close"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> User Name Tidak boleh sama Atau Konfirmasi Password tidak sama !</h6></div>').show();
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
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data gagal diubah, ada kesalahan... !!!</h4></div>').show();
			reload_table();
			//alert('Error Update data from ajax');

			return false;
		}
	});
}

function save()
{
    $.ajax(
	{
        url : "<?php echo site_url('M_Api/ins_api')?>",
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
			reload_table();
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Data gagal disimpan, cek kembali... !!!</h6></div>').show();

			return false;
		}
	});
}

</script>

