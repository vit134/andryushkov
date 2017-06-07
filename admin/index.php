<?php
    include '../core/dbconnect.php';

    $indexData = array();
    $route;

    function route() {
        $params = $_GET;

        return $params['page'];
    }

    function getSiteTypes() {
        global $mysqli, $indexData;

        $siteTypesQuery = "SELECT `type_name` FROM `site_types`";
        $siteTypesResult = $mysqli->query($siteTypesQuery);

        foreach ($siteTypesResult as $row) {
            $indexData['site_types'][] = implode(' ', $row);
        }
    }

    function getUsers() {
        global $mysqli, $indexData;

        $usersQuery = "SELECT `first_name`, `last_name` FROM `users`";

        $userResult = $mysqli->query($usersQuery);

        foreach ($userResult as $row) {
            $indexData['users'][] = implode(' ', $row);
        }
    }

    function init() {
        global $route;

        getSiteTypes();
        getUsers();
        $route = route();
    }

    init();

?>



<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script type="text/javascript" src="../js/vendor/jquery-3.2.1.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script>
    <script type="text/javascript" src="js/datetime-picker.min.js"></script>
    <script type="text/javascript" src="js/moments-locale-ru.js"></script>

    <link rel="stylesheet" type="text/css" href="css/datetime-picker.min.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <script type="text/javascript" src="js/validator.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>
    <div class="alert alert-addSite">
      Add site was <strong>Success</strong>!
    </div>
    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Admin Panel</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php if ($route == 'sites') echo 'active' ?>"><a href="?page=sites">Sites<span class="sr-only">(current)</span></a></li>
                        <li class="<?php if ($route == 'add_new') echo 'active' ?>"><a href="?page=add_new">Add new site<span class="sr-only">(current)</span></a></li>
                        <li><a href="#">Link</a></li>
                    </ul>
                </div>
              </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php if ($route == 'add_new') { ?>
                    <form id="form-addSite" data-toggle="validator" role="form">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="hidden" value="add_site" name="form_type">
                            <div class="form-group">
                                <label for="site_name">Site name</label>
                                <i>*</i>
                                <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site name" required>

                            </div>
                            <div class="form-group">
                                <label for="site_description">Site description</label>
                                <input type="text" class="form-control" name="site_description" id="site_description" placeholder="Site description">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                   <input type="file" id="exampleInputFile" name="file">
                                   <p class="help-block">Example block-level help text here.</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <label for="design_raiting">Design raiting</label>
                                        <input type="number" min="0" max="10" step="0.1" class="form-control" name="design_raiting" id="design_raiting" placeholder="">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="creativity_raiting">Creativ raiting</label>
                                        <input type="number" min="0" max="10" step="0.1" class="form-control" name="creativity_raiting" id="creativity_raiting" placeholder="">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="usability_raiting">Usability raiting</label>
                                        <input type="number" min="0" max="10" step="0.1" class="form-control" name="usability_raiting" id="usability_raiting" placeholder="">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="speed_raiting">Speed raiting</label>
                                        <input type="number" min="0" max="10" step="0.1" class="form-control" name="speed_raiting" id="speed_raiting" placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                 <div class="row">
                                    <div class="col-lg-6">
                                        <label for="site_type">Site type</label>
                                        <i>*</i>
                                        <select class="form-control" name="site_type" id="site_type" placeholder="Site type" required>
                                            <?php
                                                for ($i = 0; count($indexData['site_types']) > $i;++$i) {
                                                    echo '<option>' . $indexData['site_types'][$i] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="alias">Alias</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">/</div>
                                            <input type="text" class="form-control" name="alias" id="alias" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="site_author">Site author</label>
                                        <!-- <input type="text" class="form-control" name="site_author" id="site_author" placeholder="Site author"> -->
                                        <select class="form-control" name="site_author" id="site_author" placeholder="Site author">
                                            <?php
                                                for ($i = 0; count($indexData['users']) > $i;++$i) {
                                                    echo '<option>' . $indexData['users'][$i] . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="date_create">Date create</label>
                                        <div class='input-group date' name="date_create" id="date_create" placeholder="">
                                            <input type='text' class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-default" id="form-addSite-submit">Submit</button>
                        </div>
                    </div>
                    </form>
                <? } else if ($route == 'sites' || route() == '') { ?>
                    <h1>bla bla</h1>
                <? } ?>
            </div>
        </div>
    </div>
</body>
</html>