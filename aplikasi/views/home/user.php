<style>
.modal-dialog {
	width: 100%;
	height: 100%;
	padding: auto;
	margin: auto;
}
.modal-content {
	height: 90%;
	border-radius: 10px;
	color: #333;
	overflow: auto;
}
</style>
<div id="layoutSidenav_content">
	<main>
		<!--<div class="col-md-10">-->
			<div class="card card-danger" style="width:100%;">
				<div class="card-header with-border">
					<h3 class="card-title" style="color:gray"><i class="fas fa-edit" data-card-widget="collapse"></i> Input New User</h3>
				</div>
		   
				<div class="card-body" style="width:100%; display: none;" align="justify">
					<div style="color:red">
						<?php if(isset($error)){print $error;}?>
					</div>
					<form action="#" id="form1">
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Select Company *</label>
									<select name="company_name" id="company_name" class="form-control form-control-sm" required placeholder="Pilih Perusahaan *">
										<option value="">Select One...</option>
										<?php foreach($company->result() as $rowcompany):?>
											<option value="<?php echo $rowcompany->id;?>"><?php echo $rowcompany->company_name;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Select Group Account *</label>
									<select name="group_name" id="group_name" class="form-control form-control-sm" required placeholder="Pilih Group Account *">
										<option value="">Select One...</option>
										<?php foreach($group->result() as $rowgroup):?>
											<option value="<?php echo $rowgroup->id;?>"><?php echo $rowgroup->group_name;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<!--<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Select Sender No. *</label>
									<select name="senderno" id="senderno" class="form-control form-control-sm" required placeholder="Pilih Sender Number *">
										<option value="">Select One...</option>
										< ?php foreach($senderno->result() as $rowsenderno):?>
											<option value="< ?php echo $rowsenderno->id;?>">< ?php echo $rowsenderno->senderno;?></option>
										< ?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
								</div>
							</div>
						</div>-->
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>User Name *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="user_name" name="user_name" required placeholder="Nama User *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Full Name *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="full_name" name="full_name" required placeholder="Nama Lengkap *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Password *</label>
									<input type="password" class="form-control form-control-sm" width="100%" id="passwd" name="passwd" required placeholder="Password *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Confirmation Password *</label>
									<input type="password" class="form-control form-control-sm" width="100%" id="confirm_passwd" name="confirm_passwd" required placeholder="Konfirmasi Password *" />
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Select Menu *</label>
									<select name="menus[]" id="menus" multiple class="form-control form-control-sm" required placeholder="Pilih Menu *">
										<option value="">Select One...</option>
										<?php foreach($menus->result() as $rowmenu):?>
											<option value="<?php echo $rowmenu->id;?>"><?php echo $rowmenu->description;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</div>
							</div>
							<div class="col-md-6 col-lg-6">
								<div class="form-group">
									<label>Divisi Name *</label>
									<input type="text" class="form-control form-control-sm" width="100%" id="divisi_name" name="divisi_name" required placeholder="Nama Divisi" /><span class="help-block" style='color:red;'></span>
								</div>
							</div>
						</div>
						<br />
					</form>
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<button type="submit" class="btn btn-primary btn-sm" onclick="save()" id="Simpan">Save</button>&nbsp;
							<a href="<?=base_url('index.php/M_User/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">Cancel</button></a>
						</div>
					</div>
				</div>
			</div>
			<br />
			<div class="card card-danger" style="width:100%;">
				<div id="notif" style="display: none;"></div>
				<div class="card-header with-border">
					<h3 class="card-title" style="color:gray"><i class="fa fa-th-list"></i> List of User</h3>
				</div>
				<div class="table table-bordered table-hover" style="background:#eeeeee;">
					<table class="display" id="Show-Tables" width="100%" style="width:100%;font-size:10pt;">
						<thead align="center">
							<tr>
								<!--<th style="width: 5%;"><center>No.</center></th>-->
								<th style="width: 15%;"><center>User Name</center></th>
								<th style="width: 25%;"><center>Full Name</center></th>
								<th style="width: 25%;"><center>Company Name</center></th> 
								<!--<th style="width: 20%;"><center>Product API</center></th>
								<th style="width: 15%;"><center>Sender No.</center></th> -->
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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><b>View Detail User</b></h4>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
						<table style="width:100%; font-size:12pt;" border="0">
							<!--<tr style="padding: 2px; font-size:14pt;">
								<th align="left" style="width:25%; height: auto;">User Information</th>
								<th align="left" style="width:3%; height: auto;"></th>
								<th align="left" style="width:72%; height: auto;"></th>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> User Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="uname1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Full Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="fname1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Divisi Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="dname1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Password </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="password" class="form-control form-control-sm" id="passwd1" name="passwd1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Company Name </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="cname1" readonly /></td>
							</tr>
							<!--<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Sender No. </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="send1" readonly /></td>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Group Account </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="gname1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Status </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="status1" readonly /></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:20%;"> Menu - Menu </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:77%;"> <input type="text" class="form-control form-control-sm" name="menus1" readonly /></td>
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
					<h3 class="card-title"><b>Edit Detail User</b></h3>
				</div>
				<div class="card-body">
					<div id="modal-loader" style="display: none; text-align: center;">
						<img src="<?=base_url('images/ajax-loader.gif')?>">
					</div>
					<div class="card-body" align="justify">
					<form action="#" id="form2">
						<table style="width:100%; font-size:12pt;" border="0">
							<!--<tr style="padding: 2px; font-size:14pt;">
								<th align="left" style="width:25%; height: auto;">User Information</th>
								<th align="left" style="width:3%; height: auto;"></th>
								<th align="left" style="width:72%; height: auto;"></th>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> User Name * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="hidden" class="form-control form-control-sm" id="id2" name="id2" readonly /><input type="text" class="form-control form-control-sm" id="uname2" name="uname2" required /><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Full Name *</td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" id="fname2" name="fname2" required /><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Divisi Name *</td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="text" class="form-control form-control-sm" id="dname2" name="dname2" required /><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Password * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="password" class="form-control form-control-sm" id="passwd2" name="passwd2" required /><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Password Confirmation * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> <input type="password" class="form-control form-control-sm" id="cpasswd2" name="cpasswd2" required /><span class="help-block" style='color:red;'></span></td>
							</tr>
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Company Name * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> 
									<select id="cname2" name="cname2" class="form-control form-control-sm" required placeholder="Nama Perusahaan">
										<option value="">Select One...</option>
										<?php foreach($company->result() as $rowcompany):?>
											<option value="<?php echo $rowcompany->id;?>"><?php echo $rowcompany->company_name;?></option>
										<?php endforeach;?>
									</select><span class="help-block" style='color:red;'></span>
								</td>
							</tr>
							<!--<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Sender No. * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> 
									<select id="send2" name="send2" class="form-control form-control-sm" required placeholder="Nomor Pengirim Default">
										<option value="">Select One...</option>
										< ?php foreach($senderno->result() as $rowsenderno):?>
											<option value="< ?php echo $rowsenderno->id;?>">< ?php echo $rowsenderno->senderno;?></option>
										< ?php endforeach;?>
									</select><span class="help-block" style='color:red;'></span>
								</td>
							</tr>-->
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Group Name * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> 
									<select id="gname2" name="gname2" class="form-control form-control-sm" required placeholder="Group Account">
										<option value="">Select One...</option>
										<?php foreach($group->result() as $rowgroup):?>
											<option value="<?php echo $rowgroup->id;?>"><?php echo $rowgroup->group_name;?></option>
										<?php endforeach;?>
									</select><span class="help-block" style='color:red;'></span>
								</td>
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
							
							<tr style="line-height: 1.0;">
								<td align="left" style="width:25%;"> Menu - menu * </td>
								<td align="center" style="width:3%;">:</td>
								<td align="left" style="width:72%;"> 
									<select name="menus2[]" id="menus2" multiple class="form-control form-control-sm" required placeholder="Pilih Menu *">
										<option value="">Select One...</option>
										<?php foreach($menus->result() as $rowmenu):?>
											<option value="<?php echo $rowmenu->id;?>"><?php echo $rowmenu->description;?></option>
										<?php endforeach;?>
									</select>
									<span class="help-block" style='color:red;'></span>
								</td>
							</tr>

						</table>
						<!--<table id="myTable1" style="width:100%; font-size:12pt;" border="0">
						</table>-->
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
			"url": "<?php echo site_url('M_User/dtTables')?>",
			"type": "POST",
			"data": function ( data ) {}     
		},
		"columnDefs": 
		[
			{ 
				"targets": 0, //second column - User Name
				"orderable": true, //set orderable
				"width": "15%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 1, //third column - Full Name
				"orderable": true, //set orderable
				"width": "25%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 2, //fourth column - Company
				"orderable": true, //set orderable
				"width": "25%",
				"className": "text-center", //set alignment column to center
			},
			//{ 
				//"targets": 3, //third column - Product API
				//"orderable": true, //set orderable
				//"width": "20%",
				//"className": "text-center", //set alignment column to center
			//},
			//{ 
				//"targets": 4, //fourth column - Sender No.
				//"orderable": true, //set orderable
				//"width": "15%",
				//"className": "text-center", //set alignment column to center
			//},
			{ 
				"targets": 3, //fifth column - Status
				"width": "10%",
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
	
function view_usr(id)
{
	$('.help-block').empty(); // clear error string
	//$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});

	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_User/view_user/')?>" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data)
		{
			$('[name="uname1"]').val(data.user_name);

			$('[name="fname1"]').val(data.full_name);

			$('[name="dname1"]').val(data.divisi_name);

			$('[name="passwd1"]').val(data.passwd);

			$('[name="cname1"]').val(data.company_name);

			//$('[name="prname1"]').val(data.product_name);

			//$('[name="send1"]').val(data.senderno);

			$('[name="gname1"]').val(data.group_name);

			$('[name="status1"]').val(data.active);

			$('[name="menus1"]').val(data.menus);

			$('#view-modal').modal('show'); // show bootstrap modal when complete loaded
			//$('.modal-title').text('View Aset'); // Set title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
			alert('Error get data from ajax');
		}
	});
};

