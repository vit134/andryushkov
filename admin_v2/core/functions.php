<?php
    function checkImage($siteId) {

        $dir = '../uploads/temporary/' . $siteId ;
        $arr = [];

        if (file_exists($dir)) {
            $files = scandir($dir);
            foreach ($files as $value) {
                if ($value != '.' && $value != '..')
                //echo $value . '<br>';
                $arr[] = array(
                    'title' => $value,
                    'value' => '/uploads/temporary/' . $siteId . '/' . $value
                );
            }

            return $arr;
        } else {
            return null;
        }
    }

?>