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
                        Edit Playlist
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                if(!empty($playlist))
                                {
                                    ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/playlist/editaction/<?php echo $playlist['id'] ?>" enctype="multipart/form-data" method="post">

                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" value="<?php echo $playlist['title'] ?>" class="form-control">

                                        </div>






                                        <div class="form-group">
                                            <label>Playlist Url</label>
                                            <textarea name="playlisturl" class="form-control"><?php echo $playlist['play_list_url'] ?></textarea>


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