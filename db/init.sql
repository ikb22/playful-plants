--- Plant Information ---

CREATE TABLE plants (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  plant_name_colloquial TEXT NOT NULL,
  plant_name_scientific TEXT NOT NULL,
  plantid TEXT NOT NULL UNIQUE,
  constructive_play INTEGER NOT NULL,
  sensory_play INTEGER NOT NULL,
  physical_play INTEGER NOT NULL,
  imaginative_play INTEGER NOT NULL,
  restorative_play INTEGER NOT NULL,
  expressive_play INTEGER NOT NULL,
  play_with_rules INTEGER NOT NULL,
  bio_play INTEGER NOT NULL,
  nooks_or_secret_spaces INTEGER NOT NULL,
  loose_parts_or_play_props INTEGER NOT NULL,
  climbing_and_swinging INTEGER NOT NULL,
  mazes INTEGER NOT NULL,
  unique_elements INTEGER NOT NULL,
  edible INTEGER NOT NULL,
  taste TEXT,
  produces_scent INTEGER NOT NULL,
  scent TEXT,
  perennial INTEGER NOT NULL,
  annual INTEGER NOT NULL,
  full_sun INTEGER NOT NULL,
  partial_shade INTEGER NOT NULL,
  full_shade INTEGER NOT NULL,
  hardiness_zone_range TEXT,
  general_classification TEXT,
  photo_file_extension TEXT
);

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (1, 'Swamp Azalea', 'Rhododendron viscosum', 'SH_30', 0, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, NULL, 1, 'Sweet flower', 1, 0, 0, 1, 0, '4-9', 'Shrub', NULL);

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (2, 'Bronze Fennel', "Foeniculum vulgare 'Purpureum'", 'FL_16', 0, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, NULL, 1, NULL, 1, 0, 1, 1, 0, '4', 'Flower', NULL);

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (3, 'Soapwort', "Saponaria officinalis", 'GR_17', 0, 1, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0.5, "Sweet treat in small quantities but toxic in large quantities", 1, "Fragrant", 1, 0, 1, 0, 0, '3-8', 'Groundcovers', 'jpg');

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (4, '3 Sisters-Squash', "Cucurbita pepo", 'FE_09', 0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, "Edible once cooked, can eat squash blossoms", 0, NULL, 0, 1, 1, 0, 0, '3-10', 'Vegetable', NULL);

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (5, 'Iris, tall bearded', "Iris, 'Florentina'", 'FL_31', 0, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, "Taste disgusting and the bulbs are poisonous", 1, "Fragrant", 1, 0, 1, 0, 0, '3-9', 'Flower', 'jpg');

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (6, 'Sugar Maple', "Acer saccharum", 'TR_25', 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, 1, 1, "Seeds can be removed from the samaras and eaten raw or roasted. The trees could be tapped and you can drink the sap straight from the tree or boil it down into maple syrup", 0, NULL, 1, 0, 1, 1, 0, '3-8', 'Tree', 'jpg');

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (7, '3 Sisters-Beans', "Phaseolus vulgaris", 'FE_08', 0, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 1, NULL, 0, NULL, 0, 1, 1, 0, 0, '5-13', 'Vegetable', NULL);

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (8, 'Common Strawberry', "Fragaria virginiana", 'GR_22', 0, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, "Sweet", 0, NULL, 1, 0, 1, 1, 0, '4-9', 'Groundcovers', NULL);

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (9, 'Trumpet creeper', "Campsis radicans", 'VI_14', 0, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, NULL, 0, NULL, 1, 0, 1, 1, 0, NULL, "Vine", 'jpg');

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (10, 'Star Magnolia', "Magnolia stellata", 'TR_10', 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, 1, 1, "Blossoms eaten pickled. Young leaves edible when cooked, but not desireable.", 1, "Sweet smelling plant", 0, 0, 1, 1, 0, "5-8", "Tree", "jpg");

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (11, 'American Holly', "Ilex opaca", 'TR_28', 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0, NULL, 1, "Sweet flowers", 1, 0, 1, 1, 0, "5-9", "Tree", "jpg");

