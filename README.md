# tyrell-assessment

## Answer A

```
docker-compose up --build
```

### Answer B
Use EXISTS instead of LEFT JOIN

~~~sql
SELECT 
    Jobs.id AS `Jobs__id`,
    Jobs.name AS `Jobs__name`,
    Jobs.media_id AS `Jobs__media_id`,
    Jobs.job_category_id AS `Jobs__job_category_id`,
    Jobs.job_type_id AS `Jobs__job_type_id`,
    Jobs.description AS `Jobs__description`,
    Jobs.detail AS `Jobs__detail`,
    Jobs.business_skill AS `Jobs__business_skill`,
    Jobs.knowledge AS `Jobs__knowledge`,
    Jobs.location AS `Jobs__location`,
    Jobs.activity AS `Jobs__activity`,
    Jobs.academic_degree_doctor AS `Jobs__academic_degree_doctor`,
    Jobs.academic_degree_master AS `Jobs__academic_degree_master`,
    Jobs.academic_degree_professional AS `Jobs__academic_degree_professional`,
    Jobs.academic_degree_bachelor AS `Jobs__academic_degree_bachelor`,
    Jobs.salary_statistic_group AS `Jobs__salary_statistic_group`,
    Jobs.salary_range_first_year AS `Jobs__salary_range_first_year`,
    Jobs.salary_range_average AS `Jobs__salary_range_average`,
    Jobs.salary_range_remarks AS `Jobs__salary_range_remarks`,
    Jobs.restriction AS `Jobs__restriction`,
    Jobs.estimated_total_workers AS `Jobs__estimated_total_workers`,
    Jobs.remarks AS `Jobs__remarks`,
    Jobs.url AS `Jobs__url`,
    Jobs.seo_description AS `Jobs__seo_description`,
    Jobs.seo_keywords AS `Jobs__seo_keywords`,
    Jobs.sort_order AS `Jobs__sort_order`,
    Jobs.publish_status AS `Jobs__publish_status`,
    Jobs.version AS `Jobs__version`,
    Jobs.created_by AS `Jobs__created_by`,
    Jobs.created AS `Jobs__created`,
    Jobs.modified AS `Jobs__modified`,
    Jobs.deleted AS `Jobs__deleted`,
    JobCategories.id AS `JobCategories__id`,
    JobCategories.name AS `JobCategories__name`,
    JobCategories.sort_order AS `JobCategories__sort_order`,
    JobCategories.created_by AS `JobCategories__created_by`,
    JobCategories.created AS `JobCategories__created`,
    JobCategories.modified AS `JobCategories__modified`,
    JobCategories.deleted AS `JobCategories__deleted`,
    JobTypes.id AS `JobTypes__id`,
    JobTypes.name AS `JobTypes__name`,
    JobTypes.job_category_id AS `JobTypes__job_category_id`,
    JobTypes.sort_order AS `JobTypes__sort_order`,
    JobTypes.created_by AS `JobTypes__created_by`,
    JobTypes.created AS `JobTypes__created`,
    JobTypes.modified AS `JobTypes__modified`,
    JobTypes.deleted AS `JobTypes__deleted`
FROM 
    jobs Jobs
INNER JOIN 
    job_categories JobCategories ON JobCategories.id = Jobs.job_category_id AND JobCategories.deleted IS NULL
INNER JOIN 
    job_types JobTypes ON JobTypes.id = Jobs.job_type_id AND JobTypes.deleted IS NULL
