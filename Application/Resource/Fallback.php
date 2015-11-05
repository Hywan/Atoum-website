<?php

namespace Application\Resource;

class Fallback
{
    public function get()
    {
        require_once 'hoa://Application/View/Index.html';

        return;
    }
}
