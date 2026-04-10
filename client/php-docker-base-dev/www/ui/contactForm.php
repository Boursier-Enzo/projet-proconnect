<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form action="" method="POST">
        <div class="nom">
            <label for="nom">Nom complet :</label>
            <input type="text" placeholder="Jean Dupont">
        </div>
        <div class="email">
            <label for="email">Email :</label>
            <input type="mail" placeholder="jean@example.com">
        </div>
        <div class="phone">
            <label for="phone">Téléphone :</label>
            <input type="tel" placeholder="+33 6 00 00 00 00">
        </div>
        <div class="desired_date">
            <label for="desired_date">Créneau souhaité :</label>
            <input type="date">
        </div>
        <div class="subject">
            <label for="subject">Objet de la demande</label>
            <textarea name="subject" placeholder="Décrivez votre demande en détail..."></textarea>
        </div>
        <button type="submit">Envoyer ma demande</button>
    </form>
</body>
</html>