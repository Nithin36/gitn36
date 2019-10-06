<div id="page-wrapper">

    <div class="row">
        <!-- Page Header -->
        <div class="col-lg-12">
            <h1 class="page-header">Payment Details</h1>
        </div>
        <!--End Page Header -->



        <div class="row">
            <div class="col-lg-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Payment Details
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
                                        Payment Details
                                    </div>

                                    <div class="panel-body">
<div class="row">
                                        <div class="col-lg-4">
                                            <form role="form" action= "<?php echo base_url(); ?>index.php/paylog/searchlist" method="post">
                                                <div class="form-group">
                                                    <label>User</label>
                                                    <input type="text" name="name" value=" " class="form-control">

                                                </div>








                                                <input type="submit" class="btn btn-primary" value="Search" />
<?php if($this->router->fetch_method()=="searchlist") { ?>
    <a href="<?php echo base_url(); ?>index.php/paylog/paylog_list">List all payment Details</a>
    <?php
}
                                                ?>

                                            </form>
                                        </div>
                                        <div class="col-lg-8">

                                        </div>
</div>
<br/>
                                        <?php

                                        if(!empty($allpaylogs))
                                        {
                                            ?>

                                            <div class="table-responsive ">
                                                <table class="table table-condensed table-bordered">
                                                    <thead>
                                                    <tr>

                                                        <th>Course Details</th>

                                                        <th>User Details</th>
                                                        <th>Amount</th>
                                                        <th>Date</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach ($allpaylogs as $paylog)
                                                    {
                                                        ?>
                                                        <tr>

                                                            <td>&nbsp;<table>
                                                                    <tr><td>Course Name</td><td>:</td><td><?php echo $paylog['coursename']; ?></td></tr>
                                                                    <tr><td>Plan</td><td>:</td><td><?php echo $paylog['planname']; ?></td></tr>
                                                                    <tr><td>Course Type</td><td>:</td><td><?php if($paylog['coursestatus']==0) echo "Offline"; else echo "Online"; ?></td></tr>

                                                                </table>


                                                            </td>


                                                            <td>&nbsp;<table>
                                                                    <tr><td>User</td><td>:</td><td><?php echo $paylog['username']; ?></td></tr>
                                                                    <tr><td>Email</td><td>:</td><td><?php echo $paylog['email']; ?></td></tr>
                                                                    <tr><td>Contact Number</td><td>:</td><td><?php echo $paylog['mobno']; ?></td></tr>

                                                                </table>


                                                            </td>
                                                            <td>
                                                                <?php echo $paylog['amount'];?>
                                                            </td>
                                                            <td>
                                                                <?php echo $paylog['paydate'];?>
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