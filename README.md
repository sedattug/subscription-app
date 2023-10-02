# Subscription API

This application handles subscription management of users (CRUD).Subscriptions of users whose subscriptions have expired are automatically renewed with scheduled tasks.Payments are always assumed to be successful.

## Component Versions

Laravel `v10.24.0`

PHP `v8.2.10`

Postgresql `v10.5`

## How to Run
- Clone project 

```bash
git clone https://github.com/sedattug/subscription-app.git
```
- Go to project directory
- Create `.env` file and copy `.env.example` file to `.env` file
- Configure your database settings in `.env` file
- Create a database named **subscription_app**
- Install composer packages  `composer install`
- Migrate the database `php artisan migrate:refresh`
- Start the application `php artisan serve`
- Open browser and check address: [http://127.0.0.1:8000](http://127.0.0.1:8000)
## Available Endpoints

- Store a User: **POST** `/api/v1/register`
- Store a Subscription: **POST** `/api/v1/user/{id}/subscription`
- Update a Subscription: **PUT** `/api/v1/user/{id}/subscription/{subscription}`
- Delete a Subscription: **DELETE** `/api/v1/user/{id}/subscription/{subscription}`
- Store a Transaction: **POST** `/api/v1/user/{id}/transaction`
- Retrieve a User: **GET** `/api/v1/user/{id}`

## Available Commands

### Renew a Subscription

### `renew:subscription`

It takes 3 parameters. `<user_id:required> <subscription_id:required> <price:optional, default=250>`, it creates payment transaction and updates related subscription's expire date to a month later with given parameters.

For more information, look at: `php artisan renew:subscription -help`

### Check all Subscriptions

### `check:subscriptions`

This command takes just a parameter. `<price:optional, default=250>`, If exists subscriptions which **today** expired , it renews by default price. For change price, add price parameter to command.

For more information, look at: `php artisan check:subscriptions -help`

## Available Jobs

### Renew all Subscriptions

This job **runs daily** at Y-m-d 00:00. It runs `check:subscriptions` command.

It pays users whose subscriptions will **expire today** by the **default price** or the **given price** and renew their subscription by **one month**.

Please run: `php artisan schedule:run`

For show schedule next run time, look at: `php artisan schedule:list`

## Api Documents

Postman Api Document: [Subscription Api Postman Document](https://documenter.getpostman.com/view/3979201/2s9YJZ345u)

Postman Collection: [Json File](https://api.postman.com/collections/3979201-ed2d8eff-d0e7-4aaf-b5dc-ce63ce3109d8?access_key=PMAT-01HBBB5BFJS108QCVGHQPXZ3AY)

Installation: [How to Run](https://github.com/sedattug/subscription-app#how-to-run)

 
