# Login

Used to collect a Token for a registered User.

**URL** : `/api/auth/login`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "username": "[valid username]",
    "password": "[password in plain text]",
    "client_id": "$passportCredentials->id",
    "client_secret": "$passportCredentials->secret",
    "grant_type": "password"
}
```

> Get passport credentials by accessing `passport_client_credentials()` on frontend. Example: To get passport client secret id `passport_client_credentials()->secret`.


**Data example**

```json
{
    "username": "mysusername",
    "password": "abcd1234",
    "client_id": "2",
    "client_secret": "kgnV4808hnphldXIYbmcxSSjgMUQTwIocNcXQBGg",
    "grant_type": "password"
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
        "access_token" : "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjcxODhiMzQxYTZlZGU3NzMzODA2NTI4NDE3NDdkMGEwMTZkNjA2YTM1OWQ4ODg0NDdhOGI4NGYzZGRmMzJiYmIwOGFlNTMxNzRhZTgxNGU4In0.eyJhdWQiOiIyIiwianRpIjoiNzE4OGIzNDFhNmVkZTc3MzM4MDY1Mjg0MTc0N2QwYTAxNmQ2MDZhMzU5ZDg4ODQ0N2E4Yjg0ZjNkZGYzMmJiYjA4YWU1MzE3NGFlODE0ZTgiLCJpYXQiOjE1NTY3MjA2NzQsIm5iZiI6MTU1NjcyMDY3NCwiZXhwIjoxNTg4MzQzMDc0LCJzdWIiOiIxOCIsInNjb3BlcyI6W119.M4o21SJE20x0azU0e6uaeHZiam8ulsM7mw9OFwBS9gTlZS5XQYVsNd-hVCOjoZvm844D8fGvCPUQZT4gz_UoJvEwiKI3NlwDV78RjEznBimHc90m0ryxzZSlKCSlJHmwE0QOdy5qXfiYst5UW9-Pe3pKsqsyhcVjplge9t14ia7xUwaHPJso2xpCPFUEBwXBm5Q5jx7P2lDg1JQiwYpoP97JiFbxsaJE6gv81JeJTNfSfaCwrxA2b_IUzLSV_scJsJb7xulhvbxKSKi_KwJvNxareqUHjfuvRXbpHQYYQ1jazag0M6oBQY8Kyw2jMs6JRtg8K58vJQ3xSPLLfnMdTRQ3B1Apn9pCeVX8lmbSj8Z6vgLMBl2jxaefe3M-MlawatiwUjPNTWDHN5kCmRymqj1SSkgXNIl50fzB9Rbb-Ke2dKIHidah_xg4MwLdvK3P5BI5z_0sev7DRJ2fszZ7S2QxaGWZhOS8X3H9oFjAUbDN3sLD_QtvlZ-gGsGooRFM8UzokZpI0u8ebXdt8bJPyGUfwRHXOHhkcZmnLLsRKXscVJKagK6mv2m30xSwhMJrYaPJjou9RXQznEOVk_Dvg3A2yIUhMgUBm5rqeYvpZ8JgOm71aaV95EV_CfKRre_e4Y9PXtC6FIXG6BVEyogM-VEDK7JQRdSbTLdyduwNV-o",
    "refresh_token" : "def5020065e40a869df9a50ad91ca84192bbc6c0e5ae9f01137238c647e5cc3e7b80686d6849c598614f95b60a2ae9898aabe1d6ae6d4ff46a49c357f73ba6121e266b84eae4dded2ad9d1509c4244eb3536aa42f73ca52e69b5f6b0257df235cae7cb6ab8d257c2d2ed966016ade5a6331d7a4fe6fe25127f6a4338d32ce91a0998805d988c83489a3888531194d6ca06809dcf60bdd7339865d3366c0c0d0f9b279f8962d7c215ddbdf8bf0a362c23ac71fa34b0237ab92a788fc177fcd5ed0d530af0c6b044b7a1ed5888d7695c74678ae56838c871b3090e08d384b4eaa9b9c6e6948a8cd3003ee6a2fc10b25f0e40167f7982a2437e1e678724695577776781e54b4c601e2b5d750faa162e0267586a78b2e043a2a6bec050209e996de12a533e2963cab26ebce43a231a31299e018eeba726a664195c42db69dd6066d9e084e0946e08d532dbc21208c13e8be9ad10361812b4a893ee7074824eeed6678df1",
    },
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
