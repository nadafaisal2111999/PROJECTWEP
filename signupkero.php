<?php
session_start();
require("connection.php");
if ($_POST){
    $name=$_POST['pharmacyname'];
    $email=$_POST['email'];
    $nubmer=$_POST['phone'];
    $address =$_POST['address'];
    $password=$_POST['password'];
    $query="INSERT INTO pharmacies (`name` , `email`, `phone` , `address` , `password`) VALUES ('$name' , '$email' , '$nubmer' , '$address' , '$password')";
    mysqli_query($con, $query);
    $new_id = mysqli_insert_id($con);
    $query="SELECT * FROM pharmacies WHERE id = '$new_id' LIMIT 1";
    $result=mysqli_query($con, $query);
    if(mysqli_num_rows($result) > 0){
        $_SESSION['pharmacies']=mysqli_fetch_assoc($result);
    }
 
    header("location:profile.php");
    exit;
}

?>
<?php include("../user/header.php");  ?>
<main class="sign">
    
    <link rel="stylesheet" href="../css/style.css"/>
    <link rel="stylesheet" href="../css/all.min.css">
<div class="conti">
    <h2>صيدليتي
        <i class="fa-solid fa-square-plus" style="color: aqua;"></i>
    </h2>
    <div class="blod">
        <div class="blod2">
            <h3 style=" font-size:50px; width: 450px;">خلّي صيدليتك يشوفها آلاف اللي بيدوروا على دواء</h3>
            <p style="color:darkgray; padding-top:15px;">عمل بروفايل لصيدليتك في دقايق، وابدأ توصل للعملاء القريبين منك.</p>
        </div>
        <div class="blod3">
            <div class="iconss">
                <i class="fa-solid fa-magnifying-glass"></i>
                <h5>تظهر في نتائج البحث فورًا <p style="color:darkgray;">أي حد يدور على دواء متوفر عندك، هيشوف صيدليتك على طول.</p></h5>
            </div>
            <div class="iconss">
                <i class="fa-solid fa-truck"></i>
                <h5>تحكّم كامل في بروفايلك <p style="color:darkgray;">حدّث مخزونك وأسعارك ومواعيدك في أي وقت بنفسك.</p>
                </h5>
            </div>
            <div class="iconss">
                <i class="fa-solid fa-shield-halved"></i>
                <h5>علامة "موثّقة" لعملائك<p style="color:darkgray;">بعد التحقق من ترخيصك، صيدليتك بتاخد شارة الثقة قدام الكل.</p>
                </h5>
            </div>
        </div>
    </div>
</div>
    <form class="signup-form" action="" method="post"> 
        
        <label style="font-size:20px;" >اسم الصيدلية</label>
        <div class="input-icon">
            <i class="fa-solid fa-store icon"></i>
            <input type="text" name="pharmacyname" placeholder="مثال: صيدلية الشفاء" class="inpuy"  />
        </div>
            <label style="font-size:20px;">ايميل </label>
        <div class="input-icon">
            <i class="fa-regular fa-envelope icon"></i> 
            <input type="email" name="email" placeholder="example@pharmacy.com" class="inpuy" />
        </div>
            <label style="font-size:20px;">رقم الهاتف</label>
        <div class="input-icon">
            <i class="fa-solid fa-phone icon"></i>
            <input type="number" name="phone" placeholder="رقم الهاتف" class="inpuy" />
        </div>
            <label style="font-size:20px;">عنوان الصيدلية</label>
        <div class="input-icon">
            <i class="fa-solid fa-location-dot icon"></i>
            <input type="address" name="address" placeholder="المحافظة، المنطقة، الشارع" class="inpuy"  />
        </div>
            <label style="font-size:20px;">كلمة المرور</label>
        <div class="input-icon">
            <i class="fa-solid fa-lock icon"></i>
            <input type="password" name="password" placeholder=" احرف 8 على الأقل" class="inpuy"  />
        </div>
            
        <button class="hool">انشاء حساب</button>
    </form>
</main>
