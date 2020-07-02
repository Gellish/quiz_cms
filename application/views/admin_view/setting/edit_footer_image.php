<!-- Edit footer image start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('footer_image_update')?></div>
</div>
<?php echo form_open('admin/Csetting/update_image_url/',array('class' => 'well form-horizontal','enctype' => 'multipart/form-data' ))?>
	   <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="first_image" class="col-sm-4 col-form-label"><?php echo display('image_1')?> :</label>
                <div class="col-sm-7">
                    <input type="file" name="first_image" id="first_image" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="first_url" class="col-sm-4 col-form-label"><?php echo display('image_url_1')?> :</label>
                <div class="col-sm-7">
                    <input type="text" name="first_url" id="first_url" class="form-control" value="{first_url}">
                </div>
            </div>
            <div class="form-group row">
                <label for="first_image" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-7">
                    <img src="{first_image}" class="img-responsive">
                </div>
            </div>
            
            <div class="form-group row">
                <label for="second_image" class="col-sm-4 col-form-label"><?php echo display('image_2')?> :</label>
                <div class="col-sm-7">
                    <input type="file" name="second_image" id="second_image" class="form-control">
                </div>
            </div>
             <div class="form-group row">
                <label for="second_url" class="col-sm-4 col-form-label"><?php echo display('image_url_2')?> :</label>
                <div class="col-sm-7">
                    <input type="text" name="second_url" id="second_url" class="form-control" value="{second_url}">
                </div>
            </div>
            <div class="form-group row">
                <label for="logo" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-7">
                    <img src="{second_image}" class="img-responsive">
                </div>
            </div>
           
            <div class="form-group row">
                <label for="third_image" class="col-sm-4 col-form-label"><?php echo display('image_3')?> :</label>
                <div class="col-sm-7">
                    <input type="file" name="third_image" id="third_image" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="third_url" class="col-sm-4 col-form-label"><?php echo display('image_url_3')?> :</label>
                <div class="col-sm-7">
                    <input type="text" name="third_url" id="third_url" class="form-control" value="{third_url}">
                </div>
            </div>
            <div class="form-group row">
                <label for="logo" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-7">
                    <img src="{third_image}" class="img-responsive">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-11">
                    <input type="hidden" name="id" id="id" value="{id}" required>
                    <button type="submit" class="btn btn-primary" name="add-course"><?php echo display('save_changes')?></button>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close()?>
<!-- Edit footer image end -->