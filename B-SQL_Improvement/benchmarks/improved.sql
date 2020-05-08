ALTER TABLE jobs DROP INDEX idx_fulltext_name;
ALTER TABLE personalities DROP INDEX idx_fulltext_name;
ALTER TABLE practical_skills DROP INDEX idx_fulltext_name;
SELECT
  BENCHMARK(250000000, (
    SELECT Jobs.id AS `Jobs__id`
    FROM jobs Jobs
    LEFT JOIN jobs_personalities JobsPersonalities
      ON Jobs.id = (JobsPersonalities.job_id)
    LEFT JOIN personalities Personalities
      ON Personalities.id = (JobsPersonalities.personality_id)
    LEFT JOIN jobs_practical_skills JobsPracticalSkills
      ON Jobs.id = (JobsPracticalSkills.job_id)
    LEFT JOIN practical_skills PracticalSkills
      ON PracticalSkills.id = (JobsPracticalSkills.practical_skill_id)
    WHERE Personalities.name LIKE '%voluptas%'
      AND PracticalSkills.name LIKE '%voluptas%'
      AND Jobs.name LIKE '%voluptas%'
      AND Jobs.description LIKE '%voluptas%'
      AND Jobs.detail LIKE '%voluptas%'
      AND Jobs.business_skill LIKE '%voluptas%'
    ORDER BY Jobs.id DESC
    LIMIT 1
  ));

ALTER TABLE jobs ADD FULLTEXT idx_fulltext_name(name, description, detail, business_skill);
ALTER TABLE personalities ADD FULLTEXT idx_fulltext_name(name);
ALTER TABLE practical_skills ADD FULLTEXT idx_fulltext_name(name);
SELECT
  BENCHMARK(250000000, (
    SELECT Jobs.id AS `Jobs__id`
    FROM jobs Jobs
    LEFT JOIN jobs_personalities JobsPersonalities
      ON Jobs.id = (JobsPersonalities.job_id)
    LEFT JOIN personalities Personalities
      ON Personalities.id = (JobsPersonalities.personality_id)
    LEFT JOIN jobs_practical_skills JobsPracticalSkills
      ON Jobs.id = (JobsPracticalSkills.job_id)
    LEFT JOIN practical_skills PracticalSkills
      ON PracticalSkills.id = (JobsPracticalSkills.practical_skill_id)
    WHERE
      MATCH(Personalities.name)
        AGAINST ('*voluptas*' IN BOOLEAN MODE)
      OR MATCH(PracticalSkills.name)
        AGAINST ('*voluptas*' IN BOOLEAN MODE)
      OR MATCH(Jobs.name, Jobs.description, Jobs.detail, Jobs.business_skill)
        AGAINST ('*voluptas*' IN BOOLEAN MODE)
    ORDER BY Jobs.id DESC
    LIMIT 1
  ));
