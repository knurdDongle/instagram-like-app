<html>
<head>
	<?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>
	
	<style>
		body {	
			background-image: radial-gradient(ellipse at 99% -50%, #BD47F2 10%, #0062FF 120%);
			font-family: 'Heebo', sans-serif;
			text-transform: uppercase;
			color: #fff;
			overflow: hidden;
		}
		.div-login {
			float: none;
			margin: 0 auto;
			top: 25%;
			height: 100%;
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
			border: 1px solid #BD47F2;
			color: #fff !important;
			transition: 0.15s;
		}

		.login_text_input:focus {
			border-color: #DE9EFB;
		}

		.login_submit_input {
			border-color: #BD47F2;
			box-shadow: none;
			border-radius: 0;
			height: 35px;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 30px;
			border-top-right-radius: 30px;
			border-top-left-radius: 5px;
			background-color: transparent;
			color: #fff !important;
			transition: 0.15s;
		}

		.login_submit_input:hover {
			border-color: #BD47F2;
			background: #BD47F2;
			color: #fff !important;
		}

		.gramstain {
			background: #C9D6FF;  /* fallback for old browsers */
			background: -webkit-linear-gradient(to right, #E2E2E2, #C9D6FF);  /* Chrome 10-25, Safari 5.1-6 */
			background: linear-gradient(to right, #E2E2E2, #C9D6FF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */




			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
		}

		.under-input {
			font-size: 0.7em;
			float: left;
			z-index: 1000;
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
				<input type="text" class="login_text_input" name="username" required>
			</div>
			<div class="margin-top">
				<label for="login_text_input" class="under-input">Password</label>
				<input type="password" class="login_text_input" name="password"  required>
			</div>

			<div class="margin-top"><input type="submit" class="form-control login_submit_input" name="login" value="Login"></div>
		</form>
	</div>
</div>
</body>
</html>