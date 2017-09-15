<html>

<head>
<meta charset="utf-8">
<?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>
<link rel="stylesheet" href="views/templates/style.css">

<style>
	.item {
		width: 500px;
		height: 500px;
		background-color: #fff;
		border: 1px solid #efefef;
		margin: 0 auto;
	}

	.item:not(:first-child) {
		margin-top: 100px;
	}

	.item:last-child {
		margin-bottom: 40px;
	}

	.item h1 {
		font-family: 'Helvetica', sans-serif;
	}


	.item .item-photo img {
		height: 440px;
		width: 498px;
	}

	.item .item-user {
		padding: 10px;
		width: 500px;
	    height: 60px;
	}
	.item .item-user .item-avatar {
		display: inline;
	}
	.item .item-user .item-avatar img {
		width: 40px;
		height: 40px;
		border-radius: 50%;
	}
	.item-username {
		font-weight: bold;
		display: inline;
		vertical-align: top;
	}
	.item-creating_date {
		vertical-align: bottom;
		margin-left: -36px;
	}
	</style>
</head>
<body>
	<?php include(ROOT_PATH . '/views/templates/header.php'); ?>

	<div class="wrapper">
		<div class="items_list">
		<?php foreach ($posts as $post): ?>
			<div class="item">
				<div class="item-user">
					<div class="item-avatar">
						<img src="images/<?= $post['avatar']; ?>">
					</div>
					<span class="item-username"><?= $post['owner_username']; ?></span>
					<span class="item-creating_date"><?= $post['creation_date']; ?></span>
				</div>

				<div class="item-photo">
					<a href="photo/<?=$post['image_href'];?>"><img src="images/<?= $post['image']; ?>"></a>
				</div>
			</div>
		<?php endforeach; ?>
		</div>
	</div>
</body>