<?php
$filter_shrub = '';
$filter_grass = '';
$filter_vine = '';
$filter_tree = '';
$filter_flower = '';
$filter_groundcovers = '';
$filter_perennial = '';
$filter_annual = '';
$filter_full_sun = '';
$filter_partial_shade = '';
$filter_full_shade = '';
$filter_vegetable = '';
$filter_herb = '';
$sort_yes = '';
$sort_no = '';
$tagfilter = 'no-filter';
$sort = '';
$showtag = False;
$details_sort = $_GET['sort'];
$details_tagfilter = $_GET['tag-filter'];

if ($details_tagfilter != 'no-filter' && !is_null($details_tagfilter)){
  $sql_select = "SELECT plant_name_colloquial, plantid, photo_file_extension, tags.tag AS 'tags'  FROM plants INNER JOIN  plant_tags ON (plants.id = plant_tags.plant_id) INNER JOIN tags ON ( plant_tags.tag_id = tags.id)";
  $sql_where = " WHERE (tags='$details_tagfilter')";

  $filter_shrub = ($details_tagfilter == 'shrub' ? 'selected' : '');
  $filter_grass = ($details_tagfilter == 'grass' ? 'selected' : '');
  $filter_vine = ($details_tagfilter == 'vine' ? 'selected' : '');
  $filter_tree = ($details_tagfilter == 'tree' ? 'selected' : '');
  $filter_flower = ($details_tagfilter == 'flower' ? 'selected' : '');
  $filter_groundcovers = ($details_tagfilter == 'groundcovers' ? 'selected' : '');
  $filter_perennial = ($details_tagfilter == 'perennial' ? 'selected' : '');
  $filter_annual = ($details_tagfilter == 'annual' ? 'selected' : '');
  $filter_full_sun = ($details_tagfilter == 'full sun' ? 'selected' : '');
  $filter_partial_shade = ($details_tagfilter == 'partial shade' ? 'selected' : '');
  $filter_full_shade = ($details_tagfilter == 'full shade' ? 'selected' : '');
  $filter_vegetable = ($details_tagfilter == 'vegetable' ? 'selected' : '');
  $filter_herb = ($details_tagfilter == 'herb' ? 'selected' : '');

  $tagfilter = $details_tagfilter;
  $sort = $details_sort;

  $sort_yes = ($sort == 'yes' ? 'checked' : '');
  $sort_no = ($sort == 'no' ? 'checked' : '');
}
else{
  $sql_select = "SELECT plant_name_colloquial, plantid, photo_file_extension FROM plants";
  $sql_where = "";
}

if (is_null($details_sort)) {
  $sql_order = "";
}
else{
  if ($details_sort == 'yes'){
    $sql_order = " ORDER BY plant_name_colloquial ASC";
  };
};


//filtering and sorting
if (isset($_GET['tag-filter-submit'])) {
  $tagfilter = trim($_GET['tag-filter']);
  $sort = trim($_GET['sort']);

  $filter_shrub = ($tagfilter == 'shrub' ? 'selected' : '');
  $filter_grass = ($tagfilter == 'grass' ? 'selected' : '');
  $filter_vine = ($tagfilter == 'vine' ? 'selected' : '');
  $filter_tree = ($tagfilter == 'tree' ? 'selected' : '');
  $filter_flower = ($tagfilter == 'flower' ? 'selected' : '');
  $filter_groundcovers = ($tagfilter == 'groundcovers' ? 'selected' : '');
  $filter_perennial = ($tagfilter == 'perennial' ? 'selected' : '');
  $filter_annual = ($tagfilter == 'annual' ? 'selected' : '');
  $filter_full_sun = ($tagfilter == 'full sun' ? 'selected' : '');
  $filter_partial_shade = ($tagfilter == 'partial shade' ? 'selected' : '');
  $filter_full_shade = ($tagfilter == 'full shade' ? 'selected' : '');
  $filter_vegetable = ($tagfilter == 'vegetable' ? 'selected' : '');
  $filter_herb = ($tagfilter == 'herb' ? 'selected' : '');

  if ($tagfilter != "no-filter") {
    $sql_select = "SELECT plant_name_colloquial, plantid, photo_file_extension, tags.tag AS 'tags'  FROM plants INNER JOIN  plant_tags ON (plants.id = plant_tags.plant_id) INNER JOIN tags ON ( plant_tags.tag_id = tags.id)";
    $sql_where = " WHERE (tags='$tagfilter')";
  };

  $sort_yes = ($sort == 'yes' ? 'checked' : '');
  $sort_no = ($sort == 'no' ? 'checked' : '');

  if ($sort == 'yes'){
    $sql_order = " ORDER BY plant_name_colloquial ASC";

  };

};

