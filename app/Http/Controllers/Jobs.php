<?php
namespace JobPortal\Http\Controllers;

use stdClass;
use JobPortal\Helpers\Uuid;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use JobPortal\Models\JobSkill;
use JobPortal\Repositories\Job;
use Illuminate\Routing\Redirector;
use JobPortal\Events\JobWasCreated;
use JobPortal\Http\Requests\JobForm;
use Illuminate\View\Factory as View;
use Illuminate\Events\Dispatcher as Event;
use Illuminate\Translation\Translator as Lang;
use JobPortal\ViewHelpers\Jobs\Edit as EditJobViewHelper;
use JobPortal\ViewHelpers\Jobs\Create as CreateJobViewHelper;

class Jobs extends Controller
{
    /**
     * Get the index page
     * @param  Router  $route
     * @param  Request $request
     * @param  Job     $job
     * @param  View    $view
     * @return view
     */
    public function index(
        Router $route,
        Request $request,
        Job $job,
        View $view
    ) 
    {
        $currentRoute = $route->currentRouteName();

        //Search by term if it was requested, if not, get all the jobs
        if ($request->has('search_term')) {
            $search_term = $request->search_term;
            $jobs = $job->searchByTerm($search_term);
        } else {
            $search_term = '';
            $jobs = $job->getAll();
        }

        //Prepare view data
        $data = compact('currentRoute', 'jobs', 'search_term');

        return $view->make('home', $data);
    }

    /**
     * Get the create form view
     * @param  View                $view
     * @param  CreateJobViewHelper $viewHelper
     * @return view
     */
    public function getCreate(View $view, CreateJobViewHelper $viewHelper) 
    {
        return $view->make('form', $viewHelper->getData());
    }

    /**
     * Save the job create data
     * @param  JobForm    $request
     * @param  Uuid       $uuid
     * @param  Job        $job
     * @param  Redirector $redirect
     * @param  Event      $event
     * @param  Lang       $lang
     * @return redirect
     */
    public function postCreate(
        JobForm $request,
        Uuid $uuid,
        Job $job,
        Redirector $redirect,
        Event $event,
        Lang $lang
    ) 
    {
        $request->uuid = $uuid->generate();

        //Try to save the data, if not, redirect back
        if (!$job->save($request)) {
            return $redirect
                ->back()
                ->withInputs()
                ->with('error', $lang->get('job.postError'));
        }

        //Get the job instance by uuid
        $jobModel = $job->findByUuid($request->uuid);

        //Fire the "Job created" event
        $event->fire(new JobWasCreated($jobModel));

        return $redirect
            ->route('home')
            ->with('success', $lang->get('job.postSuccess'));
    }

    /**
     * Get the edit form view
     * @param  View                $view
     * @param  EditJobViewHelper   $viewHelper
     * @return view
     */
    public function getEdit($uuid, View $view, EditJobViewHelper $viewHelper) 
    {        
        return $view->make('form', $viewHelper->getData($uuid));
    }

    /**
     * Save the job edit data
     * @param  JobForm    $request
     * @param  Job        $job
     * @param  Redirector $redirect
     * @param  Event      $event
     * @param  Lang       $lang
     * @return redirect
     */
    public function postEdit(
        JobForm $request,
        Job $job,
        Redirector $redirect,
        Event $event,
        Lang $lang
    ) 
    {
        if (!$job->save($request, 'edit')) {
            return $redirect
                ->back()
                ->withInputs()
                ->with('error', $lang->get('job.editError'));
        }

        return $redirect
            ->route('home')
            ->with('success', $lang->get('job.editSuccess'));
    }

    /**
     * Delete the given job post
     * @param  string     $uuid
     * @param  Job        $job
     * @param  Redirector $redirect
     * @param  Lang       $lang
     * @return redirect
     */
    public function getDelete(
        $uuid, 
        Job $job, 
        Redirector $redirect,
        Lang $lang
    )
    {        
        //Try to delete the job by given uuid, if not, redirect back
        if (!$job->deleteByUuid($uuid)) {
            return $redirect
                ->route('home')
                ->withInputs()
                ->with('error', $lang->get('job.deleteError'));
        }

        return $redirect
            ->route('home')
            ->with('success', $lang->get('job.deleteSuccess'));
    }

}