WHERE 
    (JobCategories.name LIKE '%キャビンアテンダント%' OR 
     JobTypes.name LIKE '%キャビンアテンダント%' OR 
     Jobs.name LIKE '%キャビンアテンダント%' OR 
     Jobs.description LIKE '%キャビンアテンダント%' OR 
     Jobs.detail LIKE '%キャビンアテンダント%' OR 
     Jobs.business_skill LIKE '%キャビンアテンダント%' OR 
     Jobs.knowledge LIKE '%キャビンアテンダント%' OR 
     Jobs.location LIKE '%キャビンアテンダント%' OR 
     Jobs.activity LIKE '%キャビンアテンダント%' OR 
     Jobs.salary_statistic_group LIKE '%キャビンアテンダント%' OR 
     Jobs.salary_range_remarks LIKE '%キャビンアテンダント%' OR 
     Jobs.restriction LIKE '%キャビンアテンダント%' OR 
     Jobs.remarks LIKE '%キャビンアテンダント%' OR 
     EXISTS (
        SELECT 1 
        FROM jobs_personalities JobsPersonalities
        INNER JOIN personalities Personalities 
        ON Personalities.id = JobsPersonalities.personality_id 
        WHERE Jobs.id = JobsPersonalities.job_id 
        AND Personalities.name LIKE '%キャビンアテンダント%' 
        AND Personalities.deleted IS NULL
    ) OR 
     EXISTS (
        SELECT 1 
        FROM jobs_practical_skills JobsPracticalSkills
        INNER JOIN practical_skills PracticalSkills 
        ON PracticalSkills.id = JobsPracticalSkills.practical_skill_id 
        WHERE Jobs.id = JobsPracticalSkills.job_id 
        AND PracticalSkills.name LIKE '%キャビンアテンダント%' 
        AND PracticalSkills.deleted IS NULL
    ) OR 
     EXISTS (
        SELECT 1 
        FROM jobs_basic_abilities JobsBasicAbilities
        INNER JOIN basic_abilities BasicAbilities 
        ON BasicAbilities.id = JobsBasicAbilities.basic_ability_id 
        WHERE Jobs.id = JobsBasicAbilities.job_id 
        AND BasicAbilities.name LIKE '%キャビンアテンダント%' 
        AND BasicAbilities.deleted IS NULL
    ) OR 
     EXISTS (
        SELECT 1 
        FROM jobs_tools JobsTools
        INNER JOIN affiliates Tools 
        ON Tools.type = 1 
        AND Tools.id = JobsTools.affiliate_id 
        WHERE Jobs.id = JobsTools.job_id 
        AND Tools.name LIKE '%キャビンアテンダント%' 
        AND Tools.deleted IS NULL
    ) OR 
     EXISTS (
        SELECT 1 
        FROM jobs_career_paths JobsCareerPaths
        INNER JOIN affiliates CareerPaths 
        ON CareerPaths.type = 3 
        AND CareerPaths.id = JobsCareerPaths.affiliate_id 
        WHERE Jobs.id = JobsCareerPaths.job_id 
        AND CareerPaths.name LIKE '%キャビンアテンダント%' 
        AND CareerPaths.deleted IS NULL
    ) OR 
     EXISTS (
        SELECT 1 
        FROM jobs_rec_qualifications JobsRecQualifications
        INNER JOIN affiliates RecQualifications 
        ON RecQualifications.type = 2 
        AND RecQualifications.id = JobsRecQualifications.affiliate_id 
        WHERE Jobs.id = JobsRecQualifications.job_id 
        AND RecQualifications.name LIKE '%キャビンアテンダント%' 
        AND RecQualifications.deleted IS NULL
    ) OR 
     EXISTS (
        SELECT 1 
        FROM jobs_req_qualifications JobsReqQualifications
        INNER JOIN affiliates ReqQualifications 
        ON ReqQualifications.type = 2 
        AND ReqQualifications.id = JobsReqQualifications.affiliate_id 
        WHERE Jobs.id = JobsReqQualifications.job_id 
        AND ReqQualifications.name LIKE '%キャビンアテンダント%' 
        AND ReqQualifications.deleted IS NULL
    )
) 
AND Jobs.publish_status = 1 
AND Jobs.deleted IS NULL
GROUP BY 
    Jobs.id
ORDER BY 
    Jobs.sort_order DESC, 
    Jobs.id DESC 
LIMIT 50 OFFSET 0;

~~~

