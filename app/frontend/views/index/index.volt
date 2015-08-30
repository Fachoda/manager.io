<?php
use app\common\helpers\NgMaterial;

$material = NgMaterial::instance();
?>

<div class="page-header">
    <h1>Congratulations!</h1>
</div>

<md-content md-theme="docs-dark" layout-padding layout="row" layout-sm="column">
    <md-input-container>
        <label>Title</label>
        <input ng-model="user.title">
    </md-input-container>
    <md-input-container>
        <label>Email</label>
        <input ng-model="user.email" type="email">
    </md-input-container>
</md-content>
<p>You're now flying with Phalcon. Great things are about to happen!</p>

<em>This page is located at views/index/index.phtml</em>

.page-header
    md-content(md-theme="docs-dark")