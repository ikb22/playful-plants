<?php
if (is_user_logged_in() && $is_admin) {
    $id = $_GET['id']; // untrusted
    $delete = $_GET['delete'];

    $records = exec_sql_query(
        $db,
        "SELECT plant_name_colloquial FROM plants WHERE (id = :id);",
        array(
        ':id' => $id
        )
    )->fetchAll();
    if (count($records) == 0) {
        $no_plant_exists = True;
    } else if ($delete){
        $delete_record = exec_sql_query(
            $db,
            "DELETE FROM plants WHERE (id = :id);", array(':id' => $id));
        $delete_tag = exec_sql_query(
            $db,
            "DELETE FROM plant_tags WHERE (plant_id = :id);", array(':id' => $id));
        if (($delete_record)&&($delete_tag)){
            $delete_success = True;
        };
    } else{
        $record = $records[0];
        $name_col = $record['plant_name_colloquial'];
    };
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Delete Plant</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
</head>

<body>
    <?php include("includes/header.php");
    if (is_user_logged_in() && $is_admin) { ?>
        <?php if ($delete_success) { ?>
            <h2 class="center"> Delete successful! </h2>
            <p class="confirmation center"> Return to the catalog <a href="/catalog-admin"> here. </a>
        <?php } else if ($no_plant_exists){ ?>
            <p class="confirmation center"> No such plant exists in the database. Return the catalog <a href="/catalog-admin"> here. <a> </p>
            <?php } else{ ?>

            <h2 class="center"> Delete Plant: <?php echo htmlspecialchars($name_col)?> </h2>

            <main class="delete-form">
                <p> <strong> Are you sure that you want to delete <?php echo htmlspecialchars($name_col)?> from the database? </strong> </p>
                <div class="delete-buttons">
                    <a href="/catalog-admin"> <button> No, go back. </button> </a>
                    <a href="/delete?<?php echo http_build_query(array('id' => $id, 'delete' => 'yes')); ?>">
                        <button> Yes, continue. </button>
                    </a>
                </div>
            </main>
        <?php }; ?>
    <?php } else if (is_user_logged_in()) { ?>
        <p class="confirmation center"> You, <?php echo htmlspecialchars($current_user['name']); ?>, are not authorized to view this content. Please contact an administrator if you think there is an error.</p>
        <p class="confirmation center"> Return to the <a href="/"> plant gallery. </a></p>
    <?php } else { ?>
        <p class="confirmation center"> Please <a href=/login> login </a> to view this content. </p>
    <?php }; ?>
</body>
</html>
