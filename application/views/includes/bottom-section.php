
        <?php
            if($page_type!='auth'){
        ?>
        </div>
        <?php
            }
        ?>
        <?php
            if($this->session->flashdata('msg')!==NULL || $this->session->flashdata('err_msg')!==NULL){
                $msg=$this->session->flashdata('msg');
                $err_msg=$this->session->flashdata('err_msg');
        ?>
        <div class="toastr-notify d-none" data-position="toast-top-center" data-status="<?= !empty($msg)?'success':'error'; ?>" data-title="<?= !empty($msg)?'Success':'Error'; ?>"><?= !empty($msg)?$msg:$err_msg; ?></div>
        <?php
            }
        ?>
        <!-- Bootstrap 4 -->
        <script src="<?= file_url('includes/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
        <!-- AdminLTE App -->
        <script src="<?= file_url('includes/dist/js/adminlte.min.js'); ?>"></script>
        <?php
            if(!empty($bottom_script)){
                foreach($bottom_script as $key=>$script){
                    if($key=="link"){
                        if(is_array($script)){
                            foreach($script as $single_script){
                                echo "<script src='$single_script'></script>\n\t";
                            }
                        }
                        else{
                            echo "<script src='$script'></script>\n\t";
                        }
                    }
                    elseif($key=="file"){
                        if(is_array($script)){
                            foreach($script as $single_script){
                                echo "<script src='".file_url("$single_script")."'></script>\n\t";
                            }
                        }
                        else{
                            echo "<script src='".file_url("$script")."'></script>\n\t";
                        }
                    }
                }
            }
        ?>
        <!-- Custom JS -->
        <script src="<?= file_url('includes/custom/custom.js'); ?>"></script>
    </body>
</html>
