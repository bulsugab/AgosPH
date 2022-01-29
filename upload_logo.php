<?php
include('auth.php');
require('config.php');

//$status = $statusMsg = ''; 
if(isset($_POST["submit4"])){ 
    // $status = 'error'; 
    if(!empty($_FILES["banner4"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["banner4"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
            
    if(in_array($fileType, $allowTypes)) { 

            $image = $_FILES['banner4']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
        // Insert image content into database 
        $insert = $db->query("UPDATE imgs SET imgFile='$imgContent' WHERE imgClass='logo'") or die(mysqli_error($db));
            if($insert){ //isasali sa loob
                // $referer = $_SERVER['HTTP_REFERER'];
                header("Location: settings.php");
            } else { 
                echo "<script>alert('File upload failed, please try again.');
                header('Location: settings.php');
                </script>";
            }  
        } //if to check file type

        else { 
            echo "<script>alert('Sorry, only JPG, JPEG, PNG, & GIF files are allowed to be uploaded.');
            header('Location: settings.php'); 
            </script>";
        } //else file type
    } //if not empty

else { 
        echo "<script>alert('Please select an image file to upload.');
        header('Location: settings.php');
        </script>";
        
} //isset empty

} //isset submit
 
?>