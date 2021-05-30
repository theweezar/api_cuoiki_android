<?php

interface DatabaseHelper {

    public function insert($argv);

    public function update($argv);

    public function remove($argv);

    public function select($argv);

}