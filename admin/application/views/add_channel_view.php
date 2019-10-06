<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Channel</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Channel
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;

                                echo $imageerror;

                                ?>
                                <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/channel/addaction" method="post">


                                    <div class="form-group">
                                        <label>Channel Title</label>
                                        <input type="text" name="title" value="<?php if(!empty($postdata)){ echo $postdata['title']; } ?> " class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label>Channel No</label>
                                        <input type="text" name="channelno" value="<?php if(!empty($postdata)){ echo $postdata['channelno']; } ?> " class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Photo (Only image file ) </label>
                                        <input type="file" name="cphoto" >
                                    </div>

                                    <div class="form-group">
                                        <label>Live Tv Url</label>
                                        <textarea name="livetvurl" class="form-control"><?php if(!empty($postdata)){ echo $postdata['livetvurl']; } ?></textarea>


                                    </div>

                                    <div class="form-group">
                                        <label>Youtube Channel Url</label>
                                        <textarea name="youtubechannelurl" class="form-control"><?php if(!empty($postdata)){ echo $postdata['youtubechannelurl']; } ?></textarea>


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