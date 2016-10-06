<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

class NoDeprecatedCryptoFunctionsSniff implements \PHP_CodeSniffer_Sniff
{
    public $cryptoFunctions = [
        'crypt',
        'md5',
        'md5_file',
        'sha1',
        'sha1_file',
        // http://php.net/manual/en/book.crack.php
        'crack_check',
        'crack_closedict',
        'crack_getlastmessage',
        'crack_opendict',
        // http://php.net/manual/en/book.mcrypt.php
        'mcrypt_cbc',
        'mcrypt_cfb',
        'mcrypt_create_iv',
        'mcrypt_decrypt',
        'mcrypt_ecb',
        'mcrypt_enc_get_algorithms_name',
        'mcrypt_enc_get_block_size',
        'mcrypt_enc_get_iv_size',
        'mcrypt_enc_get_key_size',
        'mcrypt_enc_get_modes_name',
        'mcrypt_enc_get_supported_key_sizes',
        'mcrypt_enc_is_block_algorithm_mode',
        'mcrypt_enc_is_block_algorithm',
        'mcrypt_enc_is_block_mode',
        'mcrypt_enc_self_test',
        'mcrypt_encrypt',
        'mcrypt_generic_deinit',
        'mcrypt_generic_end',
        'mcrypt_generic_init',
        'mcrypt_generic',
        'mcrypt_get_block_size',
        'mcrypt_get_cipher_name',
        'mcrypt_get_iv_size',
        'mcrypt_get_key_size',
        'mcrypt_list_algorithms',
        'mcrypt_list_modes',
        'mcrypt_module_close',
        'mcrypt_module_get_algo_block_size',
        'mcrypt_module_get_algo_key_size',
        'mcrypt_module_get_supported_key_sizes',
        'mcrypt_module_is_block_algorithm_mode',
        'mcrypt_module_is_block_algorithm',
        'mcrypt_module_is_block_mode',
        'mcrypt_module_open',
        'mcrypt_module_self_test',
        'mcrypt_ofb',
        'mdecrypt_generic',
        // https://secure.php.net/manual/ru/book.mhash.php
        'mhash_count',
        'mhash_get_block_size',
        'mhash_get_hash_name',
        'mhash_keygen_s2k',
        'mhash'
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
     * @param int                   $stackPtr  The position in the stack where
     *                                         the token was found.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (!in_array($tokens[$stackPtr]['content'], $this->cryptoFunctions)) {
            return;
        }

        $phpcsFile->addError(
            'Crypto function `'
                . $tokens[$stackPtr]['content']
                . '` is disable for security reason. Use instead password or openssl or hash api.',
            $stackPtr,
            'DeprecatedCryptoFunction'
        );
    }
}
