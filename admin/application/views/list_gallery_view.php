<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Gallery</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Gallery Photos
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="status"></div>
                                <?php
                                echo $message;

                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Gallery Photos
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allgallerys))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>galleryPhoto</th>


                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allgallerys as $gallery)
                                                    {
                                                        ?>
                                                        <tr>




                                                            <td><img src="<?php echo GALLERY_URL.$gallery['image'] ?>" height="100" width="100"/></td>


                                                            <td><button type="button" class="btn btn-danger" onclick="del_gal(<?php echo $gallery['id'] ?>)">Delete</button></td>
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