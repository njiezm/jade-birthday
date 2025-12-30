<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Billet - {{ $ticket->firstname }} {{ $ticket->lastname }}</title>
    <style>
        /* Le CSS doit être inclus directement dans la vue pour DomPDF */
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        .ticket-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: linear-gradient(135deg, #FF9A8B 0%, #FF6A88 100%);
            color: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .ticket-header {
            background-color: rgba(0,0,0,0.2);
            padding: 20px;
            text-align: center;
        }
        .ticket-header h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 900;
            letter-spacing: -1px;
        }
        .ticket-body {
            display: flex;
            padding: 30px;
        }
        .ticket-info {
            flex: 2;
            padding-right: 20px;
        }
        .ticket-info h2 {
            font-size: 1.8em;
            margin-top: 0;
        }
        .ticket-info p {
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        .ticket-qr {
            flex: 1;
            text-align: center;
            background-color: white;
            padding: 10px;
            border-radius: 10px;
        }
        .ticket-qr img {
            width: 150px;
            height: 150px;
        }
        .ticket-qr p {
            margin: 10px 0 0 0;
            color: #333;
            font-weight: bold;
        }
        .ticket-footer {
            background-color: rgba(0,0,0,0.2);
            padding: 15px 30px;
            text-align: center;
            font-size: 0.9em;
        }
        .ticket-details {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed rgba(255,255,255,0.5);
        }
    </style>
</head>
<body>

    <div class="ticket-container">
        <div class="ticket-header">
            <h1>THE 23 BELLINI FEST</h1>
        </div>
        <div class="ticket-body">
            <div class="ticket-info">
                <h2>{{ $ticket->firstname }} {{ $ticket->lastname }}</h2>
                <p><strong>Référence :</strong> {{ $order->reference }}</p>
                <p><strong>Date :</strong> 14 Mars 2026</p>
                <p><strong>Heure :</strong> 21:00 - 06:00</p>
                <p><strong>Lieu :</strong> Plan Bateau de Folie</p>
                
                <div class="ticket-details">
                    <p><strong>Email :</strong> {{ $order->email }}</p>
                    <p><strong>Prix :</strong> {{ $order->amount / count($order->tickets) }}€</p>
                </div>
            </div>
            <div class="ticket-qr">
                <img src="{{ public_path($ticket->qr_code_path) }}" alt="QR Code">
                <p>Scannez-moi !</p>
            </div>
        </div>
        <div class="ticket-footer">
            <p>Ce billet est nominatif et personnel. Une fois scanné, il ne sera plus valide.</p>
            <p>L'abus d'alcool est dangereux pour la santé. À consommer avec modération.</p>
        </div>
    </div>

</body>
</html>