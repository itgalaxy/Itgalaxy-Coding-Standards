<?php
preg_filter('%test#', $replace, $subject);
preg_filter('/[а-я]/', $replace, $subject);
preg_filter('test', $replace, $subject);
preg_filter('imsxeADSUXJu', $replace, $subject);
preg_filter('/test/', $replace, $subject);
preg_filter('/[а-я]/e', $replace, $subject);
preg_filter('%test%imsxeADSUXJu', $replace, $subject);
preg_grep('/^(\d+)?\.\d+$/e', $array);
preg_match('/php/e', 'PHP is the web scripting language of choice.');
preg_match_all(
    '/\(?  (\d{3})?  \)?  (?(1)  [\-\s] ) \d{3}-\d{4}/e',
    'Calling 555-1212 or 1-800-555-1212',
    $phones
);
preg_replace('/\s\s+/e', ' ', 'foo   o');
preg_replace_callback(
    '/\[indent]((?:[^[]|\[(?!/?indent])|(?R))+)\[/indent]/e',
    'parseTagsRecursive',
    'up [indent] deep [indent] more deep [/indent] deep [/indent] up'
);
preg_filter();
