# Search patient

#### (**Client Only**)

Used to search patient.

**URL** : `/api/client/patient/search/{$key}`

**Params**
1. **key** = search key

**Method** : `GET`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Content examples**

```json
{
    "success":true,
    "message":"",
    "patients":{
        "current_page":1,
        "data":[
            {
                "id": 41,
                "client_id": 28,
                "code": "bh",
                "global_custom_id": "OL411560265182",
                "hpo_patient_id": "OL411560265182",
                "client_custom_id": null,
                "email": "zita.goyette@hotmail.com",
                "first_name": "Cornelius",
                "middle_name": null,
                "last_name": "Halvorson",
                "mothers_maiden_name": null,
                "gender": "female",
                "birth_date": "2005-05-26 00:00:00",
                "passport_number": "3720162815355",
                "citizen": "Pilipino",
                "blood_type": "O",
                "address": "5118 Malinda Track Suite 794 Schustershire, CA 39002-8100",
                "city": "Faheymouth",
                "senior_citizen_id": "9433196320101",
                "telephone_number": "866.259.1801",
                "fax_number": null,
                "mobile_number": null,
                "occupation": "Loading Machine Operator",
                "hmo_card": null,
                "hmo_card_no": null,
                "last_visit_at": null,
                "deleted_at": null,
                "created_at": "2019-06-11 22:59:42",
                "updated_at": "2019-06-11 22:59:42",
            },
            {
                "id": 41,
                "client_id": 28,
                "code": "bh",
                "global_custom_id": "OL411560265182",
                "hpo_patient_id": "OL411560265182",
                "client_custom_id": null,
                "email": "zita.goyette@hotmail.com",
                "first_name": "Cornelius",
                "middle_name": null,
                "last_name": "Halvorson",
                "mothers_maiden_name": null,
                "gender": "female",
                "birth_date": "2005-05-26 00:00:00",
                "passport_number": "3720162815355",
                "citizen": "Pilipino",
                "blood_type": "O",
                "address": "5118 Malinda Track Suite 794 Schustershire, CA 39002-8100",
                "city": "Faheymouth",
                "senior_citizen_id": "9433196320101",
                "telephone_number": "866.259.1801",
                "fax_number": null,
                "mobile_number": null,
                "occupation": "Loading Machine Operator",
                "hmo_card": null,
                "hmo_card_no": null,
                "last_visit_at": null,
                "deleted_at": null,
                "created_at": "2019-06-11 22:59:42",
                "updated_at": "2019-06-11 22:59:42",
            },
        ],
        "first_page_url":"http://localhost/api/client/patient?page=1",
        "from":1,
        "last_page":4,
        "last_page_url":"http://localhost/api/client/patient?page=4",
        "next_page_url":"http://localhost/api/client/patient?page=2",
        "path":"http://localhost/api/client/patient",
        "per_page":10,
        "prev_page_url":null,
        "to":10,
        "total":36
    }
}
```

> Result is in `pagination` format. See [Pagination format](../../helper/pagination.md)
