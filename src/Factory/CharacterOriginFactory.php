<?php

namespace Factory;
use App\LaComte;
use App\Mordor;
use App\Rivendel;
use App\Rohan;
use App\Gondor;

class CharacterOriginFactory
{
public static function createOrigin($contree)
  {
      switch ($contree){
          case "La comte":
              $origine = new LaComte();
              break;
          case "Gondor":
              $origine = new Gondor();
              break;
          case "Rohan":
              $origine = new Rohan();
              break;
          case "Mordor":
              $origine = new Mordor();
              break;
          case "Rivendel":
              $origine = new Rivendel();
              break;
          default:
              $origine = new Mordor();
      }
      return $origine;
      //return d'un orjet d'origine de type classe appele par la swich

  }
}