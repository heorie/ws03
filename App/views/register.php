<?php require basePath('App/views/partials/head.php'); ?>
<?php require basePath('App/views/partials/navbar.php'); ?>

<div>
  <h2>Register</h2>
  <form method="POST" action="/ws03/public/register">
    <div>
      <label>Name</label>
      <input type="text" name="name" required />
    </div>
    <div>
      <label>Email</label>
      <input type="email" name="email" required />
    </div>
    <div>
      <label>Password</label>
      <input type="password" name="password" required />
    </div>
    <button type="submit">Register</button>
  </form>
  <p>Already have an account? <a href="/ws03/public/login">Login here</a></p>
</div>

<?php require basePath('App/views/partials/footer.php'); ?>