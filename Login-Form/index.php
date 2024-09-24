<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <main>
        <form action="includes/formhandler.php" method="post">
            
            <label for="firstname">First Name</label>
            <input id="firstname" type="text" name="firstname" placeholder="First Name">
            
            <label for="lastname">Last Name</label>
            <input id="lastname" type="text" name="lastname" placeholder="Last Name">
                    
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="none">None</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
                       
            <button type="submit">Submit</button>
        </form>
    </main>
</body>
</html>
