<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos billets pour THE 23 BELLINI FEST</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #FF9A8B 0%, #FF6A88 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 900;
            letter-spacing: -1px;
        }
        .content {
            padding: 30px;
        }
        .ticket {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #FF6A88;
        }
        .ticket h3 {
            margin-top: 0;
            color: #FF6A88;
        }
        .qr-code {
            text-align: center;
            margin: 20px 0;
        }
        .qr-code img {
            max-width: 150px;
            height: auto;
        }
        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
        .btn {
            display: inline-block;
            background-color: #FF6A88;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>THE 23 BELLINI FEST</h1>
            <p>Merci pour votre achat !</p>
        </div>
        
        <div class="content">
            <p>Bonjour,</p>
            <p>Merci d'avoir acheté des billets pour THE 23 BELLINI FEST ! Voici le récapitulatif de votre commande :</p>
            
            <div class="ticket">
                <h3>Référence de commande : {{ $order->reference }}</h3>
                <p><strong>Email :</strong> {{ $order->email }}</p>
                <p><strong>Montant total :</strong> {{ $order->amount }}€</p>
                <p><strong>Statut :</strong> Payé</p>
            </div>
            
            <h3>Vos billets</h3>
            @foreach($order->tickets as $ticket)
            <div class="ticket">
                <h3>{{ $ticket->firstname }} {{ $ticket->lastname }}</h3>
                <p><strong>Date :</strong> 14 Mars 2026</p>
                <p><strong>Heure :</strong> 21:00 - 06:00</p>
                <p><strong>Lieu :</strong> Plan Bateau de Folie</p>
                
                <div class="qr-code">
                    <p>Présentez ce QR code à l'entrée :</p>
                    <img src="{{ asset($ticket->qr_code_path) }}" alt="QR Code">
                </div>
                
                <a href="{{ route('ticket.download', $ticket->id) }}" class="btn">Télécharger le billet (PDF)</a>
            </div>
            @endforeach
            
            <p>Nous vous attendons le 14 Mars 2026 pour une nuit inoubliable !</p>
            <p>Pensez à respecter le dress code : RED & PEACH FESTIVAL STYLE</p>
        </div>
        
        <div class="footer">
            <p>L'abus d'alcool est dangereux pour la santé. À consommer avec modération.</p>
            <p>&copy; 2026 Jade Birthday 23 - Bellini Fest</p>
        </div>
    </div>
</body>
</html>