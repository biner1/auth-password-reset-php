
<?php

  $user = Mysql::query("SELECT * FROM `user` WHERE `id` = :id", [':id'=>$_SESSION['id']])[0];
  $image = $user['image'];
?>
  <div class="container">
  <h2>Account Setting</h2>

  <div class='d-flex'>

  <div class="image">
    <form id="profile-form">
    <img src="images/<?php
      if ($image == '') {
        echo 'default.jpg';
      } else {
       echo $image ;
      }
     ?>" width="200" height="200" alt="">
      <div>
          <input type="file" name="image" id="image">
      </div>
      <input type="hidden" name="update_picture" value="update_picture">
    </form>
      <div id="profile-error"></div>
  </div>

  <div class="information">
    <h3>Basic Information</h3>

  <form id="update-form">
    <div class="form-group">
      <label for="name">Full Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?= $user['fullName'] ?>" placeholder="Full Name">
    </div>

    <div class="form-group">
      <label for="phone">Phone No.</label>
      <input type="text" class="form-control" id="phone" name="phone"value="<?= $user['phone'] ?>" placeholder="phone">
    </div>

    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email" name="email"value="<?= $user['email'] ?>">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div id="update-error"></div>
    <input type="hidden" name="update" value="update">
    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
  </form>


  <div class="my-5">
  <h3>Security</h3>
  <form id="password-form">
    <div class="form-group">
      <label for="password1">Current Password</label>
      <input type="password" class="form-control" name="password1"  placeholder="Password">
    </div>
    <div class="form-password2">
      <label for="password2">New Password</label>
      <input type="password" class="form-control" name="password2" placeholder="New Password">
    </div>
    <div id="change-password-error"></div>
    <input type="hidden" name="change_password" value="change_password">
    <button type="submit" name="change_password" class="btn btn-primary">Save Passwords</button>
  </form>
</div>
</div>
  </div>
  </div>

  