<?php
/***
	*
	*  Hard code form into Contavt us page tempalte
	*
***/
					
include get_theme_file_path('/inc/high-form.php');  

?>
	<div class="container page-container">
		
		<div class="page-meta" role="header"><h1 class="page-title"> <?php  get_the_title(); ?> </h1></div> 
			
			<article class="page-entry"> 
			
					<?php the_content(); ?> 
					
			</article> 
			
			<section class="form-section">
				<div id="high_thanks" style="display: none;">
					<h2> Thank you for reaching out</h2>
					<p> It takes me a day or so to answer these. </p>
				
				</div>
				<form id="high_contact" class="high-form contact-form" action="" method="POST" >
					<div class="form-control">
						<label for="high_name">Name: <span class="red">*</span> </label><small class="error-message"></small><input onblur="high_validate(this)" type="text" id="high_name" name="high_name"  >
					 </div>
					<div class="form-control">	
						<label for="high_email">Email: <span class="red">*</span> </label><small class="error-message"></small><input onblur="high_validate(this)" type="email" id="high_email" name="high_email" > 
					</div>
					<div class="form-control">
						<label for="high_reason">Reason for contacing me<span class="red">*</span></label> <small class="error-message"></small>
						<select id="high_reason" name="high_reason" onblur="high_validate(this)"  >
								<option value="">Choose a reason</option>
								<option value="Looking to get an estimate">Looking to get an estimate</option>
								<option value="Have a question">Have a question</option>
								<option value="Just want to talk to someone">Just want to talk to someone</option>
							</select>  
					 </div>
					<div class="form-control">	
						<label for="high_subject">Subject: <span class="red" class="red">*</span> </label><small class="error-message"></small><input onblur="high_validate(this)" type="text" id="high_subject" name="high_subject"  >
					 </div>
					<div class="form-control">		
						<label for="high_message">Message: <span class="red">*</span></label><small class="error-message"></small> <textarea  id="high_message" name="high_message" onblur="high_validate(this)"  ></textarea> 
					</div>
					<div class="form-control"> 
						<label for="high_term" class="small-text"><small class="error-message"></small>  
						<input type="checkbox" id="high_term" name="high_term" onblur="high_validate(this)"  > 	
						I understand that this form is for demostrative purposes. It does save my input to the database. However, your information will not be used in any way, shape or form and will be automatically deleted in 24hrs. Ernies High does not use cookies. <span class="red" class="red">*</span> </label>
					</div> 		
						 <label style="display: none">why are you checking this?<input type="text" style="display: none;" id="high_human" name="high_human"></label> 
				 	
					<input id="high_submit" name="high_submit" type="submit"> 
				</form>
					<script>
				  
			function onSubmit(token) {
				document.getElementById("high_contact").submit();
			}
				 
				</script> 
			</section>
	</div>