<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcılar</title>
    <style>
        /* Tablo Stilleri */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        /* Tablo Responsive Stilleri */
        @media screen and (max-width: 600px) {
            table {
                border: 0;
            }
            table thead {
                display: none;
            }
            table tr {
                border-bottom: 2px solid #ddd;
                display: block;
                margin-bottom: 20px;
            }
            table td {
                display: block;
                text-align: right;
                border-bottom: 1px solid #ddd;
            }
            table td:before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
            }
        }
    </style>
</head>

<?php
    include 'db_baglan.php';
    $SORGU = $DB->prepare("SELECT * FROM users");
    $SORGU->execute();
    $KAYITLAR = $SORGU->fetchAll();
?>

<body>
    <h2>Kullanıcılar Tablosu</h2>
    <table>
        <thead>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Doğum Tarihi</th>
                <th>Email</th>
                <th>Şifre</th>
                <th>Cinsiyet</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($KAYITLAR as $KAYIT): ?>
                <tr>
                    <td>
                        <?php echo $KAYIT['Name'] ?>
                    </td>
                    <td>
                        <?php echo $KAYIT['Surname'] ?>
                    </td>
                    <td>
                        <?php echo $KAYIT['BirthDate'] ?>
                    </td>
                    <td>
                        <?php echo $KAYIT['EMail'] ?>
                    </td>
                    <td>
                        <?php echo $KAYIT['Password'] ?>
                    </td>
                    <td>
                        <?php echo $KAYIT['Gender'] ?>
                    </td>
                </tr>
            <?php endforeach; ?>         
        </tbody>
    </table>
</body>
</html>