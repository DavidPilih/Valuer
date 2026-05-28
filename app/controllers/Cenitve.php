<?php

class Cenitve extends Controller
{
    private CenitveModel $cenitveModel;
    private NamenCenitveModel $namenModel;
    private PodlagaVrednostiModel $podlagaModel;
    private PremisaVrednostiModel $premisaModel;
    private UporabnikiModel $uporabnikiModel;

    public function __construct()
    {
        $this->cenitveModel = new CenitveModel();
        $this->namenModel = new NamenCenitveModel();
        $this->podlagaModel = new PodlagaVrednostiModel();
        $this->premisaModel = new PremisaVrednostiModel();
        $this->uporabnikiModel = new UporabnikiModel();
    }

    private function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    private function json($data)
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public function fill()
    {
        $setup = new SetUp();
        $setup->resetAppraisals();
        $this->redirect('/cenitve');
    }

    public function index()
    {
        $cenitve = $this->cenitveModel->getAllWithRelations();

        $this->view('cenitve', [
            'cenitve' => $cenitve,
            'uspeh' => $_SESSION['uspeh'] ?? null,
            'napaka' => $_SESSION['napaka'] ?? null,
            'nameni' => $this->namenModel->all(),
            'podlage' => $this->podlagaModel->all(),
            'premise' => $this->premisaModel->all(),
            'uporabniki' => $this->uporabnikiModel->all()
    ]);

        unset($_SESSION['uspeh'], $_SESSION['napaka']);
    }

    public function cenitev($id)
    {
        $id = $id[0];
        $cenitev = $this->cenitveModel->getWithRelations($id);


        $this->view('cenitev', [
            'cenitev' => $cenitev
        ]);
    }

    public function dodajCenitev()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ok = $this->cenitveModel->insert([
                'uporabnik_id' => $_SESSION['uporabnik']['id'],
                'naziv_narocnika' => $_POST['naziv_narocnika'] ?? '',
                'naslov_narocnika' => $_POST['naslov_narocnika'] ?? '',
                'namen_id' => $_POST['namen_id'] ?? null,
                'podlaga_id' => $_POST['podlaga_id'] ?? null,
                'premisa_id' => $_POST['premisa_id'] ?? null,
                'prvi_ogled' => $_POST['prvi_ogled'] ?? null
            ]);

            if (!$ok) $_SESSION['napaka'] = "Prišlo je do napake. Poskusite znova.";
            else $_SESSION['uspeh'] = "Cenitev uspešno dodana";
            
            $this->redirect('/cenitve');
        }

        $this->view('dodajCenitev', [
            'nameni' => $this->namenModel->all(),
            'podlage' => $this->podlagaModel->all(),
            'premise' => $this->premisaModel->all()
        ]);
    }

    public function urediCenitev($id)
    {
        $id = $id[0] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ok = $this->cenitveModel->update([
                'naziv_narocnika' => $_POST['naziv_narocnika'] ?? '',
                'naslov_narocnika' => $_POST['naslov_narocnika'] ?? '',
                'namen_id' => $_POST['namen_id'] ?? null,
                'podlaga_id' => $_POST['podlaga_id'] ?? null,
                'premisa_id' => $_POST['premisa_id'] ?? null,
                'prvi_ogled' => $_POST['prvi_ogled'] ?? null
            ], $id);

            if ($ok) $_SESSION['uspeh'] = "Cenitev uspešno urejena.";
            else $_SESSION['napaka'] = "Prišlo je do napake.";

            $this->redirect('/cenitve');
        }else{
        $this->view('urediCenitev', [
            'cenitev' => $this->cenitveModel->getWithRelations($id),
            'nameni' => $this->namenModel->all(),
            'podlage' => $this->podlagaModel->all(),
            'premise' => $this->premisaModel->all()
        ]);}
    }

    public function brisiCenitev($id)
    {
        $id = $id[0] ?? null;
        $rezultat = $this->cenitveModel->softDelete($id);
        $this->json(['success' => $rezultat]);
    }

    public function trajnoBrisiCenitev($id)
    {
        $id = $id[0] ?? null;
        $rezultat = $this->cenitveModel->delete($id);
        $this->json(['success' => $rezultat]);
    }

    public function brisiCenitve()
    {
        $body = json_decode(file_get_contents('php://input'), true);
        $rezultat = $this->cenitveModel->softDeleteMultiple($body['zaIzbris']);
        $this->json(['success' => $rezultat]);
    }

    public function izbrisaneCenitve()
    {
        $cenitve = $this->cenitveModel->getAllWithRelations(1);

        $this->view('cenitve', [
            'cenitve' => $cenitve,
            'izbrisane' => true
        ]);
    }

    public function obnoviCenitev($id)
    {
        $id = $id[0] ?? null;
        $rezultat = $this->cenitveModel->restore($id);
        $this->json(['success' => $rezultat]);
    }

    public function obnoviCenitve()
    {
        $telo = json_decode(file_get_contents('php://input'), true);
        $rezultat = $this->cenitveModel->restoreMultiple($telo['zaIzbris']);
        $this->json(['success' => $rezultat]);
    }
}