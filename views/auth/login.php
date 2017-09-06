<html>
<head>
	<?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>
	
	<style>
		body {	
			background: #43C6AC;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #191654, #43C6AC);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #191654, #43C6AC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
			font-family: 'Open Sans', sans-serif;
			color: #fff;
		}
		.div-login {
			float: none;
			margin: 0 auto;
			top:25%;
		}
		.form-login {
			padding-left: 40px;
			padding-right: 40px;
		}

		div.margin-top {
			margin-top: 20px;
		}

		div.margin-top:last-child {
			margin-bottom: 30px;
		}

		.login_text_input {
			width: 100%;
			padding: 10px 20px;
			background-color: transparent;
			box-shadow: none;
			border: 1px solid #fff;
			color: #fff !important;
		}

		.login_submit_input {
			border-color: #fff;
			box-shadow: none;
			border-radius: 0;
			height: 35px;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 30px;
			border-top-right-radius: 30px;
			border-top-left-radius: 5px;
			background-color: transparent;
			color: #fff !important;
			transition: 0.2s;
		}

		.login_submit_input:hover {
			border-color: #fff;
			background: #fff;
			color: #3A6073 !important;
		}

		.gramstain {
			background: #ef32d9;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #89fffd, #ef32d9);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #89fffd, #ef32d9); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.under-input {
			font-size: 0.7em;
			float: left;
			top: 27%;
			z-index: 1000;
			position: absolute;
		}
	</style>
</head>

<body>
<div class="container col-md-5 text-center div-login">
	<div class="form-login">
		<form action="login" method="post">
			<div class="margin-top: 30px;">
				<h1> Login to <span class="gramstain">Gramstain</span></h1>
			</div>
			<div class="margin-top">
				<label for="login_text_input" class="under-input">Username or email</label>
				<input type="text" class="login_text_input" name="username" placeholder="Username or email" required>
			</div>
			<div class="margin-top"><input type="password" class="login_text_input" name="password" placeholder="Password" required></div>
			<div class="margin-top"><input type="submit" class="form-control login_submit_input" name="login" value="Login"></div>
		</form>
	</div>
</div>
</body>
</html>