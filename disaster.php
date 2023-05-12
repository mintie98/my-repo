<?php
// true災害
$a = false;

// 送信ボタンが押された時かつ、災害時の時
if (isset($_POST['submit'])) {
  if ($a) {
    $state = $_POST['state'];
  }
  $condition = $_POST['condition'];
  $comment = $_POST['comment'];

  exit;
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- tailwind css -->
  <link href="./css/output.css" rel="stylesheet">
  <!-- icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-back-color">
  <header>
    <?php
    // if ($a) {
    //   include 'navbar_admin.php';
    // } else {
    //   include 'navbar_user.php';
    // }
    ?>
  </header>
  <main>
    <div class="container mx-auto">
      <div class="flex-row justify-center">
        <form action="" method="post">
          <?php
          if ($a) {
          ?>
            <!-- 災害時 -->
            <div class="flex-row justify-center border bg-white m-5 rounded-lg p-5">
              <h1 class="text-center pb-3 text-3xl">今の体調<br>(１つ選択)</h1>

              <div class="flex justify-center">
                <div class="inline-block mx-2">
                  <input type="radio" id="safe" name="state" value="無事" class="hidden peer" required>
                  <label for="safe" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-green-600 peer-checked:bg-green-600 peer-checked:text-white hover:bg-green-100">無事</label>
                </div>
                <div class="inline-block mx-2">
                  <input type="radio" id="mild" name="state" value="軽症" class="hidden peer">
                  <label for="mild" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-yellow-600 peer-checked:bg-yellow-400 peer-checked:text-black hover:bg-yellow-100 ">軽症</label>
                </div>
                <div class="inline-block mx-2">
                  <input type="radio" id="serious" name="state" value="重症" class="hidden peer">
                  <label for="serious" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white hover:bg-red-100 ">重症</label>
                </div>
              </div>
            </div>

            <div class="flex-row justify-center border bg-white m-5 rounded-lg p-5">
              <h1 class="text-center pb-3 text-3xl">外傷の有無<br>(１つ選択)</h1>
              <div class="flex justify-center">
                <div class="inline-block mx-2">
                  <input type="radio" id="safe" name="condition" value="元気" class="hidden peer" required>
                  <label for="safe" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-green-600 peer-checked:bg-green-600 peer-checked:text-white hover:bg-green-100">元気</label>
                </div>
                <div class="inline-block mx-2">
                  <input type="radio" id="mild" name="condition" value="普通" class="hidden peer">
                  <label for="mild" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-yellow-600 peer-checked:bg-yellow-400 peer-checked:text-black hover:bg-yellow-100 ">普通</label>
                </div>
                <div class="inline-block mx-2">
                  <input type="radio" id="serious" name="condition" value="不調" class="hidden peer">
                  <label for="serious" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white hover:bg-red-100 ">不調</label>
                </div>
              </div>
            </div>

            <div class="flex flex-col justify-center border bg-white m-5 rounded-lg p-5 text-center">
              <label for="comment" class="text-3xl mb-2">伝えたいこと</label>
              <textarea name="comment" id="comment" cols="30" rows="4" class="p-2 mt-3 border-2 border-black resize-none"></textarea>
            </div>
          <?php
          } else {
          ?>
            <!-- 平常時 -->
            <div class="flex-row justify-center border bg-white m-5 rounded-lg p-5">
              <h1 class="text-center pb-3 text-3xl">今の状態<br>(１つ選択)</h1>

              <div class="flex justify-center">
                <div class="inline-block mx-2">
                  <input type="radio" id="safe" name="condition" value="元気" class="hidden peer" required>
                  <label for="safe" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-green-600 peer-checked:bg-green-600 peer-checked:text-white hover:bg-green-100">元気</label>
                </div>
                <div class="inline-block mx-2">
                  <input type="radio" id="mild" name="condition" value="普通" class="hidden peer">
                  <label for="mild" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-yellow-600 peer-checked:bg-yellow-400 peer-checked:text-black hover:bg-yellow-100 ">普通</label>
                </div>
                <div class="inline-block mx-2">
                  <input type="radio" id="serious" name="condition" value="不調" class="hidden peer">
                  <label for="serious" class="inline-flex items-center justify-between w-full p-5 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-red-600 peer-checked:bg-red-600 peer-checked:text-white hover:bg-red-100 ">不調</label>
                </div>
              </div>

            </div>

            <div class="flex flex-col justify-center border bg-white m-5 rounded-lg p-5 text-center">
              <label for="comment" class="text-3xl mb-2">伝えたいこと</label>
              <textarea name="comment" id="comment" cols="30" rows="4" class="p-2 mt-3 border-2 border-black resize-none"></textarea>
            </div>
          <?php
          }
          ?>
          <!-- 送信ボタン -->
          <div class="flex justify-center <!--end mr-5-->">
            <button type="submit" name="submit" class="w-40 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded-3xl">送信</button>
          </div>
        </form>
      </div>
    </div>
  </main>
  <!-- footer -->
  <?php
  // include 'footer.php';
  ?>
  <script src="./js/navbar.js"></script>
</body>

</html>