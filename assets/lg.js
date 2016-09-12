var isUsernameVaild = false;

// check username exist==============


$.validator.addMethod("loginRegex", function(value, element) {
        return this.optional(element) || /^[a-z0-9\-]+$/i.test(value);
}, "Tên đăng nhập có chứa ký tự đặc biệt");
$(document).ready(function() {
	$(".new_account_link").click(function() {
		$(".r_msgTxt").css("display", "none");
		$(".login_content").fadeOut(200, function() {
			$(".register_content").fadeIn(200);
		});
	});

	$(".sign_in_link").click(function() {
		$(".l_msgTxt").css("display", "none");
		$(".register_content").fadeOut(200, function() {
			$(".login_content").fadeIn(200);
		});
	});

	$("#r_username").on("keyup blur",function() {
		isUsernameVaild = false;
		$.ajax({
	        url: 'checkExistsUsername',
	        method: 'POST',
	        data: {
	            username: $(this).val()
	        },
	        dataType: 'text'
	    }).done(function(data) {
	        if (data == "0") {
	        	isUsernameVaild = true;
	        	$(".exist_username_error").css("display", "none");
	        } else {
	        	isUsernameVaild = false;
	        	$(".exist_username_error").css("display", "block");
	        	$(".r_msgTxt").css("display", "block");
	        }
	       
	    }).fail(function(err) {
	    });
	});

	$(".btn_login").click(function() {
		console.log("sdf");
		$(".msg_server").css("display", "none");
	});

	// =========validate=========
	// ==========================
	$("#r-form").validate({
			rules: {
				r_username: {
					required: true,
					minlength: 6,
					maxlength: 100,
					loginRegex: true
					
				},
				r_email: {
					required: true,
					minlength: 6,
					maxlength: 100,
					email: true
				},
				r_password: {
					required: true,
					minlength: 6,
					maxlength: 100
				},
				r_passwordf: {
					required: true,
					equalTo: "#r_password"
				    
				}
			},
			messages: {
				r_username: {
					required: "Nhập tên đăng nhập!",
					minlength: "Tên đăng nhập phải lớn hơn 6 ký tự!",
					maxlength: "Tên đăng nhập phải nhỏ hơn 100 ký tự!",
					loginRegex: "Tên đăng nhập có chứa ký tự đặc biệt!"
				},
				r_email: {
					required: "Nhập email!",
					minlength: "Email phải lớn hơn 6 ký tự!",
					maxlength: "Email phải nhỏ hơn 100 ký tự!",
					email: "Email không hợp lệ!"
				},
				r_password: {
					required: "Nhập mật khẩu!",
					minlength: "Mật khẩu phải lớn hơn 6 ký tự!",
					maxlength: "Mật khẩu phải nhỏ hơn 100 ký tự!"
				},
				r_passwordf: {
					required: "Vui lòng xác nhận lại mật khẩu",
					equalTo: "Mật khẩu không khớp!"
				}

			},
			submitHandler: function(form) {
            	if (isUsernameVaild == true) {
		        	form.submit();
		    	}  
        	},
			errorElement : 'div',
    		errorLabelContainer: '.r_msgTxt'
		});

	$("#l_form").validate({
		rules: {
			username: {
				required: true
			},
			password: {
				required: true
			}
		},
		messages: {
			username: {
				required: "Nhập tên đăng nhập!"
			},
			password: {
				required: "Nhập mật khẩu!"
			}

		},
		submitHandler: function(form) {
	    	form.submit();
    	},
		errorElement : 'div',
		errorLabelContainer: '.l_msgTxt'
	});
});