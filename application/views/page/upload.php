<div class="row">
    <h4 class="header">Certificate Authority</h4>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="list-group">
            <a href="<?php echo base_url('index.php/main/'); ?>" class="list-group-item">Tambahkan Certificate</a>
            <a href="<?php echo base_url('index.php/main/upload'); ?>" class="list-group-item active">Upload Your CSR</a>
            <a href="<?php echo base_url('index.php/main/lists'); ?>" class="list-group-item">Daftar Certificate</a>
            <a href="<?php echo base_url('index.php/home/logout'); ?>" class="list-group-item">Keluar</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Form Upload
            </div>
            <div class="panel-body">
                <?php
                echo form_open_multipart('main/addupload',[ 'class' => 'form' ]);
                ?>
                <div class="form-group">
                    <div class="col-md-6">
                        <label class="form-label">
                            Upload CSR
                        </label>
                        <?php
                        $att = array('name' => 'file_csr', 'class' => 'form-control');
                        echo form_upload($att);
                        ?>
                        <?php echo form_error('common_name'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12 text-center" style="padding:10px;">
                        <?php
                        $att = ['class' => 'btn btn-primary', 'value' => 'Upload Certificate'];
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
