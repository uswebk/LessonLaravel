<html>
<head>
  <title>Hello/Index</title>
  <style>
    body{
      font-size:16px;
      color:#999;
      }
    h1{
      font-size:100pt;
      text-align:right;
      color:#f6f6f6;
      margin:-50px 0px -100px 0px;
      }
  </style>
</head>
<body>
      <h1>Index</h1>
      <p>This is a sample page with php-template.</p>
      <p><?= $msg; ?></p>
      <p><?= "id:" . $id; ?></p>
      <p><?="name:" . $name; ?></p>
      <p><?= date("Y年n月j日"); ?></p>
</body>
</html>