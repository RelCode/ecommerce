<div class="container" id="main-container">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-3">
            <?= $_SESSION['customer']['hasProfile'] == 'N' ? '<h4 class="alert alert-info mt-2">Create New Customer Profile</h4>' : '<h4 class="alert alert-primary mt-3">Update Your Customer Profile</h4>' ?>
            <form action="" method="post" id="form" class="mt-3">
                <!-- Country select -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="country">Select Country</label>
                    <select name="country" id="country" class="form-control must-fill">
                        <option value=""></option>
                        <option value="south africa">South Africa</option>
                    </select>
                </div>
                <!-- Province select -->
                <div class="form-outline mb-2">
                    <label for="province" class="form-label">Select Province</label>
                    <select name="province" class="form-control must-fill" id="province">
                        <option value=""></option>
                    </select>
                </div>
                <!-- City select -->
                <div class="form-outline mb-2">
                    <label for="city" class="form-label">Select City</label>
                    <select name="city" id="city" class="form-control must-fill">
                        <option value=""></option>
                    </select>
                </div>
                <!-- Address Line input -->
                <div class="form-outline mb-2">
                    <label for="address" class="form-label">Line Address</label>
                    <input type="text" name="address" class="form-control must-fill">
                </div>
                <!-- Gender select -->
                <div class="form-outline mb-2">
                    <label class="form-label" for="gender">Select Gender</label>
                    <select name="gender" id="gender" class="form-control must-fill">
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>
                <div class="form-outline mb-2">
                    <input type="submit" class="btn btn-primary form-control" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>