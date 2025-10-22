<?php


class HeaderModel {

    private function createData($page) : string {
        switch($page){
            case 'home':
                return 'Welkom';
            case 'about':
                return 'Over mij';
            case 'contact':
                return 'Contact';
            default:
                return 'Welkom';
        }
    }

    public function getHeader($page): string {
        return $this -> createData($page);
    }
}

?>