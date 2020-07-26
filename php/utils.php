<?php

function echoXss($content) {
    echo htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
}

function num_rows($array)
{
    return mysqli_num_rows($array);
}