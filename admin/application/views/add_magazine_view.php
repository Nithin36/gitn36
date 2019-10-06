        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Magazine</h1>
                </div>
                <!--End Page Header -->



                           <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Magazine
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                            <?php echo validation_errors();  
                          echo $message; 
                          echo $fileerror; 
                          echo $imageerror; 

                           ?>
                                    <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/magazine/addaction" method="post">

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
                                            <label>Title</label>
                                            <input type="text" name="title" value="<?php if(!empty($postdata)){ echo $postdata['title']; } ?> " class="form-control">
                                           
                                        </div>
                                       
                                   <div class="form-group">
                                            <label>Product Id</label>
                                            <input type="text" name="pid" value="<?php if(!empty($postdata)){ echo $postdata['pid']; } ?> " class="form-control">
                                           
                                        </div>
                                    
                                  <div class="form-group">
                                            <label>Cover Photo (Only image file ) </label>
                                            <input type="file" name="cphoto" >
                                        </div>
                                
                                    <div class="form-group">
                                            <label>Magazine File (Only pdf,epub files )</label>
                                            <input type="file" name="mfile">
                                        </div>
                                           <div class="form-group">
                                            <label>Preview File (Only pdf,epub files ) </label>
                                            <input type="file" name="pfile">
                                        </div>
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="text" data-toggle="datepicker" name="mdate" value="<?php if(!empty($postdata)){ echo $postdata['mdate']; } ?> " class="form-control">
                                           
                                        </div>
                                             <div class="form-group">
                                            <label>Price (INR)</label>
                                            <input type="text" name="price_inr" value=" <?php if(!empty($postdata)){ echo $postdata['price_inr']; } ?>" class="form-control">
                                           
                                        </div>
                                             <div class="form-group">
                                            <label>Price (DOLLAR)</label>
                                            <input type="text" name="price_dollar" value="<?php if(!empty($postdata)){ echo $postdata['price_dollar']; } ?> " class="form-control">
                                           
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