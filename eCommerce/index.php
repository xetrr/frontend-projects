<?php

include 'init.php';
echo "welcome";

$cats = getLatest("*", "categories", "catid");
foreach ($cats as $cat) {
    echo $cat['name'];
}

// Footer is already included in init.php, so we don't need to include it again
