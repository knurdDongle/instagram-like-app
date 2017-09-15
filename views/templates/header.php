<header>
	<div class="container">
		<div class="col-xs-12 menu">
			<?php if (isset($_SESSION['username'])): ?><a href="/<?= $_SESSION['username']; ?>" class="menu_buttons">Profile</a><?php endif;?>
			<a href="/" class="menu_buttons">Explore</a>
			<a href="/account/edit" class="menu_buttons">Settings</a>
		</div>
	</div>
</header>