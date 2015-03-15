<?php
/**
 * Created by PhpStorm.
 * User: leosjoberg
 * Date: 07/03/15
 * Time: 23:34
 */

class AmsterdamAPI {
    private $baseUrl = 'http://api.tandem15.eu/';

    private $key;
    private $secret;

    /**
     * AmsterdamAPI constructor.
     * @param $key
     * @param $secret
     */
    public function __construct($key, $secret)
    {
        $this->key = $key;
        $this->secret = $secret;
    }


    private function curl($url, $data = [])
    {
        $data['key'] = $this->key;
        $data['secret'] = password_hash($this->key . $this->secret, PASSWORD_BCRYPT);
        $finalUrl = $this->baseUrl . $url;
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL, $finalUrl);
        if (count($data) > 0) {
            curl_setopt($ch,CURLOPT_POST, 1);
            curl_setopt($ch,CURLOPT_POSTFIELDS, http_build_query($data));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /* Methods for retrieving posts */
    public function posts()
    {
        return $this->curl('posts');
    }

    public function post($id)
    {
        return $this->curl('posts/' . $id);
    }
    
    /* Methods for retrieving material from task 1 */
    public function taskOneByCommittee($committee)
    {
        return $this->curl('task1/' . $committee);
    }

    /* Methods for retrieving tickets */
    public function tickets()
    {
        return $this->curl('tickets');
    }

    public function ticket($id)
    {
        return $this->curl('tickets/' . $id);
    }

    public function createTicket($data)
    {
        return ($this->curl('tickets', $data));
    }
}