<?php 

include 'constants.php';

$genre = $_GET['genre'];

$url = LIST_MOVIES."?genre=".$genre;

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

// print_r($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Download Movies Torrents">
    <!-- Include CSS -->
    <link rel="stylesheet" href="../Assets/bs/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../Assets/bs/style.css">
    <!-- include font awesome -->
    <script src="https://use.fontawesome.com/d02afb5430.js"></script>
    <title>Genre: <?php echo $genre ?></title>
</head>
<body>
    <div class="fluid-container">
        
            <?php 
            $i=1;
            foreach($data as $rows){
                    echo $i."<br>";
                ?>
                
                    <div class="card" style="width: 18rem;">
                    <img src="<?php echo $rows['medium_cover_image'] ?>" class="card-img-top" alt="image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $rows['title_long']; ?></h5>
                        <p class="card-text"><?php echo mb_strimwidth($rows['summary'],0 ,30) ?></p>
                        <a href="torrent.php?id=<?php echo $rows['id']; ?>" class="btn btn-primary">View More</a>
                    </div>
                    </div>

            <?php }
            $i++;
            if($i>3){ break; }
            ?>
    </div>
</body>
</html>