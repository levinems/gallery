<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.min.css"/>

<!-- need to add tooltips and popper for jquery/bootstrap -->
<link rel="stylesheet" href="css/style.css">
<meta property="og:url" content="https://www.m-levine.com" />
<meta property="og:type" content="Photo Album" />
<meta property="og:title" content="M-Levine Photography" />
<meta property="og:description" content="Marc Levine's personal photo album" />
<meta property="og:image" content="https://www.m-levine.com/uploaded-content/2013%20Gildehaus%20Germany/images/thumbnails/DSC_0507.jpg">
<title>Photo Gallery HTML5</title>
<style>
    .modal-dialog {
  position: relative;
  display: table;
  overflow: auto;
  width: auto;
  min-width: 300px;
}
.modal-body { /* Restrict Modal width to 90% */
  overflow-x: auto !important;
  max-width: auto !important;
}
</style>
</head>
<body class="has-header row-spacing-md" data-pagination-style="scroll" data-target-row-height="200">
    <?PHP
    function isEmptyDir($dir){ 
        return (($files = @scandir($dir)) && count($files) <= 2); 
    }
    
    
   error_reporting(E_ALL);
   ini_set("display_errors", 1);
    ?>
<div class="card">
    <div class="card-header text-center" style="cursor:pointer" onclick="window.location='index.php'">
       <h1>M-Levine.com</h1>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <div class="row">
                <div class="list-group small">
                    <?PHP
                    //folder reader needs to be recursive
                    $dir="uploaded-content";
                    //$dh = opendir($dir);
                    $files = scandir($dir, 0);
                    //rsort($files);
                    foreach($files as $file){
                        
                        if ($file != "." && $file != ".." && is_dir($dir . "/" . $file)) {
                            //check directory for empty
                            $newdir = $dir . "/" . $file;
                            $emptyval = isEmptyDir($newdir);
                            
                          
                                    $target=str_replace(" ", "-", $file);

                                    echo "<button type=\"button\" class=\"list-group-item list-group-item-action\" value=\"$file\" data-toggle=\"collapse\" data-target=\"#f".$target."\" aria-expanded=\"false\" aria-controls=\"".$target."\"><i class=\"fa fa-folder text-gold\" ></i> $file</button>\n";
                                    echo "<div class='list-group small collapse margin-10' id=\"f".$target."\">";
                
                                    echo "</div>";
                        }
                
                    }
                    //closedir($dh);
                    ?>
 
                </div>
                <div id="viewer" class="col-9">
                        Okay...<br>
                        Welcome to my photo album.<br>
                        <p>
                        I custom wrote this site for myself because I wasn’t happy with the options I found.<br>
                        First, I use Adobe Lightroom for my photo management and as much as I love it the web templates are not what I was looking for. I could have written my own web template but then I still would have to manage an index for all of those albums. So, I wrote my own dynamic page and parse the JSON data from the Lightroom created albums to create my own albums.
I looked at many “simple” gallery viewers and finally found Fancybox. It’s simple to implement and fits perfectly into my own code.</p>

If’n you want a copy of this code then click here.
<br>
You will need to create a folder/directory named uploaded-content into which you will upload your albums from lightroom.

                </div>
            </div>
        </div>
        
    </div>
    <div class="card-footer text-muted">
        Marc Levine Photograpy Credit to: <a href="https://github.com/fancyapps/fancybox">fancybox3</a> for the super simple lightbox
    </div>
</div>
<?PHP




?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.min.js"></script>
<script>
$(document).ready(function(){
    $("button").click(function(e) {
    e.preventDefault();
        $.get("folderreader.php",
        {
            dir: $(this).val()
        }
        ,
         function(data){
             //write the data to where some place
             document.getElementById("viewer").innerHTML=data;
            //alert("Data: " + data);
        });

    });
});

</script>
<script>
function loadContent(target, val){
    document.getElementById(target).src=val;
}



function fbshare(url,title){
    alert("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(url)+"&t="+title);
    //window.open("https://www.facebook.com/sharer/sharer.php?u="+encodeURIComponent(url)+"&t="+title, '', 'menubar=yes,toolbar=yes,resizable=yes,scrollbars=yes,height=300,width=600');
    return false;
}


</script>

</body>
</html>