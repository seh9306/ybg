 <?php


    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    $filename = "/uploads/".$_FILES["file"]["name"];
	echo $filename;


      if(!move_uploaded_file($_FILES["file"]["tmp_name"],"$filename"))
      echo "   nono";


?> 
