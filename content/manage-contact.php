<?php
include "config/koneksi.php";

if (isset($_POST['simpan'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Simpan data ke database
    $insertQ = mysqli_query($config, "INSERT INTO contacts (first_name, last_name, email, message) VALUES ('$first_name', '$last_name', '$email', '$message')");

    if ($insertQ) {
        header("location: ?page=manage-contact&simpan=berhasil");
    } else {
        echo "<script>alert('Gagal Menyimpan Data')</script>";
    }
}
?>



<form action="#" class="p-5 bg-white" method="post">

    <h2 class="h4 text-black mb-5">Contact Form</h2>

    <div class="row form-group">
        <div class="col-md-6 mb-3 mb-md-0">
            <label class="text-black" for="fname">First Name</label>
            <input type="text" id="first_name" class="form-control" name="first_name" required>
        </div>
        <div class="col-md-6">
            <label class="text-black" for="lname">Last Name</label>
            <input type="text" id="last_name" class="form-control" name="last_name" required>
        </div>
    </div>

    <div class="row form-group">
 
        <div class="col-md-12">
            <label class="text-black" for="email">Email</label>
            <input type="email" id="email" class="form-control" name="email">
        </div>
    </div>
     
    <div class="row form-group">

        <div class="row form-group">
            <div class="col-md-12">
                <label class="text-black" for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="7" class="form-control"
                    placeholder="Write your notes or questions here..."></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <input type="submit" value="Send Message" class="btn btn-primary btn-md text-white mt-4" name="simpan">
            </div>
        </div>


</form>