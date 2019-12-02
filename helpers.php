<?php

function parseInputArgumets($argc, $argv)
{
    if ($argc !== 3) {
        echo 'Please run command ' . $argv[0] . ' as: php ' . $argv[0] . ' /path/to/user/qualifications /path/to/job/requirements';
        die;
    }

    return [$argv[1], $argv[2]];
}

function processQualifications($rawRequirements): array
{
    $requirements = [];

    $and = preg_split("/\sand\s/", $rawRequirements);

    foreach ($and as $variable) {
        $rawOr = preg_split("/\sor\s/", $variable);

        $or = array_map(function ($value) {
            $chunkedOr = [];
            preg_match_all("/\s*(an|a)*\s*([a-zA-Z\s\d']+)(,|.)*/", $value, $chunkedOr);

            return $chunkedOr[2][0];
        }, $rawOr);

        $requirements[] = $or;
    }

    return $requirements;
}