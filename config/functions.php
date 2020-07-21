<?php

/**
 * Debug function with die() after
 * dd($var);
 */

function dd($var)
{
    \yii\helpers\VarDumper::dump($var);
    exit();
}
