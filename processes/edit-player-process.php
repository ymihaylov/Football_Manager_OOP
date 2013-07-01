<?php
// fileToUpload is the name of our file input field
if ($_FILES['file-to-upload']['error'] > 0) {
    echo "Error: " . $_FILES['fileToUpload']['error'] . "<br />";
} else {
    // array of valid extensions
    $valid_extensions = array('.jpg', '.jpeg', '.gif', '.png');
	
	// get extension of the uploaded file
    $file_extension = strrchr($_FILES['file-to-upload']['name'], ".");

    if (in_array($file_extension, $valid_extensions)) 
    {
     	$newName = time() . '_' . $_FILES['file-to-upload']['name'];
    	$destination = '../uploads/' . $newName;

    	if (move_uploaded_file($_FILES['file-to-upload']['tmp_name'], $destination)) {
            echo 'File ' .$newName. ' succesfully copied';
        }
    } 
    else 
    {
        echo 'You must upload an image...';
    }

    echo "File name: " . $_FILES['file-to-upload']['name'] . "<br />";
    echo "File type: " . $_FILES['file-to-upload']['type'] . "<br />";
    echo "File size: " . ($_FILES['file-to-upload']['size'] / 1024) . " Kb<br />";
    echo "Temp path: " . $_FILES['file-to-upload']['tmp_name'];
}