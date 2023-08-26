<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="../style/commonstyles.css">
    <link rel="stylesheet" href="">

</head>

<body>
    <!--Registering with steps for better user experience-->
    <h2>Register</h2>

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
            <label>Security question</label>
            <select name="questions" id="security_questions">
                <option value="">Choose</option>
                <option value="Q1">q1</option>
                <option value="Q2">q2</option>
                <option value="Q3">q3</option>
                <option value="Q4">q4</option>
                <option value="Q5">q5</option>
                <option value="Q6">q6</option>
                <option value="Q7">q7</option>
                <option value="Q8">q8</option>
                <option value="Q9">q9</option>
                <option value="Q10">q10</option>
            </select>
            <label>Security answer</label>
            <input type="text">
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

    <script src="../controller/commonscript.js"></script>
    <script src=""></script>
</body>

</html>