function translate(keyword) {
	$(".eng_voc").show();
	$(".vi_voc").hide();
	if (keyword.trim() != "") {
		$.ajax({
	        url: siteUrl + '/home/translate',
	        method: 'POST',
	        data: {
	            keyword: keyword
	        },
	        dataType: 'json'
	    }).done(function(data) {
	        wordResults = data;
	        renderWordResults(wordResults);
	    }).fail(function(err) {
	    });
	} else {
		$(".eng_voc").empty();
	}
}

function renderWordResults(wordResults) {
	var html = '';
	for (var i in wordResults) {
		html += '<a value="'+ i +'">'+ wordResults[i]["new_word"] +'</a>';
	}
	$(".eng_voc").empty();
	$(".eng_voc").html(html);
}

function renderViResult(html) {
	$(".vi_voc").empty();
	$(".vi_voc").html(html);
	$(".vi_voc").show();
}

function translateToVi(value) {
	$(".eng_key").val(wordResults[value]["new_word"]);
	renderViResult(wordResults[value]["mean"]);
}

function chooseMean(elem) {
	var mean = (elem.text() != null) ? elem.text().trim() : "";
	var type = elem.parent().parent().parent().find("> b i").text();
	type = (type != null) ? type.trim() : "";
	var pron = elem.parents(".vi_voc").find("> i").text();
	
	$(".ta_voc_mean").val(mean);
	$(".ta_voc_type").val(type);
	$(".ta_voc_pron").val(pron);
}

function hideShowVocTrans(e) {
	var viVoc = $(".vi_voc");
    var engVoc = $(".eng_voc");
    var ta_voc_pron = $(".ta_voc_pron");
    var ta_voc_type = $(".ta_voc_type");
    var ta_voc_mean = $(".ta_voc_mean");

    if (!viVoc.is(e.target) && viVoc.has(e.target).length === 0 
    	&& !ta_voc_pron.is(e.target) && ta_voc_pron.has(e.target).length === 0
    	&& !ta_voc_type.is(e.target) && ta_voc_type.has(e.target).length === 0
    	&& !ta_voc_mean.is(e.target) && ta_voc_mean.has(e.target).length === 0
    	&& !engVoc.is(e.target) && engVoc.has(e.target).length === 0
    	) {
    	engVoc.hide();
        viVoc.hide();
    }
}

function addVoc() {
	if(validateFormTrans()) {
		$(".voc_loading").css("display", "inline-block");
		$.ajax({
	        url: siteUrl + '/home/addVoc',
	        method: 'POST',
	        data: {
	        	topicId: currentTopic["topic_id"],
	        	vocNew: $(".eng_key").val(),
	        	pron: $(".ta_voc_pron").val(),
	        	type: $(".ta_voc_type").val(),
	        	mean: $(".ta_voc_mean").val(),
	        	status: ""
	        },
	        dataType: 'json'
	    }).done(function(data) {
	    	var vocAdded = data["newVoc"];
	    	vocList.unshift(vocAdded);
	    	renderVocList(vocList);
	 		$(".voc_loading").css("display", "none");
	    }).fail(function(err) {
	    });
	}

}

function validateFormTrans() {
	var result = true;
	if ($(".eng_key").val().trim() == "") {
		$(".eng_key").addClass("invaild_trans");
		result = false;
	} else {
		$(".eng_key").removeClass("invaild_trans");
	}
	if ($(".ta_voc_mean").val().trim() == "") {
		$(".ta_voc_mean").addClass("invaild_trans");
		result = false;
	} else {
		$(".ta_voc_mean").removeClass("invaild_trans");
	}

	return result;
}

function renderTopicList(topicList) {
	if (topicList.length == 0)
		loadWellcome();
	else {
		$(".main_content").show();
		$(".list_active").show();
		$(".wellcome").hide();
		$(".non_active").hide();
		var html = '';
		for (var i in topicList) {
			html += '<a i="'+ i +'" index="'+ topicList[i]["topic_id"] +'">'+ topicList[i]["topic_name"] +' <span class="badge">5</span></a>';
		}
		$(".list_active").empty();
		$(".list_active").html(html);
	}
}

function firstLoading() {
	showHideElem(true, $(".topic_loading"));
	getTopicList();

	if (topicList.length == 0) {
		showHideElem(true, $(".topic_loading"));
	}
} 

function showHideElem(value, elem) {
	var status = value ? "block" : "none";
	elem.css("display", status);
}

