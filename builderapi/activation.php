<?php
if((isset($_GET['actid']))&&($_GET['actid']!=""))
{

    header('Location:http://builder.floatalbums.com/activate-account/'.$_GET['actid']);
}
else
{
    echo "invalid id";
}