INSERT INTO
  plants (id, plant_name_colloquial, plant_name_scientific, plantid, constructive_play, sensory_play, physical_play, imaginative_play, restorative_play, expressive_play, play_with_rules, bio_play, nooks_or_secret_spaces, loose_parts_or_play_props, climbing_and_swinging, mazes, unique_elements, edible, taste, produces_scent, scent, perennial, annual, full_sun, partial_shade, full_shade, hardiness_zone_range, general_classification, photo_file_extension)
VALUES
  (12, 'Dill', "Anethum graveolens", 'FL_15', 0, 1, 0, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, NULL, 1, NULL, 1, 0, 1, 0, 0, "2-11", "Flower", 'jpg');

--- Tag Information ---

CREATE TABLE tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  tag TEXT NOT NULL UNIQUE
);

INSERT INTO tags (id, tag) VALUES (1,"shrub");
INSERT INTO tags (id, tag) VALUES (2,"grass");
INSERT INTO tags (id, tag) VALUES (3,"vine");
INSERT INTO tags (id, tag) VALUES (4,"tree");
INSERT INTO tags (id, tag) VALUES (5,"flower");
INSERT INTO tags (id, tag) VALUES (6,"groundcovers");
INSERT INTO tags (id, tag) VALUES (7,"perennial");
INSERT INTO tags (id, tag) VALUES (8,"annual");
INSERT INTO tags (id, tag) VALUES (9,"full sun");
INSERT INTO tags (id, tag) VALUES (10,"partial shade");
INSERT INTO tags (id, tag) VALUES (11,"full shade");
INSERT INTO tags (id, tag) VALUES (12,"vegetable");
INSERT INTO tags (id, tag) VALUES (13,"herb");

--- Plant-tag Relationships ---

CREATE TABLE plant_tags (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  plant_id INTEGER NOT NULL,
  tag_id INTEGER NOT NULL,
  FOREIGN KEY (plant_id) REFERENCES plants(id),
  FOREIGN KEY (tag_id) REFERENCES tags(id)
);

INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (1, 1, 1);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (2, 1, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (3, 1, 10);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (4, 2, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (5, 2, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (6, 2, 10);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (7, 2, 5);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (8, 2, 13);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (9, 3, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (10, 3, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (11, 3, 6);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (12, 4, 8);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (13, 4, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (14, 4, 12);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (15, 5, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (16, 5, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (17, 5, 5);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (18, 6, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (19, 6, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (20, 6, 10);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (21, 6, 4);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (22, 7, 8);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (23, 7, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (24, 7, 12);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (25, 8, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (26, 8, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (27, 8, 10);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (28, 8, 6);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (29, 9, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (30, 9, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (31, 9, 10);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (32, 9, 3);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (33, 10, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (34, 10, 10);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (35, 10, 4);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (36, 11, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (37, 11, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (38, 11, 10);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (39, 11, 4);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (40, 12, 7);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (41, 12, 9);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (42, 12, 5);
INSERT INTO plant_tags (id, plant_id, tag_id) VALUES (43, 12, 13);

--- User Information ---

CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
);

INSERT INTO users (id, name, username, password) VALUES (1, 'Isabelle Breedveld', 'ikb22', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.');

INSERT INTO users (id, name, username, password) VALUES (2, 'Ellie Perlitz', 'ekp42', '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.');

CREATE TABLE groups (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL UNIQUE
);

INSERT INTO groups (id, name) VALUES (1, 'admin');

CREATE TABLE memberships (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  group_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,
  FOREIGN KEY(group_id) REFERENCES groups(id),
  FOREIGN KEY(user_id) REFERENCES users(id)
);

INSERT INTO memberships (id, group_id, user_id) VALUES (1,1,1);

--- Session Information ---

CREATE TABLE sessions (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id)
);
