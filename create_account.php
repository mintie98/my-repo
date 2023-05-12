<?php
// データを保存
// require_once "define.php";
require_once dirname(__FILE__) . '/function/db_connection.php';
session_start();
$_SESSION["error"] = "";
$message = "";

// データベースに接続
  $connection = connection();
//ユーザー画面
// フォームの送信を待機する  
if (isset($_POST['user_submit'])) {
  // 入力されたデータを処理する
  $user_id = $_POST["user_id"];
  $user_name = $_POST["user_name"];
  $user_gender = $_POST["user_gender"];
  $user_tel = $_POST["user_tel"];
  $user_address = $_POST["user_address"];
  $user_mail = $_POST["user_mail"];
  $user_mgr = $_POST["user_mgr"];
  $user_password = $_POST["user_password"];
  $user_password_conf = $_POST["user_password_conf"];


  // Password Check
  if ($user_password != $user_password_conf) {
    $message = "パスワードが一致しません。もう一度入力してください。";
    //exit;
  } else {
    // データベースに同じID or emailが存在しないことを確認する
    $stmt = $connection->prepare("SELECT COUNT(*) FROM user WHERE user_id = ? OR user_mail = ?");
    $stmt->execute([$user_id, $user_mail]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
      $message = "<div class='alert alert-warning'>ユーザーIDまたはメールアドレスが既に使用されています。別のユーザーIDまたはメールアドレスを使用してください。</div>";
    } else {
      // Hash password
      $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
      
    
        // $connection->beginTransaction();
        // データベースにユーザー情報を登録する
        $stmt = $connection->prepare("INSERT INTO user (USER_ID, USER_NAME,USER_GENDER, USER_PASS, USER_TEL,USER_MAIL, USER_ADDRESS,USER_MGR) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->execute([$user_id, $user_name, $user_gender, $hashed_password, $user_tel, $user_mail,$user_address, $user_mgr]);
        $connection->commit();
        // 登録が完了したら、ログインページにリダイレクトする
        header("Location: login.php");
        exit;
    }
  }
}
//職員画面
if (isset($_POST['emp_submit'])) {
  // 入力されたデータを処理する
  $emp_id = $_POST["emp_id"];
  $emp_name = $_POST["emp_name"];
  $emp_gender = $_POST["emp_gender"];
  $emp_tel = $_POST["emp_tel"];
  $emp_address = $_POST["emp_address"];
  $emp_mail = $_POST["emp_mail"];
  //$emp_mgr = $_POST["emp_mgr"];
  $emp_password = $_POST["emp_password"];
  $emp_password_conf = $_POST["emp_password_conf"];

  // Password Check
  if ($emp_password != $emp_password_conf) {
    $message = "パスワードが一致しません。もう一度入力してください。";
    //exit;
  } else {
    // データベースに同じID or emailが存在しないことを確認する
    $stmt = $connection->prepare("SELECT COUNT(*) FROM employee WHERE emp_id = ? OR emp_mail = ?");
    $stmt->execute([$emp_id, $emp_mail]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
      $message = "<div class='alert alert-warning'>ユーザーIDまたはメールアドレスが既に使用されています。別のユーザーIDまたはメールアドレスを使用してください。</div>";
    } else {
      // Hash password
      $hashed_password = password_hash($emp_password, PASSWORD_DEFAULT);
      
    
        // $db->beginTransaction();
        // データベースにユーザー情報を登録する
        // try{
        $stmt = $connection->prepare("INSERT INTO employee (EMP_ID, EMP_NAME,EMP_GENDER, EMP_PASS, EMP_TEL,EMP_MAIL, EMP_ADDRESS) VALUES (?,?,?,?,?,?,?)");
        $stmt->execute([$emp_id, $emp_name, $emp_gender, $hashed_password, $emp_tel, $emp_mail,$emp_address]);
        $connection->commit();
        // 登録が完了したら、ログインページにリダイレクトする
        header("Location: login.php");
        exit;
    }
  }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>災害用掲示板</title>
  <!-- tailwind -->
  <link href="./css/output.css" rel="stylesheet" />
  <!-- icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100">
  <!-- header -->
  <header></header>
  <!-- main-->
  <main>
    <div class="flex flex-wrap" id="tabs-id">
      <div class="w-full">
        <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-white bg-blue-600" onclick="change_create(event,'user')">ユーザー</a>
          </li>
          <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
            <a class="text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal text-blue-600 bg-white" onclick="change_create(event,'emp')">職員</a>
          </li>
        </ul>

        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded">
          <div class="px-4 py-5 flex-auto">
            <?= $message ?>
            <div class="tab-content">
              <div class="block" id="user">
                <div class="flex-row justify-center">
                  <h1 class="text-center my-4 mx-auto">ユーザーアカウント作成</h1>
                  <form action="" method="post">
                    <!-- id -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="number" name="user_id" id="user_id" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_id" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">ID</label>
                    </div>
                    <!-- name -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="text" name="user_name" id="user_name" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">名前</label>
                    </div>
                    <!-- 性別 -->
                    <div class="flex flex-wrap border bg-white m-5 rounded-lg p-5">
                      <div class="flex items-center">性別</div>
                      <div class="flex flex-row justify-center pl-6">
                        <div class="inline-block mx-2">
                          <input type="radio" id="user_female" name="user_gender" value="女性" class="hidden peer" required />
                          <label for="user_female" class="inline-flex items-center justify-between w-full px-5 py-3 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-black peer-checked:bg-black peer-checked:text-white">女性</label>
                        </div>
                        <div class="inline-block mx-2">
                          <input type="radio" id="user_male" name="user_gender" value="男性" class="hidden peer" />
                          <label for="user_male" class="inline-flex items-center justify-between w-full px-5 py-3 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-black peer-checked:bg-black peer-checked:text-white">男性</label>
                        </div>
                      </div>
                    </div>
                    <!-- tel -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="tel" name="user_tel" id="user_tel" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_tel" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">電話番号</label>
                    </div>
                    <!-- mail -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="email" name="user_mail" id="user_mail" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_mail" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">メールアドレス</label>
                    </div>
                    <!-- address -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="text" name="user_address" id="user_address" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_address" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">住所</label>
                    </div>
                    <!-- mgr -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="text" name="user_mgr" id="user_mgr" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_mgr" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">担当職員ID</label>
                    </div>
                    <!-- password -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="password" name="user_password" id="user_password" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">パスワード</label>
                    </div>
                    <!-- password_conf -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="password" name="user_password_conf" id="user_password_conf" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="user_password_conf" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">パスワード確認</label>
                    </div>
                    <!-- 送信ボタン -->
                    <div class="flex justify-center">
                      <button type="submit" name="user_submit" class="w-40 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">登録</button>
                    </div>
                  </form>
                </div>
              </div>

              <div class="hidden" id="emp">
                <div class="flex-row justify-center">
                  <h1 class="text-center my-4 mx-auto">職員アカウント作成</h1>
                  <form action="" method="post">
                    <!-- id -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="number" name="emp_id" id="emp_id" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="emp_id" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">ID</label>
                    </div>
                    <!-- name -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="text" name="emp_name" id="emp_name" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="emp_name" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">名前</label>
                    </div>
                    <!-- 性別 -->
                    <div class="flex flex-wrap border bg-white m-5 rounded-lg p-5">
                      <div class="flex items-center">性別</div>
                      <div class="flex flex-row justify-center pl-6">
                        <div class="inline-block mx-2">
                          <input type="radio" id="emp_female" name="emp_gender" value="女性" class="hidden peer" required />
                          <label for="emp_female" class="inline-flex items-center justify-between w-full px-5 py-3 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-black peer-checked:bg-black peer-checked:text-white">女性</label>
                        </div>
                        <div class="inline-block mx-2">
                          <input type="radio" id="emp_male" name="emp_gender" value="男性" class="hidden peer" />
                          <label for="emp_male" class="inline-flex items-center justify-between w-full px-5 py-3 text-black bg-white border border-gray-900 rounded-lg cursor-pointer peer-checked:border-black peer-checked:bg-black peer-checked:text-white">男性</label>
                        </div>
                      </div>
                    </div>
                    <!-- tel -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="tel" name="emp_tel" id="emp_tel" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="emp_tel" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">電話番号</label>
                    </div>
                    <!-- mail -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="email" name="emp_mail" id="emp_mail" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="emp_mail" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">メールアドレス</label>
                    </div>
                    <!-- address -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="text" name="emp_address" id="emp_address" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="emp_address" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">住所</label>
                    </div>
                    <!-- password -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="password" name="emp_password" id="emp_password" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="emp_password" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">パスワード</label>
                    </div>
                    <!-- password_conf -->
                    <div class="relative mb-5 m-5 md:w-3/4">
                      <input type="password" name="emp_password_conf" id="password_conf" class="block p-4 w-full h-16 text-lg text-black rounded-lg border-2 bg-white focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                      <label for="emp_password_conf" class="absolute text-sm text-gray-500 duration-300 transform -translate-y-2 scale-75 top-2 z-10 origin-[0] px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-2 left-1">パスワード確認</label>
                    </div>
                    <!-- 送信ボタン -->
                    <div class="flex justify-center">
                      <button type="submit" name="emp_submit" class="w-40 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">登録</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script type="text/javascript">
    function change_create(event, tabID) {
      let element = event.target;
      // 最初のaタグを取得
      while (element.nodeName !== "A") {
        element = element.parentNode;
      }
      // a要素の親の親要素を取得
      ulElement = element.parentNode.parentNode;
      // 取得した要素の中のliの中から全てのaタグを取得
      aElements = ulElement.querySelectorAll("li > a");
      // 取得したidの中の(tab-content)の下のdiv取得
      tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
      for (let i = 0; i < aElements.length; i++) {
        aElements[i].classList.remove("text-white", "bg-blue-600");
        aElements[i].classList.add("text-blue-600", "bg-white");
        tabContents[i].classList.add("hidden");
        tabContents[i].classList.remove("block");
      }
      element.classList.remove("text-blue-600", "bg-white");
      element.classList.add("text-white", "bg-blue-600");
      document.getElementById(tabID).classList.remove("hidden");
      document.getElementById(tabID).classList.add("block");
    }
  </script>
</body>

</html>