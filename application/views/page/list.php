<div class="row">
	<h4 class="header">Certificate Authority</h4>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="list-group">
			<?php if($this->session->userdata('email') != 'admin@kij.com') {
                echo '<a href="'.base_url('index.php/main/').'" class="list-group-item">Tambahkan Certificate</a>';
            }?>
			<a href="<?php echo base_url('index.php/main/lists'); ?>" class="list-group-item active">Daftar Certificate</a>
            <?php if($this->session->userdata('email') == 'admin@kij.com') {
                echo '<a href="#" class="list-group-item">Revoke Certificate</a>';
            }?>
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
                            <th>Signed</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1; foreach($content->result() as $row){ ?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->common_name ?></td>
							<td><?php echo $row->email_address ?></td>
							<td><?php echo $row->organization_name ?></td>
                            <td><?php
                                if($this->session->userdata('email') == 'admin@kij.com'){?>
                                    <div class="btn-group">
                                        <button class="btn btn-info" type="button">
                                            <?php
                                                if($row->sign_stat == 0) echo 'Unsigned';
                                                else echo 'Signed';
                                            ?></button>
                                        <button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <?php
                                                if($row->sign_stat == 0) echo '<li><a href="#" target="_blank">Sign</a></li>';
                                                else echo '<li><a href="#" target="_blank">Unsign</a></li>';
                                            ?>
                                        </ul>
                                    </div>
                                <?php }
                                else{
                                    if($row->sign_stat == 0) echo 'Unsigned CA';
                                    else echo 'Signed CA';
                                }
                                ?></td>
							<td>
								<div class="btn-group">
								<button class="btn btn-info" type="button">Action</button>
									<button data-toggle="dropdown" class="btn btn-info dropdown-toggle" type="button">
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<ul role="menu" class="dropdown-menu">
										<!--<li><a href="<?php echo base_url(); ?>index.php/main/download/private-key/<?php echo $row->id; ?>" target="_blank">Download Private Key</a></li>-->
										<li><a href="<?php echo base_url(); ?>index.php/main/download/cert/<?php echo $row->id; ?>" target="_blank">Download CSR</a></li>
                                        <li><a href="<?php echo base_url(); ?>index.php/main/download/key-pair/<?php echo $row->id; ?>" target="_blank">Download Key Pair</a></li>
									</ul>
								</div>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
		
		
	</div>
</div>
