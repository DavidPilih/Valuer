<?php

class Cenitve extends Controller
{
    public function fill(){//ZBRISI VEN
    $setup = new SetUp();
    $setup->reset();
    $this->view('Home');
    }
    public function index()
    {
        $cenitveModel = new CenitveModel();
        $cenitve = $cenitveModel->getAllWithRelations();
        $this->view('cenitve', ['cenitve' => $cenitve]);
    }

    public function cenitev($par)
    {
        $cenitveModel = new CenitveModel();
        $id = $par[0][2];
        $cenitev = $cenitveModel->getWithRelations($id);
        $this->view('cenitev', ['cenitev' => $cenitev]);
    }

    public function dodajCenitev()
    {

        $namenModel = new NamenCenitveModel();
        $podlagaModel = new PodlagaVrednostiModel();
        $premisakModel = new PremisaVrednostiModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cenitveModel = new CenitveModel();
            $postNazivNarocnika = $_POST['naziv_narocnika'] ?? '';
            $postNaslovNarocnika = $_POST['naslov_narocnika'] ?? '';
            $postNamenId = $_POST['namen_id'] ?? '';
            $postPodlagaId = $_POST['podlaga_id'] ?? '';
            $postPremisaId = $_POST['premisa_id'] ?? '';
            $postPrviOgled = $_POST['prvi_ogled'] ?? '';
            $userId = $_SESSION['uporabnik']['id'];
            #cenitve (user_id, naziv_narocnika, naslov_narocnika, namen_id, podlaga_id, premisa_id, prvi_ogled
            $nova_cenitev = $cenitveModel->insert([
                'uporabnik_id' => $userId,
                'naziv_narocnika' => $postNazivNarocnika,
                'naslov_narocnika' => $postNaslovNarocnika,
                'namen_id' => $postNamenId,
                'podlaga_id' => $postPodlagaId,
                'premisa_id' => $postPremisaId,
                'prvi_ogled' => $postPrviOgled
            ]);
            $cenitve = $cenitveModel->getAllWithRelations();
            if (!$nova_cenitev) {
                $napaka = "Prišlo je do napake. Poskusite znova.";
                $this->view('cenitve', ['cenitve' => $cenitve, 'napaka' => $napaka]);
            } else {
                $this->view('cenitve', ['cenitve' => $cenitve]);
            }
        } else {

            $this->view('dodajCenitev', [
                'nameni' => $namenModel->all(),
                'podlage' => $podlagaModel->all(),
                'premise' => $premisakModel->all()
            ]);
        }
    }



    public function urediCenitev($par)
    {
        $id = $par[0][2];
        $cenitveModel = new CenitveModel();
        $namenModel = new NamenCenitveModel();
        $podlagaModel = new PodlagaVrednostiModel();
        $premisaModel = new PremisaVrednostiModel();
        $nameni = $namenModel->all();
        $podlage = $podlagaModel->all();
        $premise = $premisaModel->all();
        $cenitev = $cenitveModel->getWithRelations($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $postNazivNarocnika = $_POST['naziv_narocnika'] ?? '';
            $postNaslovNarocnika = $_POST['naslov_narocnika'] ?? '';
            $postNamenId = $_POST['namen_id'] ?? '';
            $postPodlagaId = $_POST['podlaga_id'] ?? '';
            $postPremisaId = $_POST['premisa_id'] ?? '';
            $postPrviOgled = $_POST['prvi_ogled'] ?? '';

            $rezultat = $cenitveModel->update([
                'naziv_narocnika' => $postNazivNarocnika,
                'naslov_narocnika' => $postNaslovNarocnika,
                'namen_id' => $postNamenId,
                'podlaga_id' => $postPodlagaId,
                'premisa_id' => $postPremisaId,
                'prvi_ogled' => $postPrviOgled
            ], $id);

            if ($rezultat) {
                header('Location: /cenitve');
            } else {
                $napaka = "Prišlo je do napake. Poskusite znova.";
            }
        } else {
            $this->view('urediCenitev', ['cenitev' => $cenitev, 'nameni' => $nameni, 'podlage' => $podlage, 'premise' => $premise]);
        }
    }

    public function brisiCenitev($par)
    {
        $cenitveModel = new CenitveModel();
        $id = $par[0][2];
        $rezultat = $cenitveModel->softDelete($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => $rezultat]);
    }
    public function trajnoBrisiCenitev($par)
    {
        $cenitveModel = new CenitveModel();
        $id = $par[0][2];
        $rezultat = $cenitveModel->delete($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => $rezultat]);
    }

    public function brisiCenitve()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $zaIzbris = $body['zaIzbris'];
        $trajnoIzbrisi = $body['trajnoIzbrisi'] ?? false;

        $cenitveModel = new CenitveModel();
        if ($trajnoIzbrisi) {
            $rezultat = $cenitveModel->deleteMultiple($zaIzbris);
        } else {
            $rezultat = $cenitveModel->softDeleteMultiple($zaIzbris);
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => $rezultat]);
    }

    public function izbrisaneCenitve()
    {
        $cenitveModel = new CenitveModel();
        $cenitve = $cenitveModel->getAllWithRelations(1);
        $this->view('cenitve', ['cenitve' => $cenitve, 'izbrisane' => true]);
    }
    public function obnoviCenitev($par)
    {
        $cenitveModel = new CenitveModel();
        $id = $par[0][2];
        $rezultat = $cenitveModel->restore($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => $rezultat]);
    }

    public function obnoviCenitve()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $zaObnovo = $body['zaIzbris'];
        $cenitveModel = new CenitveModel();
        $rezultat = $cenitveModel->restoreMultiple($zaObnovo);
        header('Content-Type: application/json');
        echo json_encode(['success' => $rezultat]);
    }
}