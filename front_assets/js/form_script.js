jQuery('#formSignup').on('submit',function(e){
	jQuery('.errMsgSign').html('');
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
			var is_checkout = jQuery('#is_checkout').val();
			if(is_checkout == 'yes'){
        window.location.href='checkout';
			}else if(data.status=='success'){
				// jQuery('#login_form_msg').html(data.msg);
        window.location.href='main';
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
				var data = jQuery.parseJSON(result);
				swal("Congratulation!", "Food Item added successfully", "success");
				jQuery('#cart_qty_add_msg_'+attr).html('(Added - '+qty+')');
				jQuery('#totalFoodAdded').html(data.totalFoodAdded);
				jQuery('#totalPrice').html('$ '+data.totalPrice);
				var totalPrs = data.totalPrice;

				if(data.totalFoodAdded == 1){
					var total = qty * data.price;
					var html = '<div class="shopping-cart-content"><ul id="cart_ul"><li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt="" src="'+SITE_FOOD_IMG_CALL+data.images+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.food_name+' </a></h4><h6>Qty: '+qty+'</h6><span>$ '+number_format(total,2)+'</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick="delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li></ul><h4>Total : <span class="shop-total">$ '+number_format(total,2)+'</span></h4><div class="shopping-cart-btn"><button onclick="viewCart()" class="add_to_cart_btn">View Cart</button><button onclick="checkout()" class="add_to_cart_btn">Checkout</button></div></div>';
					jQuery('.header-cart').append(html);
				}else{
					var total = qty * data.price;
					jQuery('#attr_'+attr).remove();
					var html = '<li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt="" src="'+SITE_FOOD_IMG_CALL+data.images+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.food_name+' </a></h4><h6>Qty: '+qty+'</h6><span>$ '+number_format(total,2)+'</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick="delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li>';
					jQuery('#cart_ul').append(html);
					jQuery('.shop-total').html(totalPrs);
				}
			}
		});
	}else{
		swal("Error!", "Please Select Food Attribute and Quantity", "error");
	}
}

function number_format(number, decimals) {
	return number.toFixed(decimals);
}


function delete_cart(id,is_type){
	jQuery.ajax({
		url:FRONTEND_SITE_PATH+'added_to_cart',
		type:'post',
		data:'&attr='+id+'&cart_type=delete',
		success:function(result){
			if(is_type == 'load'){
				window.location.href=window.location.href;
			}else{
				var data = jQuery.parseJSON(result);
				// swal("Congratulation!", "Food Item added successfully", "success");
				// jQuery('#cart_qty_add_msg_'+attr).html('(Added - '+qty+')');
				jQuery('#totalFoodAdded').html(data.totalFoodAdded);
				jQuery('#cart_qty_add_msg_'+id).html('');

				if(data.totalFoodAdded == 0){
					jQuery('.shopping-cart-content').remove();
					jQuery('#totalPrice').html('');
				}else{
					var totalPrs = data.totalPrice;
					jQuery('.shop-total').html(totalPrs);
					jQuery('#attr_'+id).remove();
					jQuery('#totalPrice').html('$ '+data.totalPrice);
				}
			}
		}
	});
}

function viewCart(){
	window.location.href ='cart.php';
}

function checkout(){
	window.location.href ='checkout.php';
}

jQuery('#fromProfile').on('submit',function(e){
	jQuery('#profile_btn').attr('disabled',true);
	jQuery('#form_msg').html('Please Wait!');
  jQuery.ajax({
    url:FRONTEND_SITE_PATH+'update_profile',
    type:'post',
    data:jQuery('#fromProfile').serialize(),
    success:function(result){
      // console.log(result);
      jQuery('#form_msg').html('');
			jQuery('#profile_btn').attr('disabled',false);
      var data = JSON.parse(result);
      if(data.status=='success'){
				jQuery('#cst_header_name').html(jQuery('#cst_fname').val());
				swal("Profile", data.msg, "success");
			}
    }
  });
  e.preventDefault();
});

jQuery('#formPassword').on('submit',function(e){
	jQuery('#password_btn').attr('disabled',true);
	jQuery('#password_form_msg').html('Please Wait!');
  jQuery.ajax({
    url:FRONTEND_SITE_PATH+'update_profile',
    type:'post',
    data:jQuery('#formPassword').serialize(),
    success:function(result){
      //console.log(result);
      jQuery('#password_form_msg').html('');
			jQuery('#password_btn').attr('disabled',false);
      var data = JSON.parse(result);
      if(data.status=='success'){
				swal("Password", data.msg, "success");
			}
			if(data.status=='error'){
				swal("Error", data.msg, "error");
			}
    }
  });
  e.preventDefault();
});