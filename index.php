

<html lang="en" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Document</title>
</head>
<body>
  
  <form action="#" method="GET">
    <div class="form-group">
      <button id="show" type="submit" class="btn btn-primary">نمایش تمام دانشجویان</button>
    </div>
  </form>

  <div class="students">پس از کلیک بر روی دگمه‌ی نمایش افراد را بر روی کنسول کروم مشاهده کنید</div>

  <br>
  <br>

  <form action="#" method="POST">
    <div class="form-group">
      <input type="text" name="name" class="form-control"   placeholder="نام">
    </div>
    <div class="form-group">
      <input type="text" name="lastName" class="form-control"  placeholder="نام خانوادگی">
    </div>
    <div class="form-group">
      <input type="number" name="id" class="form-control"   placeholder="شماره دانشجویی">
    </div>
    <button type="submit" name="addstudent" class="btn btn-primary">اضافه کردن داشنجو</button>
  </form>
  <br>
  <br>
  <br>
  <br>
  <br>
  <form action="#" method="POST">
    <div class="form-group">
      <input type="text" name="lessons" class="form-control"  placeholder="نام درس">
    </div>
    <div class="form-group">
      <input type="text" name="sensei" class="form-control"  placeholder="نام استاد">
    </div>
    <div class="form-group">
      <input type="text" name="date" class="form-control"  placeholder="تاریخ برگزاری">
    </div>
    <div class="form-group">
      <input type="number" name="unit" class="form-control"  placeholder="واحد درسی">
    </div>
    <button type="submit" name="addlesson" class="btn btn-primary">اضافه کردن درس جدید</button>
  </form>

  <form action="" method="POST">
    <div class="form-group">
      <input type="text" name="stdName" class="form-control"  placeholder="نام دانشجو">
    </div>
    <div class="form-group">
      <input type="text" name="id" class="form-control"  placeholder="شماره دانشجویی">
    </div>
    <button type="submit" name="knowlessons" class="btn btn-primary">برای مشاهده‌ی دروس دانشجو کلیک کنید</button>
  </form>

  <form action="#" method="POST">
    <div class="form-group">
      <input type="text" name="stdName" class="form-control"  placeholder="نام دانشجو">
    </div>
    <div class="form-group">
      <input type="text" name="id" class="form-control"  placeholder="شماره دانشجویی">
    </div>
    </div>
    <div class="form-group">
      <input type="text" name="lessonName" class="form-control"  placeholder="نام درس">
    </div>
    <button type="submit" name="lessonforstd" class="btn btn-primary">اضافه کردن درس به دروس یک دانشجو</button>
  </form>

  <form action="#" method="POST">
    <div class="form-group">
      <input type="text" name="lessonName" class="form-control"  placeholder="نام درس">
    </div>
    <button type="submit" name="average" class="btn btn-primary">معدل درس</button>
  </form>

  <?php
              
  if(isset($_POST['addstudent']))
  {

  $name=$_POST['name'];
  $lastName=$_POST['lastName'];
  $id=$_POST['id'];
  $fp = fopen('students.txt', 'a');
  fwrite($fp, "$name, $lastName, $id");
  fclose($fp);
  
  }

  if(isset($_POST['addlesson']))
  {

    $lessons = $_POST['lessons'];
    $sensei = $_POST['sensei'];
    $date = $_POST['date'];
    $unit = $_POST['unit'];
    $lessonFp = fopen('lessons.txt', 'a');
    fwrite($lessonFp, "\n$lessons, $sensei, $date, $unit");
    fclose($lessonFp);

  }

  if(isset($_POST["knowlessons"])){

    $stdName = $_POST['stdName'];
    $id = $_POST['id'];
    $file = "stdles.txt";

    $contents = file_get_contents($file);
    // escape special characters in the query
    $pattern = preg_quote($id, ',');
    // finalise the regular expression, matching the whole line
    $pattern = "/^.*$pattern.*\$/m";
    // search, and store all matching occurences in $matches
    if(preg_match_all($pattern, $contents, $matches)){
      echo "دروس دانشجو مدنظر:\n";
      echo "<h1>". implode("\n", $matches[0]). "</h1>";
    }
    else{
       echo "دانشجویی یافت نشد";
    }
    
    
  }

  if(isset($_POST["lessonforstd"])){
    
    $stdName = $_POST['stdName'];
    $id = $_POST['id'];
    $lessonName = $_POST['lessonName'];
    $fp2 = fopen("stdles.txt", "a");
    fwrite($fp2, "\n$id, $lessonName") ;
    fclose($fp2);

  }

  if(isset($_POST['average'])){
    
    $lessonName = $_POST['lessonName'];
    $file = "score.txt";
    
    
    $contents = file_get_contents($file);
    // escape special characters in the query
    $pattern = preg_quote($lessonName, '/');
    // finalise the regular expression, matching the whole line
    $pattern = "/^.*$pattern.*\$/m";
    // search, and store all matching occurences in $matches
    if(preg_match_all($pattern, $contents, $matches)){
      $data = implode("\n", $matches[0]);
      $exploded = explode(",", $data);
      $exploded = array_combine(range(1, count($exploded)), $exploded);
      $s = 0;
      foreach($exploded as $val => $key){
        if($val%3==0){
            $s += $key;
        }
      }
      echo $s/((count($exploded)-1)/3);
      // print_r($exploded);
    }
  }

?>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
  $.ajax({url: 'file.php', success: (res) => {
    $('#show').click(() => {
      console.log(res)
    })
  }})

  if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>