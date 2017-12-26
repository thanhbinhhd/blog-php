<?php 
	include_once 'Views/layout/header.php';
 ?>
	<div class="container-fluid">
		<legend>
			<h1>List Users</h1>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">Add User</button>
		</legend>
		<table id="data_table" class="table table-hover">
			<thead>
				<tr class="flag">
					<th>ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Rank</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $row): ?>
					<tr id="user_<?php echo $row['id']; ?>">
						<td><?php echo $row['id'] ?></td>
						<td><?php echo $row['name'] ?></td>
						<td><?php echo $row['email'] ?></td>
						<td><?php echo $row['mobile'] ?></td>
						<td><?php echo ($row['privilege']==1)?"System admin":"Member" ?></td>
						<td>
							<a href="javascript:;" type="button" onclick="alertView('<?php echo $row['id']; ?>')" class="btn btn-info">View</a>
							<a href="javascript:;" type="button" onclick="alertEdit('<?php echo $row['id']; ?>')" class="btn btn-success">update</a>
							<a href="javascript:;" type="button" onclick="alertDel('<?php echo $row['id']; ?>')" class="btn btn-danger">delete</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>

	<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>Add Usert</strong></h1>
	        </div>
	        <div class="modal-body">
	          <form action="" method="POST" role="form">
	              <div class="form-group">
	                  <label for="">Họ tên</label>
	                  <input type="text" class="form-control" id="name" placeholder="Họ tên" name="name">
	              </div>
	              <div class="form-group">
	                  <label for="">Số điện thoại</label>
	                  <input type="text" class="form-control" id="mobile" placeholder="Nhập vào số điện thoại" name="mobile">
	              </div>
	              <div class="form-group">
	                  <label for="">Email</label>
	                  <input type="text" class="form-control" id="email" placeholder="Nhập vào email" name="email">
	              </div>
	              <div class="form-group">
	                  <label for="">Password</label>
	                  <input type="password" class="form-control" id="password" placeholder="Nhập vào password" name="password">
	              </div>
	              <div class="form-group">
	                  <label for="">Rank</label>
	                  <select name="" id="privilege">
	                  	<option value="1">System Admin</option>
	                  	<option value="0">Member</option>
	                  </select>
	              </div>
	               <div class="form-group">
	                  <label for="">Địa chỉ</label>
	                  <input type="text" class="form-control" id="address" placeholder="Nhập vào địa chỉ" name="address">
	              </div>
	            </form>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	          <button type="button" id="SaveBtn" class="btn btn-primary">Save changes</button>
	        </div>
	      </div>
    	</div>
	</div>

	<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>Edit User</strong></h1>
	        </div>
	        <div class="modal-body">
	          <form action="" method="POST" role="form2">
	              <div class="form-group">
	                  <label for="">Họ tên</label>
	                  <input type="text" class="form-control" id="ename" name="name">
	              </div>
	              <div class="form-group">
	                  <label for="">Số điện thoại</label>
	                  <input type="text" class="form-control" id="emobile" name="mobile">
	              </div>
	              <div class="form-group">
	                  <label for="">Email</label>
	                  <input type="text" class="form-control" id="eemail" name="email">
	              </div>
	              <div class="form-group">
	                  <label for="">Rank</label>
	                  <select name="" id="eprivilege">
	                  	<option value="1">System Admin</option>
	                  	<option value="0">Member</option>
	                  </select>
	              </div>
	               <div class="form-group">
	                  <label for="">Địa chỉ</label>
	                  <input type="text" class="form-control" id="eaddress" name="address">
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

	<div class="modal fade" id="viewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	        <div class="modal-header">
	          <h1 class="text-center"><strong>User Information</strong></h1>
	        </div>
	        <div class="modal-body">
	          <div class="table-responsive">
	          	<table class="table table-hover">
	          		<tbody>
	          			<tr>
	          				<td>ID</td>
	          				<td id="vid"></td>
	          			</tr>
	          			<tr>
	          				<td>Name</td>
	          				<td id="vname"></td>
	          			</tr>
	          			<tr>
	          				<td>Email</td>
	          				<td id="vemail"></td>
	          			</tr>
	          			<tr>
	          				<td>Mobile</td>
	          				<td id="vmobile"></td>
	          			</tr>
	          			<tr>
	          				<td>avatar</td>
	          				<td id="vavatar"></td>
	          			</tr>
	          			<tr>
	          				<td>Rank</td>
	          				<td id="vprivilege"></td>
	          			</tr>
	          			<tr>
	          				<td>Gender</td>
	          				<td id="vgender"></td>
	          			</tr>
	          			<tr>
	          				<td>Birthday</td>
	          				<td id="vbirthday"></td>
	          			</tr>
	          			<tr>
	          				<td>Address</td>
	          				<td id="vaddress"></td>
	          			</tr>
	          		</tbody>
	          	</table>
	          </div>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        </div>
	      </div>
    	</div>
	</div>
 <?php 
 	include_once 'Views/layout/footer.php';
  ?>
	<script type="text/javascript">
		$(document).ready(function () {
		    $('#SaveBtn').click(function() {
		        var name = $('#name').val();
		        var mobile = $('#mobile').val();
		        var email = $('#email').val();
		        var password = $('#password').val();
		        var address = $('#address').val();
		        var privilege=$('#privilege').val();
		        $.ajax({
		          type: "post",
		          url: '?mod=users&act=store',
		          data: {
		            name : name,
		            mobile : mobile,
		            email : email,
		            password : password,
		            privilege:privilege,
		            address : address,
		          },
		          success: function(res)
		          {
		            console.log(res);
		            if(!res.error) {
		              var result = JSON.parse(res);
		              console.log(result);
		              var status = result.status;
		              if(status){
		                var data = result.data;
		                $('#addUser').modal('hide');
		                var flag = $('.flag');
		                var privilege=(data.privilege==1)?"System admin":"Member";
		                var html ='<tr id="user_'+data.id+'">'+
		                    '<td>'+data.id+'</td>'+
		                    '<td>'+data.name+'</td>'+
		                    '<td>'+data.email+'</td>'+
		                    '<td>'+data.mobile+'</td>'+
		                    '<td>'+privilege+'</td>'+
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
		});

		 // Delete
		function alertDel(id) {
			var path = "?mod=users&act=delete&id=" + id;
		      swal({
		        title: "Do you want delete?",
		        // text: "Bạn sẽ không thể khôi phục lại bản ghi này!!",
		        type: "warning",
		        showCancelButton: true,
		        confirmButtonColor: "#DD6B55",
		        cancelButtonText: "No",
		        confirmButtonText: "Yes",
		        // closeOnConfirm: false,
		      },
		      function(isConfirm) {
		        if (isConfirm) {
		          $.ajax({
		            type: "post",
		            url: path,
		            success: function(res)
		              {
		                console.log(res);
		                if(!res.error) {
		                  toastr.success('Delete is successfully!');
		                  $('#user_'+id).remove();
		                }
		              },
		              error: function (xhr, ajaxOptions, thrownError) {
		                toastr.error(thrownError);
		              }
		            });
		        } else {
		          toastr.info("Thao tác xóa đã bị huỷ bỏ!");
		        }
		      });
		};

		// Edit
		function alertEdit(id) {
			$("#editUser").modal('show');
			$.ajax({
				type: "GET",
				url: "?mod=users&act=edit&id="+id,
				success: function (res)
				{
					var result = JSON.parse(res);
					var status = result.status;
					if(status)
					{
						var data=result.data;
						$("#ename").val(data.name);
						$("#eemail").val(data.email);
						$("#emobile").val(data.mobile);
						$("#eaddress").val(data.address);
						$("#euser_id").val(id);
						$("#eprivilege").val(data.privilege);
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
				var email=$("#eemail").val();
				var mobile=$("#emobile").val();
				var address=$("#eaddress").val();
				var privilege=$("#eprivilege").val();
				var id=$("#euser_id").val();
				$.ajax({
					url: '?mod=users&act=update',
					type: 'post',
					data: {
						email : email,
						name:name,
						mobile:mobile,
						address:address,
						privilege:privilege,
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
								var privilege=(data.privilege==1)?"System admin":"Member";
								$("#editUser").modal("hide");
								var html =
			                    '<td>'+data.id+'</td>'+
			                    '<td>'+data.name+'</td>'+
			                    '<td>'+data.email+'</td>'+
			                    '<td>'+data.mobile+'</td>'+
			                    '<td>'+privilege+'</td>'+
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

			                    $("#user_"+data.id).html(html);
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

		function alertView(id) {
			$("#viewUser").modal("show");
			$.ajax({
				url: '?mod=users&act=detail&id='+id,
				type: 'GET',
				success: function (res) {
					var result=JSON.parse(res);
					var status = result.status;
					if(status)
					{
						var data = result.data;
						var privilege = (data.privilege==1)?"System Admin":"Member";
						var avatar = '<img src="'+data.avatar+'" height="150" width="150">';
						var gender = (data.gender==1)?'Male':'Female';
						$("#vid").html(data.id);
						$("#vname").html(data.name);
						$("#vemail").html(data.email);
						$("#vavatar").html(avatar);
						$("#vgender").html(gender);
						$("#vbirthday").html(data.birthday);
						$("#vaddress").html(data.address);
						$("#vprivilege").html(privilege);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
                toastr.error(thrownError);
             	 }
			});
			
		}
	</script>
