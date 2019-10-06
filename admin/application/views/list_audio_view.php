<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Audios</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Audios
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
                                        Audios
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allaudios))
                                        {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Album Name</th>
                                                        <th>Audio title</th>
                                                        <th>Generics</th>
                                                        <th>Lyrics</th>
                                                        <th>singer</th>
                                                        <th>Cover photo</th>
                                                        <th>Audio File</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allaudios as $audio)
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $audio['acategory'] ?></td>
                                                            <td><?php echo $audio['aalbum'] ?></td>
                                                            <td><?php echo $audio['title'] ?>
                                                            <td><?php echo $audio['genere'] ?>
                                                            <td><?php echo $audio['lyrics'] ?>
                                                            <td><?php echo $audio['singer'] ?>



                                                            </td>
                                                            <td>     <?php
                                                                if(trim($audio['image'])!="") {
                                                                    ?>

                                                                    <img
                                                                        src="<?php echo AUDIOIMAGE_URL.$audio['image']; ?>"
                                                                        height="50" width="50"/>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    echo "No Image";
                                                                }
                                                                ?></td>

                                                            <td>     <?php
                                                                if(trim($audio['audiofile'])!="") {
                                                                    ?>
                                                                    <audio controls>

                                                                        <source src="<?php echo AUDIO_URL.$audio['audiofile']; ?>" type="audio/mpeg">

                                                                    </audio>

                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    echo "No audio";
                                                                }
                                                                ?></td>
                                                            <td><a href="<?php echo base_url(); ?>index.php/audio/edit/<?php echo $audio['id'] ?>"  class="btn btn-primary">Edit</a><br/><br/><button type="button" class="btn btn-danger" onclick="del_aud(<?php echo $audio['id'] ?>)">Delete</button></td>
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