if (($tagfilter != "no-filter") && (!empty($tagfilter))){
  $showtag = True;
}

$sql_query = $sql_select. $sql_where. $sql_order;
$records = exec_sql_query($db, $sql_query)->fetchAll();
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
  <?php include("includes/header.php"); ?>

  <form action="/" method="get" novalidate>
    <div class="home-filter">
      <div class="label-input">
          <label for="tag-filter">Filter by: </label>
          <select id="tag-filter" name="tag-filter">
            <option value="no-filter" > No Filter </option>
            <option value="shrub" <?php echo $filter_shrub?>> Shrub </option>
            <option value="grass" <?php echo $filter_grass?>> Grass </option>
            <option value="vine" <?php echo $filter_vine?>> Vine </option>
            <option value="tree" <?php echo $filter_tree?>> Tree </option>
            <option value="flower" <?php echo $filter_flower?>> Flower </option>
            <option value="groundcovers" <?php echo $filter_groundcovers?>> Groundcovers </option>
            <option value="perennial" <?php echo $filter_perennial?>> Perennial </option>
            <option value="annual" <?php echo $filter_annual?>> Annual </option>
            <option value="full sun" <?php echo $filter_full_sun?>> Full sun </option>
            <option value="partial shade" <?php echo $filter_partial_shade?>> Partial shade </option>
            <option value="full shade" <?php echo $filter_full_shade?>> Full shade </option>
            <option value="vegetable" <?php echo $filter_vegetable?>> Vegetable </option>
            <option value="herb" <?php echo $filter_herb?>> Herb </option>
          </select>
      </div>
      <div class="label-input">
        <label> Sort a-z: </label>
        <div class="label-input">
          <input id="yes" type="radio" name="sort" value="yes" <?php echo $sort_yes; ?>/>
          <label for="yes">Yes</label>
        </div>
        <div class="label-input">
          <input id="no" type="radio" name="sort" value="no" <?php echo $sort_no; ?> />
          <label for="no">No</label>
        </div>
      </div>
      <div>
          <input type="submit" name="tag-filter-submit" value="Filter" />
      </div>
    </div>
  </form>

  <?php if ($showtag) { ?>
    <h2 class="tag-title"> <?php echo htmlspecialchars(ucwords($tagfilter)) ?> </h2>
  <?php }; ?>

  <div class="photo-gallery">
    <?php foreach ($records as $record) { ?>
        <div class="title-picture">
          <h2> <a class="link" href="/details?<?php echo http_build_query(array('plantid' => $record["plantid"], 'tag-filter' => $tagfilter, 'sort' => $sort)); ?>"> <?php echo htmlspecialchars($record["plant_name_colloquial"]); ?> </a> </h2>
          <?php if (is_null($record['photo_file_extension'])){ ?>
              <!-- Source: https://www.housebeautiful.com/lifestyle/gardening/g31682048/what-to-plant-in-june/ -->
              <figure>
                <img src="/public/images/default.jpg" alt="default plant image">
                <figcaption> Source: <cite><a href="https://www.housebeautiful.com/lifestyle/gardening/g31682048/what-to-plant-in-june/">House Beautiful</a></cite> </figcaption>
              </figure>
          <?php } else { ?>
            <figure>
              <img src="/public/uploads/plants/<?php echo $record["plantid"]?>.<?php echo $record["photo_file_extension"]?>" alt="<?php echo htmlspecialchars($record["plant_name_colloquial"]);?> plant image">
            </figure>
        <?php }; ?>
        </div>
    <?php } ?>
  </div>
</body>

</html>
