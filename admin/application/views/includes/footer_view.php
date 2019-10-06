 <!-- end wrapper -->
</div>
    <!-- Core Scripts - Include with every page -->
 
    <!--   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script> -->
     <script src="<?php echo base_url(); ?>assets/scripts/datepicker.js"></script>
       <script>
    $(function() {
      $('[data-toggle="datepicker"]').datepicker({
        autoHide: true,
        zIndex: 2048,
        format: 'yyyy-mm-dd'
      });
    });
  </script>
    <script type="text/javascript">  
function del_plan( id)
{
	
	  var dataString ={ id: id};
	$.ajax({
type: "POST",
url: "<?php echo base_url(); ?>index.php/plan/delete",
data: dataString,
success: function (data) {
var json = $.parseJSON(data);
if(json.status==1)
{
	 location.reload();
$("#status").html('<div class="alert alert-info alert-dismissable"> SucessFully Deleted <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
}
else
{
$("#status").html('<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
}
}
,
error: function() 
{
}
});
    
}


function sel_album( id)
{
var seloption='<option value="">loading..</option>';
    $('#selalbum').html(seloption);
    var dataString ={ id: id};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/album/select_album",
        data: dataString,
        success: function (data) {
       $('#selalbum').html(data);
        }
        ,
        error: function()
        {
        }
    });

}
function del_aud( id)
{

    var dataString ={ id: id};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/audio/delete",
        data: dataString,
        success: function (data) {
            var json = $.parseJSON(data);
            if(json.status==1)
            {
                location.reload();
                $("#status").html('<div class="alert alert-info alert-dismissable"> SucessFully Deleted <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
            else
            {
                $("#status").html('<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        }
        ,
        error: function()
        {
        }
    });

}

function del_alb( id)
{

    var dataString ={ id: id};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/album/delete",
        data: dataString,
        success: function (data) {
            var json = $.parseJSON(data);
            if(json.status==1)
            {
                location.reload();
                $("#status").html('<div class="alert alert-info alert-dismissable"> SucessFully Deleted <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
            else
            {
                $("#status").html('<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        }
        ,
        error: function()
        {
        }
    });

}
function del_cat( id)
{

    var dataString ={ id: id};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/category/delete",
        data: dataString,
        success: function (data) {
            var json = $.parseJSON(data);
            if(json.status==1)
            {
                location.reload();
                $("#status").html('<div class="alert alert-info alert-dismissable"> SucessFully Deleted <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
            else
            {
                $("#status").html('<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        }
        ,
        error: function()
        {
        }
    });

}

function del_channel( id)
{

    var dataString ={ id: id};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/channel/delete",
        data: dataString,
        success: function (data) {
            var json = $.parseJSON(data);
            if(json.status==1)
            {
                location.reload();
                $("#status").html('<div class="alert alert-info alert-dismissable"> SucessFully Deleted <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
            else
            {
                $("#status").html('<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        }
        ,
        error: function()
        {
        }
    });

}

function del_playlist( id)
{

    var dataString ={ id: id};
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/playlist/delete",
        data: dataString,
        success: function (data) {
            var json = $.parseJSON(data);
            if(json.status==1)
            {
                location.reload();
                $("#status").html('<div class="alert alert-info alert-dismissable"> SucessFully Deleted <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
            else
            {
                $("#status").html('<div class="alert alert-warning alert-dismissable"> Something Wrong.. <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>');
            }
        }
        ,
        error: function()
        {
        }
    });

}


</script>
</body>

</html>
