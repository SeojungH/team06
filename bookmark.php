<!-- 1976180 백승민 -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Preview</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      html, body {
        display: block;
        flex-direction: column;
        flex: 1;
        width: 100%;
        height: 100%;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
      }
    </style>
  </head>
  <body>
    <div class="w-[1533px] h-[1795px] relative overflow-hidden bg-white">
      <div class="flex flex-col justify-center items-center absolute left-[31px] top-[477px] gap-[88px]">
        <p class="flex-grow-0 flex-shrink-0 text-[43px] font-bold text-center text-[#212121]">
          찜 리스트
        </p>
        <div class="flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 gap-16">

        <?php
                // 사용자가 Bookmark 한 Restaurant 정보와 Bookmark 총 개수 가져오기

                //세션 가져오기
                session_name('로그인');
                session_start();

                #$userID = $_GET['user_id']; // 사용자의 User_ID
                #$userID = 1; // 사용자의 User_ID
                $user_ID = $_SESSION["SESSION_User_ID"];
                $user_name = $_SESSION["SESSION_User_name"];
                #$user_name = '승민';
                $counter = 0; // row 구분 counter


                // MySQL 데이터베이스 연결 설정
                $servername = "localhost";
                $username = "team06";
                $password = "team06";
                $dbname = "team06";

                // 데이터베이스 연결
                $conn = new mysqli($servername, $username, $password, $dbname);

                // 데이터베이스 연결 확인
                if ($conn->connect_error) {
                    die("데이터베이스 연결 실패: " . $conn->connect_error);
                }

                $itemsPerPage = 8;
                $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

                // Bookmark 한 식당 정보 가져오기
                $bookmarkQuery = "SELECT *
                                FROM Restaurant R
                                LEFT JOIN Bookmark B ON R.Res_ID = B.Res_ID
                                WHERE B.User_ID = '$user_ID'
                                GROUP BY R.Res_ID
                                LIMIT $offset, $itemsPerPage";
                $bookmarkResult = $conn->query($bookmarkQuery);

                while ($row = $bookmarkResult->fetch_assoc()) {
                    // 식당의 북마크 총합
                    $query = "SELECT COUNT(B.User_ID) AS bookmark_count
                            FROM Bookmark B
                            JOIN Restaurant R ON B.Res_ID = R.Res_ID
                            WHERE B.Res_ID = '{$row['Res_ID']}'
                            GROUP BY B.Res_ID;";

                    $result = $conn->query($query);
                    $row_2 = $result->fetch_assoc();

                    if ($counter % 4 == 0){
                        echo "<div class='flex justify-start items-start flex-grow-0 flex-shrink-0 gap-4'>";
                    }

                    echo "<div class='flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative overflow-hidden gap-6 rounded-2xl'>
                    <div class='flex-grow-0 flex-shrink-0 w-[357px] h-[301px] relative overflow-hidden rounded-2xl bg-white'>";

            echo '<a href="res_detail.php?Res_ID=' . $row["Res_ID"] . '">';
            echo "<img src='{$row['Res_img_url']}' class='w-[357px] h-[301px] absolute left-[-1px] top-[-1px] object-cover' />";
            echo '</a>';
                      echo"<div class='flex justify-start items-start absolute left-6 top-6 gap-2'>
                        <div class='flex justify-start items-center flex-grow-0 flex-shrink-0 relative gap-2.5 px-4 py-2 rounded-lg bg-[#f17228]'>
                          <p class='flex-grow-0 flex-shrink-0 text-lg text-left text-white'>bookmark</p>
                          <p class='flex-grow-0 flex-shrink-0 text-[22px] font-bold text-left text-white'>"
                          . $row_2["bookmark_count"] .
                          "</p>
                        </div>
                        
                      </div>
                    </div>
                    <div class='flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 gap-8'>
                      <div class='flex justify-start items-center flex-grow-0 flex-shrink-0 relative gap-6'>
                        <div class='flex-grow-0 flex-shrink-0 w-16 h-16 relative'>";
                          if ($row['Category_ID'] == 1){
                            echo "<img src='./img/분식.png' class='w-16 h-16 absolute left-[-1px] top-[-1px] object-cover' />";
                          }
                          else if ($row['Category_ID'] == 2){
                            echo "<img src='./img/중식.png' class='w-16 h-16 absolute left-[-1px] top-[-1px] object-cover' />";
                          }
                          else if ($row['Category_ID'] == 3){
                            echo "<img src='./img/pasta.png' class='w-16 h-16 absolute left-[-1px] top-[-1px] object-cover' />";
                          }
                          else if ($row['Category_ID'] == 4){
                            echo "<img src='./img/한식.png' class='w-16 h-16 absolute left-[-1px] top-[-1px] object-cover' />";
                          }
                          else if ($row['Category_ID'] == 5){
                            echo "<img src='./img/일식.png' class='w-16 h-16 absolute left-[-1px] top-[-1px] object-cover' />";
                          }
                          else if ($row['Category_ID'] == 6){
                            echo "<img src='./img/pizza.png' class='w-16 h-16 absolute left-[-1px] top-[-1px] object-cover' />";
                          }
                          else if ($row['Category_ID'] == 7){
                            echo "<img src='./img/image-4.png' class='w-16 h-16 absolute left-[-1px] top-[-1px] object-cover' />";
                          }

                        echo"</div>
                        <div class='flex flex-col justify-start items-start flex-grow-0 flex-shrink-0 relative gap-1'>
                          <p class='flex-grow-0 flex-shrink-0 text-[22px] font-bold text-left text-[#424242]'>{$row['Res_name']}</p>
                          <div class='flex justify-start items-start flex-grow-0 flex-shrink-0 relative gap-2'>
                            <p class='flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]'>Star</p>
                            <p class='flex-grow-0 flex-shrink-0 text-[22px] text-left text-[#ffb30e]'>{$row_2['bookmark_count']}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>";  

            $counter++;

            if ($counter % 4 == 0){
                echo "</div>";
            }

          }
          // 다음 페이지로 이동하는 링크 추가
          echo "<a href='?offset=" . ($offset + $itemsPerPage) . "'>
          <div class='flex justify-center items-center flex-grow-0 flex-shrink-0 relative gap-2.5 px-12 py-[21px] rounded-[14px]'
          style='background: linear-gradient(140.56deg, #ffba26 -14.76%, #ff9a0e 114.07%); box-shadow: 0px 5px 10px 0 rgba(255,174,0,0.26), 0px 20px 40px 0 rgba(255,174,0,0.29);'>
                <p class='flex-grow-0 flex-shrink-0 text-lg font-bold text-center text-white'>View</p>
          </div>
          </a>";
          $conn->close();
      ?>
  </div>
  </div>
  <!-- <div
    class="flex justify-center items-center flex-grow-0 flex-shrink-0 relative gap-2.5 px-12 py-[21px] rounded-[14px]"
    style="background: linear-gradient(140.56deg, #ffba26 -14.76%, #ff9a0e 114.07%); box-shadow: 0px 5px 10px 0 rgba(255,174,0,0.26), 0px 20px 40px 0 rgba(255,174,0,0.29);"
  >
    <p class="flex-grow-0 flex-shrink-0 text-lg font-bold text-center text-white">View </p>
  </div> -->
