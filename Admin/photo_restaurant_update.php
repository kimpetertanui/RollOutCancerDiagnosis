<?php 

    require_once 'header.php';
    $controller = new ControllerPhoto();
    $extras = new Extras();

    $photo_id = $extras->decryptQuery1(KEY_SALT, $_SERVER['QUERY_STRING']);
    if($photo_id != null) {
        $photo = $controller->getPhotoByPhotoId($photo_id);
        $viewUrl = $extras->encryptQuery1(KEY_SALT, 'restaurant_id', $photo->restaurant_id, 'photo_restaurant_view.php');
        if( isset($_POST['url_upload']) ) {
          $itm = new Photo();
          $itm->photo_url = trim($_POST['photo_url']);
          $itm->thumb_url = trim($_POST['thumb_url']);
          $itm->restaurant_id = $photo->restaurant_id;
          $itm->photo_id = $photo->photo_id;
          $controller->updatePhoto($itm);
          echo "<script type='text/javascript'>location.href='$viewUrl';</script>";
        }

        if( isset($_POST['file_upload']) ) {
            if( $_FILES["file_photo"]["size"]> 0 && $_FILES["file_thumb"]["size"]> 0 ) {
              $photo->photo_url = $extras->uploadFile("file_photo", "restaurant_");
              $photo->thumb_url = $extras->uploadFile("file_thumb", "restaurant_");
              $controller->updatePhoto($photo);
              echo "<script type='text/javascript'>location.href='$viewUrl';</script>";
          }
          else {
              echo "<script>alert('You must provide both Photo and Thumbnail file.');</script>";
          }
        }
    }
    else {
          echo "<script type='text/javascript'>location.href='403.php';</script>";
    }
?>


<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://getbootstrap.com/assets/ico/favicon.ico">

    <title>Restaurant Finder</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bootstrap/css/navbar-fixed-top.css" rel="stylesheet">
    <link href="bootstrap/css/custom.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">


        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Restaurant Finder</a>
        </div>


        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li ><a href="home.php">Home</a></li>
            <li ><a href="categories.php">Categories</a></li>
            <li class="active"><a href="restaurants.php">Restaurants</a></li>
            <li><a href="admin_access.php">Admin Access</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <li ><a href="index.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
        
      </div>
    </div>

    <div class="container">

      <!-- Example row of columns -->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Update Restaurant Photo</h3>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST">
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" placeholder="Photo URL" name="photo_url" required value="<?php echo $photo->photo_url;?>" >
                        </div>
                        <br />
                        <div class="input-group">
                            <span class="input-group-addon"></span>
                            <input type="text" class="form-control" placeholder="Thumbnail URL" name="thumb_url" required  value="<?php echo $photo->thumb_url;?>" >
                        </div>
                        <br /> 
                        <p>
                            <button type="submit" name="url_upload" class="btn btn-info"  role="button">Save</button> 
                            <a class='btn btn-info' href='<?php echo $viewUrl; ?>' role='button'>Cancel</a>
                        </p>
                    </form><!--/.form --> 
                </div><!--/.col-md-6 -->
                <div class="col-md-6">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="input-group">
                            <p>Photo File</p>
                            <input type="file" name="file_photo" accept="image/*" />
                        </div>
                        <br /> 
                        <div class="input-group">
                            <p>Thumbnail File</p>
                            <input type="file" name="file_thumb" accept="image/*" />
                        </div>
                        <br /> 
                        <p>
                            <button type="submit" name="file_upload" class="btn btn-info"  role="button">Save</button> 
                            <a class='btn btn-info' href='<?php echo $viewUrl; ?>' role='button'>Cancel</a>
                        </p>
                    </form><!--/.form -->
                </div><!--/.col-md-6 -->
            </div><!--/.row -->
        </div><!--/.panel-body -->
      </div>


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/js/jquery.js"></script>
    <script src="bootstrap/js/bootstrap.js"></script>
    
  

</body></html>