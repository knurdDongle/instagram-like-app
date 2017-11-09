<!DOCTYPE html>
<html lang="en">
<head>
	<?php include (ROOT_PATH . '/views/templates/favicon.html'); ?>
</head>
<body>
	<?php if (isset($photoInfo)): ?>
		<div class="col-md-10 col-md-offset-2" style="margin-top: 50px;">
			<img src="<?= '/images/' . $photoInfo['image'];?>" style="margin-left: 4.07%">
			<p>
				<?= $photoInfo['likes'] ?> Likes 
			</p>
		</div>
	<?php endif; ?>
</body>
</html>