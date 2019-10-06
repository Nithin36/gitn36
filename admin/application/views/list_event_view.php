<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Events</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Events
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
                                        Events
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allevents))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Title</th>
                                                        <th>CoverPhoto</th>




                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allevents as $event)
                                                    {
                                                        ?>
                                                        <tr>


                                                            <td><?php echo $event['title']; ?></td>

                                                            <td>
                                                                <?php
                                                                if(trim($event['photo'])!="") {
                                                                    ?>

                                                                    <img
                                                                        src="<?php echo EVENT_URL.$event['photo']; ?>"
                                                                        height="50" width="50"/>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    echo "No Image";
                                                                }
                                                                ?>
                                                            </td>


                                                            <td>
                                                                <a href="<?php echo base_url() ?>index.php/event/edit/<?php echo $event['id'] ?>" class="btn btn-danger" >Edit</a>
                                                                <button type="button" class="btn btn-danger" onclick="del_event(<?php echo $event['id'] ?>)">Delete</button>
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