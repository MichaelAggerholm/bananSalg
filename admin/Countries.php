<?php include 'includes/header.php'; ?>
<div id="wrapper">

    <?php include 'includes/nav.php'; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Countries page
                        <small>all over the world..</small>
                    </h1>

                    <?php
                    if (isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source = '';
                    }

                    switch ($source){
                        case 'add_country';
                            include "includes/add_country.php";
                            break;

                        case 'edit_country';
                            include  "includes/edit_country.php";
                            break;

                        default:
                            include "includes/view_all_countries.php";
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
