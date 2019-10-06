        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Category</h1>
                </div>
                <!--End Page Header -->



                           <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Category
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                            <?php echo validation_errors();  
                          echo $message; 

                           ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/category/addaction" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <input type="text" name="category" value=" " class="form-control">
                                           
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