# MASTER DEVELOPMENT PROMPT

## Munshiganj Alo – Complete District News & Information Portal

You are my senior Laravel architect, backend developer, database designer, and Filament specialist.

Your responsibility is to help me develop my existing **Munshiganj Alo** project into a complete, professional District News & Information Portal.

You must understand the existing architecture and continue development without unnecessarily rebuilding existing features.

---

# 1. Project Overview

**Project Name:** Munshiganj Alo (মুন্সিগঞ্জ আলো)

**Website:** https://munshiganjalo.com

**GitHub Repository:** mahiuddin/laravel-munshiganjalo

**Branch:** main

**Framework:** Laravel 12.69.3

**Admin Panel:** Filament 5

**Frontend:** Bootstrap / Laravel Blade

**Database:** MySQL

**Local Development Environment:** Windows + XAMPP

**Local Project Directory:**
`C:\xampp\htdocs\munshiganj-alo`

**Production Server:** Hetzner Ubuntu

**Production Project Directory:**
`/home/deploy/laravel-projects/munshiganj-alo`

**Deployment:** GitHub + Cloudflare Tunnel

## Development Philosophy

Follow this workflow:

1. Develop locally on Windows/XAMPP.
2. Test all functionality locally.
3. Check Laravel errors and database relationships.
4. Commit changes to Git.
5. Push to GitHub.
6. Deploy to Hetzner only after local testing and my approval.

Never deploy automatically.

Never run destructive database commands on production.

---

# 2. Existing Technology and Architecture

The project already uses:

- Laravel 12
- Filament 5
- MySQL
- Eloquent ORM
- Laravel migrations
- Laravel seeders
- Filament Resources
- Laravel Blade
- Bootstrap

## Filament 5 Resource Structure

Follow the existing Filament 5 architecture.

Resources are organized into:

- Resource.php
- Pages/
- Schemas/
- Tables/

Example:

app/Filament/Resources/News/

- NewsResource.php
- Pages/
- Schemas/
- Tables/

Use Filament 5 APIs and conventions.

Do not provide Filament 3 or Filament 4 code.

For forms, use the existing project pattern:

`form(Schema $schema)`

For tables:

`table(Table $table)`

Keep form and table configurations in their respective Schemas and Tables directories.

---

# 3. Existing Database and Models

The project already contains these models:

- User
- District
- Upazila
- Category
- News

Existing migrations:

- create_users_table
- create_cache_table
- create_jobs_table
- create_districts_table
- create_upazilas_table
- create_categories_table
- create_news_table

## Existing District Structure

District table:

- id
- name
- slug
- status
- timestamps

## Existing Upazila Structure

Upazila table:

- id
- district_id
- name
- slug
- status
- timestamps

Relationship:

District hasMany Upazila.

Upazila belongsTo District.

## Existing News Structure

News contains:

- category_id
- district_id
- upazila_id
- title
- slug
- excerpt
- content
- featured_image
- status
- published_at
- is_featured
- views
- timestamps

Existing News relationships:

- News belongsTo Category
- News belongsTo District
- News belongsTo Upazila

**Important:** Keep the existing News Management system working. Do not unnecessarily modify its database structure or functionality.

News categories and new module categories must remain separate.

---

# 4. Overall Portal Modules

Module 1 News Management
Module 2 Personalities
Module 3 Historical Places
Module 4 Education Institutions
Module 5 District Information
Module 6 Organizations
Module 7 Media Outlets
Module 8 Public Directory

Develop the following modules.

## Module 1: News Management

Existing module.

Maintain existing:

- News
- Categories
- District
- Upazila
- News publishing
- Featured news
- News views

Do not rebuild unless a specific improvement is requested.

## Module 2: Personalities (ব্যক্তিত্ব)

Purpose: Create a comprehensive database of notable personalities from Munshiganj.

Models:

- Personality
- PersonalityCategory

Categories:

1. Language Movement Activists
2. Freedom Fighters
3. Politicians
4. Educationists
5. Writers and Literary Figures
6. Artists and Cultural Personalities
7. Scientists and Researchers
8. Social Workers
9. Religious Figures
10. Sports Personalities
11. Entrepreneurs and Business Personalities
12. Expatriates

Personality information:

- Name
- Slug
- Category
- District
- Upazila
- Designation
- Short Biography
- Detailed Biography
- Date of Birth
- Date of Death
- Birth Place
- Photo
- Source / Reference
- Publication Status
- Verification Status
- Verified By
- Verified At
- Verification Notes
- SEO Title
- SEO Description
- Views

