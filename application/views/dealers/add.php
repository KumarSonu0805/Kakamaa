
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title"><?= $title ?></h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8">
                                                <?= form_open_multipart('dealers/adddealer/',' onsubmit="return validate();"'); ?>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="name" id="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Mobile</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="mobile" id="mobile" required pattern="[\d]{10}" title="Enter valid 10-digit number">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Email (Login Username)</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="email" id="email" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-none">
                                                        <label class="col-sm-2 col-form-label">Select Location</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" id="location" class="form-control" placeholder="Search for location">
                                                            <div id="map" style="height: 450px"></div>
                                                            <input type="hidden" class="form-control" name="latitude" id="latitude" placeholder="Latitude" >
                                                            <input type="hidden" class="form-control" name="longitude" id="longitude" placeholder="Longitude" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">State</label>
                                                        <div class="col-sm-10">
                                                            <?= form_dropdown('parent_id',$states,'',array('class'=>'form-control','id'=>'parent_id','required'=>'true')); ?>
                                                            <input type="hidden" class="form-control" name="state" id="state" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">District</label>
                                                        <div class="col-sm-10">
                                                            <?= form_dropdown('area_id',[""=>"Select District"],'',array('class'=>'form-control','id'=>'area_id','required'=>'true')); ?>
                                                            <input type="hidden" class="form-control" name="district" id="district">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Pincode</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="pincode" id="pincode" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-none">
                                                        <label class="col-sm-2 col-form-label">Radius</label>
                                                        <div class="col-sm-10">
                                                            <input type="number" min="1" class="form-control" name="radius" id="radius">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Aadhar Image</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="aadhar" id="aadhar" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">PAN</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="pan" id="pan" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="gst" class="col-sm-2 control-label">GST</label>
                                                        <div class="col-sm-10">
                                                            <div class="radio-inline text-success">
                                                                <label>
                                                                    <input type="radio" name="gst" value="Yes" required> Yes
                                                                </label>
                                                            </div>
                                                            <div class="radio-inline text-danger">
                                                                <label>
                                                                    <input type="radio" name="gst" value="No">
                                                                    No
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="form-group row d-none">
                                                        <label class="col-sm-2 col-form-label">GSTIN</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="gst_no" id="gst_no" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Added By</label>
                                                        <div class="col-sm-10">
                                                            <?= form_dropdown('emp_user_id',$sales,'',array('class'=>'form-control','id'=>'emp_user_id','required'=>'true')); ?>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label"></label>
                                                        <div class="col-sm-10">
                                                            <input type="submit" class="btn btn-success waves-effect waves-light" name="adddealer" value="Save Dealer">
                                                        </div>
                                                    </div>
                                                <?= form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

<input type="hidden" id="temp_district">
<script>
	$(document).ready(function(e) {
        $('form').on('change','#parent_id',function(){
            var parent_id=$(this).val();
            var state=$(this).find('option:selected').text();
            $('#state').val(state);
            var district_id=$(this).attr('data-district_id');
            $.ajax({
                type:"post",
                url:"<?= base_url('masterkey/getdistrictdropdown/'); ?>",
                data:{state_id:$(this).val(),district_id:district_id},
                success:function(data){
                    $('#area_id').replaceWith(data);
                    if($('#area_id').val()=='')
                        $('#district').val('');
                    setarea_id();
                }
            });
        });
        $('form').on('change','input[name="gst"]',function(){
            if($(this).val()=='Yes'){
                $('#gst_no').attr('required',true).closest('.row').removeClass('d-none');
            }
            else{
                $('#gst_no').removeAttr('required').closest('.row').addClass('d-none');
            }
        });
        $('form').on('change','#area_id',function(){
            var district=$(this).find('option:selected').text();
            $('#district').val(district);
        });
    });
    function setarea_id(){
        if($('#temp_district').val()!='' && $('#area_id').val()==''){
           var area_id='';
            $.each($("#area_id option"), function(){
                //alert($(this).text()+'=='+$('#temp_district').val())
                if($(this).text()==$('#temp_district').val()){
                    area_id=$(this).val();
                }     
            });
            $('#area_id').val(area_id).trigger('change');
            $('#temp_district').val('');
        }
    }
function getPhoto(input){
    
}
    
    
function validate(){
    if($('#latitude').val()=='' || $('#longitude').val()==''){
        alert("Select Dealer Location!");
        return false;
    }
}
</script>
<script
      src="https://maps.googleapis.com/maps/api/js?key=<?//= MAP_KEY; ?>&callback=showLocation&libraries=places&v=weekly"
      async
    ></script>
<script src="<?= file_url('assets/js/map.js');  ?>" ></script>