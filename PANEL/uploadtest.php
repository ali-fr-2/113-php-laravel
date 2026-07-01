<?php


// include "../database/pdo_connection.php";

// if (isset($_POST['submit_image'])) {

//     $tmp = $_FILES['image']['tmp_name'];
//     $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

//     $newName = uniqid() . "." . $extension;

//     if (move_uploaded_file($tmp, "uploads/images/" . $newName)) {
//         echo "آپلود با موفقیت انجام شد.";

//         $result = $conn->prepare("INSERT INTO files SET file_name=?");
//         $result->bindValue(1, $newName);
//         $result->execute();
//     } else {
//         echo "آپلود ناموفق بود.";
//     }
// }

// if (isset($_POST['submit_movie'])) {

//     $tmp = $_FILES['movie']['tmp_name'];
//     $extension = pathinfo($_FILES['movie']['name'], PATHINFO_EXTENSION);

//     $newName = uniqid() . "." . $extension;

//     if (move_uploaded_file($tmp, "uploads/movies/" . $newName)) {
//         $result = $conn->prepare("INSERT INTO files SET file_name=?");
//         $result->bindValue(1, $newName);
//         $result->execute();
//     } else {
//         echo "آپلود ناموفق بود.";
//     }
// }



include "../database/pdo_connection.php";

if (isset($_POST['submit'])) {

    $type = $_POST['type']; // image یا movie

    $file = $_FILES['file'];

    $tmp = $file['tmp_name'];

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    $newName = uniqid() . "." . $extension;

    $folder = ($type == "image")
        ? "uploads/images/"
        : "uploads/movies/";

    if (move_uploaded_file($tmp, $folder . $newName)) {

        $result = $conn->prepare("INSERT INTO files SET file_name=?,
    file_type=?");

        $result->bindValue(1, $newName);
        $result->bindValue(2, $type);

        $result->execute();

        echo "آپلود با موفقیت انجام شد.";

    } else {

        echo "آپلود ناموفق بود.";

    }

}

$videos=$conn->prepare("SELECT *
FROM files
WHERE file_type='movie'");
$videos->execute();
$movies=$videos->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- <form action="upload.php" method="POST" enctype="multipart/form-data">

    <input type="file" name="image">

    <button type="submit" name="submit_image">
        Upload images
    </button>

</form>

<form action="upload.php" method="POST" enctype="multipart/form-data">

    <input type="file" name="movie">

    <button type="submit" name="submit_movie">
        Upload movies
    </button>

</form> -->


<form action="upload.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="type" value="image">

    <input type="file" name="file">

    <button type="submit" name="submit">
        Upload Image
    </button>

</form>

<form action="upload.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="type" value="movie">

    <input type="file" name="file">

    <button type="submit" name="submit">
        Upload Movie
    </button>

</form>



<?php foreach($movies as $movie){?>
<h3>Showing Video</h3>

<video controls>
    <source src="uploads/movies/<?= $movie['file_name']?>" type="video/mp4">
</video>
<?php }?>
