<?php
use app\common\helpers\NgMaterial;

$material = NgMaterial::instance();
$material->render('button', 'test');
?>

<div class="page-header">
    <h1>Congratulations!</h1>
</div>
<form>
    <input type="text" />
    <?php $material->render('input-container', 'test', ['class' => 'md-default-theme']); ?>
</form>

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
