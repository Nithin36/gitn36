<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Playlists</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Playlists
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
                                        Playlist
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allplaylists))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Title</th>

                                                        <th>Playlist Url</th>




                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allplaylists as $playlist)
                                                    {
                                                        ?>
                                                        <tr>


                                                            <td><?php echo $playlist['title']; ?></td>




                                                            <td style="word-break: break-word;"><?php echo $playlist['play_list_url'] ?></td>
                                                            <td>
                                                                <a href="<?php echo base_url() ?>index.php/playlist/edit/<?php echo $playlist['id'] ?>" class="btn btn-info" >Edit</a><br/><br/>
                                                                <button type="button" class="btn btn-danger" onclick="del_playlist(<?php echo $playlist['id'] ?>)">Delete</button>
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