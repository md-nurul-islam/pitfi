<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />-->
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />-->
        <!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />-->

        <link rel="stylesheet" href="/css/bootstrap/css/bootstrap.min.css" media="all" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
        <!-- daterange picker -->
        <link rel="stylesheet" href="/js/plugins/daterangepicker/daterangepicker-bs3.css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link rel="stylesheet" href="/js/plugins/iCheck/all.css" />
        <!-- Bootstrap Color Picker -->
        <link rel="stylesheet" href="/js/plugins/colorpicker/bootstrap-colorpicker.min.css" />
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="/js/plugins/timepicker/bootstrap-timepicker.min.css" />
        <!-- Select2 -->
        <link rel="stylesheet" href="/js/plugins/select2/select2.min.css" />
        <!-- Theme style -->
        <link rel="stylesheet" href="/css/dist/css/AdminLTE.min.css" />
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="/css/dist/css/skins/_all-skins.min.css" />
        <link rel="stylesheet" href="/css/main.css" />

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <script type="text/javascript">
            function storageAvailable(type) {
                try {
                    var storage = window[type],
                            x = '__storage_test__';
                    storage.setItem(x, x);
                    storage.removeItem(x);
                    return true;
                }
                catch (e) {
                    return false;
                }
            }
        </script>

    </head>

    <body class="skin-blue sidebar-mini">

        <div class="wrapper">
            <!-- HEADER MENU START -->
            <?php include 'header.php'; ?>
            <!-- HEADER MENU END -->

            <!-- LEFT SIDE BAR START -->
            <?php include 'leftsidebar.php'; ?>
            <!-- LEFT SIDE BAR START -->

            <div class="content-wrapper">

                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo $this->pageHeader; ?>
                    </h1>

                    <?php /* if (isset($this->breadcrumbs)) { ?>
                      <?php
                      $this->widget('zii.widgets.CBreadcrumbs', array('tagName' => 'ol',
                      'homeLink' => '<li>' . CHtml::link('<i class="fa fa-dashboard"></i>Home', '/', array()) . '</li>',
                      'activeLinkTemplate' => '<li><a href="{url}">{label}</a></li>',
                      'inactiveLinkTemplate' => '<li class="active">{label}</li>',
                      'htmlOptions' => array('class' => 'breadcrumb'),
                      'separator' => '',
                      'links' => $this->breadcrumbs,
                      ));
                      ?><!-- breadcrumbs -->
                      <?php } */ ?>

                </section>

                <!-- Main content -->
                <section class="content">
                    <?php echo $content; ?>
                </section>
                <!-- /.content -->

            </div>

            <div class="clearfix"></div>

            <!-- FOOTER START -->
            <?php include 'footer.php'; ?>
            <!-- FOOTER END -->

        </div>

        <!-- LOAD SCRIPTS -->
        <script src="/css/bootstrap/js/bootstrap.min.js"></script>
        <!-- Select2 -->
        <script src="/js/plugins/select2/select2.full.min.js"></script>
        <!-- InputMask -->
        <script src="/js/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="/js/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
        <script src="/js/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="/js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- SlimScroll 1.3.0 -->
        <script src="/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- iCheck 1.0.1 -->
        <script src="/js/plugins/iCheck/icheck.min.js"></script>
        <!-- FastClick -->
        <script src="/js/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="/css/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/css/dist/js/demo.js"></script>


        <script type="text/javascript" src="/js/custom/main.js"></script>

    </body>
</html>
