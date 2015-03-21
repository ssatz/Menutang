<?php
/*
 * This file(bladeextenstion.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('formattime');
    return preg_replace($pattern, '$1<?php $datTime= new \DateTime($2); echo $datTime->format(\'g:i a\'); ?>', $view);
});


Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('replacespace');
    return preg_replace($pattern, '$1<?php  echo strtolower(str_replace(\' \',\'-\',$2)); ?>', $view);

});
/**
*  {? $old_section = "whatever" ?}
*/
Blade::extend(function($value) {
    return preg_replace('/\{\?(.+)\?\}/', '<?php ${1} ?>', $value);
});

