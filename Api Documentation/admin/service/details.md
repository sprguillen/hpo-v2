# Service (individual)

#### (**Admin Only**)

Show client service using `service code`

**URL** : `/api/admin/services/details/{code}`

**Params**
- `code` = Service code

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "service":
        {
            "id": 4,
            "code": "e",
            "name": "utilize one-to-one convergence",
            "default_cost": 8471,
            "created_at": "2019-05-18 01:38:18",
            "updated_at": "2019-05-18 01:38:18",

            "clients": [
                {
                    "id": 9,
                    "code": "j",
                    "global_prefix": "",
                    "role": 0,
                    "username": "marisa.romaguera",
                    "email": "jacobi.amanda@gmail.com",
                    "api_token": null,
                    "first_name": "Benny",
                    "last_name": "Konopelski",
                    "contact_number": "(959) 846-3290 x156",
                    "business_name": "Bins, Johnson and Koelpin",
                    "business_address": "534 Autumn Bypass Darrelchester, OK 30131",
                    "is_active": 1,
                    "payment_mode": 0,
                    "created_at": "2019-05-18 00:59:39",
                    "updated_at": "2019-05-18 00:59:39",
                    "full_name": "Benny Konopelski",
                },
                {
                    "id": 14,
                    "code": "p",
                    "global_prefix": "",
                    "role": 0,
                    "username": "dach.diamond",
                    "email": "mcclure.nettie@yahoo.com",
                    "api_token": null,
                    "first_name": "Mohamed",
                    "last_name": "Hahn",
                    "contact_number": "1-692-630-0244 x407",
                    "business_name": "Feil, Hartmann and Koepp",
                    "business_address": "932 Geraldine Flat Cormierfort, OH 12773",
                    "is_active": 1,
                    "payment_mode": 0,
                    "created_at": "2019-05-18 00:59:40",
                    "updated_at": "2019-05-18 03:42:00",
                    "full_name": "Mohamed Hahn",
                }
            ]
        }

    }
}
```
