<?php
    include 'core/dbconnect.php';
    include 'core/config.php';

    require_once 'vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem('tmp');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));

    $twig->addExtension(new Twig_Extension_Debug());

    function getlatestSite ($mysqli) {
        $query = 'SELECT * FROM `sites` ORDER BY `date_create` DESC LIMIT 1';
        $result = $mysqli->query($query);

        return $result->fetch_array(MYSQLI_ASSOC);
    }


    $data = array(
        'main_site' => getlatestSite($mysqli),
        'all_sites' => getSite()
    );

    echo $twig->render('layout/layout_index.html', array('data' => $data));
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