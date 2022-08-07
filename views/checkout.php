<div class="container" id="main-container">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-3 mt-3">
            <h4 class="alert alert-info text-center">Checkout</h4>
            <div class="stepper d-flex justify-content-between">
                <div class="step-1 bg-primary"><span class="fa fa-home"></span></div>
                <hr>
                <div class="step-2"><span class="fa fa-credit-card"></span></div>
            </div>
            <form action="" method="post" id="form">
                <div class="stepper-step-1">
                    <!-- Country select -->
                    <div class="form-outline mb-2">
                        <label class="form-label mb-0" for="country">
                            Select Country
                            <?= isset($_SESSION['validation']['country']) ? '<span class="text text-' . $_SESSION['validation']['country'] . '">' . $_SESSION['validation']['country'] . '</span>' : '' ?>
                        </label>
                        <select name="country" id="country" class="form-control location must-fill">
                            <option value=""></option>
                            <option value="south africa" <?= isset($profile) ? 'selected' : '' ?>>South Africa</option>
                        </select>
                    </div>
                    <!-- Province select -->
                    <div class="form-outline mb-2">
                        <label for="province" class="form-label mb-0">
                            Select Province
                            <?= isset($_SESSION['validation']['province']) ? '<span class="text text-danger">' . $_SESSION['validation']['province'] . '</span>' : '' ?>
                        </label>
                        <select name="province" class="form-control location must-fill" id="province">
                            <?php
                            if (isset($profile) && count($profile) > 0) {
                                echo '<option value="' . $profile['province'] . '">' . $profile['state'] . '</option>';
                            } else {
                                echo '<option value=""></option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- City select -->
                    <div class="form-outline mb-2">
                        <label for="city" class="form-label mb-0">
                            Select City
                            <?= isset($_SESSION['validation']['city']) ? '<span class="text text-danger">' . $_SESSION['validation']['city'] . '</span>' : '' ?>
                        </label>
                        <select name="city" id="city" class="form-control location must-fill">
                            <?php
                            if (isset($profile) && count($profile) > 0) {
                                echo '<option value="' . $profile['city'] . '">' . $profile['area'] . '</option>';
                            } else {
                                echo '<option value=""></option>';
                            }
                            ?>
                        </select>
                    </div>
                    <!-- Address Line input -->
                    <div class="form-outline mb-2">
                        <label for="address" class="form-label mb-0">Line Address</label>
                        <input type="text" id="address" name="address" class="form-control must-fill" value="<?= isset($profile) ? $profile['street_address'] : (isset($_SESSION['old']['address']) ? $_SESSION['old']['address'] : '') ?>">
                    </div>
                    <!-- Zip Code input -->
                    <div class="form-outline mb-2">
                        <label for="zip" class="form-label">
                            Zip Code
                            <?= isset($_SESSION['validation']['zip']) ? '<span class="text text-danger">' . $_SESSION['validation']['zip'] . '</span>' : '' ?>
                        </label>
                        <input type="text" name="zip" id="" class="form-control must-fill" value="<?= isset($profile) ? $profile['zip_code'] : (isset($_SESSION['old']['zip']) ? $_SESSION['old']['zip'] : '') ?>">
                    </div>
                    <!-- Phone Numer input -->
                    <label for="phone" class="form-label mb-0">
                        Phone Number
                        <?= isset($_SESSION['validation']['phone']) ? '<span class="text text-' . $_SESSION['validation']['phone'] . '">' . $_SESSION['validation']['phone'] . '</span>' : '' ?>
                    </label>
                    <div class="input-group form-outline mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                +27
                            </span>
                        </div>
                        <input type="text" id="phone" name="phone" class="form-control must-fill" value="<?= isset($profile) ? $profile['phone_number'] : (isset($_SESSION['old']['phone']) ? $_SESSION['old']['phone'] : ''); ?>">
                    </div>
                </div>
                <div class="stepper-step-2 d-none">
                    <div class="form-outline mb-2">
                        <label for="bank" class="form-label mb-0">Select Bank</label>
                        <select name="bank" id="bank" class="form-control must-fill">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="form-outline mb-2">
                        <label for="branch" class="form-label mb-0">
                            Branch Code
                            <?= isset($_SESSION['validation']['branch']) ? '<span class="text text-danger">' . $_SESSION['validation']['branch'] . '</span>' : '' ?>
                        </label>
                        <input type="text" id="branch" class="form-control must-fill" disabled>
                        <input type="hidden" name="branch" class="branch">
                    </div>
                    <!-- Bank Card Number input -->
                    <div class="form-outline mb-2">
                        <label for="card" class="form-label mb-0">
                            Fake Card Number
                            <?= isset($_SESSION['validation']['card']) ? '<span class="text text-danger">' . $_SESSION['validation']['card'] . '</span>' : '' ?>
                        </label>
                        <input type="text" id="card" name="card" minlength="4" maxlength="16" class="form-control must-fill" value="<?= isset($_SESSION['old']['card']) ? $_SESSION['old']['card'] : '' ?>">
                    </div>
                    <!-- Bank Card Number input -->
                    <div class="form-outline mb-2">
                        <label for="expiry_date" class="form-label mb-0">
                            Fake Card Expiry Date(M/Y)
                            <?= isset($_SESSION['validation']['expiry_date']) ? '<span class="text text-danger">' . $_SESSION['validation']['expiry_date'] . '</span>' : '' ?>
                        </label>
                        <input type="text" id="expiry_date" maxlength="5" name="expiry_date" class="form-control must-fill" value="<?= isset($_SESSION['old']['expiry_date']) ? $_SESSION['old']['expiry_date'] : '' ?>">
                    </div>
                    <!-- Bank Card Number input -->
                    <div class="form-outline mb-2">
                        <label for="cvv" class="form-label mb-0">
                            Fake CVV
                            <?= isset($_SESSION['validation']['cvv']) ? '<span class="text text-danger">' . $_SESSION['validation']['cvv'] . '</span>' : '' ?>
                        </label>
                        <input type="text" id="cvv" name="cvv" maxlength="3" class="form-control must-fill" value="<?= isset($_SESSION['old']['cvv']) ? $_SESSION['old']['cvv'] : '' ?>">
                    </div>
                    <!-- Email Address input -->
                    <div class="form-outline mb-2">
                        <label for="email" class="form-label mb-0">
                            Email Address
                            <?= isset($_SESSION['validation']['email']) ? '<span class="text text-danger">'.$_SESSION['validation']['email'].'</span>' : '' ?>
                        </label>
                            <input type="text" name="email" id="email" class="form-control must-fill" value="<?= isset($_SESSION['old']['email']) ? $_SESSION['old']['email'] : (isset($_SESSION['customer']) ? $_SESSION['customer']['email'] : '') ?>">
                    </div>
                    <div class="form-outline mb-2">
                        <input type="submit" class="btn btn-success form-control" value="Proceed">
                    </div>
                </div>
                <input type="hidden" name="csrf-token" value="<?= $_SESSION['csrf']['token'] ?>">
            </form>
        </div>
        <div class="col-xs-12 col-md-1">
            <button class="btn btn-primary stepper-btn" id="1">Next</button>
        </div>
    </div>
</div>