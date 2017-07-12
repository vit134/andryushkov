<?php
    define('SITE_PATH', realpath(dirname(dirname(__FILE__))).DIRECTORY_SEPARATOR);


    function getUrl($url) {
        return array_splice(explode('/', $url), 1);
    }

     function route() {
        $url = $_SERVER['REQUEST_URI'];
        //echo $url;
        /*$arr array();

        if (stristr($url, '?') != '') {
            parse_str($url, $arr['params']);
            $url = explode("?", $url);

            $url = str_replace('/admin/', "", $url[0]);
        }*/
        $url = str_replace('/admin/', "", $url);

        return array_splice(explode('/', $url), 0);
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

        $res = array();

        foreach ($result->fetch_array(MYSQLI_ASSOC) as $key => $value) {
            $res[$key] = $value;

        }

        $res['likes'] = getSiteLikes($res['id']);


        //return $result->fetch_array(MYSQLI_ASSOC);
        return $res;
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

    function getTemplates() {
        global $mysqli, $indexData;

        $siteTypesQuery = "SELECT * FROM `templates`";
        $siteTypesResult = $mysqli->query($siteTypesQuery);

        foreach ($siteTypesResult as $key => $row) {
            $indexData['templates'][$key] = $row;
        }

        return $indexData['templates'];
    }

    function getPages() {
        global $mysqli, $indexData;

        $siteTypesQuery = "SELECT * FROM `pages`";
        $siteTypesResult = $mysqli->query($siteTypesQuery);

        $tmpQuery = "SELECT `id`, `name` FROM `templates`";
        $tmpResult = $mysqli->query($tmpQuery);

        foreach ($siteTypesResult as $key => $row) {
            $indexData['pages'][$key] = $row;
        }

        return $indexData['pages'];
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
                $indexData['sites'][$key]['likes'] = getSiteLikes($row['id']);
            }
        }

        return $indexData['sites'];
    }

    function getSiteLikes($id) {
        global $mysqli, $indexData;
        $result = array();

        $likeQuery = "SELECT * FROM `liked_sites` WHERE `site_id` = " . $id . " ORDER BY `date_create` DESC";

        foreach ($mysqli->query($likeQuery) as $key => $row) {
            //var_dump($row);
            $avatar = '';
            $name = 'no name';

            if ($row['user_id'] != '') {
                $userNameQuery = "SELECT `name`, `avatar` FROM `auth` WHERE `social_id`=" . $row['user_id'];
                $res = $mysqli->query($userNameQuery);
                $userData = $res->fetch_assoc();
                $name = $userData['name'];
                $avatar = $userData['avatar'];
                $countLike = getUserCountLikes($row['user_id']);
            }

            $result[] = array(
                'name' => $name,
                'avatar' => $avatar,
                'count_like' => $countLike,
                'opinion' => $row['opinion'],
                'design_raiting' => $row['design_raiting'],
                'usability_raiting' => $row['usability_raiting'],
                'creativity_raiting' => $row['creativity_raiting'],
                'speed_raiting' => $row['speed_raiting'],
                'is_like' => $row['is_like'] == 1 ? true : false
            );

        }

        return $result;
    }

    function getUserCountLikes($id) {
        global $mysqli, $indexData;

        $likeQuery = "SELECT `is_like` FROM `liked_sites` WHERE `user_id` = " . $id;
        $result = $mysqli->query($likeQuery);

        return $result->num_rows;

    }

?>