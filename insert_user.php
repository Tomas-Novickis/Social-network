<?php
    include("includes/connection.php");

    if(isset($_POST['sign_up']))
    {
        $first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
        $last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
        $pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
        $email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
        $country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
        $gender = htmlentities(mysqli_real_escape_string($con,$_POST['u_gender']));
        $birthday = htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
        $status = "verified";
        $posts = "no";
        $newgid = sprintf('%05d' , rand(0, 999999));

        $username = strtolower($first_name . "_" . $last_name . "_" . $newgid);
        $check_username_query = "SELECT user_name FROM users WHERE user_email='$email'";
        $run_username = mysqli_query($con, $check_username_query);

        if(strlen($pass) < 4 ){
            echo "<script>alert('Pass should be minimum 4 characters!')</script>";
            exit();
        }
        
        $check_email = "SELECT * FROM users WHERE user_email='$email'";
        $run_email = mysqli_query($con, $check_email);

        $check = mysqli_num_rows($run_email);

        if ($check == 1){
            echo "<script>alert('Email already exist, Please try using another email')</script>";
            echo "<script>windows.open('signup.php', '_self')</script>";
            exit();
        }

        

         if($gender == "Male")
        
            $profile_pic = "head_man.png";
       
        if($gender == "Female")
            
            $profile_pic = "head_woman.png";

        if($gender == "Others")

            $profile_pic = "head_neutral.png";
         

        $insert = "insert into users (
        f_name, l_name, user_name, describe_user, Relationship, user_pass, user_email, 
        user_country, user_gender, user_birthday, user_image, user_cover, user_reg_date,
        status, posts, recovery_account)
        values('$first_name','$last_name','$username','Hello WebsiteDiary!','...','$pass','$email',
            '$country','$gender','$birthday','$profile_pic','default_cover.jpg',NOW(),'$status','$posts',
            'recovery')";
        
        $query = mysqli_query($con, $insert);

        if($query){
            echo "<script>alert('Well done, $first_name. Everything is correct')</script>";
            echo "<script>windows.open('signin.php', '_self')</script>";
            
        }
        else {
            echo "<script>alert('Registration failed, please try again.')</script>";
            echo "<script>windows.open('signup.php', '_self')</script>";
        }
        
    }
?>