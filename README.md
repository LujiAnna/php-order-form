# Order form

## Must-have features

### Preparation

- [x] View the provided structure: you get both an index file and another file containing a form. `How are these two working together?` In form-view form => require 'form-view.php'; in index.php
- [x] Think of a funny / surprising / original name for a store that should definitely exist. => Video Call Gears
- [x] Think of some products to sell (feel free to be creative) and update the products array with these. => Video Call Gears
- [x] Check if all the products & prices are currently visible in the form. => Create Array of arrays

### Step 1: accepting orders

- [x] Show an order confirmation when the user submits the form. This should contain the chosen products and delivery address).
- [!] We will learn how to save this information to a database later, so no need to do this now.

### Step 2: validation

- Use PHP to check the following:
  - [x] Required fields are not empty.
  - [!] Zip code are only numbers.
  - [*] Email address is valid.
- [x] Show any problems (empty or invalid data) with the fields at the top of the form. Tip: use the [bootstrap alerts](https://getbootstrap.com/docs/4.0/components/alerts/) for inspiration. If they are valid, the confirmation of step 1 is shown.
- [x] If the form was not valid, show the previous values in the form so that the user doesn't have to retype everything.

> Usually, validation is a combination of server side checks (for security, these can't be bypassed) and checks in html / JS (can be bypassed but can give live user feedback).

### Step 3: improve UX by saving user data

- [x] Check out the possibilities of the PHP session and cookies.
- [x] We want to prefill the address (after the first usage), as long as the browser isn't closed. Which of these techniques is the better choice here? Session

> When using cookies on a live site, check any legal requirements.

### Step 4: expanding due to success

- [x] Read about `get` variables and what you can do with it.
- [x] Find commented navigation and activate it. Tweak the content for your own store.
- [x] Make a second category of products, and provide a new array for this info.
- [x] The navigation should work as a toggle to switch between the two categories of products.

## Nice-to-have features

### Delivery times

- Show the expected delivery time in the confirmation message (2h by default).
- A user can opt for express delivery (5$ for delivery in 45min).

### Statistics

- Show statistics about how much money has been spent. This info should be kept (can you use the session or cookies for this?) when the browser closes.
- Include the most popular product (by this user) and amount of products bought by this user.

### Look & feel

- What kind of style would suit your store? Add a color schema and a suitable font.
- Check what you can do for validation with html and JS. Use this to improve your validation.

### Bulk orders

- Allow the user to specify how much he or she wants to buy of a certain products

Sales are almost there... last thing to do is waiting for customers on a shopping spree!

![](https://media.giphy.com/media/iJmi4OLkDgO9aZWS1R/giphy.gif)
