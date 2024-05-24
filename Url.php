<?php

class Url extends Model {
    public function insertUrl($url, $code) {
        $this->query('INSERT INTO urls (url, code) VALUES (:url, :code)');
        $this->bind(':url', $url);
        $this->bind(':code', $code);
        $this->execute();
    }

    public function findUrl($url) {
        $this->query('SELECT * FROM urls WHERE url = :url');
        $this->bind(':url', $url);
        return $this->single();
    }

    public function getUrl($code) {
        $this->query('SELECT url FROM urls WHERE code = :code');
        $this->bind(':code', $code);
        $result = $this->single();
        return $result ? $result['url'] : false;
    }
}
