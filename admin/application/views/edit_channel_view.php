<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Channels</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Channel
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                if(!empty($channel))
                                {
                                    ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/channel/editaction/<?php echo $channel['id'] ?>" enctype="multipart/form-data" method="post">
                                        <?php if(trim($channel['image'])!="")
                                        {
                                            ?>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <img src="<?php echo CHANNEL_URL.$channel['image'] ?>" height="100" width="100"/>

                                            </div>
                                        <?php }?>
                                        <div class="form-group">
                                            <label>Channel Title</label>
                                            <input type="text" name="title" value="<?php echo $channel['name'] ?>" class="form-control">

                                        </div>

                                        <div class="form-group">
                                            <label>Channel No</label>
                                            <input type="text" name="channelno" value="<?php echo $channel['channelno'] ?>" class="form-control">

                                        </div>


                                        <div class="form-group">
                                            <label>Photo (Only image file ) </label>
                                            <input type="file" name="cphoto" >
                                        </div>

                                        <div class="form-group">
                                            <label>Live Tv Url</label>
                                            <textarea name="livetvurl" class="form-control"><?php echo $channel['videourl'] ?></textarea>


                                        </div>

                                        <div class="form-group">
                                            <label>Youtube Channel Url</label>
                                            <textarea name="youtubechannelurl" class="form-control"><?php echo $channel['channelurl'] ?></textarea>


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