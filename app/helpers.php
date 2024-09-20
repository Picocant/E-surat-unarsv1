<?php

use Illuminate\Support\Facades\Gate;

function can(string $ability)
{
    return Gate::allows($ability);
}

function canAny(array $abilities)
{
    foreach ($abilities as $ability) {
        if (can($ability)) return true;
    }
    return false;
}

function canAll(array $abilities)
{
    foreach ($abilities as $ability) {
        if (can($ability) == false) return false;
    }
    return true;
}

function gate(string $ability)
{
    if (!Gate::allows($ability)) {
        abort(403);
    }
}

function active_when($routeName)
{
    if (request()->routeIs($routeName)) {
        return 'active';
    }
    return '';
}

function format_string($format, $string)
{
    $stringSplit = str_split($string);
    $formatSplit = str_split($format);
    $result = '';

    for ($i = 0; $i < sizeof($stringSplit); $i++) {
        if ($formatSplit[0] == '%') {
            $result .= $stringSplit[$i];
        } else {
            $result .= $formatSplit[0];
            $i--;
        }
        array_shift($formatSplit);
    }
    return $result;
}

function format_nip($nip)
{
    return format_string('%%%%%%%% %%%%%% % %%%', $nip);
}