</div>
<div class="w-[1546px] h-[350px] absolute left-[-1px] top-[70px] bg-[#d9d9d9]"></div>
<!-- 네비게이션 바 -->
<div class="w-[1718px] h-[76px]">
        <div class="w-[1718px] h-[76px] absolute left-[-0.5px] top-[-0.5px] bg-[#ffd233]"></div>
        <div class="w-[841.1px] h-[53.2px]">
          <div  onclick = "location.href='mainpage.php'">
          <p
            class="w-[95.44px] h-[28.5px] absolute left-[443.82px] top-[22.8px] text-[22px] text-left text-[#a0a0a0]"
          >
            Main
          </p>
          </div>
          <div onclick = "location.href='Mypage.php'">
          <p
            class="w-[96.64px] h-[28.5px] absolute left-[660.95px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
          Mypage
          </p>
          </div>
          <div onclick = "location.href='bookmark.php'">
          <p
            class="w-[95.44px] h-[28.5px] absolute left-[876.9px] top-[22.8px] text-[22px] font-light text-left text-white"
          >
          Bookmark
          </p>
          </div>

          <div onclick = "location.href='Logout.php'">
          <p
            class="w-[181.34px] h-[28.5px] absolute left-[1091.65px] top-[22.8px] text-[22px] font-light text-left text-[#a0a0a0]"
          >
           Logout
          </p>
          </div>
        </div>
      </div>
<div class="w-[200px] h-[271px]">
  
  <p class="w-[142px] absolute left-[706px] top-[325px] text-5xl italic text-left text-black">
      <?php echo $user_name; ?>
  </p>

  </div>
    </div>
  </body>
</html>
