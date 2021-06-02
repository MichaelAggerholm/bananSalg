<?php include 'includes/header.php'; ?>
<div id="wrapper">

    <?php include 'includes/nav.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Products page
                        <small>Where products are being overwatched..</small>
                    </h1>

                    <?php
                    if (isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source = '';
                    }

                    switch ($source){
                        case 'add_product';
                            include "includes/add_product.php";
                            break;

                        case 'edit_product';
                            include  "includes/edit_product.php";
                            break;

                        default:
                            include "includes/view_all_products.php";
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<?php include 'includes/footer.php'; ?>
