<?php
    define('SITE_PATH', realpath(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR);


    function getUrl($url) {
        return array_splice(explode('/', $url), 1);
    }

    function getMysqlFieldType($type) {
        $mysql_data_type = array(
            'tinyint' => 1,
            'smallint' => 2,
            'int' => 3,
            'float'=> 4,
            'double'=> 5,
            'timestamp'=> 7,
            'bigint'=> 8,
            'mediumint'=> 9,
            'date'=> 10,
            'time'=> 11,
            'datetime'=> 12,
            'year'=> 13,
            'bit'=> 16,
            'varchar'=> 253,
            'char'=> 254,
            'decimal'=> 246
        );

        return array_search($type, $mysql_data_type);
    }

    function getlatestSite ($mysqli) {
        $query = 'SELECT * FROM `sites` ORDER BY `date_create` DESC LIMIT 1';
        $result = $mysqli->query($query);

        return $result->fetch_array(MYSQLI_ASSOC);
    }

    function getSiteTypes() {
        global $mysqli, $indexData;

        $siteTypesQuery = "SELECT `type_name` FROM `site_types`";
        $siteTypesResult = $mysqli->query($siteTypesQuery);

        foreach ($siteTypesResult as $row) {
            $indexData['site_types'][] = implode(' ', $row);
        }

        return $indexData['site_types'];
    }

    function getSiteTags() {
        global $mysqli, $indexData;

        $siteTypesQuery = "SELECT `tag_name` FROM `site_tags`";
        $siteTypesResult = $mysqli->query($siteTypesQuery);

        foreach ($siteTypesResult as $key => $row) {
            $indexData['site_tags'][] = implode(' ', $row);
        }
    }

    function getUsers() {
        global $mysqli, $indexData;

        $usersQuery = "SELECT `first_name`, `last_name` FROM `users`";

        $userResult = $mysqli->query($usersQuery);

        foreach ($userResult as $row) {
            $indexData['users'][] = implode(' ', $row);
        }

        return $indexData['users'];
    }

    function getSite() {
        global $mysqli, $indexData;

        $siteTypesQuery = "SELECT * FROM `sites`";
        $siteTypesResult = $mysqli->query($siteTypesQuery);

        foreach ($siteTypesResult as $key => $row) {
            foreach ($row as $keyRow => $valueRow) {
                if ($keyRow == 'tags' && $valueRow != '') {
                    $tags = explode(',', trim($valueRow));
                    $indexData['sites'][$key][$keyRow] = $tags;
                } else if ($keyRow == 'colors' && $valueRow != '') {
                    $colors = explode(',', trim($valueRow));
                    $indexData['sites'][$key][$keyRow] = $colors;
                } else {
                    $indexData['sites'][$key][$keyRow] = $valueRow;
                }

            }
        }

        return $indexData['sites'];
    }
?>