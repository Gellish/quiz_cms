<div id="commonDiv">
	<div class="regForm floatLeft">
		<form action="<?php echo base_url(); ?>front/Client_login/user_registration" method="post" id="login">
			<div class="signUp">
				Sign Up
			</div>
			<div class="fieldCover">
				<input type="text" name="first_name" id="first_name" placeholder="First Name" class="lastFirstName">
				<input type="text" name="last_name" id="last_name" placeholder="Last Name" class="lastFirstName">
			</div>
			<div class="fieldCover">
				<input type="text" name="username" id="username" placeholder="Your Email" class="input_field">
			</div>
			<div class="fieldCover">
				<input type="password" name="password" id="password" placeholder="Password" class="input_field">
			</div>
			<div class="fieldCover">
				<input type="password" name="password" id="password" placeholder="Re-enter Password" class="input_field">
			</div>
			<div class="fieldCover" style="width:85%;">
				<div class="nameField">Date of Birth:</div>
				<select name="birth_day" class="birthSelect" style="margin-left:0px;">
					<option value="">Day</option>
					<?php
					for($i=1; $i<=31; $i++)
					{
						$x = $i<10 ? "0" : " ";
					echo '<option value='.$x.$i.'>'.$x.$i.'</option>';
					}
					?>
				</select>
				<select name="birth_month" class="birthSelect">
					<option value="">Month</option>
					<option value="01">Jan</option>
					<option value="02">Feb</option>
					<option value="03">Mar</option>
					<option value="04">Apr</option>
					<option value="05">May</option>
					<option value="06">Jun</option>
					<option value="07">Jul</option>
					<option value="08">Aug</option>
					<option value="09">Sep</option>
					<option value="10">Oct</option>
					<option value="11">Nov</option>
					<option value="12">Dec</option>
				</select>
				<select name="birth_year" class="birthSelect">
					<option value="">Year</option>
					<?php
					   for ($i=2014; $i>=2000; $i=$i-1)
					   {
					   echo "<option value='$i'>$i</option>";
					   }
					?>
				</select>
			</div> 
			<div class="nameField">
				<input type="radio" name="user_sex" id="user_sex" class="radioField" value="1" />Male
				<input type="radio" name="user_sex" id="user_sex" class="radioField" value="0" />Female
			</div>
			<div class="fieldCover" style="width:78% !important;margin-top:25px;">
				<div><input type="submit" value="Sign Up" class="submitBtn" name="login" /></div>
			</div>
		</form>
	</div>
	<div class="vtlDviDr"></div>
	<div class="regForm floatRight" style="margin-top:105px;text-align:right">
		<form action="<?php echo base_url(); ?>front/Client_login/user_login" method="post" id="login">
			<div class="signUp floatRight">
				Sign in
			</div>
			<div class="fieldCover floatRight">
				<input type="text" name="username" id="username" placeholder="Your Email" class="input_field floatRight">
			</div>
			<div class="fieldCover floatRight">
				<input type="password" name="password" id="password" placeholder="Your Password" class="input_field floatRight">
			</div>
			<div class="fieldCover floatRight" style="width:78% !important;margin-top:15px;">
				<div style="float:left" ><input type="submit" value="Sign in" class="submitBtn floatRight" name="login" /></div>
			</div>
		</form>
	</div>
</div>