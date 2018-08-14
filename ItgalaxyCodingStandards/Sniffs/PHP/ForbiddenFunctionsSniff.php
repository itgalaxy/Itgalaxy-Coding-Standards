<?php
namespace ItgalaxyCodingStandards\Sniffs\PHP;

use PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff as GenericForbiddenFunctionsSniff;

// Todo need working with classes

class ForbiddenFunctionsSniff extends GenericForbiddenFunctionsSniff
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
        '_' => 'gettext',
        'call_user_method' => 'call_user_func',
        'call_user_method_array' => 'call_user_func_array',
        'chop' => 'rtrim',
        'close' => 'closedir',
        'define_syslog_variables' => null,
        'delete' => 'unset',
        'die' => 'exit',
        'diskfreespace' => 'disk_free_space',
        'eval' => null,
        'fputs' => 'fwrite',
        'gzputs' => 'gzwrite',
        'i18n_convert' => 'mb_convert_encoding',
        'i18n_discover_encoding' => 'mb_detect_encoding',
        'i18n_http_input' => 'mb_http_input',
        'i18n_http_output' => 'mb_http_output',
        'i18n_internal_encoding' => 'mb_internal_encoding',
        'i18n_ja_jp_hantozen' => 'mb_convert_kana',
        'i18n_mime_header_decode' => 'mb_decode_mimeheader',
        'i18n_mime_header_encode' => 'mb_encode_mimeheader',
        'imap_create' => 'imap_createmailbox',
        'imap_fetchtext' => 'imap_body',
        'imap_getmailboxes' => 'imap_list_full',
        'imap_getsubscribed' => 'imap_lsub_full',
        'imap_header' => 'imap_headerinfo',
        'imap_listmailbox' => 'imap_list',
        'imap_listsubscribed' => 'imap_lsub',
        'imap_rename' => 'imap_renamemailbox',
        'imap_scan' => 'imap_listscan',
        'imap_scanmailbox' => 'imap_listscan',
        'import_request_variables' => null,
        'is_double' => 'is_float',
        'is_integer' => 'is_int',
        'is_long' => 'is_int',
        'is_null' => null,
        'is_real' => 'is_float',
        'is_writeable' => 'is_writable',
        'join' => 'implode',
        'key_exists' => 'array_key_exists',
        'ldap_close' => 'ldap_unbind',
        'mbstrcut' => 'mb_strcut',
        'mbstrlen' => 'mb_strlen',
        'mbstrpos' => 'mb_strpos',
        'mbstrrpos' => 'mb_strrpos',
        'mbsubstr' => 'mb_substr',
        'msql' => 'msql_db_query',
        'msql_createdb' => 'msql_create_db',
        'msql_dbname' => 'msql_result',
        'msql_dropdb' => 'msql_drop_db',
        'msql_fieldflags' => 'msql_field_flags',
        'msql_fieldlen' => 'msql_field_len',
        'msql_fieldname' => 'msql_field_name',
        'msql_fieldtable' => 'msql_field_table',
        'msql_fieldtype' => 'msql_field_type',
        'msql_freeresult' => 'msql_free_result',
        'msql_listdbs' => 'msql_list_dbs',
        'msql_listfields' => 'msql_list_fields',
        'msql_listtables' => 'msql_list_tables',
        'msql_numfields' => 'msql_num_fields',
        'msql_numrows' => 'msql_num_rows',
        'msql_regcase' => null,
        'msql_selectdb' => 'msql_select_db',
        'msql_tablename' => 'msql_result',
        'mssql_affected_rows' => 'sybase_affected_rows',
        'mssql_close' => 'sybase_close',
        'mssql_connect' => 'sybase_connect',
        'mssql_data_seek' => 'sybase_data_seek',
        'mssql_fetch_array' => 'sybase_fetch_array',
        'mssql_fetch_field' => 'sybase_fetch_field',
        'mssql_fetch_object' => 'sybase_fetch_object',
        'mssql_fetch_row' => 'sybase_fetch_row',
        'mssql_field_seek' => 'sybase_field_seek',
        'mssql_free_result' => 'sybase_free_result',
        'mssql_get_last_message' => 'sybase_get_last_message',
        'mssql_min_client_severity' => 'sybase_min_client_severity',
        'mssql_min_error_severity' => 'sybase_min_error_severity',
        'mssql_min_message_severity' => 'sybase_min_message_severity',
        'mssql_min_server_severity' => 'sybase_min_server_severity',
        'mssql_num_fields' => 'sybase_num_fields',
        'mssql_num_rows' => 'sybase_num_rows',
        'mssql_pconnect' => 'sybase_pconnect',
        'mssql_query' => 'sybase_query',
        'mssql_result' => 'sybase_result',
        'mssql_select_db' => 'sybase_select_db',
        'mysql' => 'mysql_db_query',
        'mysqli_bind_param' => 'mysqli_stmt_bind_param',
        'mysqli_bind_result' => 'mysqli_stmt_bind_result',
        'mysqli_client_encoding' => 'mysqli_character_set_name',
        'mysqli_fetch' => 'mysqli_stmt_fetch',
        'mysqli_get_metadata' => 'mysqli_stmt_result_metadata',
        'mysqli_param_count' => 'mysqli_stmt_param_count',
        'mysqli_send_long_data' => 'mysqli_stmt_send_long_data',
        'ob_end_flush' => 'use ob_get_contents() and ob_end_clean() instead',
        'oci8append' => 'ocicollappend',
        'oci8assign' => 'ocicollassign',
        'oci8assignelem' => 'ocicollassignelem',
        'oci8close' => 'ocicloselob',
        'oci8free' => 'ocifreecoll',
        'oci8getelem' => 'ocicollgetelem',
        'oci8load' => 'ociloadlob',
        'oci8max' => 'ocicollmax',
        'oci8ocifreecursor' => 'ocifreestatement',
        'oci8save' => 'ocisavelob',
        'oci8savefile' => 'ocisavelobfile',
        'oci8size' => 'ocicollsize',
        'oci8trim' => 'ocicolltrim',
        'oci8writetemporary' => 'ociwritetemporarylob',
        'oci8writetofile' => 'ociwritelobtofile',
        'odbc_do' => 'odbc_exec',
        'odbc_field_precision' => 'odbc_field_len',
        'pdf_add_outline' => 'pdf_add_bookmark',
        'pg_clientencoding' => 'pg_client_encoding',
        'pg_setclientencoding' => 'pg_set_client_encoding',
        'pos' => 'current',
        'print' => 'echo',
        'recode' => 'recode_string',
        'register_globals' => null,
        'session_commit' => 'session_write_close',
        'session_is_registered' => 'use $_SESSION instead',
        'session_register' => 'use $_SESSION instead',
        'session_unregister' => 'use $_SESSION instead',
        'set_error_handler' => null,
        'set_socket_blocking' => 'stream_set_blocking',
        'setTimeZoneID' => 'use datefmt_set_timezone or IntlDateFormatter::setTimeZone instead',
        'show_source' => 'highlight_file',
        'sizeof' => 'count',
        'strchr' => 'strstr',
        'strcut' => 'mb_strcut',
        'stripos' => 'mb_stripos',
        'stristr' => 'mb_stristr',
        'strlen' => 'mb_strlen',
        'strpos' => 'mb_strpos',
        'strrchr' => 'mb_strrichr',
        'strripos' => 'mb_strripos',
        'strrpos' => 'mb_strrpos',
        'strstr' => 'mb_strstr',
        'strtolower' => 'mb_strtolower',
        'strtoupper' => 'mb_strtoupper',
        'strwidth' => 'mb_strwidth',
        'substr' => 'mb_substr',
        'substr_count' => 'mb_substr_count',
        'trimwidth' => 'mb_strimwidth',
        'xptr_new_context' => 'xpath_new_context',
        // Development functions.

        // Debug code should not normally be used in production.
        'error_log' => null,
        'var_dump' => null,
        'var_export' => null,
        'print_r' => null,
        'user_error' => null,
        'trigger_error' => null,
        'debug_backtrace' => null,
        'debug_print_backtrace' => null,

        // Prevent_path_disclosure
        'error_reporting' => null,
        'phpinfo' => null,

        // Urlencode
        'urldecode' => 'rawurldecode',
        'urlencode' => 'rawurlencode',

        // Runtime configuration
        'ini_alter' => null,
        'ini_restore' => null,
        'ini_set' => null,
        'apache_setenv' => null,
        'putenv' => null,
        'set_include_path' => null,
        'restore_include_path' => null,
        // This alias was DEPRECATED in PHP 5.3.0, and REMOVED as of PHP 7.0.0.
        'magic_quotes_runtime' => null,
        'get_magic_quotes_runtime' => null,
        // Warning This function was DEPRECATED in PHP 5.3.0, and REMOVED as of PHP 7.0.0.
        'set_magic_quotes_runtime' => null,
        'get_magic_quotes_gpc' => null,
        // Warning This function was removed from most SAPIs in PHP 5.3.0, and was removed from PHP-FPM in PHP 7.0.0.
        'dl' => null,

        // `extract`
        'extract' => null,

        // `ereg`
        'ereg' => null,
        'eregi' => null,
        'sql_regcase' => null,
        'mb_ereg' => null,
        'mb_eregi' => null,

        // `ereg_replace`
        'ereg_replace' => null,
        'eregi_replace' => null,
        'mb_ereg_replace' => null,
        'mb_eregi_replace'  => null,

        // `split`
        'split' => null,
        'spliti' => null,

        // `create_function`
        'create_function' => null,

        // Type casting
        'intval' => 'use `(int) $var` instead',
        'floatval' => 'use `(float) $var` instead',
        'doubleval' => 'use `(double) $var` instead',
        'strval' => 'use `(str) $var` instead',
        'boolval' => 'use `(bool) $var` instead'
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
