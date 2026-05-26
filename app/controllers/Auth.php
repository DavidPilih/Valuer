<?php

class Auth extends Controller
{
    private UporabnikiModel $uporabnikiModel;

    public function __construct()
    {
        $this->uporabnikiModel = new UporabnikiModel();
    }

    private function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    public function prijava()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = $_POST['email'] ?? '';
            $geslo = $_POST['geslo'] ?? '';

            $uporabnik = $this->uporabnikiModel->where(['email' => $email]);

            if (!$uporabnik) {
                $_SESSION['napaka'] = "Uporabnik s tem e-poštnim naslovom ne obstaja.";
                $this->redirect('/auth/prijava');
            }

            $uporabnik = $uporabnik[0];

            if (!password_verify($geslo, $uporabnik->geslo)) {
                $_SESSION['napaka'] = "Napačno geslo.";
                $this->redirect('/auth/prijava');
            }

            $_SESSION['uporabnik'] = [
                'id' => $uporabnik->id,
                'ime' => $uporabnik->ime,
                'priimek' => $uporabnik->priimek,
                'email' => $uporabnik->email,
            ];

            $_SESSION['uspeh'] = "Prijava uspešna.";
            $this->redirect('/home');
        }

        $this->view('prijava', [
            'napaka' => $_SESSION['napaka'] ?? null,
            'uspeh' => $_SESSION['uspeh'] ?? null
        ]);

        unset($_SESSION['napaka'], $_SESSION['uspeh']);
    }

    public function registracija()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $ime = $_POST['ime'] ?? '';
            $priimek = $_POST['priimek'] ?? '';
            $email = $_POST['email'] ?? '';
            $geslo = password_hash($_POST['geslo'] ?? '', PASSWORD_DEFAULT);

            $obstaja = $this->uporabnikiModel->where(['email' => $email]);

            if ($obstaja) {
                $_SESSION['napaka'] = "Ta e-poštni naslov je že registriran.";
                $this->redirect('/auth/registracija');
            }

            $id = $this->uporabnikiModel->insert([
                'ime' => $ime,
                'priimek' => $priimek,
                'email' => $email,
                'geslo' => $geslo
            ]);

            if (!$id) {
                $_SESSION['napaka'] = "Prišlo je do napake. Poskusite znova.";
                $this->redirect('/auth/registracija');
            }

            $_SESSION['uporabnik'] = [
                'id' => $id,
                'ime' => $ime,
                'priimek' => $priimek,
                'email' => $email,
            ];

            $_SESSION['uspeh'] = "Registracija uspešna.";
            $this->redirect('/home');
        }

        $this->view('registracija', [
            'napaka' => $_SESSION['napaka'] ?? null,
            'uspeh' => $_SESSION['uspeh'] ?? null
        ]);

        unset($_SESSION['napaka'], $_SESSION['uspeh']);
    }

    public function odjava()
    {
        session_destroy();
        $this->redirect('/auth/prijava');
    }

    public function spremembaGesla()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $staroGeslo = $_POST['staro_geslo'] ?? '';
            $novoGeslo = $_POST['novo_geslo'] ?? '';
            $uporabnik = $this->uporabnikiModel->one(['id' => $_SESSION['uporabnik']['id']]);

            if (!$uporabnik || !password_verify($staroGeslo, $uporabnik->geslo)) {
                $_SESSION['napaka'] = "Vnešeno geslo je napačno.";
                $this->redirect('/auth/spremembaGesla');
            }

            $ok = $this->uporabnikiModel->update(['geslo' => password_hash($novoGeslo, PASSWORD_DEFAULT)], $_SESSION['uporabnik']['id']);

            if (!$ok) {
                $_SESSION['napaka'] = "Prišlo je do napake, poskusite ponovno.";
                $this->redirect('/auth/spremembaGesla');
            } else {
                unset($_SESSION['uporabnik']);
                $_SESSION['uspeh'] = "Geslo uspešno spremenjeno.";
                $this->redirect('/auth/prijava');
            }
        }

        $this->view('spremembaGesla', [
            'napaka' => $_SESSION['napaka'] ?? null,
            'uspeh' => $_SESSION['uspeh'] ?? null
        ]);

        unset($_SESSION['napaka'], $_SESSION['uspeh']);
    }
}