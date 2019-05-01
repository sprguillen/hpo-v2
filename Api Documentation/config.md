# Request API Configuration

## Headers Data

#### Guest routes
Sample routes:
* Login
* Signup
* And other post action that don't need **authenticated user**.

**Method** : `POST`

```
'Content-Type': application/json
'X-Requested-With': XMLHttpRequest
```

#### Auth routes
Sample:
* Admin routes ***(create user, update and delete)***
* User ***(profile, settings) etc***...

**Method** : `GET`

```
'Authorization': Bearer $access_token
```

> **NOTE!** `$access_token` value is returned on `login` or via accessing `/api/auth/user/token` **(via `GET` request)**.

Sample access_token data
```
"access_token": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjZkNmRiZmEzY2FiNjk0Yzc1MTNmZGFiOTRmZDBmNGMzY2JmYzEyNThlOWNiMDY1YWNjMGU5M2Y1NWFmMGNkOGQ3MWEzYWFlYjg4MjcyZDI3In0.eyJhdWQiOiIxIiwianRpIjoiNmQ2ZGJmYTNjYWI2OTRjNzUxM2ZkYWI5NGZkMGY0YzNjYmZjMTI1OGU5Y2IwNjVhY2MwZTkzZjU1YWYwY2Q4ZDcxYTNhYWViODgyNzJkMjciLCJpYXQiOjE1NTY2NDA3NzEsIm5iZiI6MTU1NjY0MDc3MSwiZXhwIjoxNTg4MjYzMTcwLCJzdWIiOiIyMSIsInNjb3BlcyI6W119.rOUTy3EAvnG3XlpY6JspadqLaE9kgV0XWtNmSiY4ZD0lmsh5p9ZknBfYuRVb-pLjpCbsndYa4canE12S_hwL2jDQsLt7UGNTa1tRc9lqWAlzmADACkxj152A9N-2uzzGfS9RwldynOIg40kFEZqc2eLjL1itlhxvj5hYT-AjrmbbibxMxTZV3CNrBQNsD714Zv8qaIjM6e1OUnLZsZ6ogEYAk1UT_Q_DR8dHl7TpI4ebJJZBwJAYOTUETLhLNrXaRAJAm2fr0yCtXVoIQthxF-ODm_SXHUrBSOuhB-MpLRjAagCCAHyP_4AsXlA5aMfogD0ozzdhV46c5l1YiSgMWZ2bIxAlHF3JAJwFgZgJXTNSLvsQUJ5g4023qIU8Ofr83IPRNrhzN5ibVYejwy8ff-FsIN-rzZWRInmy45zGhVtIWd76C6Tio0DpVQk7MTu_f-f-E0xOO25QzkGHzv8rc7mMGPJEQIRjQbwsF4fy1fsQVTbSyWZPOeg5Pi57jQuw_j-dHXQlZ7xvLoPDSrWmLAsrikj0lJk8ODtGIVptb6dBHN1Qyj7Mm5pA9avIUh6XTOQkwCZX2ZgMcROrYN0mIhbYZ4HxYazpTFwdp6rwxytgUs_iNGs2n3LirMjAonCJ1WexftoNyMo1LQPMasy54C-hufUGgDpWIg-RpXbNU1o",
        "token_type": "Bearer",
        "expires_at": "2020-04-30 16:12:50"
    },
```

**Method** : `POST`

```
'Authorization': Bearer $access_token,
'X-Requested-With': XMLHttpRequest
```
