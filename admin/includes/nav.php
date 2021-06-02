<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Banan - CMS</a>
    </div>

    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Profile <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#usersDropdown"><i class="fa fa-fw fas fa-user"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="usersDropdown" class="collapse">
                    <li>
                        <a href="users.php">All Users</a>
                    </li>
                    <li>
                        <a href="users.php?source=add_user">Add User</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#productsDropdown"><i class="fa fa-fw fa-exchange"></i> Products <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="productsDropdown" class="collapse">
                    <li>
                        <a href="Products.php">All Products</a>
                    </li>
                    <li>
                        <a href="Products.php?source=add_Product">Add Product</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>