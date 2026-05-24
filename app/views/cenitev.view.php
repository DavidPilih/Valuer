<?php var_dump($cenitev)?>

    <p><strong>Naziv naročnika:</strong> <?= htmlspecialchars($cenitev->naziv_narocnika) ?></p>

    <p><strong>Naslov naročnika:</strong> <?= htmlspecialchars($cenitev->naslov_narocnika) ?></p>

    <p><strong>Namen cenitve:</strong> <?= htmlspecialchars($cenitev->namen_naziv) ?></p>

    <p><strong>Podlaga vrednosti:</strong> <?= htmlspecialchars($cenitev->podlaga_naziv) ?></p>

    <p><strong>Premisa vrednosti:</strong> <?= htmlspecialchars($cenitev->premisa_naziv) ?></p>

    <p><strong>Prvi ogled:</strong> 
        <?= date("d.m.Y H:i", strtotime($cenitev->prvi_ogled)) ?>
    </p>