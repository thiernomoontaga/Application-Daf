<?php

abstract class AbstractController{



    public function __construct()
    {

    }

    abstract  public function index();
    abstract public function store();
    abstract public function edit();
    abstract public function create();


      public function renderJSON():void{

      }

}