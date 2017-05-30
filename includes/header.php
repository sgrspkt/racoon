<?php
$baseUrl = str_replace("index.php", "", $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!--	 <meta http-equiv="refresh" content="30"> -->
    <meta name="keywords" content="HTML, CSS, XML, JSON, JAVA SCRIPT">
    <meta name="description" content="Review of Bird">
    <meta name="author" content="Replace with ur name">
    <title>Birds Review</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <script>
        var baseUrl = "<?php echo $baseUrl ?>";
    </script>
    <script>

        function TimedRefresh( t ) {
//            setTimeout("location.reload(true);", t);
        }

        $(document).ready(function () {
            $(document).on('click', '#reload-home', function() {
                $("header").remove();
                $(".main-item").remove();
                window.location=baseUrl;
                // contentType: "application/json; charset=utf-8",

                //     $.ajax({
                //         url: "http://localhost/Birds/home",
                //         success: function (result) {
                            
                //             $(".main-item2").html(result);
                //         }
                //     });
            });

        });


    </script>
</head>

<body onload="JavaScript:TimedRefresh(30000)">
<section class="main-item2"></section>