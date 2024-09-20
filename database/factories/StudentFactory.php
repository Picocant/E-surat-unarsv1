<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(Student::GENDERS);

        return [
            'name' => $this->faker->name(($gender == Student::GENDER_MALE) ? 'male' : 'female'),
            'student_number' => $this->faker->numerify('##########'),
            'date_of_bird' => $this->faker->date(),
            'gender' => $gender,
            'address' => $this->faker->address(),
            'father' => $this->faker->name('male'),
            'mother' => $this->faker->name('female'),
            'guardian' => $this->faker->name(),
        ];
    }
}
