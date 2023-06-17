<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Siemens Hackathon Admin</title>
  
  <link href="styles.css" type="text/css" rel="stylesheet">
  
  <script src="https://kit.fontawesome.com/57a8a8c892.js" crossorigin="anonymous"></script>
  
</head>
<body>
  
  <h1>Siemens Hackathon Admin</h1>
  
  <?php if( isset( $_SESSION['id'] ) ): ?>  
  
    <hr>
      
    <p style="padding: 0 1%;">
      <a href="/dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
      <a href="/logout.php" style="float: right;"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </p>

  <?php endif; ?>
  
  <hr>
  
  <?php echo get_message(); ?>
  
  <div style="max-width: 1500px; margin: auto;">
  
