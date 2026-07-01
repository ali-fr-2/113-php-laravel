<?php

// if (isset($_POST['submit'])) {

//     $tmp = $_FILES['image']['tmp_name'];
//     $name = $_FILES['image']['name'];

//     if (move_uploaded_file($tmp, "uploads/images/" . $name)) {
//         echo "آپلود با موفقیت انجام شد.";
//     } else {
//         echo "آپلود ناموفق بود.";
//     }

// }

if (isset($_POST['submit'])) {

    $tmp = $_FILES['movie']['tmp_name'];
    $name = $_FILES['movie']['name'];

    if (move_uploaded_file($tmp, "uploads/movies/" . $name)) {
        echo "آپلود با موفقیت انجام شد.";
    } else {
        echo "آپلود ناموفق بود.";
    }

}

?>

<!-- <form action="upload.php" method="POST" enctype="multipart/form-data">

    <input type="file" name="image">

    <button type="submit" name="submit">
        Upload
    </button>

</form> -->

<form action="upload.php" method="POST" enctype="multipart/form-data">

    <input type="file" name="movie">

    <button type="submit" name="submit">
        Upload
    </button>

</form>