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
<div class="col-md-10">
	<div class="card card-danger" style="width:100%;">
		<div class="card-header with-border">
			<h3 class="card-title" style="color:red"><i class="fas fa-edit" data-card-widget="collapse"></i> Input Master Product</h3>
		</div>
		
		<div class="card-body" style="width:100%; display: none;" align="justify">
			<div style="color:red">
				<?php if(isset($error)){print $error;}?>
			</div>
			<form action="#" id="form1">
				<div class="row">
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Product Name *</label>
							<input type="text" class="form-control form-control-sm" width="100%" id="prod_name" name="prod_name" required placeholder="Nama Produk *" />
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
					<div class="col-md-6 col-lg-6">
						<div class="form-group">
							<label>Product Description *</label>
							<textarea id="prod_desc" name="prod_desc" class="form-control form-control-sm" placeholder="Product Deskripsi" required rows="5" maxlength="800" style="resize: none;"></textarea>
							<span class="help-block" style='color:red;'></span>
						</div>
					</div>
				</div>
				<br />
			</form>
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<button type="submit" class="btn btn-primary btn-sm" onclick="save()" id="Simpan">Save</button>&nbsp;
					<a href="<?=base_url('index.php/M_Product/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">Cancel</button></a>
				</div>
			</div>
		</div>
	</div>
	<br />
	<div class="card card-danger" style="width:100%;">
		<div id="notif" style="display: none;"></div>
		<div class="card-header with-border">
			<h3 class="card-title" style="color:red"><i class="fa fa-th-list"></i> View List Product</h3>
		</div>
		
		<div class="table table-bordered table-hover" style="background:#eeeeee;">
			<table class="display" id="Show-Tables" style="font-size:10pt;">
				<thead align="center">
					<tr>
						<th style="width: 5%;"><center>No.</center></th>
						<th style="width: 15%;"><center>Product Name</center></th>
						<th style="width: 65%;"><center>Product Description</center></th>
						<th style="width: 10%;"><center>Status</center></th>
						<th style="width: 5%;"><center> Action </center></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg wrapper">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><b>View Detail Product</b></h4>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
						<table style="width:100%; font-size:12pt;" border="0">
							<!--<tr style="padding: 2px; font-size:14pt;">
								<th align="left" style="width:25%; height: auto;">Product Information</th>
								<th align="left" style="width:3%; height: auto;"></th>
								<th align="left" style="width:72%; height: auto;"></th>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:10%;"> Product Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="prod_name1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:10%;"> Product Description </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="prod_desc1" rows="5" readonly style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:10%;"> Status </td>
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
					<h4 class="card-title"><b>Edit Detail Product</b></h4>
				</div>
				<form action="#" id="form2">
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
						<table style="width:100%; font-size:12pt;" border="0">
							<!--<tr style="padding: 2px; font-size:14pt;">
								<th align="left" style="width:25%; height: auto;">Product Information</th>
								<th align="left" style="width:3%; height: auto;"></th>
								<th align="left" style="width:72%; height: auto;"> </th>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:10%;"> Product Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="hidden" class="form-control form-control-sm" width="100%" id="id2" name="id2" readonly /><input type="text" class="form-control form-control-sm" name="prod_name2" required /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:10%;"> Product Description </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <textarea class="form-control form-control-sm" name="prod_desc2" rows="5" required maxlength="800" style="resize: none;"></textarea></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:10%;"> Status </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> 
									<select id="status2" name="status2" class="form-control form-control-sm" required placeholder="Actived / Inactived ?">
										<option value="">Select One...</option>
										<option value="1">ACTIVE</option>
										<option value="0">INACTIVE</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
				</form>
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
			"url": "<?php echo site_url('M_Product/dtTables')?>",
			"type": "POST",
			"data": function ( data ) {}     
		},
		"columnDefs": 
		[
			{ 
				"targets": 0, //first column - No.
				"orderable": true, //set orderable
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 1, //second column - Name
				"orderable": true, //set orderable
				"className": "text-left", //set alignment column to center
			},
			{ 
				"targets": 2, //third column - Description
				"orderable": true, //set orderable
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 3, //seven column - Status
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 4, //seven column - Action
				"className": "text-center", //set alignment column to center
			}
		],
		"order": [[ 1, 'asc' ]],
		"autoWidth": true
	});
});

function reload_table()
{
	dataTable.ajax.reload(null,false); //reload datatable ajax 
}
	
function view_prod(id)
{
	$('.help-block').empty(); // clear error string
	//$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_Product/view_product/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="prod_name1"]').val(data.product_name);

			$('[name="prod_desc1"]').val(data.product_description);

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

function del_prod(id)
{
	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_Product/delete_product/')?>" + id,
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

function edit_prod(id)
{
    $('.help-block').empty(); // clear error string
    //$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('M_Product/view_product/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id2"]').val(data.id);

			$('[name="prod_name2"]').val(data.product_name);

			$('[name="prod_desc2"]').val(data.product_description);

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

    url = "<?php echo site_url('M_Product/update_product')?>";
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
				reload_table();
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			reload_table();
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h4> Data gagal diubah, ada kesalahan... !!!</h4></div>').show();
			//alert('Error Update data from ajax');
		}
	});
}

$(document).on('click', '#viewModal_Input', function (){    
	   
	$('.modal-dialog').css({width:'90%',height:'auto', 'max-height':'70%'});
	$('.modal-title').html($(this).attr("data-title"));
	$('.modal-body').load($(this).attr("data-href"),function(result){
			$('#myModal').modal({show:true});
	})    
});


function save()
{
    $.ajax(
	{
        url : "<?php echo site_url('M_Product/ins_product')?>",
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
            	$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon ti-close"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Product yang di input sudah ada... !</h6></div>').show();
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

