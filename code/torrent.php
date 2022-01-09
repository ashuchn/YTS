<?php 
error_reporting(-1);
include("constants.php");

$id = $_GET['id'];

$url =  MOVIE_DETAILS."?movie_id=".$id;
// echo $url;exit;

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
// print_r($resp);exit;

$response = json_decode($resp,TRUE); 

$data = $response['data']['movie'];
$mname = $data['title'];
// print_r($data);exit;
// echo $data['background_image_original'];exit;
// print_r($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico">
    <title>YTS || Download <?php echo htmlspecialchars($mname); ?></title>
</head>
<body>

<meta name="description" content="Download Movies Torrents">
    <!-- Include CSS -->
    <link rel="stylesheet" href="../Assets/bs/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../Assets/bs/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@1,500&display=swap" rel="stylesheet">
    <!-- include font awesome -->
    <script src="https://use.fontawesome.com/d02afb5430.js"></script>
    <title>YTS</title>
</head>
<body style="background-color: #CDFDB8;">
    <div class="container-fluid pt-2 ">
    <div class="alert alert-warning alert-dismissible fade show justify-content-center" role="alert">
    <marquee width="" direction="left" height=" ">
        Work in Progress
    </marquee>
    </div>
        <nav class="navbar navbar-expand-lg navbar-light navbar-fixed-top " style="background-color: #e3f2fd;">
            <a class="navbar-brand" href="#">
                <img src="../images/logo.png" alt="" width="100" height="70" srcset="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <a class="nav-item nav-link active " href="homepage.php">Home <span class="sr-only"></span></a>
                <a class="nav-item nav-link" href="#">Trending Torrents</a>
                <a class="nav-item nav-link" href="#" id="login">Login</a>
                <!-- <a class="nav-item nav-link disabled" href="#">Disabled</a> -->
              </ul>
            </div>
            <form class="form-inline mr-5">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success btn-inline" type="submit">Search</button>
            </form>
        </nav>
    </div>
<br>

<?php  

$path = $_SERVER['PHP_SELF'];
// echo $path."<br>";
$ex = explode("/",$path);
$file_name = $ex['2'];

switch($file_name)
{
    case "torrent.php" : $current_page = "View Torrent";
    break;
    case "homepage.php" : $current_page = "Home";
    break;
    default : $current_page = "YTS";
}

// echo $current_page;

?>
    <div class="fluid-container ml-2" style="">
        <?php 
        
        if($current_page == "View Torrent"){?>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $current_page; ?></li>
                </ol>
            </nav>        

        <?php } ?>

    </div>

    <div class="container-fluid torrent bg-dark" >
    <h1 class="display-6 text-white"><?php echo $mname; ?></h1>
        <div class="row" style="font-family: 'Roboto Mono', monospace;">
            <div class="col-4">
                <img src="<?php echo $data['medium_cover_image']; ?>" alt="" >
            </div>
            <div class="col-6">
                <table class="table table-dark" CELLSPACING="2">
                    <tr>
                        <td style="width: 40%;">Torrent Name:</td> 
                        <td><?php echo $mname; ?></td> 
                    </tr>
                    <tr>
                        <td>Year:</td>
                        <td><?php echo $data['year']; ?></td>
                    </tr>
                    <!-- <tr>
                        <td>description:</td>
                        <td><?php// echo $data['description_full']; ?></td>
                    </tr> -->
                    <!-- <tr>
                        <td>Genre:</td>
                        <td><?php// foreach($data['genres'] as $genre){ echo $genre." "; } ?></td>
                    </tr> -->
                    <tr>
                        <td>Runtime:</td>
                        <td><?php echo $data['runtime']." Minutes"; ?></td>
                    </tr>
                    <tr>
                        <td>Youtube Trailer:</td>
                        <td><a href="#youtube"><img src="../images/youtube.png" alt="Youtube Icon" style="width: 15%;" title="Youtube"></a></td>
                    </tr>
                    <tr>
                        <td><button class="btn btn-outline-success">Downloads: <?php echo $data['download_count'] ?></button></td>
                        <td><button class="btn btn-outline-success"><?php echo $data['like_count'];?><img src="" alt=""></button></td>
                    </tr>
                    <tr colspan="2">
                        <td>Download Method:</td>
                    </tr>
                    <tr>
                        <td><button class="btn btn-outline-primary"><img src="../images/dwnlod.png" alt="" style="height: 30px; width: 30px;"> Direct Download</button></td>
                        <td><button class="btn btn-outline-primary" title="Magnet Download"><img src="../images/magnet.png" alt="magnet_link" style="height: 30px; width: 30px;"> Magnet Download</button></td>
                    </tr>
                </table>
            </div>
        </div> 
        <!-- row ends here -->
        <hr class="text-white">
        <div class="fluid-container text-white">
            <h3>Description:</h3>
            <p class="lead">
                <?php echo $data['description_full']; ?>
            </p>
        </div>
        <br>
        <?php  
            if(!empty($data['yt_trailer_code']))
            {?>
                <div class="iframe-container align-items-center" id="youtube" style="text-align: center;">

                </div>
            <?php }
        ?>
        
    </div>


</html>
<script src="https://www.youtube.com/iframe_api"></script>


    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    //    This function creates an <iframe> (and YouTube player)
        //  after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('youtube', {
          height: '390',
          width: '640',
          videoId: '<?php echo $data['yt_trailer_code']; ?>',
          playerVars: {
            'playsinline': 1
          },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
<script>
    // $(".alert").alert('close')
</script>
