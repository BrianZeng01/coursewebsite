<?php

function echoXss($content) {
    echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
}