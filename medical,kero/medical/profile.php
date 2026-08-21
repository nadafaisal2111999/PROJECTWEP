<?php 
 session_start();
 require("connection.php");
 require("function.php");
 check_login();
?>


<?php include("../user/header.php");  ?>
<?php 
if (isset($_POST['edit-profile']) && $_POST['edit-profile'] === "Update"){


// Connect Between Edit Profile And Mysql => done require("connection.php");
$image_added = false;
if (isset($_FILES['image']['name']) && $_FILES['image']['error'] === 0){
 
$folder = "upload/";
if(!file_exists($folder)){
    mkdir($folder);
}
$destination = $folder . $_FILES['image']['name'];
move_uploaded_file($_FILES['image']["tmp_name"], $destination);
$image_added = true;
if (file_exists($_SESSION['pharmacies']['image'])){
    unlink($_SESSION['pharmacies']['image']);
   
}

}

// save data in variable ;
$name = addslashes($_POST['name']);
$address = addslashes($_POST['address']);
$phone = addslashes($_POST['phone']);
$image = "";
$id = $_SESSION['pharmacies']['id'];
// query to send data to mysql 
if ($image_added){

    $query = "UPDATE `pharmacies` SET name = '$name', address = '$address', phone = '$phone', image = '$destination' where id = '$id'";
    } else{
    $query = "UPDATE `pharmacies` SET name = '$name', address = '$address', phone = '$phone' where id = '$id'";

}
mysqli_query($con, $query);
// Update $_SESSION

$query = "SELECT * FROM `pharmacies` where id = '$id' limit 1";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result)>0){
    $_SESSION['pharmacies']= mysqli_fetch_assoc($result);
}
} 
if(isset($_GET['action']) && $_GET["action"] === "edit"){ ?>

<main>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/all.min.css">
    <h2 style="text-align:center;">Edit Profile</h2>
    <div style="text-align:center;padding-top:20px;">
        <img width=150px src="<?php echo $_SESSION['pharmacies']['image'] ?>" />
    </div>
    <form class="edit-profile" action="" method="post" enctype="multipart/form-data">

        Image <input type="file" name="image"/>
        <input value="<?php echo $_SESSION['pharmacies']['name'] ?>" type="text" placeholder="name" name="name"/>
        <input type="text" value="<?php echo $_SESSION['pharmacies']['address'] ?>" placeholder="address" name="address"/>
        <input type="text" value="<?php echo $_SESSION['pharmacies']['phone'] ?>" placeholder="phone" name="phone"/>
        <input type="submit" value="Update" name="edit-profile"/>
    </form>
</main>


<?php 
} else if ( isset($_GET['action']) && $_GET['action'] === "delete"){ 

if (isset($_POST['delete']) && $_POST['delete'] == "delete User" ){
    $id = addslashes($_POST['id']);
    $query = "DELETE FROM `pharmacies` WHERE id = '$id'";
    mysqli_query($con, $query);
    header("location:logout.php");
    exit;
}
    ?>
    
<main>
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/all.min.css">
    <h2 style="text-align:center;">Delete Profile Page</h2>
    <div style="text-align:center;padding-top:20px;">
        <img width=150px src="<?php echo $_SESSION['pharmacies']['image'] ?>" />
    </div>
<div class="text-center">

    <p>Name IS : <?php echo $_SESSION['pharmacies']['name'] ?></p>
    <p> Address Is : <?php echo $_SESSION['pharmacies']['address'] ?></p>
    <p> Phone Is : <?php echo $_SESSION['pharmacies']['phone'] ?></p>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $_SESSION['pharmacies']['id']; ?>">
        <input type="submit" name="delete" value="delete User"/>
    </form>
    <button><a href="profile.php"> Cancel</a></button>
</div>
   
</main>
<?php 
} else{

// ===== جلب الأدوية الخاصة بالصيدلية دي =====
$pharmacy_id = $_SESSION['pharmacies']['id'];
$med_query = "SELECT * FROM `pharmacy_medicines` WHERE pharmacy_id = '$pharmacy_id' ORDER BY id DESC";
$med_result = mysqli_query($con, $med_query);
$medicines = [];
if ($med_result && mysqli_num_rows($med_result) > 0) {
    while ($row = mysqli_fetch_assoc($med_result)) {
        $medicines[] = $row;
    }
}
// ================================================

?>
<main class="profile">
<div class="con-pro">
    
    <a herf="home.php">
        <h1>صيدليتي   <i class="fa-solid fa-square-plus" style="color: aqua;"></i>  </h1>
        
    </a>
    
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/all.min.css">

<div class="d-flex jc-c profile-page">
<div class="profile-section">
<div class="profile-section1">
    
    <div class="profile-image">
        <?php  if (!$_SESSION['pharmacies']['image']):  ?>
        <img style="width: 70px; border-radius:50px;" src="./images.png" />
        <?php else:  ?>
            <img style="width: 70px; border-radius:50px;" src="<?= $_SESSION['pharmacies']['image'] ?>"/>
        <?php endif;  ?>
    </div>
    <div class="profile-data">
        <h2>Name : <?=  $_SESSION['pharmacies']['name']  ?></h2>
        <p>Address : <?= $_SESSION['pharmacies']['address']  ?></p>
        <p>Phone : <?= $_SESSION['pharmacies']['phone']  ?></p>
        <button class="profile-button">
            <a href="profile.php?action=edit">Edit Profile<a>
        </button>
        <button class="profile-button">
            <a href="profile.php?action=delete">Delete Profile<a>
        </button>
    </div>
        
</div>
</div>
</div>
<!-- ===== قسم عرض الأدوية المضافة ===== -->
<div class="medicines-section">
    <div class="gol">
        <h3 style="padding-top:30px;">الأدوية المتوفرة (<?= count($medicines) ?>)</h3>
        <button class="profile-button">
            <a href="add.php"><h4>اضافة ادوية</h4><a>
        </button>
    </div>
    <?php if (count($medicines) === 0): ?>
        <p class="empty-meds">لسه مضفتش أي دواء. ابدأ ضيف أول دواء دلوقتي.</p>
    <?php else: ?>
        <div class="meds-grid">
            <?php foreach ($medicines as $med): ?>
                <div class="med-card">
                    <div class="med-img">
                        <?php if (!empty($med['image']) && file_exists($med['image'])): ?>
                            <img style="width: 70px; border-radius:15px; padding-top:5px;" src="<?= $med['image'] ?>" alt="<?= htmlspecialchars($med['medicinename']) ?>"/>
                        <?php else: ?>
                            <div class="med-img-ph" style="width: 200px; padding-top:5px;" >💊</div>
                        <?php endif; ?>
                    </div>
                    <div class="med-info">
                        <h4><?= htmlspecialchars($med['medicinename']) ?></h4>
                        <?php if (!empty($med['description'])): ?>
                            <p class="med-desc"><?= htmlspecialchars($med['description']) ?></p>
                        <?php endif; ?>
                        <span class="med-price"><?= htmlspecialchars($med['price']) ?> ج.م</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<!-- ===================================== -->
</div>
</main>
<?php } include("footer.php");  ?>