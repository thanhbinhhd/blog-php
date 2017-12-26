<?php 
	include_once 'Views/index/header.php';
 ?>
 <?php if(isset($_SESSION['login'])&&($_SESSION['login']['id']==$author['id'])){ ?>
 	<div style="margin: 20px;float: right;">
 	<select name="Option" id="">
 		<option value="">--option--</option>
 		<option value=""><a href="javascript:;" type="button" onclick="alertEdit('<?php echo $row['id']; ?>')" class="btn btn-success">Update</a></option>
 		<option value=""><a href="javascript:;" type="button" onclick="delEdit('<?php echo $row['id']; ?>')" class="btn btn-success">Delete</a>
 	</select>
 	<a href="?mod=posts"><button type="button" class="btn btn-primary">Back</button></a>
 	</div>
 <?php } ?>
	<!--start-single-->
	<div class="single">
		<div class="container">
				<div class="single-top">
						<a href="#"><img class="img-responsive" src="<?php echo $post['image']; ?>" style="width:80%;height: auto;margin: auto;"></a>
					<div class=" single-grid">
						<h2><?php echo $post['title'] ?></h2>				
							<ul class="blog-ic">
								<li><a href="?mod=index&act=list_of_author&id=<?php echo $author['id'] ?>"><span> <i  class="glyphicon glyphicon-user"> </i><?php echo $author['name'] ?></span> </a> </li>
		  						 <li><span><i class="glyphicon glyphicon-time"> </i><?php echo $post['created_at'] ?></span></li>		  						 	
		  						 <li><span><i class="glyphicon glyphicon-eye-open"> </i>Hits:145</span></li>
		  					</ul>		  						
						<p><?php echo $post['content']; ?></p>
						<p><?php echo $post['content']; ?></p>
						<p><?php echo $post['content']; ?></p>
						<p><?php echo $post['content']; ?></p>
						<div style="opacity: 0.8">Tags: 
							<?php foreach ($tags as $row) {?>
								<a href="?mod=index&act=list_of_tag&id=<?php echo $row['id'] ?>" class="btn"><?php echo $row['name'] ?></a>
							<?php } ?>
						</div>
					</div>
					<?php if(isset($_SESSION['login'])){ ?>
					<div class="comments heading">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11';
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-comments" data-href="https://developers.facebook.com/docs/plugins/comments#configurator" data-numposts="5"></div>
						<!-- <h3>Comments</h3>
						<div class="media">
					      	<div class="media-body">
						        <h4 class="media-heading">	Richard Spark</h4>
						        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs .  </p>
					      	</div>
					      <div class="media-right">
					        <a href="#">
								<img src="Public/images/si.png" alt=""> </a>
					      </div>
					 </div>
					  <div class="media">
					      <div class="media-left">
					        <a href="#">
					        	<img src="Public/images/si.png" alt="">
					        </a>
					      </div>
					      <div class="media-body">
					        <h4 class="media-heading">Joseph Goh</h4>
					        <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs .  </p>
					      </div>
					    </div>
    				</div>
    				<div class="comment-bottom heading">
    					<h3>Leave a Comment</h3>
    					<form>	
						<input type="text" value="Name" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Name';}">
						<input type="text" value="Email" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Email';}">
						<input type="text" value="Subject" onfocus="this.value='';" onblur="if (this.value == '') {this.value ='Subject';}">
						<textarea cols="77" rows="6" value=" " onfocus="this.value='';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
							<input type="submit" value="Send">
					</form> -->
    				</div>
    				<?php } else{ ?>
    					<center style="margin-top: 50px;"><a href="?mod=users&act=login&slug=<?php echo $post['slug'] ?>">Please login to comment</a></center>
    				<?php } ?>
				</div>	
			</div>					
	</div>
	<!--end-single-->
	<?php 
		include_once 'Views/index/footer.php';
	 ?>
</body>
</html>