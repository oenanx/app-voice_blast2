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
				<h3 class="box-title">Upload Documents Succeed !!!</h3>
			</div><!-- /.box-header -->
        
			<div class="box-body">
				<!--<div class="summernote"></div>-->
				<div class="row">
					<div class="col-xs-12 form-group input-sm">
						<ul>
							<?php foreach ($berkas as $item => $value):?>
								<li><?php echo $item;?>: <?php echo $value;?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<br />
				<div class="row">
					<div class="col-xs-12 form-group input-sm">
						<!--<input type="submit" class="btn btn-primary btn-sm" value="Upload" />
						<button type="submit" class="btn btn-primary btn-sm" onclick="save()" id="Simpan">Save</button>&nbsp;-->
						<a href="<?=base_url('index.php/Docs/index')?>"><button type="button" class="btn btn-danger btn-sm" name="Batal">Cancel</button></a>
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
