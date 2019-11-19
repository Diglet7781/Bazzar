
<?php
  
    
   require_once "dblogin.php";
   require_once "class/Seller.php";
   require_once "functions/validate.php";
  // $username=$_SESSION['username'];
  // $type= $_SESSION['type'];

  
   $sellerId=$_SESSION["userId"];
  echo  $_SESSION["userId"];
  // session_start();
  // if(isset($_SESSION['accountType']))
  // {
     //  if($_SESSION['accountType']=='seller')
      // {
   
   if (isset($_POST["add"])){
       $productName= test_input($_POST["itemName"]);
       $productType=test_input($_POST["productType"]);
       $productDescription=test_input($_POST["description"]);
       $productQuantity=test_input($_POST["quantity"]);
       $productPrice=test_input($_POST["price"]);
       $status = 'on';
       //this is for file upload"
       $file=$_FILES['picture'];

       $fileName= $_FILES['picture']['name'];
       $fileTmpName=$_FILES['picture']['tmp_name'];
       $fileSize=$_FILES['picture']['size'];
       $fileError=$_FILES['picture']['error'];
       $fileType=$_FILES['picture']['type'];
 

       $fileExt=explode('.',$fileName);

       $fileActualExt=strtolower(end($fileExt));

       $allowed=array('jpg','jpeg','png','pdf');





/*
       //For pictures
       $picName=$_FILES['picture']['picName'];
       $target_dir="upload/";
       $target_file=$target_dir .basename($_FILES["picture"]["picName"]);
       //select file type
       $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
       //valid file exxtensions
       $extensions_arr = array("jpg","jpeg","png","gif");
       $image_base64 = base64_encode(file_get_contents($_FILES['picture']['tmp_name']) );
       $productImage = 'data:image/'.$imageFileType.';base64,'.$image_base64;
       
         //validate input fields and verify
       //itemValidate($productName,$productType,$productDescription,$productQuantity,$productPrice,$productImage); 
       */

       
       
   if(in_array($fileActualExt,$allowed)){
       if($fileError===0){
           if($fileSize<50000000){
               $fileNameNew=uniqid('',true).".".$fileActualExt;
               $fileDestination="./upload/".$fileNameNew;
       
       $products= new Seller($productName,$productType,$productDescription, $productQuantity, $productPrice, $fileDestination);
       $connect = createConn();
       $result=$connect->query($products->addItems()); 

               move_uploaded_file($_FILES['picture']['tmp_name'],$fileDestination);
               header("Location:../backend/viewInventory.php");
               
               //print_r($fileDestination);

           }else{
               echo "you file is too big!";
           }

       }else{
           echo "there was an error uploading your file";
       }

   }else{
       echo "you cannot upload files of this type";
   }
       /*
       //Upload File
       move_uploaded_file($_FILES['picture']['tmp_name'],$target_dir.$name);
       if (!$result){
           die($connect->error);
       }
       else{
           echo "item added sucessfully";
           header('Location:logout.php');
       }
       */
   }
?>