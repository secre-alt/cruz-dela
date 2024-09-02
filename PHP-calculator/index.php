 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Calculator</title>
 </head>
 <body>

    <form action="inludes/calculate.php" method="post">
      <div class="buttons">
         <input type="submit" name="num" value="7" class="number-button">
         <input type="submit" name="num" value="8" class="number-button">
         <input type="submit" name="num" value="9" class="number-button">
         <input type="submit" name="operation" value="/" class="operation-button">

         <input type="submit" name="num" value="4" class="number-button">
         <input type="submit" name="num" value="5" class="number-button">
         <input type="submit" name="num" value="6" class="number-button">
         <input type="submit" name="operation" value="*" class="operation-button">

         <input type="submit" name="num" value="1" class="number-button">
         <input type="submit" name="num" value="2" class="number-button">
         <input type="submit" name="num" value="3" class="number-button">
         <input type="submit" name="operation" value="-" class="operation-button">

         <input type="submit" name="num" value="0" class="number-button">
         <input type="submit" name="num" value="." class="number-button">
         <input type="submit" name="clear" value="C" class="clear-button">
         <input type="submit" name="operation" value="+" class="operation-button">
      </div>
         <button type="submit" name="submit" value="calculate" 
         class="equal-button">=</button>
    </form>
 </body>
 </html>