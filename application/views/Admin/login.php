<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  
  
  
      <link rel="stylesheet" href="<?php echo  base_url('resource/login/css/style.css'); ?>">

  
</head>

<body>
  <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>


 <?php $attributes = array("class" => "signin",);
                echo form_open("Admin/admin_login_process", $attributes);?>
  <h4> Login Information </h4>
  <?php echo $this->session->flashdata('msg');?><br>
  <input class="name" type="text" placeholder="Enter Username" name="username"/>
  <input class="pw" type="password" placeholder="Enter Password" name="password"/>
  
  <input class="button" type="submit" value="Log in"/>
<?php echo form_close(); ?>
  
  
</body>
</html>
