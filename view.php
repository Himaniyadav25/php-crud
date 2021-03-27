    <!DOCTYPE html>
<html lang="en">
<head>
  <title>View Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
	/* Style the header */
.header {
  background-color: #f1f1f1;
  padding: 20px;
  text-align: center;
}

/* Style the top navigation bar */
.topnav {
  overflow: hidden;
  background-color: #333;
  text-align: center;
}

/* Style the topnav links */
.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

/* Change color on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Style the footer */
.footer {
  background-color: #f1f1f1;
  padding: 10px;
  text-align: center;
}

.container{
	padding: 100px;
}
	</style>
</head>
<body>

<div class="header">
  <h1>Data Modification</h1>
  <p>You can see and Updte your information.</p>
  <div class="topnav">
  <a href="index.php">Home</a>
  <a href="view.php">Update</a>
  
</div>
</div>
<div class="container">
  <h2>View data</h2>
  <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<table class="table table-bordered table-sm" >
    <thead>
      <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
		<th>City</th>
		<th>Action</th>
      </tr>
    </thead>
    <tbody id="table">
      
    </tbody>
  </table>
</div>
<!-- Modal Update-->
    <div class="modal fade" id="update_country" role="dialog">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
			<div class="modal-header" style="color:#fff;background-color: #e35f14;padding:6px;">
			  <h5 class="modal-title"><i class="fa fa-edit"></i> Update</h5>
			 
			</div>
			<div class="modal-body">
			
				<!--1-->
				<div class="row">
					<div class="col-md-3">
					    <label>Name</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="name_modal" id="name_modal" class="form-control-sm" required>
					</div>	
				</div>
			    <!--2-->
				<div class="row">
					<div class="col-md-3">
					    <label>Email</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="email_modal" id="email_modal" class="form-control-sm" required>
					</div>	
				</div>
			    <!--3-->
				<div class="row">
					<div class="col-md-3">
					    <label>Phone</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="phone_modal" id="phone_modal" class="form-control-sm" required>
					</div>	
				</div>
				<!--4-->
				<div class="row">
					<div class="col-md-3">
					    <label>City</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="city_modal" id="city_modal" class="form-control-sm" required>
					</div>	
				</div>
				<input type="hidden" name="id_modal" id="id_modal" class="form-control-sm">
			</div>
			<div class="modal-footer" style="padding-bottom:0px !important;text-align:center !important;">
			<p style="text-align:center;float:center;">
			<button type="submit" id="update_data" class="btn btn-default btn-sm" style="background-color: #e35f14;color:#fff;">Save</button>
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="background-color: #e35f14;color:#fff;">Close</button></p>
			
		  </div>
		  </div>
		</div>
	</div>
<!-- Modal End-->


<!--delete Modal Update-->
    <div class="modal fade" id="delete_country" role="dialog">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
			<div class="modal-header" style="color:#fff;background-color: #e35f14;padding:6px;">
			  <h5 class="modal-title"><i class="fa fa-edit"></i> Delete</h5>
			 
			</div>
			<div class="modal-body">		
			    
		
				<div class="row">
				<div class="row">
					<div class="col-md-3">
					    <label>ID</label>
					</div>
					<div class="col-md-9">
						<input type="text" name="id_modal" id="id_modal" class="form-control-sm">
					</div>	
				</div>
					<div>
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>	
					</div>	
				</div>
				
			</div>
			<div class="modal-footer" style="padding-bottom:0px !important;text-align:center !important;">
			<p style="text-align:center;float:center;">
			<button type="submit" id="delete_data" name="delete_data" class="btn btn-default btn-sm" style="background-color: #e35f14;color:#fff;">Delete</button>
			<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="background-color: #e35f14;color:#fff;">Close</button></p>
			
		  </div>
		  </div>
		</div>
	</div>
<!-- delete Modal End-->

	


<script>
$(document).ready(function() {
	$.ajax({
		url: "View_ajax.php",
		type: "POST",
		cache: false,
		success: function(dataResult){
			$('#table').html(dataResult); 
		}
	});
	$(function () {
		$('#update_country').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); /*Button that triggered the modal*/
			var id = button.data('id');
			var name = button.data('name');
			var email = button.data('email');
			var phone = button.data('phone');
			var city = button.data('city');
			var modal = $(this);
			modal.find('#name_modal').val(name);
			modal.find('#email_modal').val(email);
			modal.find('#phone_modal').val(phone);
			modal.find('#city_modal').val(city);
			modal.find('#id_modal').val(id);
		});
    });
	$(document).on("click", "#update_data", function() { 
		$.ajax({
			url: "update_ajax.php",
			type: "POST",
			cache: false,
			data:{
				id: $('#id_modal').val(),
				name: $('#name_modal').val(),
				email: $('#email_modal').val(),
				phone: $('#phone_modal').val(),
				city: $('#city_modal').val(),
			},
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#update_country').modal().hide();
					alert('Data updated successfully !');
					location.reload();					
				}
			}
		});
	}); 
	
	
	$(function () {
		$('#delete_country').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); /*Button that triggered the modal*/
			var id = button.data('id');
			var modal = $(this);
			modal.find('#id_modal').val(id);
			
		});
		
		
    });
	
	$(document).on("click", "#delete_data", function() { 
		$.ajax({
			url: "delete_ajax.php",
			type: "POST",
			cache: false,
			data:{
				id: $('#id_modal').val(),
			},
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$('#delete_country').modal().hide();
					alert('Data deleted successfully !');
					location.reload();					
				}
			}
		});
	});
	
	
	
	$(document).on("click", "#delete_data1", function() { 
		var $ele = $(this).parent().parent();
		$.ajax({
			url: "delete_ajax.php",
			type: "POST",
			cache: false,
			data:{
				id: $(this).attr("data-id")
			},
			success: function(dataResult){
				var dataResult = JSON.parse(dataResult);
				if(dataResult.statusCode==200){
					$ele.fadeOut().remove();
				}
			}
		});
	});
});
</script>

<div class="footer">
  <p>@This is test project created by Himani yadav for seovelly.</p>
</div>
</body>
</html>
