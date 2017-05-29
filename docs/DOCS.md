## Documentation: 



### Fetch(retrieve) list of users
##### Method: GET
##### Path: /users/
##### Result:
```
200 Success
Content-Type: application/hal+json

[
  {
    "id": 1,
    "firstName": "Ivan",
    "lastName": "Ivanov",
    "email": "ivanivanov@acme.com",
    "state": "ACTIVE",
    "createdAt": "2017-05-29T00:20:24+0300",
    "_links": {
      "self": {
        "href": "/users/1"
      },
      "all_users": {
        "href": "/users/"
      },
      "userGroup": {
        "href": "/groups/1"
      }
    },
    "_embedded": {
      "userGroup": {
        "id": 1,
        "name": "XBOX Fans",
        "_links": {
          "self": {
            "href": "/groups/1"
          },
          "all_groups": {
            "href": "/groups/"
          }
        }
      }
    }
  },
  {
    "id": 2,
    "firstName": "Petr",
    "lastName": "Petrov",
    "email": "petrpetrov@acme.com",
    "state": "INACTIVE",
    "createdAt": "2017-05-29T00:20:24+0300",
    "_links": {
      "self": {
        "href": "/users/2"
      },
      "all_users": {
        "href": "/users/"
      },
      "userGroup": {
        "href": "/groups/1"
      }
    },
    "_embedded": {
      "userGroup": {
        "id": 1,
        "name": "XBOX Fans",
        "_links": {
          "self": {
            "href": "/groups/1"
          },
          "all_groups": {
            "href": "/groups/"
          }
        }
      }
    }
  }
]
```

## Fetch info of a user
##### Method: GET
##### Path: /users/{id}
##### Result:
```
path: /users/1

200 Success
Content-Type: application/hal+json

{
  "id": 1,
  "firstName": "Ivan",
  "lastName": "Ivanov",
  "email": "ivanivanov@acme.com",
  "state": "ACTIVE",
  "createdAt": "2017-05-29T00:20:24+0300",
  "_links": {
    "self": {
      "href": "/users/1"
    },
    "all_users": {
      "href": "/users/"
    },
    "userGroup": {
      "href": "/groups/1"
    }
  },
  "_embedded": {
    "userGroup": {
      "id": 1,
      "name": "XBOX Fans",
      "_links": {
        "self": {
          "href": "/groups/1"
        },
        "all_groups": {
          "href": "/groups/"
        }
      }
    }
  }
}
```


## Create a user
##### Method: POST
##### Path: /users/

##### Payload:
```
Accept: json
Content-Type: json


{
"firstName": "Ivan",
"lastName": "Ivanov",
"email": "ivanivanov@acmee.com",
"state": "ACTIVE",
"userGroup": 2
}

```
##### Result:
```
201 Created
Content-Type: application/hal+json

{
  "id": 8,
  "firstName": "Ivan",
  "lastName": "Ivanov",
  "email": "ivanivanov@acmee.com",
  "state": "ACTIVE",
  "createdAt": "2017-05-29T05:47:24+0300",
  "_links": {
    "self": {
      "href": "/users/8"
    },
    "all_users": {
      "href": "/users/"
    },
    "userGroup": {
      "href": "/groups/2"
    }
  },
  "_embedded": {
    "userGroup": {
      "id": 2,
      "name": "PS4 Lovers",
      "_links": {
        "self": {
          "href": "/groups/2"
        },
        "all_groups": {
          "href": "/groups/"
        }
      }
    }
  }
}
```

## Modify users info
##### Method: PUT/PATCH
##### Path: /users/{id}

##### Payload:
```
path: /users/8

Accept: json
Content-Type: json


{"id": 8
"firstName": "Ivan2",
"lastName": "Ivanov2",
"email": "ivanivanov2@acmee.com",
"state": "INACTIVE",
"userGroup": 1
}

```
##### Result:
```
200 Success
Content-Type: application/hal+json

{
  "id": 8,
  "firstName": "Ivan2",
  "lastName": "Ivanov2",
  "email": "ivanivanov2@acmee.com",
  "state": "INACTIVE",
  "createdAt": "2017-05-29T05:47:24+0300",
  "_links": {
    "self": {
      "href": "/users/8"
    },
    "all_users": {
      "href": "/users/"
    },
    "userGroup": {
      "href": "/groups/1"
    }
  },
  "_embedded": {
    "userGroup": {
      "id": 1,
      "name": "XBOX Fans",
      "_links": {
        "self": {
          "href": "/groups/1"
        },
        "all_groups": {
          "href": "/groups/"
        }
      }
    }
  }
}
```
## Fetch list of groups
##### Method: GET
##### Path: /groups/