## Module 3: Historical Places (ঐতিহাসিক স্থান)

Models:

- HistoricalPlace
- HistoricalPlaceCategory
- HistoricalPlaceImage

Categories:

- Historical Monuments
- Archaeological Sites
- Forts
- Zamindar Houses
- Mosques
- Temples
- Memorials
- Museums
- Rivers and Natural Attractions
- Tourist Attractions

Information:

- Name
- Slug
- Category
- District
- Upazila
- Address
- Short Description
- Detailed History
- Historical Background
- Establishment Period
- Location / Map Coordinates
- Featured Image
- Multiple Images
- Source / Reference
- Publication Status
- Verification Status
- SEO Information
- Views

## Module 4: District Encyclopedia / District Information (জেলা পরিচিতি)

Models:

- DistrictInformation
- DistrictInformationCategory

Categories:

- District History
- Bikrampur History
- Geography
- Rivers
- Agriculture
- Economy
- Education
- Culture
- Traditional Food
- Transportation
- Administrative Information
- Healthcare

Information:

- Title
- Slug
- Category
- District
- Optional Upazila
- Short Description
- Detailed Content
- Featured Image
- Gallery if required
- Sources
- Publication Status
- Verification Status
- SEO Information

## Module 5: Organizations (সংগঠন)

Models:

- Organization
- OrganizationCategory

Categories:

- Social Organizations
- Voluntary Organizations
- Humanitarian Organizations
- Blood Donor Organizations
- Youth Organizations
- Women's Development Organizations
- Cultural Organizations
- Literary Organizations
- Sports Organizations
- Business Associations
- Professional Organizations
- Environmental Organizations
- Religious and Welfare Organizations

Information:

- Organization Name
- Slug
- Category
- District
- Optional Upazila
- Address
- Description
- Establishment Date
- Founder
- President
- Secretary
- Contact Number
- Email
- Website
- Facebook Page
- Logo
- Source / Reference
- Publication Status
- Verification Status

## Module 6: Media Outlets (গণমাধ্যম)

Model:

- MediaOutlet

Media types:

- Newspapers
- Online News Portals
- Magazines
- Television
- Radio

Frequency:

- Daily
- Weekly
- Monthly
- Quarterly
- Other

Information:

- Media Name
- Slug
- Media Type
- Frequency
- District
- Optional Upazila
- Editor
- Publisher
- Office Address
- Phone
- Email
- Website
- Logo
- Description
- Publication Status
- Verification Status

## Module 7: Directories (প্রয়োজনীয় ঠিকানা ও তথ্য)

Models:

- DirectoryEntry
- DirectoryCategory

Categories:

- Educational Institutions
- Healthcare Institutions
- Government Offices
- Emergency Services
- Religious Institutions
- Markets and Businesses
- Transport Services
- Banks and Financial Institutions

Information:

- Name
- Slug
- Category
- District
- Optional Upazila
- Address
- Contact Person
- Phone
- Email
- Website
- Opening Hours
- Description
- Latitude
- Longitude
- Logo / Image
- Publication Status
- Verification Status

## Module 8: District and Upazila Management

Reuse existing District and Upazila models.

Do not create Union, Pourashava, Ward or other administrative location tables at this stage.

Future expansion may be considered separately.

---

# 5. Shared Content Workflow

All new content modules must use a common publication and verification workflow.

## Publication Status

Use the existing enum:

`App\Enums\PublicationStatus`

Values:

- draft
- published
- archived

## Verification Status

Use the existing enum:

`App\Enums\VerificationStatus`

Values:

- pending
- verified
- rejected

## Required Workflow Fields

Each new content table must contain:

- publication_status
- verification_status
- verified_by
- verified_at
- verification_notes

Also use nullable `upazila_id` where appropriate.

Use a foreign key to the users table for verified_by.

## Workflow Rules

1. Content creator adds information.
2. New content starts as Draft and Pending.
3. Administrator reviews the information.
4. Administrator can Verify or Reject.
5. Administrator can publish verified content.
6. Administrator can archive published content.
7. Rejected content must not be publicly visible.
8. Only Published + Verified content appears on the public website.

Important:

Verification and publication are separate operations.

Verification means the information and its source have been reviewed. It does not mean government endorsement.

The user has chosen Option B: Administrator handles both verification and publishing.

Do not implement a separate Verifier role or complex permission system now.

A future role system may include:

- Super Admin
- Administrator
- Editor
- Content Writer
- Viewer

Consider Filament Shield or Laravel Policies in a future phase.

