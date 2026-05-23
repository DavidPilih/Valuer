<?php
class Auth extends Controller
{
    public function prijava()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $post_email = $_POST['email'];
            $post_geslo = $_POST['geslo'];
            
            $uporabnikiModel = new UporabnikiModel();
            $uporabnik = $uporabnikiModel->where(['email' => $post_email]);
                
            if(!$uporabnik){
                $napaka = "Uporabnik s tem e-poštnim naslovom ne obstaja.";
                $this->view('prijava', ['napaka'=>$napaka]);
            } else {
                if(password_verify($post_geslo, $uporabnik[0]->geslo)){
                    $_SESSION['uporabnik'] = [
                        'id'      => $uporabnik[0]->id,
                        'ime'     => $uporabnik[0]->ime,
                        'priimek' => $uporabnik[0]->priimek,
                        'email'   => $uporabnik[0]->email,
                    ];
                    header('Location: /home');
                } else {
                    $napaka = "Napačno geslo.";
                    $this->view('prijava', ['napaka'=>$napaka]);
                }
            }
        } else {
            $this->view('prijava');
        }
    }

    public function registracija()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $post_ime     = $_POST['ime'];
            $post_priimek = $_POST['priimek'];
            $post_email   = $_POST['email'];
            $post_geslo   = password_hash($_POST['geslo'], PASSWORD_DEFAULT);
            
            $uporabnikiModel = new UporabnikiModel();

            $obstaja = $uporabnikiModel->where(['email' => $post_email]);
            if($obstaja){
                $napaka = "Ta e-poštni naslov je že registriran.";
                $this->view('registracija', ['napaka'=>$napaka]);
            } else {
                $result = $uporabnikiModel->insert([
                    'ime'     => $post_ime,
                    'priimek' => $post_priimek,
                    'email'   => $post_email,
                    'geslo'   => $post_geslo
                ]);
                if($result){
                    $_SESSION['uporabnik'] = [
                        'id'      => $result,
                        'ime'     => $post_ime,
                        'priimek' => $post_priimek,
                        'email'   => $post_email,
                    ];
                    header('Location: /Home');
                } else {
                    $napaka = "Prišlo je do napake. Poskusite znova.";
                    $this->view('registracija', ['napaka'=>$napaka]);
                }
            }
        } else {
            $this->view('registracija');
        }
    }

    public function odjava(){
        session_destroy();
        header('Location: /auth/prijava');
    }
}