function getTopicList() {
	$.ajax({
        url: siteUrl + '/home/getTopicList',
        method: 'POST',
        dataType: 'json'
    }).done(function(data) {
    	topicList = data["topicList"];
    	currentTopic = data["currentTopic"];
    	showHideElem(false, $(".topic_loading"));
        renderTopicList(topicList);
        setTopicActive(currentTopic);
        if (currentTopic != null) {
        	updateToolbar();
        	getVocList(currentTopic["topic_id"]);
        }
    }).fail(function(err) {
    });
}

function setTopicShare() {
	if ( $(".a_is_share").attr("value") == "true") {
		$(".a_is_share").css("color", "#cad4d8");
		$(".a_is_share").attr("value", "false");
	} else {
		$(".a_is_share").css("color", "#0a91ab");
		$(".a_is_share").attr("value", "true");
	}
	var isShare = $(".a_is_share").attr("value");
	$.ajax({
        url: siteUrl + '/home/updateTopic',
        method: 'POST',
        data: {
        	topicName: currentTopic["topic_name"],
        	isShare: (isShare == "true") ? "public" : "private",
        	topicId: currentTopic["topic_id"]
        },
        dataType: 'json'
    }).done(function(data) {
    	topicList = data["topicList"];
    	currentTopic = data["currentTopic"];
    }).fail(function(err) {
    });
}

function setStatusShare() {
	if (currentTopic["status"] == "private") {
		$(".a_is_share").css("color", "#cad4d8");
		$(".a_is_share").attr("value", "false");
	} else {
		$(".a_is_share").css("color", "#0a91ab");
		$(".a_is_share").attr("value", "true");
	}
}

function addTopic() {
	showHideElem(true, $(".topic_loading"));
	$("#modal_add_topic").modal("hide");
	var topicName = $("#form_add_topic input[name=i_add_topic]").val();
	$.ajax({
        url: siteUrl + '/home/addTopic',
        method: 'POST',
        data: {
        	topicName: topicName,
        	isShare: "public"
        },
        dataType: 'json'
    }).done(function(data) {
    	topicList = data["topicList"];
    	currentTopic = data["currentTopic"];
        renderTopicList(topicList);
        setTopicActive(currentTopic);
        updateToolbar();
        getVocList(currentTopic["topic_id"]);
        showHideElem(false, $(".topic_loading"));
    }).fail(function(err) {
    });
}

function setTopicActive(topic) {
	if (topic != null) {
		var topicId = topic["topic_id"]
		$(".topic_list a").css({"background-color" : "#fdfdfd", "color" : "#0a91ab"});
		$(".topic_list a[index="+ topicId +"]").css({"background-color": "#0a91ab", "color" : "#fff"});
	}
}

function prepareUpdateTopic() {
	$("#modal_update_topic input[name=i_update_topic]").val(currentTopic["topic_name"]);
}

function updateTopic() {
	showHideElem(true, $(".topic_loading"));
	$("#modal_update_topic").modal("hide");
	var topicName = $("#modal_update_topic input[name=i_update_topic]").val();
	var isShare = $(".a_is_share").attr("value");
	var topicId = currentTopic["topic_id"];

	$.ajax({
        url: siteUrl + '/home/updateTopic',
        method: 'POST',
        data: {
        	topicName: topicName,
        	isShare: (isShare == "true") ? "public" : "private",
        	topicId: topicId
        },
        dataType: 'json'
    }).done(function(data) {
    	topicList = data["topicList"];
    	currentTopic = data["currentTopic"];

        renderTopicList(topicList);
        setTopicActive(currentTopic);
        updateToolbar();
        showHideElem(false, $(".topic_loading"));
    }).fail(function(err) {
    });
}

function focusTopic(elemClicked) {
	currentTopic = topicList[elemClicked.attr("i")];
	setTopicActive(currentTopic);
	updateToolbar();
	getVocList(currentTopic["topic_id"]);
	$(".voc_chall").fadeOut(200, function() {
		$(".main_content").fadeIn(200);
	});
}

function updateToolbar() {
	$(".topic_title b").text("Chủ đề: " + currentTopic["topic_name"]);
	$(".sm_topic_id").text("[Mã: "+ currentTopic["topic_id"] +"]");
	setStatusShare();
}

