<?php

require 'database.php';

class ClaseAdmin
{

 
    public function getClientes()
    {
        global $conn; //para poder usarla en nuestros metodos
        $query = $conn->prepare('SELECT * FROM users');
        $query->execute();
        return $query->fetchAll();
    }

    public function getPedidos()
    {
        global $conn; //para poder usarla en nuestros metodos
        $query = $conn->prepare('SELECT * FROM pedidos');
        $query->execute();
        return $query->fetchAll();
    }

 
 
}
