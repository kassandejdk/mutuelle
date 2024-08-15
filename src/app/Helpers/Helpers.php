<?php
function getPrix($prix){
        return number_format($prix,2,',','').' XOF';
}
function routeur(int $role)
        {
            if($role===4) return  dd('admin');
            elseif($role===2) return route('membre.home');
            elseif($role===3) return route('dashbord.dashbord');
        }
?>