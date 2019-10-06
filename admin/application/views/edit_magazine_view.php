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
                            Edit Category
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                            <?php echo validation_errors();  
                          echo $message; 
                         if(!empty($category))
                         {
                           ?>
                                    <form role="form" action= "<?php echo base_url(); ?>index.php/category/editaction/<?php echo $category['id'] ?>" method="post">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <input type="text" name="category" value="<?php echo $category['category_name'] ?>" class="form-control">
                                           
                                        </div>
                                       
                                  
                                    
                                    
                                        <div class="form-group">
                                           
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="home" <?php if($category['home']=="yes" ) { ?> checked="checked" <?php } ?>value="yes">Display Home
                                                </label>
                                            </div>
                                      
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