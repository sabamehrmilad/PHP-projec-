<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+SC" rel="stylesheet">
    <link rel="manifest" href="site.webmanifest">
    <link rel="icon" href="" type="../image/png">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="../style_css_files/normalize.css">
    <link rel="stylesheet" href="../style_css_files/main.css?version=27">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="../js/particles.min.js"></script>
    <link rel="stylesheet" href="/dp/css/persianDatepicker-default.css">
</head>
<body>
<?php include '../sections/menu.php';?>
<?php require_once 'process.php'; ?>
<?php
$mysqli=new mysqli('localhost','root','','germanteach') or die($mysqli->error);
$id = $_GET['edit'];
$result=$mysqli->query("SELECT * FROM things WHERE id='$id'") or die($mysqli->error());
$users=$mysqli->query("SELECT id,first_name,last_name FROM users")or die($mysqli->error());
$branches=$mysqli->query("SELECT id,branch_name FROM branches")or die($mysqli->error());
if (count(array($result))==1) {
    $row = $result->fetch_array();
    $code = $row['code'];
    $title = $row['title'];
    $Description = $row['Description'];
    $image = $row['image'];
    $user = $row['user_id'];
    $branch = $row['branch_id'];
    $numbers=$row['numbers'];
    $category = $row['category'];
}

?>
<div class="container-fluid">
    <div class="row">
        <?php include '../sections/dashboard.php';?>
        <div class="col col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <div class="box">
                <div class="content">
                    <!--Content of the Page Starts-->
                    <!--Dear Milad, YOUR CODES ARE HERE...-->
                    <form method="POST" action="process.php" enctype="multipart/form-data" >
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <div class="form-group">
                            <label for="formGroupExampleInput">کد کالا</label>
                            <input type="text" value="<?php echo $code ?>" name="code" class="form-control" id="formGroupExampleInput" >
                        </div>
                        <div class="form-group">
                            <label for="formGroupExampleInput">عنوان</label>
                            <input type="text" value="<?php echo $title ?>" name="title" class="form-control" id="formGroupExampleInput" placeholder="عنوان کالا را وارد کنید">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">توضیحات</label>
                            <textarea class="form-control"  name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $Description ?></textarea>
                        </div>
                        <img height="400px" width="400px" src="../img/<?php echo $image ?>" class="img-fluid" alt="Responsive image">

                        <div class="form-group">
                            <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">
                        </div>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">در تحویل چه کسی می باشد ؟</label>
                        <select class="custom-select my-1 mr-sm-2" name="user" id="inlineFormCustomSelectPref">
                            <option  selected>فرد مورد نظر را انتخاب بکنید</option>
                            <?php while($row=mysqli_fetch_array($users)) { ?>
                                <option value="<?php echo $row['id']?>" <?php if ($row['id']==$user)  echo ' selected="selected"';?> ><?php echo $row['first_name'].''.$row['last_name'] ?></option>
                            <?php } ?>

                        </select>
                        <label class="my-1 mr-2" for="month-selector">در کدام شعبه می باشد ؟</label>
                        <select class="custom-select my-1 mr-sm-2" name="branch" id="month-selector">
                            <option selected>شعبه مورد نظر را انتخاب بکنید</option>
                            <?php while($row=mysqli_fetch_array($branches)) { ?>
                                <option value="<?php echo $row['id']?>" <?php if ($row['id']==$branch)  echo ' selected="selected"';?> ><?php echo $row['branch_name'] ?></option>
                            <?php } ?>
                        </select>
                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">اموال یا تبلیغات</label>
                        <select class="custom-select my-1 mr-sm-2" name="category" id="inlineFormCustomSelectPref">
                            <option selected>نوع وسیله  مورد نظر را انتخاب بکنید</option>
                            <option value="1" <?php if ($category == '1') echo ' selected="selected"'; ?>>تبلیغاتی</option>
                            <option value="2" <?php if ($category == '2') echo ' selected="selected"'; ?>>اموال</option>
                        </select>

                        <div class="form-group">
                            <label for="formGroupExampleInput">تعداد</label>
                            <input type="number" value="<?php echo $numbers?>"  name="number" class="form-control" id="formGroupExampleInput" >
                        </div>
                        <button style="position:relative; top: 5px; right:10px;"  type="submit" name="update" value="update" class="btn btn-primary" >ویرایش</button>
                    </form>
                    <!--Content of the Page Ends-->
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<?php include '../sections/footer.php'; ?>
<script src="../js/vendor/modernizr-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-3.3.1.min.js"><\/script>')</script>
<script src="../js/plugins.js"></script>
<script src="../js/main.js"></script>
<script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('send', 'pageview')
</script>

<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
