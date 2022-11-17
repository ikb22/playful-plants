<header>
    <div class="align-right">
        <?php if (!is_user_logged_in()) { ?>
            <a class="login" href="/login"> Login </a>
        <?php } else if (is_user_logged_in()) { ?>
            <a class="login" href="<?php echo logout_url(); ?>">Logout</a>
        <?php }; ?>
    </div>
    <h1> Playful Plants </h1>
    <p class="subheader"> —— Catalog —— </p>
</header>
