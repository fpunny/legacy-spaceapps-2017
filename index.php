<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Aluoette I - Search</title>

    <link href="main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:200,200i,400" rel="stylesheet">
</head>

<body>
    <header style='position: relative; height: 100px;'>
        <div class='image' style='background-image: url(src/csa_logo.png); padding: 32px; position: absolute; left: 20px;'></div>
        <div style='color: white; z-index: 1;'>
            <h2 style='letter-spacing: 1px; text-shadow: 0px 0px 8px black, 0px 0px 10px black, 0px 0px 10px black;'>Alouette-I Ionogram Search Tool</h2>
        </div>
    </header>
    <section>
        <h2>Search Alouette-I images</h2>
        <h4 style='position: relative; top: -4px;'>Ionograms from 1962 - 1972</h4>
        <br>
        <div>
            <div style='display: flex;'>
                <div class='tool single'>
                    <h4>Satelite</h4>
                    <select style='padding: 8px 12px; border: 1px solid #E0D8DE;'>
                            <option value='' disabled selected>Satelite
                            </option>
                            <option value='00'>All Satelites</option>
                            <option value='01'>01 - Alouette I</option>
                        </select>
                </div>
                <div class='tool single' style='margin-left: 5px;'>
                    <h4>Station</h4>
                    <select style='padding: 8px 12px; border: 1px solid #E0D8DE;'>
                            <option value='' disabled selected>Select Station</option>
                            <option value='00'>All Stations</option>
                            <option value='01'>01 - Resolute Bay, NWT</option>
                            <option value='02'>02 - Prince Albert, AB</option>
                            <option value='03'>03 - Ottawa, ON</option>
                            <option value='04'>04 - St John's, NL</option>
                            <option value='05'>05 - Fairbanks, AK, USA</option>
                            <option value='06'>06 - Fort Myers. FL. USA</option>
                            <option value='07'>07 - Quito, Ecuador</option>
                            <option value='08'>08 - Antofagasta, Chile</option>
                            <option value='09'>09 - Falkland Island, UK</option>
                            <option value='10'>10 - Winkfield, UK</option>
                            <option value='11'>11 - Singapore, Malaysia</option>
                            <option value='12'>12 - Woomera, Australia</option>
                            <option value='13'>13 - Grand Forks, MN, USA</option>
                            <option value='14'>14 - Blossom Point, HI, USA</option>
                            <option value='15'>15 - South Point, HI, USA</option>
                            <option value='16'>16 - Johannesburg, South Africa</option>
                            <option value='17'>17 - Mojava, CA, USA</option>
                            <option value='18'>18 - Winkfield, UK 2</option>
                            <option value='19'>19 - Fairbanks, AK, USA 2</option>
                            <option value='20'>20 - Rosman, NC, USA</option>
                        </select>
                </div>
            </div>
            <div class='tool' style='display: flex; flex-wrap: wrap;'>
                <div>
                    <h4>Start Time</h4>
                    <div style='display: flex;'>
                        <input type='text' placeholder='Year / Day of Year' style='padding: 8px 10px; border: 1px solid #E0D8DE; margin-right: 5px;'>
                        <input type='text' placeholder='Hour : Min' size='8px' style='padding: 8px 10px; border: 1px solid #E0D8DE;'>
                    </div>
                </div>
                <hr width='8px;' style='background-color: black; border: 1px solid black; margin: 17px 5px;'>
                <div>
                    <h4>End Time</h4>
                    <div style='display: flex;'>
                        <input type='text' placeholder='Year / Day of Year' style='padding: 8px 10px; border: 1px solid #E0D8DE; margin-right: 5px;'>
                        <input type='text' placeholder='Hour : Min' size='8px' style='padding: 8px 10px; border: 1px solid #E0D8DE;'>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class='search' style='padding: 10px 70px;'>
            <h5>Search</h5>
        </div>
    </section>
</body>

</html>