<?php
function slugify($string, $replace = array(), $delimiter = '-') {
    // https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
    if (!extension_loaded('iconv')) {
        throw new Exception('iconv module not loaded');
    }
    // Save the old locale and set the new locale to UTF-8
    $oldLocale = setlocale(LC_ALL, '0');
    setlocale(LC_ALL, 'en_US.UTF-8');
    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    if (!empty($replace)) {
        $clean = str_replace((array) $replace, ' ', $clean);
    }
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower($clean);
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
    $clean = trim($clean, $delimiter);
    // Revert back to the old locale
    setlocale(LC_ALL, $oldLocale);
    return $clean;
}

function text($text) {
    if(is_array($text)) {
        $tmp = "";
        foreach($text as $desc) {
            $tmp .= '<p>'.nl2br(trim($desc)).'</p>';
        }
        $text = $tmp;
        unset($tmp);
    }
    $text = '<p>'.nl2br(trim($text)).'</p>';
    return $text;
}

ob_start();

$projects = [
    [
        'name' => 'FrAnanas',
        'link' => 'https://github.com/Doc0160/FrAnanas',
        'img' => 'https://raw.githubusercontent.com/Doc0160/FrAnanas/master/frananas.png',
        'desc' => 'FrAnanas est un framework php7.',
        'lang' => ['PHP', 'Framework'],
    ],
    [
        'name' => 'Kikipedo',
        'desc' => [
            'Serveur portable de Wiki simplifié créer dans le but de faciliter la création d\'une base de connaissance lors d\'un travail en équipe.',
            'Ce projet a été, au départ, crée pour aider au suivi des fiches de personnage du jeux de rôle "Roll For Shoes".',
        ],
        'more' => [
            'Ce programme est composé de plusieurs choses:',
            '<ul>'
            .'<li>un serveur http</li>'
           .'<li>un sytéme de base de données</li>'
           .'<li>le systéme de wiki</li>'
           .'<li>une api rest</li>'
           .'</ul>',
            'La base de données est stockée dans un fichier *.db qui peut être ensuit partagé et utiliser par n\'importe qui d\'autre possédant ce logiciel.',
            'Pour des soucis de portabilité, les fichiers de style, de script et de templates sont stockées dans l\'éxécutable même.',
        ],
        'link' => 'https://gitla.in/Doc0160/kikipedo',
        'lang' => ['Go', 'HTTP', 'Markdown', 'BoltDB'],
    ],
    [
        'name' => 'Pink Samurai',
        'link' => 'https://github.com/Doc0160/Pink-Samurai-Chat',
        'img' => 'https://raw.githubusercontent.com/Doc0160/Pink-Samurai-Chat/master/404/evil_eyes.png',
        'desc' => [
            'Pink Samurai est un logicel de chat pour réseau local ... avec un design plutôt douteux.',
        ],
        'more' => [
            'Prend en charge:',
            '<ul>'
            .'<li>La création d\'un compte</li>'
            .'<li>HTTPS</li>'
            .'<li>Multiples channels</li>'
           .'</ul>',
        ],
        'lang' => ['Go', 'Websockets'],
    ],
    [
        'name' => 'platform.go',
        'link' => 'https://gitla.in/Doc0160/platform.go',
        'desc' => 'Wrapper de la librairie shiny pour fournir une API simple permettant d\'afficher une image. Fait aussi librairie son.',
        'lang' => ['Go', 'Shiny', 'GUI'],
    ],
    [
        'name' => 'NESfu**er',
        'link' => 'https://git.teknik.io/Doc0160/NESfucker',
        'desc' => [
            'Emulateur NES NTSC.',
            'Le processus de compilation m\'étant familier, je me suis tempté à l\'émulation. La NES étant très bien docummenté, c\'est donc le systéme que j\'ai choisi de documenter.',
        ],
        'more' => [
            'Le projet prend en charge un nombre limité de mapper.',
            'Ce projet n\'implémente pas non plus les instructions illégales du microprocesseur MOS Technology 6502.',
        ],
        'lang' => ['Go', 'platform.go', 'NES'],
    ],
    [
        'name' => 'GBfu**er',
        'link' => 'https://git.teknik.io/Doc0160/GBfucker',
        'desc' => [
            'GameBoy emulateur.',
            'Second émulateur que j\'ai créé. Ne prend pas en charge les jeux GameBoy Color.',
        ],
        'lang' => ['Go', 'platform.go', 'GameBoy'],
    ],
    [
        'name' => 'asm.go',
        'link' => 'https://gitla.in/Doc0160/asm.go',
        'desc' => [
            'Met à disposition l\'instruction RDTSC pour Go.',
            'Permet de faire une meusure précise de la performance d\'un programme (en cycles processeurs).',
        ],
        'lang' => ['Go', 'asm'],
    ],
    [
        'name' => 'YLP',
        'link' => 'https://github.com/Doc0160/YLP',
        'desc' => 'Un programme ayant pour but de secrétement changer le fond d\'écran d\'un ordinateur windows à interval régulier.',
        'lang' => ['Go', 'Windows', 'Blague'],
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
        'desc' => [
            '"VLC is Bad at streaming" est un programme qui cherche à compenser le buffer trop petit de VLC lors de la lecture de video en streaming.',
            'Ce programme télécharge assez de video avant de lancer VLC pour visioner sans jamais attendre la phase de buffering.',
        ],
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
    
    $filename = 'img/'.slugify($project['name']).'.png';
    if(!file_exists($filename)) {
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
    }

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
                
                echo '<div class="col-lg-4">';
                echo '<div class="thumbnail">';
                
                doImg($project);

                echo '<div class="caption">';
                doTitle($project);
                if(isset($project['lang'])) {
                    echo '<kbd>';
                    echo implode($project['lang'], '</kbd> <kbd>');
                    echo '</kbd>';
                }

                echo text($project['desc']);
                
                if(isset($project['more'])) {
                    echo '<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#'.slugify($project['name']).'" aria-expanded="false" aria-controls="collapseExample">';
                    echo 'En savoir plus';
                    echo '</button>';
                    
                    echo '<div class="collapse" id="'.slugify($project['name']).'">';
                    echo '<div class="well">';
                    echo text($project['more']);
                    echo '</div>';
                    echo '</div>';
                }
                
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
