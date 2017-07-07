<?php
    include '../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    require_once '/vendor/autoload.php';

    $loader = new Twig_Loader_Filesystem('tmp');
    $twig = new Twig_Environment($loader, array(
        'debug' => true
    ));

    $twig->addExtension(new Twig_Extension_Debug());

    $indexData = array();
    $route;

    /*function route() {
        $params = $_GET;

        return $params['page'];
    }*/

    /*function route() {
        $url = $_SERVER['REQUEST_URI'];
        //echo $url;
        $url = str_replace('/admin/', "", $url);

        return array_splice(explode('/', $url), 0);
    }*/


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
            //var_dump($row1);


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
            //var_dump($row1);
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
            //var_dump($row1);
        } else {
            echo 'no ID';
        }

        return $indexData['edit_page'];

    }





    function init() {
        global $route, $indexData;

        getSiteTypes();
        getSiteTags();
        getUsers();
        getSite();
        getTemplates();
        getPages();
        $indexData['route'] = $route = route();

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

            /*echo $twig->render('pages/' . $route[0] . '/edit_site.html', array(
                'data' => $indexData,
                'is_tree' => $isTree
            ));*/

            if ( $route[1] == '' || $route[1] == 'sites' ) {
                echo $twig->render('pages/'. $route[0] .'/index.html', array(
                    'data' => $indexData,
                    'is_tree' => $isTree
                ));
            } else if ( $route[1] == 'edit' ) {
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
        case '':
            echo $twig->render('pages/sites/index.html', array('data' => $indexData, 'is_tree' => false));
            break;
    }

?>


