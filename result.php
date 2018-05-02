<?php

if (empty($_POST['name']) && empty($_POST['author']) && empty($_POST['isbn']) ) {
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
}
else {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $isbn = $_POST['isbn'];

    $pdo = new PDO("mysql:host=localhost;dbname=books;charset=utf8", "root", "");
    $sql = "SELECT * FROM books WHERE name LIKE '%$name%' AND author LIKE '%$author%' AND isbn LIKE '%$isbn%'";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Поиск</title>
</head>
<body>
    <form action="result.php" method="POST">
        <input type="text" name="isbn" placeholder="ISBN">
        <input type="text" name="name" placeholder="Название книги">
        <input type="text" name="author" placeholder="Автор книги">
        <input type="submit" value="Поиск">
    </form>
    <table border="1">
        <thead style="font-weight: bold">
            <tr>
                <td>Название</td>
                <td>Автор</td>
                <td>Год выпуска</td>
                <td>Жанр</td>
                <td>ISBN</td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pdo->query($sql) as $row) : ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['author'] ?></td>
                    <td><?php echo $row['year'] ?></td>
                    <td><?php echo $row['genre'] ?></td>
                    <td><?php echo $row['isbn'] ?></td>
                </tr>
            <<?php endforeach; ?>   
        </tbody>
    </table>
</body>
</html>