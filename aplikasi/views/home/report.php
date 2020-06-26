<div id="layoutSidenav_content">
	<main>
		<div class="card card-primary" style="width:100%;">
			<div class="card-header with-border">
				<h3 class="card-title" style="color:gray"><i class="fa fa-th-list"></i> Report Detail</h3>
			</div>
		
			<div class="card-body" style="width:100%;height: auto;" align="justify">
				<div class="container" align="justify">
					<form id="form2" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-4 col-lg-4">
								<div class="form-group">
									<label>Select Campaign *</label>
									<select name="campaign" id="campaign" class="form-control-sm" required>
										<option value="">Select Campaign</option>
										<?php foreach($campaign->result() as $campaign):?>
										<option value="<?php echo $campaign->id;?>"><?php echo $campaign->title;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>

							<div class="col-md-4 col-lg-4">
								<div class="form-group">
									<label>Select Batch No. *</label>
									<select name="batches" id="batches" class="form-control-sm" required>
										<option value="">Select Batch No.</option>
										<!--< ?php foreach($batch->result() as $batchs):?>
										<option value="< ?php echo $batchs->batchid;?>">< ?php echo $batchs->batchid;?></option>
										< ?php endforeach;?>-->
									</select>
								</div>
							</div>

							<div class="col-md-4 col-lg-4">
								<div class="form-group">
									<label>Select Response *</label>
									<select name="responses" id="responses" class="form-control-sm" required>
										<option value="">Select One...</option>
										<option value="ALL">All Response</option>
										<option value="completed">Completed</option>
										<option value="BUSY">Busy</option>
										<option value="FAILED">Failed</option>
										<option value="canceled">No Answer</option>
									</select>
								</div>
							</div>
						</div>
						<!--
						<div class="row">
							<div class="col-md-4 col-lg-4">
								<div class="form-group">
									<label>Start Date *</label>
									<input data-date-format="YYYY-MM-DD" type="text" style="font-size:10pt;" id="startdate" name="startdate" class="form-control form-control-sm datepicker" readonly required placeholder="(yyyy-mm-dd)" />
								</div>
							</div>

							<div class="col-md-4 col-lg-4">
								<div class="form-group">
									<label>End Date *</label>
									<input data-date-format="YYYY-MM-DD" type="text" style="font-size:10pt;" id="endate" name="endate" class="form-control form-control-sm datepicker" readonly required placeholder="(yyyy-mm-dd)" />
								</div>
							</div>

							<div class="col-md-4 col-lg-4">
								<div class="form-group">
								</div>
							</div>
						</div>-->
					</form>
				
					<div class="table table-bordered table-hover" style="width:100%;background:#eeeeee;">
						<table class="cell-border compact hover" id="Show-Tables" style="width:100%;font-size:8pt;">
							<thead align="center">
								<tr>
									<!--<th style="width: 5%;"><center>No.</center></th>-->
									<th style="width: 9%;"><center>Batch</center></th>
									<th style="width: 10%;"><center>Phone</center></th>
									<th style="width: 10%;"><center>Name</center></th> 
									<th style="width: 13%;"><center>Call Sid.</center></th> 
									<th style="width: 10%;"><center>Response</center></th> 
									<th style="width: 10%;"><center>Count Call</center></th> 
									<th style="width: 10%;"><center>Start Call</center></th> 
									<th style="width: 10%;"><center>End Call</center></th> 
									<th style="width: 8%;"><center>Duration</center></th> 
									<th style="width: 10%;"><center>Call Retry</center></th> 
									<!--<th style="width: 10%;"><center> Action </center></th>-->
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>	
		</div>
	</main>

<link href="<?=base_url('assets/dist/css/propeller.css')?>" rel="stylesheet">
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/dataTables.buttons.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/buttons.flash.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/jszip.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/pdfmake.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/vfs_fonts.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/buttons.html5.min.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/datatables/buttons.print.min.js')?>"></script>

