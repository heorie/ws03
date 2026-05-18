<?php require basePath('App/views/partials/head.php'); ?>
<?php require basePath('App/views/partials/navbar.php'); ?>

<div>
  <h2>Login</h2>
  <form method="POST" action="/ws03/public/login">
    <div>
      <label>Email</label>
      <input type="email" name="email" required />
    </div>
    <div>
      <label>Password</label>
      <input type="password" name="password" required />
    </div>
    <button type="submit">Login</button>
  </form>
  <p>No account? <a href="/ws03/public/register">Register here</a></p>
</div>

<?php require basePath('App/views/partials/footer.php'); ?>