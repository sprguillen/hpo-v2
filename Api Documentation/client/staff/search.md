# Search staff

#### (**Client Only**)

Used to search staff on a client using name.

**URL** : `/api/client/staff/search/{$key}`

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "services":{
        "current_page":1,
        "data":[
            {
                "id": 38,
                "client_id": 75,
                "staff_id": 126,
                "deleted_at": null,
                "created_at": "2019-06-05 01:03:46",
                "updated_at": "2019-06-05 01:03:46",
                "user": {
                    "id": 126,
                    "dispatcher_id": null,
                    "code": "dz",
                    "global_prefix": null,
                    "role": 3,
                    "username": "LolaGaylord",
                    "email": "sporer.geovanni@gmail.com",
                    "api_token": null,
                    "first_name": "Lola",
                    "last_name": "Gaylord",
                    "contact_number": null,
                    "business_name": null,
                    "business_address": null,
                    "is_active": 1,
                    "payment_mode": 0,
                    "created_at": "2019-06-05 01:03:46",
                    "updated_at": "2019-06-05 01:03:46",
                    "full_name": "Lola Gaylord",
                }
            },
            {
                "id": 38,
                "client_id": 75,
                "staff_id": 126,
                "deleted_at": null,
                "created_at": "2019-06-05 01:03:46",
                "updated_at": "2019-06-05 01:03:46",
                "user": {
                    "id": 126,
                    "dispatcher_id": null,
                    "code": "dz",
                    "global_prefix": null,
                    "role": 3,
                    "username": "LolaGaylord",
                    "email": "sporer.geovanni@gmail.com",
                    "api_token": null,
                    "first_name": "Lola",
                    "last_name": "Gaylord",
                    "contact_number": null,
                    "business_name": null,
                    "business_address": null,
                    "is_active": 1,
                    "payment_mode": 0,
                    "created_at": "2019-06-05 01:03:46",
                    "updated_at": "2019-06-05 01:03:46",
                    "full_name": "Lola Gaylord",
                }
            },
        ],
        "first_page_url":"http://localhost/api/admin/processor?page=1",
        "from":1,
        "last_page":4,
        "last_page_url":"http://localhost/api/admin/processor?page=4",
        "next_page_url":"http://localhost/api/admin/processor?page=2",
        "path":"http://localhost/api/admin/processor",
        "per_page":10,
        "prev_page_url":null,
        "to":10,
        "total":36
    }
}
```

> Result is in `pagination` format. See [Pagination format](../../helper/pagination.md)
