<?php

declare(strict_types=1);

namespace App;

class View
{
    public function render(string $page, array $params = []): void
    {
        $params = $this->escape($params);
        require_once("C:/xampp/htdocs/app/templates/layout.php");
    }
    
    private function escape(array $params): array
    {
        $clearParams = [];

        foreach ($params as $key => $param) {
            if(is_array($param)) {
                $clearParams[$key] = $this->escape($param);
            } else {
                $clearParams[$key] = htmlentities((string)$param); 
            }
        }
        return $clearParams;
    }
}

