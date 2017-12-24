<?php 
	include_once 'Views/layout/header.php';
 ?>
 <a href="?mod=posts" style="float: right"><button type="button" class="btn btn-primary">Back</button></a>
<center>
	<h1><?php echo $post['title']; ?></h1>
	<img src="<?php echo $post['image'] ?>">
</center>
	<p><?php echo $post['content']; ?></p>
	<p class="text-muted">
		create at: <?php echo $post['created_at'] ?>
	</p>
	<p class="text-muted">update at: <?php echo $post['updated_at'] ?></p>

 <?php 
 	include_once 'Views/layout/footer.php';
  ?>