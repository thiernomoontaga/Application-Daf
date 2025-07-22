<?php

namespace Src\Entity;



enum Statut : string {
     CASE SUCCES = 'Succes';
     CASE ECHEC = 'Echec' ;
}

 Statut::SUCCES->value;
 Statut::ECHEC->value;
