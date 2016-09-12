<div class="login_container">
	<div class="row login_inner">
		<div class="col-md-6 col-md-offset-3">
			<img class="logo" src="<?php echo base_url(); ?>assets/images/logo.png">
			<div class="login_content text-center">
				<h3>Đăng nhập</h3>
				<div class="l_msgTxt msgTxt msg_error" style="display: none;"></div>
				<?php if (isset($msg)) {
					if ($msg == "r_success") {
						echo '<div class="msg_server msgTxt msg_success">
							<strong>Chúc mừng!</strong> Bạn vừa đăng ký tài khoản thành công.
							</div>';
					} else if ($msg == "r_error") {
						echo '<div class="msg_server msgTxt msg_error">
							<strong>Rất tiếc!</strong> Đã có lỗi xảy ra.
							</div>';
					} else if ($msg == "l_error") {
						echo '<div class="msg_server msgTxt msg_error">
							<strong>Lỗi đăng nhập!</strong> Sai tên đăng nhập hoặc mật khẩu.
							</div>';
					}
				} ?>

				<?php 
				$attributes = array('id' => 'l_form');
				echo form_open('home/login', $attributes); ?>			
				<div class="input-group">
					<input id="username" name="username" placeholder="Tên đăng nhập" class="form-control"  type="text" value="<?php echo isset($username_error) ? $username_error : ''; ?>">
				</div>
				<div class="input-group">
					<input id="password" name="password" placeholder="Mật khẩu" class="form-control"  type="password">
				</div>
				<button class="btn btn_default btn_login" name="btnSubmit" value="login">Đăng nhập</button>
				<?php echo form_close(); ?>
				<a class="new_account_link">Đăng ký tài khoản!</a>
			</div>
			<div class="register_content text-center" style="display:none;">
				<h3>Đăng ký tài khoản</h3>
				<div class="r_msgTxt msgTxt msg_error" style="display: none;">
					<div class="exist_username_error" style="display:none;">Tên đăng nhập đã tồn tại!</div>
				</div>
				<?php 
				$attributes = array('id' => 'r-form');
				echo form_open('home/login', $attributes); ?>
				<div class="input-group">
					<input id="r_username" name="r_username" placeholder="Tên đăng nhập" class="form-control"  type="text">
				</div>
				<div class="input-group">
					<input id="r_email" name="r_email" placeholder="Email" class="form-control"  type="email">
				</div>
				<div class="input-group">
					<input id="r_password" name="r_password" placeholder="Mật khẩu" class="form-control"  type="password">
				</div>
				<div class="input-group">
					<input id="r_passwordf" name="r_passwordf" placeholder="Xác nhận lại mật khẩu" class="form-control"  type="password">
				</div>
				<button type="submit" class="btn btn_default" name="btnSubmit" value="register">Đăng ký</button>
				<?php echo form_close(); ?>
				<a class="sign_in_link" >Đăng nhập!</a>
			</div>
		</div>
		
	</div>
</div>
<script src='<?php echo base_url(); ?>assets/lg.js' type='text/javascript'></script>