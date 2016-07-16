<?php 
namespace JobPortal\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model 
{
    /**
     * Gets all the skills of the Job post
     * @return object
     */
    public function skills()
    {
        return $this->hasMany('JobPortal\Models\JobSkill');
    }
}
