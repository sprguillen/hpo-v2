# User

User model

**Column**

* `id` = **integer** | **auto increment**
* `code` = **string(20)**
* `global_prefix` = **string(40)**
* `username` = **string(45)**
* `email` = **string(45)**
* `first_name` = **string(45)**
* `last_name` = **string(45)**
* `role` = **tinyinteger(4)**
* `contact_number` = **string(45)** | **nullable**
* `business_name` = **string(45)** | **nullable**
* `business_address` = **string(255)** | **nullable**
* `is_active` = **tinyinteger(1)**
* `payment_mode` = **tinyinteger(1)**
* `updated_at` = **timestamp**
* `created_at` = **timestamp**

**Column variables**

* `id` = values:
   * `0` = **Client** Role
   * `1` = **Processor** Role  
   * `2` = **Patient** Role  
   * `3` = **Staff** Role  
   * `10` = **Admin** Role  


* `payment_mode` = values:
    * `0` = **Cash**
    * `1` = **Charge**
