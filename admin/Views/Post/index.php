<?php 
	include_once 'Views/layout/header.php'; ?>
	<div class="container-fluid">
		<legend>
			<h1>List Posts</h1>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPost">Add Posts</button>
		</legend>
		<table id="data_table" class="table table-hover">
			<thead>
				<tr class="flag">
					<th>ID</th>
					<th>ID User</th>
					<th>Title</th>
					<th>Description</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $row): ?>
					<tr id="post_<?php echo $row['id']; ?>">
						<td><?php echo $row['id'] ?></td>
						<td><?php echo $row['user_id'] ?></td>
						<td style="width: 25%"><?php echo substr($row['title'], 5) ?></td>
						<td style="width: 25%"><?php echo $row['description'] ?></td>
						<td>
							<label class="switch">
							  <input type="checkbox" <?php if($row['status']==1) {?> checked <?php } ?> class="status">
							  <span class="slider round"></span>
							</label>
						</td>
						<td style="width: 25%">
							<a href="?mod=posts&act=detail&id=<?php echo $row['id']; ?>" class="btn btn-info">View</a>
							<a href="javascript:;" type="button" onclick="alertEdit('<?php echo $row['id']; ?>')" class="btn btn-success">update</a>
							<a href="javascript:;" type="button" onclick="alertDel('<?php echo $row['id']; ?>')" class="btn btn-danger">delete</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<!-- add modal -->
	<div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document" style="width: 70%">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>Add Post</strong></h1>
	        </div>
	        <div class="modal-body">
	          <form action="" method="POST" role="form">
          		<input type="text" id="user_id" class="hide" value="<?php echo $_SESSION['login']['id'] ?>">
	          	<div class="form-group">
	          		<label for="title">Title</label>
	          		<input type="text" class="form-control" id="title" placeholder="Title">
	          	</div>
	          	<div class="form-group">
	          		<label for="image">Image</label>
	          		<input type="text" class="form-control" id="image" placeholder="Image link">
	          	</div>
	          	<div class="form-group">
	          		<label for="description">Description</label>
	          		<input type="text" class="form-control" id="description" placeholder="Description">
	          	</div>
	          	<div class="form-group">
	          		<label for="content">Content</label>
	          		<textarea id="content" placeholder="Content"></textarea>
	          	</div>
	          </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="button" id="SaveBtn" class="btn btn-primary">Add Post</button>
	        </div>
	      </div>
    	</div>
	</div>

	<!-- edit modal -->
	<div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document" style="width: 70%">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>Edit Post</strong></h1>
	        </div>
	        <div class="modal-body">
	          <form action="" method="POST" role="form">
	          	<input type="text" id="user_id" class="hide" value="<?php echo $_SESSION['login']['id'] ?>">
	          	<div class="form-group">
	          		<label for="title">Title</label>
	          		<input type="text" class="form-control" id="etitle" placeholder="Title">
	          	</div>
	          	<div class="form-group">
	          		<label for="image">Image</label>
	          		<input type="text" class="form-control" id="eimage" placeholder="Image link">
	          	</div>
	          	<div class="form-group">
	          		<label for="description">Description</label>
	          		<input type="text" class="form-control" id="edescription" placeholder="Description">
	          	</div>
	          	<div class="form-group">
	          		<label for="content">Content</label>
	          		<textarea id="econtent" placeholder="Content"></textarea>
	          	</div>
	          	<input type="text" name="eid" id="eid" class="hide">
	          </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="button" id="eSaveBtn" class="btn btn-primary">Update</button>
	        </div>
	      </div>
    	</div>
	</div>

	<script type="text/javascript" src="Views/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
		CKEDITOR.replace('content');
		CKEDITOR.replace('econtent');
	</script>
 <?php 
 	include_once 'Views/layout/footer.php';
  ?>

  <script type="text/javascript">
  	$(document).ready(function () {
  		$("#SaveBtn").on("click",function () {
  			var user_id=$("#user_id").val();
  			var title=$("#title").val();
  			var image=$("#image").val();
  			var status='0';
  			var description=$("#description").val();
  			var content=CKEDITOR.instances.content.getData();
  			$.ajax({
  				url: '?mod=posts&act=store',
  				type: 'post',
  				data:{
  					status:status,
  					user_id:user_id,
  					title:title,
  					image:image,
  					description:description,
  					content:content,
  				},
  				success:function (res) {
  					console.log(res);
  					if(!res.error)
  					{
  						var result=JSON.parse(res);
  						console.log(result);
  						var status = result.status;
  						if(status)
  						{
  							var data=result.data;
  							data.status=(data.status==1)?"Ready":"Waiting";
  							$("#addPost").modal("hide");
  							var flag=$(".flag");
  							var html='<tr id="post_'+data.id+'">'+
		                    '<td>'+data.id+'</td>'+
		                    '<td>'+data.user_id+'</td>'+
		                    '<td>'+data.title+'</td>'+
		                    '<td>'+data.description+'</td>'+
		                    '<td>'+data.status+'</td>'+
		                    '<td>'+
		                    '<a href="javascript:;" type="button" onclick="alertView('+data.id+')" class="btn btn-info">'+
		                      'View'+
		                    '</a> '+
		                    '<a href="javascript:;" type="button" onclick="alertEdit('+data.id+')" class="btn btn-success">'+
		                      'update'+
		                    '</a> '+
		                    '<a href="javascript:;" type="button" onclick="alertDel('+data.id+')" class="btn btn-danger">'+
		                      'delete'+
		                    '</a>'+
		                    '</td>'+
		                  '</tr>';
		                  	$(html).insertAfter(flag);
		                	toastr.success('Thêm mới thành công!', 'Nafosted',{timeOut: 1000});
  						}
  						else
  						{
		                	toastr.error('Thêm mới không thành công!', 'Nafosted',{timeOut: 1000});
  						}
  					}
  					else
  					{
  						toastr.error('Error', 'Nafosted-Error',{timeOut: 1000});
  					}
  				},
  				error: function (xhr, ajaxOptions, thrownError) {
		            toastr.error('Error', 'Nafosted-Error',{timeOut: 1000});
		          }
  			});

  		});
  	})


	function alertDel(id)
	{
		var path = "?mod=posts&act=delete&id=" + id;
		swal({
			title: "Do you want delete??",
			type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#DD6B55",
	        cancelButtonText: "No",
	        confirmButtonText: "Yes",
		},
		function (isConfirm) {
			if(isConfirm)
			{
				$.ajax({
					url: path,
					type: 'post',
					success: function (res) {
						console.log(JSON.parse(res).status);
						if(!res.error)
						{
							toastr.success("Delete is successfully!");
							$("#post_"+id).remove();
						}
					},
					error:function (xhr, ajaxOptions, thrownError) {
		                toastr.error(thrownError);
		              }
				});
				
			}
			else
			{
				toastr.info("Delete operation has been canceled!");
			}
		});
	};

	function alertEdit(id) {
		$("#editPost").modal("show");
		$.ajax({
			url: '?mod=posts&act=edit&id='+id,
			type: 'GET',
			success:function (res) {
				var result=JSON.parse(res);
				var status=result.status;
				if(status)
				{
					var data=result.data;
					$("#euser_id").val(data.user_id);
					$("#etitle").val(data.title);
					$("#edescription").val(data.description);
					$("#eimage").val(data.image);
					CKEDITOR.instances.econtent.setData(data.content);
					$("#eid").val(id);
				}
			},
			error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
		});
	}

	$(document).ready(function () {
		$("#eSaveBtn").on('click', function() {
			var title=$("#etitle").val();
			var image=$("#eimage").val();
			var description=$("#edescription").val();
			var content=CKEDITOR.instances.econtent.getData();
			var id=$("#eid").val();
			$.ajax({
				url: '?mod=posts&act=update',
				type: 'post',
				data: {
					title:title,
					image:image,
					description:description,
					content:content,
					id:id,
				},
				success:function (res) {
					if(!res.error)
					{
						var result=JSON.parse(res);
						var status=result.status;
						if(status)
						{
							var data=result.data;
							data.status=(data.status==1)?"Ready":"Waiting";
							$("#editPost").modal("hide");
							var html='<td>'+data.id+'</td>'+
		                    '<td>'+data.user_id+'</td>'+
		                    '<td>'+data.title+'</td>'+
		                    '<td>'+data.description+'</td>'+
		                    '<td>'+data.status+'</td>'+
		                    '<td>'+
		                    '<a href="javascript:;" type="button" onclick="alertView('+data.id+')" class="btn btn-info">'+
		                      'View'+
		                    '</a> '+
		                    '<a href="javascript:;" type="button" onclick="alertEdit('+data.id+')" class="btn btn-success">'+
		                      'update'+
		                    '</a> '+
		                    '<a href="javascript:;" type="button" onclick="alertDel('+data.id+')" class="btn btn-danger">'+
		                      'delete'+
		                    '</a>'+
		                    '</td>';
		                    $("#post_"+id).html(html);
		                    toastr.success('Cập nhật thành công!','Nafosted',{timeOut: 1000});
						}
						else
						{
							toastr.error('Cập nhật không thành công!', 'Nafosted',{timeOut: 1000});
						}
					}
					else
					{
						toastr.error('Error', 'Nafosted-Error',{timeOut: 1000});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
		            toastr.error('Error', 'Nafosted-Error',{timeOut: 1000})
		        	}
			});
		});

		$(".status").change(function () {
			var status;
			if($(this).is(":checked"))
				status =1;
			else status = 0;
			console.log(status);
			var id=$(this).parents("tr").children("td:first-child").html();
			$.ajax({
				url: '?mod=posts&act=update',
				type: 'post',
				data: {
					status:status,
					id:id,
				},
				success:function (res) {
					if(!res.error)
					{
						var result=JSON.parse(res);
						var status=result.status;
						if(status)
						{
		                    toastr.success('Update is successfully!','Nafosted',{timeOut: 1000});
						}
						else
						{
							toastr.error('Update is false!', 'Nafosted',{timeOut: 1000});
						}
					}
					else
					{
						toastr.error('Error', 'Nafosted-Error',{timeOut: 1000});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
		            toastr.error('Error', 'Nafosted-Error',{timeOut: 1000})
		        	}
			});
		})
	})

  </script>