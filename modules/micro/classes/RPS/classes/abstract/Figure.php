<?php

abstract class Figure {
    
    protected $winsAgainst;

    final public function checkPlayerWin(Figure $figure) {
        return $figure instanceof $this->winsAgainst;
    }
}
