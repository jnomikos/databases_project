# Welcome to the Hell of looking at my code!

It should be fairly self-explanatory, but I wanted to go over the status of the different
pages/functionalities of the site and give some guidance as to how I set things up.
Stuff like forms are all 'functional' despite not connecting to the database or doing
any validation... they're all set up to be used as-is. 

## General

I tried to design the skeleton so that we can all individually work on pieces and they'll
still have a typical style and all work together. Hit me up on Discord if you need more information
about how a certain page works, how I envisioned the functionality, etc.

Generally speaking the login functions 'work,' despite not authenticating to the database. 
Logging in as an Owner disables all links other than logout and redirects to the owner dashboard:
Logging in as a Customer enables shopping cart, checking out, and order tracking.

I tried to use most of the Google developer style for html:
2 spaces indentation, lowercase elements, etc. Only change is I went with 120 max column width.

## Bootstrap

I used Bootstrap 5.2 instead of raw css to style the site. It makes things a lot easier.
https://getbootstrap.com/docs/5.0/getting-started/introduction/
The docs are great and if you want to use some Bootstrap I recommend it,
but if you're not familiar, since Bootstrap is just basically just built on css, 
**you can still use any normal HTML/PHP as you normally would.**
Forms, tables, the whole works. You don't have to use Bootstrap classes or containers or anything.

## Products/Product Landing

The products page is mostly functional as of this writing. We'll need a new database entry, "description"
for a detailed description of the item to show on the landing page. 

## Login and Owner Login 

Right now the authentication is hardcoded to only allow 'fake@email.com' access, 
for both customers and owners. The email address login is sent to the authentication page
using the POST method when the user clicks submit, so you can get the email address
to check for validation in the userauth.php or empauth.php 
> `$_POST['inputemail']`

## Cart/Checkout

SO FAR: the cart is tracked as a session variable array, `$_SESSION['cart']` where the indices 
are the item's productID. Currently it just prints out a quick X of item Y thing, but a look at the code
shows how you can get the product ID and then ping the database for the brand and type of item.

So for instance, `$_SESSION['cart'][1]` shows how many of item 1 are in the cart. The **index does not exist**
if the value is zero, and updating the cart to remove items should unset this entry.

Clicking on Check Out takes the customer to the checkout page where 
they type their shipping address and credit card number. Submitting this form takes them to
submitorder.php, where all the hard work needs to go (creating a new order, putting its status
as pending or processing or whatever, and plopping it all in the database)

**MIGHT NEED:** an additional php file to modify the cart when certain actions are taken.

## Owner Dashboard

It's blank right now. This is where the functionality needs to go for the owners to display
and update order information, as well as looking at the store inventory. 

**MIGHT NEED:** a php file to update the status of the order(s) based on the form data entered here.

## Authentication

Logging in as a customer sets `$_SESSION['user']` to the user's email address. 
Logging in as an owner sets `$_SESSION['owner']` to the owner's email address.
These variables are set until the logout page is called, which terminates the session.
You can check whether a customer is logged in with 
> `if(isset($_SESSION['user']))`

