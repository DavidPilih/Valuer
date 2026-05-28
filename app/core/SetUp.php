<?php

class SetUp
{
    use Database;
public function fillNamenCenitve()
{
    $this->query("INSERT INTO namen_cenitve (naziv) VALUES
        ('Zavarovano posojanje'),
        ('Sodni postopek'),
        ('Stečajni postopek'),
        ('Računovodsko poročanje'),
        ('Davčni postopek'),
        ('Poslovna odločitev naročnika')
    ");
}

public function fillPodlagaVrednosti()
{
    $this->query("INSERT INTO podlaga_vrednosti (naziv) VALUES
        ('Tržna vrednost'),
        ('Likvidacijska vrednost'),
        ('Tržna najemnina'),
        ('Pravična vrednost')
    ");
}

public function fillPremisaVrednosti()
{
    $this->query("INSERT INTO premisa_vrednosti (naziv) VALUES
        ('Sedanja ali obstoječa uporaba'),
        ('Najgospodarnejša uporaba'),
        ('Redna likvidacija')
    ");
}

public function fillUporabniki()
{
    $this->query("INSERT INTO uporabniki (ime, priimek, email, geslo) VALUES
        ('Janez', 'Novak', 'janez@gmail.com', '" . password_hash('pass', PASSWORD_DEFAULT) . "'),
        ('David', 'Pilih', 'david@gmail.com', '" . password_hash('pass', PASSWORD_DEFAULT) . "')
    ");
}

public function fillCenitve()
{
    $this->query("INSERT INTO cenitve (uporabnik_id, naziv_narocnika, naslov_narocnika, namen_id, podlaga_id, premisa_id, prvi_ogled) VALUES
        (1, 'Podjetje d.o.o.', 'Ljubljanska 5, Ljubljana', 1, 1, 1, '2025-03-10 09:00:00'),
        (2, 'Franc Kovač', 'Mariborska 12, Maribor', 2, 2, 3, '2025-03-15 11:30:00'),
        (1, 'Stavbna zadruga', 'Celjska 3, Celje', 5, 4, 2, '2025-04-01 14:00:00'),
        (2, 'Investicijska skupina d.o.o.', 'Dunajska 45, Ljubljana', 1, 2, 1, '2025-04-05 10:00:00')
    ");
}

public function fill()
{
    $this->fillNamenCenitve();
    $this->fillPodlagaVrednosti();
    $this->fillPremisaVrednosti();
    $this->fillUporabniki();
    $this->fillCenitve();
}
    public function reset()
    {
        $this->query("DROP TABLE IF EXISTS cenitve");
        $this->query("DROP TABLE IF EXISTS uporabniki");
        $this->query("DROP TABLE IF EXISTS namen_cenitve");
        $this->query("DROP TABLE IF EXISTS podlaga_vrednosti");
        $this->query("DROP TABLE IF EXISTS premisa_vrednosti");
        $this->create();
        $this->fill();
    }
    public function create()
    {
        $this->query("CREATE TABLE IF NOT EXISTS uporabniki (
        id INT AUTO_INCREMENT PRIMARY KEY,
        ime VARCHAR(50) NOT NULL,
        priimek VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        geslo VARCHAR(255) NOT NULL,
        izbrisano TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

        $this->query("CREATE TABLE IF NOT EXISTS namen_cenitve (
        id INT AUTO_INCREMENT PRIMARY KEY,
        naziv VARCHAR(100) NOT NULL
    )");

        $this->query("CREATE TABLE IF NOT EXISTS podlaga_vrednosti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        naziv VARCHAR(100) NOT NULL
    )");

        $this->query("CREATE TABLE IF NOT EXISTS premisa_vrednosti (
        id INT AUTO_INCREMENT PRIMARY KEY,
        naziv VARCHAR(100) NOT NULL
    )");

        $this->query("CREATE TABLE IF NOT EXISTS cenitve (
        id INT AUTO_INCREMENT PRIMARY KEY,
        uporabnik_id INT NOT NULL,
        naziv_narocnika VARCHAR(150) NOT NULL,
        naslov_narocnika VARCHAR(255) NOT NULL,
        namen_id INT NOT NULL,
        podlaga_id INT NOT NULL,
        premisa_id INT NOT NULL,
        prvi_ogled DATETIME NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        izbrisano TINYINT(1) DEFAULT 0,
        FOREIGN KEY (uporabnik_id) REFERENCES uporabniki(id)
            ON DELETE CASCADE,
        FOREIGN KEY (namen_id) REFERENCES namen_cenitve(id),
        FOREIGN KEY (podlaga_id) REFERENCES podlaga_vrednosti(id),
        FOREIGN KEY (premisa_id) REFERENCES premisa_vrednosti(id)
    )");
    }

    public function resetAppraisals(){ // samo uporabnikov ne resetira

        $this->query("DROP TABLE IF EXISTS cenitve");
        $this->query("DROP TABLE IF EXISTS namen_cenitve");
        $this->query("DROP TABLE IF EXISTS podlaga_vrednosti");
        $this->query("DROP TABLE IF EXISTS premisa_vrednosti");
        $this->create();
        $this->fillNamenCenitve();
        $this->fillPodlagaVrednosti();
        $this->fillPremisaVrednosti();
        $this->fillCenitve();
}
}


