<?php 
	include_once 'Views/index/header.php';
 ?>
	<!--welcome-starts-->
	<div class="welcome">
		<div class="container">
			<div class="welcome-top heading">
				<h3>WELCOME</h3>
				<div class="welcome-bottom">
					<img src="Public/images/abt-1.jpg" alt=""/>
					<p>Vivamus interdum diam diam, non faucibus tortor consequat vitae. Proin sit amet augue sed massa pellentesque viverra. Suspendisse iaculis purus eget est pretium aliquam ut sed diam. Nullam non magna lobortis, faucibus erat eu, consequat justo. Suspendisse commodo nibh odio, vel elementum nulla luctus sit amet.</p>
					<p>Nulla in tempor lectus. Etiam ac mauris lacinia nulla ultricies porta sit amet eleifend ligula. Quisque tincidunt vitae turpis at efficitur. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec sagittis, magna a sagittis dapibus, ipsum metus interdum lectus, quis feugiat leo ipsum nec diam.</p>
				</div>
			</div>
		</div>
	</div>
	<!--welcome-end-->
	<!--team-starts-->
	<div class="team">
		<div class="container">
		<div class="team-top heading">
			<h3>OUR TEAM</h3>
		</div>
			<div class="team-bottom">
				<?php foreach ($admin as $row): ?>
				<div class="col-md-3 team-left">
					<img src="<?php echo $row['avatar'] ?>" style="border-radius: 50% !important;height: 200px;width: 200px" class="img-rounded"/>
					<h4><?php echo $row['name'] ?></h4>
					<p>Fusce at elementum diam. Integer pellentesque ultricies pharetra.</p>
				</div>
				<?php endforeach ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!--team-end-->
<?php 
	include_once 'Views/index/footer.php';
 ?>