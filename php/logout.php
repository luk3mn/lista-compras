<?php
# inicia uma nova sessão
session_start();
# Deleta a sessão
session_unset();
# destroi a sessão
session_destroy();
# redireciona para a página de login
header('location: ../index.php');