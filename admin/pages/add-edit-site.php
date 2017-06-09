<?php
    include '../../core/config.php';
    include SITE_PATH . 'core/dbconnect.php';

    getSiteTypes();
    getUsers();
    getSite();

    echo '<pre>';
    //var_dump($indexData);
    echo '</pre>';

    include '../tmp/views/header.html';
?>

    <div class="row">
        <h2>Add new site</h3>
    </div>
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
                                    <input type='text' class="form-control" name="date_create" />
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
    </div>

