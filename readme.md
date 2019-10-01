<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## First Project Work-Search https://documenter.getpostman.com/view/3634938/SVfRtT4h?version=latest


**Auth
POST Register[Pass role as String, to prevent confusion with id.||User Roles = [worker, employer, admin]]
POST Login
POST Logout

**User
GET Index[
PARAMS
searchterm
Filter by search term (search in fields "first_name", "last_name", "city", "country")
]+[
http://host/api/user?search=term
Admins only
]
GET Show[
http://work-search.loc/api/user/1
Admin can view any user info
Other users only self info
]
PUT Update[
http://work-search.loc/api/user/2
Admin can update any user
Other users only self account
]
DEL Delete[
http://work-search.loc/api/user/17
Admin can delete any user
Other users only self account
Use SoftDelete. Also SoftDelete all related data (organizations, vacancies, bookings)
]

**Organization
GET Index[
http://work-search.loc/api/organization
Admin get list of all organizations
Employers can see a list of owned organizations
]
POST Store[
http://work-search.loc/api/organization
Can be created only by Employers
]
GET Show[
PARAMS
vacancies1
0 (or without parameter) - nothing to add,
1 - add a list of active vacancies,
2 - list of closed (full) vacancies,
3 - all organization vacancies
workers1
0 (or without parameter) -nothing to add,
1 - add liist of workers, booked to organization vacancies
]+[
http://work-search.loc/api/organization/1?vacancies=1&workers=1
Admin can view any organization details
Employers can view details only about owned ones
]
PUT Update[
http://work-search.loc/api/organization/3
Admin can edit any organization details
Employers can edit details only owned ones
]
DEL Delete[
http://work-search.loc/api/organization/4
Admin can delete any organization
Emploeyrs can delete only owned ones
Use SoftDelete. When deleting organizations also SoftDelete all vacancies and bookings related to it
]


**Vacancy
GET Index[
PARAMS
only_activefalse
true - return active vacancies (default),
false - return all vacancies
]+[
Worker/Employer get list of Active vacancies 
Admin can use "only_active" parameter to get only active or all vacancies
]
POST Store[
http://work-search.loc/api/vacancy
Can be created only by Employers for owned organizations
]
GET Show
http://work-search.loc/api/vacancy/2
Worker can see basic info about vacancy
Employer/Admin additionally get list of booked workers
]
PUT Update[
http://work-search.loc/api/vacancy/3
Can be edited only by Employer-owner or Admin
]
DEL Delete[
http://work-search.loc/api/vacancy/1
Can be deleted by Employer-owner or Admin
Use SoftDelete. Also SoftDelete related bookings
]
POST Book[
http://work-search.loc/api/vacancy-book
For Workers only
Book (sign) on vacancy for current worker
Admin can do this too
]
POST UnBook[
http://work-search.loc/api/vacancy-unbook
Worker can unbook from vacancy
Employer also can refuse booking
Admin can do this too
]


**Stats
GET Vacancies[
http://work-search.loc/api/stats/vacancy
Admin only
Short stat on Active/Closed(Full)/All vacancies count
]
GET Organizations[
http://work-search.loc/api/stats/organization
Admin only
Short stat on users by groups (Admins/Employers/Workers) count
]
GET Users[
http://work-search.loc/api/stats/user
Admin only
Short stat on users by groups (Admins/Employers/Workers) count
]
  
