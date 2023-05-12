<?php
// 情報をデータベースに入れる
// setcookie('login_conf', date('Y-m-d H:i:s'));

// require_once dirname(__FILE__) . '/function/function.php';
$a = true; // 災害
$admin = false; // 管理者（ログイン時に追加したセッションを使用）
?>

<!DOCTYPE html>
<html lang="ja">
<!-- 会員の方はこちら -->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>掲示板</title>
  <!-- tailwind css -->
  <link href="./css/output.css" rel="stylesheet">
  <!-- css -->
  <link href="./css/my_style.css" rel="stylesheet">
  <!-- icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-back-color">
  <?php
  // include 'navbar_admin.php';
  ?>

  <main class="container mx-auto p-0">
    <!-- user nemu -->
    <div class="flex flex-wrap justify-center">
      <?php
      if ($admin) {
      ?>
        <div class="max-w-sm w-full">
          <!-- 状況の切り替え -->
          <div class="border border-gray-800 bg-red-500 rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./switch.php'">
            <div class="text-white text-3xl flex justify-center py-3">状況切り替え</div>
          </div>
          <!-- 災害時安否確認 -->
          <div class="border border-gray-800 bg-red-500 rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./all_info.php'">
            <div class="text-white text-3xl flex justify-center py-3">災害時安否確認</div>
          </div>
          <!-- 通常時体調確認 -->
          <div class="border border-gray-800 bg-white rounded-2xl flex flex-col justify-between leading-normal my-5">
            <div class="text-black text-3xl flex justify-center py-3">通常時体調確認</div>
          </div>
          <!-- ユーザー登録 -->
          <div class="border border-gray-800 bg-white rounded-2xl flex flex-col justify-between leading-normal my-5">
            <div class="text-black text-3xl flex justify-center py-3">ユーザー登録</div>
          </div>
        </div>
      <?php
      } elseif ($a) {
      ?>
        <!-- 1つ目 -->
        <div class="max-w-sm w-full m-5 mt-10" onclick="location.href='./disaster.php'">
          <div class="border border-gray-800 bg-white rounded-2xl  flex flex-col justify-between leading-normal">
            <div class="flex justify-end pt-2 pr-2">
              <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center"><span class="flex items-center"><i class="fa-solid fa-pen text-2xl" style="color: #fafafa;"></i></span></div>
            </div>
            <div class="text-gray-900 font-bold flex justify-center text-2xl">あんぴほうこく</div>
            <div class="text-gray-900 font-bold text-6xl flex justify-center pb-12">安否報告</div>
          </div>
        </div>

      <?php
      } else {
      ?>
        <!-- admin nemu -->
        <!-- 1つ目 -->
        <div class="max-w-sm w-full m-5 mt-10" onclick="location.href='./disaster.php'">
          <div class="border border-gray-800 bg-white rounded-2xl  flex flex-col justify-between leading-normal">
            <div class="flex justify-end pt-2 pr-2">
              <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center">
                <span class="flex items-center"><i class="fa-solid fa-pen text-2xl" style="color: #fafafa;"></i></span>
              </div>
            </div>
            <div class="text-gray-900 font-bold flex justify-center text-2xl">たいちょうほうこく</div>
            <div class="text-gray-900 font-bold text-6xl flex justify-center pb-12">体調報告</div>
          </div>
        </div>

      <?php
      }
      ?>
      <!-- (奇数調整)-->
      <!-- <div class="max-w-sm w-full m-5 flex-auto"></div> -->
    </div>
  </main>
  <?php
  // include 'footer.php';
  ?>
  <script src="./js/navbar.js"></script>
</body>

</html>