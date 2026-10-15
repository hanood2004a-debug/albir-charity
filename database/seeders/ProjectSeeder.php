<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Winter Support Campaign',
                'title_ar' => 'حملة الدفء الشتوي',
                'description' => 'Providing winter essentials to families in need.',
                'description_ar' => 'توفير مستلزمات التدفئة والملابس الشتوية للعائلات المحتاجة في المناطق الأشد برودة.',
                'goal_amount' => 10000,
                'raised_amount' => 6500,
                'status' => 'active',
            ],
            [
                'title' => 'Orphan Sponsorship',
                'title_ar' => 'كفالة الأيتام',
                'description' => 'Monthly sponsorship program for orphans.',
                'description_ar' => 'برنامج كفالة شهرية يوفر الدعم التعليمي والمعيشي للأطفال الأيتام.',
                'goal_amount' => 20000,
                'raised_amount' => 4200,
                'status' => 'active',
            ],
            [
                'title' => 'Clean Water Wells',
                'title_ar' => 'آبار المياه النظيفة',
                'description' => 'Building clean water wells for rural communities.',
                'description_ar' => 'حفر آبار مياه نظيفة وآمنة للشرب في القرى التي تعاني من نقص المياه.',
                'goal_amount' => 15000,
                'raised_amount' => 15000,
                'status' => 'completed',
            ],
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(['title' => $project['title']], $project);
        }
    }
}
