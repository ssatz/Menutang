<?php
/*
 * This file(FrontEndController.php) is part of the menutang
 *
 * (c) Sensei Online Food Services
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Translation\Translator;
use Illuminate\Support\Facades\Password;

class GuestController extends BaseController
{
    /**
     * @var Application
     */
    protected $app;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Redirector
     */
    protected $redirector;
    /**
     * @var Translator
     */
    protected $translator;
    /**
     * @var View
     */
    protected $view;


    /**
     * @param Request $request
     * @param Redirector $redirector
     * @param Translator $translator
     * @param Application $app
     */
    public function __construct(Request $request,
                                Redirector $redirector,
                                Translator $translator,
                                Application $app)
    {
        $this->app = $app;
        $this->request = $request;
        $this->redirector = $redirector;
        $this->translator = $translator;
        $this->view = $this->app->make('view');
    }


    /**
     * @return mixed
     */
    public function aboutUs()
    {
            return $this->view->make('frontend.about');
    }

    /**
     * @return mixed
     */
    public function faq()
    {

        return $this->view->make('frontend.faq');
    }

    /**
     *
     */
    public function contactUs()
    {

    }

    public function passwordReset()
    {
        Password::user()->remind('sathish.thi@gmail.com', function ($message) {
            $message->subject('Password reminder');
        });
    }

}