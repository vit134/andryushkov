<?php
    include 'core/dbconnect.php';

    function getlatestSite ($mysqli) {
        $query = 'SELECT * FROM `sites` ORDER BY `dateCreate` DESC LIMIT 1';
        $result = $mysqli->query($query);

        return $result->fetch_array(MYSQLI_ASSOC);
    }


    $data = array(
        'main_site' => getlatestSite($mysqli)
    );


?>

<?php
    include 'tmp/header.html';
?>
<?php
    include 'tmp/main-menu.php';
?>
<div class="l-window js-l-window">
    <?php include 'tmp/topline.html'; ?>

    <div class="l-row">
        <?php include 'tmp/main-block.html'; ?>
    </div>
    <div class="l-row">
        <?php include 'tmp/content.php' ?>
    </div>


    <?php include 'tmp/footer.html'; ?>
</div>