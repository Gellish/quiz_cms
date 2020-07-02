<!-- Edit setting start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('update_web_setting')?></div>
</div>
<?php echo form_open('admin/Csetting/update_setting/',array('class' => 'well form-horizontal','id' => 'course_add','enctype' => 'multipart/form-data' ))?>
	   <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="logo" class="col-sm-4 col-form-label"><?php echo display('site_logo')?> :</label>
                <div class="col-sm-7">
                    <input type="file" name="logo" id="logo" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="logo" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-7">
                    <img src="{logo}" height="100" width="100">
                    <input type="hidden" value="{logo}" name="old_logo">
                </div>
            </div>
            <div class="form-group row">
                <label for="favicon" class="col-sm-4 col-form-label"><?php echo display('favicon')?> :</label>
                <div class="col-sm-7">
                    <input type="file" name="favicon" id="favicon" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="favicon" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-7">
                    <img src="{favicon}" height="100" width="100">
                    <input type="hidden" value="{favicon}" name="old_favicon">
                </div>
            </div>

            <div class="form-group row">
                <label for="back_image" class="col-sm-4 col-form-label"><?php echo display('back_image')?> :</label>
                <div class="col-sm-7">
                    <input type="file" name="back_image" id="back_image" class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label for="logo" class="col-sm-0 col-form-label"></label>
                <div class="col-sm-12">
                    <img src="{back_image}" height="200" width="100%">
                    <input type="hidden" value="{back_image}" name="old_back_image">
                </div>
            </div>
            <div class="form-group row">
                <label for="copyright_text" class="col-sm-4 col-form-label"><?php echo display('copyright_text')?> :</label>
                <div class="col-sm-7">
                    <input type="text" name="copyright" id="copyright_text" value="{copyright}" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="link" class="col-sm-4 col-form-label"><?php echo display('site_link')?> :</label>
                <div class="col-sm-7">
                    <input type="text" name="link" id="link" class="form-control" required value="{link}">
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
<!-- Edit setting end -->