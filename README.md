<h1 align="center">LarkData</h1>
<h2 align="center">Alouette-I Ionogram Search Engine and Custom Ionogram Image Metadata Processing Algorithms</h2>
<h4 align="center">Spaceapps Toronto 2017 Hackathon</br>
CSA Challenge #1: "Be part of Canada's legacy in space!"</h4>

<div align="center"><a href="http://larkdata.space/"><img src ="http://i.imgur.com/VSdbx3U.jpg" /></a></div>

# Quick Links:
1. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#why-larkdata">Why "LarkData?"</a></br>
2. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#what-the-challenge-was">What the Challenge Was</a></br>
3. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#what-our-solution-does-and-how-it-answers-the-challenge">What Our Solution Does and how it Answers the Challenge</a></br>
4. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#target-audience">Target Audience</a></br>
5. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#video-demonstration-of-our-project-at-work-website-tool-and-python-algorithms">Video Demonstration of our Project at Work (Website Tool and Python Algorithms)</a></br>
6. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#why-was-our-published-project-focused-only-on-a-smaller-sample-of-data">Why was our Published Project focused only on a smaller sample of data?</a></br>
7. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#how-we-built-it">How we Built it</a></br>
8. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#challenges-we-faced-as-a-team">Challenges we Faced as a Team</a></br>
9. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#languagestools-used">Languages/Tools Used</a></br>
10. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#links-to-live-website">Links to Live Website</a></br>
11. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#video-of-our-presentation-at-spaceapps-toronto-2017">Video of Our Presentation at SpaceApps Toronto 2017</a></br>
12. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#team-members-credits">Team Members (Credits)</a></br>
13. <a href="https://github.com/ismailmohammad/legacy-spaceapps-2017#how-to-navigate-this-repository-additional-information">How to Navigate this Repository (Additional Information)</a></br>

## Why "LarkData"?
We chose to name our project with a tribute to the original naming of the satellite which was "Alouette-I". Alouette as we know it, is French for the word Lark, which is a small songbird combined with the idea of parsing through useful data that can be used towards further research and appreciation of what the satellite did. Hence, the ideal name of LarkData for our project.

## What the Challenge Was:
<a href="http://www.asc-csa.gc.ca/eng/events/2017/space-apps-csa-challenges.asp#alouette">Source: CSA Space Apps 2017 Challenges</a></br>
"**Your challenge?** Go back in time and create a tool that will decipher the numeric and the Binary Digital Coding (BDC) used in 1963. Your tool will help manage the thousands of ionosphere images recently scanned by the CSA."</br>
**How would a tool to manage the Alouette-I images be helpful?**</br>
"The 450 digitalized film rolls offer thousands of images. Without a tool to manage them, it is difficult to efficiently use the data because it is nearly impossible to carry out effective searches."</br>
**What type of application or tool would be appropriate?**</br>
"The challenge is not to interpret the ionogram images but to read and interpret the metadata found in each one. Once this information is **electronically recognized, it could be integrated in a database**. A tool could then use this database to manage the information by allowing searches according to specific criteria such as the receiving station facility, date, etc."</br>

## What Our Solution Does and how it Answers the Challenge:

LarkData is a tool which takes thousands of Ionogram images scanned by the Canadian Space Agency to read and interpret the metadata found in each image. This tool deciphers the numeric and Binary Digital Coding use in 1963.The metadata information is integrated into a database which manages the information by allowing searches according to specific criteria. This criteria includes Station Facility, Start Date/Time, and End Date/Time. The time taken in as an input is within the UTC (Coordinated Universal Time) time format as are the results displayed.

