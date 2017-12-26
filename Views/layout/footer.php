<!-- footer content -->
        
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="Views/layout/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="Views/layout/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="Views/layout/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="Views/layout/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="Views/layout/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="Views/layout/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="Views/layout/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="Views/layout/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="Views/layout/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="Views/layout/vendors/Flot/jquery.flot.js"></script>
    <script src="Views/layout/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="Views/layout/vendors/Flot/jquery.flot.time.js"></script>
    <script src="Views/layout/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="Views/layout/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="Views/layout/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="Views/layout/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="Views/layout/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="Views/layout/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="Views/layout/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="Views/layout/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="Views/layout/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="Views/layout/vendors/moment/min/moment.min.js"></script>
    <script src="Views/layout/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="Views/layout/build/js/custom.min.js"></script>
	
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#data_table').DataTable();
    } );
    </script>
  </body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $("#changePassBtn").on('click', function() {
            var password = $("#cpass").val();
            var new_password = $("#cnewpass").val();
            var confirm_password = $("#ccomfirmpass").val();
            var cpass1 = $("#cpass1").val();
            var id = $("#cid").val();
            if(password!=cpass1)
            {
                toastr.info("Password is false!",{timeOut: 1000});
            }
            else if(new_password!=confirm_password)
            {
                toastr.info("Confirm password is false!",{timeOut: 1000});
            }
            else
            {
                $.ajax({
                    url: '?mod=users&act=update',
                    type: 'post',
                    data: {
                        password:new_password,
                        id:id,
                    },
                    success:function (res) {
                        if(!res.error)
                        {
                            var result=JSON.parse(res);
                            var status=result.status;
                            if(status)
                            {
                                toastr.success('Cập nhật thành công!','Nafosted',{timeOut: 1000});
                                $("#changePass").modal("hide");
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
            }
        });
    })
</script>