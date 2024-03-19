jQuery('#formSignup').on('submit',function(e){
	jQuery('.errMsg').html('');
	jQuery('#signup').attr('disabled',true);
	jQuery('#wait_msg').html('Please Wait!');
	jQuery('.passMsg').html('');
  jQuery.ajax({
    url:FRONTEND_SITE_PATH+'login_signup_submit',
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
    url:FRONTEND_SITE_PATH+'login_signup_submit',
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

function click_chkbox(id){
	var mnu_itm = jQuery('#mnu_itm').val();
	var verify = mnu_itm.search(" : "+ id);
	if(verify != '-1'){
		mnu_itm = mnu_itm.replace(" : "+ id,'');
	}else{
		mnu_itm = mnu_itm+" : "+ id;
	} 
	jQuery('#mnu_itm').val(mnu_itm);
	jQuery('#menuItm')[0].submit();
}

function setFoodType(food_type){
	jQuery('#food_type').val(food_type);
	jQuery('#menuItm')[0].submit();
}

function add_to_cart(id,cart_type){
	var qty =jQuery('#qty'+id).val();
	var attr =jQuery('input[name="radio'+id+'"]:checked').val();
	var is_attr_checked= '';
	if(typeof attr === 'undefined'){
		is_attr_checked = 'no';
	}
	if(qty > 0 && is_attr_checked != 'no'){
		jQuery.ajax({
			url:FRONTEND_SITE_PATH+'added_to_cart',
			type:'post',
			data:'qty='+qty+'&attr='+attr+'&cart_type='+cart_type,
			success:function(result){
				swal("Congratulation!", "Food Item added successfully", "success");
				jQuery('#cart_qty_add_msg_'+attr).html('(Added - '+qty+')');
			}
		});
	}else{
		swal("Error!", "Please Select Food Attribute and Quantity", "error");
	}
}