## Target Audience:
Something to stress here is the target audience for our tool. The CSA challenge page mentioned that "without a tool to manage this huge collection of data, it is nearly impossible to carry out effective searches". What this indicates is that there is a need for such a tool to parse the information. Moreover, carrying out effective searches is what would assist researchers and scientists to decipher trends within the different time periods for the ionosphere and even focus in on specific times of a single day even. If the Alouette-II also used Binary Digital Coding (BDC), then this tool could further be extended into the images captured by that satellite. The general public and enthusiasts could also utilize our tool, however the emphasis would be on research and scientists who would be able to sift through the huge amounts of data and make observations and comparisons perhaps with the current day ionosphere and notice the trends over time.

## Video Demonstration of our Project at Work (Website Tool and Python Algorithms):
[![LarkData Demo](http://i.imgur.com/dqewRvL.png)](https://www.youtube.com/watch?v=LWgXa3Rc61c "LarkData Demo")

## Why was our Published Project focused only on a smaller sample of data?
This is an important question to answer as one needs to gain insight on the colossal size of the data at hand to understand our decision. With each image coming in at roughly 30-40 MB and having a total of 3000 images in the dataset provided, this would lead to an average of 90,000 MB (90 GB) to 120,000 (120 GB) worth of data. Limited by network bandwidth and (possibly server bandwidth),it was not plausible to download the entire cache of 3000 Ionograms and parse them all. We do hope to one day be able to compile all the data into a grand database to assist the researchers/scientists. Moreover, we had the opportunity to speak to representatives of the CSA at the hackathon who assured us that other than these sample rolls, there is much more where this came from, we're talking thousands and thousands of more images. As a result, we feel our tool would be most effective with local access to the data as opposed to over the internet with respect to classifying all the images. Once the database is created, the online tool can be used by anyone to access this data.

## How we Built it:

The webpage was first designed by the designers on our team to ensure proper aesthetics and a simple yet eye-pleasing design. The wireframe of this was then moved forward to the front-end developers who coded the webpage using HTML5 and CSS3. At the same time, the back-end developers were divided into two separate teams. The first team worked on developing a program using Python to decipher, read and interpret the metadata found in each image. OCR (Optical Character Recognition) was initially considered however would prove difficult to turn into a standard solution considering the Binary Digital Coding data. They then coded for a Python Algorithm to convert the parsed metadata into a CSV format. The second team set up the PostgreSQL database initially using the files included within the "Sample Data Sets" directory of this repository. The team then  This was used so, when the data entered into the HTML form was submitted based on the users inputted data and applies the filters on the data set and gives the users a refined table of search results with the option to view an smaller image or download the image. The filters of the data set was made using PHP while the data is being stored in a PostgreSQL database that was accessed using the php_pgsql extensions and its relevant functions such as pg_connect() and so forth.

## Challenges we Faced as a Team:

We ran into many challenges throughout this hackathon. The first challenge which we ran into was getting a Calendar/date-time picker built into the webpage for a easier selection of the date and time. We first tried this using JavaScript and jQuery but, without any luck we had to revert to basic HTML Calendar view. We spent many hours getting this to work as the time had to be down to the second as many of the Ionogram images had the exact hour and minute and were only a couple of seconds apart. If the date/time picker was not cut down to the second, the search result would yield not just one image but more images. Another challenge we faced was learning PostgreSQL and PHP within a span of 2 hours and applying it to the program. This was a major challenge for us as we did not know how to fix and go about with the errors that show up throughout the program. We spent countless hours on this part, but eventually, we got the entire webpage to work. This included a big crunch to get things working again when a simple naming error broke the PHP code. Shoutout to Jim Rootham for extending his experience and expertise within the industry and assisting us in learning new languages and concepts. Specifically, without each and every individual member of our team, this would not have been possible with the time constraints that were in place for such an ambitious challenge that we chose to take on.

## Languages/Tools Used:
* Python</br>
* PostgreSQL</br>
* PHP 5</br>
* HTML 5</br>
* CSS3</br>

## Links to Live Website:
http://larkdata.space<br />
http://lark-data.space<br />
http://larkdata.heliohost.org<br />

## Video of Our Presentation at SpaceApps Toronto 2017
[![SpaceApps Toronto 2017 Presentations](http://i.imgur.com/wxEdpt9.png)](https://www.youtube.com/watch?v=U5yd2ZN50Yk&feature=youtu.be&t=1h31m35s "SpaceApps Toronto 2017 Presentations")

## Team Members (Credits):
* Ali Karamali</br>
* Amy Yi</br>
* Erin Hong</br>
* Frederic Pun <a href="https://github.com/fpunny">@fpunny</a></br>
* Huanning Wang</br>
* Jim Rootham <a href="https://github.com/jrootham">@jrootham</a></br>
* Karlille John <a href="https://github.com/KarlilleJohn">@KarlilleJohn</a></br>
* Michelle Villar</br>
* Mohammad Ismail <a href="https://github.com/ismailmohammad">@ismailmohammad</a></br>
* Patrick Ocampo</br>
* Prashant Patel <a href="https://github.com/prasvpatel">@prasvpatel</a></br>
* Sameed Sohani <a href="https://github.com/asonance">@asonance</a></br>

## How to Navigate this Repository (Additional Information):
This repository is divided up into the various components that are required to either replicate the project we have created locally or to be hosted online. Below is a guide to uncomplicate perhaps the somewhat complicated but explanatory directories.

#### LarkData Hackathon Localhost Files:
This directory contains the original files from the demo used at the Space Apps Toronto 2017 Hackathon, including the obsolete and/or unnecessary files to maintain the integrity of the project files and display them as we had it at the time of the deadline. If needed to recreate this, please place the files within this directory within the XAMPP htdocs or the general root location of your local server.

#### LarkData LiveWebsite Files:
This directory within the repo contains the actual required files needed to host our project online along with its coded sample PostgreSQL database hosted on ElephantSQL. The code within result.php can be modified with your own database credentials. The files within this directory is also a revamp of the Weekend project with an updated header. The site at the moment is intended for Desktop users, considering our target audience. Also another change within this source code is that the images within the img folder have been compressed into .JPG format, bringing down the entire size of the directory to about ~30 MB allowing for quick viewing of images with the option to download the full resolution TIFF images (roughly 30-40 MB each) from the offical ftp Server.

#### PHP Extensions to Ensure Enabled:
This is regarding if website is hosted locally, or if online and you have full control of your server. This directory contains is the instructions to enable the PHP extensions php_pdo_pgsql.dll and php_pgsql.dll enabling PHP support for PostgreSQL databases and the use of various functions such as pg_connect(); that are necessary for the successful operation of our tool. Our initial choice for hosting did not have PHP PostgreSQL enabled and neither did XAMPP by default so this is to assist users.

#### PostgreSQL Setup Scripts:
This directory contains the scripts necessary to set up the local PostgreSQL database, with its respective tables. The sample_data.CSV can be replaced with a larger set of data generated by our Python Image Metadata Processing Algorithms. One note however, should you not have full superuser privileges of a database to COPY from local files, You may use a CSV to SQL converter to convert the CSV in question into a list of SQL insert commands such as <a href="http://www.convertcsv.com/csv-to-sql.htm"></a>. We are not affiliated with the aforementioned website in any way.

#### Presentation - Sunday April 30th, 2017:
This directory simply contains a .ppt version of the presentation used at the SpaceApps Toronto 2017 Presentation and also a link to the actual Google Slides presentation used as well.

#### Python Image Processing and CSV generating Algorithms:
This directory contains the the python programs we created over the weekend to parse the Allouette images in their original .tif format for their metadata and to determine if the Ionogram does infact have valid metadata as there were instances of blank images or just metadata without their related image.

#### Sample Data Sets:
Lastly, this directory contains the station_location.CSV and sample_data_old_witherrors.CSV which were used at the actual presentation. However the new sample_data.CSV and sample_data (USE THIS ONE...).CSV were also included to provide the most accurate data for our live demo on the websites.
