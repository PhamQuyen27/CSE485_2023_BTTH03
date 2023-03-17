<?php
include "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
include "../vendor/phpmailer/phpmailer/src/Exception.php";
include "../vendor/phpmailer/phpmailer/src/POP3.php";
include "../vendor/phpmailer/phpmailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

interface EmailServerInterface {
	public function sendEmail($to, $subject, $message);
}

class EmailSender {
    private $emailServer;

    public function __construct(EmailServerInterface $emailServer) {
        $this->emailServer = $emailServer;
    }

    public function send($to, $subject, $message) {
        $this->emailServer->sendEmail($to, $subject, $message);
    }
}

class GmailEmailServer implements EmailServerInterface {
    private $username;
    private $password;
    
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function sendEmail($to, $subject, $message) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = $this->username; //email của bạn                    
            $mail->Password   = $this->password; // password của bạn             
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                                    

            //Recipients
            $mail->setFrom($this->username, 'Mailer');
            $mail->addAddress($to);              

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $user   = $_POST['username'];
            $mail   = $_POST['email'];
            $pass1  = $_POST['password'];
            $pass2  = $_POST['password2'];
            if($pass1 != $pass2){
                echo "<p style='color:red'>Mật khẩu không khớp</p>";
                // header("Location:register.php");
            }else{
                // Kiểm tra Tài khoản nó đã TỒN TẠI CHƯA
                try{
                    $conn = mysqli_connect('localhost','root','','member');
                }catch(Exception $e){
                    echo $e->getMessage();
                }
                $select_sql = "SELECT * FROM users WHERE username = '$user' OR email='$mail'";
                $result_sql = mysqli_query($conn,$select_sql);
                if(mysqli_num_rows($result_sql) > 0){
                    echo "<p style='color:red'>Tên đăng nhập hoặc Email đã được sử dụng</p>";
                }else{
                    // Lưu lại bản đăng kí vào CSDL
                    $pass_hash = password_hash($pass1, PASSWORD_DEFAULT);
                    $code_hash = md5(random_bytes(20));
                    $insert_sql = "INSERT INTO users (username, email, password, activation_code)
                    VALUES ('$user', '$mail', '$pass_hash', '$code_hash')";
                    if(mysqli_query($conn,$insert_sql)){
                        echo "<p style='color:green'>Đăng kí thành công, vui lòng check Email để kích hoạt tài khoản</p>";
                        // Gửi Email chứa liên kết để kích hoạt
                        // Kích hoạt là gì?
                        // $to = $mail;
                        $subject = 'Kich hoat tai khoan cua ban';
                        $message = 'Chào ' . $user . ',<br><br>';
                        $message .= 'Cám ơn bạn đã đăng ký tài khoản. Vui lòng kích hoạt tài khoản của bạn bằng cách nhấp vào đường link dưới đây:<br><br>';
                        $message .= 'http://localhost/BTTH/CSE485_2023_bttH03/BT01/activation.php?user=' . $user . '&code=' . $code_hash;
                        // $message .= 'Đội ngũ hỗ trợ của chúng tôi';
                    
                        // // Đặt các header cho email
                        // $headers = 'From: noreply@example.com' . "\r\n" .
                        //     'Reply-To: noreply@example.com' . "\r\n" .
                        //     'Content-type: text/html; charset=UTF-8' . "\r\n" .
                        //     'X-Mailer: PHP/' . phpversion();
                    
                        // // Gửi email
                        // mail($to, $subject, $message, $headers);
                        $emailServer = new GmailEmailServer('quyenpham27122002@gmail.com', 'tpcwzqztgaqrayto');
                        $emailSender = new EmailSender($emailServer);
                        $emailSender->send($mail, $subject,$message);
                    }

                    
                }
            }
        }
    ?>
    <main>
        <form action="register.php" method="POST">
            <h2>Đăng ký</h2>
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>

            <label for="password">Nhập lại mật khẩu:</label>
            <input type="password" name="password2" id="password2" required>

            <label for="email">Địa chỉ email:</label>
            <input type="email" name="email" id="email" required>

            <input type="submit" value="Đăng ký">
        </form>
    </main>
</body>
</html>