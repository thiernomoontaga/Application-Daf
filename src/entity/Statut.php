<?php

namespace Src\Entity;



enum Statut : string {
     CASE SUCCES = 'Succes';
     CASE ECHEC = 'Echec' ;
}

echo Statut::SUCCES->value;
echo  Statut::ECHEC->value;
