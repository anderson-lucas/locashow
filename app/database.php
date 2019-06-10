<?php

const DB_HOST = '192.168.0.14';
const DB_USER = 'root';
const DB_PASS = 'root';
const DB_NAME = 'db_locashow';
const DB_PORT = 6603;

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if (mysqli_connect_errno()) {
    printf("Conexão com o banco de dados falhou: %s\n", mysqli_connect_error());
    exit;
}