The module sends a new order's data to a specified URL in a JSON format.

## How to install
```
composer require stock2shop2/magento2_module_webhook:*
bin/magento setup:upgrade
rm -rf pub/static/* && bin/magento setup:static-content:deploy en_US <additional locales, e.g.: de_DE>
rm -rf var/di var/generation generated/code && bin/magento setup:di:compile
```
If you have problems with these commands, please check the [detailed instruction](https://mage2.pro/t/263).

## Backend settings

![](https://mage2.pro/uploads/default/original/2X/5/5dc6483369d3628688092c098dd2cb42d28d0dce.png)

## An order's history
![](https://mage2.pro/uploads/default/original/2X/8/86a2ab2c6dba214c229b18b3dda388edeeea8119.png)

## Data example

```
{
    "base_currency_code": "USD",
    "base_discount_amount": 0,
    "base_discount_tax_compensation_amount": 0,
    "base_grand_total": 105,
    "base_shipping_amount": 5,
    "base_shipping_discount_amount": 0,
    "base_shipping_discount_tax_compensation_amnt": 0,
    "base_shipping_incl_tax": 5,
    "base_shipping_tax_amount": 0,
    "base_subtotal": 100,
    "base_subtotal_incl_tax": 100,
    "base_tax_amount": 0,
    "base_to_global_rate": 1,
    "base_to_order_rate": 1,
    "base_total_due": 105,
    "billing_address": {
        "address_type": "billing",
        "city": "New York City",
        "company": "Mage2.PRO",
        "country_id": "US",
        "customer_address_id": 1,
        "email": "admin@mage2.pro",
        "firstname": "Dmitry",
        "lastname": "Fedyuk",
        "postcode": "10001",
        "quote_address_id": "13",
        "region": "New York",
        "region_id": 43,
        "street": "49 West 32nd Street",
        "telephone": "+1 (212) 736-3800"
    },
    "created_at": "2018-08-11 17:18:30",
    "customer": {
        "created_at": "2018-08-10 15:16:55",
        "created_in": "Default Store View",
        "default_billing": "1",
        "default_shipping": "1",
        "disable_auto_group_change": "0",
        "email": "admin@mage2.pro",
        "entity_id": "1",
        "failures_num": "0",
        "firstname": "Dmitry",
        "group_id": "1",
        "is_active": "1",
        "lastname": "Fedyuk",
        "password_hash": "7916da30aa9a40476115244956220b001d723f5b17b2e5475467cd83c247d688:UYz7RVCPATEDrsRrz7Er7xMBzN5RwkGP:1",
        "rp_token": "5705c1d8103fad5797842f11a0794df5",
        "rp_token_created_at": "2018-08-10 15:16:56",
        "store_id": "1",
        "updated_at": "2018-08-10 15:21:12",
        "website_id": "1"
    },
    "customer_email": "admin@mage2.pro",
    "customer_firstname": "Dmitry",
    "customer_group_id": 1,
    "customer_id": "1",
    "customer_is_guest": 0,
    "customer_lastname": "Fedyuk",
    "customer_note_notify": 1,
    "discount_amount": 0,
    "discount_tax_compensation_amount": 0,
    "entity_id": "7",
    "global_currency_code": "USD",
    "grand_total": 105,
    "id": "7",
    "increment_id": "000000007",
    "is_virtual": 0,
    "line_items": [
        {
            "image": "https://localhost.com:737/pub/media/catalog/product/cache/afad95d7734d2fa6d0a8ba78597182b7/c/a/cat03.jpg",
            "name": "Cat",
            "price": 100,
            "price_with_discount": 100,
            "price_with_discount_and_tax": 100,
            "price_with_tax": 100,
            "qty": 1,
            "tax_rate": 0,
            "url": "https://localhost.com:737/cat.html"
        }
    ],
    "order_currency_code": "USD",
    "payment": {
        "additional_information": {
            "method_title": "Check / Money order"
        },
        "amount_ordered": 105,
        "base_amount_ordered": 105,
        "base_shipping_amount": 5,
        "method": "checkmo",
        "shipping_amount": 5
    },
    "protect_code": "c1b0b856b1eecece75ce91b89b33dcc8",
    "quote_id": "3",
    "remote_ip": "127.0.0.1",
    "shipping_address": {
        "address_type": "shipping",
        "city": "New York City",
        "company": "Mage2.PRO",
        "country_id": "US",
        "customer_address_id": "1",
        "email": "admin@mage2.pro",
        "firstname": "Dmitry",
        "lastname": "Fedyuk",
        "postcode": "10001",
        "quote_address_id": "8",
        "region": "New York",
        "region_id": "43",
        "street": "49 West 32nd Street",
        "telephone": "+1 (212) 736-3800"
    },
    "shipping_amount": 5,
    "shipping_description": "Flat Rate - Fixed",
    "shipping_discount_amount": 0,
    "shipping_discount_tax_compensation_amount": 0,
    "shipping_incl_tax": 5,
    "shipping_method": "flatrate_flatrate",
    "shipping_tax_amount": 0,
    "state": "new",
    "status": "pending",
    "store_currency_code": "USD",
    "store_id": 1,
    "store_name": "Main Website\r\nMain Website Store\r\nDefault Store View",
    "store_to_base_rate": 0,
    "store_to_order_rate": 0,
    "subtotal": 100,
    "subtotal_incl_tax": 100,
    "tax_amount": 0,
    "total_due": 105,
    "total_item_count": 1,
    "total_qty_ordered": 1,
    "updated_at": "2018-08-11 17:18:30",
    "visitor": {
        "http_user_agent": "Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36",
        "remote_addr": "92.243.166.8"
    },
    "weight": 400
}
```