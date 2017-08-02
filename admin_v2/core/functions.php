<?php
    function checkImage($siteId) {

        $dir = '../uploads/temporary/' . $siteId ;
        $arr = [];

        echo $dir . '<br>';
        if (file_exists($dir)) {
            $files = scandir($dir);
            foreach ($files as $value) {
                if ($value != '.' && $value != '..')
                //echo $value . '<br>';
                $arr[] = $value;
            }

            return $arr;
        } else {
            return null;
        }
    }

?>