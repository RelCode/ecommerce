<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/ecommerce">PH-ECommerce</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navMenuContent" aria-controls="navMenuContent" aria-expanded="false" aria-label="Toggle Navigation Menu">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenuContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                    <a href="/ecommerce/category/hoodies" class="nav-link">Hoodies</a>
            </li>
            <li class="nav-item">
                <a href="/ecommerce/category/pants" class="nav-link">Pants</a>
            </li>
            <li class="nav-item">
                <a href="/ecommerce/shirts" class="nav-link">Shirts</a>
            </li>
            <li class="nav-item">
                <a href="/ecommerce/shoes" class="nav-link">Shoes</a>
            </li>
            <li class="nav-item">
                <a href="/ecommerce/shorts" class="nav-link">Shorts</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto p-0 m-0">
            <li class="nav-item">
                <a href="/ecommerce/cart" class="nav-link">Cart <i class="badge " id="cart-count"></i></a>
            </li>
            <?php
            if (isset($_SESSION['customer']) && $_SESSION['customer']['loggedIn']) {
            ?>
                <li class="nav-item">
                    <a href="/ecommerce/profile" class="nav-link dot-parent">Profile <?= isset($_SESSION['customer']) && $_SESSION['customer']['hasProfile'] == 'N' ? '<span class="red-dot" title="Create Profile"></span>' : ''; ?></a>
                </li>
                <li class="nav-item">
                    <a href="/ecommerce/logout" class="nav-link">Logout</a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav-item">
                    <a href="/ecommerce/login" class="nav-link">Login</a>
                </li>
                <li class="nav-item">
                    <a href="/ecommerce/register" class="nav-link">Register</a>
                </li>
            <?php
            }
            ?>
            <li class="nav-item">
                <form method="post" action="" class="form-inline my-2 ml-md-3 my-lg-0">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search" placeholder="Search For Product" aria-label="Input field to search for products by name" aria-describedby="button-addon1">
                        <input type="hidden" name="csrf-token" value="<?= $_SESSION['csrf']['token']; ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>
</nav>