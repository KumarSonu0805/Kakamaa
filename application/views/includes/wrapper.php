    <?php
        if($page_type=='auth'){
            !empty($content)?$this->load->view($content):'';
        }
        else{
    ?>
        <?php
            if(!empty($content_script)){
                foreach($content_script as $key=>$script){
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
        <?php !empty($content)?$this->load->view($content):''; ?>
    <?php
        }
    ?>