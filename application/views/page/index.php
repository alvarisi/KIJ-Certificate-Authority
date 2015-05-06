<div class="row">
	<h4 class="header">Certificate Authority</h4>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
          	<a href="<?php echo base_url('index.php/main/'); ?>" class="list-group-item active">Tambahkan Certificate</a>
          	<a href="<?php echo base_url('index.php/main/lists'); ?>" class="list-group-item">Daftar Certificate</a>
		<a href="<?php echo base_url('index.php/home/logout'); ?>" class="list-group-item">Keluar</a>
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
					<div class="col-md-6">
						<label class="form-label">
						Nama
						</label>
						<?php
						$att = array('name' => 'common_name', 'class' => 'form-control');
						echo form_input($att);
						?>
						<?php echo form_error('common_name'); ?>
					</div>
					<div class="col-md-6">
						<label class="form-label">
						Email
					</label>
						<?php
						$att = array('name' => 'email_address', 'class' => 'form-control');
						echo form_input($att);
						?>
						<?php echo form_error('email_address'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="form-label">
						Negara
						</label>
						<?php
						$options = array();
						foreach ($country->result() as $row) {
							$options[$row->code] =  $row->name;
						}
						$att = array('name' => 'country_name', 'class' => 'form-control');
						echo form_dropdown('country_name', $options, null, $att);
						?>
						<?php echo form_error('country_name'); ?>
					</div>
					<div class="col-md-6">
						<label class="form-label">
						Provinsi
					</label>
						<?php
						$att = array('name' => 'state_name', 'class' => 'form-control');
						echo form_input($att);
						?>
						<?php echo form_error('state_name'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12">
						<label class="form-label">
						Locality
						</label>
						<?php
						$att = array('name' => 'locality_name', 'class' => 'form-control');
						echo form_input($att);
						?>
						<?php echo form_error('locality_name'); ?>
					</div>
					
				</div>
				<div class="form-group">
					<div class="col-md-6">
						<label class="form-label">
						Organisasi
						</label>
						<?php
						$att = array('name' => 'organization_name', 'class' => 'form-control');
						echo form_input($att);
						?>
						<?php echo form_error('organization_name'); ?>
					</div>
					<div class="col-md-6">
						<label class="form-label">
						Unit Organisasi
					</label>
						<?php
						$att = array('name' => 'organizational_unit', 'class' => 'form-control');
						echo form_input($att);
						?>
						<?php echo form_error('organizational_unit'); ?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12 text-center" style="padding:10px;">
						<?php
						$att = ['class' => 'btn btn-primary', 'value' => 'Buat Certificate'];
						echo form_submit($att);
						?>
					</div>
				</div>
				<?php 
					echo form_close();
				?>
			</div>
		</div>
		
		
	</div>
</div>
