<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
</head>

<body>
    <?php include("includes/header.php"); ?>
    <?php if (is_user_logged_in() && $is_admin) { ?>
      <p class="confirmation center"> Welcome <?php echo htmlspecialchars($current_user['name']); ?>. As an admin of the site, you are able to edit, delete, and add plants <a href="/catalog-admin"> here. </a> </p>
      <p class="confirmation center"> Or, return to the <a href="/"> gallery homepage. </a></p>
    <?php } else if (is_user_logged_in()) { ?>
      <p class="confirmation center"> Welcome <?php echo htmlspecialchars($current_user['name']); ?>! You are now successfully logged in. </p>
      <p class="confirmation center"> Return to the <a href="/"> gallery homepage.</a> </p>
    <?php } else { ?>
      <div class="login-form">
        <?php echo_login_form('/login', $session_messages); ?>
      </div>
    <?php }; ?>
</body>

</html>
