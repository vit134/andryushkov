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

    function route() {
        $params = $_GET;

        return $params['page'];
    }


    function getEditSiteData($id) {
        global $mysqli, $indexData;

        $editSiteQuery = 'SELECT * FROM `sites` WHERE `id`=' . $id;

        $editSiteResult = $mysqli->query($editSiteQuery);

        foreach ($editSiteResult as $key => $row) {
            $indexData['edit_site'] = $row;
        }

    }

    if ($_GET['page'] == 'edit_site') {
        $editSiteId = $_GET['id'];
        getEditSiteData($editSiteId);
    }


    function init() {
        global $route;

        getSiteTypes();
        getSiteTags();
        getUsers();
        getSite();
        $route = route();
    }

    init();
?>


<?php if ($route == 'add_new') { ?>
    <div class="row">
        <h2>Add new site</h3>
    </div>
    <!-- <div class="row">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">Basic</a></li>
            <li role="presentation"><a href="#">Content</a></li>
        </ul>
    </div> -->
    <div class="row">
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
                        <label for="big_img_file">Big File input</label>
                           <input type="file" id="big_img_file" name="big_img_file" class="file-input">
                           <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="form-group">
                        <label for="small_img_file">Small File input</label>
                        <input type="file" id="small_img_file" name="small_img_file" class="file-input">
                        <p class="help-block">820x625 px</p>
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
                                <label for="link">Real Link</label>
                                <div class="input-group">
                                    <div class="input-group-addon">http://</div>
                                    <input type="text" class="form-control" name="link" id="link" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="site_author">Site author</label>
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
                                    <input type='text' class="form-control" name="date_create" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input value="" type="text" class="form-control" name="tags" id="tags" data-offset="10" placeholder="" >
                        <!-- <div class="tags-list">
                            <ul>
                                <?php
                                    for ($i = 0; count($indexData['site_tags']) > $i;++$i) {
                                        //echo '<li class="tags-list__item js-tag-item">' . $indexData['site_tags'][$i] . '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="tags-search-result"></div> -->
                    </div>
                    <div class="form-group">
                        <label for="colors">Colors</label>
                        <input value="" type="text" class="form-control" name="colors" id="colors" placeholder="" >
                        <!-- <div class="tags-list">
                            <ul>
                                <?php
                                    for ($i = 0; count($indexData['site_tags']) > $i;++$i) {
                                        //echo '<li class="tags-list__item js-tag-item">' . $indexData['site_tags'][$i] . '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="tags-search-result"></div> -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <textarea class="tinyMce">Next, get a free TinyMCE Cloud API key!</textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-default" id="form-addSite-submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
<? } else if ($route == 'edit_site') { ?>
    <div class="row">
        <h2>Edit site</h3>
    </div>
    <div class="row">
        <form id="form-editSite" data-toggle="validator" role="form">
            <div class="row">
                <div class="col-lg-6">
                    <input type="hidden" value="edit_site" name="form_type">
                    <input type="hidden" value="<?php echo $indexData['edit_site']['id'] ?>" name="site_id">
                    <div class="form-group">
                        <label for="site_name">Site name</label>
                        <i>*</i>
                        <input value="<?php echo $indexData['edit_site']['name'] ?>" type="text" class="form-control" name="site_name" id="site_name" placeholder="Site name" required>
                    </div>
                    <div class="form-group">
                        <label for="site_description">Site description</label>
                        <input value="<?php echo $indexData['edit_site']['description'] ?>" type="text" class="form-control" name="site_description" id="site_description" placeholder="Site description">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="design_raiting">Design raiting</label>
                                <input value="<?php echo $indexData['edit_site']['design_raiting'] ?>" type="number" min="0" max="10" step="0.1" class="form-control" name="design_raiting" id="design_raiting" placeholder="">
                            </div>
                            <div class="col-lg-3">
                                <label for="creativity_raiting">Creativ raiting</label>
                                <input value="<?php echo $indexData['edit_site']['creativity_raiting'] ?>" type="number" min="0" max="10" step="0.1" class="form-control" name="creativity_raiting" id="creativity_raiting" placeholder="">
                            </div>
                            <div class="col-lg-3">
                                <label for="usability_raiting">Usability raiting</label>
                                <input value="<?php echo $indexData['edit_site']['usability_raiting'] ?>" type="number" min="0" max="10" step="0.1" class="form-control" name="usability_raiting" id="usability_raiting" placeholder="">
                            </div>
                            <div class="col-lg-3">
                                <label for="speed_raiting">Speed raiting</label>
                                <input value="<?php echo $indexData['edit_site']['speed_raiting'] ?>" type="number" min="0" max="10" step="0.1" class="form-control" name="speed_raiting" id="speed_raiting" placeholder="">
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
                                            if ($indexData['edit_site']['type'] == $indexData['site_types'][$i]) {
                                                echo '<option selected>' . $indexData['edit_site']['type'] . '</option>';
                                            } else {
                                                echo '<option>' . $indexData['site_types'][$i] . '</otion>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="alias">Alias</label>
                                <div class="input-group">
                                    <div class="input-group-addon">/</div>
                                    <input value="<?php echo $indexData['edit_site']['alias'] ?>" type="text" class="form-control" name="alias" id="alias" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                         <div class="row">
                            <div class="col-lg-6">
                                <label for="link">Real Link</label>
                                <div class="input-group">
                                    <div class="input-group-addon">http://</div>
                                    <input value="<?php echo $indexData['edit_site']['link'] ?>" type="text" class="form-control" name="link" id="link" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="site_author">Site author</label>
                                <select class="form-control" name="site_author" id="site_author" placeholder="Site author">
                                    <?php
                                        for ($i = 0; count($indexData['users']) > $i;++$i) {
                                            if ($indexData['edit_site']['author'] == $indexData['users'][$i]) {
                                                echo '<option selected>' . $indexData['edit_site']['author'] . '</option>';
                                            } else {
                                                echo '<option>' . $indexData['users'][$i] . '</otion>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="date_create">Date create</label>
                                <div class='input-group date' id="date_create" >

                                    <input value="<?php echo date('d.m.Y H:i', strtotime($indexData['edit_site']['date_create'])) ?>" type='text' placeholder="<?php echo $indexData['edit_site']['date_create'] ?>" class="form-control" name="date_create" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input value="<?php echo $indexData['edit_site']['tags'] ?>" type="text" class="form-control" name="tags" id="tags" data-offset="0" placeholder="" >
                        <!-- <div class="tags-list">
                            <ul>
                                <?php
                                    for ($i = 0; count($indexData['site_tags']) > $i;++$i) {
                                        //echo '<li class="tags-list__item js-tag-item">' . $indexData['site_tags'][$i] . '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="tags-search-result"></div> -->
                    </div>
                    <div class="form-group">
                        <label for="colors">Colors</label>
                        <input value="<?php echo $indexData['edit_site']['colors'] ?>" type="text" class="form-control" name="colors" id="colors" placeholder="" >
                        <!-- <div class="tags-list">
                            <ul>
                                <?php
                                    for ($i = 0; count($indexData['site_tags']) > $i;++$i) {
                                        //echo '<li class="tags-list__item js-tag-item">' . $indexData['site_tags'][$i] . '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="tags-search-result"></div> -->
                    </div>
                </div>
                <div class="col-lg-4  col-lg-offset-1">
                    <div class="row edit-site__image__row">
                        <div class="edit_site__image__title">Big File</div>
                        <div class="edit_site__image__block <?php if ($indexData['edit_site']['big_img_file'] != '') echo 'image' ?>">
                            <img class="edit_site__image__image" src="<?php echo $indexData['edit_site']['big_img_file'] ?>">
                            <div class="edit_site__image__remove-image js-remove-preview-image"><span class="glyphicon glyphicon-trash"></span></div>
                        </div>
                        <div class="form-group">
                            <input type="file" id="big_img_file" name="big_img_file" class="file-input">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                    </div>
                    <div class="row edit-site__image__row">
                        <div class="edit_site__image__title">Small File</div>
                        <div class="edit_site__image__block <?php if ($indexData['edit_site']['small_img_file'] != '') echo 'image' ?>">
                            <img class="edit_site__image__image" src="<?php echo $indexData['edit_site']['small_img_file'] ?>">
                            <div class="edit_site__image__remove-image js-remove-preview-image"><span class="glyphicon glyphicon-trash"></span></div>
                        </div>
                        <div class="form-group">
                            <input type="file" id="small_img_file" name="small_img_file" class="file-input">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-default" id="form-editSite-submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
<? } else if ($route == 'sites' || route() == '') {
    echo $twig->render('pages/index.html', array('data' => $indexData)); ?>
<? } ?>