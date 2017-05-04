<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>LarkData - Alouette-I Search Results</title>

        <link href="main.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,400" rel="stylesheet">
        <link type='text/css' rel='stylesheet' href='font-awesome-4.7.0/css/font-awesome.min.css'>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>

        <?php
        date_default_timezone_set('UTC');

        // Handle the GET requests coming in from the "Search" Button whose action is this .php file
        //Satellite, Start, Start-h, Start-m, Start-s, End, End-h, End-m, End-s, Station
        $satellite = $_GET['Satellite'];
        $start_date = $_GET['Start'];
        $start_hourss = $_GET['Start-h'];
        $start_minutes = $_GET['Start-m'];
        $start_seconds = $_GET['Start-s'];
        $end_date = $_GET['End'];
        $end_hours = $_GET['End-h'];
        $end_minutes = $_GET['End-m'];
        $end_seconds = $_GET['End-s'];
        $station = $_GET['Station'];
        // Connection to DB established
        $conn_string = "host=stampy.db.elephantsql.com port=5432 dbname=zhjpaedv user=zhjpaedv password=jOYJDGLm_N4shJbNph2p27W6WH_RD0Cv";
        $dbconn4 = pg_connect($conn_string);

        // Create empty array for args
        $select_args = array();
        // Join the tables of the station location and the sampledata_final
        $select_query = 'SELECT * FROM sampledata_final, station_location WHERE sampledata_final.station = station_location.id';
        $args_num = 0;
        // Create the timestamp based off of the variables above and using sprintf
        $start_timestamp = $start_date . " " . $start_hourss . ":" . $start_minutes . ":" . $start_seconds . "+00";
        $end_timestamp = $end_date . " " . $end_hours . ":" . $end_minutes . ":" . $end_seconds . "+00";
        // Check for the time contraints taken in through $_GET[]
        // (If the user does not choose aspects such as hours, minutes, or seconds, they will default to the value of "00")
        $bool1 = isset($start_date);
        $bool2 = isset($start_hourss);
        $bool3 = isset($start_minutes);
        $bool4 = isset($start_seconds);
        $bool5 = isset($end_date);
        $bool6 = isset($end_hours);
        $bool7 = isset($end_minutes);
        $bool8 = isset($end_seconds);


        if ($bool1 and $bool2 and $bool3 and $bool4 and $bool5 and $bool6 and $bool7 and $bool8){
          // Handle Start Timestamp
          // Increase by 2, One for reach timestamp involved
          $args_num += 1;
          $select_query .= sprintf(" AND sampledata_final.image_time BETWEEN $%d", $args_num);
          // Handle End Timestamp
          $args_num += 1;
          $select_query .= sprintf(" AND $%d", $args_num);
          // Push the timestamps into the array as arguments
          array_push($select_args, $start_timestamp, $end_timestamp);
          //$select_query .= " AND sampledata_final.image_time BETWEEN %s and %s";
          //echo sprintf($select_query, $start_timestamp, $end_timestamp);
          //echo $select_query;
          //echo '\n';
        }
        //echo $select_query;

        // Check if the Satellite number exists taken through $_GET[]
        if (isset($satellite) and !($satellite == 99)){
          $args_num += 1;
          $select_query .= sprintf(" AND sampledata_final.satellite = $%d", $args_num);
          array_push($select_args, $satellite);
        }

        // Check if the Station number is taken in through $_GET[]
        if (isset($station) and !($station == 99)){
          $args_num += 1;
          $select_query .= sprintf(" AND sampledata_final.station = $%d", $args_num);
          array_push($select_args, $station);
        }


        // Add a Semicolon to the Query to signify end of line within Query
        $select_query .= ";";
        // Prepare the PostGreSQL Query
        $select_prepare = pg_prepare($dbconn4, "select_query", $select_query);
        // Execute the SQL Query
        $select_execute = pg_execute($dbconn4, "select_query", $select_args);

        // String Format for rows
        // Name, Satallite, Time, Station, View, Download
        $format = "<ul class='column'>
                    <li>%s</li>
                    <li>%s</li>
                    <li>%s</li>
                    <li>%s</li>
                    <li><a href='/item.php?%s'>View</a></li>
                    <li><a href='ftp://ftp.asc-csa.gc.ca/users/OpenData_DonneesOuvertes/pub/AlouetteData/%s'>Download</a></li>
                </ul>";

        // $rows is an array of arrays
        // The array's array would have [name, sat, time, view, down]
        $result_db = pg_fetch_all($select_execute);
        $stop = count($result_db);
        function results($rows, $format, $stop) {
            for ($i = 0; $i < $stop; $i++) {
                $down = sprintf('%s/I%s', $rows[$i]['roll_num'], substr($rows[$i]['filename'], 1));
                $name = sprintf('%s-I%s', $rows[$i]['roll_num'], substr($rows[$i]['filename'], 1));
                $view = 'Name=' . $name . '&Download=' . $down . '&Satellite=' . $rows[$i]['satellite'] . '&Time=' . $rows[$i]['image_time'] . '&Station=' . $rows[$i]['location'];
                echo sprintf($format, $name, 'Alouette-I', $rows[$i]['image_time'], $rows[$i]['location'], $view, $down);
            }
        }
        ?>

    </head>
    <body>
        <header style='position: relative; height: 50px;'>
            <div class='image' style='background-image: url(src/csa_logo.png); padding: 20px; position: absolute; left: 20px;'></div>
            <div style='color: white; z-index: 1;'>
                <h3 style='letter-spacing: 1px;'>LarkData - Alouette I Search Tool</h3>
            </div>
        </header>
        <section style='display: flex; align-items: flex-start;padding: 10px 30px;'>
            <div style='display: flex; width: 100%; align-items: center;'>
                <div class='arrow-left'></div>
                <h5 onclick='goBack()' style='color: #154187; padding-left: 6px;'>Back to Result</h5>
            </div>
        </section>
        <section style='padding: 10px 60px;'>
            <div style='width: 100%; font-size: 9px; margin-bottom: 3px;'>
                <p id='info'>Search result found <?php echo $stop; ?> from
                    <?php echo $start_timestamp. ' to ' . $end_timestamp . ' at ' . $station . ' by Aluoette-I.'; ?>
                </p>
            </div>
            <div class='table'>
                <ul class='column-head'>
                    <li style='margin-right: 46px;'>Image Name</li>
                    <li style='margin-right: 22px;'>Satellite</li>
                    <li style='margin-right: 124px;'>Time</li>
                    <li>Station</li>
                    <li>View</li>
                    <li>Download</li>
                </ul>
                <hr size='3px' style='background-color: lightgrey; border: none; margin-top: 4px; margin-bottom: 10px;'>
                <!-- add someting like this: CHANGER THIS BACKKKKKK!!! add php tag echo //results($result_db) -->

                <?php results($result_db, $format, $stop); ?>



                <hr size='3px' style='background-color: lightgrey; border: none; margin-top: 4px; margin-bottom: 10px;'>


            </div>
            <p style='color: gray; font-size: 10px;'>Powered by LarkData.space</p>
        </section>
    </body>
</html>
