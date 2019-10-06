<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Audios</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Audio
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;

                                ?>
                                <form role="form" action= "<?php echo base_url(); ?>index.php/audio/addaction" method="post" enctype="multipart/form-data">

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control" name="category" onchange="sel_album(this.value)">
                                            <option value="">select</option>
                                            <?php

                                            if(!empty($allcategorys))
                                            {
                                                foreach ($allcategorys as $category)
                                                {
                                                    ?>
                                                    <option value="<?php echo $category['id'] ?>" <?php if(!empty($postdata)){if($postdata['category']==$category['id']) {?> selected="selected" <?php }}?>><?php echo $category['category_name'] ?></option>

                                                    <?php
                                                }
                                            }
                                            ?>


                                        </select>
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
                                                    <option value="<?php echo $album['id'] ?>" <?php if(!empty($postdata)){if($postdata['album']==$album['id']) {?> selected="selected" <?php }}?>><?php echo $album['title'] ?></option>

                                                    <?php
                                                }
                                            }
                                            ?>


                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Audio Title</label>
                                        <input type="text" name="title" value="<?php if(!empty($postdata)){ echo $postdata['title']; }?> " class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label>Generics</label>
                                        <input type="text" name="genere" value="<?php if(!empty($postdata)){ echo $postdata['genere']; }?> " class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label>Lyrics</label>
                                        <input type="text" name="lyrics" value=" <?php if(!empty($postdata)){ echo $postdata['lyrics']; }?>" class="form-control">

                                    </div>
                                    <div class="form-group">
                                        <label>Singer</label>
                                        <input type="text" name="singer" value=" <?php if(!empty($postdata)){ echo $postdata['singer']; }?>" class="form-control">

                                    </div>


                                    <div class="form-group">
                                        <label>Cover Photo (Only image file ) </label>
                                        <input type="file" name="aphoto" >
                                    </div>


                                    <div class="form-group">
                                        <label>Audio (Only audio file ) </label>
                                        <input type="file" name="afile" >
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