# Send reset password (email)

Send reset password code via email.

**URL** : `/api/auth/reset/password/send`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "email": "[valid email]",
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "success":true,
    "message":"An email has been sent to malika.botsford@abbott.com."
}
```
