<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcı Bilgi Formu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            font-weight: bold;
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    
    <h2>Kullanıcı Bilgi Formu</h2>
    <form id="userForm" action="" method="post">
        <label for="fname">İsim:</label><br>
        <input type="text" id="fname" name="fname" required><br>

        <label for="lname">Soyisim:</label><br>
        <input type="text" id="lname" name="lname" required><br>

        <label for="email">E-posta:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Şifre:</label><br>
        <input type="password" id="password" name="password" required><br>
        <span id="passwordError" class="error"></span><br>

        <label for="birthdate">Doğum Tarihi:</label><br><br>
        <input type="date" id="birthdate" name="birthdate" required><br>

        <label for="gender">Cinsiyet:</label><br>
        <select id="gender" name="gender" style="width: 393px; height: 30px;">
            <option value="">Seçiniz</option>
            <option value="Erkek">Erkek</option>
            <option value="Kadın">Kadın</option>
            <option value="Diğer">Diğer</option>
        </select><br>

        <input type="submit" name="submit" value="Gönder">
    </form>
    <a href="users.php"><input type="submit" value="Kullanıcıları Listele"></a>

    <?php
    include 'db_baglan.php';

    if(isset($_POST['submit'])){
        // Sorguyu hazırlayalım
        $SORGU = $DB->prepare("INSERT INTO users(Name, Surname, BirthDate, EMail,Gender, Password)
        VALUES (:Name,:Surname,:Birthdate, :Email,:Gender, :Password)");
        $SORGU->bindParam(":Name", $_POST["fname"]);
        $SORGU->bindParam(":Surname",  $_POST["lname"]);
        $SORGU->bindParam(":Birthdate",    $_POST["birthdate"]);
        $SORGU->bindParam(":Email",    $_POST["email"]);
        $SORGU->bindParam(":Password",    $_POST["password"]);
        $SORGU->bindParam(":Gender",    $_POST["gender"]);
        // SQL Sorgumuzu çalıştıralım
        $SORGU->execute();
        
        die();
    }
?>


    <script>
        const form = document.getElementById('userForm');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        form.addEventListener('submit', function(event) {
            if (!isValidEmail(emailInput.value)) {
                emailError.textContent = 'Geçerli bir e-posta adresi giriniz.';
                event.preventDefault();
            } else {
                emailError.textContent = '';
            }
        });
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');

        form.addEventListener('submit', function(event) {
            if (passwordInput.value.length < 6) {
                passwordError.textContent = 'Şifre en az 6 karakter olmalıdır.';
                event.preventDefault();
            } else {
                passwordError.textContent = '';
            }
        });

    </script>
</body>
</html>