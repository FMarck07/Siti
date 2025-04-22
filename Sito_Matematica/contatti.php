<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    exit;
}
?>

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal form
    $nome = htmlspecialchars($_POST['nome']);
    $cognome = htmlspecialchars($_POST['cognome']);
    $email = htmlspecialchars($_POST['email']);
    $oggetto = htmlspecialchars($_POST['oggetto']);
    $messaggio = htmlspecialchars($_POST['messaggio']);
    
    // Validazione
    if (empty($nome) || empty($cognome) || empty($email) || empty($messaggio)) {
        header('Location: ../errore.html?msg=dati_mancanti');
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../errore.html?msg=email_non_valida');
        exit;
    }
    
    // Email di destinazione
    $destinatario = "tuaemail@esempio.com";
    
    // Costruisci l'oggetto e il corpo della mail
    $subject = "Nuovo messaggio da LIMITI MATEMATICI: $oggetto";
    $body = "Hai ricevuto un nuovo messaggio:\n\n";
    $body .= "Nome: $nome $cognome\n";
    $body .= "Email: $email\n";
    $body .= "Oggetto: $oggetto\n\n";
    $body .= "Messaggio:\n$messaggio\n";
    
    // Intestazioni della mail
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Invia la mail
    if (mail($destinatario, $subject, $body, $headers)) {
        header('Location: ../grazie.html');
        exit;
    } else {
        header('Location: ../errore.html?msg=invio_fallito');
        exit;
    }
}
?>