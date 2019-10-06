<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Daily Verse</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Daily Verse
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
                                        Daily Verse
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($alldailyverses))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Verse Details</th>

                                                        <th>CoverPhoto</th>
                                                        <th>MagazineFile</th>


                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($alldailyverses as $dailyverse)
                                                    {
                                                        ?>
                                                        <tr>

                                                            <td>&nbsp;<table>
                                                                    <tr><td>Poll</td><td>:</td><td><?php echo $dailyverse['poll']; ?></td></tr>
                                                                    <tr><td>Yes</td><td>:</td><td><?php echo $dailyverse['yes']; ?></td></tr>
                                                                    <tr><td>No</td><td>:</td><td><?php echo $dailyverse['no']; ?></td></tr>
                                                                    <tr><td>Maybe</td><td>:</td><td><?php echo $dailyverse['maybe']; ?></td></tr>
                                                                </table>


                                                            </td>


                                                            <td><img src="<?php echo VERSEIMAGE_URL.$dailyverse['image'] ?>" height="50" width="50"/></td>
                                                            <td>
                                                                <?php if(trim($dailyverse['audio'])!="") { ?>
                                                                <audio controls>
                                                                    <source src="<?php echo VERSEAUDIO_URL.$dailyverse['audio'] ?>" type="video/mp4">

                                                                </audio>
                                                            <?php }
                                                            else
                                                            {
                                                                echo "No Audio";
                                                            }

                                                            ?>
                                                            </td>



                                                            <td><button type="button" class="btn btn-danger" onclick="del_dve(<?php echo $dailyverse['id'] ?>)">Delete</button></td>
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