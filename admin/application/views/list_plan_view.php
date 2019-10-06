<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Plans</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Plans
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

                                        if(!empty($allplans))
                                        {
                                            ?>
                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Name</th>

                                                        <th>Price</th>
                                                        <th>No Of Days</th>


                                                        <th>Actions</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allplans as $plan)
                                                    {
                                                        ?>
                                                        <tr>

                                                            <td>&nbsp;
                                                                <?php echo $plan['name'];?>


                                                            </td>


                                                            <td><?php echo $plan['price'];?></td>
                                                            <td>
                                                                <?php echo $plan['noofdays'];?>
                                                            </td>



                                                            <td>
                                                                <a  class="btn btn-danger" href="<?php echo base_url() ?>index.php/plan/edit/<?php echo $plan['id'] ?>" >Edit</a>
                                                                <button type="button" class="btn btn-danger" onclick="del_plan(<?php echo $plan['id'] ?>)">Delete</button>

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