function del_usr(id)
{
	//Ajax Load data from ajax
	$.ajax(
	{
		url : "<?php echo site_url('M_User/delete_user/')?>" + id,
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

function edit_usr(id)
{
    $('.help-block').empty(); // clear error string
    //$('.modal-dialog').css({width:'100%',height:'auto', 'max-height':'100%'});
    //$('#myTable1 tbody tr').remove();
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('M_User/view_user/')?>" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
			$('[name="id2"]').val(data.id);

			$('[name="uname2"]').val(data.user_name);

			$('[name="fname2"]').val(data.full_name);

			$('[name="dname2"]').val(data.divisi_name);

			$('[name="passwd2"]').val(data.passwd);

			$('[name="cpasswd2"]').val(data.passwd);

			$('[name="cname2"]').val(data.company_id);

			//$('[name="prname2"]').val(data.product_id);

			//$('[name="send2"]').val(data.senderno_id);

			$('[name="gname2"]').val(data.account_group_id);

			$('[name="status2"]').val(data.factive);

			$('[name="menus2"]').val(data.menus);

			//$("#myTable1").remove();
			//$("#myTable1 tbody tr").remove();
			/*
			$("#myTable1").empty();
			$.ajax(
			{
				url : "<?php echo site_url('M_User/view_menu/')?>" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					//console.log(data);
					//$("#myTable1 tbody tr").remove();
					//$("#myTable1 tbody tr").remove();

					var trHTML = '';
					
					trHTML += '<tr style="line-height: 1.0;">' +
								'<td align="left" style="width:25%;"> Menu - menu * </td>' +
								'<td align="center" style="width:3%;">:</td>' + 
								'<td align="left" style="width:72%;">' +
								'<select id="menux2" name="menux2[]" multiple class="form-control form-control-sm" required placeholder="Menu - menu">';
					for(var i = 0; i < data.length;  i++ ) 
					{
						trHTML += '<option value="' + data[i].menu_id + '">' + data[i].description + '</option>';
					}
					trHTML += '</select><span class="help-block" style="color:red;"></span></td></tr>';
					$('#myTable1').append(trHTML);
					
				},
			});
			*/
			
            $('#view-modal-edit').modal('show'); // show bootstrap modal when complete loaded
            //$('.modal-title').text('Edit Aset'); // Set title to Bootstrap modal title
			
			//$("#myTable1").remove();
			
			//return false;
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

    url = "<?php echo site_url('M_User/update_user')?>";
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
        url : "<?php echo site_url('M_User/ins_user')?>",
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
			reload_table();
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h6> Data gagal disimpan, cek kembali... !!!</h6></div>').show();

			return false;
		}
	});
}

</script>

