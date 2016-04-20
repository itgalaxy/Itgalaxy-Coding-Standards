<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

class DirectlyFromUserInputSniff implements \PHP_CodeSniffer_Sniff
{
    public $functions = [
        // Assert
        'assert',
        // Callback Function
        'ob_start',
        'array_diff_uassoc',
        'array_diff_ukey',
        'array_filter',
        'array_intersect_uassoc',
        'array_intersect_ukey',
        'array_map',
        'array_reduce',
        'array_udiff_assoc',
        'array_udiff_uassoc',
        'array_udiff',
        'array_uintersect_assoc',
        'array_uintersect_uassoc',
        'array_uintersect',
        'array_walk_recursive',
        'array_walk',
        'assert_options',
        'uasort',
        'uksort',
        'usort',
        'preg_replace_callback',
        'spl_autoload_register',
        'iterator_apply',
        'call_user_func',
        'call_user_func_array',
        'register_shutdown_function',
        'register_tick_function',
        'set_error_handler',
        'set_exception_handler',
        'session_set_save_handler',
        'sqlite_create_aggregate',
        'sqlite_create_function',
        // File system function
        'basename',
        'chgrp',
        'chmod',
        'chown',
        'clearstatcache',
        'copy',
        'delete',
        'dirname',
        'disk_free_space',
        'disk_total_space',
        'diskfreespace',
        'fclose',
        'feof',
        'fflush',
        'fgetc',
        'fgetcsv',
        'fgets',
        'fgetss',
        'file_exists',
        'file_get_contents',
        'file_put_contents',
        'file',
        'fileatime',
        'filectime',
        'filegroup',
        'fileinode',
        'filemtime',
        'fileowner',
        'fileperms',
        'filesize',
        'filetype',
        'flock',
        'fnmatch',
        'fopen',
        'fpassthru',
        'fputcsv',
        'fputs',
        'fread',
        'fscanf',
        'fseek',
        'fstat',
        'ftell',
        'ftruncate',
        'fwrite',
        'glob',
        'is_dir',
        'is_executable',
        'is_file',
        'is_link',
        'is_readable',
        'is_uploaded_file',
        'is_writable',
        'is_writeable',
        'lchgrp',
        'lchown',
        'link',
        'linkinfo',
        'lstat',
        'mkdir',
        'move_uploaded_file',
        'parse_ini_file',
        'parse_ini_string',
        'pathinfo',
        'readfile',
        'readlink',
        'realpath_cache_get',
        'realpath_cache_size',
        'realpath',
        'rename',
        'rewind',
        'rmdir',
        'set_file_buffer',
        'stat',
        'symlink',
        'tempnam',
        'tmpfile',
        'touch',
        'umask',
        'unlink',
        // From http://www.php.net/manual/en/ref.dir.php except function that use directory handle as parameter
        'chdir',
        'chroot',
        'dir',
        'opendir',
        'scandir',
        // From http://ca2.php.net/manual/en/function.mime-content-type.php
        'finfo_open',
        // From http://ca2.php.net/manual/en/book.xattr.php
        'xattr_get',
        'xattr_list',
        'xattr_remove',
        'xattr_set',
        'xattr_supported',
        // From http://www.php.net/manual/en/function.readgzfile.php
        'readgzfile',
        'gzopen',
        'gzfile',
        // From http://www.php.net/manual/en/ref.image.php
        'getimagesize',
        'imagecreatefromgd2',
        'imagecreatefromgd2part',
        'imagecreatefromgd',
        'imagecreatefromgif',
        'imagecreatefromjpeg',
        'imagecreatefrompng',
        'imagecreatefromwbmp',
        'imagecreatefromwebp',
        'imagecreatefromxbm',
        'imagecreatefromxpm',
        'imagepsloadfont',
        'jpeg2wbmp',
        'png2wbmp',
        // 2nd params only, maybe make it standalone and check just the second param?
        'image2wbmp',
        'imagegd2',
        'imagegd',
        'imagegif',
        'imagejpeg',
        'imagepng',
        'imagewbmp',
        'imagewebp',
        'imagexbm',
        // From http://www.php.net/manual/en/ref.exif.php
        'exif_imagetype',
        'exif_read_data',
        'exif_thumbnail',
        'read_exif_data',
        // From http://www.php.net/manual/en/ref.hash.php
        'hash_file',
        'hash_hmac_file',
        'hash_update_file',
        // From http://www.php.net/manual/en/ref.misc.php
        'highlight_file',
        'php_check_syntax',
        'php_strip_whitespace',
        'show_source',
        // Various functions that open/read files
        'get_meta_tags',
        'hash_file',
        'hash_hmac_file',
        'hash_update_file',
        'md5_file',
        'sha1_file',
        'bzopen',
        // Function handling
        'create_function',
        'call_user_func',
        'call_user_func_array',
        'forward_static_call',
        'forward_static_call_array',
        'function_exists',
        'register_shutdown_function',
        'register_tick_function',
        // Systemexec
        'exec',
        'passthru',
        'proc_open',
        'popen',
        'shell_exec',
        'system',
        'pcntl_exec',
        // FTP
        'ftp_alloc',
        'ftp_cdup',
        'ftp_chdir',
        'ftp_chmod',
        'ftp_close',
        'ftp_connect',
        'ftp_delete',
        'ftp_exec',
        'ftp_fget',
        'ftp_fput',
        'ftp_get_option',
        'ftp_get',
        'ftp_login',
        'ftp_mdtm',
        'ftp_mkdir',
        'ftp_nb_continue',
        'ftp_nb_fget',
        'ftp_nb_fput',
        'ftp_nb_get',
        'ftp_nb_put',
        'ftp_nlist',
        'ftp_pasv',
        'ftp_put',
        'ftp_pwd',
        'ftp_quit',
        'ftp_raw',
        'ftp_rawlist',
        'ftp_rename',
        'ftp_rmdir',
        'ftp_set_option',
        'ftp_site',
        'ftp_size',
        'ftp_ssl_connect',
        'ftp_systype'
    ];

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
        return [T_STRING];
    }

    /**
     * Processes the tokens that this sniff is interested in.
     *
     * @param \PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int $stackPtr  The position in the stack where the token was found.
     *
     * @return void
     */

    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (in_array($tokens[$stackPtr]['content'], $this->functions)) {
            if ($tokens[$stackPtr]['content'] == 'symlink') {
                $phpcsFile->addError(
                    'Allowing symlink() while open_basedir is used is actually a security risk. '
                        . 'Disabled by default in Suhosin >= 0.9.6',
                    $stackPtr,
                    'WarnSymlink'
                );
            }

            $prev = $phpcsFile->findPrevious(
                \PHP_CodeSniffer_Tokens::$emptyTokens,
                $stackPtr - 1,
                null,
                true
            );

            // Return if function of the class
            if ($tokens[$prev]['code'] === T_OBJECT_OPERATOR
                || $tokens[$prev]['code'] === T_DOUBLE_COLON
            ) {
                return;
            }

            $opener = $phpcsFile->findNext(T_OPEN_PARENTHESIS, $stackPtr, null, false, null, true);

            // If function not have parenthesis
            if ($tokens[$opener]['code'] !== T_OPEN_PARENTHESIS) {
                return;
            }

            $closer = $tokens[$opener]['parenthesis_closer'];
            $s = $stackPtr + 1;
            $s = $phpcsFile->findNext(
                array_merge(
                    \PHP_CodeSniffer_Tokens::$emptyTokens,
                    \PHP_CodeSniffer_Tokens::$bracketTokens,
                    [
                        T_CONSTANT_ENCAPSED_STRING,
                        T_COMMA,
                        T_LNUMBER,
                        T_DNUMBER
                    ],
                    [T_STRING_CONCAT]
                ),
                $s,
                $closer,
                true
            );

            if ($s) {
                if ($this->isTokenUserInput($tokens[$s])) {
                    $phpcsFile->addError(
                        'Function '
                            . $tokens[$stackPtr]['content']
                            . '() detected with parameter directly from user input',
                        $stackPtr,
                        'ParameterDirectlyFromUserInput'
                    );
                }
            }
        }
    }

    // Todo maybe another function disable
    protected function isTokenUserInput($t)
    {
        if ($t['code'] == T_VARIABLE) {
            if (preg_match('/\$\{?_(GET|POST|REQUEST|COOKIE|SERVER|FILES|ENV|GLOBALS|SESSION)/', $t['content'])) {
                return true;
            }
        } elseif ($t['code'] == T_STRING) {
            if (preg_match('/^(getenv|apache_getenv)$/', $t['content'])) {
                return true;
            }
        }

        return false;
    }
}
