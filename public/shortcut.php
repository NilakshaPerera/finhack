<?php
$target = '{{absolute folder path}}/fin/public/uploads';
$shortcut = 'uploads';
symlink($target, $shortcut);
?>