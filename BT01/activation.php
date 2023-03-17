<?php
        if(isset($_GET['user']) && isset($_GET['code'])){
            $user = $_GET['user'];
            $code = $_GET['code'];
                // Kiểm tra Mật khẩu có khớp ko
       
            // Kiểm tra Tài khoản nó đã TỒN TẠI CHƯA
            try{
                $conn = mysqli_connect('localhost','root','','member');
            }catch(Exception $e){
                echo $e->getMessage();
            }
            $select_sql = "SELECT * FROM users WHERE username = '$user' AND  activation_code='$code'";
            $result_sql = mysqli_query($conn,$select_sql);
            if(mysqli_num_rows($result_sql) > 0){
                $update_sql = "UPDATE users SET is_activated=1 WHERE username='$user'";
                if(mysqli_query($conn,$update_sql)){
                    echo "<p style='color:green'>Tài khoản được kích hoạt thành công</p>";
                }else{
                    echo "<p style='color:red'>Liên kết không hợp lệ</p>";
                }
            }else{

                    echo "<p style='color:red'>Liên kết không hợp lệ</p>";
                }

                
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>