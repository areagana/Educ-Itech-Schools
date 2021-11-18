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
            'form_id' => $this->faker->integer(),
            'subject_id' => $this->faker->integer(),
            'course_id' => $this->faker->integer(),
            'subject_name'=>$this->faker->name(),
            'subject_code'=>$this->faker->text(),
            'created_at'=> now(),
            'updated_at'=> now()
        ];
    }
}
