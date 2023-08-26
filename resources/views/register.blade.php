<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <script src="https://kit.fontawesome.com/726d0afaa7.js" crossorigin="anonymous"></script>
</head>

<body>
    <!--Registering with steps for better user experience-->
    <h2>Register</h2>

    <!--Step 1: choose registering type-->
    <div id="Registering_Type_Content">
        <h3>Select registering type</h3>
        <div>
            <p>I want to bid on items!</p>
            <input type="radio" class="radio_item" value="" name="usertype" id="usertype_bidder">
            <label class="label_item" for="usertype_bidder"> <i class="fa-solid fa-bag-shopping"></i> </label>
        </div>
        <div>
            <p>I have items to sell!</p>
            <input type="radio" class="radio_item" value="" name="usertype" id="usertype_merchant">
            <label class="label_item" for="usertype_merchant"> <i class="fa-solid fa-tag"></i> </label>
        </div>
        <div>
            <p>I want to expertise items!</p>
            <input type="radio" class="radio_item" value="" name="usertype" id="usertype_auctioneer">
            <label class="label_item" for="usertype_auctioneer"> <i class="fa-solid fa-user-tie"></i> </label>
        </div>

        <input type="submit" value="Next">
    </div>

    <!--Step 2: account information-->
    <div id="Account_Information_Content">
        <h3>Account details</h3>
        <form action="">
            <label>Enter a username</label>
            <input type="text">
            <label>Enter email</label>
            <input type="email">
            <label>Enter password</label>
            <input type="password">
            <label>Confirm password</label>
            <input type="password">

            <input type="submit" value="Next">
        </form>
    </div>

    <!--Step 3: personal information-->
    <div id="Personal_Information_Content">
        <h3>Personal details</h3>
        <form action="">
            <label>First name</label>
            <input type="text">
            <label>Last name</label>
            <input type="text">
            <label>Birth date</label>
            <input type="date">
            <label>Contact number</label>
            <input type="text">
            <input type="number">
            
            <input type="submit" value="Next">
        </form>
    </div>

    <!--Step 4: location information-->
    <div id="Location_Information_Content">
        <h3>Location details</h3>
        <form action="">
            <label>Street</label>
            <input type="text">
            <label>City</label>
            <input type="text">
            <label>Postal/Zip Code</label>
            <input type="text">
            <label>Country</label>
            <input type="text">
            
            <input type="submit" value="Next">
        </form>
    </div>

    @vite(['resources/js/register.js'])

</body>

</html>
