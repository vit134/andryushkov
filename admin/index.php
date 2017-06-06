<?php
    include '../core/dbconnect.php';

    if (count($_GET) != 0){
        $formFields = $_GET;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script type="text/javascript" src="../js/vendor/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h2>Admin Panel</h2>
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="#">Brand</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Add new site<span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form action="/admin/index.php"  method="get">
                  <div class="form-group">
                    <label for="site_name">Site name</label>
                    <input type="text" class="form-control" name="site_name" id="site_name" placeholder="Site name">
                  </div>
                  <div class="form-group">
                    <label for="site_description">Site description</label>
                    <input type="text" class="form-control" name="site_description" id="site_description" placeholder="Site description">
                  </div>
                  <div class="form-group">
                    <label for="site_type">Site type</label>
                    <input type="text" class="form-control" name="site_type" id="site_type" placeholder="Site type">
                  </div>
                  <div class="form-group">
                    <label for="site_author">Site author</label>
                    <input type="text" class="form-control" name="site_author" id="site_author" placeholder="Site author">
                  </div>
                  <div class="form-group">
                    <label for="date_create">Date create</label>
                    <input type="date" class="form-control" name="date_create" id="date_create" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="design_raiting">Design raiting</label>
                    <input type="number" class="form-control" name="design_raiting" id="design_raiting" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="alias">Alias</label>
                    <div class="input-group">
                        <div class="input-group-addon">/</div>
                        <input type="text" class="form-control" name="alias" id="alias" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile" name="file">
                    <p class="help-block">Example block-level help text here.</p>
                  </div>
                  <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>