##### Result:
```
200 Success
Content-Type: application/hal+json

[
  {
      "id": 1,
      "name": "XBOX Fans",
      "_links": {
        "self": {
          "href": "/groups/1"
        },
        "all_groups": {
          "href": "/groups/"
        },
        "users": {
          "href": "/users/"
        }
      },
      "_embedded": {
        "users": [
          {
            "id": 1,
            "firstName": "Ivan",
            "lastName": "Ivanov",
            "email": "ivanivanov@acme.com",
            "state": "ACTIVE",
            "createdAt": "2017-05-29T00:20:24+0300",
            "_links": {
              "self": {
                "href": "/users/1"
              },
              "all_users": {
                "href": "/users/"
              }
            }
          },
          {
            "id": 2,
            "firstName": "Petr",
            "lastName": "Petrov",
            "email": "petrpetrov@acme.com",
            "state": "INACTIVE",
            "createdAt": "2017-05-29T00:20:24+0300",
            "_links": {
              "self": {
                "href": "/users/2"
              },
              "all_users": {
                "href": "/users/"
              }
            }
          },
          {
            "id": 4,
            "firstName": "Ivan2",
            "lastName": "Ivanov2",
            "email": "ivanivanov26@acme.com",
            "state": "ACTIVE",
            "createdAt": "2017-05-29T02:59:16+0300",
            "_links": {
              "self": {
                "href": "/users/4"
              },
              "all_users": {
                "href": "/users/"
              }
            }
          },
          {
            "id": 8,
            "firstName": "Ivan2",
            "lastName": "Ivanov2",
            "email": "ivanivanov2@acmee.com",
            "state": "INACTIVE",
            "createdAt": "2017-05-29T05:47:24+0300",
            "_links": {
              "self": {
                "href": "/users/8"
              },
              "all_users": {
                "href": "/users/"
              }
            }
          }
        ]
      }
    },
    {
      "id": 2,
      "name": "PS4 Lovers",
      "_links": {
        "self": {
          "href": "/groups/2"
        },
        "all_groups": {
          "href": "/groups/"
        },
        "users": {
          "href": "/users/"
        }
      },
      "_embedded": {
        "users": [
          {
            "id": 3,
            "firstName": "Michail",
            "lastName": "Michailov",
            "email": "michailmiichailov@acme.com",
            "state": "ACTIVE",
            "createdAt": "2017-05-29T00:20:24+0300",
            "_links": {
              "self": {
                "href": "/users/3"
              },
              "all_users": {
                "href": "/users/"
              }
            }
          },
          {
            "id": 7,
            "firstName": "Ivan22",
            "lastName": "Ivanov222",
            "email": "ivanivanov2622222@acme.com",
            "state": "ACTIVE",
            "createdAt": "2017-05-29T03:16:48+0300",
            "_links": {
              "self": {
                "href": "/users/7"
              },
              "all_users": {
                "href": "/users/"
              }
            }
          }
        ]
      }
    }
  }
]
```

## Create a group
##### Method: POST
##### Path: /groups/

##### Payload:
```
Accept: json
Content-Type: json


{
"name":"SteamMachines Fans",
"users":[5,6,1]
}

```
##### Result:
```
201 Created
Content-Type: application/hal+json

{
  "id": 36,
  "name": "SteamMachines Fans",
  "_links": {
    "self": {
      "href": "/groups/36"
    },
    "all_groups": {
      "href": "/groups/"
    },
    "users": {
      "href": "/users/"
    }
  },
  "_embedded": {
    "users": [
      {
        "id": 5,
        "firstName": "Ivan33",
        "lastName": "Ivanov33",
        "email": "ivanivanov262@acme.com",
        "state": "ACTIVE",
        "createdAt": "2017-05-29T02:59:50+0300",
        "_links": {
          "self": {
            "href": "/users/5"
          },
          "all_users": {
            "href": "/users/"
          }
        }
      },
      {
        "id": 6,
        "firstName": "Ivan22",
        "lastName": "Ivanov222",
        "email": "ivanivanov2622@acme.com",
        "state": "INACTIVE",
        "createdAt": "2017-05-29T03:00:30+0300",
        "_links": {
          "self": {
            "href": "/users/6"
          },
          "all_users": {
            "href": "/users/"
          }
        }
      },
      {
        "id": 1,
        "firstName": "Ivan",
        "lastName": "Ivanov",
        "email": "ivanivanov@acme.com",
        "state": "ACTIVE",
        "createdAt": "2017-05-29T00:20:24+0300",
        "_links": {
          "self": {
            "href": "/users/1"
          },
          "all_users": {
            "href": "/users/"
          }
        }
      }
    ]
  }
}
```

## Modify group info

##### Method: PUT/PATCH
##### Path: /groups/{id}

##### Payload:
```
path: /groups/36

Accept: json
Content-Type: json


{
"id":36,
"name":"SteamMachines Fans!!!!!",
"users":[5,6]
}

```
##### Result:
```
200 Success
Content-Type: application/hal+json

{
  "id": 36,
  "name": "SteamMachines Fans!!!!!",
  "_links": {
    "self": {
      "href": "/groups/36"
    },
    "all_groups": {
      "href": "/groups/"
    },
    "users": {
      "href": "/users/"
    }
  },
  "_embedded": {
    "users": [
      {
        "id": 5,
        "firstName": "Ivan22",
        "lastName": "Ivanov22",
        "email": "ivanivanov262@acme.com",
        "state": "ACTIVE",
        "createdAt": "2017-05-29T02:59:50+0300",
        "_links": {
          "self": {
            "href": "/users/5"
          },
          "all_users": {
            "href": "/users/"
          }
        }
      },
      {
        "id": 6,
        "firstName": "Ivan22",
        "lastName": "Ivanov222",
        "email": "ivanivanov2622@acme.com",
        "state": "INACTIVE",
        "createdAt": "2017-05-29T03:00:30+0300",
        "_links": {
          "self": {
            "href": "/users/6"
          },
          "all_users": {
            "href": "/users/"
          }
        }
      }
    ]
  }
}
```