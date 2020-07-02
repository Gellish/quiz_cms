<!-- Edit advertisement start -->
<div class="well" style="margin-top: 10px;">
	<div style="font-size:25px;font-weight:bold;"><?php echo display('edit_advertisement')?></div>
</div>
<?php echo form_open('admin/Cadvertisement/update_advertisement/',array('class' => 'well form-horizontal','id' => 'course_add','enctype' => 'multipart/form-data' ))?>
	<div class="row">
		<div class="col-md-4">
            <div class="control-group">
                <label><?php echo display('ads_position') ?></label>
                <select name="add_position" class="form-control" id="add_position" required="1">
                    <option value=""><?php echo display('select_ads_position') ?></option>
                    <option value="Top Ads"><?php echo display('top_ads') ?></option>
                    <option value="Left Ads"><?php echo display('left_ads') ?></option>
                </select>
            </div>
        	<br>
			<div class="control-group">
                <label><?php echo display('ads_type') ?></label>
                <select name="ad_type" class="form-control" id="ad_type" required="1" onchange="set_ad_type(this.value)">
                    <option value=""><?php echo display('select_ads_type') ?></option>
                    <option value="1"><?php echo display('embed_code') ?></option>
                    <option value="2"><?php echo display('ads_image') ?></option>
                </select>
            </div>
        	<br>
        	<div class="embed_code_ad" style="display: block;">
                <div class="control-group">
                    <label><?php echo display('embed_code') ?></label>
                    <textarea name="add_code" class="form-control">
                    </textarea>
                </div> 
            </div>
            <br>
        	<div class="img_ad" style="display: none;">
                <div class="control-group">
					<label for="chapterName"><?php echo display('select_file') ?>:</label>
					<div class="controls">
						<input name="add_image" class="form-control" type="file">
					</div>
				</div>
				<br>
				<div class="control-group">
					<label for="add_url"><?php echo display('add_url') ?>:</label>
					<input type="text" name="add_url" id="add_url" class="form-control" placeholder="<?php echo display('add_url') ?>">
				</div> 
        	</div>
        	<br>
			<div class="control-group">
				<div class="controls">
					<input type="submit" class="btn btn-primary" value="<?php echo display('save') ?>" name="add-chapter">
					<input type="submit" class="btn btn-default" value="<?php echo display('save_another') ?>" name="add-chapter-another">
				</div>
			</div>
		</div>
	</div>
<?php echo form_close()?>
<!-- Edit advertisement end -->


<!--Select ads type by javascript start-->
<script type="text/javascript">
    $(document).ready(function() {
        $('.img_ad').css({'display': 'none'});
        $('.embed_code_ad').css({'display': 'none'});

        $('#ad_type').on('change', function() {
            var ad_type = $('#ad_type option:selected').val();
            if (ad_type == 1) {
                $('.img_ad').css({'display': 'none'});
                $('.embed_code_ad').css({'display': 'block'});
            }
            else if (ad_type == 2) {
                $('.img_ad').css({'display': 'block'});
                $('.embed_code_ad').css({'display': 'none'});
            }
            else {
                $('.img_ad').css({'display': 'none'});
                $('.embed_code_ad').css({'display': 'none'});
            }
        });
    });
</script>
<!--Select ads type by javascript end-->
