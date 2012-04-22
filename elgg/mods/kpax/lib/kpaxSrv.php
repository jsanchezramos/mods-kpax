<?php

/**
 * Class get information to service.
 *
 * @author juanfrasr
 */
class kpaxSrv {

    protected $url = "http://localhost:8080/webapps/svrKpax/";
    private $key;
    private $apiKey = "d647b78183383b0a4b8da7eb024b2d9f00b492dd";
    //private $apiKey = "870148ed6b226ba4c59816dfabd480726be9a572";
    private $oauthKpax = null;

    public function __construct($userName = "admin") {
        $this->oauthKpax = new kpaxOauth();
        $userName = str_replace("uoc.edu_", "", $userName); //Case uoc login
        $body = 'username=' . trim($userName . "&apikey=" . $this->apiKey);
        $_SESSION["campusSession"] = $this->service("user/sign/elgg", "POST", $body);
    }

    public function getKey() {
        return $this->key;
    }
    
    public function oauth($key,$secret){
        $this->oauthKpax->setKeySecret($key, $secret);
    }
        
    private function service($action, $type = "GET", $body = "", $header = "application/json") {
        $url = $this->oauthKpax->getSignature($type, $this->url . $action);
        $options = array('method' => $type,
            'header' => 'Content-type: ' . $header,
            'content' => $body);
        $type_post = array('http' => $options);
        $context = stream_context_create($type_post);

        return file_get_contents($url, false, $context);
    }

    public function getGame($gameId, $campusSession) {

        return json_decode($this->service("game/" . $campusSession . "/get/" . $gameId));
    }

    public function getListGames($campusSession) {
        var_dump($this->service("game/" . $campusSession . "/list"));
    }

    public function addLikeGame($campusSession, $containerId, $productId) {
        $body = 'secretSession=' . $campusSession . '&containerId=' . $containerId;
        $this->service("game/like/" . $productId . "/add", "POST", $body);
    }

    public function delLikeGame($campusSession, $containerId, $productId) {
        $body = 'secretSession=' . $campusSession . '&containerId=' . $containerId;
        $this->service("game/like/" . $productId . "/del", "POST", $body);
    }

    public function getLikesGame($campusSession, &$entity) {
        $listLike = json_decode($this->service("game/like/" . $campusSession . "/list/" . $entity->getGuid()));
        return $listLike;
    }

    public function getLikeGame($campusSession, $idEntity) {
        $objLike = json_decode($this->service("game/like/" . $campusSession . "/get/" . $idEntity));
        return $objLike;
    }

    public function addGame($campusSession, $name, $idGame) {
        $body = 'secretSession=' . $campusSession . '&name=' . $name . '&idGame=' . $idGame;
        return $this->service("game/add", "POST", $body);
    }

    public function delGame($campusSession, $idGame) {
        $body = 'secretSession=' . $campusSession;
        return $this->service("game/delete/" . $idGame, "POST", $body);
    }

    public function getScore($gameUid) {
        return json_decode($objScore = $this->service("game/score/" . $gameUid . "/list"));
    }

}

?>
