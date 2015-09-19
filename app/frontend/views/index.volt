{{ getDoctype() }}
<html data-ng-app="manager">
<!--TODO replace open dependencies-->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <title>Manager.io</title>
        {{ assets.outputCss('header') }}

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400'
              rel='stylesheet' type='text/css'>
    </head>
    <body data-custom-background="" data-off-canvas-nav="">
        <div class="page-wrapper nav-style--alternative">
            <div data-ng-cloak="" class="no-print">
                <aside id="nav-container">
                    {{ partial('common/navigation') }}
                </aside>
            </div>

            <div class="view-container">
                <div data-ng-cloak="" class="no-print">
                    <section id="header" class="top-header">
                        {{ partial('common/header') }}
                    </section>
                </div>
                <section id="content" class="animate-fade-up">
                    {{ content() }}
                </section>
            </div>
        </div>

        <script type="text/javascript" src="/js/material-design/dist/scripts/vendor.js"></script>
        <script type="text/javascript" src="/js/material-design/dev/app/scripts/app.module.js"></script>
        <script type="text/javascript" src="/js/material-design/dev/app/scripts/app.config.js"></script>
        <script type="text/javascript" src="/js/material-design/dev/app/scripts/app.run.js"></script>
    </body>
</html>
