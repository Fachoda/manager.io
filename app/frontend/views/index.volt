{{ getDoctype() }}
<html ng-app="manager">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Manager.io</title>
        {{ assets.outputCss('header') }}
    </head>
    <body>
        {{ content() }}

        {{ assets.outputJs('footer') }}
    </body>
</html>
