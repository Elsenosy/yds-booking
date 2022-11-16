# YDS Booking system

### Simple Booking application (API): #Laravel, #JWT, APIs;

## Features
- Users
    - Register new users with specified types: customer | employee | admin | studio_owner.
    - Get user's profile data.
    - User Authentication.
- Studio
    - Get employees list.
    - Get studio list.
    - Add new Studio(for studio owners).
- Employees
    - Change active studio from assigned studios list.
- Reservations
    - Get reservations based on user type
        - All reservations for admin.
        - Customer only reservations for the customer.
        - Logged on's active studio reservations for the employee.
        - Studio's reservations for the studioOwner.
    - Make New Reservation.
    - Cancel reservation by the customer (before passes 15 mins).
---
## Diagrams
### Database schema
![Booking-Schema](/public/screenshots/yds.png)



### Api endpoints
![Apis](/public/screenshots/apis.png)


## Installation
- Composer required, [download](https://getcomposer.org/download/)

    ```bash
    $ cd YDSBooking
    $ composer install
    ```

- Set env variables
    ```bash
    $ cp .env.example .env
    ```
- Create mysql database and Update database configurations
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=ydsbooking
    DB_USERNAME=root
    DB_PASSWORD=secret
    ```
- Run migrations
    ```bash
    $ cd YDSBooking
    $ php artisan migrate --seed
    ```
- Run the project
    ```bash
    $ cd YDSBooking
    $ php artisan serve
    ```
---
## Attachments
 - [Postman collection file](./attachments/YDSBooking%20system.postman_collection.json).
 - [Postman environment file](./attachments/YDSBooking%20Development.postman_environment.json).
 - [Schema file](./attachments/yds-schema.pdf)
