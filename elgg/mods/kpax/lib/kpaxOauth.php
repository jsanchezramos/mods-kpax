<?php

/**
 * Description of kpaxOauth
 * http://www.hackingballz.com/herramientas/ofuscar-codigos.html
 *
 * @author juanfrasr
 */

class kpaxOauth {
    const URL = 'http://kpax.uoc.es/elgg/';
    const API_URL = 'http://kpax.uoc.es/webapps/svrKpax/';
    const VERSION = '1.0';
    const FORMAT = 'json';

    // Oauth

    private $oauth;
    private $key = 'kpax.module';
    private $secret = '__unused__';

    public function setKeySecret($key = '',$secret = ''){
        $this->key = $key;
        $this->secret = $secret;
    }
    
    public function getSignature($method = 'GET',$toUrl = '') {

        $hmac_method = new KpaxOAuthSignatureMethod_RSA_SHA1();

        $test_consumer = new OAuthConsumer($this->key, $this->secret, "about:blank");

        $acc_req = OAuthRequest::from_consumer_and_token($test_consumer, null, $method, $toUrl,null);
        $acc_req->sign_request($hmac_method, $test_consumer, null);

        return $acc_req->to_url();
    }

    public function test() {
  
        $consumer = new OAuthConsumer($this->key, $this->secret);

        $api_endpoint = 'http://localhost:8080/webapps/svrKpax/user/sign/elgg';
        

        $parameters = null;
        $req = OAuthRequest::from_consumer_and_token($consumer, null, "GET", $api_endpoint, $parameters);
        $sig_method = new KpaxOAuthSignatureMethod_RSA_SHA1();
        $req->sign_request($sig_method, $consumer, null); //note: double entry of token
        //get data using signed url
        
        $ch = curl_init($req->to_url());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, true);
        $res = curl_exec($ch);

        echo $res;
        curl_close($ch);
    }

}

?>
