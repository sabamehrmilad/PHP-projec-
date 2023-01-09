<?php
session_start();
$mysqli=new mysqli('localhost','root','','germanteach') or die($mysqli->error);


if(isset($_POST['save'])){
    $code=$_POST['code'];
    $title=$_POST['title'];
    $description=$_POST['description'];
    $user=$_POST['user'];
    $category=$_POST['category'];
    $branch=$_POST['branch'];
    $number=$_POST['number'];
    $file=$_FILES['file'];
    $filename=$_FILES['file']['name'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileType=$_FILES['file']['type'];
//    print_r($user);
//    print_r($branch);


    $fileExt=explode('.',$filename);
    $fileActualExt=strtolower(end($fileExt));

    $allowed=array('jpg','jpeg','png');
    if(in_array($fileActualExt,$allowed))
    {
        if($fileError===0){
            $fileDestination='../img/'.$filename;
            move_uploaded_file($fileTmpName,$fileDestination);


        }

    }else
    {
        echo"You cannot upload files of this type!";
    }



    $mysqli->query("INSERT INTO things(code,title,Description,image,category,branch_id,user_id,numbers)VALUES ('$code','$title','$description','$filename','$category','$branch','$user','$number')") or die($mysqli->error);
    header("location:index.php");
}



if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   $mysqli->query("DELETE FROM things WHERE id=$id") or die($mysqli->error);
   $_SESSION['message']="کالا مورد نظر حذف شد!";
   $_SESSION['msg_type']="danger";
   header("location:index.php");

}

//if(isset($_GET['sync'])) {
//    $id = $_GET['sync'];
//    $result = $mysqli->query("SELECT * FROM events WHERE id='$id'") or die($mysqli->error());
//    if (count(array($result)) == 1) {
//        require_once 'jdf.php';
//        $row = $result->fetch_array();
//        $title = $row['day_title'];
//        $year = $row['year_num'];
//        $month = $row['month_num'];
//        $day = $row['day_num'];
//        $day_type = $row['if_off'];
//        $description = $row['description'];
//        $later_year=$year+1;
//        $mysqli->query("UPDATE events SET day_title='$title'  ,year_num='$later_year'  ,month_num='$month'  ,day_num='$day'  ,description='$description'   ,if_off='$day_type' WHERE id='$id'")or die($mysqli->error);
//        $_SESSION['message']="تاریخ مورد نظر ویرایش شد!";
//        $_SESSION['msg_type']="warning";
//        header("location:index.php");
//
//    }
//}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $code=$_POST['code'];
    $title=$_POST['title'];
    $Description=$_POST['description'];
    $user=$_POST['user'];
    $branch=$_POST['branch'];
    $numbers=$_POST['number'];
    $category=$_POST['category'];
    $file=$_FILES['file'];
    $filename=$_FILES['file']['name'];
    $image_saves=$filename;
    $fileTmpName=$_FILES['file']['tmp_name'];
    if($fileTmpName!="")
    {
        move_uploaded_file($fileTmpName, "../img/$filename");
        $mysqli->query("UPDATE things SET code='$code'  ,title='$title'  ,Description='$Description'  ,image='$filename'  ,category='$category'   ,numbers='$numbers',user_id='$user',branch_id='$branch' WHERE id='$id'")or die($mysqli->error);

//        $c_update="update things set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass',  customer_image= '$c_image'
//     where customer_id='$customer_id'";
    }else
    {
        $mysqli->query("UPDATE things SET code='$code'  ,title='$title'  ,Description='$Description'    ,category='$category'   ,numbers='$numbers',user_id='$user',branch_id='$branch' WHERE id='$id'")or die($mysqli->error);


    }
    $_SESSION['message']="کالا مورد نظر ویرایش شد!";
    $_SESSION['msg_type']="warning";
    header("location:index.php");
}
if (isset($_POST['report']))
{
   $id = $_POST['id'];
   $report = $_POST['report_text'];
   $number=$_POST['number'];
   $changed_number=$_POST['changed_number'];
   $category=$_POST['category'];

   if ($changed_number!="")
   {
       $mysqli->query("INSERT INTO report(report,number,changed_number,things_id,category)VALUES ('$report','$number','$changed_number','$id','$category')") or die($mysqli->error);

   }else
       $mysqli->query("INSERT INTO report(report,number,changed_number,things_id)VALUES ('$report','$number','$number','$id','$category')") or die($mysqli->error);
       $mysqli->query("UPDATE things SET numbers='$changed_number' WHERE id='$id'")or die($mysqli->error);

    header("location:index.php");


}
