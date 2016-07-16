<?php
namespace JobPortal\Repositories;

use JobPortal\Models\JobSkill;
use JobPortal\Models\Job as JobModel;

class Job
{
    /**
     * List of skills
     * @var array
     */
    protected $skillsList = [
        'html5'      => 'HTML5', 
        'css3'       => 'CSS3',
        'javascript' => 'JavaScript', 
        'jquery'     => 'jQuery', 
        'php'        => 'PHP',
        'mysql'      => 'MySQL',
        'laravel'    => 'Laravel',
    ];

    /**
     * Job instance
     * @var object
     */
    protected $job;

    /**
     * JobSkill instance
     * @var object
     */
    protected $jobSkill;

    public function __construct(JobModel $job, JobSkill $jobSkill)
    {
        $this->job      = $job;
        $this->jobSkill = $jobSkill;
    }

    /**
     * Get all the job instances
     * @return object
     */
    public function getAll()
    {
        return $this->job->all();
    }

    /**
     * Find the job instance by the given uuid
     * @param  string $uuid
     * @return object
     */
    public function findByUuid($uuid)
    {
        return $this->job->where('uuid', $uuid)->first();
    }

    /**
     * Find the job instance and also add helper for editing reasons
     * @param  string $uuid
     * @return object
     */
    public function findByUuidForEdit($uuid)
    {
        //Get the proper job instance
        $job = $this->findByUuid($uuid);

        //Get the skills object
        $job->hasSkill = $this->getSkillsObject();

        //Modify hasSkill attribute values to match stored skill attribute values
        foreach ($job->skills as $skill) {
            $name = array_search($skill->name, $this->skillsList);
            $job->hasSkill->{$name} = true;
        }

        return $job;
    }

    /**
     * Save the instance by using given data
     * @param  object $data
     * @return boolean
     */
    public function save($data, $action = 'create')
    {
        //If we have uuid, use it to fetch the instance, else use new one
        if ($action == 'create') {
            $this->job->uuid    = $data->uuid;
        } else {
            $this->job = $this->findByUuid($data->uuid);
        }
        
        //Assign given data to the job instance
        $this->job->email   = $data->email;
        $this->job->title   = $data->title;
        $this->job->details = $data->details;

        //Save the job instance
        if (!$this->job->save()) {
            return false;
        }

        //Delete all the previous skills if not already empty
        if (!$this->job->skills->isEmpty()) {
            if (!$this->deleteAll($this->job->skills)) {
                return false;
            }
        }

        $jobSkillModels = [];

        //Create job skill instances
        foreach ($this->skillsList as $key => $value) {
            if ($data->has($key)) {
                $jobSkillModel = new JobSkill;
                $jobSkillModel->name = $value;

                array_push($jobSkillModels, $jobSkillModel);
            }
        }

        //Save all the skill instances to the main job instance
        if (!$this->job->skills()->saveMany($jobSkillModels)) {
            return false;
        }

        return true;
    }

    public function deleteByUuid($uuid)
    {
        $job = $this->findByUuid($uuid);

        if (!$job->delete()) {
           return false;
        }

        return true;
    }

    /**
     * Delete all the objects in the collection
     * @param  object $collection
     * @return boolean
     */
    public function deleteAll($collection)
    {
        foreach ($collection as $object) {
            if (!$object->delete()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Search by the given term
     * @param  string $search_term
     * @return object
     */ 
    public function searchByTerm($search_term)
    {
        return $this->job->where('email', 'like', '%' . $search_term . '%')
                    ->orWhere('title', 'like', '%' . $search_term . '%')
                    ->orWhere('details', 'like', '%' . $search_term . '%')
                    ->orwhereHas('skills', function ($q) use ($search_term) {
                        $q->where('name', 'like', '%' . $search_term . '%');
                        })
                    ->get();
    }

    /**
     * Get all the attributes
     * @return array
     */
    public function getAttributes() {
        return $this->job->getConnection()->getSchemaBuilder()->getColumnListing($this->job->getTable());
    }

    /**
     * Make an empty job instance
     * @return object
     */
    public function makeEmptyJobInstance()
    {
        //Get all the columns
        $columns = array_flip($this->getAttributes());

        //Set the values to empty string and cast it as object
        $job = (object)array_map(function() { return ''; }, $columns);

        $job->hasSkill = $this->getSkillsObject();

        return $job;
    }

    /**
     * Get skills list as an object
     * @return object
     */
    public function getSkillsObject()
    {
        $skillsList = $this->skillsList;

        $skills = array_map(function() { return false; }, $skillsList);

        return (object)$skills;
    }
}