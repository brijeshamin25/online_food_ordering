jQuery('#formSignup').on('submit',function(e){
	jQuery('.errMsg').html('');
	jQuery('#signup').attr('disabled',true);
	jQuery('#wait_msg').html('Please Wait!');
	jQuery('.passMsg').html('');
  jQuery.ajax({
    url:'login_signup_submit.php',
    type:'post',
    data:jQuery('#formSignup').serialize(),
    success:function(result){
      // console.log(result);
      jQuery('#wait_msg').html('');
      jQuery('#signup_form_msg').html('');
			jQuery('#signup').attr('disabled',false);

      var data = JSON.parse(result);
			if(data.status=='error'){
				jQuery('#'+data.field).html(data.msg);
			}
      if(data.status=='success'){
				jQuery('#'+data.field).html(data.msg);
        jQuery('#formSignup') [0].reset();
			}
    }
  });
  e.preventDefault();
});



jQuery('#formLogin').on('submit',function(e){
	jQuery('.errMsg').html('');
	jQuery('#login_submit_btn').attr('disabled',true);
	jQuery('#login_form_msg').html('Please Wait!');
  jQuery.ajax({
    url:'login_signup_submit.php',
    type:'post',
    data:jQuery('#formLogin').serialize(),
    success:function(result){
			// console.log("result from server:",result);
			jQuery('#login_form_msg').html('');
			jQuery('#login_submit_btn').attr('disabled',false);

      var data = JSON.parse(result);
			if(data.status=='error'){
				jQuery('#email_error').html(data.msg);
			}
      if(data.status=='success'){
				// jQuery('#login_form_msg').html(data.msg);
        window.location.href='index.php';
			}
    }
  });
  e.preventDefault();
});
