<?php
    $items = array(
        0 => array(
            'name' => 'The Non Silent Film',
            'date' => 'June 3, 2017',
            'image' => '/images/lostcars/cover.png',
            'tags' => array(
                0 => 'autonews',
                1 => 'landing',
                2 => 'feetcher'
            ),
            'colors' => array(
                0 => '#bb3f3f',
                1 => '#ededed',
            )
        ),
        1 => array(
            'name' => 'The Non Sil123ent Film',
            'date' => 'June 1233, 2017',
            'image' => '/images/lostcars/cover.png',
            'tags' => array(
                0 => 'aut123onews',
                1 => 'feetcher'
            ),
            'colors' => array(
                0 => '#bb3fad',
                1 => '#ededed',
            )
        ),
        2 => array(
            'name' => 'The Non Sil123ent Film',
            'date' => 'June 1233, 2017',
            'image' => 'images/lostcars/cover.png',
            'tags' => array(
                0 => 'aut123onews',
                1 => 'lan123ding',
            ),
            'colors' => array(
                0 => '#ffeb3b',
                1 => '#bb3f3f',
            )
        ),
        3 => array(
            'name' => 'The Non Sil123ent Film',
            'date' => 'June 1233, 2017',
            'image' => '/images/lostcars/cover.png',
            'tags' => array(
                0 => 'autonews',
                1 => 'landing',
                2 => 'feetcher'
            ),
            'colors' => array(
                0 => '#bb3fad',
                1 => '#ededed',
            )
        )
    )
?>

<div class="content">
    <div class="content__wrapper">
        <div class="content__head">
            <div class="content__head__col">
                <span class="content__head__sort__name">Last sites</span>
            </div>
            <div class="content__head__col"></div>
        </div>
        <div class="content__grid">
            <div class="content__body">
                <?php
                    for ($i = 0; count($items) > $i; ++$i) {
                        echo '<div class="content__col">';
                        include 'tmp/items/item-medium.php';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>