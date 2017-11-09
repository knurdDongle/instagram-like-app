<html>

<head>
<meta charset="utf-8">
<?php include(ROOT_PATH . '/views/templates/favicon.html'); ?>
<link rel="stylesheet" href="/views/templates/style.css">

</head>

<body>
<?php include(ROOT_PATH . '/views/templates/header.php'); ?>


<div class="wrapper">
	<div class="content">
		<div class="col-xs-12 profile_info">
			<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<div class="profile_avatar col-sm-4">
				<?php if (empty($userInfo['profile_info']['avatar'])): ?>
					<img src="/views/templates/default_pic.png" class="profile_pic default_profile_pic">
				<?php endif; ?>
				<?php if (!empty($userInfo['profile_info']['avatar'])): ?>
					<img src="/images/<?= $userInfo['profile_info']['avatar']?>" class="profile_pic">
				<?php endif; ?>
				</div>

				<div class="profile_info">
					<span class="profile_info-name"><?= $userInfo['profile_info']['name'] . ' <b>@'. $userInfo['profile_info']['username'] . '</b>';?></span>
					<span class="profile_info-description"><?= $userInfo['profile_info']['description']; ?></span>
				</div>
		
				<?php if (Functions::logged_in() && (CURRENT_USER == $userInfo['profile_info']['username'])): ?>
				<div class="btn-option">
					<div class="btn-group">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="glyphicon glyphicon-wrench"></span>
					    </button>
					    <ul class="dropdown-menu">
					    	<li role="presentation" class="dropdown-header">Account Settings</li>
							<li><a href="/account/edit">Settings</a></li>
							<li>
								<form action="logout" method="post">
									<input class="form-control" type="submit" name="logout" value="Exit">
								</form>
							</li>
					   	</ul>
					</div>

					<div class="btn-group btn-option-upload">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="glyphicon glyphicon-upload"></span>
					    </button>
					    <ul class="dropdown-menu">
					    	<li role="presentation" class="dropdown-header">Upload a photo</li>
							<li>
								<form action="cabinet/addimage/" method="post" enctype="multipart/form-data" class="col-xs-12">
									<input class="form-control" type="file" name="image" required>
									<input class="form-control" type="submit" name="addphoto" value="Upload">
								</form>
							</li>
					   	</ul>
					</div>
				</div>
				<?php endif; ?>

				<?php if (Functions::logged_in() && (CURRENT_USER != $userInfo['profile_info']['username'])): ?>
				<?php if ($subscriber == 1): ?>
				<div class="btn-option">
					<form action="/subscribe" method="post">
						<input type="hidden" name="username" value="<?=$userInfo['profile_info']['username'];?>">
						<button type="submit" name="unsubscribe" class="col-xs-12 btn-subscribe">Already subscribing</button>
					</form>
				</div>
				<?php endif; ?>

				<?php if ($subscriber == 0): ?>
				<div class="btn-option">
					<form action="/subscribe" method="post">
						<input type="hidden" name="username" value="<?=$userInfo['profile_info']['username'];?>">
						<button type="submit" name="subscribe" class="col-xs-12 btn-subscribe">Subscribe</button>
					</form>
				</div>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	
		<div class="profile_stats col-xs-12 col-sm-6 col-sm-offset-3">
			<div class="stats_column col-xs-4">
				<span><?= count($userInfo['images']); ?></span>
				photos
			</div>

			<div class="stats_column col-xs-4">
				<span><?= $userInfo['profile_info']['subscribers']; ?></span>
				<a href="/subscribers/<?=$userInfo['profile_info']['username'];?>">subscribers</a>
			</div>

			<div class="stats_column col-xs-4">
				<span><?= $userInfo['profile_info']['followings']; ?></span>
				<a href="/following/<?=$userInfo['profile_info']['username'];?>">following</a>
			</div>
		</div>

		<?php if (count($userInfo['images'] > 0)): ?>
		<div class="photo_content">
			<div class="photos">
				<?php $i = 0; ?>
				<?php foreach ($userInfo['images'] as $image): ?>
				<?php if ($i == 0 || $i % 3 == 0): ?>
				<div class="col-xs-12 items">
				<?php endif; ?>
					<div class="col-xs-4 text-center item">
						<a href="/photo/<?= $image['image_href'] ?>"?>
							<img class="img-responsive" src="<?= '/images/' . $image['image']; ?>" id="<?= $image['id']; ?>">
						</a>
					</div>
				<?php $i++; ?>
				<?php if ($i == 0 || $i % 3 == 0): ?> </div> <?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
	</div>
	<div class="footer">
	    <div class="footer-main">
	        <div class="content-footer">
	            <div class="col-md-4">
	                <a href="/">
	                    <img class="svg" src="/views/templates/untitled.svg">
	                </a>
	            </div>

	            <div class="latest-news col-md-4">
	                <a href="/blog" class="tracked mb-1 db-1 tt-u no-underline">On The Blog ›</a>
	                <a href="/blog/hire" class="db-1 blue-3 no-underline">We hire new appliciants</a>
	            </div>

	            <div class="ratings col-md-4">
	                <a href="/ratings" class="tracked mb-1 db-1 tt-u no-underline">Community ratings weekly ›</a>
	                <a href="/ratings/november2017" class="db-1 blue-3 no-underline">Being inclusive and animation patterns</a>
	            </div>
	        </div>

	        <div class="content-footer pv8">
	            <div class="col-md-4">
	                <a href="/terms" class="grey-5 pr1 no-underline">Terms</a>
	                <a href="/privacy" class="grey-5 pr1 no-underline">Privacy</a>
	            </div>

	            <div class="col-md-8 grey-5">
	                <span>© 2017 Gramstain Limited. All rights reserved. Level 1, Wall Street, Philadelphia, United States 36011.</span>
	            </div>
	        </div>
	    </div>
	</div>
</div>

</body>
</html>