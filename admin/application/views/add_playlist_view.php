<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Playlists</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Playlist
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;


                                ?>
                                <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/playlist/addaction" method="post">


                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" name="title" value="<?php if(!empty($postdata)){ echo $postdata['title']; } ?> " class="form-control">

                                    </div>


                                    <div class="form-group">
                                        <label>Playlist Url</label>
                                        <textarea name="playlisturl" class="form-control"><?php if(!empty($postdata)){ echo $postdata['playlisturl']; } ?></textarea>


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