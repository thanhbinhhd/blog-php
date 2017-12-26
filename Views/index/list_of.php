<?php 
	include_once 'Views/index/header.php';
 ?>

 <div class="container" style="margin-bottom: 100px;">
 <table>
 	<?php 
	foreach ($data as $row) {
 ?>
<tr style="margin-top: 50px;clear: both;overflow: hidden;">
	<td style="padding-right: 20px;">
		<img src="<?php echo $row['image'] ?>" style="width: 150px;height: 100px;">
	</td>
	<td style="padding: 20px">
		<p><b><?php echo $row['title'] ?></b></p>
		<p><?php echo $row['description'] ?></p>
		<p><small><span class="text-muted">Created at: <?php echo $row['created_at'] ?></span></small></p>
		<p><small><span class="text-muted">Updated at:<?php echo $row['updated_at'] ?></span></small></p>
		<a href="?mod=index&act=read&slug=<?php echo $row['slug'] ?>">Read more...</a>
	</td>
</tr>
 <?php 
}
  ?>
  </table>
 </div>

 <?php 
	include_once 'Views/index/footer.php';
 ?>