<?php
/**
 * Created by PhpStorm.
 * Date: 31/10/2018
 * Time: 1:42 CH
 */

namespace common\components;

use yii\base\Exception;
use Yii;

class Encryption
{
    protected $pubkey = <<<EOD
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCjubDHHrt1m3hSc6d/MHnYM/iI
CobvlVSuUGJZlQk04GWhAT++FiFxAsKd4UVAZaUvkMFJQzD850JMlBSaTtUOgE44
RQGmWeNHr1+WFLSeYx15p4yKlPdLDq+kheJQCQLkSjhj+pdgTrgmpCqn7pennJ8r
YOAfvyQmf7ByI+MPnwIDAQAB
-----END PUBLIC KEY-----
EOD;

    protected $privkey = <<<EOD
-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQCjubDHHrt1m3hSc6d/MHnYM/iICobvlVSuUGJZlQk04GWhAT++
FiFxAsKd4UVAZaUvkMFJQzD850JMlBSaTtUOgE44RQGmWeNHr1+WFLSeYx15p4yK
lPdLDq+kheJQCQLkSjhj+pdgTrgmpCqn7pennJ8rYOAfvyQmf7ByI+MPnwIDAQAB
AoGBAJB/xa6nyAkPUw1qN61AqnkPvUzMBbWUFW3XUkYADGUXm3qTMJ/ixlcIeZ2A
AW/JhhXJ611uqOC8dj5B/0EFTHGbS6yaIJxsRDP2wtk1rqnrL7f74vr+AkByxaWN
eRLqBoPUxd5clo1fcUoQ6QqeklFLU3ASukLVFwS906HxjX0pAkEA1UFuC5JPzABJ
DgTU16cXirJaVlFKe5CfeLAxyiCcusxZuce468QPK04Pz35IapuPgfOKtCh2gG3M
PjA7PsFzFQJBAMSKw/nPsCYYkKaOSTkEVxzIbK4I0CU9RKOHCPUqv4DANLaXydIM
jHxQp9K+P0CVJK4IZvJTsLN7cJb7RPyC9OMCQD92VDhPVz3fS95HI8v1ZrUYtHeB
g4fYFw0Eahy7rciNLZpyzB4lX1pExcG60/QdzQwgHMPWUsWPZzuOgOMBEK0CQQDB
SccaMsqFbLs1UdFpJX+WavWW4kvxk6OhPvfsRLI5KM2ulPCChpzS1W92rmr+VK7S
CKlVwECTAt7jXRGnVBMJAkBBRYEbM2xRtRuHhBLr9kpgcn3ExNHaoZO/39wKTZRq
+58G/aQzmrm4PKQfDzDRnku0WJLGdh6BHVF2fc+x7QBy
-----END RSA PRIVATE KEY-----
EOD;


    public function signature($data)
    {
        //create signature
        openssl_sign($data, $signature, $this->privkey, OPENSSL_ALGO_SHA1);
        return urlencode(base64_encode($signature));
    }

    public function encrypt($data)
    {
        openssl_public_encrypt($data, $data_encrypted, $this->pubkey);
        $data_encrypted = base64_encode($data_encrypted);
        return urlencode($data_encrypted);
    }

    public function decrypt($data)
    {
        openssl_private_decrypt(base64_decode(urldecode($data)), $data_decrypted, $this->privkey);
        return $data_decrypted;
    }

    public function verify($data, $signature)
    {
        $ok = openssl_verify(($data), base64_decode(urldecode($signature)), $this->pubkey, OPENSSL_ALGO_SHA1);
        return $ok;
    }
}