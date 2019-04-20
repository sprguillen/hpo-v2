# Login

Used to collect a Token for a registered User.

**URL** : `/api/auth/login`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "username": "[valid username]",
    "password": "[password in plain text]"
}
```

**Data example**

```json
{
    "username": "mysusername",
    "password": "abcd1234"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "success":true,
    "message":"You are logged in. Please wait.",
    "access_token":{
        "token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL2FwaVwvYXV0aFwvbG9naW4iLCJpYXQiOjE1NTU2MDc1MzgsImV4cCI6MTU1NTYxMTEzOCwibmJmIjoxNTU1NjA3NTM4LCJqdGkiOiJlanp3YXJwNHh5c1JrcEJ4Iiwic3ViIjoxLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.jl_dP9PNmkUlsK2kV2-okUTcmGBd9dHDnx2DxeI9hUQ",
        "token_type":"bearer",
        "expires_in":3600
    },
    "logged_in_user":{
        "username":"ellis53","id":1
    }
}
```

## Error Response

**Condition** : If 'username' and 'password' combination is wrong.

**Code** : `422 Unprocessable Entity`

**Content** :

```json
{
    "success": false,
    "message": "Email or password does not match."
}

```

**Condition** : If 'username' not exists.

**Code** : `422 Unprocessable Entity`

**Content** :

```json
{
    "message": "error.validation",
    "errors": {
        "username": [
            0 => "The selected username is invalid."
        ]
    },
    "success": false

}

```
