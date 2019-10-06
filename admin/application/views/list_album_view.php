<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Albums</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Albums
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
                                        Albums
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allalbums))
                                        {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Album Name</th>
                                                        <th>Cover photo</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allalbums as $album)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $album['acategory'] ?></td>
                                                            <td><?php echo $album['title'] ?></td>
                                                            <td>     <?php
                                                                if(trim($album['image'])!="") {
                                                                    ?>

                                                                    <img
                                                                        src="<?php echo ALBUM_URL.$album['image']; ?>"
                                                                        height="50" width="50"/>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    echo "No Image";
                                                                }
                                                                ?></td>
                                                            <td><a href="<?php echo base_url(); ?>index.php/album/edit/<?php echo $album['id'] ?>"  class="btn btn-primary">Edit</a>&nbsp;<button type="button" class="btn btn-danger" onclick="del_alb(<?php echo $album['id'] ?>)">Delete</button></td>
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