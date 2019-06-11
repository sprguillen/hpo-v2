# Patient Create

#### (**Client Only**)

Store patient on client

**URL** : `/api/client/patient/store`

**Method** : `POST`

**Auth required** : YES

## Success Response

**Code** : `200 OK`

**Post Data**

```json
{
    "client_id": "the_client_id_or_auth_user",
    "client_custom_id": "$client_custom_id", On live this is the `HPD Patient ID`
    "email": "$email", Required*
    "first_name": "$first_name", Required*
    "middle_name": "$middle_name",
    "last_name": "$last_name", Required*
    "mothers_maiden_name": "$mothers_maiden_name",
    "gender": "$gender", Required*
    "birth_date": "$birth_date", Required* - Format (mm/dd/yyyy)
    "passport_number": "$passport_number",
    "citizen": "$citizen",
    "blood_type": "$blood_type",
    "address": "$address",
    "city": "$city",
    "senior_citizen_id": "$senior_citizen_id",
    "telephone_number": "telephone_number",
    "fax_number": "fax_number",
    "mobile_number": "mobile_number",
    "occupation": "occupation",
    "hmo_card": "hmo_card",
    "hmo_card_no": "hmo_card_no",
}
```

> All fields that are **NOT** required are optional.

**Content examples**

```json
{
    "success":true,
    "message":"New patient has been created.",
    "patient": {
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
}
```
