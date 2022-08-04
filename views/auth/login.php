<div class="container" id="main-container">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-3 pt-3">
            <form method="POST" action="" id="form">
                <!-- Email input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="text" id="email" name="email" class="form-control must-fill" value="<?= isset($_SESSION['old']['email']) ? $_SESSION['old']['email'] : '' ?>" />
                    <?= isset($_SESSION['validation']['email']) ? '<span class="text text-danger">'.$_SESSION['validation']['email'].'</span>' : '' ?>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control must-fill" />
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-3">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="/ecommerce/forgot">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>

                <!-- Alert messages -->
                <?= isset($_SESSION['alert']) ? '<h6 class="alert alert-' . $_SESSION['alert']['class'] . ' text-center">' . $_SESSION['alert']['message'] . '</h6>' : '' ?>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="/ecommerce/register">Register</a></p>
                    <p>or sign up with:</p>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-google"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-facebook-f"></i>
                    </button>

                    <button type="button" class="btn btn-link btn-floating mx-1">
                        <i class="fab fa-twitter"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>