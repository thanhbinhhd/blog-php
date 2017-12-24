<?php 
	include_once 'Views/layout/header.php';
 ?>
	<div class="container-fluid">
		<legend>
			<h1>List tags</h1>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addTag">Add Tag</button>
		</legend>
		<table id="data_table" class="table table-hover">
			<thead>
				<tr class="flag">
					<th>ID</th>
					<th>Name</th>
					<th>Post_id</th>
					<th>Created_at</th>
					<th>Updated_at</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $row): ?>
					<tr id="tag_<?php echo $row['id']; ?>">
						<td><?php echo $row['id'] ?></td>
						<td><?php echo $row['name'] ?></td>
						<td align="center"><?php echo $row['post_id'] ?></td>
						<td><?php echo $row['created_at'] ?></td>
						<td><?php echo $row['created_at'] ?></td>
						<td>
							<a href="javascript:;" type="button" onclick="alertEdit('<?php echo $row['id']; ?>')" class="btn btn-success">update</a>
							<a href="javascript:;" type="button" onclick="alertDel('<?php echo $row['id']; ?>')" class="btn btn-danger">delete</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<!-- Add modal -->
	<div class="modal fade" id="addTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>Add Tag</strong></h1>
	        </div>
	        <div class="modal-body">
	          <form action="" method="POST" role="form">
	          	<div class="form-group">
	          		<label for="id">ID</label>
	          		<input type="text" class="form-control" id="id" placeholder="ID">
	          	</div>
	          	<div class="form-group">
	          		<label for="name">Name</label>
	          		<input type="text" class="form-control" id="name" placeholder="Name">
	          	</div>
	          	<div class="form-group">
	          		<label for="post_id">Post_id</label>
	          		<input type="text" class="form-control" id="post_id" placeholder="Post_id">
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

	<!-- Edit modal -->
	<div class="modal fade" id="editTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>Edit Tag</strong></h1>
	        </div>
	        <div class="modal-body">
	          <form action="" method="POST" role="form">
	          	<div class="form-group">
	          		<label for="name">Name</label>
	          		<input type="text" class="form-control" id="ename" placeholder="Name">
	          	</div>
	          	<div class="form-group">
	          		<label for="post_id">Post_id</label>
	          		<input type="text" class="form-control" id="epost_id" placeholder="Post_id">
	          	</div>
	          	<input type="text" name="eid" id="eid" class="hide">
	          </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="button" id="eSaveBtn" class="btn btn-primary">Add Post</button>
	        </div>
	      </div>
    	</div>
	</div>
 <?php 
 	include_once 'Views/layout/footer.php';
  ?>

  <script type="text/javascript">
  	$(document).ready(function () {
  		$("#SaveBtn").on('click', function() {
  			var id=$("#id").val();
  			var name=$("#name").val();
  			var post_id=$("#post_id").val();
  			$.ajax({
  				url: '?mod=tags&act=store',
  				type: 'post',
  				data:{
  					id:id,
  					name:name,
  					post_id:post_id,
  				},
  				success:function(res) {
  					console.log(res);
		            if(!res.error) {
		              var result = JSON.parse(res);
		              console.log(result);
		              var status = result.status;
		              if(status){
		                var data = result.data;
		                $('#addTag').modal('hide');
		                var flag = $('.flag');
		                var html ='<tr id="tag_'+data.id+'">'+
		                    '<td>'+data.id+'</td>'+
		                    '<td>'+data.name+'</td>'+
		                    '<td align="center">'+data.post_id+'</td>'+
		                    '<td>'+data.created_at+'</td>'+
		                    '<td>'+data.updated_at+'</td>'+
		                    '<td>'+
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
		              }else{
		                toastr.error('Thêm mới không thành công!', 'Nafosted',{timeOut: 1000})
		              }
		            } else {
		              toastr.error('Error', 'Nafosted-Error',{timeOut: 1000})
		            }
  				},
  				error: function (xhr, ajaxOptions, thrownError) {
		            toastr.error('Error', 'Nafosted-Error',{timeOut: 1000})
		          }
  			});
  			
  		});
  	})

  	function alertDel(id)
	{
		var path = "?mod=tags&act=delete&id=" + id;
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
							$("#tag_"+id).remove();
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
		$("#editTag").modal("show");
		$.ajax({
			url: '?mod=tags&act=edit&id='+id,
			type: 'GET',
			success:function (res) {
				var result=JSON.parse(res);
				var status=result.status;
				if(status)
				{
					var data=result.data;
					$("#ename").val(data.name);
					$("#epost_id").val(data.post_id);
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
			var name=$("#ename").val();
			var post_id=$("#epost_id").val();
			var id=$("#eid").val();
			$.ajax({
				url: '?mod=tags&act=update',
				type: 'post',
				data: {
  					id:id,
  					name:name,
  					post_id:post_id,
				},
				success:function (res) {
					if(!res.error)
					{
						var result=JSON.parse(res);
						var status=result.status;
						if(status)
						{
							var data=result.data;
							$("#editTag").modal("hide");
							var html='<td>'+data.id+'</td>'+
		                    '<td>'+data.name+'</td>'+
		                    '<td align="center">'+data.post_id+'</td>'+
		                    '<td>'+data.created_at+'</td>'+
		                    '<td>'+data.updated_at+'</td>'+
		                    '<td>'+
		                    '<a href="javascript:;" type="button" onclick="alertEdit('+data.id+')" class="btn btn-success">'+
		                      'update'+
		                    '</a> '+
		                    '<a href="javascript:;" type="button" onclick="alertDel('+data.id+')" class="btn btn-danger">'+
		                      'delete'+
		                    '</a>'+
		                    '</td>';
		                    $("#tag_"+id).html(html);
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
	})
  </script>