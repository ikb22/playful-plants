<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Not Found</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
</head>

<body>
  <?php include("includes/header.php"); ?>
  <div class="confirmation center">
    <p> Sorry, the page you are looking for, <em>&quot;<?php echo htmlspecialchars($request_uri); ?>&quot;</em>, does not exist.</p>
    <p> Redirect to the plant catalog <a href="/">here</a>. </p>
  </div>
</body>

</html>
