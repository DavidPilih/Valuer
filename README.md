# Valuer

Spletna aplikacija za upravljanje cenitev nepremičnin.

## Tehnologije

- PHP (MVC, brez frameworka)
- MySQL
- Bootstrap 5
- Docker

## Namestitev

```bash
docker-compose up -d
```
da se podatkovna baza nalozi lahko traja kaksno minutko

Aplikacija bo dostopna na `http://localhost:100`.
Za reset baze docker-compose down -v. 


## Funkcionalnosti

- Prijava in registracija uporabnikov + spreminjanje gesl
- Pregled, dodajanje, urejanje in brisanje cenitev
- Koš izbrisanih cenitev z možnostjo obnove
- Filtriranje in sortiranje cenitev