<script type="text/javascript" src="<?=base_url('assets/dist/js/moment.js')?>" language="javascript"></script>
<script type="text/javascript" src="<?=base_url('assets/dist/js/bootstrap-datetimepicker.js')?>" language="javascript"></script>
<script type="text/javascript" class="init">
//var dataSch;
var dataTable;
$(document).ready(function()
{
	//$('body').on('focus','.datepicker', function()
	//{
		//$(this).datepicker({
			//dateFormat: 'yy-mm-dd', yearRange: '1990:2100', ignoreReadonly: true
		//});
	//});

	$('#campaign').change(function(){ //button filter event click
        //dataTable.ajax.reload();  //just reload table
		var id=$(this).val();
		$.ajax({
			url : "<?php echo site_url('Report/get_batch');?>",
			method : "POST",
			data : {id: id},
			async : true,
			dataType : 'json',
			success: function(data){
				 
				var html = '<option value="">Select Batch No.</option>';
				var i;
				for(i=0; i<data.length; i++){
					//html += '<option value="">Select Batch No.</option>';
					html += '<option value='+data[i].batchid+'>'+data[i].batchid+'</option>';
				}
				$('#batches').html(html);
			}
		});
		return false;
    });

	$('#batches').change(function()
	{ //button filter event click
        //dataTable.ajax.reload();  //just reload table
		reload_table();
    });

	$('#responses').change(function()
	{ //button filter event click
        //dataTable.ajax.reload();  //just reload table
		reload_table();
    });
});

function reload_table()
{
	//dataTable.ajax.reload(null,false); //reload datatable ajax 
	$('#Show-Tables').DataTable().clear();
	$('#Show-Tables').DataTable().destroy();

	dataTable =  $('#Show-Tables').DataTable( 
	{
		//"retrieve": true,
		"processing": true,
		"sDom": "Bfrtip",
		"language": 
		{ 
			"processing": "Mohon tunggu sebentar sedang memproses data..."
		},
		"serverSide": true,
		"ordering": false, 
		"pagingType": "simple_numbers",
		"searching": false,
		"ajax": {
			"url": "<?php echo site_url('Report/dtTables_rpt')?>",
			"type": "POST",
			//"data": function ( data ) {}     
			"data": function ( data ) {
				data.batches = $('#batches').val();
				data.responses = $('#responses').val();
			}     
		},
		"columnDefs": 
		[
			{ 
				"targets": 0, //second column - Batch
				//"orderable": true, //set orderable
				"width": "9%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 1, //third column - Phone
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 2, //fourth column - Name
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 3, //fifth column - Result
				"width": "13%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 4, //fifth column - Result
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 5, //fifth column - Result
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 6, //fifth column - Result
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 7, //fifth column - Result
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 8, //fifth column - Result
				"width": "8%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 9, //fifth column - Result
				"width": "10%",
				"className": "text-center", //set alignment column to center
			}
		],
		//"order": [[ 1, 'asc' ]],
		"buttons": [
				'excelHtml5',
				//'pdfHtml5',
				'csvHtml5'
			],
		"autoWidth": true
	});
}

/*
$(document).ready(function (e) 
{
    $('#call').on('click', function () 
	{
    	//var Checked = $('input[name="batches"]:selected').length;
		//print_r($('[name="batches"]').val(data.batches));
		//exit();
		var batches = $('select[name="batches"]').val();
        if(batches !== "") //jika checked lebih besar dari 0
		{ 
			//alert(batchid);
			//exit();
			$.ajax(
			{
				url : "<?php echo site_url('C_Call/call'); ?>",
				type: "POST",
				data: $('#form2').serialize(),
				//data: {'batchid':batchid},
				dataType: "JSON",
				success: function(data)
				{
					//alert(data);
					//exit();
					//$('[name="res"]').val(output);
					if(data.status) //if success close modal and reload ajax table
					{
						$("#notif").html('<div class="alert alert-success alert-dismissable"><i class="icon fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h5> PROSES CALL BERHASIL!</h5></div>').show();
						$('#form1')[0].reset();
						reload_table();
					}
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					reload_table();
					$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h5> PROSES CALL GAGAL!</h5></div>').show();

					return false;
				}
			});
			
		}
	    else
		{
			//alert('Pilih Batch Number dahulu');
			$("#notif").html('<div class="alert alert-danger alert-dismissable"><i class="icon fa fa-ban"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><h5> Pilih Batch Number dahulu !</h5></div>').show();

			return false;
			document.getElementById("batches").focus();
		}
    });
});		
*/
</script>
