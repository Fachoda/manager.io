{{ getDoctype() }}
<html data-ng-app="manager">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <title>Manager.io</title>

        <link rel="stylesheet" media="screen" href="/js/handsontable/bower_components/handsontable/dist/handsontable.full.css" />
    </head>

    <body>
        {{ content() }}
        <script type="text/javascript" src="/js/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="/js/handsontable/bower_components/angular/angular.js"></script>
        <script type="text/javascript" src="/js/handsontable/bower_components/handsontable/dist/handsontable.full.js"></script>
        <script type="text/javascript" src="/js/handsontable/bower_components/ngHandsontable/dist/ngHandsontable.js"></script>
        <script type="text/javascript" src="/js/app/src/app.js"></script>
        <script type="text/javascript" src="/js/app/src/app.config.js"></script>
        <script type="text/javascript" src="/js/app/src/app.run.js"></script>
        <script type="text/javascript" src="/js/app/src/controllers/timesheets/TimeSheetsController.js"></script>
    </body>
</html>