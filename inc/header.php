<?php
$id_level = isset($_SESSION['LEVEL']) ? $_SESSION['LEVEL'] : '';
//supaya web terproteksi dan harus melakukan login terlebih dahulu
?>
<header class="shadow p-3 mb-5 bg-body-tertiary rounded">
  <nav class="navbar navbar-expand-lg bg-body-White">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">CMS Aca</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Page
            </a>
            <ul class="dropdown-menu">
              <!-- <li><a class="dropdown-item" href="#">AboutUs</a></li> -->
              <li><a class="dropdown-item" href="?page=myprofile">My Profile</a></li>
              <!-- jika levelnya admin maka tampilkan menu user -->
               <?php if ($id_level == 1) : ?>
                <li><a class="dropdown-item" href="?page=user">User</a></li>
              <?php endif ?>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="?page=manage-contact">Contact</a></li>
              <li></li>
            </ul>
          <li class="nav-item">
            <a class="nav-link" href="?page=manage-skill">Skill</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=experience">Experience</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=education">Education</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=works">Works</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=manage-galleries">Galleries</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?page=manage-aboutus">About US</a>
          </li>
        </ul>
        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?php echo $_name ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="keluar.php">Keluar</a></li>
            </ul>
          </li>
      </div>
    </div>
  </nav>
</header>