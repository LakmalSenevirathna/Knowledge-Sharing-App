
<nav class="navbar navbar-expand-lg  nav-color " style=" height: 120px;  border-bottom-left-radius: 5px;border-bottom-right-radius: 5px; background:#e8c300;">
<?php if(!isset($_SESSION['username'])): ?>
  <a class="navbar-brand color" href="dashboard.php" style="margin-left:20px;"><img style="height:100px; width:100px; border-radius:80px;" src="assets/img/logom.png"></a>
  <a class="navbar-brand color" href="dashboard.php" style="margin-left:20px;">𝐊𝐧𝐨𝐰𝐥𝐞𝐝𝐠𝐞 𝐒𝐡𝐚𝐫𝐞</a>
  <?php else: ?>
    <a  class="navbar-brand color" href="index.php" style="margin-left:20px;"><img style="height:100px; width:100px; border-radius:80px;" src="assets/img/logom.png"></a>
    <a  class="navbar-brand color" href="index.php" style="margin-left:20px;">𝐊𝐧𝐨𝐰𝐥𝐞𝐝𝐠𝐞 𝐒𝐡𝐚𝐫𝐞</a>
  <?php endif; ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
  
      <li class="nav-item">
        <a href="logout.php" class="nav-link color"></a>
      </li>
    </ul>
    <?php if(!isset($_SESSION['username'])): ?>
    <form class="form-inline mt-2 mt-md-0" action="dashboard.php" method="POST">
        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <?php else: ?>
      <form class="form-inline mt-2 mt-md-0" action="index.php" method="POST">
        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <?php endif; ?>
  </div>
</nav>