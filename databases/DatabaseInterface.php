<?php

interface DatabaseInterface {

    public function insert($params);

    public function update($params);

    public function remove($params);

    public function select($params);

}