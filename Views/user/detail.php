<?php 
	include_once 'Views/layout/header.php';
 ?>

<!-- Latest compiled and minified CSS & JS -->

<table class="table table-hover">
	<legend><h1>User Information <a href="?mod=posts" style="float: right;"><button type="button" class="btn btn-sm btn-success">Back</button></a></h1></legend>
	<tbody>
		<tr>
			<td>ID</td>
			<td><?php echo $user['id']; ?></td>
		</tr>
		<tr>
			<td>Name</td>
			<td id="uname"><?php echo $user['name']; ?></td>
		</tr>
		<tr>
			<td>Email</td>
			<td><?php echo $user['email']; ?></td>
		</tr>
		<tr>
			<td>Avatar</td>
			<td id="uimage"><img src="<?php echo $user['avatar']; ?>" style="width: 100px;height: 100px; "></td>
		</tr>
		<tr>
			<td>Mobile</td>
			<td id="umobile"><?php echo $user['mobile']; ?></td>
		</tr>
		<tr>
			<td>Rank</td>
			<td><?php echo $user['rank']; ?></td>
		</tr>
		<tr>
			<td>Birthday</td>
			<td id="ubirthday"><?php echo $user['birthday']; ?></td>
		</tr>
		<tr>
			<td>Address</td>
			<td id="uaddress"><?php echo $user['address']; ?></td>
		</tr>
	</tbody>
</table>
<button type="button" class="btn btn-primary" data-toggle="modal" onclick="alertEdit('<?php echo $user['id'] ?>')">Update User</button>
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>Edit User</strong></h1>
	        </div>
	        <div class="modal-body">
	          <form action="" method="POST" role="form2" enctype="multipart/form-data">
	              <div class="form-group">
	                  <label for="">Name</label>
	                  <input type="text" class="form-control" id="ename" name="name" placeholder="Name">
	              </div>
	              <div class="form-group">
	                  <label for="">avatar</label>
	                  <input type="file" id="eavatar" name="eavatar" accept="image/gif, image/jpeg, image/png">
	              </div>
	              <div class="form-group">
	                  <label for="">Mobile</label>
	                  <input type="text" class="form-control" id="emobile" name="mobile" placeholder="Mobile">
	              </div>
	               <div class="form-group">
	                  <label for="">Address</label>
	                  <input type="text" class="form-control" id="eaddress" name="address" placeholder="Address">
	              </div>
	              <div class="form-group">
	                  <label for="">Birthday</label>
	                  <input type="text" class="form-control" id="ebirthday" name="birthday" placeholder="Birthday">
	              </div>
	              <input type="hidden" class="form-control" id="euser_id" value="">
	            </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="button" id="eSaveBtn" class="btn btn-primary">Save changes</button>
	        </div>
	      </div>
    	</div>
	</div>
 <?php 
 	include_once 'Views/layout/footer.php';
  ?>

  <script type="text/javascript">
  	// Edit
		function alertEdit(id) {
			$("#editUser").modal('show');
			$.ajax({
				type: "GET",
				url: "?mod=users&act=edit&id="+id,
				success: function (res)
				{
					console.log(res);
					var result = JSON.parse(res);
					var status = result.status;
					if(status)
					{
						var data=result.data;
						$("#ename").val(data.name);
						$("#ebirthday").val(data.birthday);
						$("#emobile").val(data.mobile);
						$("#eaddress").val(data.address);
						$("#euser_id").val(id); 
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
              }
			});
		}

		// Update
		$(document).ready(function () {
			$("#eSaveBtn").on("click",function () {
				var name=$("#ename").val();
				var birthday=$("#ebirthday").val();
				var mobile=$("#emobile").val();
				var address=$("#eaddress").val();
				var id=$("#euser_id").val();
				$.ajax({
					url: '?mod=users&act=update',
					type: 'post',
					data: {
						name:name,
						mobile:mobile,
						address:address,
						birthday:birthday,
						id:id,
					},
					success:function (res) {
						console.log(res);
						if(!res.error)
						{
							var result=JSON.parse(res);
							var status=result.status;
							if(status)
							{
								var data=result.data;
								$("#editUser").modal("hide");
								$("#uname").html(data.name);
								$("#uaddress").html(data.address);
								$("#ubirthday").html(data.birthday);
								$("#umobile").html(data.mobile);
								// var uimg='<img src="'+data.image+'" style="width: 100px;height: 100px; ">';
								// $("#uimage").html(uimg);
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
		});
  </script>