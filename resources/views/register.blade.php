<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <!--Registering with steps for better user experience-->
    <h2>Register</h2>
     @csrf
    <!--Step 1: choose registering type-->
    <div id="Registering_Type_Content">
        <h3>Choose a registering type</h3>
        <div>
            <p>I want to bid on items!</p>
            <button>Bidder</button>
        </div>
        <div>
            <p>I have items to sell!</p>
            <button>Merchant</button>
        </div>
        <div>
            <p>I want to expertise items!</p>
            <button>Auctioneer</button>
        </div>
        <input type="submit" value="Next">
    </div>

    <!--Step 2: account information-->
    <div id="Account_Information_Content">
        <h3>Account details</h3>
        <form action=" /register" method= "POST">
            @csrf
            <label>Enter a username</label>
            <input name=username type="text">
            <label>Enter email</label>
            <input name=email type="email">
            <label>Enter password</label>
            <input name=password type="password">
            <label>Confirm password</label>
            <input name=password type="password">
            <input type="submit" value="Next">
        </form>
    </div>

    <!--Step 3: personal information-->
    <div id="Personal_Information_Content">
        <h3>Personal details</h3>
        <form action=" /register" method= "POST">
            @csrf
            <label>name</label>
            <input name=name type="text">
            <label>Last name</label>
            <input name=last_name type="text">
            <label>Birth date</label>
            <input name=birth_date type="date">
            <label>Contact number</label>
            <input name=contact_number type="text">
            <input name=contact_number type="number">
            
            <input type="submit" value="Next">
        </form>
    </div>

    <!--Step 4: location information-->
    <div id="Location_Information_Content">
        <h3>Location details</h3>
        <form action=" /register" method= "POST">
            @crsf
            <label>Street</label>
            <input name=street type="text">
            <label>City</label>
            <input name=city type="text">
            <label>Postal/Zip Code</label>
            <input name=postal_code type="text">
            <label>Country</label>
            <input name=country type="text">
            <input type="submit" value="Next">
        </form>
    </div>
</body>

</html>