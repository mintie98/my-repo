<?php
// 情報をデータベースに入れる
// setcookie('login_conf', date('Y-m-d H:i:s'));

// require_once dirname(__FILE__) . '/function/function.php';
require_once dirname(__FILE__) . '/function/db_connection.php';
session_start();
$a = true; // 災害
$admin = false;
$emp = false; //職員　１～１００
//user １０１以上
$user_id = filter_input( INPUT_GET, "user_id");
if($user_id ==10000){
    $table ="admin";
    $id="admin_id";
     $admin = true; // 管理者（ログイン時に追加したセッションを使用）0のみ
}elseif($user_id>0 && $user_id<100){
  $emp = true; //職員　１～１００
  $table ="employee";
  $id="emp_id";
}else{
  $table ="user";
    $id="user_id";
}


// データベースに接続
$connection = connection();
//SQL作成
//IDによってsqlが変わる
$sql =  "SELECT * FROM {$table} WHERE {$id}= :user_id" ;
//SQLのプリペアードステートメントを実行
$stmt = $connection -> prepare($sql);
//$stmt->bindParam(":user_id",$user_id,PDO::PARAM_STR); //câu lệch để thay thế user_id =$user_id
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
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
<h2 style="text-align:center; color:red ; font-size : 30px"  >Check information</h2>
    <label style="">USER ID :    <?= $user[$id] ?></label><br>
  <?php
  // include 'navbar_admin.php';
  ?>

  <main class="container mx-auto p-0">
  <?php
      if ($admin) {
      ?>
  <h2 style="text-align:center; color:red ; font-size : 30px"  >ADMIN</h2>
      <?php }?>
  <div class="flex flex-wrap justify-center">
   
    <!-- user nemu -->
      <?php
      if ($admin) {
      ?>
       
      
        <div class="max-w-sm w-full">
          <!-- 状況の切り替え -->
          <div class="border border-gray-800 bg-red-500 rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./switch.php?user_id=<?= $user[$id] ?>'">
            <div class="text-white text-3xl flex justify-center py-3">状況切り替え</div>
          </div>
          <!-- 災害時安否確認 -->
          <div class="border border-gray-800 bg-red-500 rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./all_info.php?user_id=<?= $user[$id] ?>'">
            <div class="text-white text-3xl flex justify-center py-3">災害時安否確認</div>
          </div>
          <!-- 通常時体調確認 -->
          <div class="border border-gray-800 bg-white rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./all_info.php?user_id=<?= $user[$id] ?>'">
            <div class="text-black text-3xl flex justify-center py-3">通常時体調確認</div>
          </div>
          <!-- ユーザー登録 -->
          <div class="border border-gray-800 bg-white rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./create_account.php'">
            <div class="text-black text-3xl flex justify-center py-3">ユーザー登録</div>
          </div>
        </div>
      <?php
      } elseif ($emp) {
      ?>
        <div class="max-w-sm w-full">
          <!-- 災害時安否確認 -->
          <div class="border border-gray-800 bg-red-500 rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./all_info.php?user_id=<?= $user[$id] ?>'">
            <div class="text-white text-3xl flex justify-center py-3">災害時安否確認</div>
          </div>
          <!-- 通常時体調確認 -->
          <div class="border border-gray-800 bg-white rounded-2xl flex flex-col justify-between leading-normal my-5" onclick="location.href='./all_info.php?user_id=<?=$user[$id] ?>'">
            <div class="text-black text-3xl flex justify-center py-3">通常時体調確認</div>
          </div>
        </div>
      <?php
      } elseif ($a) {
      ?>
        <!-- 1つ目 -->
        <div class="max-w-sm w-full m-5 mt-10" onclick="location.href='./disaster.php?user_id=<?= $user['user_id'] ?>'">
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
        <div class="max-w-sm w-full m-5 mt-10" onclick="location.href='disaster.php?user_id= <?=$user[$id]?>'">
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