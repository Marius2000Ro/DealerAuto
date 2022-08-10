<?php

class IstoricController extends Controller{
    public function istoric(){
       $items = $this->model('istoric')->get();
       $this->view('istoric/istoric', ['items'=>$items]);
    }

    public function create(){
        if(isset($_POST['action'])){
          $newItem = $this->model('Istoric');
          $id_masina= $_POST['id_car'];
          $newItem->id_car = $_POST['id_car'];
          $newItem->data_intrare_service = $_POST['data_intrare_service'];
          $newItem->data_iesire_service = $_POST['data_iesire_service'];
          $newItem->pret_manopera = $_POST['pret_manopera'];
          $newItem->pret_piese = $_POST['pret_piese'];
          $newItem->pret_total = $_POST['pret_manopera'] + $_POST['pret_piese'];
          $newItem->tip_operatie = $_POST['tip_operatie'];
          $newItem->km = $_POST['km'];
          $newItem->descriere = $_POST['descriere'];
          $newItem->create();
          session_start();
          $_SESSION['message']= "A fost adaugat un istoric nou pentru vehiculul cu ID '$id_masina'! ";
          header('location:../istoric');
        }else{
          $_SESSION['message']= "Adaugarea istoricului nu a functionat, incearca din nou!";
          $this->view('istoric/create');
        }
      }

    

      public function edit($id_istoric){
        $theIstoric = $this->model('istoric')->find($id_istoric);

        if(isset($_POST['action'])){
        
          $theIstoric->data_intrare_service = $_POST['data_intrare_service'];
          $theIstoric->data_iesire_service = $_POST['data_iesire_service'];
          $theIstoric->pret_manopera = $_POST['pret_manopera'];
          $theIstoric->pret_piese = $_POST['pret_piese'];
          $theIstoric->tip_operatie = $_POST['tip_operatie'];
          $theIstoric->km = $_POST['km'];
          $theIstoric->descriere = $_POST['descriere'];
          $theIstoric->pret_total = $_POST['pret_manopera'] + $_POST['pret_piese'];
          $theIstoric->update();
          session_start();
          $_SESSION['message']= "Istoricul cu ID '$id_istoric' a fost editat cu succes!";
          header('location:../../istoric');
        }else{
          $_SESSION['message']= "Istoricul cu ID '$id_istoric' nu a fost editat. Incearca din nou!";
          $this->view('istoric/edit', $theIstoric);
        }
      }



      public function delete($id_istoric){
        $theIstoric = $this->model('istoric')->find($id_istoric);
        if(isset($_POST['action'])){
          $theIstoric->delete();
          session_start();
          $_SESSION['message']= "Istoricul cu ID '$id_istoric' a fost sters cu succes!";
          header('location:../../istoric');
        }else{
          $_SESSION['message']= "Istoricul cu ID '$id_istoric' nu a fost sters, incearca din nou!";
          $this->view('istoric/delete', $theIstoric);
        }
      }
}
?>