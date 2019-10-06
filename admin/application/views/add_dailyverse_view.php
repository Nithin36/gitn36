<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Daily Verse</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Daily Verse
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                echo $fileerror;
                                echo $imageerror;

                                ?>
                                <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/dailyverse/addaction" method="post">




                                    <div class="form-group">
                                        <label>Language</label>
                                        <select class="form-control" name="lang">
                                            <option value="">select</option>

                                            <option value="English" <?php if(!empty($postdata)){if($postdata['lang']=='English') {?> selected="selected" <?php }}?>>English</option>
                                            <option value="Tamil" <?php if(!empty($postdata)){if($postdata['lang']=='Tamil') {?> selected="selected" <?php }}?>>Tamil</option>
                                            <option value="Kannada" <?php if(!empty($postdata)){if($postdata['lang']=='Kannada') {?> selected="selected" <?php }}?>>Kannada</option>
                                            <option value="Hindi" <?php if(!empty($postdata)){if($postdata['lang']=='Hindi') {?> selected="selected" <?php }}?>>Hindi</option>



                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Photo (Only image file(.jpg,png,gif) ) </label>
                                        <input type="file" name="vphoto" >
                                    </div>

                                    <div class="form-group">
                                        <label>Audio File (Only audio files )</label>
                                        <input type="file" name="vfile">
                                    </div>

                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" data-toggle="datepicker" name="vdate" value="<?php if(!empty($postdata)){ echo $postdata['vdate']; } ?> " class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label>Poll</label>
                                        <textarea name="poll" class="form-control"><?php if(!empty($postdata)){ echo $postdata['poll']; } ?></textarea>


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