<html>

<head>
<meta charset="utf-8">
<?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>
<link rel="stylesheet" href="../views/templates/style.css">

<style>
	.wrapper {
		height: 100%;
		display: flex;
		flex-direction: column;
	}
	.item-heading {
		text-align: center;
		background: #FF9800;
		font-size: 16px;
	}

	.item-heading a {
		color: #fff;
	}

	.items {
		height: 100%;
		padding-top: 100px;
		padding-left: 100px;
		padding-right: 100px;
	}

	.items .item {
		margin-top: 30px;
	}


	.btn-option {
		width: 100%;
		margin-left: 0;
	}
</style>
</head>

<body>
	<?php include(ROOT_PATH . '/views/templates/header.php'); ?>

	<div class="wrapper">
		<div class="items">
			<?php foreach($subscribers as $subscriber): ?>
				<div class="item col-xs-4">
					<div class="item-heading">
						<a href="/<?= $subscriber['username'];?>">
							<span class="item-username">@<?= $subscriber['username']; ?></span>
						</a>
					</div>
					<div class="item-image">
						<img src="../images/<?= $subscriber['avatar']; ?>" class="img-responsive">
					</div>
					<div class="item-unsubscribe">
						<div class="btn-option">
						<?php if ($subscriber['subscribed'] && CURRENT_USER != $subscriber['username']): ?>
							<form action="/subscribe" method="post">
								<input type="hidden" name="username" value="<?=$subscriber['username'];?>">
								<button type="submit" name="unsubscribe" class="col-xs-12 btn-subscribe">Already following</button>
							</form>
						<?php endif; ?>

						<?php if (!$subscriber['subscribed'] && CURRENT_USER != $subscriber['username']): ?>
							<form action="/subscribe" method="post">
								<input type="hidden" name="username" value="<?=$subscriber['username'];?>">
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