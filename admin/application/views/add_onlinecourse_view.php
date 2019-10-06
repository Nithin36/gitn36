<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Online Course</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Add Online Course
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <?php echo validation_errors();
                                echo $message;

                                ?>



                                <form role="form" action= "<?php echo base_url(); ?>index.php/course/addonlineaction" method="post">
                                    <div class="form-group">
                                        <label>Course Name</label>
                                        <input type="text" name="course" value=" " class="form-control">

                                    </div>

                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" class="form-control"><?php if(!empty($postdata)){ echo $postdata['poll']; } ?></textarea>


                                    </div>

                                    <div class="form-group">
                                        <label>Course Price</label>
                                        <input type="text" name="price" value=" " class="form-control">

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