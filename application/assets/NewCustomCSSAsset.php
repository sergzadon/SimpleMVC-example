<?php

namespace application\assets;
use ItForFree\SimpleAsset\SimpleAsset;
use application\assets\BootstrapAsset;

/* 
 * Класс ассетов для CSS стилей. Пользовательский
 * 
 */

class NewCustomCSSAsset extends SimpleAsset {
    
    public $basePath = '/';
    
    public $css = [
        'CSS/style_1.css'
    ];
    
    public $needs = [    
             
    ];     
    
}

