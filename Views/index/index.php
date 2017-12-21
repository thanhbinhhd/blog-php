<?php 
	include_once 'Views/index/header.php';
 ?>
	<!--about-starts-->
	<div class="about">
		<div class="container">
			<div class="about-main">
				<div class="col-md-8 about-left">
					<div class="about-one">
						<p>Find The Most</p>
						<h3><?php echo $data[0]['title'] ?></h3>
					</div>
					<div class="about-two">
						<a href="?mod=index&act=read&slug=<?php echo $data[0]['slug'] ?>"><img src="<?php echo $data[0]['image'] ?>"  /></a>
						<p>Posted by <a href="#"><?php echo $data[0]['name'] ?></a> <?php echo $data[0]['created_at'] ?><a href="#">comments(2)</a></p>
						<p><?php echo $data[0]['description'] ?></p>
						<p><?php echo $data[0]['description'] ?></p>
						<div class="about-btn">
							<a href="?mod=index&act=read&slug=<?php echo $data[0]['slug'] ?>">Read More</a>
						</div>
						<ul>
							<li><p>Share : </p></li>
							<li><a href="#"><span class="fb"> </span></a></li>
							<li><a href="#"><span class="twit"> </span></a></li>
							<li><a href="#"><span class="pin"> </span></a></li>
							<li><a href="#"><span class="rss"> </span></a></li>
							<li><a href="#"><span class="drbl"> </span></a></li>
						</ul>
					</div>	
					<div class="about-tre" style="overflow: hidden;">
						<?php foreach ($data as $row): ?>
							<div class="col-md-6 abt-left">
								<a href="?mod=index&act=read&slug=<?php echo $row['slug'] ?>"><img style="height: 235px;" class="img-responsive" src="<?php echo $row['image'] ?>" /></a>
								<h6>Find The Most</h6>
								<h3><a href="?mod=index&act=read&slug=<?php echo $row['slug'] ?>"><?php echo substr($row['title'],0,20)."..." ?></a></h3>
								<p><?php echo substr($row['description'], 0,70) ?></p>
								<label><?php echo $row['created_at'] ?></label>
							</div>
						<?php endforeach ?>
					</div>
					<center style="clear: both;margin-top: 30px;">
						<div class="btn-group">
							<a href="?page=1"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-left"></span></button></a>
						  	<a href="?page=<?php echo ($page==1)?'1':$page-1; ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span></button></a>

						 	 <?php if($page-3>=1) {?>
						  		<a href="?page=<?php echo ($page==1)?'1':$page-1; ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-option-horizontal"></span></button></a>
						  	<?php } ?>

					  		<?php for($i=-2;$i<3;$i++) {
							  	$temp_num=$page+$i;
							  	if($temp_num<=$num_page&&$temp_num>0){
							  ?>
							  	<a href="?page=<?php echo $temp_num; ?>"><button type="button" class="btn btn-primary"><?php echo $temp_num; ?></button></a>
							<?php ;}} ?>
							<?php if($page+3<=$num_page) {?>
							  	<a href="?page=<?php echo ($page==$num_page)?'$num_page':$page+1; ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-option-horizontal"></span></button></a>
							<?php } ?>

							<a href="?page=<?php echo ($page==$num_page)?'$num_page':$page+1; ?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-right"></span></button></a>
							<a href="?page=<?php echo $num_page;?>"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-triangle-right"></span></button></a>
						</div>
					</center>
				</div>
				<div class="col-md-4 about-right heading">
					<div class="abt-1">
						<h3>ABOUT US</h3>
						<div class="abt-one">
							<img src="Public/images/c-2.jpg" alt="" />
							<p>Quisque non tellus vitae mauris luctus aliquam sit amet id velit. Mauris ut dapibus nulla, a dictum neque.</p>
							<div class="a-btn">
								<a href="single.html">Read More</a>
							</div>
						</div>
					</div>
					<div class="abt-2">
						<h3>NEW POST</h3>
							<?php foreach ($new_post as $row2): ?>
								<div class="might-grid">
									<div class="grid-might">
										<a href="?mod=index&act=read&slug=<?php echo $row2['slug']?>"><img src="<?php echo $row2['image']; ?>" class="img-responsive"> </a>
									</div>
									<div class="might-top">
										<h4><a href="?mod=index&act=read&slug=<?php echo $row2['slug'] ?>"><?php echo $row['title']; ?></a></h4>
										<p><?php echo substr($row2['description'], 0,50); ?></p> 
									</div>
									<div class="clearfix"></div>
								</div>
							<?php endforeach ?>					
					</div>
					<div class="abt-2">
						<h3>ARCHIVES</h3>
						<ul>
							<li><a href="single.html">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </a></li>
							<li><a href="single.html">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</a></li>
							<li><a href="single.html">When an unknown printer took a galley of type and scrambled it to make a type specimen book. </a> </li>
							<li><a href="single.html">It has survived not only five centuries, but also the leap into electronic typesetting</a> </li>
							<li><a href="single.html">Remaining essentially unchanged. It was popularised in the 1960s with the release of </a> </li>
							<li><a href="single.html">Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing </a> </li>
							<li><a href="single.html">Software like Aldus PageMaker including versionsof Lorem Ipsum.</a> </li>
						</ul>	
					</div>
					<div class="abt-2">
						<h3>NEWS LETTER</h3>
						<div class="news">
							<form>
								<input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" />
								<input type="submit" value="Subscribe">
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>			
			</div>		
		</div>
	</div>
	<!--about-end-->
	<!--footer-starts-->
	<?php 
		include_once 'Views/index/footer.php';
	 ?>
	<!--footer-end-->
</body>
</html>