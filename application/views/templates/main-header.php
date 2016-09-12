<div class="container main_header">
	<div class="row main_header_inner">
		<nav class="navbar my-navbar">
			<div class="navbar-header collapsed">
				<a class="navbar-brand" href="#"><img class="small-logo" src="<?php echo base_url(); ?>/assets/images/logo.png"></a>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavba">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>			</div>
			<div class="navbar-collapse collapse" id="myNavba">
				<ul class="nav navbar-nav nav-menu">
					<li><a class="active" href="<?php echo site_url(); ?>/home" >Trang chủ</a></li>
					<li><a href="#" >App</a></li>
					<li><a href="#" >Gói Từ Vựng</a></li>
					<li><a href="#" >Trợ Giúp</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right nav-profile">
			        <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php if (isset($_SESSION["loged-in"]["username"]))echo $_SESSION["loged-in"]["username"]; ?></a></li>
			        <li><a href="<?php echo site_url(); ?>/home/logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			      </ul>
			</div>
		</nav>
	</div>
</div>