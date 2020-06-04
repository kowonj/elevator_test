#### Provided Source: 
* * *
# Elevator Controls

 
## What is this?
This is a code challenge to be able to get a feel for how candidates for employment write and organize code. This is not a test, though code should be functional.

## So, what am I expected to do?

The goal of this challenge is to code an elevator system. The expectation is to utilize PHP Object Oriented best practices to create a functional REST-ish API that can cause elevator cars to react to calls to different floors in an efficient manner. SlimPHP has been provided as a framework, and persistance layer, or additional libraries, are up to the digression of the developer.

## What are the requirements?

 - Be able to configure the number of Elevator Cars via the `ELEVATOR_CAR_COUNT` environmental variable (.env)
 - Be able to configure the number of Elevator Cars via the `FLOOR_COUNT` environmental variable (.env)

## How should I do this?

- Clone this repository to your local environment
- Set up a new remote to add from repository service of choice (Gitlab, Github, Bitbucket, etc..)
- Write tests
- Write code
- Test Code
- When complete, Invite the hiring manager to a PR in the personal remote 

* * *
### Notes: 

As described [above](http://bitbucket.poweredbyefi.org/projects/LIB/repos/elevator_test/browse), this is a simple example of RESTful API with PHP, Slim 3, JavaScript, jQuery, AJAX, bootstrap, HTML, CSS. 

Additional tools: [dotenv](https://packagist.org/packages/vlucas/phpdotenv), [composer](https://getcomposer.org/download/), GIT.

#### Install:
- Download [composer](https://getcomposer.org/download/) and install.
  ```
   composer install
  ```
- To run PHP localhost server
  ```
   # run in ~/public folder.
   cd public 
   php -S localhost:8080
  ```
- Dependency - Install PhpRenderer
  ```
   composer.phar require slim/php-view
  ```
- Dependency - Install [dotenv](https://packagist.org/packages/vlucas/phpdotenv)
  ```
   composer require vlucas/phpdotenv
   
   # Need to dump autoload after installing dotenv.
   composer dump-autoload
  ```
- To untrack .env file:
  ```
    #In elevator-test folder:
    git update-index --assume-unchanged src/.env
  ```
  

#### Folder Structure: 
```
├── ELEVATOR_TEST
│   └── public
│   └── src
│   │    └── App
│   │    └── Templates
│   │    └── .env (file)
│   └── tests
│   └── vendor
```
#### Reference: 
- [Slim v3 Tutorial - First Application Walkthrough](http://www.slimframework.com/docs/v3/tutorial/first-app.html). Github: [Tutorial Code](https://github.com/slimphp/Tutorial-First-Application)
- Rest API in Slim PHP - [Github](https://github.com/maurobonfietti/rest-api-slim-php)

#### ENDPOINTS:
- `GET /`
- `POST /Elevator`
- `PUT /Elevator/{id}`

#### What it does:
- With PHP local webserver running: `php -S localhost:8080`, a page will be rendered in ``localhost:8080``.
  
- Default UI as below:<br/>
![Default UI](https://github.com/kowonj/elevator_test/blob/master/src/resources/images/elevator_ui1.PNG)

- Users can enter how many elevator they want to create (min: 1, max: 3). 
- Three blocks which each of them represents an elevator will be rendered.
- If created elevator is less than the maximun number 3, elevator(s) will be disabled to enter a floor number upon number of elevator car(s) created.
- <b>POST</b> Method: When 'Create' is submitted, the number entered will be stored in ``ELEVATOR_CAR_COUNT`` environment variables (.env), and will assign default values to ``FLOOR_COUNT``.
  ```
    # ex.
    # For example, if 2 elevators are created, 
    # then the following default string will be
    # stored in FLOOR_COUNT enviroment variable with default value 1.

     FLOOR_COUNT={"elev1":"1","elev2":"1"}

    # If 3 elevators are created, then:
     FLOOR_COUNT={"elev1":"1","elev2":"1", "elev3":"3"}

  ``` 
  ![Create-success](https://github.com/kowonj/elevator_test/blob/master/src/resources/images/elevator_ui1-created.PNG)
 
- User can enter a floor number between 1 to 5.
- <b>PUT</b> Method: When 'Go' button is submitted, Backend will update ``FLOOR_COUNT`` in .env file and return updated data as a response: 
  ```
    # ex.
    {"elev1":"2","elev2":"3","elev3":"3"}
  ```
  
- If POST request is successfuly processed, the frontend will show 'Success' message (AJAX) and the message will be hidden after few seconds.

- If PUT request is successfuly processed, the frontend will show 'Success' message (AJAX) and the message will be hidden after few seconds. Then it will show a info text of current floor. The text will be updated via AJAX.
- ex. Elevator 1 floor changed:
 ![go1](https://github.com/kowonj/elevator_test/blob/master/src/resources/images/elevator_ui1-go1.PNG)
- ex. Elevator 2 floor changed:
 ![go2](https://github.com/kowonj/elevator_test/blob/master/src/resources/images/elevator_ui1-go2.PNG)


#### TO DO:
 - [ ] `GET /Elevator/{id}` 
 - [ ] `DELETE /Elevator/delete/{id}`
 - [ ] Test cases
 - [ ] Breaking down into classes and functions
 - [ ] Improvements on UI

