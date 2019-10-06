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
                            List Categories
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="status"></div>
                            <?php 
                          echo $message; 

                           ?>
                                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categories
                        </div>
                        <div class="panel-body">
                            <?php
    
if(!empty($allcategorys))
{
    ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                           
                                            <th>Category Name</th>
                                          
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       
                                        foreach ($allcategorys as $category)
{
?>
                                        <tr>
                                           
                                            <td><?php echo $category['category_name'] ?></td>
                                       
                                         <td><a href="<?php echo base_url(); ?>index.php/category/edit/<?php echo $category['id'] ?>"  class="btn btn-primary">Edit</a>&nbsp;<button type="button" class="btn btn-danger" onclick="del_cat(<?php echo $category['id'] ?>)">Delete</button></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                  
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        else
                        {
echo '<div class="alert alert-info alert-dismissable"> No Result </div>';
                            
                        }
                        ?>
                        </div>
                        <?php echo $links ?> 
                    </div>
                                </div>
                  
                            </div>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>
            </div>

            

        </div>