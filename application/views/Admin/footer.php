<div class="row-fluid">
  <div id="footer" class="span12"> 2018 &copy; <a href="http://cyberiasoftwares.com/">Cyberia Softwares Pvt.Ltd</a> </div>
</div>
<script src="<?php echo  base_url('resource/admin/js/select2.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.tables.js'); ?>"></script> 
 
<script src="<?php echo  base_url('resource/admin/js/excanvas.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.ui.custom.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/bootstrap.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.flot.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.flot.resize.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/jquery.peity.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/fullcalendar.min.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.dashboard.js'); ?>"></script> 
<script src="<?php echo  base_url('resource/admin/js/maruti.chat.js'); ?>"></script> 

<script>
    function readURL(input) {
            var reader = new FileReader();            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }           
            reader.readAsDataURL(input.files[0]);
    }   
    $("#imgInp").change(function(){
        readURL(this);
		  $('#blah').show();
    });
	</script>
<script type="text/javascript">

  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>

</body>
</html>