<md-toolbar class="md-tall hd-hue-2">
    <span flex></span>
    <div layout="column" class="md-toolbar-tools-bottom inset">
        <user-avatar></user-avatar>
        <span></span>
        <div>Adrian Eavaz</div>
        <div>adrian.eavaz@gmail.com</div>
    </div>
</md-toolbar>
<div ng-init="items = [{title: 'Dashboard', icon: 'dashboard'}, {title: 'Email', icon: 'email'}]"></div>
<md-list>
    <md-list-item data-ng-repeat="item in items">
        <a>
            <md-content layout="row" layout-align="start center">
                <div class="inset">
                    <md-icon md-font-set="mi">{{ ng('item.icon') }}</md-icon>
                </div>
                <div class="inset">{{ ng('item.title') }}</div>
            </md-content>
        </a>
    </md-list-item>

    <md-divider></md-divider>
    <md-subheader>Management</md-subheader>

    <md-list-item data-ng-repeat="item in items" md-ink-ripple="#F00">
        <a href="#" layout-fill>
            <md-content layout="row" layout-align="start center">
                <div class="inset">
                    <md-icon md-font-set="mi">{{ ng('item.icon') }}</md-icon>
                </div>
                <div class="inset">{{ ng('item.title') }}</div>
            </md-content>
        </a>
    </md-list-item>
    <md-divider></md-divider>
</md-list>