
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css" />
<div class="box">
    <div >
        <div class="row">
                
            <?php  
                    $data = file_get_contents("http://www.football-data.co.uk/mmz4281/1718/I1.csv");
                    $rows = explode("\n",$data);
                    $match_status = array();
                    foreach($rows as $row) {
                        $match_details = str_getcsv($row);
                        $winner = '';
                        $loser = '';
                        if(sizeof($match_details) >=6){
                            $match_result = $match_details[6];
                        if($match_result=='H'){
                            $winner = $match_details[2];
                            $loser = $match_details[3];
                        }elseif($match_result=='A'){
                            $winner = $match_details[3];
                            $loser = $match_details[2];
                        }
                        }
                        
                        
                        if($winner!='' && $loser !=''){
                            $match_array = array('winner'=>$winner,'loser'=>$loser);
                            $match_status[] = $match_array;
                        }
                        
                    }
                ?>
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box-part-page text-center">
                        <div class="title">
                            <h1 class="page_title"> Sports </h1>
                        </div>
                        
                        <div class="text">
                            <div class="col-lg-6 offset-lg-3 team_name_div"><input class="form-control form-rounded" type="text" placeholder="Input team name" id="team_name"></div>
                            <div class="col-lg-6 offset-lg-3"><ul id="team_list_ul"><li class="list-group-item">No teams found</li></ul></div>
                        </div>
                         <a class="back_a" href="index.php">Back</a>
                     </div>
                </div>   
        </div>      
    </div>
</div>
<script>
    var match_list = '<?php echo json_encode($match_status);?>';
</script>
<script src="sports.js"></script>
