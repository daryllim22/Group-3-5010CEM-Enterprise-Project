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
        $selectedCategories = $_POST['category'];

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

        if ($result) {
            // error_log("Product updated successfully");
            echo "Product details updated successfully <br/>";
            header("Location: viewproducts.php");
            die;
        }
        else {
            // error_log("Error: " . mysqli_error($con));
            echo "Error: " . mysqli_error($con);
        }


        // categorising the product
        $checkPDCategory = "SELECT 
                              product_category.catID, 
                              product_category.catName
                            FROM pd_category_relationship 
                            JOIN product_category ON pd_category_relationship.catID = product_category.catID
                            WHERE pdID = $pdID";
        $checkResult = mysqli_query($con, $checkPDCategory);

        // assigning the product product-categories
        if (isset($selectedCategories)) {
            // iterate through each user input for product category
            foreach ($selectedCategories as $pdCategory) {
                $catMatch = false; // variable for checking for match in data

                // pulling the result from every row to compare with user input
                // if category is already selected, indicate existence of data
                while ($tbrow = mysqli_fetch_assoc($checkResult)) {
                    if ($pdCategory === $checkResult) {
                        $catMatch = true;
                        break;
                    }
                }

                // if user's new selection isn't found in product-category association table
                if ($catMatch === false) {
                    $asgnNewCategory = "INSERT INTO pd_category_relationship(pdPD, catID) VALUES '$pdID', (SELECT catID FROM product_category WHERE catName = $pdCategory)";
                    $assignResult = mysqli_query($con, $asgnNewCategory);

                    if(!$assignResult) {
                        echo "SQL error: " . mysqli_error($con);
                    }
                }

            }
        }
        // else {
        //     // cycle through the rows where pdID is present
        //     // if any rows still have old data that user just unchecked
        //     while ($tbrow = mysqli_fetch_assoc($checkResult)) {
                
        //     }
        // }


        // if nothing in $selectedCategories matches any category names in the database, DELETE row
        $dbCategory = $tbrow['catID'];

        if (!in_array($dbCategory, $selectedCategories)) {
            // separating the array values by dynamically adding commas between them for the SQL query condition
            $formattedCategories = implode(", ", $selectedCategories);

            $removeCategory = "DELETE FROM 
                                pd_category_relationship 
                               WHERE 
                                catName
                               NOT IN
                                ()";
        }
    }
?>