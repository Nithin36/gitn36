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
                        Add Plans
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;



                                ?>
                                <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/plan/addaction" method="post">


                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text"  name="name" value="<?php if(!empty($postdata)){ echo $postdata['name']; } ?> " class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label>No Of Days</label>
                                        <input type="text"  name="days" value="<?php if(!empty($postdata)){ echo $postdata['days']; } ?> " class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text"  name="price" value="<?php if(!empty($postdata)){ echo $postdata['price']; } ?> " class="form-control">

                                    </div>




                                    <input type="submit" class="btn btn-primary" value="Submit" />
                                    <input type="reset" class="btn btn-success" value="Reset">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
    </div>



</div>