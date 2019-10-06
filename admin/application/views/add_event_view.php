<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Event</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Event
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;

                                echo $imageerror;

                                ?>
                                <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/event/addaction" method="post">


                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" value="<?php if(!empty($postdata)){ echo $postdata['title']; } ?> " class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" data-toggle="datepicker" name="sdate" value="<?php if(!empty($postdata)){ echo $postdata['sdate']; } ?> " class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" data-toggle="datepicker" name="edate" value="<?php if(!empty($postdata)){ echo $postdata['edate']; } ?> " class="form-control">

                                    </div>


                                    <div class="form-group">
                                        <label>Photo (Only image file ) </label>
                                        <input type="file" name="ephoto" >
                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"><?php if(!empty($postdata)){ echo $postdata['description']; } ?></textarea>


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