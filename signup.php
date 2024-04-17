<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="icon" href="images/logo.png" type="image/x-icon">
  <title>Sign Up</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="css/signup_styles.css">
  <style>
    body {
      background-image: url('image/bg1.png');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    p {
      font-size: 14px;
    }

    .margin {
      margin-bottom: 45px;
    }



    .navbar {
      padding-top: 15px;
      padding-bottom: 15px;
      border: 0;
      border-radius: 0;
      margin-bottom: 0px;
      font-size: 12px;
      letter-spacing: 5px;
    }

    .navbar-nav li a:hover {
      color: #1abc9c !important;
    }

    .form {
      background: #eaecf7;
      padding: 40px;
      max-width: 510px;
      margin: 40px auto;
      border-radius: 15px;
      box-shadow: 0 4px 10px 4px rgba(19, 35, 47, .3);
    }

    #password-strength {
      color: #999;
      font-size: 12px;
    }

    .weak {
      color: red !important;
    }

    .medium {
      color: orange !important;
    }

    .strong {
      color: green !important;
    }

    .error {
      background-color: #ffcccc !important;
    }

    .field-wrap {
      position: relative;
      margin-bottom: 20px;
    }

    .show-password {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .password-wrap {
      position: relative;
    }

    #show-password {
      position: absolute;
      right: 10px;
      top: 55%;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .field-wrap {
      position: relative;
    }

    .password-container {
      position: relative;
    }

    .field-wrap i {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      cursor: pointer;
    }

    .container-fluid {
      height: 100vh;
      overflow-y: auto;/
    }
  </style>

</head>

<body>

</body>
<script>
  function calculateAge() {
    // Get the birthdate value
    var birthdateInput = document.getElementById("birthdate");
    var birthdate = new Date(birthdateInput.value);

    // Calculate the age
    var currentDate = new Date();
    var age = currentDate.getFullYear() - birthdate.getFullYear();

    // Update the age input field
    var ageInput = document.getElementById("age");
    ageInput.value = age;
  }
</script>

<script>
  function calculateAge() {
    var birthdateInput = document.getElementById("birthdate");
    var birthdate = new Date(birthdateInput.value);
    var currentDate = new Date();
    var age = currentDate.getFullYear() - birthdate.getFullYear();
    var ageInput = document.getElementById("age");
    ageInput.value = age;
  }

  function checkPasswordStrength() {
    var password = document.getElementById('password');
    var strengthText = document.getElementById('password-strength');
    var regex = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/;

    if (password.value.length >= 8 && regex.test(password.value)) {
      strengthText.innerHTML = 'Password Strength: Strong';
      strengthText.className = 'strong';
    } else if (password.value.length >= 8 || regex.test(password.value)) {
      strengthText.innerHTML = 'Password Strength: Medium';
      strengthText.className = 'medium';
    } else {
      strengthText.innerHTML = 'Password Strength: Weak';
      strengthText.className = 'weak';
    }
  }

  function validateForm() {
    var fields = ["firstName", "lastName", "username", "password", "email", "phoneNumber", "birthdate", "address"];
    var isValid = true;

    for (var i = 0; i < fields.length; i++) {
      var field = document.getElementById(fields[i]);

      if (field.value.trim() === "") {
        field.style.backgroundColor = "#ffcccc";
        isValid = false;
      } else {
        field.style.backgroundColor = "";
      }
    }

    return isValid;
  }
</script>

<script>
  function showDatePicker() {
    document.getElementById('birthdate').style.display = 'block';
    document.getElementById('birthdate-placeholder').style.display = 'none';
  }
</script>

<script>
  function togglePassword() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }
</script>

<script>
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById('password');
    var icon = document.getElementById('show-password');

    var scrollPosition = window.scrollY;

    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      icon.classList.remove('fa-eye');
      icon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      icon.classList.remove('fa-eye-slash');
      icon.classList.add('fa-eye');
    }

    window.scrollTo(0, scrollPosition);
  }
</script>




<div class="container-fluid">
  <div class="form">
    <img src="images/logo.png" alt="Logo" style="width: 150px; height: auto; display: block; margin: 0 auto;">
    <h2>
      <center>Account Registration</center>
    </h2><br>
    <form action="register.php" method="post">

      <div class="top-row">
        <div class="field-wrap">
          <input type="text" type="text" name="firstName" required placeholder="Firstname">
        </div>
        <div class="field-wrap">
          <input type="text" type="text" name="lastName" required placeholder="Lastname">
        </div>
      </div>

      <div class="top-row">
        <div class="field-wrap">
          <input id="text" type="text" name="username" required placeholder="Username" />
        </div>
        <div class="field-wrap">
          <div class="password-container">
            <input type="password" name="password" required placeholder="Password" id="password" onkeyup="checkPasswordStrength()" />
            <i class="fa fa-eye" id="show-password" onclick="togglePasswordVisibility()"></i>
          </div>
          <span id="password-strength"></span>
        </div>

      </div>

      <input id="text" type="text" name="email" required placeholder="Email Address" /> <br>

      <input id="number" type="text" name="phoneNumber" required maxlength="11" placeholder="Phone Number"/>
<span style="color: red;">Please enter exactly 11 numbers for the phone number.</span>

      <br>
      <div class="top-row">
        <div class="field-wrap">
          <input type="text" id="birthdate-placeholder" placeholder="Birthdate" readonly onclick="showDatePicker()" />
          <input type="date" id="birthdate" name="birthdate" required style="display: none;" onchange="calculateAge()" />
        </div>
        <div class="field-wrap">
          <input id="age" type="number" name="age" required placeholder="Age" readonly />
        </div>
      </div>
      <label>Address:</label>
      <textarea name="address" required></textarea> <br>
      <button id="button" type="submit" class="button button-block">Sign Up</button><br>
      <p class="mb-0 mt-4 center-text" style="text-align: center;">
        <a href="login.php" class="link">Already have an account? <span style="color: blue;">Login</span></a>
      </p>

    </form>
  </div>
</div>
<script>
document.getElementById('number').addEventListener('input', function () {
    if (this.value.length > 11) {
        this.value = this.value.slice(0, 11); // Limit input to 11 characters
    }
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>