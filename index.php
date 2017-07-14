<?php
    session_start();



    include 'core/dbconnect.php';
    include 'core/config.php';

    require_once 'vendor/autoload.php';
    require_once 'vendor/SocialAuther/autoload.php';

    $loader = new Twig_Loader_Filesystem('tmp');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));

    $twig->addExtension(new Twig_Extension_Debug());

     $adapterConfigs = array(
        'vk' => array(
            'client_id'     => '6104770',
            'client_secret' => 'PeZxugyq7gUuxMhgul9k',
            'redirect_uri'  => 'http://andryushkov/?provider=vk'
        ),
        'google' => array(
            'client_id'     => '607818319032-v05se1lvpcb1vdm1mi7gf6kn9t1tcvsr.apps.googleusercontent.com',
            'client_secret' => 'Vd_bSUAfIXAjEGcQfcjAQn5u',
            'redirect_uri'  => 'http://localhost/auth?provider=google'
        ),
        'facebook' => array(
            'client_id'     => '361235930945802',
            'client_secret' => 'a491b10603bd964b9362cbcb89a5a93d',
            'redirect_uri'  => 'http://localhost/auth?provider=facebook'
        )
    );

    // создание адаптера и передача настроек
    //$vkAdapter = new SocialAuther\Adapter\Vk($vkAdapterConfig);
    $adapters = array();

    foreach ($adapterConfigs as $adapter => $settings) {
        $class = 'SocialAuther\Adapter\\' . ucfirst($adapter);
        $adapters[$adapter] = new $class($settings);
    }

    foreach ($adapters as $title => $adapter) {
        $indexData['auth_href'][$title] = $adapter->getAuthUrl();
    }


    // передача адаптера в SocialAuther
    //$auther = new SocialAuther\SocialAuther($vkAdapter);

    if (isset($_GET['provider']) && array_key_exists($_GET['provider'], $adapters)) {
        $auther = new SocialAuther\SocialAuther($adapters[$_GET['provider']]);
    }

    if (!isset($_SESSION['user'])) {
        $indexData['login'] = $_SESSION;
    }

    if (isset($_GET['code'])) {
        //echo $auther->authenticate();

        if ($auther->authenticate()) {
            $result = $mysqli->query(
                "SELECT *  FROM `auth` WHERE `provider` = '{$auther->getProvider()}' AND `social_id` = '{$auther->getSocialId()}' LIMIT 1"
            );

            $record = mysqli_fetch_array($result);
            if (!$record) {
                $values = array(
                    $auther->getProvider(),
                    $auther->getSocialId(),
                    $auther->getName(),
                    $auther->getEmail(),
                    $auther->getSocialPage(),
                    $auther->getSex(),
                    date('Y-m-d', strtotime($auther->getBirthday())),
                    $auther->getAvatar()
                );

                $query = "INSERT INTO `auth` (`provider`, `social_id`, `name`, `email`, `social_page`, `sex`, `birthday`, `avatar`) VALUES ('";
                $query .= implode("', '", $values) . "')";
                $result =  $mysqli->query($query);
            }

            $user = new stdClass();
            $user->provider   = $auther->getProvider();
            $user->socialId   = $auther->getSocialId();
            $user->name       = $auther->getName();
            $user->email      = $auther->getEmail();
            $user->socialPage = $auther->getSocialPage();
            $user->sex        = $auther->getSex();
            $user->birthday   = $auther->getBirthday();
            $user->avatar     = $auther->getAvatar();
            $user->city       = $auther->getCity();
            $user->country    = $auther->getCountry();


            $_SESSION['user'] = $user;
            header("location:/");
        } else {
            echo 'no authenticate';
        }
    } else {
        //echo 'isset GET["code"]';
    }

    $data = array(
        'main_site' => getlatestSite($mysqli),
        'all_sites' => getSite(),
        'site_type' => getSiteTypes(),
        'site_author' => getUsers(),
        'pages' => getPages(),
        'route' => route(),
        'auth_href' => $indexData['auth_href'],
        'login' => $_SESSION['user'],
        //'all_route' => route()

    );

    //$route = getUrl($_SERVER['REQUEST_URI']);
    $route = route();

    //echo $route[0];

    if ($route[0] == "") {
        //var_dump(getSiteLikes(107));
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

        $data['site']['likes'] = getSiteLikes($data['site']['id']);

        echo $twig->render('layout/layout_site.html', array('data' => $data));
    } else if ($route[0] == 'all-site') {
        echo $twig->render('layout/layout_sites.html', array('data' => $data));
    } else if ($route[0] == 'auth') {
        if ($route[1] == 'logout') {
            unset($_SESSION['user']);
            header("location:/");
        }

        echo $twig->render('layout/layout_auth.html', array('data' => $data));
    } else if ($route[0] == 'lk') {
        //var_dump($data['login']->socialId);

        $data['likes'] = getUserLikes($data['login']->socialId);
        echo $twig->render('layout/layout_lk.html', array('data' => $data));
    }


?>