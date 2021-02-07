<style>

.box  
{  
	width:90%;  
	padding:20px;  
	background-color:#fff;  
	
	border-radius:5px;  
	
}  

.text-danger{
  color:red;
}
label {
    margin-top: -40px !important;
}


@media screen and (max-width: 500px) {
    #wid {
        margin-left:30px;
    }
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo  base_url('Admin/add_customer');?>" class="tip-bottom">Add Customer</a> <a href="#" class="current">List Customer</a> </div>

    </div>
  <div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>List Customer</h5>
                          <br><br>
       <div><a href="<?php echo  base_url('Admin/add_customer');  ?>" class="btn btn-danger pull-right" >Add Customer</a></div>
                    </div>
                    <div class="widget-content nopadding" style="overflow-x:scroll;">
					<div class="container box">  
                       <div class="table-responsive">  
                <br /> 
                      <table class="table table-bordered" id="user_data">
              <thead>
                <tr>
                	 <th>Serial No</th>
                	 <th>Customer Name</th>
				  <th>Customer Address</th>
                   <th> Registration Number</th>
                   <th>Chassis Number </th>
                  <th>Engine Number </th>
                  <th>Model Name </th> 
                  <th>Contact Number</th> 
                  <th>GSTIN No</th>
                  <th> Date of Sale</th>
                  <th> Email Id</th>  
                  <th>Actions</th> 
                </tr>
              </thead>
      
</table>

</div>
</div>
                    </div>

                </div>
         
        </div>
    </div>
</div>

  <script>
setTimeout(function() {
    $('#mydiv').fadeOut('slow');
}, 1000); // <-- time in milliseconds
</script>
<script type="text/javascript" language="javascript" >  
 $(document).ready(function(){  
      var dataTable = $('#user_data').DataTable({  
           "processing":true,  
           "serverSide":true,  
           "order":[],  
           "ajax":{  
                url:"<?php echo base_url() . 'Admin/fetch_user'; ?>",  
                type:"POST"  
           },  
           "columnDefs":[  
                {  
                     "targets":[0, 3, 4],  
                     "orderable":false,  
                },  
           ],  
      });  
 });  
 </script> 
