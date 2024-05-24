<?php

use Ramsey\Uuid\Uuid;

class UrlController extends Controller {
    public function index() {
        $this->view('index');
    }

    public function shorten() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = $_POST['url'];

            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $this->view('index', ['error' => 'Invalid URL']);
                return;
            }

            $urlModel = $this->model('Url');
            $existingUrl = $urlModel->findUrl($url);

            if ($existingUrl) {
                $shortCode = $existingUrl['code'];
            } else {
                $shortCode = $this->generateShortCode();
                $urlModel->insertUrl($url, $shortCode);
            }

            $this->view('index', ['shortCode' => $shortCode]);
        }
    }

    public function redirect($code) {
        $urlModel = $this->model('Url');
        $url = $urlModel->getUrl($code);

        if ($url) {
            header('Location: ' . $url);
        } else {
            echo 'URL not found';
        }
    }

    private function generateShortCode() {
        $uuid = Uuid::uuid4();
        $shortCode = str_replace('-', '', $uuid->toString());
        return substr($shortCode, 0, 12);
    }
}
