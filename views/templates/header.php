<header>
	<div class="container">
		<div class="col-xs-12 menu">
			<a href="/"><img style="height: 40px; margin-top: 4px;" src="/views/templates/untitled.svg"></a>
			<a class="btn-search-friends" href="/search"><i class="fa fa-search" aria-hidden="true"></i>
Search friends </a>

			<?php if (isset($_SESSION['username'])): ?><a href="/<?= $_SESSION['username']; ?>" class="menu_buttons">Profile</a><?php endif;?>
			<a href="/" class="menu_buttons">Explore</a>
			<a href="/account/edit" class="menu_buttons">Settings</a>
		</div>
	</div>
</header>