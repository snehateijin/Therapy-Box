
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css" />
<?php
session_start();
include 'class.user.php';
$user = new User();
$uid = $_SESSION['uid'];
if (!$user->get_session()) {
    header("location:login.php");
}
if (isset($_GET['q'])) {
    $user->user_logout();
    header("location:login.php");
}
 //include "db_config.php";
// Create database connection
        $db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Check connection
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<style><!--
    body{
        font-family:Arial, Helvetica, sans-serif;
    }
    h1{
        font-family:'Georgia', Times New Roman, Times, serif;
    }
    --></style>
<div class="box">
    <div class="container">
        <h1>Good Day <?php echo $_SESSION['uname']; ?></h1>
        <a href="index.php?q=logout">LOGOUT</a>
        <div class="row">             
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="box-part text-center position_relative">
                    <div class="title box-title">
                        <h4>Weather</h4>
                    </div>

                    <div class="text">
                        <div id="weather_loader_div" class="overlay"><div class="overlay-content"><img src="loading.gif" alt="Loading..."></div></div>
                        <div class="weather_parent_div">
                            <div id="weather_icon"></div>
                            <div id="weather_temp"></div>
                        </div>
                        <div class="weather_parent_div" id="weather_place"></div>

                    </div> 
                </div>
            </div>   

            <?php
            $content = file_get_contents("http://feeds.bbci.co.uk/news/rss.xml"); // get XML string
            $x = new SimpleXmlElement($content); // load XML string into object
            $namespaces = $x->getNamespaces(true);
            if (sizeof($x->channel->item) > 0) {
                $entry = $x->channel->item[0];
                $media_group = $entry->children($namespaces['media'])->thumbnail->attributes()->url;
                $title = '<a href="' . $entry->link . '" title="' . $entry->title . '" target="_blank">' . $entry->title . '</a>';
                $description = $entry->description;
                ;
            } else {
                $title = 'News';
                $description = "No Latest news found";
            }
            ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="box-part text-center">
                    <div class="title box-title">
                        <h4> News </h4>
                    </div>

                    <div class="text">
                        <h4> <?php echo $title; ?></h4>
                        <span><?php echo $description; ?></span>
                    </div>
                    <a href="news.php">View more</a>
                </div>
            </div>   
            <?php
            $data = file_get_contents("http://www.football-data.co.uk/mmz4281/1718/I1.csv");
            $rows = explode("\n", $data);
            if (sizeof($rows) > 1) {
                $sports_row_data = str_getcsv($rows[1]);
            }
            $home_team = $sports_row_data[2];
            $away_team = $sports_row_data[3];
            $full_time_score = "Score : " . $sports_row_data[4] . ' - ' . $sports_row_data[5];
            $result_stat = $home_team . ' won against ' . $away_team . ' in their home match';
            if ($sports_row_data[6] == 'D') {
                $result_stat = "Match Report: " . $home_team . " and " . $away_team . 'draw';
            } else if ($sports_row_data[6] == 'A') {
                $result_stat = $home_team . ' lost to ' . $away_team . ' in their home match';
            }
            // $s = array();
            // foreach($rows as $row) {
            //     $s[] = str_getcsv($row);
            // }
            // print_r($s);exit;
            ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="box-part text-center">
                    <div class="title box-title">
                        <h4>Sport</h4>
                    </div>

                    <div class="text">
                        <span><?php echo $result_stat; ?></br><span class="highlight_span"><?php echo $full_time_score; ?></span></span>
                    </div>

                    <a href="sports.php">View More</a>

                </div>
            </div>   

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="box-part text-center">
                    <div class="title box-title">
                        <h4>Photos</h4>
                    </div>

                    <?php
                    $query = $db->query("SELECT * FROM gallery ORDER BY image_id DESC");

                    if ($query->num_rows > 0) {
                        $i = 0;
                        while ($row = $query->fetch_assoc()) {
                            if($i<=3){
                            $imageURL = 'gallery/' . $row["file_name"];
                            echo '<img src="' . $imageURL . '" width="120" height="100">';
                            }
                            ?>

                            <?php
                            $i++;
                        }
                    } else {
                        ?>
                    
                        <p>No image(s) found...</p>
                    <?php } ?> 

                        <p>
                        <a href="gallery.php"> View More</a>
                        </p>

                </div>
            </div>   
            <?php
            $task_sql = $db->query("SELECT * FROM task ORDER BY id DESC");             
            ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="box-part text-center">
                    <div class="title box-title">
                        <h4>Tasks</h4>
                    </div>
                    <?php
                    if ($task_sql->num_rows > 0) {
                        ?>
                    <div class="task_home_page">
                    <table>
                    <?php
                        $i = 0;
                        while ($row = $task_sql->fetch_assoc()) {
                            if($i<=2){
                            $taskName = $row["task_name"];
                            $task_status = $row["task_status"];
                            if($task_status == '1'){
                                $check = 'checked';
                            }else{
                                $check = '';
                            }
                                
                            ?>
                        <tr>
                            <td class="task_name_home"><?php echo $taskName; ?></td>
                            <td class="task_status"><input type="checkbox"  <?php echo $check; ?>  disabled="disabled"/></td>
                        </tr>
                        
                   
                    <?php
                            }
                            ?>

                            <?php
                            $i++;
                        }
                        ?>
                    </table>
                    </div>
                        <?php
                    } else {
                        ?>
                    
                        <p>No task(s) found...</p>
                    <?php } ?> 
                        <p>
                    <a href="task.html"> View More</a>
                        </p>

                </div>
            </div>   

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="box-part text-center position_relative ">
                    <div class="title box-title">
                        <h4>Clothes</h4>
                    </div>

                    <div class="text">
                        <div id="cloth_loader_div" class="overlay"><div class="overlay-content"><img src="loading.gif" alt="Loading..."></div></div>
                        <span><div id="container"></div></span>
                    </div>
                </div>
            </div>

        </div>      
    </div>
</div>
<script src="index.js"></script>
<script src="https://static.anychart.com/js/8.0.1/anychart-core.min.js"></script>
<script src="https://static.anychart.com/js/8.0.1/anychart-pie.min.js"></script>
