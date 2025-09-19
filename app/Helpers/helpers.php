<?php

use Laravolt\Avatar\Facade as Avatar;

function getAvatar($userName)
{
    return Avatar::create($userName)->toBase64();
}
