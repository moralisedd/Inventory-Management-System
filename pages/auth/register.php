<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <script defer src="/js/index.js"></script>
    <link rel="icon" type="image/svg+xml" href="/assets/images/QuickBuyIcon.svg" />
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
    <div class="Register-Body-container">

        <div class="top-QBlogo-container-Login-button">

            <div class="top-QBlogo-container">
                <img src="/assets/images/QuickBuyLogo-BlackVersion.svg" alt="QuickBuy Logo">
            </div>

            <a href="/pages/auth/login.php" class="Login-button">
                <img src="/assets/images/Login Button.svg" alt="Login Button">
            </a>

        </div>

        <div class="create-title">
            <img src="/assets/images/Create your account Logo.svg" alt="Create your account">
        </div>

        <div class="register-title">
            <h3>Let's get you to your work orders</h3>
        </div>

        <!-- Register Form -->
        <div class="register-form-box">
            <form action="/action_page.php">
                <div class="reg-form-container">

                    <div class="input-container">
                        <i class="img-input-icons">
                            <img src="/assets/images/Your Name Icon.svg" alt="Your Name Icon">
                        </i>

                        <input class="input-field" type="text" placeholder="Enter Name" name="name" id="name" required>
                    </div>

                    <div class="input-container">
                        <i class="img-input-icons">
                            <img src="/assets/images/Your Work Email Icon.svg" alt="Email Icon">
                        </i>
                        <input class="input-field" type="text" placeholder="Enter Email" name="email" id="email"
                            required>
                    </div>

                    <div class="input-container">
                        <i class="img-input-icons">
                            <img src="/assets/images/Password Icon.svg" alt="Password Icon">
                        </i>
                        <input class="input-field" type="password" placeholder="Enter Password" name="psw" id="psw"
                            required>
                    </div>

                    <div class="input-container">
                        <i class="img-input-icons">
                            <img src="/assets/images/Confirm Password Icon.svg" alt="Repeat Password Icon">
                        </i>
                        <input class="input-field" type="password" placeholder="Repeat Password" name="psw-repeat"
                            id="psw-repeat" required>
                    </div>

                    <button type="submit" class="btn">Register</button>
                </div>

            </form>
        </div>
        <!-- Register Form -->

        <img src="/assets/images/Bottom Layer.svg" alt="Bottom Layer" id="bottom-layer">

    </div>
</body>

</html>