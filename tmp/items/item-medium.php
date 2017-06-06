<?php $item = $items[$i]; ?>

<div class="item-medium">
    <div class="item-medium__inner">
        <a href="#" class="item-medium">
            <img src="<?php echo $item['image'] ?>" class="item-medium__img">
        </a>
        <div class="item-medium__content">
            <div class="item-medium__name"><?php echo $item['name']; ?></div>
            <div class="item-medium__date"><?php echo $item['date']; ?></div>
            <div class="item-medium__tags">
                <?php
                    for ($it = 0; count($item['tags']) > $it; ++$it) {
                        echo '<a href="#" class="item-medium__tag">' . $item['tags'][$it] . '</a>';
                    }
                ?>
            </div>
            <div class="item-medium__colors">
                <?php
                    for ($it = 0; count($item['colors']) > $it; ++$it) {
                        echo '<span class="item-medium__color" style="background-color:' . $item['colors'][$it] .'"></span>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>