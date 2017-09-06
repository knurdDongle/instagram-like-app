<!DOCTYPE html>
<html lang="en">
<head>
	<?php include (ROOT_PATH . '/views/templates/favicon.html'); ?>
</head>
<body>
	<?php if (isset($photoInfo)): ?>
		<div class="col-md-8 col-md-offset-3" style="margin-top: 50px;">
			<img src="<?= '/images/' . $photo;?>">
			<p>
				<?= $photoInfo['likes'] ?> Likes 
			</p>
		</div>
	<?php endif; ?>
</body>
</html>