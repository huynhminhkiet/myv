<div class="container home_container">
	<div class="row home_inner">
		<div class="col-sm-2 left_side">
			<div class="left_menu">
				<div class="logo">
					<img class="small-logo" src="<?php echo base_url(); ?>/assets/images/logo.png">
				</div>
				<div class="menu_part">
					<div class="menu_title">
						<div class="loading topic_loading"></div>
						<p><i class="fa fa-thumb-tack" aria-hidden="true"></i> Chủ đề
						<a class="a_title" data-toggle="modal" data-target="#modal_add_topic"><i class="fa fa-plus-square" aria-hidden="true"></i></a></p>
					</div>
					<div class="list topic_list list_active" style="display:none">

					</div>
					<div class="list topic_list non_active text-center" style="display:none">
						<i class="fa fa-tint" aria-hidden="true"></i>
						<p>Bạn chưa có chủ đề nào!</p>
					</div>

					<div class="menu_title" style="margin-top: 0px;">
						<p><i class="fa fa-bars" aria-hidden="true"></i></i> Menu</p>
					</div>
					<div class="list menu_list">
						<a href="#"><i class="fa fa-mobile" aria-hidden="true"></i> Ứng dụng</a>
						<a href="#"><i class="fa fa-commenting-o" aria-hidden="true"></i> Phản hồi</a>
						<a href="<?php echo site_url(); ?>/home/logout"><i class="fa fa-sign-out" aria-hidden="true"></i> minhkiet94 (Đăng xuất)</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-10 right_side">
			<div class="main_content" style="display:none">
				<div class="tool_bar row">
					<p class="topic_title"><b>Chủ đề: </b> 
						<span>
							<a class="a_update_topic" data-toggle="modal" data-target="#modal_update_topic"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
							<a class="a_delete_topic" data-toggle="modal" data-target="#modal_delete_topic"><i class="fa fa-trash" aria-hidden="true"></i></a>
							<a class="a_is_share" value="true"><i class="fa fa-share-alt-square" aria-hidden="true"></i></a>
							<a><small class="sm_topic_id">[Mã: 101]</small></a>
						</span>
						<button class="btn btn_chall" data-toggle="modal" data-target="#modal_choose_chall">Ôn tập</button>
						<div class="loading voc_loading"></div>
					</p>

				</div>
				<div class="translate_bar">
					<div class="row">
						<div class="col-sm-3 input_trans eng_tras">
							<textarea placeholder="Nhập từ mới.." class="form-control eng_key"></textarea>
						</div>
						<div class="col-sm-3 input_trans"><textarea placeholder="Phát âm" class="form-control ta_voc_pron"></textarea></div>
						<div class="col-sm-2 input_trans"><textarea placeholder="Từ loại" class="form-control ta_voc_type"></textarea></div>
						<div class="col-sm-3 input_trans"><textarea placeholder="Nghĩa" class="form-control ta_voc_mean"></textarea></div>
						<div class="col-sm-1 input_trans"><button class="btn btn_default btn_add_voc">Lưu</button></div>
					</div>
					<div class="row word_result" style="margin-top: 5px;">
						<div class="col-sm-3 eng_voc">
						
						</div>
						<div class="col-sm-8 vi_voc">
							
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				
				<div class="voc_list">
					
				</div>
			</div>
			<div class="wellcome" style="display:none">
				<div class="wel_title">
					<b>3</b> bước để ghi nhớ từ vựng lâu hơn
					<hr>
				</div>
				<div class="wel_b wel_b1"><b>1</b>Thêm chủ đề</div>
				<div class="wel_b wel_b2"><b>2</b>Quản lý từ vựng</div>
				<div class="wel_b wel_b3"><b>3</b>Luyện tập</div>
				<button class="btn btn_first_start" data-toggle="modal" data-target="#modal_add_topic">Bắt đầu <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></button>
			</div>

			<div class="voc_chall" style="display: none">
				<div class="voc_chall_content">
					<div class="chall_inner">
						<div class="chall_part">
							<h2 style="padding-left: 12px;">Hello</h2>
							<hr>
							<div class="tn_answer_choose">
								<a><b class="answer_title">A</b>Xin chao</a>
								<a><b class="answer_title">B</b>Xin chao</a>
								<a><b class="answer_title">C</b>Xin chao</a>
							</div>
						</div>

						<div class="chall_part">
							<h2>Hello</h2>
							<hr>
							<div class="tn_answer_choose">
								<a><b class="answer_title">A</b>Xin chao</a>
								<a><b class="answer_title">B</b>Xin chao</a>
								<a><b class="answer_title">C</b>Xin chao</a>
							</div>
						</div>

						<div class="chall_part">
							<h2>Hello</h2>
							<hr>
							<div class="tn_answer_choose">
								<a><b class="answer_title">A</b>Xin chao</a>
								<a><b class="answer_title">B</b>Xin chao</a>
								<a><b class="answer_title">C</b>Xin chao</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<!-- Modal -->
