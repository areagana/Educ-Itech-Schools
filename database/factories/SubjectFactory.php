<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'form_id' => $this->faker->id(),
            'subject_id' => $this->faker->id(),
            'course_id' => $this->faker->id(),
            'subject_name'=>$this->faker->subject_name(),
            'subject_code'=>$this->faker->subject_code(),
            'created_at'=> now(),
            'updated_at'=> now()
        ];
    }
}
