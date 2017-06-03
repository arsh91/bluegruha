<?php
global $userID;
$first_name = $last_name = $user_email = $user_mobile = '';
if(!empty($userID)){
	$first_name             =   get_the_author_meta( 'first_name' , $userID );
	$last_name              =   get_the_author_meta( 'last_name' , $userID );
	$user_email             =   get_the_author_meta( 'user_email' , $userID );
	$user_mobile            =   get_the_author_meta( 'mobile' , $userID );
}
?>
<div class="col-md-12 headingPanel">
	<h3>Please Enter Your Contact Details</h3>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Name *</label>
	<?php
		if(!empty($userID)){
	?>
			<input type="text" class="form-control agent_name" placeholder="John Doe" value="<?php echo $first_name.' '.$last_name; ?>" readonly="true" />
	<?php
		}else{
	?>
			<input type="text" class="form-control agent_name" placeholder="John Doe" name="agent_name" id = "agent_name">
	<?php } ?>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Phone Number</label>
	<?php
		if(!empty($user_mobile)){
	?>
		<input type="text" class="form-control" placeholder="(555)555-5555" value="<?php echo $user_mobile; ?>" readonly="true" />
	<?php }else{ ?>
		<input type="text" class="form-control" placeholder="(555)555-5555" name="agent_phone" />
	<?php } ?>
</div>
<div class="form-group col-md-6">
	<label class="control-label">Email *</label>
	<?php
		if(!empty($userID)){
	?>
			<input type="email" class="form-control agent_user_email" id="agent_user_email" style="float:right;margin:0;" value="<?php echo $user_email; ?>" readonly="true" />
	<?php }else{ ?>
			<input type="email" class="form-control agent_user_email" name="agent_email" id="agent_user_email" style="float:right;margin:0;" />
	<?php } ?>
</div>
<?php
	if(empty($userID)){
?>
	<div>
		<div class="form-group col-md-6">
			<span class="verification" id="varify_cont_email">Verify your email</span>
		</div>
		<div class="form-group col-md-6 hide">
			<label class="control-label">One time password (OTP)</label>
			<input type="text" class="form-control otpField" placeholder="Please enter your OTP" name="otp" id="agent_contact_otp" size="4" />
		</div>
	</div>
<?php } ?>
<div class="col-md-6">
	<div class="alert-box error">
		<div class="alert-message" id="alert-agent-contact"></div>
	</div> 
</div>