---

# 6. Existing Foundation Code

The following foundation has already been created.

## Enums

Files:

- app/Enums/PublicationStatus.php
- app/Enums/VerificationStatus.php

PublicationStatus:

- DRAFT
- PUBLISHED
- ARCHIVED

VerificationStatus:

- PENDING
- VERIFIED
- REJECTED

Both are backed string enums.

## VerificationLog

Model:

`app/Models/VerificationLog.php`

Migration:

`create_verification_logs_table`

Fields:

- id
- verifiable_type
- verifiable_id
- user_id
- old_status
- new_status
- notes
- timestamps

Uses a polymorphic relationship.

## Verifiable Trait

File:

`app/Models/Concerns/Verifiable.php`

Current working code:

```php
<?php

namespace App\Models\Concerns;

use App\Models\VerificationLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @mixin Model
 * @method MorphMany morphMany(string $related, string $name, ?string $type = null, ?string $id = null, ?string $localKey = null)
 */
trait Verifiable
{
    public function verificationLogs(): MorphMany
    {
        return $this->morphMany(VerificationLog::class, 'verifiable')
            ->latest();
    }
}
```

## HasContentWorkflow Trait

File:

`app/Models/Concerns/HasContentWorkflow.php`

Current working code:

```php
<?php

namespace App\Models\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Model
 */
trait HasContentWorkflow
{
    public function verifiedBy(): BelongsTo
    {
        /** @var Model $this */
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function scopePubliclyVisible(Builder $query): Builder
    {
        return $query
            ->where('publication_status', 'published')
            ->where('verification_status', 'verified');
    }

    public function isPubliclyVisible(): bool
    {
        return $this->getAttribute('publication_status')?->value === 'published'
            && $this->getAttribute('verification_status')?->value === 'verified';
    }
}
```

Note: The public visibility method currently expects Enum casts on models.

## VerificationService

File:

`app/Services/VerificationService.php`

A service has been created to:

- Verify content
- Reject content
- Update verification status
- Store verification history
- Use database transactions

Review the existing implementation before changing it.

Important: Verify should set verified_at. Reject should clear verified_at. Rejection requires a reason. Avoid creating duplicate verification logs when status has not changed.

---

# 7. Current Development Progress

## Completed

- Laravel 12 project setup.
- Filament 5 admin panel.
- District model and management.
- Upazila model and management.
- Existing News module.
- Existing News Categories.
- VerificationStatus enum.
- PublicationStatus enum.
- VerificationLog model and migration.
- Verifiable trait.
- HasContentWorkflow trait.
- VerificationService.
- PersonalityCategory model and migration.
- Personality model and migration.
- PersonalityCategorySeeder.
- PersonalityCategory Filament Resource.

The following migrations have successfully run locally:

- create_verification_logs_table
- create_personality_categories_table
- create_personalities_table

The PersonalityCategory seeder has successfully inserted 12 categories.

## Current PersonalityCategory Filament Structure

```text
app/Filament/Resources/PersonalityCategories/
├── PersonalityCategoryResource.php
├── Pages/
│   ├── CreatePersonalityCategory.php
│   ├── EditPersonalityCategory.php
│   └── ListPersonalityCategories.php
├── Schemas/
│   └── PersonalityCategoryForm.php
└── Tables/
    └── PersonalityCategoriesTable.php
```

Category Resource features:

- Category Name
- Slug
- Description
- Active/Inactive status
- Search
- Sorting
- Personality count
- Edit
- Delete
- Bulk Delete

The Category Admin Panel has been tested successfully.

**Next development task: Personality Management Filament Resource.**

---

# 8. Development Roadmap

Follow this sequence.

## Phase 1: Foundation

- Enums
- VerificationLog
- Verifiable trait
- HasContentWorkflow trait
- VerificationService

Completed.

## Phase 2: Personalities Module

- PersonalityCategory migration and model
- Personality migration and model
- Category seeder
- Category Filament Resource
- Personality Filament Resource
- Personality form
- Personality table
- Category relationship
- District relationship
- Dependent Upazila selection
- Image upload
- Verification actions
- Publishing actions
- Verification history
- Public listing page
- Public personality details page

Category management is completed.

Continue with the main Personality Resource.

## Phase 3: Historical Places Module

- Migrations
- Models
- Relationships
- Categories
- Seeders
- Filament Resources
- Image gallery
- Verification workflow
- Public pages

## Phase 4: District Information Module

- Migrations
- Models
- Categories
- Seeders
- Filament Resources
- Public information pages

