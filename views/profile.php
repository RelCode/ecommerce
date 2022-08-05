<div class="container" id="main-container">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-3">
            <?= $_SESSION['customer']['hasProfile'] == 'N' ? '<h4 class="alert alert-info mt-2">Create New Customer Profile</h4>' : '<h4 class="alert alert-primary mt-3">Update Your Customer Profile</h4>' ?>
            <form action="" method="post" id="form" class="mt-3">
                <!-- Country select -->
                <div class="form-outline mb-2">
                    <label class="form-label mb-0" for="country">
                        Select Country
                        <?= isset($_SESSION['error']) ? '<span class="text text-' . $_SESSION['error']['class'] . '">' . $_SESSION['error']['message'] . '</span>' : '' ?>
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
                    <input type="text" id="address" name="address" class="form-control must-fill" value="<?=isset($profile) ? $profile['street_address'] : (isset($_SESSION['old']['address']) ? $_SESSION['old']['address'] : '') ?>">
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
                <label for="phone" class="form-label mb-0">Phone Number</label>
                <div class="input-group form-outline mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            +27
                        </span>
                    </div>
                    <input type="text" id="phone" name="phone" class="form-control must-fill" value="<?= isset($profile) ? $profile['phone_number'] : (isset($_SESSION['old']['phone']) ? $_SESSION['old']['phone'] : ''); ?>">
                </div>
                <input type="hidden" name="csrf-token" value="<?= $_SESSION['csrf']['token'] ?>">
                <div class="form-outline mb-2">
                    <input type="submit" class="btn btn-primary form-control" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>