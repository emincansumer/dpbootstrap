<div id="user-login-block-container">
  <div id="user-login-block-form-fields">
    <?php print $name; // Display username field ?>
    <?php print $pass; // Display Password field ?>
    <?php print $submit; // Display submit button ?>
    <div class="form-group">
        <?php print $rendered; // Display hidden elements (required for successful login) ?>
    </div>
    
    <div class="links form-group text-center">
        <a href="/user/register">Register</a> | <a href="/user/password">Forgot Password</a>
    </div>
  </div>  
</div>