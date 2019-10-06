<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Plans</h1>
        </div>
        <!--End Page Header -->



        <div class="row">

            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Plan
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                if(!empty($plan))
                                {
                                    ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/plan/editaction/<?php echo $plan['id'] ?>" method="post">
                                        <div class="form-group">
                                            <label>Plan</label>
                                            <input type="text" name="name" value="<?php echo $plan['name'] ?>" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>No Of Days</label>
                                            <input type="text" name="days" value="<?php echo $plan['noofdays'] ?>" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" name="price" value="<?php echo $plan['price'] ?>" class="form-control">

                                        </div>








                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        <input type="reset" class="btn btn-success" value="Reset">
                                    </form>
                                    <?php
                                }
                                else
                                {
                                    echo '<div class="alert alert-warning alert-dismissable"> Something Wrong... </div>';
                                }

                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
    </div>



</div>