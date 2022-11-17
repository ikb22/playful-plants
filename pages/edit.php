<?php
if (is_user_logged_in() && $is_admin) {
  $name_col_feedback_class = 'hidden';
  $name_sci_feedback_class = 'hidden';
  $plantid_feedback_class = 'hidden';
  $play_type_feedback_class = 'hidden';
  $play_op_feedback_class= 'hidden';
  $classification_feedback_class= 'hidden';
  $characteristics_feedback_class= 'hidden';
  $picture_feedback_class = "hidden";

  // get or post request??
  if (isset($_POST['edit-submit'])) {
    $post_id = $_POST['edit-id']; // untrusted
    $records = exec_sql_query(
      $db,
      "SELECT * FROM plants WHERE (id = :id);",
      array(
        ':id' => $post_id
      )
    )->fetchAll();
    } else {
    $get = True;
    $get_id = $_GET['id']; // untrusted
    $records = exec_sql_query(
      $db,
      "SELECT * FROM plants WHERE (id = :id);",
      array(
        ':id' => $get_id
      )
    )->fetchAll();
  };

  if (count($records) == 0) {
    $no_plant_exists = True;
  } else{
    $record = $records[0];
    $original_id = $record['id'];
  };

  if ($get) {
    $name_colloquial = $record['plant_name_colloquial'];
    $name_scientific = $record['plant_name_scientific'];
    $plantid = $record['plantid'];
    $classification = $record['general_classification'];
    $constructive = (($record['constructive_play']==1) ? 'checked' : '');
    $sensory = (($record['sensory_play']==1) ? 'checked' : '');
    $physical = (($record['physical_play']==1) ? 'checked' : '');
    $imaginative = (($record['imaginative_play']==1) ? 'checked' : '');
    $restorative = (($record['restorative_play']==1) ? 'checked' : '');
    $expressive = (($record['expressive_play']==1) ? 'checked' : '');
    $rules = (($record['play_with_rules']==1) ? 'checked' : '');
    $bio = (($record['bio_play']==1) ? 'checked' : '');
    $nooks = (($record['nooks_or_secret_spaces']==1) ? 'checked' : '');
    $loose = (($record['loose_parts_or_play_props']==1) ? 'checked' : '');
    $swing = (($record['climbing_and_swinging']==1) ? 'checked' : '');
    $maze = (($record['mazes']==1) ? 'checked' : '');
    $unique = (($record['unique_elements']==1) ? 'checked' : '');
    $edible = (($record['edible']==1) ? 'checked' : '');
    $scent = (($record['produces_scent']==1) ? 'checked' : '');
    $perennial = (($record['perennial']==1) ? 'checked' : '');
    $annual = (($record['annual']==1) ? 'checked' : '');
    $full_sun = (($record['full_sun']==1) ? 'checked' : '');
    $partial_shade = (($record['partial_shade']==1) ? 'checked' : '');
    $full_shade = (($record['full_shade']==1) ? 'checked' : '');
    $hardiness = ((is_null($record['hardiness_zone_range'])) ? '': $record['hardiness_zone_range']);
    $taste_description = ((is_null($record['taste'])) ? '': $record['taste']);
    $scent_description = ((is_null($record['scent'])) ? '': $record['scent']);
  };

  if (isset($_POST['edit-submit'])) {
    $edit_form_valid = True;
    $name_col = trim($_POST['colloquial-name']); // untrusted
    $name_sci = trim($_POST['scientific-name']); // untrusted
    $plantid = trim($_POST['plantid']); // untrusted
    $classification = trim($_POST['classification']);
    $constructive_play = (bool)trim($_POST['constructive']); // untrusted
    $sensory_play = (bool)trim($_POST['sensory']); // untrusted
    $physical_play = (bool)trim($_POST['physical']); // untrusted
    $imaginative_play= (bool)trim($_POST['imaginative']); // untrusted
    $restorative_play = (bool)trim($_POST['restorative']); // untrusted
    $expressive_play = (bool)trim($_POST['expressive']); // untrusted
    $rules_play = (bool)trim($_POST['rules']); // untrusted
    $bio_play = (bool)trim($_POST['bio']); // untrusted
    $nooks_op = (bool)trim($_POST['nooks']); // untrusted
    $loose_op = (bool)trim($_POST['props']); // untrusted
    $climb_op = (bool)trim($_POST['climb']); // untrusted
    $mazes_op = (bool)trim($_POST['mazes']); // untrusted
    $unique_op = (bool)trim($_POST['unique']); // untrusted
    $edible = (bool)trim($_POST['edible']);
    $produces_scent = (bool)trim($_POST['scent']);
    $perennial = (bool)trim($_POST['perennial']);
    $annual = (bool)trim($_POST['annual']);
    $full_sun = (bool)trim($_POST['full-sun']);
    $partial_shade = (bool)trim($_POST['partial-shade']);
    $full_shade = (bool)trim($_POST['full-shade']);
    $hardiness_zone = trim($_POST['hardiness']);
    $taste_description = trim($_POST['taste-description']);
    $scent_description = trim($_POST['scent-description']);
    $picture = $_FILES['plant-picture'];

    if ($picture['error'] == UPLOAD_ERR_OK) {
      $picture_filename = basename($picture['name']);
      $picture_ext = strtolower(pathinfo($picture_filename, PATHINFO_EXTENSION));
      if (!in_array($picture_ext, array('jpeg','jpg','png'))) {
        $edit_form_valid = False;
      };
    } else if (empty($picture['name'])) {
        $picture_ext = NULL;
    } else{
        $edit_form_valid = False;
        $picture_feedback_class ='';
    };

    if (empty($name_col)) {
      $edit_form_valid = False;
      $name_col_feedback_class = '';
    }
    if (empty($name_sci)) {
      $edit_form_valid = False;
      $name_sci_feedback_class = '';
    }
    if (empty($plantid)) {
      $edit_form_valid = False;
      $plantid_feedback_class = '';
    }
    if (empty($classification)){
      $edit_form_valid = False;
      $classification_feedback_class = '';
    }

    // is one of the play type checkboxes checked?
    if ((!$constructive_play) && (!$sensory_play) && (!$physical_play) && (!$imaginative_play) && (!$restorative_play) && (!$expressive_play) && (!$rules_play) && (!$bio_play)) {
      $edit_form_valid = False;
      $play_type_feedback_class= '';
    }

    // is one of the play opportunities checkboxes checked?
    if ((!$nooks_op) && (!$loose_op) && (!$climb_op) && (!$mazes_op) && (!$unique_op)){
      $edit_form_valid = False;
      $play_op_feedback_class = '';
    }

    if ((!$edible) && (!$produces_scent) && (!$perennial) && (!$annual) && (!$full_sun) && (!$partial_shade) && (!$full_shade)){
      $edit_form_valid = False;
      $characteristics_feedback_class = '';
    }

    if ($edit_form_valid){
      // set values to 0 or 1 to add to the database
      $edit_constructive_play = (($constructive_play) ? 1 : 0); // tainted
      $edit_sensory_play = (($sensory_play) ? 1 : 0); //tainted
      $edit_physical_play = (($physical_play) ? 1 : 0); //tainted
      $edit_imaginative_play = (($imaginative_play) ? 1 : 0); //tainted
      $edit_restorative_play = (($restorative_play) ? 1 : 0); //tainted
      $edit_expressive_play = (($expressive_play) ? 1 : 0); //tainted
      $edit_rules_play = (($rules_play) ? 1 : 0); //tainted
      $edit_bio_play = (($bio_play) ? 1 : 0); //tainted
      $edit_nooks_op = (($nooks_op) ? 1 : 0); //tainted
      $edit_loose_op = (($loose_op) ? 1 : 0); //tainted
      $edit_climb_op = (($climb_op) ? 1 : 0); //tainted
      $edit_mazes_op = (($mazes_op) ? 1 : 0); //tainted
      $edit_unique_op = (($unique_op) ? 1 : 0); //tainted
      $edit_edible = (($edible) ? 1 : 0);
      $edit_produces_scent = (($produces_scent) ? 1 : 0);
      $edit_perennial = (($perennial) ? 1 : 0);
      $edit_annual = (($annual) ? 1 : 0);
      $edit_full_sun = (($full_sun) ? 1 : 0);
      $edit_partial_shade = (($partial_shade) ? 1 : 0);
      $edit_full_shade = (($full_shade) ? 1 : 0);

      if (empty($taste_description)){
        $edit_taste_description = NULL;
      } else{
        $edit_taste_description = $taste_description;
      };

      if (empty($scent_description)){
        $edit_scent_description = NULL;
      } else{
        $edit_scent_description = $scent_description;
      };

      if (empty($hardiness_zone)){
        $edit_hardiness_zone = NULL;
      } else{
        $edit_hardiness_zone = $hardiness_zone;
      };
      $edit_result = exec_sql_query(
        $db,
        "UPDATE plants SET
          plant_name_colloquial = :name1, plant_name_scientific = :name2, plantid = :ID, constructive_play = :p1, sensory_play = :p2, physical_play = :p3, imaginative_play = :p4, restorative_play = :p5, expressive_play = :p6, play_with_rules = :p7, bio_play = :p8, nooks_or_secret_spaces = :p9, loose_parts_or_play_props = :p10, climbing_and_swinging = :p11, mazes = :p12, unique_elements = :p13, edible = :p14, taste = :taste, produces_scent = :p15, scent = :scent, perennial = :p16, annual = :p17, full_sun = :p18, partial_shade = :p19, full_shade = :p20, hardiness_zone_range = :hardiness, general_classification = :classification, photo_file_extension = :pic
        WHERE (id = :id);",
        array(
          ':name1' => $name_col, // tainted
          ':name2' => $name_sci, // tainted
          ':ID' => $plantid, // tainted
          ':p1' => $edit_constructive_play,
          ':p2' => $edit_sensory_play,
          ':p3' => $edit_physical_play,
          ':p4' => $edit_imaginative_play,
          ':p5' => $edit_restorative_play,
          ':p6' => $edit_expressive_play,
          ':p7' => $edit_rules_play,
          ':p8' => $edit_bio_play,
          ':p9' => $edit_nooks_op,
          ':p10' => $edit_loose_op,
          ':p11' => $edit_climb_op,
          ':p12' => $edit_mazes_op,
          ':p13' => $edit_unique_op,
          ':p14' => $edit_edible,
          ':taste' => $edit_taste_description,
          ':p15' => $edit_produces_scent,
          ':scent' => $edit_scent_description,
          ':p16' => $edit_perennial,
          ':p17' => $edit_annual,
          ':p18' => $edit_full_sun,
          ':p19' => $edit_partial_shade,
          ':p20' => $edit_full_shade,
          ':hardiness' => $edit_hardiness_zone,
          ':classification' => $classification,
          ':pic' => $picture_ext,
          ':id' => $original_id
        ));
      if ($edit_result){
        $plant_edited = True;
        $new_picture_path = 'public/uploads/plants/'.htmlspecialchars($plantid). '.' . $picture_ext;
        move_uploaded_file($picture["tmp_name"], $new_picture_path);

        // insert into tags
        $tag_inserts = array();
        if ($edit_perennial == 1){
          array_push($tag_inserts, 7);
        };
        if ($edit_annual == 1){
          array_push($tag_inserts, 8);
        };
        if ($edit_full_sun == 1){
          array_push($tag_inserts, 9);
        };
        if ($edit_partial_shade == 1){
          array_push($tag_inserts, 10);
        };
        if ($edit_full_shade == 1){
          array_push($tag_inserts, 11);
        };
        if (strtolower($classification) == 'shrub'){
          array_push($tag_inserts, 1);
        };
        if (strtolower($classification) == 'grass'){
          array_push($tag_inserts, 2);
        };
        if (strtolower($classification) == 'vine'){
          array_push($tag_inserts, 3);
        };
        if (strtolower($classification) == 'tree'){
          array_push($tag_inserts, 4);
        };
        if (strtolower($classification) == 'flower'){
          array_push($tag_inserts, 5);
        };
        if (strtolower($classification) == 'groundcovers'){
          array_push($tag_inserts, 6);
        };
        if (strtolower($classification) == 'vegetable'){
          array_push($tag_inserts, 12);
        };
        if (strtolower($classification) == 'herb'){
          array_push($tag_inserts, 13);
        };

        $delete = exec_sql_query(
          $db,
          "DELETE FROM plant_tags WHERE (plant_id = :id);", array(':id' => $original_id));

        foreach ($tag_inserts as $tag_insert){
          $result = exec_sql_query(
            $db,
            "INSERT INTO plant_tags (plant_id, tag_id) VALUES (:id, :tag)", array(':id' => $original_id, ':tag' => $tag_insert));
        };
      };
      } else{
        $name_colloquial = $name_col; //tainted
        $name_scientific = $name_sci; //tainted
        $plantid = $plantid; //tainted
        $classification = $classification;
        $constructive = (($constructive_play) ? 'checked' : ''); // tainted
        $sensory = (($sensory_play) ? 'checked' : ''); //tainted
        $physical = (($physical_play) ? 'checked' : ''); //tainted
        $imaginative = (($imaginative_play) ? 'checked' : ''); //tainted
        $restorative = (($restorative_play) ? 'checked' : ''); //tainted
        $expressive = (($expressive_play) ? 'checked' : ''); //tainted
        $rules = (($rules_play) ? 'checked' : ''); //tainted
        $bio = (($bio_play) ? 'checked' : ''); //tainted
        $nooks = (($nooks_op) ? 'checked' : ''); //tainted
        $loose = (($loose_op) ? 'checked' : ''); //tainted
        $swing = (($climb_op) ? 'checked' : ''); //tainted
        $maze = (($mazes_op) ? 'checked' : ''); //tainted
        $unique = (($unique_op) ? 'checked' : ''); //tainted
        $edible = (($edible) ? 'checked' : '');
        $scent = (($produces_scent) ? 'checked' : '');
        $perennial = (($perennial) ? 'checked' : '');
        $annual = (($annual) ? 'checked' : '');
        $full_sun = (($full_sun) ? 'checked' : '');
        $partial_shade = (($partial_shade) ? 'checked' : '');
        $full_shade = (($full_shade) ? 'checked' : '');
        $hardiness = $hardiness_zone;
        $taste_description = $taste_description;
        $scent_descriptions = $scent_description;
    }
  };
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Edit Plant</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
</head>

<body>
    <?php include("includes/header.php");
    if (is_user_logged_in() && $is_admin) { ?>
      <?php if ($no_plant_exists){ ?>
          <p class="confirmation center"> No such plant exists in the database. Return the catalog <a href="/catalog-admin"> here. <a> </p>
      <?php } else { ?>
          <h2 class="center"> Edit Plant: <?php echo htmlspecialchars($name_colloquial)?> </h2>

          <?php if ($plant_edited) { ?>
            <p class="confirmation center"> The plant, <?php echo htmlspecialchars($name_col)?>, was successively edited! Return to the catalog <a href="/catalog-admin">here. </a> </p>
          <?php } else { ?>

          <main class="center-form">
            <form class="add" action="/edit-plant?<?php echo http_build_query(array('id' => $original_id)); ?>" method="post" enctype="multipart/form-data" novalidate>
              <p class="feedback edit <?php echo $name_col_feedback_class; ?>"> Please provide the plant's colloquial name. </p>
              <div class="label-input">
                  <label for="colloquial-add"> Plant Name (Colloquial):</label>
                  <input type="text" name="colloquial-name" id="colloquial-add" value="<?php echo htmlspecialchars($name_colloquial); ?>" />
              </div>
              <p class="feedback edit <?php echo $name_sci_feedback_class; ?>"> Please provide the plant's scientific name. </p>
              <div class="label-input">
                  <label for="scientific-add"> Plant Name (Scientific):</label>
                  <input type="text" name="scientific-name" id="scientific-add" value="<?php echo htmlspecialchars($name_scientific); ?>" />
              </div>
              <p class="feedback edit <?php echo $plantid_feedback_class; ?>"> Please provide the plant ID. </p>
              <div class="label-input">
                  <label for="plantid-add"> Plant ID:</label>
                  <input type="text" name="plantid" id="plantid-add" value="<?php echo htmlspecialchars($plantid); ?>" />
              </div>
              <p class="feedback edit <?php echo $classification_feedback_class; ?>"> Please provide the plant's general classification. </p>
              <div class="label-input">
                  <label for="classification-add"> General Classification:</label>
                  <input type="text" name="classification" id="classification-add" value="<?php echo htmlspecialchars($classification); ?>" />
              </div>
              <p class="feedback edit <?php echo $play_type_feedback_class; ?>"> Please provide at least one play type categorization. </p>
              <div class="checkbox">
                  <p class="no-bottom-margin"> Play Type: </p>
                  <div>
                    <input type="checkbox" id="constructive-checkbox" name="constructive" <?php echo $constructive;?>/>
                    <label for="constructive-checkbox">Exploratory constructive play</label>
                  </div>
                  <div>
                    <input type="checkbox" id="sensory-checkbox" name="sensory" <?php echo $sensory;?>/>
                    <label for="sensory-checkbox">Exploratory sensory play </label>
                  </div>
                  <div>
                    <input type="checkbox" id="physical-checkbox" name="physical" <?php echo $physical;?> />
                    <label for="physical-checkbox">Physical play</label>
                  </div>
                  <div>
                    <input type="checkbox" id="imaginative-checkbox" name="imaginative" <?php echo $imaginative;?>/>
                    <label for="imaginative-checkbox">Imaginative play</label>
                  </div>
                  <div>
                    <input type="checkbox" id="restorative-checkbox" name="restorative" <?php echo $restorative;?>/>
                    <label for="restorative-checkbox">Restorative play</label>
                  </div>
                  <div>
                    <input type="checkbox" id="expressive-checkbox" name="expressive" <?php echo $expressive;?>/>
                    <label for="expressive-checkbox">Expressive play</label>
                  </div>
                  <div>
                    <input type="checkbox" id="rules-checkbox" name="rules" <?php echo $rules;?> />
                    <label for="rules-checkbox">Play with rules</label>
                  </div>
                  <div>
                    <input type="checkbox" id="bio-checkbox" name="bio" <?php echo $bio;?> />
                    <label for="bio-checkbox">Bio play</label>
                  </div>
              </div>
              <p class="feedback edit <?php echo $play_op_feedback_class; ?>"> Please provide at least one play opportunity. </p>
              <div class="checkbox">
                  <p class="no-bottom-margin"> Play Opportunities: </p>
                  <div>
                    <input type="checkbox" id="nooks-checkbox" name="nooks" <?php echo $nooks;?>/>
                    <label for="nooks-checkbox">Creates nooks/secret spaces</label>
                  </div>
                  <div>
                    <input type="checkbox" id="props-checkbox" name="props" <?php echo $loose;?>/>
                    <label for="props-checkbox">Provides loose parts/play props</label>
                  </div>
                  <div>
                    <input type="checkbox" id="climb-checkbox" name="climb" <?php echo $swing;?>/>
                    <label for="climb-checkbox">Opportunites for climbing & swinging</label>
                  </div>
                  <div>
                    <input type="checkbox" id="mazes-checkbox" name="mazes" <?php echo $maze;?>/>
                    <label for="mazes-checkbox">Used to create mazes/labyrinths/spirals </label>
                  </div>
                  <div>
                    <input type="checkbox" id="unique-checkbox" name="unique" <?php echo $unique;?>/>
                    <label for="unique-checkbox">Evocative/unique elements</label>
                  </div>
              </div>

              <p class="feedback edit <?php echo $characteristics_feedback_class; ?>"> Please provide at least one plant characteristic. </p>
              <div class="checkbox">
                  <p class="no-bottom-margin"> Plant Characteristics: </p>
                  <div>
                    <input type="checkbox" id="edible-checkbox" name="edible" <?php echo $edible?>/>
                    <label for="edible-checkbox">Edible</label>
                  </div>
                  <div>
                    <input type="checkbox" id="scent-checkbox" name="scent" <?php echo $scent?>/>
                    <label for="scent-checkbox">Produces a scent</label>
                  </div>
                  <div>
                    <input type="checkbox" id="perennial-checkbox" name="perennial" <?php echo $perennial;?>/>
                    <label for="perennial-checkbox">Perennial</label>
                  </div>
                  <div>
                    <input type="checkbox" id="annual-checkbox" name="annual" <?php echo $annual;?>/>
                    <label for="annual-checkbox">Annual</label>
                  </div>
                  <div>
                    <input type="checkbox" id="full-sun-checkbox" name="full-sun" <?php echo $full_sun;?>/>
                    <label for="full-sun-checkbox">Full sun</label>
                  </div>
                  <div>
                    <input type="checkbox" id="partial-shade-checkbox" name="partial-shade" <?php echo $partial_shade;?>/>
                    <label for="partial-shade-checkbox">Partial shade</label>
                  </div>
                  <div>
                    <input type="checkbox" id="full-shade-checkbox" name="full-shade" <?php echo $full_shade;?>/>
                    <label for="full-shade-checkbox">Full shade</label>
                  </div>
              </div>

              <p class="no-bottom-margin"> Optional: </p>
              <div class="label-input">
                  <label for="hardiness-zone"> Hardiness zone range:</label>
                  <input type="text" name="hardiness" id="hardiness-zone" value="<?php echo htmlspecialchars($hardiness); ?>" />
              </div>
              <div class="label-input">
                  <label for="taste-description"> Taste description:</label>
                  <textarea id="taste-description" name="taste-description" rows="2"><?php echo htmlspecialchars($taste_description); ?></textarea>
              </div>
              <div class="label-input">
                  <label for="scent-description"> Scent description:</label>
                  <textarea id="scent-description" name="scent-description" rows="2"><?php echo htmlspecialchars($scent_description); ?></textarea>
              </div>
              <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
              <p class="feedback edit <?php echo $picture_feedback_class; ?>"> File upload unsucessful. </p>
              <div class="label-input">
                  <label for="plant-picture">Picture:</label>
                  <input id="plant-picture" type="file" name="plant-picture" accept=".jpeg,.jpg,.png" />
              </div>

              <input type="hidden" name="edit-id" value="<?php echo htmlspecialchars($original_id); ?>" />

              <div class="align-right">
                    <input type="submit" name="edit-submit" value="Edit Plant" />
              </div>
            </form>
        </main>
        <?php }}; ?>
    <?php } else if (is_user_logged_in()) { ?>
      <p class="confirmation center"> You, <?php echo htmlspecialchars($current_user['name']); ?>, are not authorized to view this content. Please contact an administrator if you think there is an error.</p>
      <p class="confirmation center"> Return to the <a href="/"> plant gallery. </a></p>
    <?php } else { ?>
      <p class="confirmation center"> Please <a href=/login> login </a> to view this content. </p>
    <?php }; ?>
</body>

</html>