<div id="modal_add_topic" class="modal fade" role="dialog">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Thêm chủ đề</h4>
	      	</div>
	    	<div class="modal-body text-center">
	    		<form id="form_add_topic" method="post">
	    			<div class="add_topic_msgTxt msgTxt msg_error" style="display: none"></div>
		 			<input placeholder="Nhập tên chủ đề" type="text" name="i_add_topic" class="form-control i_add_topic">
		 			<button type="submit" class="btn btn_default" style="margin: 0 auto; display: block;">Thêm</button> 
		 			<a class="a_download_topic"><i class="fa fa-gift" aria-hidden="true"></i> Nhận gói từ vựng!</a>
		 		</form>
		 		<div class="form_download_topic" style="display: none">
		 			<input placeholder="Nhập mã chủ đề" type="text" name="" class="form-control i_down_topic">
		 			<button class="btn btn_default" style="margin: 0 auto; display: block;">Xác nhận</button> 
		 		</div>      
	    	</div>
	    </div>
  	</div>
</div>
<div id="modal_update_topic" class="modal fade" role="dialog">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Cập nhật chủ đề</h4>
	      	</div>
	    	<div class="modal-body text-center">
	    		<form id="form_update_topic" method="post">
	    			<div class="update_topic_msgTxt msgTxt msg_error" style="display: none"></div>
	 				<input placeholder="Nhập tên chủ đề" type="text" name="i_update_topic" class="form-control i_update_topic">
	 				<button type="submit" class="btn btn_default" style="margin: 0 auto; display: block;">Cập nhật</button>	 
	 			</form>	   
	    	</div>
	    </div>
  	</div>
</div>
<div id="modal_delete_topic" class="modal fade" role="dialog">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Xóa chủ đề</h4>
	      	</div>
	    	<div class="modal-body text-center">
	    		<p>Toàn bộ từ vựng của chủ đề <b class="title_topic_del"></b> sẽ được xóa.</p>
	    		<button class="btn btn_default btn_delete_topic">Đồng ý</button>  
	    	</div>
	    </div>
  	</div>
</div>
<div id="modal_choose_chall" class="modal fade" role="dialog">
  	<div class="modal-dialog">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Chọn bài tập</h4>
	      	</div>
	    	<div class="modal-body text-center">
	    		  <div class="chall_choose">
					<a class="tn_voc">Trắc nghiệm</a>
					<a class="vt_chall">Viết từ</a>
				</div>
	    	</div>
	    </div>
  	</div>
</div>
<script type="text/javascript">
	var siteUrl = "<?php echo site_url(); ?>";
	console.log(siteUrl);
</script>

<script src='<?php echo base_url(); ?>assets/var.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>assets/func.js' type='text/javascript'></script>
<script src='<?php echo base_url(); ?>assets/hm.js' type='text/javascript'></script>
