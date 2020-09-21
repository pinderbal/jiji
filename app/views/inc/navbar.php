<nav class="navbar navbar-expand-lg navbar-light bg-light mb-5">
<div class="container">
  <a class="navbar-brand" href="<?= URLROOT;?>"><img src="https://img.icons8.com/nolan/48/love-book.png"/>JiJi</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">
      <?php if(isset($_SESSION['user_id'])) : ?>
        <a class="nav-item nav-link" href="#">Listings <span class="sr-only"></span></a>
        <a class="nav-item nav-link" href="<?= URLROOT ?>/users/logout">Logout <span class="sr-only"></span></a>
      <?php else : ?>
        <a class="nav-item nav-link" href="<?= URLROOT ?>/users/login">Login <span class="sr-only"></span></a>
        <a class="nav-item nav-link" href="<?= URLROOT ?>/users/register">Register</a>
      <?php endif; ?>
    </div>
  </div>
</div>
</nav>