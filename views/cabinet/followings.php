<html>

<head>
<meta charset="utf-8">
<?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>
<link rel="stylesheet" href="../views/templates/style.css">

<style>

	.item-heading {
		height: 40px;
		border: 1px solid #ccc;
	}

	.items {
		padding-left: 100px;
		padding-right: 100px;
	}
</style>
</head>

<body>
	<?php include(ROOT_PATH . '/views/templates/header.php'); ?>

	<div class="wrapper">
		<div class="items">
			<?php foreach($followings as $following): ?>
				<div class="item col-xs-4">
					<div class="item-heading">
						<a href="/<?= $following['username'];?>"><span class="item-username"><?= $following['username']; ?></span></a>
					</div>
					<div class="item-image">
						<img src="../images/<?=$following['avatar']; ?>" class="img-responsive">
					</div>
					<div class="item-unsubscribe">
						<div class="btn-option">
							<?php if ($following['subscribed'] && $_SESSION['username'] != $following['username']): ?>
								<form action="/unsubscribe" method="post">
									<input type="hidden" name="username" value="<?=$following['username'];?>">
									<button type="submit" name="unsubscribe" class="col-xs-12 btn-subscribe">Already following</button>
								</form>
							<?php endif; ?>

							<?php if (!$following['subscribed'] && $_SESSION['username'] != $following['username']): ?>
								<form action="/subscribe" method="post">
									<input type="hidden" name="username" value="<?=$following['username'];?>">
									<button type="submit" name="subscribe" class="col-xs-12 btn-subscribe">Follow</button>
								</form>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</body>