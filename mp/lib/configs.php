<?php
	define('titulo_site', 'PAGAMENTO'); //Título do site
	define('url_site', 'http://localhost:8080/crypto/');  //URL do site OBRIGATÓRIO
	define('client_id', '7513369674826269'); //Vai precisar pegar no MP
	define('client_secret', 'oVLk3fFEzjRk44LEA80YKOh2hgOggxyD'); //Vai precisar pegar no MP
	define('email', 'cryptovortex@outlook.com.br'); //Email que receberá os e-mails


    function sendMail($nome, $sobrenome, $email, $telefone, $valor, $status){
        $to = email;
        $subject = 'PAGAMENTO EFETUADO!';
        $headers = "From:" . email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $message = '<html><body>';
        $message .=
            '
            <h1>Olá, você recebeu um novo pagamento!</h1>
            <hr>
            <h2>Dados do pagante:</h2>
            <p><b>Nome:</b> '.$nome.' '.$sobrenome.'</p>
            <p><b>Email:</b> '.$email.' </p>
            <p><b>Telefone:</b> '.$telefone.' </p>
            <p><b>Valor:</b> <code> R$ '.$valor.' </code>
            <p><b>Status:</b> '.$status.' </p>
            <hr>
            <p>Obs: Confirme o pagamento na conta do MercadoPago antes de efetuar a liberação.</p>
            </p>';
        $message .= '</body></html>';

        mail($to, $subject, $message, $headers);
    }
?>