        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Slider</h1>
                </div>
                <!--End Page Header -->



                           <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Slider
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                            <?php echo validation_errors();  
                          echo $message; 
                       
                          echo $imageerror; 

                           ?>
                                    <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/slider/addaction" method="post">

                                 
                             
                                    
                                  <div class="form-group">
                                            <label>Slider Photo (Only image file ) </label>
                                            <input type="file" name="sphoto" >
                                        </div>
                                        <div class="form-group">
                                            <label>Slider Url</label>
                                            <textarea name="sliderurl" class="form-control"><?php if(!empty($postdata)){ echo $postdata['sliderurl']; } ?></textarea>


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