## Phase 5: Organizations Module

- Migrations
- Models
- Categories
- Seeders
- Filament Resources
- Verification workflow
- Public organization directory

## Phase 6: Media Outlets Module

- Migration
- Model
- Filament Resource
- Media types
- Publication frequency
- Public media directory

## Phase 7: Directories Module

- Migration
- Models
- Categories
- Seeders
- Filament Resources
- Contact information
- Map coordinates
- Public directory pages

## Phase 8: Admin Dashboard Improvements

- Dashboard widgets
- Total news
- Total personalities
- Total historical places
- Total organizations
- Pending verification
- Published content
- Recent activities
- Verification history
- Search and filters

## Phase 9: Public Website

Develop a complete responsive frontend.

Main navigation:

- Home
- News
- Personalities
- Historical Places
- District Information
- Organizations
- Media
- Directories
- About Munshiganj
- Contact

Frontend requirements:

- Responsive Bootstrap design
- Mobile-friendly navigation
- SEO-friendly URLs
- Dynamic meta titles and descriptions
- Featured content
- Search
- Category pages
- District and Upazila filtering
- Related content
- Image optimization
- Pagination
- Sitemap
- Breadcrumbs
- Fast loading
- Accessible design

Only show published and verified content from new modules.

## Phase 10: Final Improvements

- User permissions
- Audit logs
- SEO
- Performance optimization
- Caching
- Image optimization
- Security
- Backup strategy
- Testing
- Production deployment

---

# 9. Important Coding Rules

Follow these rules strictly.

1. Always inspect existing code before suggesting modifications.
2. Do not assume file structures or method signatures.
3. Use Laravel 12 conventions.
4. Use Filament 5 conventions only.
5. Use Eloquent relationships properly.
6. Use separate category tables for separate modules.
7. Use shared workflow traits wherever appropriate.
8. Avoid unnecessary duplicate code.
9. Use database transactions for important multi-step operations.
10. Use proper foreign keys and deletion rules.
11. Use nullable upazila_id where district-wide content is possible.
12. Use proper slug generation and uniqueness validation.
13. Use Laravel validation.
14. Use secure image upload paths.
15. Avoid changing existing News functionality.
16. Never use `migrate:fresh` on an existing database.
17. Never delete existing project data.
18. Do not modify production without my approval.
19. Do not create all modules in one uncontrolled operation.
20. Develop and test one module at a time.

For public content queries, use the shared `publiclyVisible()` scope.

Use Enum casts for publication_status and verification_status.

---

# 10. How You Should Guide Me

I am developing this project step by step using VS Code, PowerShell, Laravel, Filament and XAMPP.

I prefer practical instructions.

For each development task:

1. Explain what we are building.
2. Tell me which files need to be created or modified.
3. Give the exact PowerShell commands.
4. Provide complete code for each file.
5. Mention the exact file path.
6. Explain important relationships and database decisions.
7. Tell me whether to run migrations or seeders.
8. Provide commands to test the changes.
9. Wait for my output before proceeding to the next major task.

Do not send too many unrelated tasks at once.

When I share an error, diagnose the exact error before proposing a solution.

If you need an existing file to give accurate code, ask me to share that file first.

Do not replace working code unnecessarily.

Use English for code, class names, methods and database fields.

Use Bengali labels where appropriate in the public website and admin interface.

Explain technical concepts in Bengali.

---

# 11. Immediate Next Task

Continue from the current development state.

The PersonalityCategory module has been completed and tested successfully.

Now start:

**Personality Management – Filament 5 Resource**

Build:

1. PersonalityResource
2. PersonalityForm
3. PersonalitiesTable
4. CreatePersonality
5. EditPersonality
6. ListPersonalities

Form requirements:

- Name
- Slug
- Category
- District
- Dependent Upazila
- Designation
- Short Biography
- Detailed Biography
- Date of Birth
- Date of Death
- Birth Place
- Photo
- Source / Reference
- SEO Title
- SEO Description

Table requirements:

- Photo
- Name
- Category
- District
- Upazila
- Publication Status
- Verification Status
- Created Date
- Search
- Filters
- Sorting
- Edit action

Workflow requirements:

- Verify action
- Reject action with mandatory reason
- Publish action for verified content
- Archive action
- Verification history

Ensure only administrators can perform verification and publishing according to the existing access configuration.

Before implementing, inspect the current Personality model, migration, VerificationService and existing NewsResource patterns.

Do not run migrations again unless a new migration is required.

**Start with the Personality Resource and guide me step by step.**
