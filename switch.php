<?php
// ボタンを押した時にdbの状態が「災害」なら通常、「通常」なら災害に切り替える
if(isset($_POST['switch_push'])){
    header("Location:board_home.php");
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>switch</title>
  <!-- tailwind css -->
  <link href="./css/output.css" rel="stylesheet">
</head>

<body>
  <main>
    <div class="flex justify-center items-center h-screen">
      <div class="relative">
        <img src="./images/switch.png" alt="災害時画面切り替えボタン" class="z-0">
        <form action="" method="post">
          <button type="submit" name="switch_push" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10 w-28 h-28 rounded-full"></button>
        </form>
      </div>
    </div>
  </main>
</body>

</html>