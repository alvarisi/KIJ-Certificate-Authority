<div class="row">
	<h4 class="header">Certificate Authority</h4>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
          	<a href="<?php echo base_url('index.php/main/'); ?>" class="list-group-item">Tambahkan Certificate</a>
          	<a href="<?php echo base_url('index.php/main/lists'); ?>" class="list-group-item active">Daftar Certificate</a>
        </div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-primary">
			<div class="panel-heading">
				Daftar Certificate Authority
			</div>
			<div class="panel-body">
				<table class="table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Perusahaan</th>
							<th>Hashing</th>
							<th>Valid</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($content->result() as $row){ ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		
		
	</div>
</div>