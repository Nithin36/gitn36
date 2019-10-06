<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header"><?php if($course['online']==1) { ?> Online Course<?php } else { ?> Offline Course<?php } ?></h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!--  Tooltips and Popovers-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $course['name'] ?>
                    </div>
                    <div class="panel-body">
                        <h4>Add  Plan</h4>
                        <div class="tooltip-demo">
                            <a  href="<?php echo base_url() ?>index.php/courseplan/add/<?php echo $course['id'] ?>" class="btn btn-default" >Add Plan</a>
                            <a href="<?php echo base_url() ?>index.php/courseplan/courseplan_list/<?php echo $course['id'] ?>" class="btn btn-default" >List Plans</a>
                            <a href="<?php echo base_url(); ?>index.php/course/<?php if($course['online']==1) { ?>onlinecourse_list<?php } else { ?>offlinecourse_list<?php } ?>" class="btn btn-default" >Back To <?php if($course['online']==1) { ?> Online Course<?php } else { ?> Offline Course<?php } ?></a>

                        </div>

                    </div>
                </div>
                <!--End  Tooltips and Popovers-->
            </div>
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $course['name']; ?> >> Add Plan
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;


                                ?>
                                <form role="form" action= "<?php echo base_url(); ?>index.php/courseplan/addaction/<?php echo $course['id'] ?>" method="post">

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