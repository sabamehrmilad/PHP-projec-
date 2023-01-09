
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
            </head>
            <body>
                <?php include '../sections/menu.php';?>
                <?php require_once 'process.php'; ?>
                <?php
                  $mysqli=new mysqli('localhost','root','','germanteach');
                  $results=$mysqli->query("SELECT * FROM things") or die ($mysqli->error);

                ?>
                <?php

                if(isset($_SESSION['message'])): ?>

                <div class="alert alert-<?=$_SESSION['msg_type']?>">

                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
                <?php endif ?>
                </div>



                <div class="container-fluid">
                    <div class="row">
                        <?php include '../sections/dashboard.php';?>
                        <div class="col col-12 col-sm-12 col-md-9 col-lg-9 col-xl-9">
                            <div class="box">
                                <div class="content">
                                <!--Content of the Page Starts-->

                                <!--Dear Milad, YOUE CODES ARE HERE...-->
                                    <a class="btn btn-success" href="index2.php">گزارش کالاهای آموزشگاه </a>
                                    <a class="btn btn-primary" href="index3.php">گزارش کالاهای تبلیغاتی</a>
                                    <a class="btn btn-danger" href="index4.php">گزارش اموال معیوب و مفقود آموزشگاه  </a>
                                    <a class="btn btn-danger" href="index5.php">گزارش اموال معیوب و مفقود  تبلیغاتی  </a>

                                    <div style="display:flex; flex-direction: row;margin-top: 20px; margin-bottom: 10px;" >
                                    <input type="text" style=" width: 300px;   " id="myInput" onkeyup="myFunction()" class="form-control" placeholder="جستجو بر اساس شرح کالا ">
                                    <input type="text" style=" width: 300px; position:relative; right:20px " id="myInput-second" onkeyup="myfunction()" class="form-control" placeholder="جستجو بر اساس عنوان کالا ">
                                    </div>





                                    <table  style='text-align: right;' class='table table-hover table-bordered' id="myTable">
                                        <thead>
                                        <tr class="table-active">
                                            <th scope="col">#</th>
                                            <th scope="col">عکس</th>
                                            <th scope="col">کد کالا</th>
                                            <th scope="col">عنوان</th>
                                            <th scope="col">توضیحات</th>
                                            <th scope="col">در تحویل کیست؟</th>
                                            <th scope="col">در کدام شعبه است؟</th>
                                            <th scope="col">نوع کالا</th>
                                            <th scope="col">تعداد</th>
                                            <th scope="col">عملیات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php while($row = $results->fetch_assoc()): ?>


                                        <tr>
                                            <td><?php echo $row['id']; ?></td>
                                            <td>
                                                <?php
                                                $image = $row['image'];
                                                echo "<img width='300px' height='300px' src='../img/$image'>"

                                                ?>

                                            </td>
                                            <td><?php echo $row['code'];?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['Description'];?></td>
                                            <td>
                                                <?php $results2=$mysqli->query("SELECT * FROM users")or die($mysqli->error);?>

                                                <?php while($row2 = $results2->fetch_assoc()):
                                                    if($row['user_id']==$row2['id'])
                                                    {
                                                         $user= $row2['first_name'].' '.$row2['last_name'];
                                                         echo "$user";

                                                    }

                                                endwhile;
                                                if($row['user_id']==0)
                                                {
                                                    echo "مسئول مورد نظر انتخاب نشده است ";
                                                }

                                                    ?></td>


                                            <td>
                                                <?php
                                                $results3=$mysqli->query("SELECT * FROM branches")or die($mysqli->error); ?>
                                                <?php  while($row3 = $results3->fetch_assoc()):

                                                    if($row['branch_id']==$row3['id'])
                                                    {
//                                                        print_r($row['branch_id']);
//                                                        print_r("//////////////////");
//                                                        print_r($row3['id']);
                                                        $branch= $row3['branch_name'];
                                                        echo "$branch";

                                                    }
                                                endwhile;
                                                if($row['branch_id']==0)
                                                {
                                                    echo "شعبه مورد نظر انتخاب نشده است ";
                                                }

                                                    ?></td>
                                            <td><?php if ($row['category']==1) echo 'تبلیغاتی'; elseif($row['category']==2) echo 'اموال'; elseif($row['category']==0) echo 'نوع کالا مورد نظر مشخص نشده است '?></td>
                                            <td><?php echo $row['numbers']; ?></td>
                                            <td>
                                                <a href="edit.php?edit=<?php echo $row['id']; ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                <a href="create_report.php?report=<?php echo $row['id']; ?>" class="btn btn-success"><i class="fa fa-file"></i></a>
                                                <a href="reports.php?reports=<?php echo $row['id']; ?>" class="btn btn-success">گزارشات مربوطه</a>

                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                        </tbody>
                                    </table>


                                <!--Content of the Page Ends-->
                                </div>    
                            </div>
                        </div>
                    </div>
                </div> 
                <br />
                <?php include '../sections/footer.php'; ?>
                <script>
                    function myFunction() {
                        // Declare variables
                        var input, filter, table, tr, td, i, txtValue;
                        input = document.getElementById("myInput");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("myTable");
                        tr = table.getElementsByTagName("tr");

                        // Loop through all table rows, and hide those who don't match the search query
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[4];
                            if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }
                </script>
                <script>
                    function myfunction() {
                        // Declare variables
                        var input, filter, table, tr, td, i, txtValue;
                        input = document.getElementById("myInput-second");
                        filter = input.value.toUpperCase();
                        table = document.getElementById("myTable");
                        tr = table.getElementsByTagName("tr");

                        // Loop through all table rows, and hide those who don't match the search query
                        for (i = 0; i < tr.length; i++) {
                            td = tr[i].getElementsByTagName("td")[3];
                            if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                            }
                        }
                    }

                </script>
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