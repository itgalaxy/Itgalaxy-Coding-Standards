<?php
namespace ItgalaxyCodingStandards\Sniffs\Security;

class CryptoFunctionDisableSniff implements \PHP_CodeSniffer_Sniff
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
        // https://secure.php.net/manual/en/book.csprng.php
        // 'random_bytes',
        // 'random_int',
        // http://php.net/manual/en/book.hash.php
        // 'hash_algos',
        // 'hash_copy',
        // 'hash_file',
        // 'hash_final',
        // 'hash_hmac_file',
        // 'hash_hmac',
        // 'hash_init',
        // 'hash_pbkdf2',
        // 'hash_update_file',
        // 'hash_update_stream',
        // 'hash_update',
        // 'hash',
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
        // http://php.net/manual/en/book.openssl.php
        // 'openssl_cipher_iv_length',
        // 'openssl_csr_export_to_file',
        // 'openssl_csr_export',
        // 'openssl_csr_get_public_key',
        // 'openssl_csr_get_subject',
        // 'openssl_csr_new',
        // 'openssl_csr_sign',
        // 'openssl_decrypt',
        // 'openssl_dh_compute_key',
        // 'openssl_digest',
        // 'openssl_encrypt',
        // 'openssl_error_string',
        // 'openssl_free_key',
        // 'openssl_get_cipher_methods',
        // 'openssl_get_md_methods',
        // 'openssl_get_privatekey',
        // 'openssl_get_publickey',
        // 'openssl_open',
        // 'openssl_pbkdf2',
        // 'openssl_pkcs12_export_to_file',
        // 'openssl_pkcs12_export',
        // 'openssl_pkcs12_read',
        // 'openssl_pkcs7_decrypt',
        // 'openssl_pkcs7_encrypt',
        // 'openssl_pkcs7_sign',
        // 'openssl_pkcs7_verify',
        // 'openssl_pkey_export_to_file',
        // 'openssl_pkey_export',
        // 'openssl_pkey_free',
        // 'openssl_pkey_get_details',
        // 'openssl_pkey_get_private',
        // 'openssl_pkey_get_public',
        // 'openssl_pkey_new',
        // 'openssl_private_decrypt',
        // 'openssl_private_encrypt',
        // 'openssl_public_decrypt',
        // 'openssl_public_encrypt',
        // 'openssl_random_pseudo_bytes',
        // 'openssl_seal',
        // 'openssl_sign',
        // 'openssl_spki_export_challenge',
        // 'openssl_spki_export',
        // 'openssl_spki_new',
        // 'openssl_spki_verify',
        // 'openssl_verify',
        // 'openssl_x509_check_private_key',
        // 'openssl_x509_checkpurpose',
        // 'openssl_x509_export_to_file',
        // 'openssl_x509_export',
        // 'openssl_x509_free',
        // 'openssl_x509_parse',
        // 'openssl_x509_read',
        // https://secure.php.net/manual/ru/book.mhash.php
        'mhash_count',
        'mhash_get_block_size',
        'mhash_get_hash_name',
        'mhash_keygen_s2k',
        'mhash'
        // http://php.net/manual/en/book.password.php
        // 'password_get_info',
        // 'password_hash',
        // 'password_needs_rehash',
        // 'password_verify',
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
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     */
    public function process(\PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();

        if (in_array($tokens[$stackPtr]['content'], $this->cryptoFunctions)) {
            $phpcsFile->addError(
                'Crypto function `'
                    . $tokens[$stackPtr]['content']
                    . '` is disable for security reason. Use instead password or openssl or hash api.',
                $stackPtr,
                'OlderCryptoFunc'
            );
        }
    }
}
