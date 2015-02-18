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
    $pattern = $compiler->createMatcher('formtdate');
    return preg_replace($pattern, '<?php $time = new \DateTime($1); echo $time->format("g:i a"); ?>', $view);

});