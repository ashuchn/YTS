<?php 
include("constants.php");
// echo LIST_MOVIES;

$url = LIST_MOVIES."?limit=10";
// echo $url;exit;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);

$response = json_decode($resp,TRUE); 
$data = $response['data']['movies'];


// foreach($data as $rows){
//   echo $rows['medium_cover_image']."<br>";
// }
// exit;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/favicon.ico">
    <meta name="description" content="Download Movies Torrents">
    <!-- <link rel="stylesheet" href="../Assets/darkmode.css"> -->
    <!-- Include CSS -->
    <link rel="stylesheet" href="../Assets/bs/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../Assets/bs/style.css">
    <!-- include font awesome -->
    <script src="https://use.fontawesome.com/d02afb5430.js"></script>
    <!-- tawk.to -->
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61e670fbf7cf527e84d2ae4b/1fpm2ilt0';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
    <title>YTS</title>
</head>
<body style="background-color: #CDFDB8;">
    <div class="container-fluid pt-2 ">
      <!-- <button class="btn btn-success" onclick="toggle();">Toggle Mode</button> -->
    <?php include 'loading.php'; ?>
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
<!-- Navbar ends here -->
<br>
<?php  

$path = $_SERVER['PHP_SELF'];
$ex = explode("/",$path);
$file_name = $ex['2'];

switch($file_name)
{
    case "torrent.php" : $current_page = "View Torrent";
    break;
    case "homepage.php" : $current_page = "Homepage";
    break;
    default : $current_page = "YTS";
}

echo $current_page;

?>
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-3">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">

                    <?php 
                    $cond = "TRUE";
                    foreach($data as $rows){ 
                      
                      ?>
                        <a href="torrent.php?id=<?php echo $rows['id']; ?>">
                        <div class="carousel-item<?php if($cond == "TRUE"){echo " active";} ?> ">
                          <img class="img-thumbnail hover-zoom img-fluid rounded hover-overlay ripple shadow-1-strong" src="<?php echo $rows['medium_cover_image'] ?>" alt="First slide">
                          <div class="overlay">
                              <div class="text">
                                  <?php echo $rows['title']; ?>
                                  <hr>
                                  Rating: <?php echo $rows['rating']."/10"; ?>
                                  <img src="https://img.icons8.com/emoji/96/000000/star-struck.png"/>
                              </div>
                          </div>

                        </div>
                    </a>
               <?php  
               
                   $cond = "FALSE";    }
                    
                    ?>
                    </div>

                </div>
                 
            </div> 

            <div class="col">
                <nav class="navbar navbar-light rounded text-center" style="background-color: #e3f2fd;">
                    <div class="container-fluid ">
                      <span class="navbar-text" style="color: black;">
                        <h1 class="display-6">Recently Added Torrents <img src="../images/trending.png" alt="" style="width: 30px; height: 24px;"></h1>
                      </span>
                    </div>
                </nav> 
                <span class="success"><hr></span> 
            <div class="container-fluid" id="main-class">
                <table class="table table-striped table-hover" style="background-color: #;">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Torrent</th>
                        <th scope="col">Date Uploaded</th>
                        <th scope="col">Genre</th>
                         <th scope="col">Rating</th>
                        <!--<th scope="col">Peers</th> -->
                        <!-- <th scope="col">Se</th> -->
                      </tr>
                    </thead>
                    <tbody>
                     <?php 
                     $i=1;
                     foreach($data as $content)
                     {?>
                        
                          <tr>
                              <td> <?php echo $i; ?></td>
                              <td><a href="torrent.php?id=<?php echo $content['id']; ?>"><?php echo $content['title']; ?></a></td>
                              <td><?php echo $content['date_uploaded']; ?></td>
                              <td>
                                <?php foreach($content['genres'] as $genre){ ?> 
                                  <a href="movies_by_genre.php?genre=<?php echo $genre; ?>">
                                    <span class="badge badge-success" style="color: #fe6800";>
                                        <?php echo $genre; ?>
                                    </span>
                                  </a> 
                                <?php } ?>
                              </td>
                              <td align="right"><?php echo $content['rating'] ?><i><img src="../images/star.png" height="40" width="40" alt="" srcset=""></i></td>
                          </tr>
                        
                      
              <?php $i++; }
                     
                     ?>
                    </tbody>
                  </table>
            </div>
            </div> <!-- col -->
        </div> <!-- row-->
    </div> <!-- container-->

 <!-- Include JS -->
 <!-- <script src="../Assets/bs/js/bootstrap.bundle.min.js"></script> -->
 <!-- Include Popper JS (Optional) -->
 <!-- <script src="../Assets/bs/js/popper.min.js"></script> -->
 <!-- JavaScript Bundle with Popper -->
 <script src="../Assets/bs/jquery/jquery.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<!-- carousal jquery -->
<script language="JavaScript" type="text/javascript">
    $(document).ready(function(){
      $('.carousel').carousel({
        interval: 3000
      })
    });    
</script>

</body>
</html>

<!-- <script>
  function toggle() {
    var element = document.body;
    element.classList.toggle("dark-mode");
}
</script> -->