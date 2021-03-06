<?php
session_start();
require_once("dbconnect.php");
header("Content-Type: application/json");

//fetch records from DB

if (isset($_POST['sortComplete'])){

    $sortBy = $_POST['sortComplete'];

    if ($sortBy == 'Newest') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE state = 3
ORDER BY `created_date` DESC";
    } else if ($sortBy == 'Oldest') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 3
ORDER BY `created_date`";
    } else if ($sortBy == 'Highest Prize') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 3
 ORDER BY `prize` DESC";
    } else if ($sortBy == 'Lowest Prize') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 3
ORDER BY `prize`";
    }
}

if (isset($_POST['sortActive'])){

    $sortBy = $_POST['sortActive'];

    if ($sortBy == 'Newest') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE state = 1
 ORDER BY `created_date` DESC";
    } else if ($sortBy == 'Oldest') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 1
 ORDER BY `created_date`";
    } else if ($sortBy == 'Highest Prize') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 1 
ORDER BY `prize` DESC";
    } else if ($sortBy == 'Lowest Prize') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 1
ORDER BY `prize`";
    }
}



if (isset($_POST['sortHomeActive'])){

    $sortBy = $_POST['sortHomeActive'];

    if ($sortBy == 'Newest') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE state = 1
AND u.user_id = ".$_SESSION['user_id']."
 ORDER BY `created_date` DESC";
    } else if ($sortBy == 'Oldest') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 1
AND u.user_id = ".$_SESSION['user_id']."
 ORDER BY `created_date`";
    } else if ($sortBy == 'Highest Prize') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 1 
AND u.user_id = ".$_SESSION['user_id']."
ORDER BY `prize` DESC";
    } else if ($sortBy == 'Lowest Prize') {
        $sqlQuery = "SELECT 
u.user_id, u.user_username, 
pr.project_id, pr.created_date, pr.closing_date, pr.prize, pr.project_desc, pr.project_title, pr.state, 
prr.room_id, prr.room_name, prr.room_type, 
prp.prop_id, prp.comment_extra_details, prp.feature_name 
FROM users AS u INNER JOIN projects as pr ON u.user_id = pr.creator_id 
INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
INNER JOIN project_properties as prp ON prp.room_id = prr.room_id
WHERE `state` = 1
AND u.user_id = ".$_SESSION['user_id']."
ORDER BY `prize`";
    }
}



if (isset($_POST['sortUserComplete'])){

    $sortBy = $_POST['sortUserComplete'];

    if ($sortBy == 'Newest') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE state = 3 
AND ps.user_id = ".$_SESSION['user_id']."
ORDER BY `created_date` DESC";
    } else if ($sortBy == 'Oldest') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE `state` = 3 
AND ps.user_id = ".$_SESSION['user_id']."
ORDER BY `created_date`";
    } else if ($sortBy == 'Highest Prize') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE `state` = 3
 AND ps.user_id = ".$_SESSION['user_id']." 
 ORDER BY `prize` DESC";
    } else if ($sortBy == 'Lowest Prize') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE `state` = 3
 AND ps.user_id = ".$_SESSION['user_id']."
ORDER BY `prize`";
    }
}

if (isset($_POST['sortUserActive'])){

    $sortBy = $_POST['sortUserActive'];

    if ($sortBy == 'Newest') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE 
	u.user_id = ".$_SESSION['user_id']."
	AND pr.state = 1 
ORDER BY 
	`created_date` DESC";
    } else if ($sortBy == 'Oldest') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE 
	u.user_id = ".$_SESSION['user_id']."
	AND pr.state = 1 
ORDER BY 
	`created_date`";
    } else if ($sortBy == 'Highest Prize') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE 
	u.user_id = ".$_SESSION['user_id']."
	AND pr.state = 1 
ORDER BY `prize` DESC";
    } else if ($sortBy == 'Lowest Prize') {
        $sqlQuery = "SELECT 
	u.user_id, 
	u.user_username, 
	pr.project_id, 
	pr.created_date, 
	pr.closing_date, 
	pr.prize, 
	pr.project_desc, 
	pr.project_title, 
	pr.state, 
	prr.room_id, 
	prr.room_name, 
	prr.room_type, 
	prp.prop_id, 
	prp.comment_extra_details, 
	prp.feature_name, 
	prf.caption, 
	prf.filename, 
	prf.filetype, 
	prf.file_id, 
	prf.public_name 
FROM 
	projects AS pr 
	INNER JOIN users as u ON pr.creator_id = u.user_id 
	INNER JOIN project_rooms as prr ON prr.project_id = pr.project_id 
	INNER JOIN project_properties as prp ON prp.room_id = prr.room_id 
	INNER JOIN project_files as prf ON prf.room_id = prp.room_id 
	INNER JOIN project_submissions as ps ON pr.project_id = ps.project_id 
WHERE 
	u.user_id = ".$_SESSION['user_id']."
	AND pr.state = 1 	
ORDER BY `prize`";
    }
}





$result = $conn->query($sqlQuery);



$proj_id = 0;
$room_id = 0;
$file_id = 0;

$projects = array();
$rooms = array();
$files = array();
$properties = array();
$images = array();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    if ($proj_id != $row["project_id"]) {
        $rooms = array();
        $files = array();
        $properties = array();
        $projects[] = array(
            "user_id" => $row["user_id"],
            "username" => $row["user_username"],
            "project_id" => $row["project_id"],
            "created_date" => $row["created_date"],
            "closing_date" => $row["closing_date"],
            "prize" => $row["prize"],
            "project_desc" => $row["project_desc"],
            "project_title" => $row["project_title"],
            "rooms" => array()
        );

        $rooms[] = array(
            "room_id" => $row["room_id"],
            "room_name" => $row["room_name"],
            "room_type" => $row["room_type"],
            "comment_extra_details" => $row["comment_extra_details"],
            "files" => array(),
            "properties" => array()
        );

        $rooms[0]["properties"][] = array(
            "feature_name" => $row["feature_name"]
        );

        $f = "SELECT * FROM project_files where room_id = ?";
        $result2 = $conn->prepare($f);
        $result2->execute(array($row['room_id']));



        while ($rowF = $result2->fetch(PDO::FETCH_ASSOC)) {

            $rooms[0]['files'][] = array(
                "filename" => $rowF["filename"],
                "filetype" => $rowF["filetype"],
                "file_id" => $rowF["file_id"],
                "caption" => $rowF["caption"],
                "public_name" => $rowF["public_name"]
            );

        }

        $proj_id = $row["project_id"];
        $counter = sizeof($projects) - 1;
        $projects[$counter]["rooms"] = $rooms;

    } else {

        $rooms[0]["properties"][] = array(
            "feature_name" => $row["feature_name"]
        );
        $counter = sizeof($projects) - 1;
        $projects[$counter]["rooms"] = $rooms;
    }
}


exit(json_encode($projects));

?>