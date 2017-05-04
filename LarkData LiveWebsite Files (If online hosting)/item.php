<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <link href="main.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,400" rel="stylesheet">
        <link type='text/css' rel='stylesheet' href='font-awesome-4.7.0/css/font-awesome.min.css'>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <?php
        $name = $_GET['Name'];
        $link = $_GET['Download'];
        $sat = $_GET['Satellite'];
        $time = $_GET['Time'];
        $station = $_GET['Station'];


        // The path to image
        $picture = 'img/' . substr($link, 0, -4) .".jpg";

        // Name of Image (50X-Image0XXX)
        $name = substr($name, 0, -4);

        // Name of Satellite
        if ($sat == 1) {
          $sat = 'Alouette-I';
        }

        // ftp://ftp.asc-csa.gc.ca/users/OpenData_DonneesOuvertes/pub/AlouetteData/500/Image0XXX.tif

        ?>
        <title>LarkData - Alouette I <?php echo $name; ?></title>

    </head>
    <body>
        <header style='position: relative; height: 50px;'>
            <div class='image' style='background-image: url(src/csa_logo.png); padding: 20px; position: absolute; left: 20px;'></div>
            <div style='color: white; z-index: 1;'>
                <h3 style='letter-spacing: 1px;'>LarkData - Alouette-I Search Tool</h3>
            </div>
        </header>
        <section style='padding: 30px 50px;'>
            <div style='display: flex; width: 100%; margin-bottom: 20px; align-items: center;'>
                <div class='arrow-left'></div>
                <h5 onclick='goBack()' style='color: #154187; padding-left: 6px;'>Back to Result</h5>
            </div>
            <div style='display: flex; flex-wrap: wrap; justify-content: center;'>
                <div class='item' style='background-image: url("<?php echo $picture; ?>");'></div>
                <div style='padding: 4px 0px; width: 240px;'>
                    <h3>
                        <?php echo $name; ?>
                    </h3>
                    <form action='<?php echo 'ftp://ftp.asc-csa.gc.ca/users/OpenData_DonneesOuvertes/pub/AlouetteData/' . $link; ?>'>
                        <input type='submit' value='Download' class='search' style='padding: 6px 30px; border: none; margin: 12px 0px;'>
                    </form>
                    <div style='display: flex;'>
                        <ul class='row-head'>
                            <li>Satellite</li>
                            <li>Time</li>
                            <li>Station</li>
                        </ul>
                        <ul class='row'>
                            <li><?php echo $sat; ?></li>
                            <li><?php echo $time; ?></li>
                            <li><?php echo $station; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
