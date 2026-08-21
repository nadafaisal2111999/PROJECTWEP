<?php
session_start();
require("connection.php");
require("function.php");
check_login();
if ($_POST){
    $pharmacy_id = $_SESSION['pharmacies']['id'];
    $medicinename = addslashes($_POST['medicinename']);
    $price = addslashes($_POST['price']);
    $description = addslashes($_POST['description']);

    
    $image_path = "";
    if (isset($_FILES['image']['name']) && $_FILES['image']['error'] === 0){
        $folder = "upload/";
        if(!file_exists($folder)){
            mkdir($folder);
        }
        $destination = $folder . uniqid() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']["tmp_name"], $destination);
        $image_path = $destination;
    }

    $query = "INSERT INTO pharmacy_medicines (`medicinename`, `price`, `description`, `image`, `pharmacy_id`)
              VALUES ('$medicinename', '$price', '$description', '$image_path', '$pharmacy_id')";
    mysqli_query($con, $query);

    header("location:profile.php");
    exit;
}

?>
<?php include("../user/header.php");  ?>

<main class ="addl">
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/all.min.css">
    <div class="continar">
        <h2>إضافة دواء جديد</h2>
        <p>
        البيانات دي هتظهر مباشرة لعملائك اللي بيدوروا على الدواء ده.
        </p>
        <form class="addform" action="" method="post" enctype="multipart/form-data">
        <div class="medicinename">
            <label style="font-size:20px;">اسم الدواء </label>
            
            <input type="text" name="medicinename" placeholder="اسم الدواء" class="inpuy" />
        </div>
        <div class="price">
            <label style="font-size:20px;">سعر </label>
            
            <input type="number" name="price" placeholder="سعر"class="inpuy" />
        </div>
        <div class="description">
            <label style="font-size:20px;">معلومات عن الدواء </label>
            
            <input type="text" name="description" placeholder="معلومات عن الدواء" class="inpuy" />
        </div>
        <div class="image">
            <label style="font-size:20px;">صورة الدواء </label>
            
            <input type="file" name="image" accept="image/*" />
        </div>
        <button>اضافة</button>
        </form>
    
    
    
</div>
    
</main>