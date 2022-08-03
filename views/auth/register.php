<div class="container" id="main-container">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-3 pt-3">
            <form method="POST" action="" id="form">
                <!-- Names input -->
                <div class="form-outline mb-2">
                    <label for="names" class="form-label">First & Last Names</label>
                    <input type="text" name="names" id="names" class="form-control must-fill" value="<?= isset($_SESSION['old']['names']) ? $_SESSION['old']['names'] : '' ?>" />
                    <?= isset($_SESSION['validation']['names']) ? '<span class="text text-danger">'.$_SESSION['validation']['names'].'</span>' : '' ?>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="email">Email address</label>
                    <input type="text" id="email" name="email" class="form-control must-fill" value="<?= isset($_SESSION['old']['email']) ? $_SESSION['old']['email'] : '' ?>" />
                    <?= isset($_SESSION['validation']['email']) ? '<span class="text text-danger">'.$_SESSION['validation']['email'].'</span>' : '' ?>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control must-fill" />
                    <?= isset($_SESSION['validation']['password']) ? '<span class="text text-danger">'.$_SESSION['validation']['password'].'</span>' : '' ?>
                </div>

                <!-- Confirm Password input -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="confirm">Repeat Password</label>
                    <input type="password" id="confirm" name="confirm" class="form-control must-fill" />
                </div>

                <!-- 2 column grid layout for inline styling -->


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-2">Sign up</button>

                <?= isset($_SESSION['alert']) ? '<h6 class="alert alert-'.$_SESSION['alert']['class'].' text-center">'.$_SESSION['alert']['message'].'</h6>' : '' ?>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Already a member? <a href="/ecommerce/login">Login</a></p>
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