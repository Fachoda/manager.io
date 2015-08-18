{{ getDoctype() }}
<html ng-app="Manager">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Manager.io</title>
<!--        {{ assets.outputCss('header') }}-->
        <link rel="stylesheet" href="js/angular/bower_components/angular-material/angular-material.css" />
    </head>
    <body>
        {{ content() }}

        {{ assets.outputJs('footer') }}
    </body>
</html>
