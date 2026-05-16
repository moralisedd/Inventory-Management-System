<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log in</title>
    <script defer src="/js/index.js"></script>
    <link rel="icon" type="image/svg+xml" href="/assets/images/QuickBuyIcon.svg" />
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
    <div class="LoginPage-Container">

        <div class="top-QBlogo-SignUp-button-container">

            <div class="LogInTop-QBlogo-container">
                <img src="/assets/images/QuickBuyLogo-BlackVersion.svg" alt="QuickBuy Logo">
            </div>

            <a href="/pages/auth/register.php" class="SignUp-button">
                <img src="/assets/images/Sign Up Button.svg" alt="Sign Up Button">
            </a>

        </div>

        <div class="Welcome-title">
            <img src="/assets/images/Welcome To QuickBuy Text.svg" alt="Welcome to QuickBuy">
        </div>

        <div class="Login-title">
            <h3>Let's get you to your work orders</h3>
        </div>

        <div class="Login-form-container">
            <p id="login-error" class="login-error"></p>
            <form action="/backend/auth/login.php" method="post">

                <div class="Login-container">
                    <label for="uname"><b>Username / Email</b></label>
                    <input type="text" placeholder="Enter Username or Email" name="uname" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" required>

                    <button type="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="forgot-psw.container">
                    <span class="psw">Forgot <a href="#">password?</a>
                    </span>
                </div>
            </form>
        </div>

        <img src="/assets/images/Bottom Layer.svg" alt="Bottom Layer" id="bottom-layer">

    </div>

    <script>
        const params = new URLSearchParams(window.location.search);
        const err = params.get('error');
        if (err) {
            const el = document.getElementById('login-error');
            el.textContent = err === 'invalid' ? 'Incorrect email or password.' : 'Something went wrong. Please try again.';
            el.style.display = 'block';
        }
    </script>
</body>

</html>