<style>
.text-danger
{
  color:red;
}
@media screen and (max-width: 500px) {
    #wid {
        margin-left:30px;
    }
}
#locationCodesParent{ 
    position: relative;
    width: 550px;
    height: -230px;
}
</style>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="<?php echo  base_url('Admin/admin_home_page');?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>  <a href="<?php echo  base_url('Admin/add_customer');?>" class="current">Add Customer</a> </div>

    </div>
  <div id="mydiv"> <h4><?php echo $this->session->flashdata('msg'); ?></h4></div>
    <div class="container-fluid">
        <div class="row-fluid">
          
                <div class="widget-box">

                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Add Customer</h5>

                     <a class="btn btn-danger pull-right" href="<?php echo base_url('Admin/list_customer');?>"><b>List Customer</b></a>

                    </div>
                    <div class="widget-content nopadding">
                        <form action="<?php 
                echo  base_url('Admin/customer_add');?>" method="post" class="form-horizontal" name="add">

         <div class="span12">
          <div class="span5"> 
<br>          
                            <div class="control-group">
                                <label class="control-label">Customer Name:</label>
                                <div class="controls">
                    <input type="text"  name="c_name" class="span11" placeholder="Customer name"/>
                   <span class="text-danger"><?php echo form_error('c_name'); ?></span>
                                </div>                
                            </div>
               <div class="control-group">
                                <label class="control-label">Address :</label>
                                <div class="controls">
                <textarea name="c_address" class="span11" placeholder="Your address" placeholder="Customer address"></textarea>
                   <span class="text-danger"><?php echo form_error('c_address'); ?></span>
                                </div>                
                            </div>

                            <div class="control-group">
                                <label class="control-label">Registration Number :</label>
                                <div class="controls">
                                    <input type="text" name="c_r_no" id="reg" class="span11" placeholder="Registration no" />
                  <span class="text-danger"><?php echo form_error('c_r_no'); ?></span>
                                </div>                
                            </div>

                            <div class="control-group">
                                <label class="control-label">Chassis No :</label>
                                <div class="controls">
                                    <input type="text" name="c_c_no" class="span11" placeholder="Chassis no" />
                  <span class="text-danger"><?php echo form_error('c_c_no'); ?></span>
                                </div>                
                            </div>
                               <div class="control-group">
                                <label class="control-label">Model Name :</label>
								 <div class="controls" id="locationCodesParent" style="margin-left:200px">
                                    <select class=" item1" name="c_m"  id="ins"  style="width:300px;border-radius:0px"  >
                                        <option value="">--Select--</option>
                                        <?php
                    foreach($model as $row)
                    {?>
     <option value ="<?php echo $row->mod_name; ?>"><?php echo $row->mod_name; ?></option>
       <?php
                     }
                     ?>
                                    </select>
                                    
                                </div>                     
                            </div>
</div>    
<div class="span5" style="margin-left:15%">


                <div class="control-group" style="margin-top:4%" >
                                <label class="control-label">GSTIN Number</label>
                                <div class="controls">
                                    <input type="text" name="c_g_no" class="span11" placeholder="GSTIN " />
                  <span class="text-danger"><?php echo form_error('c_g_no'); ?></span>
                                </div>                
                            </div>



            <div class="control-group" >
                                <label class="control-label">Engine No :</label>
                                <div class="controls">
                                    <input type="text" name="c_e_no" class="span11" placeholder="Engine number" />
                  <span class="text-danger"><?php echo form_error('c_e_no'); ?></span>
                                </div>                
                            </div>

            <div class="control-group" >
                                <label class="control-label"> Contact No :</label>
                                <div class="controls">
                                    <input type="text" name="c_contact" class="span11" placeholder="contact no" />
                  <span class="text-danger"><?php echo form_error('c_contact'); ?></span>
                                </div>                
                            </div>

                             
                <div class="control-group">
                                <label class="control-label"> Date Of Sale : </label>
                                <div class="controls">
                                    <input type="date" name="c_sale" class="span11" placeholder="date of sale"  />
                  <span class="text-danger"><?php echo form_error('c_sale'); ?></span>
                                </div>                
                            </div>
                 
                           
                           <div class="control-group">
                                <label class="control-label">Email Id :</label>
                                <div class="controls">
                                    <input type="email" name="c_email" class="span11" placeholder="Email-Id" />
                  <span class="text-danger"><?php echo form_error('c_email'); ?></span>
                                </div>
                            </div>


                           


                            <div class="control-group" id="wid" style="margin-left:5%;margin-top:3%" >
                                <label class="control-label"></label>
                                <button type="submit" class="btn btn-danger" onclick="return valid();" style="border-radius:50px;">Submit</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="reset" class="btn btn-default" style="border-radius:50px;">Cancel</button>       
                            </div>
               <br><br><br>
             
          </div>    </div>  
                            <div class="form-actions" style="">
            
              
              </div>
              </form>
                      

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






<script type="text/javascript">
    

function valid(){


        var name=document.add.c_name.value;

        var address=document.add.c_address.value;

         var reg=document.add.c_r_no.value;    

        var chassis=document.add.c_c_no.value;

         var model=document.add.c_m.value;

         var gstin=document.add.c_g_no.value;

        var engine=document.add.c_e_no.value;

        var contact=document.add.c_contact.value;

        var date=document.add.c_sale.value;

        var mail=document.add.c_email.value;

     

    
    var letter=/^[a-zA-Z\" "]+$/;

    var adr=/^[a-zA-Z\" "\0-9\-\.]+$/;

    var num=/^[a-zA-Z\" "]+$/;

    var cha=/^[a-zA-Z\0-9]+$/;

    var number=/^[0-9]+$/;

    var register= /^[A-Za-z\0-9]+$/; 

    var gst=/^[0-9\A-Za-z\" "]+$/;

    var mode=/^[0-9\A-Za-z\" "\.\-]+$/;


        if(name ==""){
            alert('Name field is empty');
            document.add.c_name.focus();
            return false;
        }


        else if(!name.match(letter)){
            alert('Name field is invalid');
            document.add.c_name.focus();
            return false;
        }


       
        else if(reg == ""){
            alert('registration number required');
            document.add.c_r_no.focus();
            return false;
        }

        else if(!reg.match(register)){
            alert('registration number is invalid');
            return false;
        }

        else if(chassis == ""){
            alert('chassis number is empty');
            document.add.c_c_no.focus();
            return false;
        }

        else if(!chassis.match(cha)){
            alert('chassis number is invalid');
            document.add.c_c_no.focus();
            return false;
        }

       

        else if(engine == ""){
            alert('engine number is empty');
            document.add.c_e_no.focus();
            return false;
        }
        else if(!engine.match(cha)) {
       alert('engine number is invalid');
            document.add.c_e_no.focus();
            return false;

        }   


       

       

        else{

            return true;
        
        }

}

</script>