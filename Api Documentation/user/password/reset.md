# Reset user password

Send reset password code via email.

**URL** : `/api/auth/reset/password`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "token": "valid_password_reset_token",
    "password": "secret",
    "password_confirmation": "secret",
}
```
> Note: You can get the token and assign on hidden input on the end of the **url** example: `http://dev.erts-hpo.com/reset-password/{token}`

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "success":true,
    "message":"Your password has been reset!"
}
```
