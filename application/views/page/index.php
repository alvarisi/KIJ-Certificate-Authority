<div class="row">
	<h4 class="header">Certificate Authority</h4>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
          	<a href="<?php echo base_url('index.php/main/'); ?>" class="list-group-item active">Tambahkan Certificate</a>
          	<a href="<?php echo base_url('index.php/main/lists'); ?>" class="list-group-item">Daftar Certificate</a>
        </div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Form Tambah
			</div>
			<div class="panel-body">
				<?php
				echo form_open_multipart('main/add',[ 'class' => 'form' ]);
				?>
				<div class="form-group">
					<label class="form-label">
						Nama Perusahaan
					</label>
					<?php
					$att = array('name' => 'name', 'class' => 'form-control');
					echo form_input($att);
					?>
					<?php echo form_error('name'); ?>
				</div>			
				<div class="form-group">
					<label class="form-label">
						File
					</label>
					<?php
					$att = array('name' => 'file', 'class' => 'form-control');
					echo form_upload($att);
					?>
					<?php echo form_error('file'); ?>
				</div>
				<div class="form-group">
					<label class="form-label">
						Type Hashing
					</label>
					<div class="">
						<div class="">
						<?php
						$att = array('name' => 'hashing_type','value' => 'SHA1','class' => '','id' => 'SHA1');
						echo form_radio($att);
						echo form_label('SHA1','SHA1',['id' => 'SHA1']);
						?>
						</div>
						<div class="">
						<?php
						$att = array('name' => 'hashing_type', 'value' => 'SHA256','class' => '','id' => 'SHA256');
						echo form_radio($att);
						echo form_label('SHA256','SHA256',['id' => 'SHA256']);
						?>
						</div>
						<?php echo form_error('hashing_type'); ?>

					</div>
				</div>
				<div class="form-group">
					<?php
					$att = ['class' => 'btn btn-primary', 'value' => 'Simpan'];
					echo form_submit($att);
					?>
				</div>
				<?php 
					echo form_close();
				?>
			</div>
		</div>
		
		
	</div>
</div>