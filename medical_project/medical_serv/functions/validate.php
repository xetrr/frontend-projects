<?php


function checkEmpty($value)
{
    if (empty($value)) {
        return false;
    } else {
        return true;
    }
}


function isEmpty($value)
{
    return empty($value);
}

function isValidEmail($value)
{
    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}


function isGreaterThan($value, $min)
{
    if (trim(strlen($value)) <= $min) {

        return false;
    }
    return true;
}
