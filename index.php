<?php
    include 'core/dbconnect.php';
    include 'core/config.php';

    require_once 'vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem('tmp');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));

    $twig->addExtension(new Twig_Extension_Debug());

    $data = array(
        'main_site' => getlatestSite($mysqli),
        'all_sites' => getSite(),
        'site_type' => getSiteTypes(),
        'site_author' => getUsers()
    );

    //var_dump(getUrl($_SERVER['REQUEST_URI'])[0]);
    $route = getUrl($_SERVER['REQUEST_URI']);
    //echo $route;

    if ($route[0] == "") {
        echo $twig->render('layout/layout_index.html', array('data' => $data));
    } else if ($route[0] == 'site'){
        $id = $route[1];

        $siteTypesQuery = "SELECT * FROM `sites` WHERE" . "'" . $id . "' in (`id`, `alias`)";
        $siteTypesResult = $mysqli->query($siteTypesQuery);

        foreach ($siteTypesResult as $key => $row) {
            foreach ($row as $keyRow => $valueRow) {
                if ($keyRow == 'tags' && $valueRow != '') {
                    $tags = explode(',', trim($valueRow));
                    $data['site'][$keyRow] = $tags;
                } else {
                    $data['site'][$keyRow] = $valueRow;
                }

            }
        }

        echo $twig->render('layout/layout_site.html', array('data' => $data['site']));
    } else if ($route[0] == 'all-site') {
        echo $twig->render('layout/layout_sites.html', array('data' => $data));
    }

    /*echo $twig->render('layout/layout_index.html', array('data' => $data));
    echo '<div class="bla">123</div>';*/
?>

<!-- <?php
    //include 'tmp/header.html';
?>
<?php
    //include 'tmp/main-menu.php';
?>
<div class="l-window js-l-window">
    <?php //include 'tmp/topline.html'; ?>

    <div class="l-row">
        <?php //include 'tmp/main-block.html'; ?>
    </div>
    <div class="l-row">
        <?php //include 'tmp/content.php' ?>
    </div>


    <?php //include 'tmp/footer.html'; ?>
</div> -->