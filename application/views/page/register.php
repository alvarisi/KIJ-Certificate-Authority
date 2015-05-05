<div class="row">
	<h4 class="header">Certificate Authority</h4>
</div>
<div class="row">
	<div class="col-md-offset-4 col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Daftar
			</div>
			<div class="panel-body">
				<?php
				echo form_open_multipart('home/postRegister',[ 'class' => 'form' ]);
				?>
				<div class="form-group">
					
						<label class="form-label">
						Email
						</label>
						<?php
						$att = array('name' => 'email', 'class' => 'form-control');
						echo form_input($att);
						?>
						<?php echo form_error('email'); ?>
					
				</div>
				<div class="form-group">
					
						<label class="form-label">
						Password
						</label>
						<?php
						$att = array('name' => 'password', 'class' => 'form-control');
						echo form_password($att);
						?>
						<?php echo form_error('password'); ?>
					
				</div>
				<div class="form-group">
					
						<label class="form-label">
						Konfirmasi Password
						</label>
						<?php
						$att = array('name' => 'cpassword', 'class' => 'form-control');
						echo form_password($att);
						?>
						<?php echo form_error('cpassword'); ?>
					
				</div>
				
				<div class="form-group">
					<div class="col-md-12 text-center" style="padding:10px;">
						<?php
						$att = ['class' => 'btn btn-primary', 'value' => 'Daftar'];
						echo form_submit($att);
						?>
						<a class="btn btn-info" href="<?php echo base_url(); ?>index.php/home">Login</a>
					</div>
				</div>
				<?php 
					echo form_close();
				?>
			</div>
		</div>
		
		
	</div>
</div>
