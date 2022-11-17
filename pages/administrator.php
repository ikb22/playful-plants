<?php
if (is_user_logged_in() && $is_admin) {
  // fetch all records from database
  $sql_select = "SELECT * FROM plants";
  $sql_where= "";
  $sql_order = "";


  // feedback classes (default is hidden)
  $name_col_feedback_class = 'hidden';
  $name_sci_feedback_class = 'hidden';
  $plantid_feedback_class = 'hidden';
  $play_type_feedback_class = 'hidden';
  $play_op_feedback_class= 'hidden';
  $classification_feedback_class= 'hidden';
  $characteristics_feedback_class= 'hidden';
  $picture_feedback_class = "hidden";

  //  values for add form
  $name_col = '';
  $name_sci = '';
  $plantid = '';
  $classification= '';
  $constructive_play = '';
  $sensory_play = '';
  $physical_play = '';
  $imaginative_play = '';
  $restorative_play = '';
  $expressive_play = '';
  $rules_play = '';
  $bio_play = '';
  $nooks_op = '';
  $loose_op = '';
  $climb_op = '';
  $mazes_op = '';
  $unique_op = '';
  $edible = '';
  $produces_scent = '';
  $perennial = '';
  $annual = '';
  $full_sun = '';
  $partial_shade = '';
  $full_shade = '';
  $hardiness_zone = '';
  $taste_description = '';
  $scent_description = '';

  //  sticky values for add form
  $sticky_name_col = '';
  $sticky_name_sci = '';
  $sticky_plantid = '';
  $sticky_classification = '';
  $sticky_constructive_play = '';
  $sticky_sensory_play = '';
  $sticky_physical_play = '';
  $sticky_imaginative_play = '';
  $sticky_restorative_play = '';
  $sticky_expressive_play = '';
  $sticky_rules_play = '';
  $sticky_bio_play = '';
  $sticky_nooks_op = '';
  $sticky_loose_op = '';
  $sticky_climb_op = '';
  $sticky_mazes_op = '';
  $sticky_unique_op = '';
  $sticky_edible = '';
  $sticky_produces_scent = '';
  $sticky_perennial = '';
  $sticky_annual = '';
  $sticky_full_sun = '';
  $sticky_partial_shade = '';
  $sticky_full_shade = '';
  $sticky_hardiness_zone = '';
  $sticky_taste_description = '';
  $sticky_scent_description = '';

  // values for filter form
  $play_op = '';
  $play_type = '';

  // sticky values for filter form
  $filter_constructive_play = '';
  $filter_sensory_play = '';
  $filter_physical_play = '';
  $filter_imaginative_play = '';
  $filter_restorative_play = '';
  $filter_expressive_play = '';
  $filter_rules_play = '';
  $filter_bio_play = '';
  $filter_nooks_op = '';
  $filter_loose_op = '';
  $filter_climb_op = '';
  $filter_mazes_op = '';
  $filter_unique_op = '';

  if (isset($_POST['add-submit'])) {
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

    $add_form_valid = True;

    if ($picture['error'] == UPLOAD_ERR_OK) {
      $picture_filename = basename($picture['name']);
      $picture_ext = strtolower(pathinfo($picture_filename, PATHINFO_EXTENSION));
      if (!in_array($picture_ext, array('jpeg','jpg','png'))) {
        $add_form_valid = False;
      };
    } else if (empty($picture['name'])) {
        $picture_ext = NULL;
    } else{
        $add_form_valid = False;
        $picture_feedback_class ='';
    };

    if (empty($name_col)) {
      $add_form_valid = False;
      $name_col_feedback_class = '';
    }
    if (empty($name_sci)) {
      $add_form_valid = False;
      $name_sci_feedback_class = '';
    }
    if (empty($plantid)) {
      $add_form_valid = False;
      $plantid_feedback_class = '';
    }
    if (empty($classification)){
      $add_form_valid = False;
      $classification_feedback_class = '';
    }

    // is one of the play type checkboxes checked?
    if ((!$constructive_play) && (!$sensory_play) && (!$physical_play) && (!$imaginative_play) && (!$restorative_play) && (!$expressive_play) && (!$rules_play) && (!$bio_play)) {
      $add_form_valid = False;
      $play_type_feedback_class= '';
    }

    // is one of the play opportunities checkboxes checked?
    if ((!$nooks_op) && (!$loose_op) && (!$climb_op) && (!$mazes_op) && (!$unique_op)){
      $add_form_valid = False;
      $play_op_feedback_class = '';
    }

    if ((!$edible) && (!$produces_scent) && (!$perennial) && (!$annual) && (!$full_sun) && (!$partial_shade) && (!$full_shade)){
      $add_form_valid = False;
      $characteristics_feedback_class = '';
    }

    if ($add_form_valid){
      // set values to 0 or 1 to add to the database
      $add_constructive_play = (($constructive_play) ? 1 : 0); // tainted
      $add_sensory_play = (($sensory_play) ? 1 : 0); //tainted
      $add_physical_play = (($physical_play) ? 1 : 0); //tainted
      $add_imaginative_play = (($imaginative_play) ? 1 : 0); //tainted
      $add_restorative_play = (($restorative_play) ? 1 : 0); //tainted
      $add_expressive_play = (($expressive_play) ? 1 : 0); //tainted
      $add_rules_play = (($rules_play) ? 1 : 0); //tainted
      $add_bio_play = (($bio_play) ? 1 : 0); //tainted
      $add_nooks_op = (($nooks_op) ? 1 : 0); //tainted
      $add_loose_op = (($loose_op) ? 1 : 0); //tainted
      $add_climb_op = (($climb_op) ? 1 : 0); //tainted
      $add_mazes_op = (($mazes_op) ? 1 : 0); //tainted
      $add_unique_op = (($unique_op) ? 1 : 0); //tainted
      $add_edible = (($edible) ? 1 : 0);
      $add_produces_scent = (($produces_scent) ? 1 : 0);
      $add_perennial = (($perennial) ? 1 : 0);
      $add_annual = (($annual) ? 1 : 0);
      $add_full_sun = (($full_sun) ? 1 : 0);
      $add_partial_shade = (($partial_shade) ? 1 : 0);
      $add_full_shade = (($full_shade) ? 1 : 0);

      if (empty($taste_description)){
        $add_taste_description = NULL;
      } else{
        $add_taste_description = $taste_description;
      };

      if (empty($scent_description)){
        $add_scent_description = NULL;
      } else{
        $add_scent_description = $scent_description;
      };

      if (empty($hardiness_zone)){
        $add_hardiness_zone = NULL;
      } else{
        $add_hardiness_zone = $hardiness_zone;
      };

      $add_result = exec_sql_query(
        $db,
        "INSERT INTO plants (plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension) VALUES (:name1, :name2, :ID, :p1, :p2, :p3, :p4, :p5, :p6, :p7, :p8, :p9, :p10, :p11, :p12, :p13, :p14, :taste, :p15, :scent, :p16, :p17, :p18, :p19, :p20, :hardiness, :classification, :pic);",
        array(
          ':name1' => $name_col, // tainted
          ':name2' => $name_sci, // tainted
          ':ID' => $plantid, // tainted
          ':p1' => $add_constructive_play,
          ':p2' => $add_sensory_play,
          ':p3' => $add_physical_play,
          ':p4' => $add_imaginative_play,
          ':p5' => $add_restorative_play,
          ':p6' => $add_expressive_play,
          ':p7' => $add_rules_play,
          ':p8' => $add_bio_play,
          ':p9' => $add_nooks_op,
          ':p10' => $add_loose_op,
          ':p11' => $add_climb_op,
          ':p12' => $add_mazes_op,
          ':p13' => $add_unique_op,
          ':p14' => $add_edible,
          ':taste' => $add_taste_description,
          ':p15' => $add_produces_scent,
          ':scent' => $add_scent_description,
          ':p16' => $add_perennial,
          ':p17' => $add_annual,
          ':p18' => $add_full_sun,
          ':p19' => $add_partial_shade,
          ':p20' => $add_full_shade,
          ':hardiness' => $add_hardiness_zone,
          ':classification' => $classification,
          ':pic' => $picture_ext
        ));

      if ($add_result) {
        $plant_inserted = True;
        $last_id = $db->lastInsertId('id');
        $new_picture_path = 'public/uploads/plants/'.htmlspecialchars($plantid). '.' . $picture_ext;
        move_uploaded_file($picture["tmp_name"], $new_picture_path);

        // insert into tagss
        $tag_inserts = array();
        if ($add_perennial == 1){
          array_push($tag_inserts, 7);
        };
        if ($add_annual == 1){
          array_push($tag_inserts, 8);
        };
        if ($add_full_sun == 1){
          array_push($tag_inserts, 9);
        };
        if ($add_partial_shade == 1){
          array_push($tag_inserts, 10);
        };
        if ($add_full_shade == 1){
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

        foreach ($tag_inserts as $tag_insert){
          $result = exec_sql_query(
            $db,
            "INSERT INTO plant_tags (plant_id, tag_id) VALUES (:id, :tag)", array(':id' => $last_id, ':tag' => $tag_insert));
        };
      };
      } else{
        $sticky_name_col = $name_col; //tainted
        $sticky_name_sci = $name_sci; //tainted
        $sticky_plantid = $plantid; //tainted
        $sticky_classification = $classification;
        $sticky_constructive_play = (($constructive_play) ? 'checked' : ''); // tainted
        $sticky_sensory_play = (($sensory_play) ? 'checked' : ''); //tainted
        $sticky_physical_play = (($physical_play) ? 'checked' : ''); //tainted
        $sticky_imaginative_play = (($imaginative_play) ? 'checked' : ''); //tainted
        $sticky_restorative_play = (($restorative_play) ? 'checked' : ''); //tainted
        $sticky_expressive_play = (($expressive_play) ? 'checked' : ''); //tainted
        $sticky_rules_play = (($rules_play) ? 'checked' : ''); //tainted
        $sticky_bio_play = (($bio_play) ? 'checked' : ''); //tainted
        $sticky_nooks_op = (($nooks_op) ? 'checked' : ''); //tainted
        $sticky_loose_op = (($loose_op) ? 'checked' : ''); //tainted
        $sticky_climb_op = (($climb_op) ? 'checked' : ''); //tainted
        $sticky_mazes_op = (($mazes_op) ? 'checked' : ''); //tainted
        $sticky_unique_op = (($unique_op) ? 'checked' : ''); //tainted
        $sticky_edible = (($edible) ? 'checked' : '');
        $sticky_produces_scent = (($produces_scent) ? 'checked' : '');
        $sticky_perennial = (($perennial) ? 'checked' : '');
        $sticky_annual = (($annual) ? 'checked' : '');
        $sticky_full_sun = (($full_sun) ? 'checked' : '');
        $sticky_partial_shade = (($partial_shade) ? 'checked' : '');
        $sticky_full_shade = (($full_shade) ? 'checked' : '');
        $sticky_hardiness_zone = $hardiness_zone;
        $sticky_taste_description = $taste_description;
        $sticky_scent_description = $scent_description;
    }
  };

  if (isset($_GET['filter-submit'])) {
    $play_type = trim($_GET['play-type-filter']);
    $play_op = trim($_GET['play-op-filter']);
    $sort = trim($_GET['sort']);

    $filter_constructive_play = ($play_type == 'constructive' ? 'selected' : '');
    $filter_sensory_play = ($play_type == 'sensory' ? 'selected' : '');
    $filter_physical_play = ($play_type == 'physical' ? 'selected' : '');
    $filter_imaginative_play = ($play_type == 'imaginative' ? 'selected' : '');
    $filter_restorative_play = ($play_type == 'restorative' ? 'selected' : '');
    $filter_expressive_play = ($play_type == 'expressive' ? 'selected' : '');
    $filter_rules_play = ($play_type == 'play-rules' ? 'selected' : '');
    $filter_bio_play = ($play_type == 'bio' ? 'selected' : '');
    $filter_nooks_op = ($play_op == 'nooks' ? 'selected' : '');
    $filter_loose_op = ($play_op == 'loose' ? 'selected' : '');
    $filter_climb_op = ($play_op == 'climb' ? 'selected' : '');
    $filter_mazes_op = ($play_op == 'mazes' ? 'selected' : '');
    $filter_unique_op = ($play_op == 'unique' ? 'selected' : '');
    $sort_yes = ($sort == 'yes' ? 'checked' : '');
    $sort_no = ($sort == 'no' ? 'checked' : '');

    $filter_form_valid = True;

    $where_filter_expressions = array();

    if ($play_type == 'constructive'){
      array_push($where_filter_expressions, "(constructive_play = 1)");
    }
    if ($play_type == 'sensory'){
      array_push($where_filter_expressions, "(sensory_play = 1)");
    }
    if ($play_type == 'physical'){
      array_push($where_filter_expressions, "(physical_play = 1)");
    }
    if ($play_type == 'imaginative'){
      array_push($where_filter_expressions, "(imaginative_play = 1)");
    }
    if ($play_type == 'restorative'){
      array_push($where_filter_expressions, "(restorative_play = 1)");
    }
    if ($play_type == 'expressive'){
      array_push($where_filter_expressions, "(expressive_play = 1)");
    }
    if ($play_type == 'play-rules'){
      array_push($where_filter_expressions, "(play_with_rules = 1)");
    }
    if ($play_type == 'bio'){
      array_push($where_filter_expressions, "(bio_play = 1)");
    }
    if ($play_op == 'nooks'){
      array_push($where_filter_expressions, "(nooks_or_secret_spaces = 1)");
    }
    if ($play_op == 'loose'){
      array_push($where_filter_expressions, "(loose_parts_or_play_props = 1)");
    }
    if ($play_op == 'climb'){
      array_push($where_filter_expressions, "(climbing_and_swinging = 1)");
    }
    if ($play_op == 'mazes'){
      array_push($where_filter_expressions, "(mazes = 1)");
    }
    if ($play_op == 'unique'){
      array_push($where_filter_expressions, "(unique_elements = 1)");
    }

    if (count($where_filter_expressions) > 0) {
      $sql_where = ' WHERE ' . implode(' AND ', $where_filter_expressions);
    }

    if (($play_op == 'no_filter') && ($play_type == 'no_filter')){
      $filter_form_valid = False;
    }

    if ($sort == 'yes'){
      $sql_order = " ORDER BY plant_name_colloquial ASC";
      $sort_valid = True;
    }
  };

  $sql_query = $sql_select. $sql_where. $sql_order;
  $records = exec_sql_query($db, $sql_query)->fetchAll();
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title>Plant Catalog</title>
  <link rel="stylesheet" type="text/css" href="/public/styles/site.css" media="all" />
</head>

<body>
  <?php include("includes/header.php");
  if (is_user_logged_in() && $is_admin) { ?>
    <div class="flex">
    <aside>
      <h2> Filter Plants </h2>

      <form class="filter" action="/catalog-admin" method="get" novalidate>
        <div class="label-input">
            <label for="op-filter">Play Opportunities: </label>
            <select id="op-filter" name="play-op-filter">
              <option value="no_filter" > No Filter </option>
              <option value="nooks" <?php echo $filter_nooks_op; ?>> Nooks/secret spaces </option>
              <option value="loose" <?php echo $filter_loose_op; ?>> Loose parts/play props </option>
              <option value="climb" <?php echo $filter_climb_op; ?>> Climbing & swinging </option>
              <option value="mazes" <?php echo $filter_mazes_op; ?>> Mazes/labyrinths/spirals </option>
              <option value="unique" <?php echo $filter_unique_op; ?>> Evocative/unique elements </option>
            </select>
        </div>

        <div class="label-input">
            <label for="play-filter">Play Type:</label>
            <select id="play-filter" name="play-type-filter">
              <option value="no_filter" >No Filter</option>
              <option value="constructive" <?php echo $filter_constructive_play; ?>>Exploratory constructive play</option>
              <option value="sensory" <?php echo $filter_sensory_play; ?>>Exploratory sensory play</option>
              <option value="physical" <?php echo $filter_physical_play; ?>>Physical play</option>
              <option value="imaginative" <?php echo $filter_imaginative_play; ?>>Imaginative play</option>
              <option value="restorative" <?php echo $filter_restorative_play; ?>>Restorative play</option>
              <option value="expressive" <?php echo $filter_expressive_play; ?>>Expressive play</option>
              <option value="play-rules" <?php echo $filter_rules_play; ?>>Play with rules</option>
              <option value="bio" <?php echo $filter_bio_play; ?>>Bio play</option>
            </select>
        </div>

        <div>
            <p class="no-bottom-margin"> Sort Alphabetically: </p>
            <input id="yes" type="radio" name="sort" value="yes" <?php echo $sort_yes; ?> />
            <label for="yes">Yes</label>
            <input id="no" type="radio" name="sort" value="no" <?php echo $sort_no; ?> />
            <label for="no">No</label>
        </div>

        <div class="align-right">
              <input type="submit" name="filter-submit" value="Filter Plants" />
        </div>
      </form>

      <h2> Add Plant </h2>
      <form action="/catalog-admin" method="post" enctype="multipart/form-data" novalidate>

        <p class="feedback <?php echo $name_col_feedback_class; ?>"> Please provide the plant's colloquial name. </p>
        <div class="label-input">
            <label for="colloquial-add"> Plant Name (Colloquial):</label>
            <input type="text" name="colloquial-name" id="colloquial-add" value="<?php echo htmlspecialchars($sticky_name_col); ?>" />
        </div>
        <p class="feedback <?php echo $name_sci_feedback_class; ?>"> Please provide the plant's scientific name. </p>
        <div class="label-input">
            <label for="scientific-add"> Plant Name (Scientific):</label>
            <input type="text" name="scientific-name" id="scientific-add" value="<?php echo htmlspecialchars($sticky_name_sci); ?>" />
        </div>
        <p class="feedback <?php echo $plantid_feedback_class; ?>"> Please provide the plant ID. </p>
        <div class="label-input">
            <label for="plantid-add"> Plant ID:</label>
            <input type="text" name="plantid" id="plantid-add" value="<?php echo htmlspecialchars($sticky_plantid); ?>" />
        </div>
        <p class="feedback <?php echo $classification_feedback_class; ?>"> Please provide the plant's general classification. </p>
        <div class="label-input">
            <label for="classification-add"> General Classification:</label>
            <input type="text" name="classification" id="classification-add" value="<?php echo htmlspecialchars($sticky_classification); ?>" />
        </div>
        <p class="feedback <?php echo $play_type_feedback_class; ?>"> Please provide at least one play type categorization. </p>
        <div class="checkbox">
            <p class="no-bottom-margin"> Play Type: </p>
            <div>
              <input type="checkbox" id="constructive-checkbox" name="constructive" <?php echo $sticky_constructive_play;?>/>
              <label for="constructive-checkbox">Exploratory constructive play</label>
            </div>
            <div>
              <input type="checkbox" id="sensory-checkbox" name="sensory" <?php echo $sticky_sensory_play;?>/>
              <label for="sensory-checkbox">Exploratory sensory play </label>
            </div>
            <div>
              <input type="checkbox" id="physical-checkbox" name="physical" <?php echo $sticky_physical_play;?> />
              <label for="physical-checkbox">Physical play</label>
            </div>
            <div>
              <input type="checkbox" id="imaginative-checkbox" name="imaginative" <?php echo $sticky_imaginative_play;?>/>
              <label for="imaginative-checkbox">Imaginative play</label>
            </div>
            <div>
              <input type="checkbox" id="restorative-checkbox" name="restorative" <?php echo $sticky_restorative_play;?>/>
              <label for="restorative-checkbox">Restorative play</label>
            </div>
            <div>
              <input type="checkbox" id="expressive-checkbox" name="expressive" <?php echo $sticky_expressive_play;?>/>
              <label for="expressive-checkbox">Expressive play</label>
            </div>
            <div>
              <input type="checkbox" id="rules-checkbox" name="rules" <?php echo $sticky_rules_play;?> />
              <label for="rules-checkbox">Play with rules</label>
            </div>
            <div>
              <input type="checkbox" id="bio-checkbox" name="bio" <?php echo $sticky_bio_play;?> />
              <label for="bio-checkbox">Bio play</label>
            </div>
        </div>
        <p class="feedback <?php echo $play_op_feedback_class; ?>"> Please provide at least one play opportunity. </p>
        <div class="checkbox">
            <p class="no-bottom-margin"> Play Opportunities: </p>
            <div>
              <input type="checkbox" id="nooks-checkbox" name="nooks" <?php echo $sticky_nooks_op;?>/>
              <label for="nooks-checkbox">Creates nooks/secret spaces</label>
            </div>
            <div>
              <input type="checkbox" id="props-checkbox" name="props" <?php echo $sticky_loose_op;?>/>
              <label for="props-checkbox">Provides loose parts/play props</label>
            </div>
            <div>
              <input type="checkbox" id="climb-checkbox" name="climb" <?php echo $sticky_climb_op;?>/>
              <label for="climb-checkbox">Opportunites for climbing & swinging</label>
            </div>
            <div>
              <input type="checkbox" id="mazes-checkbox" name="mazes" <?php echo $sticky_mazes_op;?>/>
              <label for="mazes-checkbox">Used to create mazes/labyrinths/spirals </label>
            </div>
            <div>
              <input type="checkbox" id="unique-checkbox" name="unique" <?php echo $sticky_unique_op;?>/>
              <label for="unique-checkbox">Evocative/unique elements</label>
            </div>
        </div>

        <p class="feedback <?php echo $characteristics_feedback_class; ?>"> Please provide at least one plant characteristic. </p>
        <div class="checkbox">
            <p class="no-bottom-margin"> Plant Characteristics: </p>
            <div>
              <input type="checkbox" id="edible-checkbox" name="edible" <?php echo $sticky_edible?>/>
              <label for="edible-checkbox">Edible</label>
            </div>
            <div>
              <input type="checkbox" id="scent-checkbox" name="scent" <?php echo $sticky_produces_scent?>/>
              <label for="scent-checkbox">Produces a scent</label>
            </div>
            <div>
              <input type="checkbox" id="perennial-checkbox" name="perennial" <?php echo $sticky_perennial;?>/>
              <label for="perennial-checkbox">Perennial</label>
            </div>
            <div>
              <input type="checkbox" id="annual-checkbox" name="annual" <?php echo $sticky_annual;?>/>
              <label for="annual-checkbox">Annual</label>
            </div>
            <div>
              <input type="checkbox" id="full-sun-checkbox" name="full-sun" <?php echo $sticky_full_sun;?>/>
              <label for="full-sun-checkbox">Full sun</label>
            </div>
            <div>
              <input type="checkbox" id="partial-shade-checkbox" name="partial-shade" <?php echo $sticky_partial_shade;?>/>
              <label for="partial-shade-checkbox">Partial shade</label>
            </div>
            <div>
              <input type="checkbox" id="full-shade-checkbox" name="full-shade" <?php echo $sticky_full_shade;?>/>
              <label for="full-shade-checkbox">Full shade</label>
            </div>
        </div>

        <p class="no-bottom-margin"> Optional: </p>
        <div class="label-input">
            <label for="hardiness-zone"> Hardiness zone range:</label>
            <input type="text" name="hardiness" id="hardiness-zone" value="<?php echo htmlspecialchars($sticky_hardiness_zone); ?>" />
        </div>
        <div class="label-input">
            <label for="taste-description"> Taste description:</label>
            <textarea id="taste-description" name="taste-description" rows="2"><?php echo htmlspecialchars($sticky_taste_description); ?></textarea>
        </div>
        <div class="label-input">
            <label for="scent-description"> Scent description:</label>
            <textarea id="scent-description" name="scent-description" rows="2"><?php echo htmlspecialchars($sticky_scent_description); ?></textarea>
        </div>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />

        <p class="feedback <?php echo $picture_feedback_class; ?>"> File upload unsucessful. </p>
        <div class="label-input">
            <label for="plant-picture">Picture:</label>
            <input id="plant-picture" type="file" name="plant-picture" accept=".jpeg,.jpg,.png" />
        </div>

        <div class="align-right">
              <input type="submit" name="add-submit" value="Add Plant" />
        </div>
      </form>
    </aside>

    <main>
      <?php if ($plant_inserted) { ?>
        <p class="confirmation"> The plant, <?php echo htmlspecialchars($name_col)?>, was inserted sucessfully into the database! </p>
      <?php } ?>

      <?php if ($filter_form_valid && ($sort_valid == False)) { ?>
        <p class="filter-feedback"> Now filtering your results: </p>
      <?php } ?>

      <?php if ($sort_valid && ($filter_form_valid==False)) { ?>
        <p class="sort-feedback"> Now sorting your results aphabetically: </p>
      <?php } ?>

      <?php if ($sort_valid && $filter_form_valid) { ?>
        <p class="sort-feedback"> Now fitering by selected fields & sorting your results aphabetically: </p>
      <?php } ?>

      <?php foreach ($records as $record) {
        $supports_list = array();
        $playops_list = array();
        if ($record['constructive_play'] == 1){
          array_push($supports_list, "exploratory constructive play");
        }
        if ($record['sensory_play'] == 1){
          array_push($supports_list, "exploratory sensory play");
        }
        if ($record['physical_play'] == 1){
          array_push($supports_list, "physical play");
        }
        if ($record['imaginative_play'] == 1){
          array_push($supports_list, "imaginative play");
        }
        if ($record['restorative_play'] == 1){
          array_push($supports_list, "restorative play");
        }
        if ($record['expressive_play'] == 1){
          array_push($supports_list, "expressive play");
        }
        if ($record['play_with_rules'] == 1){
          array_push($supports_list, "play with rules");
        }
        if ($record['bio_play'] == 1){
          array_push($supports_list, "bio play");
        }
        if ($record['nooks_or_secret_spaces'] == 1){
          array_push($playops_list, "creates nooks/secret spaces");
        }
        if ($record['loose_parts_or_play_props'] == 1){
          array_push($playops_list, "provides loose parts/play props");
        }
        if ($record['climbing_and_swinging'] == 1){
          array_push($playops_list, "opportunites for climbing & swinging");
        }
        if ($record['mazes'] == 1){
          array_push($playops_list, "used to create mazes/labyrinths/spirals");
        }
        if ($record['unique_elements'] == 1){
          array_push($playops_list, "evocative/unique elements");
        }
        $supports_string = implode(', ', $supports_list);
        $playops_string = implode(', ', $playops_list);

        ?>
        <div class = "plant">
        <p class="edit-delete"> <a href="/edit-plant?<?php echo http_build_query(array('id' => $record["id"])); ?>"> Edit </a> <a href="/delete?<?php echo http_build_query(array('id' => $record["id"])); ?>"> Delete </a> </p>
        <h2> <?php echo htmlspecialchars($record["plant_name_colloquial"]); ?>, <em> <?php echo htmlspecialchars($record["plant_name_scientific"]); ?> </em> </h2>
          <ul>
            <li> <em class="underline"> Plant ID:</em> <?php echo htmlspecialchars($record["plantid"]); ?> </li>
            <li> <em class="underline"> Supports:</em> <?php echo htmlspecialchars($supports_string);?> </li>
            <li> <em class="underline"> Play Opportunites:</em> <?php echo htmlspecialchars($playops_string);?> </li>
          </ul>
        </div>
      <?php } ?>
    </main>
  </div>
  </body>
  <?php } else if (is_user_logged_in()){ ?>
    <p class="confirmation center"> You, <?php echo htmlspecialchars($current_user['name']); ?>, are not authorized to view this content. Please contact an administrator if you think there is an error.</p>
    <p class="confirmation center"> Return to the <a href="/"> plant gallery. </a></p>
  <?php } else { ?>
    <p class="confirmation center"> Please <a href=/login> login </a> to view this content. </p>
  <?php }; ?>
</html>
