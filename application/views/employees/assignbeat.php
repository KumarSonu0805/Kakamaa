                                
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header"><?= $title; ?></div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <?= form_open_multipart('employees/savebeatassignment'); ?>
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <?= create_form_input('date','date','Date',true,date('Y-m-d'),['id'=>'date']); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?= create_form_input('select','emp_id','DSO',true,'',['id'=>'emp_id'],employee_dropdown("e_id","DSO")); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?= create_form_input('select','','Area',true,$this->input->get('area_id'),['id'=>'area_id'],area_dropdown()); ?>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?= create_form_input('select','beat_id','Beat',true,$this->input->get('beat_id'),['id'=>'beat_id'],beat_dropdown()); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-md-3">
                                                                    <?= create_form_input('number','target','Target',true,'',['id'=>'target']); ?>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-2">
                                                                <div class="col-12">
                                                                    <input type="submit" name="savebeatassignment" class="btn btn-sm btn-success" value="Assign Beat">
                                                                </div>
                                                            </div>
                                                        <?= form_close(); ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div id="tabulator-table"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

<script>
                                $(document).ready(function(e) {

                                    var url="<?= base_url('dealers/dealerlist/?type=data&area_id=-1'); ?>";
                                    var columns=[
                                            { 
                                                title: "Sl.No.", 
                                                field: "serial", 
                                                type: "auto"
                                            },
                                            { title: "Name", field: "name" },
                                            { title: "Mobile", field: "mobile" },
                                            { title: "Email", field: "email" },
                                            { 
                                                title: "Address", 
                                                field: "address", 
                                                width:250,
                                                formatter: function(cell) {
                                                    let address = cell.getValue();
                                                    return address;
                                                }  
                                            },
                                            { title: "Area", field: "area_name" },
                                            { title: "Beat", field: "beat_name" },
                                            { 
                                                title: "Status", 
                                                field: "status", 
                                                formatter: function(cell) {
                                                    let user_status = cell.getValue();
                                                    let status='<i class="fa fa-times text-danger"></i>';
                                                    if(user_status==1){
                                                        status='<i class="fa fa-check text-success"></i>';
                                                    }
                                                    return status;
                                                } 
                                            },
                                            { 
                                                title: "Action", 
                                                field: "id", 
                                                formatter: function(cell) {
                                                    let id = cell.getValue();
                                                    return '';
                                                } 
                                            }
                                        ];
                                    
                                    var pagination={
                                        sizes:[10, 20, 50, 100]
                                    }
                                    
                                    var table=createTabulator('tabulator-table',url,columns,pagination);
                                    
                                    function refreshTableData(newUrl='') {
                                        url=newUrl!=''?newUrl:url;
                                        table.replaceData(url);
                                    }
                                    $('body').on('keyup','#searchInput',function(){
                                        let value = $(this).val().toLowerCase();
                                        console.log(value);
                                        table.setFilter(function(data) {
                                            return Object.values(data).some(field => 
                                                field !== null && field !== undefined && field.toString().toLowerCase().includes(value)
                                            );
                                        });
                                    });

                                    $('body').on('click','#clearSearch',function(){
                                        document.getElementById("searchInput").value = "";
                                        table.clearFilter();
                                    });

                                    $('body').on('change','#area_id',function(){
                                        var area_id=$(this).val();
                                        $.ajax({
                                            type:"post",
                                            url:"<?= base_url('masterkey/getbeatdropdown/'); ?>",
                                            data:{area_id:$(this).val(),beat_id:''},
                                            success:function(data){
                                                $('#beat_id').replaceWith(data);
                                            }
                                        });
                                        var dealer_url="<?= base_url('dealers/dealerlist/?type=data'); ?>&area_id="+area_id;
                                        refreshTableData(dealer_url);
                                    });
                                    $('body').on('change','#beat_id',function(){
                                        var area_id=$('#area_id').val();
                                        var beat_id=$(this).val();
                                        var dealer_url="<?= base_url('dealers/dealerlist/?type=data'); ?>&area_id="+area_id+"&beat_id="+beat_id;
                                        refreshTableData(dealer_url);
                                    });
                                });
                            </script>