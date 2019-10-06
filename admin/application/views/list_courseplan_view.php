<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header"><?php if($course['online']==1) { ?> Online Course<?php } else { ?> Offline Course<?php } ?></h1>
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
                        <h4>List Plans</h4>
                        <div class="tooltip-demo">
                            <a  href="<?php echo base_url() ?>index.php/courseplan/add/<?php echo $course['id'] ?>" class="btn btn-default" >Add plan</a>
                            <a href="<?php echo base_url() ?>index.php/courseplan/courseplan_list/<?php echo $course['id'] ?>" class="btn btn-default" >List plans</a>
                            <a href="<?php echo base_url(); ?>index.php/course/<?php if($course['online']==1) { ?>onlinecourse_list<?php } else { ?>offlinecourse_list<?php } ?>" class="btn btn-default" >Back To <?php if($course['online']==1) { ?> Online Course<?php } else { ?> Offline Course<?php } ?></a>

                        </div>

                    </div>
                </div>
                <!--End  Tooltips and Popovers-->
            </div>
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $course['name'] ?> >> List courseplans
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
                                       Plans
                                    </div>
                                    <div class="panel-body">
                                        <?php

                                        if(!empty($allcourseplans))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Name</th>

                                                        <th>Price</th>
                                                        <th>No of days</th>



                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allcourseplans as $courseplan)
                                                    {
                                                        ?>
                                                        <tr>

                                                            <td>&nbsp;
                                                                <?php echo $courseplan['name'];?>


                                                            </td>
                                                            <td>&nbsp;
                                                                <?php echo $courseplan['price'];?>


                                                            </td>

                                                            <td>&nbsp;
                                                                <?php echo $courseplan['noofdays'];?>


                                                            </td>






                                                            <td>
                                                                <a  class="btn btn-danger" href="<?php echo base_url() ?>index.php/courseplan/edit/<?php echo $courseplan['id'] ?>" >Edit</a>
                                                                <button type="button" class="btn btn-danger" onclick="del_courseplan(<?php echo $courseplan['id'] ?>)">Delete</button>

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