<?php
$plantid = $_GET['plantid']; // untrusted
$sort = $_GET['sort'];
$tagfilter = $_GET['tag-filter'];

$sql_select = "SELECT id, plant_name_colloquial, plant_name_scientific, edible, taste, produces_scent, scent, hardiness_zone_range, general_classification, photo_file_extension FROM plants";

// is this safe???
$sql_where = " WHERE (plantid = '$plantid') ";
$sql_order = "";

$sql_query = $sql_select. $sql_where. $sql_order;
$records = exec_sql_query($db, $sql_query)->fetchAll();

if (count($records) == 0) {
  $no_plant_exists = True;
} else{
  $record = $records[0];

  $current_plant_id = $record['id'];

  $tag_query = "SELECT tags.tag AS 'tags.tag' FROM plant_tags INNER JOIN tags ON (plant_tags.tag_id = tags.id) WHERE (plant_id = $current_plant_id)";
  $tags = exec_sql_query($db, $tag_query)->fetchAll();

  // get edible information
  if ($record['edible'] == 1){
    $edible = "yes";
  } else if ($record['edible'] == 0){
    $edible = "no";
  } else {
    $edible = "somewhat";
  };

  if (is_null($record['taste'])){
    $taste_description = False;
  }
  else{
    $taste_description = True;
  };

  // get scent information
  if ($record['produces_scent'] == 1){
    $scent = "yes";
  } if ($record['produces_scent'] == 0) {
    $scent = "no";
  };

  if (is_null($record['scent'])){
    $scent_description = False;
  }
  else{
    $scent_description = True;
  };

  if (is_null($record['hardiness_zone_range'])){
    $hardiness = False;
  }
  else{
    $hardiness = True;
  };
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Plant Details</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
</head>

<body>
  <?php include("includes/header.php"); ?>

  <?php if ($no_plant_exists){ ?>
        <p class="confirmation center"> No such plant exists in the database. Return the catalog <a href="/"> here. <a> </p>
  <?php } else { ?>

    <a href="/?<?php echo http_build_query(array('tag-filter' => $tagfilter, 'sort' => $sort)); ?>"> Back to catalog. </a>
    <div class="details">
      <h2> <?php echo htmlspecialchars($record["plant_name_colloquial"]);?> </h2>
      <h3> <?php echo htmlspecialchars($record["plant_name_scientific"]);?> </h3>

    <?php if (is_null($record['photo_file_extension'])){ ?>
        <figure class="detail-image">
          <img src="/public/images/default.jpg" alt="default plant image">
          <figcaption> Source: <cite><a href="https://www.housebeautiful.com/lifestyle/gardening/g31682048/what-to-plant-in-june/">House Beautiful</a></cite> </figcaption>
        </figure>
    <?php } else { ?>
        <figure class="detail-image">
          <img src="/public/uploads/plants/<?php echo $plantid?>.<?php echo $record["photo_file_extension"]?>" alt="<?php echo htmlspecialchars($record["plant_name_colloquial"]);?> plant image">
        </figure>
    <?php }; ?>
    </div>

    <div class="tags">
        <?php foreach ($tags as $tag) { ?>
          <a class="tag" href="/?<?php echo http_build_query(array('tag-filter' => $tag['tags.tag'], 'sort' => $sort)); ?>"> <?php echo htmlspecialchars($tag['tags.tag']) ?> </a>
        <?php }; ?>
      </div>

    <ul>
      <li> General classification: <?php echo htmlspecialchars($record["general_classification"])?> </li>
      <?php if ($hardiness) { ?>
        <li> Hardiness zone range: <?php echo htmlspecialchars($record["hardiness_zone_range"])?>
      <?php }; ?>
      <li> Edible: <?php echo $edible ?> </li>
      <?php if ($taste_description) { ?>
        <li> Taste decription: <?php echo htmlspecialchars($record["taste"]);?> </li>
      <?php }; ?>
      <li> Scent: <?php echo $scent ?> </li>
      <?php if ($scent_description) { ?>
        <li> Scent decription: <?php echo htmlspecialchars($record["scent"]);?> </li>
      <?php }; ?>
    </ul>
  <?php }; ?>
</body>
</html>
