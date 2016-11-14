<div class="col-md-12 headingPanel">
	<h3>Please Enter Your Contact Details</h3>
</div>

<div class="form-group col-md-6">
	<label class="control-label">Name *</label>
	<input type="text" class="form-control" placeholder="John Doe" name="agent_name" id = "agent_name">
</div>
<div class="form-group col-md-6">
	<label class="control-label">Phone Number</label>
	<input type="text" class="form-control" placeholder="(555)555-5555" name="agent_phone">
</div>
<div class="form-group col-md-6">
	<label class="control-label">Email *</label>
	<input type="email" class="form-control" name="agent_email" id="agent_user_email" style="float:right;margin:0;">
</div>
<div>
	<div class="form-group col-md-6">
		<span class="verification" id="varify_cont_email">Verify your email</span>
	</div>
	<div class="form-group col-md-6">
		<label class="control-label">One Time Password (OTP)</label>
		<input type="text" class="form-control" placeholder="Please enter your OTP" name="otp" id="agent_contact_otp">
	</div>
</div>
<div class="col-md-6">
	<div class="alert-box error">
		<div class="alert-message" id="alert-agent-contact"></div>
	</div> 
</div>