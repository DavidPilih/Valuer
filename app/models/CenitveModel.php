<?php
class CenitveModel extends Model {
    protected $table = 'cenitve';

        // FOREIGN KEY (uporabnik_id) REFERENCES uporabniki(id)
        // FOREIGN KEY (namen_id) REFERENCES namen_cenitve(id),
        // FOREIGN KEY (podlaga_id) REFERENCES podlaga_vrednosti(id),
        // FOREIGN KEY (premisa_id) REFERENCES premisa_vrednosti(id)
    public function getWithRelations($id, $izbrisano=0){
        $query = "SELECT 
            cenitve.id,
            cenitve.naziv_narocnika,
            cenitve.naslov_narocnika,
            cenitve.prvi_ogled,
            cenitve.namen_id,
            cenitve.podlaga_id,
            cenitve.premisa_id,
            namen_cenitve.naziv AS namen_naziv,
            podlaga_vrednosti.naziv AS podlaga_naziv,
            premisa_vrednosti.naziv AS premisa_naziv,
            uporabniki.ime AS uporabnik_ime,
            uporabniki.priimek AS uporabnik_priimek
            FROM cenitve 
            LEFT JOIN uporabniki ON cenitve.uporabnik_id = uporabniki.id
            LEFT JOIN namen_cenitve ON cenitve.namen_id = namen_cenitve.id
            LEFT JOIN podlaga_vrednosti ON cenitve.podlaga_id = podlaga_vrednosti.id
            LEFT JOIN premisa_vrednosti ON cenitve.premisa_id = premisa_vrednosti.id
            WHERE cenitve.id = :id
            AND cenitve.izbrisano = $izbrisano
            LIMIT 1 ";
        return $this->query($query, ['id'=>$id])[0];
    }
        public function getAllWithRelations($izbrisano = 0){
        $query = "SELECT 
            cenitve.id,
            cenitve.naziv_narocnika,
            cenitve.naslov_narocnika,
            cenitve.prvi_ogled,
            cenitve.namen_id,
            cenitve.podlaga_id,
            cenitve.premisa_id,
            namen_cenitve.naziv AS namen_naziv,
            podlaga_vrednosti.naziv AS podlaga_naziv,
            premisa_vrednosti.naziv AS premisa_naziv,
            uporabniki.ime AS uporabnik_ime,
            uporabniki.priimek AS uporabnik_priimek
            FROM cenitve 
            LEFT JOIN uporabniki ON cenitve.uporabnik_id = uporabniki.id
            LEFT JOIN namen_cenitve ON cenitve.namen_id = namen_cenitve.id
            LEFT JOIN podlaga_vrednosti ON cenitve.podlaga_id = podlaga_vrednosti.id
            LEFT JOIN premisa_vrednosti ON cenitve.premisa_id = premisa_vrednosti.id
            WHERE cenitve.izbrisano = $izbrisano";
        return $this->query($query);
    }


}