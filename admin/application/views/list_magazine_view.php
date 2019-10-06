        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header">Magazines</h1>
                </div>
                <!--End Page Header -->



                           <div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            List Magazines
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
                            Magazines
                        </div>
                        <div class="panel-body">
                            <?php
    
if(!empty($allmagazines))
{
    ?>
                            <div class="table-responsive ">
                                <table class="table table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                           
                                            <th>Magazine Description</th>
                                          <!--   <th>Title</th>
                                            <th>Productid</th> -->
                                            <th>CoverPhoto</th>
                                          <th>MagazineFile</th> 
                                             <th>PreviewFile</th> 
                                             <!-- <th>Date</th>  -->
                                             <th>Price</th> 
                                             
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                       
                                        foreach ($allmagazines as $magazine)
{
?>
                                        <tr>
                                           
                                            <td>Category&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $magazine['cname']; ?><br/>
                                                Title&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $magazine['title']; ?><br/>
                                                ProductId&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo $magazine['product_id']; ?><br/>
                                                Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp; <?php echo $magazine['date']; ?>

                                            </td>
                                           
                                           
                                            <td><img src="<?php echo COVERPHOTO_URL.$magazine['cover_image'] ?>" height="50" width="50"/></td>
                                          <td><a target="_blank" href="<?php echo MAGAZINE_URL.$magazine['magazine_file'] ?>"><?php echo ellipsize($magazine['magazine_file'],20,.5); ?></a></td>
                                            <td><a target="_blank" href="<?php echo PREVIEW_URL.$magazine['preview_file'] ?>"><?php echo ellipsize($magazine['preview_file'],20,.5); ?></a></td>
                                          <!--   <td><?php echo $magazine['date'] ?></td> -->
                                            <td><?php echo $magazine['price_inr'] ?>(INR) <br/><?php echo $magazine['price_dollar'] ?>(DOLLAR)</td>
                                            
                                         <td><button type="button" class="btn btn-danger" onclick="del_mag(<?php echo $magazine['id'] ?>)">Delete</button></td>
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