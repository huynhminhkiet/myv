$(document).ready(function() {
	firstLoading();
	firstResize();

	$(".eng_key").on("keyup", function() {
		translate($(this).val());
	});

	$(".eng_voc").on("click", "a", function() {
		translateToVi($(this).attr("value"));
	});

	$(".vi_voc").on("click", "font", function() {
		chooseMean($(this));
	});

	$(document).mouseup(function (e) {
	    hideShowVocTrans(e);
	});

	$(".btn_add_voc").click(function() {
		addVoc();
	});

	$("#form_add_topic").validate({
		rules: {
				i_add_topic: {
					required: true,
					maxlength: 50,
				}
			},
			messages: {
				i_add_topic: {
					required: "Nhập tên chủ đề!",
					maxlength: "Tên chủ đề phải nhỏ hơn 50 ký tự!",
				}
			},
			submitHandler: function(form) {
            	 addTopic();
        	},
			errorElement : 'div',
    		errorLabelContainer: '.add_topic_msgTxt'
	});

	$(".a_is_share").click(function() {
		setTopicShare();
	});

	$(".topic_list").on("click", "a", function() {
		currentTopicId = $(this).attr("index");
		setTopicActive(currentTopicId);
		focusTopic($(this));
	});

	$(".a_update_topic").click(function() {
		prepareUpdateTopic();
	});

	$("#form_update_topic").validate({
		rules: {
				i_update_topic: {
					required: true,
					maxlength: 50,
				}
			},
			messages: {
				i_update_topic: {
					required: "Nhập tên chủ đề!",
					maxlength: "Tên chủ đề phải nhỏ hơn 50 ký tự!",
				}
			},
			submitHandler: function(form) {
            	 updateTopic();
        	},
			errorElement : 'div',
    		errorLabelContainer: '.update_topic_msgTxt'
	});

	$(".btn_delete_topic").click(function() {
		deleteTopic();
	});

	$(".a_delete_topic").click(function() {
		prepareDeleteTopic();
	});

	$(window).on('resize', function(){   
	    resize();
	});

	$(".voc_list").on("click", ".del_voc", function() {
		deleteVoc($(this));
	});
});