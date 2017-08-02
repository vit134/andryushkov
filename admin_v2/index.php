<?php
    include '../core/config.php';
    include 'core/functions.php';
    include SITE_PATH . 'core/dbconnect.php';

    require_once '../vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem('tmp');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));

    $twig->addExtension(new Twig_Extension_Debug());

    $indexData = array();
    $route;

    function getEditSiteData($id) {
        if ($id != '') {
            global $mysqli, $indexData;

            $editSiteQuery = 'SELECT * FROM `sites` WHERE `id` like ' .  (integer) $id;

            $editSiteResult = $mysqli->query($editSiteQuery);

            if ($editSiteResult) {
                foreach ($editSiteResult as $key => $row) {
                    //echo $row;
                    $indexData['edit_site'] = $row;
                }
            } else {
                echo 'false';
            }
        } else {
            echo 'no ID';
        }

    }

    function getEditTemplateData($id) {
        if ($id != '') {
            global $mysqli, $indexData;

            $editSiteQuery = 'SELECT * FROM `templates` WHERE `id` like ' .  (integer) $id;

            $editSiteResult = $mysqli->query($editSiteQuery);

            if ($editSiteResult) {
                foreach ($editSiteResult as $key => $row) {
                    //echo $row;
                    $indexData['edit_template'] = $row;
                }
            } else {
                echo 'false';
            }
        } else {
            echo 'no ID';
        }

        return $indexData['edit_template'];

    }

    function getEditPageData($id) {
        if ($id != '') {
            global $mysqli, $indexData;

            $editSiteQuery = 'SELECT * FROM `pages` WHERE `id` like ' .  (integer) $id;

            $editSiteResult = $mysqli->query($editSiteQuery);

            if ($editSiteResult) {
                foreach ($editSiteResult as $key => $row) {
                    //echo $row;
                    $indexData['edit_page'] = $row;
                }
            } else {
                echo 'false';
            }
        } else {
            echo 'no ID';
        }

        return $indexData['edit_page'];
    }

    function init() {
        global $route, $indexData, $config;

        checkLogin();
        getSiteTypes();
        getSiteTags();
        getUsers();
        getSite();
        getTemplates();
        getPages();
        $indexData['route'] = $route = array_splice(explode('/', $_SERVER['REQUEST_URI']), 2);
        $indexData['login'] = $_SESSION['login'];
        $indexData['config'] = $config;

        $indexData['tree'] = array(
            'templates' => $indexData['templates'],
            'pages' => $indexData['pages'],
            'sites' => $indexData['sites']
        );
        /*echo '<pre>';
        var_dump($indexData['pages']);
        echo '</pre>';*/

        //var_dump($route);
    }

    $isTree = true;

    init();

    //var_dump($route);

    switch ($route[0]) {
         case 'templates':
            if ( $route[1] == '' ) {
                echo $twig->render('pages/'. $route[0] .'/index.html', array(
                    'data' => $indexData,
                    'is_tree' => $isTree
                ));
            } else if ($route[1] == 'edit')  {
                echo $twig->render('pages/' . $route[0] . '/edit_template.html', array(
                    'data' =>  $indexData,
                    'edit' =>  getEditTemplateData($route[2]),
                    'is_tree' => $isTree
                ));
            } else  {
                echo $twig->render('pages/' . $route[0] . '/' .$route[1].'.html', array(
                    'data' => $indexData,
                    'is_tree' => $isTree
                ));
            }
            break;
        case 'pages':
            if ( $route[1] == '' || $route[1] == 'all_pages' ) {
                echo $twig->render('pages/'. $route[0] .'/index.html', array(
                    'data' => $indexData,
                    'is_tree' => $isTree
                ));
            } else if ( $route[1] == 'edit' ) {
                echo $twig->render('pages/' . $route[0] . '/edit_page.html', array(
                    'data' => $indexData,
                    'edit' => getEditPageData($route[2]),
                    'templates' =>  $indexData['templates'],
                    'is_tree' => $isTree
                ));
            } else if ($route[1] == 'add_new_page' ) {
                echo $twig->render('pages/' . $route[0] . '/' .$route[1].'.html', array(
                    'data' => $indexData,
                    'is_tree' => false
                ));
            }
            break;
        case 'sites':
            if ($route[1] == 'edit') {
                $editSiteId = $route[2];
                getEditSiteData($editSiteId);
            }

            if ( $route[1] == '' || $route[1] == 'sites' ) {
                echo $twig->render('pages/'. $route[0] .'/index.html', array(
                    'data' => $indexData,
                    'is_tree' => $isTree
                ));
            } else if ( $route[1] == 'edit' ) {

                $indexData['upload_files'] = checkImage($route[2]);
                echo $twig->render('pages/' . $route[0] . '/edit_site.html', array(
                    'data' => $indexData,
                    'is_tree' => $isTree
                ));
            } else if ($route[1] == 'add_new' ) {
                echo $twig->render('pages/' . $route[0] . '/' .$route[1].'.html', array(
                    'data' => $indexData,
                    'is_tree' => false
                ));
            }
            break;
        case 'account':

            echo $twig->render('pages/' . $route[0] . '/index.html', array(
                'data' => $indexData,
                'is_tree' => false
            ));
            break;
        case '':
            echo $twig->render('pages/sites/index.html', array('data' => $indexData, 'is_tree' => false));
            break;
    }

?>


