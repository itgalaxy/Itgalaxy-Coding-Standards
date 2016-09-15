<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

class ForbiddenFunctionsSniff extends \Generic_Sniffs_PHP_ForbiddenFunctionsSniff
{
    /**
     * A list of forbidden functions with their alternatives.
     *
     * The value is NULL if no alternative exists. IE, the
     * function should just not be used.
     *
     * @var array(string => string|null)
     */
    public $forbiddenFunctions = [];

    protected $defaultForbiddenFunctions = [
        'die' => 'exit',
        'sizeof' => 'count',
        'delete' => 'unset',
        'print' => 'echo',
        'print_r' => null,
        'is_null' => null,
        'create_function' => null,
        'chop' => 'rtrim',
        'diskfreespace' => 'disk_free_space',
        'doubleval' => 'floatval',
        'fputs' => 'fwrite',
        'gzputs' => 'gzwrite',
        'strchr' => 'strstr',
        'recode' => 'recode_string',
        'pos' => 'current',
        'key_exists' => 'array_key_exists',
        'join' => 'implode',
        'is_writeable' => 'is_writable',
        'is_real' => 'is_float',
        'is_long' => 'is_int',
        'is_integer' => 'is_int',
        'is_double' => 'is_float',
        'dl' => null,
        'error_reporting' => null,
        'ini_alter' => null,
        'ini_restore' => null,
        'ini_set' => null,
        'magic_quotes_runtime' => null,
        'set_magic_quotes_runtime' => null,
        'apache_setenv' => null,
        'putenv' => null,
        'set_include_path' => null,
        'restore_include_path' => null,
        '_' => 'gettext',
        'phpinfo' => null,
        'extract' => null,
        'session_commit' => 'session_write_close',
        'session_is_registered' => null,
        'session_register' => null,
        'session_unregister' => null,
        'show_source' => 'highlight_file',
        'var_export' => null,
        'error_log' => null,
        'var_dump' => null,
        'user_error' => 'trigger_error',
        'set_error_handler' => null,
        'debug_print_backtrace' => null,
        'split' => null,
        'spliti' => null,
        'ereg' => null,
        'ereg_replace' => null,
        'register_globals' => null,
        'urlencode' => 'rawurlencode',
        'urldecode' => 'rawurldecode'
    ];

    /**
     * Returns an array of tokens this test wants to listen for.
     *
     * @return array
     */
    public function register()
    {
        $this->forbiddenFunctions = array_merge($this->defaultForbiddenFunctions, $this->forbiddenFunctions);

        return parent::register();
    }
}
