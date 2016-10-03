$(document).ready(function() {
	firstLoading();
	firstResize();

	var typingTimer;
	var doneTypingInterval = 400;  
	$(".eng_key").keyup(function(){
	    clearTimeout(typingTimer);
	    if ($(".eng_key").val) {
	        typingTimer = setTimeout(function(){
	             var v = $(".eng_key").val();
	             translate(v);
	        }, doneTypingInterval);
	    }
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

	$(".tn_voc").click(function() {
		prepareChall("tn");
	});

	$(".vt_voc").click(function() {
		prepareChall("vt");
	});

	$(".tn_chall .tn_answer_choose a").click(function() {
		answer($(this));
	});

	$("#form_vt_chall").validate({
			submitHandler: function(form) {
            	answerVt();
        	}
	});

	$(".btn_vt_skip_answer").click(function() {
		vtQuestionAfter();
	});

	$(".btn_chall").click(function() {
		if (vocList.length < 5 ) {
			$(".chall_note").show();
			$(".chall_choose").hide();
		} else {
			$(".chall_note").hide();
			$(".chall_choose").show();
		}
	});

});
