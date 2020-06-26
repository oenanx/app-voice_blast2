<style>
.pic-container {
    width: 50px;
    height: 460px;
    overflow-y: scroll;
    overflow-x:hidden;
}
</style>
    <div class="col-md-6">
		<div class="box box-info pic-container" style="width:100%;">
			<div class="box-header with-border">
				<h3 class="box-title">Upload Documents Failed !!!</h3>
			</div><!-- /.box-header -->
        
			<div class="box-body">
				<!--<div class="summernote"></div>-->
				<div class="row">
					<div class="col-xs-12 form-group input-sm">
						<?php echo $error;?>
					</div>
				</div>
				<br />
				<br />
				<div class="row">
					<div class="col-xs-12 form-group input-sm">
						<a href="<?=base_url('index.php/M_Upload/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">Cancel</button></a>
					</div>
				</div>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
    </div>


	<!-- include summernote -->
	<!--<link rel="stylesheet" href="< ?=base_url('assets/dist/css/example.css')?>">
	<link rel="stylesheet" href="< ?=base_url('assets/dist/css/summernote-bs4.css')?>">
	<script type="text/javascript" src="< ?=base_url('assets/dist/js/summernote-bs4.js')?>"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.summernote').summernote({
			height: 200,
			tabsize: 0
		});
	});
	</script>-->
