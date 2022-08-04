<div class="container" id="main-container">
    <div class="row">
        <div class="col-xs-12 col-md-6 offset-md-3">
            <?= $_SESSION['customer']['hasProfile'] == 'N' ? '<h4 class="alert alert-info mt-3">Create New Customer Profile</h4>' : '<h4 class="alert alert-primary mt-3">Update Your Customer Profile</h4>' ?>
            <form action="" method="post" id="form" class="mt-3">
                <!-- Country input -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="country">Select Country</label>
                    <input type="password" id="country" name="country" class="form-control" />
                </div>
                <!-- Gender select -->
                <div class="form-outline mb-3">
                    <label class="form-label" for="gender">Select Gender</label>
                    <select name="gender" id="gender" class="form-control must-fill">
                        <option value="female">Female</option>
                        <option value="male">Male</option>
                    </select>
                </div>

            </form>
        </div>
    </div>
</div>