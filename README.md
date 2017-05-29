user-api
========
Restful API with HATEOAS implementation.

Powered by Symfony 3.2

### Setup:
```
$ git clone https://github.com/waterelder/user-api.git
$ ./bin/linux_setup
$ php bin/console server:run 0.0.0.0:8000
```
##### OR with Docker

```
$ docker init swarm    #If you have not done this before
$ docker build -t user-api .
$ docker stack deploy -c docker-swarm.yml user-api # Or you can deploy in old fasion way: $docker compose -f docker-swarm.yml up -d
```


### Entities:
- User: email, last name, first name, state (active/ non active),
creation
date
- Group: name

### API methods:
- /users/ fetch(retrieve) list of users
- /users/ create a user
- /users/id/ fetch info of a user
- /users/id/modify users info
- /groups/ fetch list of groups
- /groups/create a group
- /groups/id/modify group info

###  [Documentation](docs/DOCS.md)





