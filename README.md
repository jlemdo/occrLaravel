# Food Backend API

This is the API for the Food Backend application. It provides endpoints for managing users, products, orders, and more.

## Authentication

- `POST /register`: Register a new user.
  - **Parameters**: `first_name`, `last_name`, `email`, `contact_number`, `password`, `password_confirmation`
- `POST /api/login`: Log in a user.
  - **Parameters**: `email`, `password`
- `POST /forgetpasswordlink`: Send a password reset link.
  - **Parameters**: `email`
- `POST /updateuserprofile`: Update a user's profile.
  - **Parameters**: `userid`, `first_name`, `last_name`, `address`, `phone`, `dob`
- `POST /updateusepassword`: Update a user's password.
  - **Parameters**: `userid`, `current_password`, `password`, `password_confirmation`
- `POST /auth/google`: Log in with Google.
  - **Parameters**: `id_token`

## Products

- `GET /products/{category?}`: Get a list of products, optionally filtered by category.
  - **URL Parameters**: `category` (optional)
- `GET /productscats`: Get a list of product categories.

## Orders

- `POST /ordersubmit`: Submit a new order.
  - **Parameters**: `userid`, `customer_lat`, `customer_long`, `user_email`, `need_invoice`, `tax_details`, `delivery_date`, `delivery_slot`, `orderdetails` (array of objects with `item_name`, `item_price`, `item_qty`, `item_image`)
- `GET /orderhistory/{userid}`: Get a user's order history.
  - **URL Parameters**: `userid`
- `GET /orderhistorydriver/{userid}`: Get a driver's order history.
  - **URL Parameters**: `userid`
- `GET /orderdetails/{orderid}`: Get the details of a specific order.
  - **URL Parameters**: `orderid`
- `POST /orderdel`: Mark an order as delivered (for drivers).
  - **Parameters**: `orderid`

## Payment

- `POST /create-payment-intent`: Create a payment intent for Stripe.
  - **Parameters**: `amount`, `currency`
- `POST /stripe/webhook`: Handle Stripe webhooks.
  - **Parameters**: Stripe webhook event object

## Driver Location

- `POST /driverlocsubmit`: Submit a driver's location.
  - **Parameters**: `orderid`, `driver_lat`, `driver_long`
- `GET /driverlocationsagainstorder/{orderid}`: Get driver locations for a specific order.
  - **URL Parameters**: `orderid`

## Messaging

- `POST /msgsubmit`: Submit a message.
  - **Parameters**: `orderid`, `sender`, `message`
- `GET /msgfetch/{orderid}`: Fetch messages for a specific order.
  - **URL Parameters**: `orderid`

## Address Management

- `POST /addaddress`: Add a new address for a user.
  - **Parameters**: `userid`, `address`, `phone`, `is_default`
- `GET /fetch_address/{id}`: Fetch all addresses for a user.
  - **URL Parameters**: `id` (user id)
- `GET /fetch_address_single_edit/{id}`: Fetch a single address for editing.
  - **URL Parameters**: `id` (address id)
- `POST /updateaddress`: Update an address.
  - **Parameters**: `address_id`, `userid`, `address`, `phone`, `is_default`
- `POST /deleteaddress`: Delete an address.
  - **Parameters**: `id` (address id)

## Other

- `GET /fetch_ddates/{ddate}`: Fetch delivery dates.
  - **URL Parameters**: `ddate`
- `GET /userdetails/{userid}`: Get user details.
  - **URL Parameters**: `userid`
- `POST /compsubmit`: Submit a complaint.
  - **Parameters**: `orderno`, `message`
