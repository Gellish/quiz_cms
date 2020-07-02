<!-- Operator login form start -->
<div id="adminLoginForm">
	<div style="height:auto;overflow:hidden;width:50%;margin:40px auto;border:1px solid #518484;padding:50px;">
	<?php echo form_open('operator/operator_dashboard/do_login',array('id' => 'login'))?>
			<div class="text-center">
				<h2><?php echo display('operator_login_area')?></h2>	
			</div>
			<hr>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('email')?>: </label>
				<div class="col-sm-7">
					<input type="text" name="username" id="username"  placeholder="<?php echo display('email')?>" class="input_field form-control">
				</div>
			</div>
			<div class="form-group row">
				<label for="example-text-input" class="col-sm-3 col-form-label"><?php echo display('password')?>: </label>
				<div class="col-sm-7">
					<input type="password" name="password" id="password"  placeholder="<?php echo display('password')?>" class="input_field form-control">
				</div>
			</div>
			<div class="form-group row text-right">
				<div class="col-sm-7">
					<input type="submit" value="<?php echo display('login')?>" class="btn btn-primary placeMiddle" name="login" />
				</div>
			</div>
		<?php echo form_close()?>
	</div>
</div>
<!-- Operator login form end -->