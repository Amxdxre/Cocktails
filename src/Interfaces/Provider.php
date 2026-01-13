<?php

namespace Cocktails\Interfaces;

interface Provider
{
    public function getAssociatedEntity();
    public function post($entity);
    public function delete($id);
}