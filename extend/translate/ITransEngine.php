<?php

namespace translate;

interface ITransEngine
{
    public function translate($text,$from,$to);
}