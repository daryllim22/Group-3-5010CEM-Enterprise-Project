<?php
    require("Connectdb.php");

    if ($_SERVER['REQUEST_METHOD']=="POST") {

        // user input
        $promoImg = $_FILES['promo-image'];
        $promoTitle = $_POST['promo-title'];

           
        //handling the image for insertion into database
        $imageFileName = $promoImg['name'];
    
        //error handling
        $imageFileError = $promoImg['error'];
    
        //assigning temporary name of file to variable
        $imageFileTemp = $promoImg['tmp_name'];
    
        //separating the name of the file and the file type into separate strings e.g. image.jpg -> 'image' 'jpg'
        $filename_separate = explode('.', $imageFileName);
    
        //converting the file extension e.g. .JPG to lower case for consistency
        $file_extension = strtolower(end($filename_separate));
    
        //accepting these file types into the upload
        $extension = array('jpeg', 'jpg', 'png');
    
    
        if (in_array($file_extension, $extension)) {
            $uploadImage = 'images/' . $imageFileName;
            move_uploaded_file($imageFileTemp, $uploadImage);
    
            $query = "INSERT INTO carousel_promo(promoImage, promoTitle) VALUES ('$uploadImage', '$promoTitle')";
            $result = mysqli_query($con, $query);
    
            if ($result) {
                echo "Promo image added successfully <br/>";
                header("Location: apromo.php");
                die;
            }
            else {
                die("Error: " . mysqli_error($con));
            }
        }
    }
?>