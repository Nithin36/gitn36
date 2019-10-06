<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Channels</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Channels
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
                                        Channels
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allchannels))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Channel No</th>
                                                        <th>Channel Title</th>
                                                        <th>CoverPhoto</th>
                                                        <th>Live Tv Url</th>
                                                        <th>Youtube Channel Url</th>



                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allchannels as $channel)
                                                    {
                                                        ?>
                                                        <tr>

                                                            <td><?php echo $channel['channelno']; ?></td>
                                                            <td><?php echo $channel['name']; ?></td>

                                                            <td>
                                                                <?php
                                                                if(trim($channel['image'])!="") {
                                                                    ?>

                                                                    <img
                                                                        src="<?php echo CHANNEL_URL.$channel['image']; ?>"
                                                                        height="50" width="50"/>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    echo "No Image";
                                                                }
                                                                ?>
                                                            </td>

                                                             <td style="word-break: break-word;"><?php echo $channel['videourl'] ?></td>
                                                            <td style="word-break: break-word;"><?php echo $channel['channelurl'] ?></td>
                                                            <td>
                                                                <a href="<?php echo base_url() ?>index.php/channel/edit/<?php echo $channel['id'] ?>" class="btn btn-info" >Edit</a><br/><br/>
                                                                <button type="button" class="btn btn-danger" onclick="del_channel(<?php echo $channel['id'] ?>)">Delete</button>
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