<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
</head>

    <script>
     changePage();
        function changePage(){
            var newUrl = "/phpgryplanszowe/php/homePage.php"
            document.location.href = newUrl;
        }
    </script>

</html>

