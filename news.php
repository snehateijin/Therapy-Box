
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
                $content = file_get_contents("http://feeds.bbci.co.uk/news/rss.xml"); // get XML string
                $x = new SimpleXmlElement($content); // load XML string into object
                $namespaces = $x->getNamespaces(true);
                if(sizeof($x->channel->item) > 0){
                    $entry = $x->channel->item[0];                    
                    $media_group = $entry->children($namespaces['media'])->thumbnail->attributes()->url;
                    $title = '<a href="'.$entry->link.'" title="'.$entry->title.'" target="_blank">' . $entry->title . '</a>';
                    $description = $entry->description;
                    $image = '<img src="'.$media_group.'">';
                }else{
                    $title = 'News';
                    $description = "No Latest news found";
                    $image = "";
                }
                
            ?>
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="box-part-page text-center">
                        <div class="title">
                            <h1 class="page_title"> News </h1>
                        </div>
                        
                        <div class="text">
                            <div><?php echo $image; ?></div>
                              <h4> <?php echo $title; ?></h4>
                            <span><?php echo $description;?></span>
                        </div>
                         <a class="back_a" href="index.php">Back</a>
                     </div>
                </div>   
        </div>      
    </div>
</div>
