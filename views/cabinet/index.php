<html>

<head>
<meta charset="utf-8">
<?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>
<link rel="stylesheet" href="views/templates/style.css">
</head>

<body>
<header>
	<div class="container">
		<div class="col-xs-12 menu">
			<a href="profile/" class="menu_buttons">Profile</a>
			<a href="explore/" class="menu_buttons">Explore</a>
			<a href="friends/" class="menu_buttons">Friends</a>
		</div>
	</div>
</header>

<div class="wrapper">
	<div class="col-xs-8">
		<img src="images/<?= $userInfo['avatar']?>" class="avatar">
		<?php if (isset($userInfo) && isset($_SESSION['username']) && ($_SESSION['username'] == $userInfo['username'])): ?>
			<a href="/account/edit" class="btn btn-info"> Редактировать </a>
		<?php endif; ?>
	</div>

<?php if (isset($userInfo) && isset($_SESSION['username']) && ($_SESSION['username'] == $userInfo['username'])): ?>
	<div class="col-xs-4">
		<form action="cabinet/addimage/" method="post" enctype="multipart/form-data" class="col-xs-12">
			<h1> Добавить фото </h1>
			<input class="form-control" type="file" name="image" required>
			<input class="form-control" type="submit" name="addphoto" value="Загрузить">
		</form>
	</div>

	<div class="col-xs-12">
		<form action="logout" method="post">
			<input class="form-control btn-info" type="submit" name="logout" value="Выход">
		</form>
	</div>
<?php endif; ?>

<div class="col-xs-12 text-center">
	<h1> Профиль <?= $userInfo['username']; ?> </h1>
</div>


<?php if (isset($images)): ?>
<div>
	<?php $i = 0; ?>
	<?php foreach ($images as $image): ?>
		<?php if ($i == 0 || $i % 3 == 0): ?>
		<div class="row col-xs-12">
		<?php endif; ?>
			<div class="col-xs-4 text-center">
				<a href="/photo/<?= $image['image_href'] ?>"?>
					<img class="profile_pic" src="<?= '/images/' . $image['image']; ?>" id="<?= $image['id']; ?>">
				</a>
			</div>
		<?php $i++; ?>
		
		<?php if ($i == 0 || $i % 3 == 0): ?> </div> <?php endif; ?>
	<?php endforeach; ?>
</div>
<?php endif; ?>
</div>

</body>
</html>