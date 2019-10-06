<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Albums</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Album
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                if(!empty($album))
                                {
                                    ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/album/editaction/<?php echo $album['id'] ?>" method="post" enctype="multipart/form-data">

                                        <?php if(trim($album['image'])!="")
                                        {
                                            ?>
                                            <div class="form-group">
                                                <label>Image</label>
                                                <img src="<?php echo ALBUM_URL.$album['image'] ?>" height="100" width="100"/>

                                            </div>
                                        <?php }?>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control" name="category">
                                                <option value="">select</option>
                                                <?php

                                                if(!empty($allcategorys))
                                                {
                                                    foreach ($allcategorys as $category)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $category['id'] ?>" <?php if($album['category']==$category['id']) {?> selected="selected" <?php }?>><?php echo $category['category_name'] ?></option>

                                                        <?php
                                                    }
                                                }
                                                ?>


                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>album</label>
                                            <input type="text" name="title" value="<?php echo $album['title'] ?>" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Albums</label>
                                            <select class="form-control" name="album" id="selalbum">
                                                <option value="">select</option>
                                                <?php

                                                if(!empty($allalbums))
                                                {
                                                    foreach ($allalbums as $album)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $album['id'] ?>" <?php if($audio['album']==$album['id']) {?> selected="selected" <?php }?>><?php echo $album['title'] ?></option>

                                                        <?php
                                                    }
                                                }
                                                ?>


                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Audio Title</label>
                                            <input type="text" name="title" value="<?php echo $audio['title'] ?> " class="form-control">

                                        </div>

                                        <div class="form-group">
                                            <label>Generics</label>
                                            <input type="text" name="genere" value="<?php echo $audio['genere'] ?> " class="form-control">

                                        </div>

                                        <div class="form-group">
                                            <label>Lyrics</label>
                                            <input type="text" name="lyrics" value=" <?php echo $audio['lyrics'] ?>" class="form-control">

                                        </div>
                                        <div class="form-group">
                                            <label>Singer</label>
                                            <input type="text" name="singer" value=" <?php echo $audio['singer'] ?>" class="form-control">

                                        </div>

                                        <div class="form-group">
                                            <label>Photo (Only image file ) </label>
                                            <input type="file" name="aphoto" >
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