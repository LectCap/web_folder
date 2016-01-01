<?php
include($_SERVER['DOCUMENT_ROOT']."php/db.php");
session_start();
$lect_id = $_POST['lect_id'];
$slideTime = $_POST['start_sec'];
$target_dir = "images/";
$filename = generateRandomString().".";
$imageFileType = pathinfo($_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
$target_file = $_SERVER['DOCUMENT_ROOT'] . $target_dir . $filename . $imageFileType;
$uploadOk = 1;
$path = $target_dir . $filename . $imageFileType;
$path = db_quote($path);
// Check if image file is a actual image or fake image
if(isset($_POST["lect_id"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
		if (file_exists($target_file)) {
			$return = array('code' => -1);
			echo json_encode($return);
		} else {
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				$return = array('code' => -3);
				echo json_encode($return);
			} else {
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					$return = array('code' => -4);
					echo json_encode($return);
				} else {
					if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						$result = db_query("INSERT INTO slides (id,time,path) VALUES ($lect_id, $slideTime, $path)");
						$return = array('code' => 1);
						echo json_encode($return);
					//Error uploading file
					} else {
						$return = array('code' => -5);
						echo json_encode($return);
					}
				}
			}
		}
    } else {
        $return = array('code' => 0);
		echo json_encode($return);
        $uploadOk = -1;
    }
} else {
	$return = array('code' => -10);
	echo json_encode($return);
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>