<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Sliders</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edit Slider
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;
                                if(!empty($slider))
                                {
                                    ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/slider/editaction/<?php echo $slider['id'] ?>" enctype="multipart/form-data" method="post">
                                        <?php if(trim($slider['image_url'])!="")
                                        {
                                            ?>
                                            <div class="form-group">
                                                <label>Slider Photo</label>
                                                <img src="<?php echo SLIDER_URL.$slider['image_url']; ?>" height="100" width="100"/>

                                            </div>
                                        <?php }?>

                                        <div class="form-group">
                                            <label>Slider Photo (Only image file ) </label>
                                            <input type="file" name="sphoto" >
                                        </div>

                                        <div class="form-group">
                                            <label>Slider Url</label>
                                            <textarea name="sliderurl" class="form-control"><?php echo $slider['slider_url']; ?></textarea>


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