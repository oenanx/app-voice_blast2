<div id="layoutSidenav_content">
	<main>
		<div class="card card-primary" style="width:100%;">
			<div class="card-header with-border">
				<h3 class="card-title" style="color:gray"><i class="fa fa-th-list"></i> Report Summary</h3>
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
										<option value="All">All Campaign</option>
										<?php foreach($campaign->result() as $campaign):?>
										<option value="<?php echo $campaign->id;?>"><?php echo $campaign->title;?></option>
										<?php endforeach;?>
									</select>
								</div>
							</div>
						</div>
					</form>
				
					<div class="table table-bordered table-hover" style="width:100%;background:#eeeeee;">
						<table class="cell-border compact hover" id="Show-Tables" style="width:100%;font-size:10pt;">
							<thead align="center">
								<tr>
									<th style="width: 25%;"><center>Campaign Title</center></th>
									<th style="width: 10%;"><center>Start Date</center></th>
									<th style="width: 10%;"><center>End Date</center></th>
									<th style="width: 10%;"><center>Completed</center></th>
									<th style="width: 10%;"><center>Busy</center></th> 
									<th style="width: 10%;"><center>Failed</center></th> 
									<th style="width: 10%;"><center>No Answer</center></th> 
									<th style="width: 15%;"><center>Duration</center></th> 
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
	$('#campaign').change(function()
	{   
		//button filter event click
		//if($('#campaign').val() == "")
		//{
			//$('#form2')[0].reset();
		//} 
		//else 
		//{
			reload_table();
		//}
    });
});

function reload_table()
{
	//dataTable.ajax.reload(null,false); //reload datatable ajax 
	//$('#Show-Tables').DataTable().draw();
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
			"url": "<?php echo site_url('Report2/dtTables_rpt')?>",
			"type": "POST",
			//"data": function ( data ) {}     
			"data": function ( data ) {
				data.campaign = $('#campaign').val();
			}     
		},
		"columnDefs": 
		[
			{ 
				"targets": 0, //1 column - Campaign_title
				"width": "25%",
				"className": "text-left", //set alignment column to center
			},
			{ 
				"targets": 1, //2 column - start_date
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 2, //3 column - end_date
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 3, //4 column - Completed
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 4, //5 column - Busy
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 5, //6 column - Failed
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 6, //7 column - Canceled
				"width": "10%",
				"className": "text-center", //set alignment column to center
			},
			{ 
				"targets": 7, //8 column - Dur_Completed
				"width": "15%",
				"className": "text-center", //set alignment column to center
			}
		],
		//"order": [[ 1, 'asc' ]],
		"buttons": [
				'excelHtml5',
				//'pdfHtml5',
				'csvHtml5'
			],
		"autoWidth": false
	});
}
</script>
