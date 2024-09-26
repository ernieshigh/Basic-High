<?php
/***
	*
	*  Hard code form into Contavt us page tempalte
	*
***/
					
include get_theme_file_path('/inc/high-form.php');  

?>

<style>
	.robot{display: none;}
</style>
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
						 <label style="display: none">why are you checking this?<input type="text" id="high_human" name="high_human" class="robot"></label> 
				 	
					<input id="high_submit" name="high_submit" type="submit"> 
				</form>
				
				
				<script>
				 
				
				let high_form = document.getElementById('high_contact'); 
				let high_name = document.getElementById('high_name'); 
				let high_email = document.getElementById('high_email');  
				let high_reason = document.getElementById('high_reason');
				let high_subject = document.getElementById('high_subject');
				let high_message = document.getElementById('high_message');
				let high_term = document.getElementById('high_term');      
				let submit_button = document.getElementById('high_submit'); 
				
				let high_thanks = document.getElementById('high_thanks'); 
				
				const emailIsValid = email => {
				  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
				}
				 
 
				function high_validate(input){
													 											   
					if (input.value.length < 1) {        
						input.style.borderColor = '#F70000';
																	 
						input.removeAttribute('valid') 
						input.setAttribute('invalid', 'invalid')  
						input.parentNode.querySelector('small.error-message').innerHTML = 'You\'re missing something';
					} else if (input.type == "email") {         
					 
						if (emailIsValid(high_email.value)) {                        
							high_email.setAttribute('valid', 'valid')
							high_email.style.borderColor = '#5bb959';                                                               
							input.parentNode.querySelector('small.error-message').innerHTML = '';
						} else {
							high_email.removeAttribute('valid') 
							high_email.style.borderColor = '#f70000'; 
							input.parentNode.querySelector('small.error-message').innerHTML = 'Please enter valid email address'; 
						} 
					} else {                               
					 
						input.removeAttribute('invalid')  
						input.setAttribute('valid', 'valid')  
						input.style.borderColor = '#5bb959';
						input.parentNode.querySelector('small.error-message').innerHTML = '';
					}
					
				}
				 
				const validate = (e) => {
				  e.preventDefault();
				   
				  if (high_name.value === "") {
					
					high_name.parentNode.querySelector('small.error-message').innerHTML = 'You have a name?';
					high_name.style.borderColor = '#F70000';
					return false;
				  }
					
				  if (high_email.value === "") {
					
					high_email.parentNode.querySelector('small.error-message').innerHTML = 'You need an email';
					high_email.style.borderColor = '#F70000'; 
					return false;
				  }
				  if (!emailIsValid(high_email.value)) {
					high_email.parentNode.querySelector('small.error-message').innerHTML = 'Please enter a valid email address';
					high_email.style.borderColor = '#F70000';
					high_email.focus();
					return false;
				  }                     
				  
				  if (high_reason.value === "") {
					
					high_reason.parentNode.querySelector('small.error-message').innerHTML = 'Please make a selection';
					high_reason.style.borderColor = '#F70000';
					return false;
				  }
				  
				  if (high_subject.value === "") {
					
					high_subject.parentNode.querySelector('small.error-message').innerHTML = 'Please add a subject to discuss.';
					high_subject.style.borderColor = '#F70000';
					return false;
				  }
				  
				  if (high_message.value === "") {
					
					high_message.parentNode.querySelector('small.error-message').innerHTML = 'What have you got on your mind?';
					high_message.style.borderColor = '#F70000';
					return false;
				  }    
				  if (high_term.checked == false) {
					high_term.parentNode.querySelector('small.error-message').innerHTML = 'You gotta check the box';
					high_term.style.borderColor = '#F70000';
					return false;
				  }
				  
				  high_thanks_message();
				 // alert('wtf')
				  //return true; // Can submit the form data to the server
				}
				
				function high_thanks_message() {
					
					high_form.style.display = 'none';
					high_thanks.style.display = 'block';
					
				}

						 
			 submit_button.addEventListener('click', validate);	
				 
				</script> 
			</section>
	</div>