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
                        <h4>Edit Plan</h4>
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
                        <?php echo $course['name'] ?> >> Edit plan
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                if(!empty($courseplan))
                                {
                                    ?>
                                    <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/courseplan/editaction/<?php echo $courseplan['id'] ?>" method="post">

                                        <div class="form-group">
                                            <label>Plan</label>
                                            <input type="text" name="name" value="<?php echo $courseplan['name'] ?>" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>No Of Days</label>
                                            <input type="text" name="days" value="<?php echo $courseplan['noofdays'] ?>" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="text" name="price" value="<?php echo $courseplan['price'] ?>" class="form-control">

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