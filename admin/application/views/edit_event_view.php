<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Events</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Event
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                if(!empty($event))
                                {
                                    ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/event/editaction/<?php echo $event['id'] ?>" enctype="multipart/form-data" method="post">
                                         <?php if(trim($event['photo'])!="")
                                         {
                                             ?>
                                        <div class="form-group">
                                            <label>Image</label>
                                            <img src="<?php echo EVENT_URL.$event['photo'] ?>" height="100" width="100"/>

                                        </div>
                                        <?php }?>
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" value="<?php echo $event['title'] ?>" class="form-control">

                                        </div>




                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="text" data-toggle="datepicker" name="sdate" value=" <?php echo $event['sdate'] ?>" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" data-toggle="datepicker" name="edate" value=" <?php echo $event['edate'] ?>" class="form-control">

                                        </div>


                                        <div class="form-group">
                                            <label>Photo (Only image file ) </label>
                                            <input type="file" name="ephoto" >
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control"><?php echo $event['description'] ?></textarea>


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