<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Online Course</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!--  Tooltips and Popovers-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $course['name'] ?>
                    </div>
                    <div class="panel-body">
                        <h4>List Videos</h4>
                        <div class="tooltip-demo">
                            <a  href="<?php echo base_url() ?>index.php/video/add/<?php echo $course['id'] ?>" class="btn btn-default" >Add Video</a>
                            <a href="<?php echo base_url() ?>index.php/video/video_list/<?php echo $course['id'] ?>" class="btn btn-default" >List Videos</a>
                            <a href="<?php echo base_url(); ?>index.php/course/onlinecourse_list" class="btn btn-default" >Back To Online Course</a>

                        </div>

                    </div>
                </div>
                <!--End  Tooltips and Popovers-->
            </div>
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $course['name'] ?> >> List Videos
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
                                        Videos
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allvideos))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Title</th>

                                                        <th>Paid</th>
                                                        <th>Image</th>
                                                        <th>Video</th>


                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allvideos as $video)
                                                    {
                                                        ?>
                                                        <tr>

                                                            <td>&nbsp;
                                                                <?php echo $video['title'];?>


                                                            </td>


                                                            <td><?php
                                                                if($video['paid']==0)
                                                                {
                                                                    echo "Free";
                                                                }
                                                                else
                                                                {
                                                                    echo "Paid";
                                                                }
                                                                ?></td>
                                                            <td><?php
                                                                if(trim($video['image'])!="")
                                                                {
                                                                  ?>
                                                                    <img src="<?php echo COVERPHOTO_URL.$video['image'] ?>" height="100" width="100"/>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                    echo "No Image";
                                                                }
                                                                ?></td>
                                                            <td>
                                                                <video width="160" height="120" controls>
                                                                    <source src="<?php echo VIDEO_URL.$video['video'] ?>" type="video/mp4">

                                                                </video>
                                                            </td>



                                                            <td>
                                                                <a  class="btn btn-danger" href="<?php echo base_url() ?>index.php/video/edit/<?php echo $video['id'] ?>" >Edit</a>
                                                                <button type="button" class="btn btn-danger" onclick="del_video(<?php echo $video['id'] ?>)">Delete</button>

                                                            </td>
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