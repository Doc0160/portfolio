<?php
ob_start();

$projects = [
    [
        'name' => 'FrAnanas',
        'link' => 'https://github.com/Doc0160/FrAnanas',
        'img' => 'https://raw.githubusercontent.com/Doc0160/FrAnanas/master/frananas.png',
        'desc' => 'FrAnanas est un framework php7.',
        'lang' => ['PHP'],
    ],
    [
        'name' => 'Kikipedo',
        'desc' => 'Wiki portable.',
        'link' => 'https://gitla.in/Doc0160/kikipedo',
        'lang' => ['Go'],
    ],
    [
        'name' => 'Pink Samurai',
        'link' => 'https://github.com/Doc0160/Pink-Samurai-Chat',
        'img' => 'https://raw.githubusercontent.com/Doc0160/Pink-Samurai-Chat/master/404/evil_eyes.png',
        'desc' => 'Pink Samurai est un logicel de chat pour réseau local ... avec un design plutôt douteux.',
        'lang' => ['Go', 'Websockets'],
    ],
    [
        'name' => 'platform.go',
        'link' => 'https://gitla.in/Doc0160/platform.go',
        'desc' => 'Wrapper de la librairie shiny pour fournir une API simple permettant d\'afficher une image. Fait aussi librairie son.',
        'lang' => ['Go', 'Shiny'],
    ],
    [
        'name' => 'NESfu**er',
        'link' => 'https://git.teknik.io/Doc0160/NESfucker',
        'desc' => 'Nes emulateur.',
        'lang' => ['Go', 'platform.go', 'NES'],
    ],
    [
        'name' => 'GBfu**er',
        'link' => 'https://git.teknik.io/Doc0160/GBfucker',
        'desc' => 'GameBoy emulateur.',
        'lang' => ['Go', 'platform.go', 'GameBoy'],
    ],
    [
        'name' => 'asm.go',
        'link' => 'https://gitla.in/Doc0160/asm.go',
        'desc' => 'RDTSC pour Go.',
        'lang' => ['Go', 'asm'],
    ],
    [
        'name' => 'YLP',
        'link' => 'https://github.com/Doc0160/YLP',
        'desc' => 'Un programme ayant pour but de secrétement changer le fond d\'écran.',
        'lang' => ['Go', 'Windows'],
    ],
    [
        'name' => 'Melter',
        'link' => 'https://github.com/Doc0160/Melter',
        'desc' => 'Programme qui provoque un effet d\'écran "fondu".',
        'lang' => ['C++', 'Windows'],
    ],
    [
        'name' => 'MarcyR30',
        'link' => 'https://github.com/Doc0160/MarcyR30',
        'desc' => 'Bot Discord avec un systéme de pluggin.',
        'lang' => ['Go', 'Discord'],
    ],
    [
        'name' => 'VLCiBas',
        'link' => 'https://github.com/Doc0160/VLCiBaS',
        'desc' => 'VLC is Bad at streaming. Programme qui télécharge assez de video avant de lancer VLC pour visioner pendant que la video fini de télécharger.',
        'lang' => ['Go'],
    ],
];

function doTitle(array $project) {
    if(isset($project['link'])) echo '<a  target="_blank" href="'.$project['link'].'">';
    echo '<h3>'.$project['name'].'</h3>';
    if(isset($project['link'])) echo '</a>';
}

function doImg(array $project) {
    $img = 'http://fakeimg.pl/320/ffffff,0/000000/?text='.urlencode($project['name']);
    if(isset($project['img'])) $img = $project['img'];
    
    $filename = 'img/'.$project['name'].'.png';
    $filename = str_replace('*', '-', $filename);
    file_put_contents($filename, file_get_contents($img));
    
    $source = imagecreatefrompng($filename);
    list($width, $height) = getimagesize($filename);
    $thumb = imagecreatetruecolor(320, 320);
    $color = imagecolorat($source, 0, 0);
    imagefill($thumb, 0, 0, $color);
    imagealphablending($thumb, false);
    imagesavealpha($thumb, true);
    
    $nh = 320;
    $nw = 320;
    $ratio = $width/$height;

    if ($nw/$nh > $ratio) {
        $nw = $nh*$ratio;
    } else {
        $nh = $nw/$ratio;
    }
    imagecopyresampled($thumb, $source, 320/2-$nw/2, 320/2-$nh/2, 0, 0, $nw, $nh, $width, $height);
    imagepng($thumb, $filename);

    if(isset($project['link'])) echo '<a target="_blank" href="'.$project['link'].'">';
    echo '<img class="img-rounded" src="'.$filename.'">';
    if(isset($project['link'])) echo '</a>';
};

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Tristan Magniez</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
         .col-md-4 img {
             margin: auto;
         }
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>Tristan Magniez
                    <small>
                        <a href="https://github.com/Doc0160/">
                            <i class="fa fa-github" aria-hidden="true"></i>
                            Github
                        </a>
                        <a href="https://gitla.in/Doc0160">
                            <i class="fa fa-git" aria-hidden="true"></i>
                            Gitlain
                        </a>
                        <a href="https://git.teknik.io/doc0160">
                            <i class="fa fa-git" aria-hidden="true"></i>
                            Teknik
                        </a>
                    </small>
                </h1>
            </div>
            <?php
            echo '<div class="row">';
            $i = 0;
            foreach($projects as $project) {
                echo '<!--';
                var_dump($project);
                echo '-->';
                
                echo '<div class="col-md-4">';
                echo '<div class="thumbnail">';
                
                doImg($project);

                echo '<div class="caption">';
                doTitle($project);
                if(isset($project['lang'])) {
                    echo '<kbd>';
                    echo implode($project['lang'], '</kbd> <kbd>');
                    echo '</kbd>';
                }

                if(isset($project['desc'])) echo '<p>'.nl2br(trim($project['desc'])).'</p>';

                echo '</div>';
                echo '</div>';
                echo '</div>';
                $i++;
                if($i % 3 == 0) {
                    echo '</div>';
                    echo '<div class="row">';
                }
            }
            echo '</div>';
            ?>
        </div>
    </body>
</html>
<?php
file_put_contents('index.html', ob_get_clean());
