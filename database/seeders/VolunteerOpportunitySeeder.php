<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\VolunteerOpportunity;

class VolunteerOpportunitySeeder extends Seeder
{
    public function run(): void
    {
        $winterProject = Project::where('title', 'Winter Support Campaign')->first();
        $orphanProject = Project::where('title', 'Orphan Sponsorship')->first();

        $opportunities = [
            [
                'project_id' => $winterProject?->id,
                'title' => 'Winter Kits Distribution',
                'title_ar' => 'توزيع حقائب الشتاء',
                'description' => 'Help distribute winter kits to families.',
                'description_ar' => 'مساعدة فريق التوزيع بإيصال حقائب الملابس والدفء للعائلات المستفيدة.',
                'spots_available' => 10,
                'status' => 'open',
            ],
            [
                'project_id' => $orphanProject?->id,
                'title' => 'Tutoring Sessions',
                'title_ar' => 'جلسات تقوية دراسية للأيتام',
                'description' => 'Provide tutoring sessions for sponsored children.',
                'description_ar' => 'إعطاء دروس تقوية بالمواد الدراسية الأساسية للأطفال المكفولين.',
                'spots_available' => 5,
                'status' => 'open',
            ],
            [
                'project_id' => null,
                'title' => 'Social Media Volunteer',
                'title_ar' => 'متطوع لإدارة وسائل التواصل',
                'description' => 'Help manage the charity social media accounts.',
                'description_ar' => 'المساعدة بإدارة صفحات الجمعية على مواقع التواصل الاجتماعي ونشر المحتوى.',
                'spots_available' => 2,
                'status' => 'open',
            ],
        ];

        foreach ($opportunities as $opportunity) {
            VolunteerOpportunity::firstOrCreate(['title' => $opportunity['title']], $opportunity);
        }
    }
}
