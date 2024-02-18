# Financial House Homework Sample Project


## Developer Log

*In this section, I will log the thought process behind the architectural decisions I've made during the development of this repository.*

- I have started a fresh Laravel 10 project.
- I will be using Laravel Breeze for authentication scaffolding for it satisfies auth requirements of this project out of the box.
- I used tailwind for CSS applications.
- Normally I would use React for an interface of this type, but since this won't go beyond basic item listing and filtering, I opted to use vanilla JavaScript instead. This will also help keep things simple, save time both writing and reviewing.
- I prefer to organize 3rd party API connections in two layers as demonstrated in this project;
  - 1st layer would be a HTTP client dedicated to the 3rd party API in question. This would abstract all the API-specific routines.
  - 2nd layer would be a Service/Repository. This layer would implement the business logic and serves a high level interface for the rest of the program.
- Since Reporting API is an API for generating reports, freshness of the responses are not of paramount. Hence. I have cached data returned from this API briefly. This has several benefits;
  - Debounce API calls.
  - Help users stay under the API rate limits if there are any.
  - Improve UX by serving cached responses where available.
  - Reduce network traffic between server and the 3rd party API.
- Homework document suggest adding "Unit Tests", however I have assumed it was meant to say "Automated Tests". Those terms are used ambiguously in the sector.
  - I think the best suited test type for this kind of application is Feature Tests.
  - Unit Tests could come in handy more in mathematically heavy methods or methods which handle complex business logic.
  - Another automated test type which would be suitable for this application is Browser Testing with Laravel Dusk. But I think that falls out of the scope of this demo.



## TO DO
*I will keep a TO DO list in this section. However, I might not complete most of them for I think polishing a demo project too much won't be necessary. Take this as a list of things that I would have implemented in a commercial project.*

- Dashboard
  - [ ] Keep filters after refreshing the page. (Could use browser local storage to store and retrieve the filters.)
  - [ ] Add pagination support for the transaction list.
  - [X] Add more columns/data points to the table.
  - [ ] Send filter options from the server and dynamically create the filters.
  - [ ] Refactor to use ENUMS for filter options.
  - [ ] Use Data Transfer Objects for Reporting API responses.
  - [ ] Use Data Transfer Objects and method parameter type declarations for `ReportingApiRepository` and `ReportingApiClient` methods.
  - [ ] Handle error cases while listing transactions.
  - [X] Handle zero length results while listing transactions.
  - [ ] Move inline JavaScript to an external file. Manage client side dependencies with a dependency manager.
