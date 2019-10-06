<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">faq</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add faq
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo validation_errors();
                                echo $message;

                                echo $imageerror;

                                ?>
                                <form role="form" enctype="multipart/form-data" action= "<?php echo base_url(); ?>index.php/faq/addaction" method="post">
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
                                        <label>Description</label>
                                        <textarea name="description" id="editor1"  class="form-control"><?php if(!empty($postdata)){ echo $postdata['description']; } ?></textarea>


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
<script src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>

<script type="text/javascript"> 


$(document).ready(function(){



CKEDITOR.replace( 'editor1', {
filebrowserBrowseUrl : '<?php echo base_url(); ?>ckfinder/ckfinder.html',
filebrowserImageBrowseUrl : '<?php echo base_url(); ?>ckfinder/ckfinder.html?type=Images',
filebrowserFlashBrowseUrl : '<?php echo base_url(); ?>ckfinder/ckfinder.html?type=Flash',
filebrowserUploadUrl : '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
filebrowserImageUploadUrl : '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
filebrowserFlashUploadUrl : '<?php echo base_url(); ?>ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
});











});



</script>