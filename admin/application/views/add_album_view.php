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
                        Add Album
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;

                                ?>
                                <form role="form" action= "<?php echo base_url(); ?>index.php/album/addaction" method="post" enctype="multipart/form-data">

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
                                                    <option value="<?php echo $category['id'] ?>" <?php if(!empty($postdata)){if($postdata['category']==$category['id']) {?> selected="selected" <?php }}?>><?php echo $category['category_name'] ?></option>

                                                    <?php
                                                }
                                            }
                                            ?>


                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Album Title</label>
                                        <input type="text" name="title" value=" " class="form-control">

                                    </div>


                                    <div class="form-group">
                                        <label>Cover Photo (Only image file ) </label>
                                        <input type="file" name="aphoto" >
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