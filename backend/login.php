
<?php
   // session_start();
  
    require_once "functions/validate.php";
    require_once "dblogin.php";
   
    if(isset($_POST['submitSignIn'])){
        $username=test_input($_POST['username']);
        $password=test_input($_POST['password']);
        echo "hello";
        //creating conncetion to the db
        $connect= createConn();
        $query="SELECT * From user where username='$username';";
        $result= $connect->query($query);
        if($result->num_rows==1){
            $row=$result->fetch_assoc();
           if (password_verify($password,$row['password']))
           {
               session_start();
              $_SESSION['username']=$row['username'];
              $type= $_SESSION['type']=$row['accountType'];
              $_SESSION['userId']=$row['userId'];
              
                    switch ($type)
                                    {
                                        case 'Seller':
                                         header('Location:addinventory.php');
                                        exit();
                                        case 'Buyer':
                                        header('Location:viewHomepage.php');
                                        exit();
                                        default:
                                        echo "create account ";
                                    }
            }
            else{
               echo "password did not match";
                }
        }
        else{
            echo "please enter the correct credentials or create a new account";
             }
 
    }
    ?>