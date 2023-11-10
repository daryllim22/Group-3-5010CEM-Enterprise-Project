<?php

    include("Connectdb.php");
    
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        // current product id passed in from `editproduct.php`
        $pdID = $_GET['id'];

        // form variables
        $pdName = $_POST['pd-name'];
        $pdPrice = $_POST['pd-price'];
        $pdSize = $_POST['pd-size'];
        $pdStockCount = $_POST['pd-stock-count'];
        $pdDescription = $_POST['pd-description'];
        $pdImg = $_FILES['pd-image'];
        $pdImgCurrent = $_POST['pd-img-nochange'];
        $userSelectedCategories = $_POST['category'];

        //error handling for $_FILES
        $imageFileError = $pdImg['error'];


        //escaping the product description input
        $escapedPDDescription = mysqli_real_escape_string($con, $pdDescription);


        //if the user doesn't upload a new file, database will be populated with the existing file location
        if ($imageFileError === UPLOAD_ERR_NO_FILE) {
            $uploadImage = $pdImgCurrent;
        }
        else {
            //retrievng file name
            $imageFileName = $pdImg['name'];

            //assigning temporary name of file to variable
            $imageFileTemp = $pdImg['tmp_name'];

            //separating the name of the file and the file type into separate strings e.g. image.jpg -> 'image' 'jpg'
            $filename_separate = explode('.', $imageFileName);

            //converting the file extension e.g. .JPG to lower case for consistency
            $file_extension = strtolower(end($filename_separate));

            //accepting these file types into the upload
            $extension = array('jpeg', 'jpg', 'png');



            if (in_array($file_extension, $extension)) {
                $uploadImage = 'images/' . $imageFileName;
                move_uploaded_file($imageFileTemp, $uploadImage);
            }
        }


        // updating the product data
        $queryUpdate = "UPDATE product
                  SET 
                    pdName = '$pdName', 
                    pdPrice = '$pdPrice', 
                    pdSize = '$pdSize', 
                    pdStockCount = '$pdStockCount', 
                    pdDescription = '$escapedPDDescription', 
                    pdImage = '$uploadImage' 
                  WHERE pdID = $pdID";
        $result = mysqli_query($con, $queryUpdate);

        if (!$result) {
            die("Update product data SQL error: " . mysqli_error($con));
        }




        // ---------------------------------------------------------------------------------------------------------




        // clearing the product's product-category associations before inserting the new & updated ones
        $clearExistingUserCategories = "DELETE FROM pd_category_relationship WHERE pdID = $pdID";
        $clearResult = mysqli_query($con, $clearExistingUserCategories);
        // error handling
        if (!$clearResult) {
            die("Error clearing categories: " . mysqli_error($con));
        }

        // when the user selects a category
        // iterate through each user input and inserting product-category relationship into database
        foreach ($userSelectedCategories as $pdUserCategory) {
            $assignNewCategory = "INSERT INTO pd_category_relationship(pdID, catID) VALUES ('$pdID', (SELECT catID FROM product_category WHERE catID = '$pdUserCategory'))";
            $assignResult = mysqli_query($con, $assignNewCategory);

            if(!$assignResult) {
                die("Inserting product-category relationship SQL error: " . mysqli_error($con));
            }
        }


        // redirect to `viewproducts.php`
        header("Location: aviewproducts.php");


        $con->close();
    }
?>