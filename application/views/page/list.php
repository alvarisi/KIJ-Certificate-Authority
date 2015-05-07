<div class="row">
	<h4 class="header">Certificate Authority</h4>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
            <?php if($this->session->userdata('isUser')){ ?>
                <a href="<?php echo base_url('index.php/main/'); ?>" class="list-group-item">Tambahkan Certificate</a>
            <?php } ?>
            <a href="<?php echo base_url('index.php/main/upload'); ?>" class="list-group-item">Upload Your CSR</a>
			<a href="<?php echo base_url('index.php/main/lists'); ?>" class="list-group-item active">Daftar Certificate</a>
			<a href="<?php echo base_url('index.php/home/logout'); ?>" class="list-group-item">Keluar</a>
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
							<th>Nama</th>
							<th>Email</th>
							<th>Perusahaan</th>
                            <th>Status</th>
							<th>Download</th>
							<?php if($this->session->userdata('isAdmin')){ ?>
							<th>Action</th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach($content->result() as $row){ ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->common_name ?></td>
							<td><?php echo $row->email_address ?></td>
							<td><?php echo $row->organization_name ?></td>
                            <td>
                            	<?php
                            		switch ($row->status) {
                            			case '0':
                            				echo 'Pending';
                            				break;
                            			case '1':
                            				echo 'Signed';
                                            break;
                                        case '2':
                                            echo 'Revoked';
                                            break;
                            			default:
                            				echo "Pending";
                            				break;
                            		}
                            	?>
                            </td>
							<td>
								<div class="btn-group">
								<button class="btn btn-info" type="button">Action</button>
									<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul role="menu" class="dropdown-menu">
										<li><a href="<?php echo base_url(); ?>index.php/main/download/csr/<?php echo $row->id; ?>" target="_blank">Download Self CSR</a></li>
                                        <li><a href="<?php echo base_url(); ?>index.php/main/download/key-pair/<?php echo $row->id; ?>" target="_blank">Download Key Pair</a></li>
										<?php if($row->status=='1'){ ?>
										<li><a href="<?php echo base_url(); ?>index.php/main/download/cert/<?php echo $row->id; ?>" target="_blank">Download CA</a></li>
										<?php } ?>
									</ul>
								</div>
							</td>
							<?php if($this->session->userdata('isAdmin')){ ?>
							<td>
								<?php
								$options = array(
									'0' => 'Pending',
									'1' => 'Sign',
                                    '2' => 'Revoke'
								);
								echo form_dropdown('status',$options, $row->status, array('class' => 'form-control','data-idrecord' => $row->id, 'onChange' => 'changeStatus(this)'));
								?>
							</td>
							<?php } ?>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function changeStatus(x) {
		var id = x.getAttribute('data-idrecord');
		var val = x.value;
		window.location.href = "<?php echo base_url(); ?>index.php/main/changeStatus/" + id + "/" + val;
	}
</script>