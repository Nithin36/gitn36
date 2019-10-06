 <!-- navbar side -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">


                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                         <!--    <div class="user-section-inner">
                                <img src=<?php echo base_url(); ?>assets/img/user.jpg" alt="">
                            </div> -->
                            <div class="user-info">
                                <div></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>Category<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/category/add">Add Category</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/category/cat_list">List Categories</a>
                            </li>

                        </ul>
                        <!-- second-level-items -->
                    </li>
                    
                              <li>
                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>Faq<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/faq/add">Add Faq</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/faq/faq_list">List Faq</a>
                            </li>

                        </ul>
                        <!-- second-level-items -->
                    </li>
<!--                    <li>-->
<!--                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>Albums<span class="fa arrow"></span></a>-->
<!--                        <ul class="nav nav-second-level">-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url(); ?><!--index.php/album/add">Add Album</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url(); ?><!--index.php/album/album_list">List Albums</a>-->
<!--                            </li>-->
<!---->
<!--                        </ul>-->
<!--                        second-level-items -->
<!--                    </li>-->
<!---->
<!---->
<!--                    <li>-->
<!--                        <a href="#"><i class="fa fa-circle-o fa-fw"></i>Audios<span class="fa arrow"></span></a>-->
<!--                        <ul class="nav nav-second-level">-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url(); ?><!--index.php/audio/add">Add Audio</a>-->
<!--                            </li>-->
<!--                            <li>-->
<!--                                <a href="--><?php //echo base_url(); ?><!--index.php/audio/audio_list">List Audios</a>-->
<!--                            </li>-->
<!---->
<!--                        </ul>-->
<!--                        <!-- second-level-items -->-->
<!--                    </li>-->


               <li>
                        <a href="<?php echo base_url(); ?>index.php/admin/logout"><i class="fa fa-sign-in fa-fw"></i>LogOut</a>
                    </li>
                </ul>
                <!-- end side-menu -->
            </div>
            <!-- end sidebar-collapse -->
        </nav>