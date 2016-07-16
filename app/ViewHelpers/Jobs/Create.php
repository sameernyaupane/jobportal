<?php
namespace JobPortal\ViewHelpers\Jobs;

use JobPortal\Repositories\Job;
use Illuminate\Routing\Router;
use Illuminate\Translation\Translator as Lang;

class Create
{
    /**
     * Route instance
     * @var object
     */
    protected $route;

    /**
     * Language instance
     * @var object
     */
    protected $language;

    /**
     * Job instance
     * @var object
     */
    protected $job;

    /**
     * Create new view helper instance
     * @param Router $route
     * @param Lang   $language
     */
    public function __construct(Router $route, Lang $language, Job $job)
    {
        $this->route    = $route;
        $this->language = $language;
        $this->job      = $job;
    }

    /**
     * Prepare data needed for the view
     * @return array
     */
    public function getData()
    {
        //Get the current route name
        $currentRoute = $this->route->currentRouteName();

        $lang = [];

        //Push appropriate language data to lang array
        $lang['header']              = $this->language->get('jobForm.post-a-job');
        $lang['header-desc']         = $this->language->get('jobForm.post-a-job-desc');
        $lang['email-address']       = $this->language->get('jobForm.email-address');
        $lang['email-placeholder']   = $this->language->get('jobForm.email-placeholder');
        $lang['job-title']           = $this->language->get('jobForm.job-title');
        $lang['title-placeholder']   = $this->language->get('jobForm.title-placeholder');
        $lang['job-details']         = $this->language->get('jobForm.job-details');
        $lang['details-placeholder'] = $this->language->get('jobForm.details-placeholder');
        $lang['skills']              = $this->language->get('jobForm.skills');
        $lang['html5']               = $this->language->get('jobForm.html5');
        $lang['css3']                = $this->language->get('jobForm.css3');
        $lang['javascript']          = $this->language->get('jobForm.javascript');
        $lang['jquery']              = $this->language->get('jobForm.jquery');
        $lang['php']                 = $this->language->get('jobForm.php');
        $lang['mysql']               = $this->language->get('jobForm.mysql');
        $lang['laravel']             = $this->language->get('jobForm.laravel');
        $lang['submit']              = $this->language->get('jobForm.submit');

        $job = $this->job->makeEmptyJobInstance();

        return compact('currentRoute', 'lang', 'job');
    }
}