function deleteTopic() {
	$("#modal_delete_topic").modal("hide");
	showHideElem(true, $(".topic_loading"));
	$.ajax({
        url: siteUrl + '/home/deleteTopic',
        method: 'POST',
        data: {
        	topicId: currentTopic["topic_id"]
        },
        dataType: 'json'
    }).done(function(data) {
    	topicList = data["topicList"];
    	currentTopic = data["currentTopic"];

        renderTopicList(topicList);
        if (currentTopic != null) {
        	setTopicActive(currentTopic);
        	updateToolbar();
        	getVocList(currentTopic["topic_id"]);
        }
        showHideElem(false, $(".topic_loading"));
    }).fail(function(err) {
    });
}

function prepareDeleteTopic() {
	$(".title_topic_del").text(currentTopic["topic_name"]);
}

function loadWellcome() {
	$(".main_content").hide();
	$(".list_active").hide();
	$(".wellcome").show();
	$(".non_active").show();

	var speed = 100;
	$(".wel_title").fadeIn(speed, function() {
		$(".wel_b1").fadeIn(speed, function() {
			$(".wel_b2").fadeIn(speed, function() {
				$(".wel_b3").fadeIn(speed, function() {
					$(".btn_first_start").fadeIn(speed);
				});
			});
		});
	});
}

function resize() {
	firstResize();
}

function firstResize() {
	var listHeight = ($(window).height() - 290) + "px";
	$(".topic_list").css("min-height", listHeight);
}

function renderVocList(vocList) {
	var html = '';
		for (var i in vocList) {
			html += '<div class="voc_row"><p class="stt"><i class="fa fa-circle" aria-hidden="true"></i></p>';
			html += '<p class="voc_new">'+ vocList[i]["voc_new"] +'</p>';
			html += '<p class="voc_pron">'+ vocList[i]["pron"] +'</p>';
			html += '<p class="voc_type">'+ vocList[i]["type"] +'</p>';
			html += '<p class="voc_mean">'+ vocList[i]["mean"] +'</p>';
			html += '<a class="del_voc" voc_id="'+ vocList[i]["vocabulary_id"] +'" value="'+ i +'"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
		}
		$(".voc_list").empty();
		$(".voc_list").html(html);
}

function getVocList(topicId) {
	$(".voc_loading").css("display", "inline-block");
	$.ajax({
        url: siteUrl + '/home/getVocList',
        method: 'POST',
        data: {
        	topicId: topicId
        },
        dataType: 'json'
    }).done(function(data) {
    	vocList = data["vocList"];
 		renderVocList(vocList);
 		$(".voc_loading").css("display", "none");
    }).fail(function(err) {
    });
}

function deleteVoc(vocElem) {
	$(".voc_loading").css("display", "inline-block");
	$.ajax({
        url: siteUrl + '/home/deleteVoc',
        method: 'POST',
        data: {
        	vocId: vocElem.attr("voc_id")
        },
        dataType: 'json'
    }).done(function(data) {
    	if (data["status"] == "success") {
    		var index = Number(vocElem.attr("value"));
    		if (index > -1) {
			    vocList.splice(index, 1);
			}
    	}
    	renderVocList(vocList);
 		$(".voc_loading").css("display", "none");
    }).fail(function(err) {
    });
}


function prepareChall(c) {
	$("#modal_choose_chall").modal("hide");
	$(".main_content").fadeOut(200, function() {
		$(".voc_chall").fadeIn(200, function() {
			if (c == "tn") {
				prepareChallTn();
			} else if (c = "vt") {
				prepareChallVt();
			}
		});
	});
	
}

function prepareChallTn() {
	var challArr = vocList.slice();
	shuffle(challArr);

	renderChallTn(challArr);
}

function renderChallTn(challArr) {
	
	answerChooseArr[0] = challArr[0];

	console.log();  
}

function prepareAnswerChose(questionObj) {
	var answerChooseArr = [];
	answerChooseArr[0] = questionObj;
	do {
		var i = Math.floor(Math.random() * vocList.length);
		answerChooseArr[1] = vocList[i];
		i = Math.floor(Math.random() * vobList.length);
		answerChooseArr[2] = vocList[i];
	} while (!checkVaildAnswerArr(answerChooseArr));
}

function shuffle(a) {
    var j, x, i;
    for (i = a.length; i; i--) {
        j = Math.floor(Math.random() * i);
        x = a[i - 1];
        a[i - 1] = a[j];
        a[j] = x;
    }
}

function checkVaildAnswerArr(answersArr) {
	if (answersArr[0]["vocabulary_id"] == answersArr[1]["vocabulary_id"] || answersArr[0]["vocabulary_id"] == answersArr[2]["vocabulary_id"] || answersArr[1]["vocabulary_id"] == answersArr[2]["vocabulary_id"])
		return false;
	return true;
}