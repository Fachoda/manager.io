{{ getDoctype() }}
<html data-ng-app="manager">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <title>Manager.io</title>
        {{ assets.outputCss('header') }}
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link id="main-style" rel="stylesheet" href="js/material-design/dev/app/assets/css/main.css?ceva" />
    </head>
    <body>
        <!--[if lt IE 10]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
            your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="page-wrapper" layout="row">
            <md-sidenav layout="column" class="left-sidenav md-whiteframe-z1" data-md-component-id="sidenav-left" data-md-is-locked-open="true">
                {{ partial('common/navigation') }}
            </md-sidenav>
        </div>

        <script type="text/javascript" src="js/material-design/dist/scripts/vendor.js"></script>
        <script type="text/javascript" src="js/material-design/dev/app/scripts/app.module.js"></script>
        <script type="text/javascript" src="js/material-design/dev/app/scripts/app.config.js"></script>
        <script type="text/javascript" src="js/material-design/dev/app/scripts/app.run.js"></script>
    </body>
</html>
